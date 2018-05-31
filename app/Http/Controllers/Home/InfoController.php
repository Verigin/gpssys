<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function index()
    {
        return view('home.info', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:true',
            'password' => 'confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password') && $request->password == $request->password_confirmation && $request->password != '') {
            //dd($request);
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->route('home.info')->with('success', 'Info updated successfuly');
    }
}
