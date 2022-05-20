<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SesionController extends Controller
{
    //
    public function sesionValidate(Request $request)
    {
        //  dd($request->email);
        $credentials = [
            'email' => $request->email,
            'password' => $request->pwrd,
        ];

        // dd($credentials);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->pwrd])) {
            $request->session()->regenerate();

            // dd(auth()->user()->role);

            if (auth()->user()->role == 1){
                return response()->json([
                    'status' => 'succesAdmin',
                    'responseText' => 'redireccionar-admin'
                ], 200);
            } else if (auth()->user()->role == 2){
                return response()->json([
                    'status' => 'succesUser',
                    'responseText' => 'redireccionar-usuario'], 200);
            }
            
        }

     
         return response()->json(['responseText' => 'Credenciales incorrectas'], 200);

       

    }
}
