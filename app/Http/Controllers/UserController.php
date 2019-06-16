<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Mail\UserInvitationMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
   public function sendInvitation(Request $request){
       $this->validate($request,[
           'email' => 'required|string|email|max:255|unique:users,email',
       ]);

        $client = Client::where('id','=',$request->client)->first();

        $user = new User;
        $user->name = $client->name;
        $user->email = $request->email;
        $user->password = Hash::make('SarosPartners');
        $user->token = sha1(uniqid($client->name, true));
        $user->save();

        $client->user_id = $user->id;
        $client->save();

       Mail::to($user->email)->send(new UserInvitationMail($user));

       return redirect()->back()->with('success','Zaproszenie zostało wysłane pod adres: '.$user->email.'!');
   }

   public function registration($token, Request $request){
       if (auth()->user()){
           return redirect()->route('dashboard')->with('error','Musisz się wylogować by móc potwierdzić nowe konto!');
       }

       $user = User::where('token','=',$token)->first();
       if (!isset($user)){
           return redirect()->route('login');
       }

       return view('users.registration-form',compact('user'));
   }

    public function store(User $user, Request $request){
        if (isset($request->admin) && $request->admin == 1){
            $this->validate($request,[
                'name' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'string|min:6',
                'confirm_password' => 'string|same:password',
            ]);

            $user = new User;
            $user->admin = 1;
            $user->name = $request->name;
        } else {
            $this->validate($request,[
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'password' => 'string|min:6',
                'confirm_password' => 'string|same:password',
                'privacy_policy' => 'required'
            ]);
        }

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = null;
        $user->created_at = now();
        $user->save();

        if (isset($request->admin) && $request->admin == 1){
            return redirect()->back()->with('success','Administrator '.$user->name.' został dodany!');
        }
        return redirect()->route('login')->with('success','Użytkownik został zarejestrowny!');
    }
}
