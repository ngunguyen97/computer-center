<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // fetch all the images
      $files  =   Document::all();
      return view('documents.index', compact('files'));
    }

  public function getDownload($slug)
  {
    $item = Document::where('slug', '=', $slug)->firstOrFail();

    if($item->count()) {
      $path = json_decode($item->filename, true)[0]["download_link"];
      $name = json_decode($item->filename, true)[0]["original_name"];
      $path_test = Voyager::image($path);
      dd($path_test);
      //PDF file is stored under project/public/download/info.pdf
      $file= public_path('storage/'. $path);
      //dd($file);

      //dd(storage_path($file_name));

      return response()->download($file, $name);
    }

  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //dd($request->file('filename'));
      // if validation success
      if($file   =   $request->file('filename')) {

        $name      =   time().time().'.'.$file->getClientOriginalExtension();

        $target_path    =   public_path('/uploads/');

        if($file->move($target_path, $name)) {

          // save file name in the database
          $file   =   Document::create([
            'name' => 'test',
            'filename' => $name
          ]);

          return back()->with("success", "File uploaded successfully");
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
