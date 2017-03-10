<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Videos;
use Youtube;
use Exception;
use Session;
use Redirect;
use DB;
use App\Likes;
use App\UnLikes;
use Auth;

class VideosController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['only'=>['create']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos =  Videos::paginate(5);
        
        return view('home', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $videoId = Youtube::parseVidFromURL($request->url);
        $relatedVideos = Youtube::getRelatedVideos($videoId);
        
        if(Youtube::getVideoInfo($videoId)==false)
        {
            return redirect()->back()->with('message-error', 'Error.');
        }
        else{
            $videoInfo = Youtube::getVideoInfo($videoId);
            $createVideo = new Videos;
            $createVideo->url = $videoId;
            $createVideo->title = $request->title;
            $createVideo->description = $request->description;
            $createVideo->category = $request->category;
            $createVideo->save();
            
            return redirect()->route('videos.index')->with('message', Session::flash('message','Video Ingresado Correctamente.'));
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
    
    public function ver($id){
        $videos = Videos::find($id);
        
        return view('show', compact('videos'));
    }
    
    public function like($user, $video){
        
    }
}
