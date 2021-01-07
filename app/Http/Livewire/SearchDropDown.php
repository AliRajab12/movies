<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
 

class SearchDropDown extends Component
{
    public $search = '';
    public function render()
    {   
        $searchResults=[];
        if(strlen($this->search) > 2){
            $client = new Client();
            $request = $client->request('GET','https://api.themoviedb.org/3/search/movie?api_key=956400813a76a24a25dc1842029b2360&query='.$this->search);
            $response = json_decode($request->getBody());
            $searchResults=$response->results;
        }
        
        // dump($searchResults);
        return view('livewire.search-drop-down',[
            'searchResults'=>collect($searchResults)->take(7),
        ]);
    }
}
