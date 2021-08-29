<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;

class UrlsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $url;
    private $id;

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
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testIndex()
    {
        $response = $this->get(route('chanks.index'));
        $response->assertOk();
    }
    public function testShow()
    {
        $response = $this->get(route('urls.show'));
        $response->assertOk();
    }
    public function testSite()
    {
        $response = $this->get(route('urls.site', $this->id));
        $response->assertOk();
    }
    public function testStore()
    {
        $urlData = ['url[name]' => 'https://hexlet.io'];
        $response = $this->post(route('urls.store', $urlData));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
    }
    public function testStoreEmpty()
    {
        $urlData = ['url[name]'=>''];
        $response = $this->post(route('urls.store', $urlData));
        $this->assertDatabaseMissing('urls', $urlData);
        $response->assertRedirect();
    }
   /* public function testStoreExistLink()
    {
        $curUrl = 'http://test.com';
        $response = $this->post(route('urls.store', $curUrl));
        //dd($response);
        //$response->assertSessionHasErrors();
        $response->assertRedirect();
        
    }
    public function testToLong()
    {
        $urlData = str_repeat('domain', 50);
        $url = "http://{$urlData}.com";
        $response = $this->post(route('urls.store', $url));
        $response->assertSessionHasErrors(['name']);
        $response->assertRedirect();
    }*/
}
