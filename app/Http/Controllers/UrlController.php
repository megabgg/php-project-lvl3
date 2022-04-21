<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UrlRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Ramsey\Uuid\Type\Integer;

class UrlController extends Controller
{
    public function index()
    {
        $urls = DB::table('urls')
            ->select(
                'urls.id',
                'urls.name as name',
                'url_checks.created_at as created_at',
                'url_checks.status_code as status_code',
            )
            ->distinct('urls.id')
            ->leftJoin('url_checks', 'url_checks.url_id', '=', 'urls.id')
            ->orderBy('urls.id')
            ->orderBy('url_checks.created_at', 'desc')
            ->simplePaginate(10);


        return view('urls.index', compact('urls'));
    }

    public function create()
    {
        return view('urls.create');
    }

    public function store(UrlRequest $request)
    {
        $data = $request->validated();
        $urlRaw = $data['url']['name'];
        $scheme = parse_url($urlRaw, PHP_URL_SCHEME);
        $host = parse_url($urlRaw, PHP_URL_HOST);
        $url = "$scheme://$host";

        if (DB::table('urls')->where('name', $url)->exists()) {
            flash("Страница уже существует");
            /**
             * @var int $urlId
             */
            $urlId = DB::table('urls')->where('name', $url)->first()->id;
        } else {
            $data = [
                'name' => $url,
                'created_at' => Carbon::now()
            ];

            $urlId = DB::table('urls')->insertGetId($data);
            flash("Страница успешно добавлена")->success();
        }

        return redirect()->route('urls.show', ['id' => $urlId]);
    }

    public function show(int $id)
    {
        $url = DB::table('urls')->find($id);
        abort_unless($url, 404);

        $checks = DB::table('url_checks')
            ->where('url_id', $id)
            ->orderBy('id', 'desc')
            ->simplePaginate(10);
        return view('urls.show', compact('url', 'checks'));
    }
}
