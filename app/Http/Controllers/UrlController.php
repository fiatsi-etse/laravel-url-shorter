<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Url;
use App\Http\Requests\UrlPostRequest;
use App\Http\Requests\UrlUpdateRequest;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("url.list", ["urls" => Url::paginate(10)]);
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
                'click' => 0,
                'active' => true,
                'expiryAt' => $request->get('expiryAt')
            ]);
        } else {
            Url::create([
                'name' => $request->get('name'),
                'originalUrl' => $request->get('originalUrl'),
                'generatedUrl' => $short,
                'click' => 0,
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
        $url = Url::where('generatedUrl', $link)->where('active', 1)->first();
        if($url) {
            if(env('APP_ENABLE_STAT')) {
                $url->click ++;
                $url->save();
            }
            return redirect($url->originalUrl);
        } else {
            abort(404);
        }
    }
}
