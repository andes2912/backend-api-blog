<?php

namespace App\Http\Controllers\API\Log;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,ActivityLog};
use Auth;

class LogController extends Controller
{
    // Log
    public function index()
    {
      $token = Auth::user()->token();
      if ($token) {

        $log = ActivityLog::where('user_id',Auth::id())->orderBy('id','DESC')->get();

        return \response()->json([
          'success' => true,
          'log'    => $log
        ]);
      }
    }
}
