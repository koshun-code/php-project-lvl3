<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Url;
use Illuminate\Support\Arr;

class UrlsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function setUp():void
    {
        parent::setUp();

        Url::factory()->count(2)->make();
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
        $urls = Url::factory()->create();
        $response = $this->get(route('urls.site', [$urls]));
        $response->assertOk();
    }
    public function testStore()
    {
        $urls = Url::factory()->make();
        $response = $this->post(route('urls.store', [$urls]));
        $response->assertRedirect();
    }
}
