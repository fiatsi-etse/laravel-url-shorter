<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Url;
use App\Models\Click;
use App\Http\Requests\UrlPostRequest;
use App\Http\Requests\UrlUpdateRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("url.list", ["urls" => Url::with('clicks')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("url.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrlPostRequest $request)
    {
        // dd($request);
        $validated = $request->validated();
        $short = substr(md5($request->url . time()), 0, 6);

        if($request->get('addExpiry') == "1") {
            Url::create([
                'name' => $request->get('name'),
                'originalUrl' => $request->get('originalUrl'),
                'generatedUrl' => $short,
                'active' => true,
                'expiryAt' => $request->get('expiryAt')
            ]);
        } else {
            Url::create([
                'name' => $request->get('name'),
                'originalUrl' => $request->get('originalUrl'),
                'generatedUrl' => $short,
                'active' => true,
            ]);
        }
        return redirect()->route('urls.list')->with('status', 'Lien court ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UrlUpdateRequest $request, string $id)
    {
        // dd($request->all());
        $validated = $request->validated();
        $url = Url::findOrFail($request->url_id);

        if($request->get('addExpiry') == "1") {
            $url->update([
                'name' => $request->get('name'),
                'originalUrl' => $request->get('originalUrl'),
                'generatedUrl' => $request->get('generatedUrl'),
                'active' => $request->get('active'),
                'expiryAt' => $request->get('expiryAt')
            ]);
        } else {
            $url->update([
                'name' => $request->get('name'),
                'originalUrl' => $request->get('originalUrl'),
                'generatedUrl' => $request->get('generatedUrl'),
                'active' => $request->get('active'),
                'expiryAt' => null
            ]);
        }
        return redirect()->route('urls.list')->with('status', 'Lien court modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function visit(Request $request, string $link)
    {
        // dd($request);
        $url = Url::where('generatedUrl', $link)->where('active', 1)->first();


        if($url) {

            if(env('APP_ENABLE_STAT')) {
                Click::create([
                    'urlId' => $url->id,
                    'userAgent' => $request->userAgent(),
                    'ip' => $request->ip(),
                ]);
            }
            
            if($url->expiryAt!=null) {
                $today = Carbon::today(); // La date actuelle sans heure
                $dateToCheck = Carbon::createFromFormat('Y-m-d', $url->expiryAt);
                if ($today->greaterThan($dateToCheck)) {
                    abort(404);
                }
            }
            
            return redirect($url->originalUrl);
        } else {
            abort(404);
        }
    }
}
