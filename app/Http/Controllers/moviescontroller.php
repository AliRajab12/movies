<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use GuzzleHttp\Client;
class moviescontroller extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $client = new Client();
        $request = $client->request('GET','https://api.themoviedb.org/3/movie/popular?api_key=956400813a76a24a25dc1842029b2360');
        // ,[
        //     'headers' => [
        //         'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5NTY0MDA4MTNhNzZhMjRhMjVkYzE4NDIwMjliMjM2MCIsInN1YiI6IjVlYjE1YzE4YmYwZjYzMDAxZjdmMTYxNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.0tkRvu3Ef3oBNDK8RE9bhT-KowE4Ab_Ul7-a9XBP0po' ,
        //         'Accept' => 'application/json',
        //     ]
        // ]
    // );
        $request2= $client->request('GET','https://api.themoviedb.org/3/genre/movie/list?api_key=956400813a76a24a25dc1842029b2360');
        $response1 = json_decode($request->getBody());
        $popularMovies= $response1->results;
        $response2 =json_decode($request2->getBody());
        $genersArray= $response2->genres;
        $genres= collect($genersArray)->mapWithKeys(function ($genre){
            return [ $genre->id => $genre->name];
        });
        $request3 = $client->request('GET','https://api.themoviedb.org/3/movie/now_playing?api_key=956400813a76a24a25dc1842029b2360');
        $response3= json_decode($request3->getBody());
        $nowPlayingMovies= $response3->results;
        // dump($nowPlayingMovies);
        // $popularMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json()['results'];
        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres
        );
        return view('movies.index',$viewModel);
        // return view('index',[
        //     'popularMovies'=> $popularMovies,
        //     'nowPlayingMovies'=>$nowPlayingMovies,
        //     'genres' => $genres,
        // ]);
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
        $request = $client->request('GET','https://api.themoviedb.org/3/movie/'.$id.'?api_key=956400813a76a24a25dc1842029b2360&append_to_response=credits,videos,images');
        $movieDetails = json_decode($request->getBody());
        // dump($movieDetails);
        $viewModel = new MovieViewModel($movieDetails);
        return view('movies.show',$viewModel);
        // return view('show',[
        //     'movieDetails'=>$movieDetails,
        // ]);
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
