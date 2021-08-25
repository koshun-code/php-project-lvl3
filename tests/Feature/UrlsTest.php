<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UrlsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $urls;

    protected function setUp():void
    {
        parent::setUp();
        $this->urls = Url::factory()->create();

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
        $response = $this->get(route('urls.site', $this->urls['id']));
        $response->assertOk();
    }
    public function testStore()
    {
        $urlData = ['url[name]'=>$this->urls['name']];
        $response = $this->post(route('urls.store', $urlData));
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }
    public function testStoreEmpty()
    {
        $urlData = ['url[name]'=>''];
        $response = $this->post(route('urls.store', $urlData));
        $response->assertRedirect();
        $response->assertSessionHasErrors();
    }
    public function testStoreExistLink()
    {
        $url = DB::table('urls')->insertGetId([
            'name' => 'http://test.com',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        $curUrl = 'http://test.com';
        $response = $this->post(route('urls.store', $curUrl));
        //dd($response);
        $response->assertSessionHasErrors();
        $response->assertRedirect();
        
    }
    public function testToLong()
    {
        $urlData = str_repeat('domain', 50);
        $url = "http://{$urlData}.com";
        $response = $this->post(route('urls.store', $url));
        $response->assertSessionHasErrors();
        $response->assertRedirect();
    }
}
