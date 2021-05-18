<?php

namespace App\Http\Controllers\API\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class MeController extends Controller
{
    // Me
    public function index()
    {
      $token = Auth::user()->token();
      if ($token) {

        $user = auth()->user();

        return \response()->json([
          'success' => true,
          'user'    => $user
        ]);
      }
    }

    // Update
    public function update(Request $request, $id)
    {
      $token = Auth::user()->token();
      if ($token) {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return \response()->json([
          'message' => 'Data User Berhasil Diupdate',
          'user'    => $user
        ],200);
      }
    }
}
