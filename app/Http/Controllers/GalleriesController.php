<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Image;
use App\Http\Requests\GalleryRequest;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $term = $request->input('term');

        return Gallery::getGalleries($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request title
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $user = auth()->user()->id;

        $gallery = new Gallery();
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->user_id = $user;

        $gallery->save();

        $imags = [];
        foreach($request->images as $img) {
            $imags[] = new Image($img);
        }
        $gallery->images()->saveMany($imags);
        
        return $this->show($gallery->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Gallery::getSingleGallery($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = auth()->user()->id;

        $gallery = Gallery::find($id);
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->user_id = $user;
        $gallery->save();        
        
        $gallery->images()->delete();
        $imags = [];
        foreach(request('images') as $img) {
            $imags[] = new Image($img);
        }
        $gallery->images()->saveMany($imags);
        return $this->show($gallery->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}
