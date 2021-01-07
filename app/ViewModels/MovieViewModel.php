<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{   
    public $movieDetails;
    public function __construct($movieDetails)
    {
        $this->movieDetails= $movieDetails;
        
    }
    public function movie(){
        // return collect($this->movieDetails)->merge([
        //     'poster_path'=>'https://image.tmdb.org/t/p/w500/'.$this->movieDetails->poster_path,
        //     'vote_average'=> $this->movieDetails->vote_average *10 .'%',
        //     'release_date' => \Carbon\Carbon::parse($this->movieDetails->release_date)->format('M d, Y'),
        //      'genres' => collect($this->movieDetails->genres)->pluck('name')->flatten()->implode(', '),
        //      'crew' => collect($this->movieDetails->credits->crew)->take(2),
        //      'cast' =>collect($this->movieDetails->credits->cast)->take(5),
        //      'images' => collect($this->movieDetails->images->backdrops)->take(9)
        // ])->only([
            // 'poster_path' , 'id' ,'genre_ids' , 'title' ,'vote_average' , 'overview',
            // 'release_date' , 'credits' , 'videos' , 'images' ,'crew' ,'cast' , 'images'
        // ]);
    }
}
