<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function changeSettings(SettingsRequest $request){

        $user = auth()->user();

        if ($user->email != $request->email){
            $user->email = $request->email;
        }

        if (isset($request->new_password)){
            $user->password = Hash::make($request->new_password);
        }

        if (isset($request->nip)){
            $user->client->nip = $request->nip;
            $user->client->save();
        } else {
            $user->client->nip = null;
            $user->client->save();
        }

        $user->save();

        return redirect()->back()->with('success','Zmiany na koncie zostały pomyślnie wprowadzone!');
    }
}
