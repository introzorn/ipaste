<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{

public function login(Request $rec){
    if(Auth::check()){return redirect(route('main'));} //а может пользователь уже залогинился
    $valid=$rec->validate([
        'user'=>'required|string|max:255|min:5|regex:/^[a-z]+$/i',
        'password'=>'required|min:6',

    ]);


    if(Auth::attempt(['user'=>$valid['user'],'password'=> $valid['password']])){
        return redirect(route('main'));
    }
 return redirect(route('login'))->withErrors(['user'=>'Неверный логин или пароль']);

}



public function reg(Request $rec){
    if(Auth::check()){return redirect(route('main'));} //а может пользователь уже залогинился
    $valid=$rec->validate([
        'user'=>'required|string|max:255|min:5|regex:/^[a-z]+$/i|unique:users',
        'password'=>'required|min:6',
        'password_confirmation' => 'required|min:6|same:password',

    ]);
     $user=User::create(['user'=>$valid['user'],'password'=> Hash::make($valid['password'])]);
     Auth::login($user);
     if($user){
            Auth::login($user);
            return redirect(route('main'));
     }
     if(Auth::check()){return redirect(route('main'));}  // еще раз проверим на всякий случай
     return redirect(route('reg'))->withErrors(['error'=>'Неизвестная ошибка']); //если вдруг регистрация не прошла как надо

}

public function logout(){
    Auth::logout();
    return redirect(route('main'));
}


}
