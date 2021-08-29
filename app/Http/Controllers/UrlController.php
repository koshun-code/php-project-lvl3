<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Database\Migrations\Migration;

class UrlController extends Controller
{
    public function store(Request $request)
    {
        $inputUrl = $request->input('url');
        $validator =  Validator::make($inputUrl, [
            'name' => 'required|max:255',
        ]);
        /*
         $validate = $request->validate([
             'name' => 'required|url|max:255',
         ]);*/
        if ($validator->fails()) {
            flash('Некоректный Url')->error();
            return back()->withErrors($validator);
        }
 
        $url = $this->normalizeUrl($request);
        $updated_at = Carbon::now('Europe/Moscow');
        $created_at = Carbon::now('Europe/Moscow');

        if ($this->isUniqueUrl($url)) {
                DB::insert('insert into urls (name, updated_at, created_at) values (?, ?, ?)', [$url, $updated_at, $created_at]);
                flash('Ссылка добавлена!')->success();
                return redirect()->route('urls.show');
        } else {
                flash('Такая ссылка уже есть')->warning();
                return back()->withErrors($validator);
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

        foreach ($urls as $dbUrl) {
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
        $urls = DB::table('urls')->distinct('urls.id')->leftJoin('url_checks', 'urls.id', '=', 'url_checks.url_id')
        ->select('urls.id as id', 'name', 'url_checks.status_code as status_code', 'urls.updated_at as updated_at')
        ->orderBy('id', 'asc')->paginate(15);
        return view('chanks.show', compact('urls'));
    }
    /**
     * 
     */
    public function site($id)
    {
        [$url] = DB::select('select * from urls where id = ?', [$id]);
        $checkedUrl = DB::select('select * from url_checks where url_id = ?', [$id]);
        return view('chanks.site', compact('url', 'checkedUrl'));
    }
}
