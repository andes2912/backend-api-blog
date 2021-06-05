<?php

namespace App\Http\Controllers\API\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{News,Category,User,ActivityLog};
use Auth;
use Validator;
use Str;

class NewsController extends Controller
{
    //index
    public function index()
    {
      $news = News::with('User','Category')->orderBy('created_at','DESC')->get();


      if ($news) {
        return \response()->json([
          'data'  => $news
        ],200);
      }
    }

    // Store
    public function store(Request $request)
    {
      $token = Auth::user()->token();
      if (!$token) {
        return \response()->json([
          'message' => 'Token Invalid !'
        ], 401);
      }

      $validator = Validator::make($request->all(), [
        'title'         => 'required|Max:100',
        'content'       => 'required',
        'category_id'   => 'required|exists:categories,id|numeric|min:1',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()], 401);
      }

      $news = News::Create([
        'title'       => $request->title,
        'slug'        => Str::slug($request->title) .'-'. Str::random(5) . '-' .Auth::id(),
        'content'     => $request->content,
        'category_id' => $request->category_id,
        'user_id'     => Auth::id()
      ]);

      if ($news) {
        $ActivityLog = ActivityLog::create([
          'user_id' => Auth::id(),
          'method'  => 'Create',
          'Note'    => 'Create News'
        ]);

        return \response()->json([
          'message' => 'Berita Berhasil Ditambah',
          'data'    => $news,
          'log'     => $ActivityLog
        ],200);
      }
    }

    // Update Berita
    public function update(Request $request)
    {
      $token = Auth::user()->token();
      if (!$token) {
        return \response()->json([
          'message' => 'Token Invalid !'
        ], 401);
      }

      $validator = Validator::make($request->all(), [
        'title'         => 'required|Max:100',
        'content'       => 'required',
        'category_id'   => 'required|exists:categories,id|numeric|min:1',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()], 401);
      }

      $news = News::where('slug', $request->slug)->first();
      $news->title    = $request->title;
      $news->content  = $request->content;
      $news->category_id  = $request->category_id;

      if ($news->user_id != Auth::id()) {
        return \response()->json([
          'message' => 'Tidak Diijinkan',
          'error'  => 403
        ],403);
      }

      $news->save();

      if ($news) {
        $ActivityLog = ActivityLog::create([
          'user_id' => Auth::id(),
          'method'  => 'Update',
          'Note'    => 'Update News'
        ]);

        return \response()->json([
          'message' => 'Berita Berhasil Diupdate',
          'data'    => $news,
          'log'     => $ActivityLog
        ],200);
      }

    }

    // Show
    public function show(Request $request)
    {
      $news = News::with('User','Category')->where('slug', $request->slug)->first();

      if ($news) {
        return \response()->json([
          'data'  => $news
        ],200);
      }

      return \response()->json([
        'message'  => 'Berita Tidak Ditemukan',
        'errors'   => 404
      ],404);
    }

    // Show news by id user
    public function showByUserId(Request $request)
    {
      $news = User::with('News')->where('name', $request->name)->first();

      if ($news) {
        return \response()->json([
          'data'    => $news
        ],200);
      }

      return \response()->json([
        'message'    => 'User Tidak Ditemukan',
        'errors'     => 404
      ],404);
    }
}
