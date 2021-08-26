<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class UrlChecksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $url;
    protected $id;

    protected function setUp():void
    {
        parent::setUp();
        $this->url = 'http://test.com';
        $this->id = DB::table('urls')->insertGetId([
            'name' => $this->url,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

    }
    public function testIndex()
    {
        HTTP::fake([$this->url => HTTP::response()]);
        $response = $this->post(route('urls.check', ['id' => $this->id]));
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }
}
