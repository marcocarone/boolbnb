<?php

namespace App\Http\Controllers\upr;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Image;
use App\Apartment;
use Illuminate\Http\Request;
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
    }


    public function create()
    {
        return view('upr.image-upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);

        $newImage = new Image;
        $newImage->apartment_id = $data['apartmentId'];
        $newImage->img_path = $imageName;
        $newImage->save();
        // dd($newImage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Image $image)
    {
			$image->delete();
			return redirect()->back();
    }

    public function deleteImage(Request $request)
    {
        $image = $request->file('filename');
        $filename =  $request->get('filename').'.jpeg';
        Image::where('img_path', $filename)->delete();
        $path = public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
