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
    public function index(){
        $videos =  Videos::paginate(5);
        
        return view('home', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if($request->type == 1){
            $videoId = Youtube::parseVidFromURL($request->url);
            $relatedVideos = Youtube::getRelatedVideos($videoId);
            
            if(Youtube::getVideoInfo($videoId)==false)
            {
                Session::flash('message-error', 'Error: No se pudo Ingresar el Video (Los videos tienen que ser de Youtube y/o formato mp4).');
                return Redirect()->back();
            }
            else{
                $videoInfo = Youtube::getVideoInfo($videoId);
                $createVideo = new Videos;
                $createVideo->type = 'enlace';
                $createVideo->name = $videoId;
                $createVideo->title = $request->title;
                $createVideo->description = $request->description;
                $createVideo->category = $request->category;
                $createVideo->save();
               
                Session::flash('message', 'Video Ingresado Correctamente.');
                return redirect()->route('videos.index');
            }
        }
        
        elseif($request->type == 2)
        {
            $boolean = true;
            switch ($request->file->getclientoriginalextension()) 
            {
                case 'wmv': $boolean = true; break;
                case 'mp4': $boolean = true; break;
                default: $boolean = false; break;
            }
            
            if($boolean == true)
            {
                $createVideo = new Videos;
                $createVideo->type = 'archivo';
                $file = $request->file;
                $fileName = $file->getClientOriginalName();
                \Storage::disk('videos')->put($fileName, \File::get($file));
                $createVideo->name = $fileName;
                $createVideo->title = $request->title;
                $createVideo->description = $request->description;
                $createVideo->category = $request->category;
                $createVideo->save();
                
                Session::flash('message', 'Video Ingresado Correctamente.');
                return redirect()->route('videos.index');
            }
            else
            {
                
                Session::flash('message-error', 'Error: No se pudo Ingresar el Video (Los videos tienen que ser de Youtube y/o formato mp4).');
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
    
    public function ver($id){
        $videos = Videos::find($id);
        
        return view('show', compact('videos'));
    }
    
    public function like($video){
        
        $contadorLikes = Likes::where('videos_id', $video)->where('user_id', Auth::user()->id)
                ->count();
                
        $contadorUnLikes = UnLikes::where('videos_id', $video)->where('user_id', Auth::user()->id)
                ->count();
        
        if($contadorLikes == 0 && $contadorUnLikes == 0)
        {
            $vid = Videos::find($video); 
            $vid->likes()->save(new Likes(['videos_id' => $vid->id, 'user_id' => Auth::user()->id]));    
            
            $contadorL = Likes::where('videos_id', $video)->count();
            $contadorU = UnLikes::where('videos_id', $video)->count();
            
            return ['likes' => $contadorL, 'unLikes' => $contadorU];
        }
        elseif($contadorLikes == 0 && $contadorUnLikes > 0)
        {
            UnLikes::where('videos_id', $video)->where('user_id', Auth::user()->id)->delete();
            $vid = Videos::find($video); 
            $vid->likes()->save(new Likes(['videos_id' => $vid->id, 'user_id' => Auth::user()->id])); 
            
            $contadorL = Likes::where('videos_id', $video)->count();
            $contadorU = UnLikes::where('videos_id', $video)->count();
            
            return ['likes' => $contadorL, 'unLikes' => $contadorU];
        }
        elseif($contadorLikes == 1)
        {
            $contadorL = Likes::where('videos_id', $video)->count();
            $contadorU = UnLikes::where('videos_id', $video)->count();
            
            return ['likes' => $contadorL, 'unLikes' => $contadorU];
        }
    }
    
    public function unlike($video){
        $contadorLikes = Likes::where('videos_id', $video)->where('user_id', Auth::user()->id)
                ->count();
                
        $contadorUnLikes = UnLikes::where('videos_id', $video)->where('user_id', Auth::user()->id)
                ->count();
        
        
        if($contadorUnLikes == 0 && $contadorLikes == 0)
        {
            $vid = Videos::find($video); 
            $vid->likes()->save(new UnLikes(['videos_id' => $vid->id, 'user_id' => Auth::user()->id]));    
            
            $contadorL = Likes::where('videos_id', $video)->count();
            $contadorU = UnLikes::where('videos_id', $video)->count();
            
            return ['likes' => $contadorL, 'unLikes' => $contadorU];
        }
        elseif($contadorUnLikes == 0 && $contadorLikes > 0)
        {
            Likes::where('videos_id', $video)->where('user_id', Auth::user()->id)->delete();
            $vid = Videos::find($video); 
            $vid->likes()->save(new UnLikes(['videos_id' => $vid->id, 'user_id' => Auth::user()->id])); 
            
            $contadorL = Likes::where('videos_id', $video)->count();
            $contadorU = UnLikes::where('videos_id', $video)->count();
            
            return ['likes' => $contadorL, 'unLikes' => $contadorU];
        }
        elseif($contadorLikes == 1)
        {
            $contadorL = Likes::where('videos_id', $video)->count();
            $contadorU = UnLikes::where('videos_id', $video)->count();
            
            return ['likes' => $contadorL, 'unLikes' => $contadorU];
        }
    }
}
