<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }
    public function checkPassword()
    {
        $user = User::find(request()->user()->id);
        if (Hash::check(request()->value, $user->password)) {
            return ['success' => true];
        }
        return ['success' => false];
    }
}
