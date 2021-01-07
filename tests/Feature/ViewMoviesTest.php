<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewMoviesTest extends TestCase
{
    public function the_main_page_show_correct_info(){
        $response = $this->get(route('moives.index'));
        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
    }
}
