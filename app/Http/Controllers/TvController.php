<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();

        $request = $client->request('GET','https://api.themoviedb.org/3/tv/popular?api_key=956400813a76a24a25dc1842029b2360');
        $response1 = json_decode($request->getBody());
        $popularTv= $response1->results;
        $request2= $client->request('GET','https://api.themoviedb.org/3/genre/tv/list?api_key=956400813a76a24a25dc1842029b2360');
        $response2 =json_decode($request2->getBody());
        $genres= $response2->genres;    
        // $genres= collect($genersArray)->mapWithKeys(function ($genre){
        //     return [ $genre->id => $genre->name];
        // });

        $request3 = $client->request('GET','https://api.themoviedb.org/3/tv/top_rated?api_key=956400813a76a24a25dc1842029b2360');
        $response3= json_decode($request3->getBody());
        $topRatedTv= $response3->results;

        $viewModel = new TvViewModel(
            $popularTv,
            $genres,
            $topRatedTv
        );
        return view('tv.index',$viewModel);
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
        $request = $client->request('GET','https://api.themoviedb.org/3/tv/'.$id.'?api_key=956400813a76a24a25dc1842029b2360&append_to_response=credits,videos,images');
        $tvDetails = json_decode($request->getBody());
        // dump($movieDetails);
        $viewModel = new TvShowViewModel($tvDetails);
        return view('tv.show',$viewModel);
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
