<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Url;
use App\Http\Requests\UrlPostRequest;

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
        $validated = $request->validated();
        $short = substr(md5($request->url . time()), 0, 6);
    
        Url::create([
            'name' => $request->get('name'),
            'originalUrl' => $request->get('originalUrl'),
            'generatedUrl' => config('app.url'). '/'. $short,
            'click' => 0,
            'active' => true,
        ]);
        return redirect()->route('url.list')->with('status', 'Lien court ajouté avec succès!');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
