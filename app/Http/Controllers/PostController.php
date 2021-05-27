<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('status', 'PUBLISHED')->take(8)->orderBy('id', 'DESC')->get();
        return view('posts', compact('posts'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('post', compact('post'));
    }

  public function getDownload($slug)
  {
    $item = Post::where('slug', '=', $slug)->firstOrFail();

    if($item->count()) {
      $path = json_decode($item->meta_description, true)[0]["download_link"];
      $name = json_decode($item->meta_description, true)[0]["original_name"];
      //PDF file is stored under project/public/download/info.pdf
      $file= public_path('storage/'. $path);

      return response()->download($file, $name);
    }

  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
