<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {   
        abort_if($page > 500, 204);
        $client = new Client();
        $request = $client->request('GET','https://api.themoviedb.org/3/person/popular?api_key=956400813a76a24a25dc1842029b2360&page='.$page);
        $response1 = json_decode($request->getBody());
        $popularActors= $response1->results;
        //dump($popularActors);
        $viewModel = new ActorsViewModel($popularActors,$page);
        return view('actors.index',$viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $client = new Client();
        $request = $client->request('GET','https://api.themoviedb.org/3/person/'.$id.'?api_key=956400813a76a24a25dc1842029b2360');
        $actorDetails = json_decode($request->getBody());
        // dump($actorDetails);
        $request2= $client->request('GET','https://api.themoviedb.org/3/person/'.$id.'/external_ids'.'?api_key=956400813a76a24a25dc1842029b2360');
        $social = json_decode($request2->getBody());
        // dump($social);
        $request3= $client->request('GET','https://api.themoviedb.org/3/person/'.$id.'/combined_credits'.'?api_key=956400813a76a24a25dc1842029b2360');
        $credits = json_decode($request3->getBody());
        // $credits=collect($reponse3->cast)->where('media_type','movie')->sortByDesc('popularity')->take(5)
        // ->map(function($movie){
        //     return collect($movie)->merge([
        //         'poster_path'=> $movie->poster_path
        //         ? 'https://image.tmdb.org/t/p/w185'.$movie->poster_path
        //         : 'http://via.placeholder.com/185x278',
        //         'title' =>isset($movie->title) ? $movie->title :'Untitled'
        //     ]);
        // });
        
        // dump($credits);
        $viewModel = new ActorViewModel($actorDetails,$social,$credits);
        return view('actors.show',$viewModel);
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
