<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{   
    public function index(Request $request){
        return User::with(["posts"])->latest()->get();
    }

    public function show(Request $request){
        return User::with(["posts"])->findOrFail($id);
    }

    public function signup(Request $request){

        $request->validate([
            "password"=>"required|confirmed",
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $token = $user->createToken("mytoken")->plainTextToken;
        return response()->json([
            "user"=>$user,
            "token"=>$token,
        ]);
    
    }
    
    public function signout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(["user"=>"signout"]);
    }
    
    public function login(Request $request){
        $user = User::where("email",$request->email)->first();
        if(!$user||!Hash::check($request->password,$user->password)){
            return response()->json(["message"=>"Bad login"],401);
        }
        $token = $user->createToken("mytoken")->plainTextToken;
        return response()->json([
            "user"=>$user,
            "token"=>$token
        ]);
    }
}

