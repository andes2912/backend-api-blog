<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use Str;

class CategoryController extends Controller
{
    // index
    public function index()
    {
      $category = Category::orderBy('created_at','DESC')->get();

      return \response()->json([
        'data'  => $category,
      ]);
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
        'name'  => 'required|unique:categories|max:10',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()], 401);
      }

      $category = Category::create([
        'name'    => $request->name,
        'slug'    => Str::slug($request->name) .'-'.Str::random(5) .'-'.Auth::id()
      ]);

      if ($category) {
        return \response()->json([
          'message' => 'Category Berhasil Ditambah',
          'data'    => $category
        ],200);
      }
    }

    // Update
    public function update(Request $request)
    {
      $token = Auth::user()->token();
      if (!$token) {
        return \response()->json([
          'message' => 'Token Invalid !'
        ], 401);
      }

      $validator = Validator::make($request->all(), [
        'name'  => ['required', Rule::unique('categories')->ignore($request->slug,'slug'),'Max:20'],
      ]);

      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()], 401);
      }

      $category = Category::where('slug',$request->slug)->first();
      $category->name = $request->name;
      if ($request->status) {
        $category->status = (int)$request->status;
      } else {
        $category->status = (int)$request->status;
      }
      $category->save();

      if ($category) {
        return \response()->json([
          'message' => 'Category Berhasil Diupdate',
          'data'    => $category
        ],200);
      }
    }

     // Show
    public function show(Request $request)
    {
      $category = Category::with('News','User')->where('slug',$request->slug)->first();

      if ($category) {
        return \response()->json([
          'data'  => $category
        ],200);
      }


      return \response()->json([
        'message'  => 'Category Tidak Ditemukan',
        'errors'   => 404
      ],404);

    }
}
