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
    protected string $url;
    protected int $id;

    protected function setUp(): void
    {
        parent::setUp();
        $this->url = 'http://test.com';
        $this->id = DB::table('urls')->insertGetId([
            'name' => $this->url,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
    public function testIndex(): void
    {
        $expected = [
            'url_id'   => $this->id,
            'status_code' => 200,
            'keywords'    => 'keywords test fixture',
            'h1'          => 'Header test fixtures',
            'description' => 'description test fixture',
        ];
        $fixture = file_get_contents(__DIR__ . '/../fixtures/test.html');
        if ($fixture === false) {
            throw new \Exception("Somthing wrong with fixtures");
        }
        HTTP::fake([$this->url => HTTP::response($fixture)]);
        $response = $this->post(route('urls.check', ['id' => $this->id]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
    }
}
