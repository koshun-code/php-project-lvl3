<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'url.name' => 'required|max:255',
        ]);
        if ($validate) {
            ['scheme' => $scheme, 'host' => $host] = parse_url($request->input('url')['name']);
            $url = "{$scheme}://{$host}";
        }
        //dump($url);
    }
    public function show()
    {
        $urls = DB::select('select * from urls');
        return view('chanks.show', ['urls' => $urls]);
    }
    public function site($id)
    {
        $url = DB::select('select * from urls where id = ?', [$id]);
        return view('chanks.site', ['url' => $url]);
       //dump($url);
    }
}
