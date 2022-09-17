<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('video.index',[
            'videos' => Video::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'video' => 'required|file|mimetypes:video/mp4',
        ]);

        $path = $request->file('video')->store('public/videos');
 
        if ($path) {
            $video = new Video();
            $video->name = $request->name;
            $video->path = $path;
            $video->save();

            return redirect()->back()->with('message','Success Submit Video');
        }

        return redirect()->back()->with('message','Failed Submit Video');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('video.edit',[
            'video' => $video,
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        if($request->hasFile('video')){
            $request->validate([
              'video' => 'required|file|mimetypes:video/mp4',
            ]);
            $path = $request->file('video')->store('public/videos');
            Storage::delete($video->path);
            $video->path = $path;
        }
        $video->name = $request->name;
        $video->save();

        return redirect()->route('video.index')->with('message','Success Update Video');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        Storage::delete($video->path);
        $video->delete();

        return redirect()->back()->with('message','Success Delete Video');
    }
}
