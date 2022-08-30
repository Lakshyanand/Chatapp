<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdetail;
use App\Mail\agentRegistration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;

class adminPanelController extends Controller
{
    public function toAgentPanel()
    {
        session(['role'=>'Agent']);
        return redirect('/agentpanel');
    }
    public function addagent(Request $req)
    {
        $validatedData = $req->validate([
            'email' => ['unique:userdetails']
        ]);
        $userdetail = new Userdetail;
        $userdetail->name = $req->name;
        $userdetail->email = $req->email;
        $userdetail->role = "Agent";
        $pass = Str::random(8);
        $userdetail->password = Hash::make($pass);
        $userdetail->save();

        $maildata = [
            'email' => $req->email,
            'password' => $pass
        ];
    
        Mail::to($req->email)->send(new agentRegistration($maildata));

        // return view('addagent',['successMessage'=> 'Agent added successfully']);
        return redirect('/addagent')->with('successMessage','Agent added successfully');
    

    }

    public function agentlist(Request $req)
    {
        if($req->search)
        {
            $userdetail = Userdetail::where('role','Agent')->Where('name',"LIKE","%$req->search%")->where('email',"LIKE","%$req->search%")->get();
            if($userdetail)
            {
                return view('/adminpanel',['lists' => $userdetail]);
            }
            return redirect('/adminpanel')->with('error','No such entry');
        }

        $userdetail = Userdetail::where('role','Agent')->get();
        return view('/adminpanel',['lists' => $userdetail]);
    }

    public function deleteAgent($id)
    {
        $userdetail = Userdetail::find($id);
        $userdetail->delete();
        return redirect('/adminpanel')->with('success','Agent Deleted Successfully');
    }

    public function editAgent(Request $req)
    {
        $userdetail = Userdetail::find($req->id);
        $userdetail->name = $req->name;
        $userdetail->save();
        return redirect('/adminpanel')->with('success','Agent Updated Successfully');
    }

}