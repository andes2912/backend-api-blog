<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;

class RegisterController extends Controller
{
    //Register
    public function index(Request $request)
    {
      $validator = Validator::make($request->all(),[
        'name'      => 'required|max:55',
        'email'     => 'email|required|unique:users',
        'password'  => ['required', 'confirmed', Password::min(8)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()
            // ->uncompromised(),
        ],
      ]);

      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()], 401);
      }


      $user = User::create([
        'name'                    => $request->name,
        'email'                   => $request->email,
        'password'                => bcrypt($request->password),
        'password_confirmation'   => bcrypt($request->password_confirmation),
      ]);

      $accessToken = $user->createToken('ApiToken')->accessToken;

      return response()->json([
        'user'          => $user,
        'access_token'  => $accessToken,
      ],200);
    }
}
