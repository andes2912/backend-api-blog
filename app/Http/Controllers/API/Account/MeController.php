<?php

namespace App\Http\Controllers\API\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,ActivityLog};
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

        if ($user) {
          $ActivityLog = ActivityLog::create([
            'user_id'   => Auth::id(),
            'method'    => 'Update',
            'Note'      => 'Update Profile'
          ]);
        }

        return \response()->json([
          'message' => 'Data User Berhasil Diupdate',
          'user'    => $user,
          'log'     => $ActivityLog
        ],200);
      }
    }
}
