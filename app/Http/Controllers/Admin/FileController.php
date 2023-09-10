<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::where('user_id', auth()->user()->id)->paginate(3);
        return view('admin.files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file'=>'required|image'
        ]);

        $nombre = Str::random(10). $request->file('file')->getClientOriginalName();
        $ruta = storage_path(). '\app\public\images/'. $nombre;


        // url de consulta https://image.intervention.io/v2/api/resize
        Image::make($request->file('file'))
        ->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($ruta);

        File::create([
            'user_id'=> auth()->user()->id,
            'url'=>'/storage/images/'.$nombre
        ]);



        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($file)
    {
        return view('admin.files.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($file)
    {
        return view('admin.files.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        // metodo uno donde consultamos el id y lo listamos pero es mas facil por el File del metodo destroy
        //$file = File::where('id', $file)->first();
        $url = str_replace('storage','public', $file->url);
        Storage::delete($url);
        $file->delete();
        return redirect()->route('admin.files.index')->with('eliminar','ok');
        
    }
}
