<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdetail;
use App\Models\Chatdetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class agentPanelController extends Controller
{
    public function reset(Request $req)
    {

        // dd('hi');
        $validatedData = $req->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required',
        ]);

        // $userdetail = Userdetail::where('email',$req->email)->get()->first();
        $userdetail = Userdetail::find($req->id);
        
            $passwordHashStatus = Hash::check($req->oldpassword,$userdetail->password);
            if($passwordHashStatus)
            {
                if($req->newpassword == $req->confirmpassword)
                {
                    $id = $userdetail->id;
                    $rowToBeUpdated = Userdetail::find($id);
                    $rowToBeUpdated->password = Hash::make($req->newpassword);
                    
                    $rowToBeUpdated->firstTimeLogin = 1;
                    $rowToBeUpdated->save();
                    
                    session()->pull('role',null);

                    // return view('agentResetPass',['successMessage' => 'Password changed successfully']);
                          
                    return redirect('/login')->with('password','Password changed successfully');
                }
                else
                {
                    // $error = "Password and confirm password are not same";
                    // dd('hi');
                    return redirect('/agentResetPass')->with('resetError','Password and confirm password are not same');

                }
            }
            else
            {
                // $error = "Please enter the same password as sent on your registered mail";
                return redirect('/agentResetPass')->with('resetError','Please enter the same password as sent on your registered mail');

            }

        // return view('agentResetPass',['errorMessage' => $error]);
        // return redirect('/agentResetPass')->with('resetError',$error);

    }


    public function viewAgents()
    {
        $userdetail = Userdetail::all();
        return ['status' => true ,'lists' => $userdetail];
    }

    public function loadChat($id)
    {

        $loggedInUser = session('id');
        $receiverUser = $id;
        

        $chatMessage = Chatdetail::orderBy('created_at')
                 ->get()->toArray();

                //  $lastMessage = count($chatMessage);
                //  $messageCount = 1;

        $messages = [];
        foreach($chatMessage as $message)
        {
            if( ($message['senderId'] == $loggedInUser) && ($message['receiverId'] == $receiverUser) )
            {
                $message['type']='outgoing';

                $name = Userdetail::find($loggedInUser);
                $message['personname'] = $name->name;

                $time = $message['created_at'];
                $chattime = date("h:i:A",strtotime($time));
                $message['time'] = $chattime;                
            }
            else{
                if( ($message['senderId'] == $receiverUser) && ($message['receiverId'] == $loggedInUser) ){
                    $message['type']='incoming';

                    $name = Userdetail::find($receiverUser);
                    $message['personname'] = $name->name;
                    

                    $time = $message['created_at'];
                    $chattime = date("h:i:A",strtotime($time));
                    $message['time'] = $chattime;
                    
                }else{
                    unset($message);
                }
            }
                // $array = [];

                // if(isset($message) && $messageCount == $lastMessage){
                //     $message['lastMessage'] = 1; 
                // }

            if(isset($message)){
                unset($message['senderId'],$message['receiverId'],$message['id'],$message['updated_at']);

                $messages[] = $message;
            }

            // $messageCount++;
        }

        return ['status' => 200, 'name'=> Userdetail::find($receiverUser)->name , 'messages' => $messages];

        // return view('chatpage',['messages' => $messages]);
    }

    public function saveChat(Request $req)
    {
        $chatdetail = new Chatdetail;
        $chatdetail->senderId = $req->sender;
        $chatdetail->receiverId = $req->receiver;
        $chatdetail->message = $req->message;
        
        $chatdetail->created_at = Carbon::now()->addminutes('330');

        $chatdetail->save();

        return response()->json([

            'status'=>'200',

            'message'=>'Message sent successfully'

        ]);

    }
    public function createfile(Request $req)
    {
        $loggedInUser = session('id');
        $receiverUser = $req->backupid;
        Storage::disk('local')->put("$loggedInUser-$receiverUser.csv", 'Backup');

        $chatMessage = Chatdetail::orderBy('created_at')->get();
        $msg = [];
        foreach($chatMessage as $message)
        {
            if( ($message['senderId'] == $loggedInUser) && ($message['receiverId'] == $receiverUser) )
            {
                $message['type']='outgoing';
                $message['message'] = Crypt::encryptString($message['message']);
                
                Storage::append("$loggedInUser-$receiverUser.csv",$message);

            }
            else if( ($message['senderId'] == $receiverUser) && ($message['receiverId'] == $loggedInUser) )
            {
                $message['type']='incoming';
                $message['message'] = Crypt::encryptString($message['message']);

                Storage::append("$loggedInUser-$receiverUser.csv", $message);
            }
        }
        
        return redirect('agentpanel');
    }
   
    public function DeleteChat(Request $req)
    {
        $senderData = Chatdetail::where('senderId',session('id'))->Where('receiverId',$req->idd);
        $senderData->delete();
        $receiverData = Chatdetail::where('senderId',$req->idd)->Where('receiverId',session('id'));
        $receiverData->delete();
        return redirect('agentpanel');
    }
    public function RestoreChat(Request $req)
    {
        $loggedInUser = session('id');
        $receiverUser = $req->restoreid;
        $contents = Storage::get("$loggedInUser-$receiverUser.csv");
        
            $location = "app";
            $filename = "$loggedInUser-$receiverUser.csv";
            $filepath = storage_path($location."/".$filename);
            $file = fopen($filepath,"r");
            $importData_arr = array();
            $i = 0;
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata );
                
                // Skip first row (Remove below comment if you want to skip the first row)
                if($i == 0){
                   $i++;
                   continue; 
                }       
                for ($c=0; $c < $num; $c++) {
                   $importData_arr[$i][] = $filedata [$c];
                }
                $i++;
            }
            fclose($file);
            foreach($importData_arr as $importData){
            
                $chatdetail = new Chatdetail();
                
                $import = explode(":",$importData[1]);
                $chatdetail->senderId = $import[1];
                
                $import = explode(":",$importData[2]);
                $chatdetail->receiverId = $import[1];

                $import = explode(":",$importData[3]);
                $msg = substr($import[1], 1, -1);
                $chatdetail->message = Crypt::decryptString($msg);

                $created = substr($importData[4], 11, -1);
                $time = str_replace("T", " ", $created);
                $time = substr($time, 0, strpos($time, "."));
                $time = substr($time,1,-1);
                $chatdetail->created_at = $time;
                
                $updated = substr($importData[5], 11, -1);
                $timing = str_replace("T", " ", $updated);
                $timing = substr($timing, 0, strpos($timing, "."));
                $timing = substr($timing,1,);
                $chatdetail->updated_at = $timing;

                $chatdetail->save();

            }
            
        return redirect('agentpanel');
    }
}