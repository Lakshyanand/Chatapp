<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdetail;
use App\Models\Forgotpassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\resetmail;
use Validator;


class checkloginController extends Controller
{
    public function checkUser(Request $req)
    {
        $validatedData = $req->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $userDetail = Userdetail::where('email',$req->email)->get()->first();

        if(!$userDetail)
        {
            // return view('login',['errorMessage' => 'Email does not exist']);
            return redirect('/login')->with('errorMessage','Email does not exist');
        }
        else
        {
            $passwordHashStatus = Hash::check($req->password,$userDetail->password);

            if(!$passwordHashStatus)
            {
                // return view('login',['errorMessage' => 'Incorrect Password']);
                return redirect('/login')->with('errorMessage','Incorrect Password');

            }
            else
            {
                if($userDetail->role == 'Admin')
                {
                    $req->session()->put('role','Admin');
                    session(['username' => 'Lakshya']);
                    session(['id'=>$userDetail->id]);
                    
                    return redirect('adminpanel');
                }
                else if($userDetail->role == 'Agent')
                {
                    session(['id'=>$userDetail->id]);

                    session(['username' => $userDetail->name]);
                    if($userDetail->firstTimeLogin == 0)
                    {
                        session(['idd'=>$userDetail->id]);
                        return redirect('agentResetPass');
                        // return view('agentResetPass');
                    }
                    else
                    {
                        session(['role'=>'Agent']);
                        return redirect('agentpanel');
                    }
                }
            }
        }
    }

    public function changepass(Request $req)
    {
        $emailExitsOrNot = Userdetail::where('email',$req->email)->get()->first();
        if($emailExitsOrNot)
        {
            $randomNumber = random_int(100000, 999999);

            $emailExits = Forgotpassword::where('email',$req->email)->get()->first();
            if($emailExits)
            {
                $emailExits->otp = $randomNumber;
                $emailExits->save();
            }
            else
            {
                $forgotpassword = new Forgotpassword;
                $forgotpassword->email = $req->email;
                $forgotpassword->OTP = $randomNumber;
                $forgotpassword->save();
            }
    
            $checkEmail = Forgotpassword::where('email',$req->email)->get()->first();
            $checkId = $checkEmail->id;
            $link = url('changepassword/'.$checkId.'/'.$randomNumber);
            
    
            $resetdata = [
                'otp' => $randomNumber,
                'link' => $link,
            ];
        
            Mail::to($req->email)->send(new resetmail($resetdata));
    
            return redirect('login')->with('successMessage','OTP sent successfully...Please check your email for reset passowrd link.');
        }

        return redirect('forgotpass')->with('errorMessage','Email does not exist..Please enter correct email');
       
    }

    public function checkOtp($id,$otp)
    {
        $checkId = Forgotpassword::find($id);
        if($checkId)
        {
            $checkOTP = Forgotpassword::where('OTP',$otp)->get()->first();
            if($checkOTP)
            {
                return redirect('changepass')->with('id',$id);
            }
            return redirect('login');
        }
        return redirect('login');
    }

    public function setNewPassword(Request $req)
    {
        $id = Forgotpassword::find($req->id);
        $email = $id->email;

        $findEmailRow = Userdetail::where('email',$email)->get()->first();
        if($findEmailRow)
        {
            if($req->password == $req->confirmpassword)
            {
                $findEmailRow->password = Hash::make($req->password);
                $findEmailRow->save();
                return redirect('login')->with('successMessage','New password set successfully');
            }
            return redirect('changepass')->with('errorMessage','Password and confirm password are different');
        }
        return redirect('login')->with('errorMessage','Email does not exist');

    }

    public function setLanguage(Request $req)
    {
        // dd('hi');
        $lang = $req->language;
        session(['lang'=>$lang]);
        return redirect('/login');
    }


}