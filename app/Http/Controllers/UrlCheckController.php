<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlCheckController extends Controller
{
    public function index($id)
    {
        [$url] = DB::select("select * from urls where id = :id", ['id' => $id]);
        $updated_at = Carbon::now('Europe/Moscow');
        $urlId = $url->id;
        $created_at = $url->created_at;
        DB::insert('insert into url_checks (url_id, updated_at, created_at) values (?, ?, ?)', [$urlId, $updated_at, $created_at]);
        DB::update('update urls set updated_at=:updated_at where id=:id', [$updated_at, $urlId]);
        return redirect()->route('urls.site', $urlId);
    }
}
