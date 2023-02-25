<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('component.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, image $image)
    {

        $file = $request->file('image');
        $nama_file = $file->getClientOriginalName();
        $finalName = date('YndHis') . "-" . $nama_file;

        $request->file('image')->storeAs('ImageUpload/', $finalName, 'public');

        $image->create([
            'nama_gambar' => 'http://localhost:8000' . Storage::url('ImageUpload/' . $finalName),
        ]);

        return redirect('/show');
        // return response()->json(['Success' => true], 200);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(image $image)
    {
        $data = $image->all();

        // $data =[
        //     'data' => $data
        // ];

        return view('component.showImage', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(image $image)
    {
        return view('component.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, image $image)
    {

        // dd($image);
        if ($request->hasFile('image')) {

            $exploded = explode('/', $image->nama_gambar);
            $lastPathName = end($exploded);

            if (File::exists('storage/ImageUpload/' . $lastPathName)) {
                unlink('storage/ImageUpload/' . $lastPathName);
            }

            $file = $request->file('image');
            $nama_file = $file->getClientOriginalName();
            $finalName = date('YmdHis') . "-" . $nama_file;

            $request->file('image')->storeAs('ImageUpload/', $finalName, 'public');
        }

        $image->update([
            'nama_gambar' => 'http://localhost:8000' . Storage::url('ImageUpload/' . $finalName),
        ]);

        return redirect('/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(image $image)
    {
        $exploded = explode('/', $image->nama_gambar);
        $lastPathName = end($exploded);

        if (File::exists('storage/ImageUpload/' . $lastPathName)) {
            unlink('storage/ImageUpload/' . $lastPathName);
        }

        $image->delete();

        return redirect('/show');
    }
}
