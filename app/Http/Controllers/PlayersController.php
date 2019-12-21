<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Player;
use DB;

class PlayersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$players =DB::select('SELECT* FROM players');
        $players = Player::orderBy('created_at','asc')->get();
        return view('players.index')->with('players',$players);
        //$players= Player::all();
        //return view('players.index')->with('players',$players);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required',
            'country'=>'required',
            'age'=>'required'
            ,'player_cover_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('player_cover_image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('player_cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('player_cover_image')-> getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('player_cover_image')->storeAs('public/player_cover_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        //create Player
        $player = new Player;
        $player->name =$request->input('name');
        $player->country =$request->input('country');
        $player->age =$request->input('age');
        $player->user_id= auth()->user()->id;
        $player->player_cover_image=$fileNameToStore;
        $player->save();

        return redirect('/players')->with('success','Player Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
       // return Player::find($id); //single post
       // $player = Player::where('country', '$id')->get();
        $player = Player::find($id);
        return view('players.show')->with('player',$player);
    }


    /*public function show_country($country)
    {
       // return Player::find($id); //single post
        $player = Player::where('country', '$id')->get();
        //$player = Player::find($country);
        return view('players.show_country')->with('player',$player);
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = Player::find($id);
        //check for correct user
        if(auth()->user()->id !==$player->user_id){
            return redirect('/players')->with('error','Unauthorized Page');
        }
        return view('players.edit')->with('player',$player);
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
        $this->validate($request,['name'=>'required',
            'country'=>'required',
            'age'=>'required'
            ,'cover_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('player_cover_image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('player_cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('player_cover_image')-> getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('player_cover_image')->storeAs('public/player_cover_images', $fileNameToStore);
        }

        //create Player
        $player = Player::find($id);
        $player->name =$request->input('name');
        $player->country =$request->input('country');
        $player->age =$request->input('age');
        if($request->hasFile('player_cover_image')){
            $player->player_cover_image = $fileNameToStore;
        }
        //$post->user_id=auth()->user()->id;
        //$post->cover_image=$fileNameToStore;
        $player->save();

        return redirect('/players')->with('success','Player Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player = Player::find($id);

        //check for correct user
        if(auth()->user()->id !==$player->user_id){
            return redirect('/players')->with('error','Unauthorized Page');
        }
        if($player->player_cover_image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/player_cover_images/'.$player->player_cover_image);
        }

        $player->delete();
        return redirect('/players')->with('success','Player Removed');
    }
}
