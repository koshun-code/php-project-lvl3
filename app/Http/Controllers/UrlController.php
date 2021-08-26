<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Database\Migrations\Migration;

class UrlController extends Controller
{
    public function store(Request $request)
    {
         $validate = $request->validate([
             'url.name' => 'required|max:255',
         ]);
        $url = $this->normalizeUrl($request);
        if ($validate) {
            $url = $this->normalizeUrl($request);
            $updated_at = Carbon::now('Europe/Moscow');
            $created_at = Carbon::now('Europe/Moscow');
            if ($this->isUniqueUrl($url)) {
                DB::insert('insert into urls (name, updated_at, created_at) values (?, ?, ?)', [$url, $updated_at, $created_at]);
                return redirect()->route('urls.show')->with('success', 'Link added successfully!');
            } else {
                return back()->with('error', 'Такая ссылка уже есть');
            }
        }
    }
    /**
     * @request - implements of request
     * return string
     */
    private function normalizeUrl(Request $request):string
    {
        ['scheme' => $scheme, 'host' => $host] = parse_url($request->input('url')['name']);
        return "{$scheme}://{$host}";
    }
    /**
     * Cheak url to unique in db
     */
    private function isUniqueUrl($url)
    {
        $urls = DB::table('urls')
        ->select('name')
        ->get();

        foreach($urls as $dbUrl) {
            if ($dbUrl->name === $url) {
                return false;
            }
        }
        return true;
    }
    /**
     * 
     */
    public function show()
    {
        $urls = DB::select('select * from urls');
        return view('chanks.show', ['urls' => $urls]);
    }
    /**
     * 
     */
    public function site($id)
    {
        [$url] = DB::select('select * from urls where id = ?', [$id]);
        $checkedUrl = DB::select('select * from url_checks where url_id = ?', [$id]);// проблема в том, что нет такого id
        //dd($checkedUrl);
        return view('chanks.site', compact('url', 'checkedUrl'));
    }
}
