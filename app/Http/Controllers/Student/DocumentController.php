<?php

namespace App\Http\Controllers\Student;

use App\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct() {
      $this->middleware('auth:student')->except('logout');
    }
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
      $filename = json_decode($item->filename, true)[0]["download_link"];
      $name = json_decode($item->filename, true)[0]["original_name"];
      $file= Storage::disk('s3')->get($filename);

      $headers = [
        'Content-Type' => 'text/csv',
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => "attachment; filename={$name}",
        'filename'=> $name
      ];

      return response($file, 200, $headers);
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
