<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use DiDom\Query;

class UrlCheckController extends Controller
{
    public function index($id)
    {
        [$url] = DB::select("select * from urls where id = :id", ['id' => $id]);
        $updated_at = Carbon::now('Europe/Moscow');
        $urlId = $url->id;
        $created_at = $url->created_at;
        [$h1, $keywords, $description] = $this->getMetaData($url->name);
        $status = $this->getStatuseCode($url->name);
        DB::insert('insert into url_checks (url_id, status_code, h1, keywords, description, updated_at, created_at) 
        values (?, ?, ?, ?, ?, ?, ?)', [$urlId, $status, $h1, $keywords, $description, $updated_at, $created_at]);
        DB::update('update urls set updated_at=:updated_at where id=:id', [$updated_at, $urlId]);
        return redirect()->route('urls.site', $urlId);
    }
    private function getStatuseCode($url)
    {
        $response = HTTP::get($url);
        return $response->status();
    }
    private function getMetaData($url)
    {
        $response = HTTP::get($url);
        $document = new Document($response->body());
        $h1 = optional($document->first('h1'))->text();
        $keywords = optional($document->first('meta[name=keywords]'))->getAttribute('content');
        if ($keywords === null) {
            optional($document->first('meta[name=Keywords]'))->getAttribute('content');
        }
        $description = optional($document->first('meta[name=description]'))->getAttribute('content');
        if ($description === null) {
            optional($document->first('meta[name=Description]'))->getAttribute('content');
        }
        return [$h1, $keywords, $description];
    }
}
