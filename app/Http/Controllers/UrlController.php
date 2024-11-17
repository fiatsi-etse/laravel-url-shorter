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
        return view("url.list", ["urls" => Url::with(['clicks', 'user'])->paginate(10)]);
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
                'original_url' => $request->get('original_url'),
                'generated_url' => $short,
                'active' => true,
                'expiry_at' => $request->get('expiry_at'),
                'user_id' => $request->user()->id
            ]);
        } else {
            Url::create([
                'name' => $request->get('name'),
                'original_url' => $request->get('original_url'),
                'generated_url' => $short,
                'active' => true,
                'user_id' => $request->user()->id
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
                'original_url' => $request->get('original_url'),
                'generated_url' => $request->get('generated_url'),
                'active' => $request->get('active'),
                'expiry_at' => $request->get('expiry_at')
            ]);
        } else {
            $url->update([
                'name' => $request->get('name'),
                'original_url' => $request->get('original_url'),
                'generated_url' => $request->get('generated_url'),
                'active' => $request->get('active'),
                'expiry_at' => null
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
        $url = Url::where('generated_url', $link)->where('active', 1)->first();


        if($url) {

            if(env('APP_ENABLE_STAT')) {
                Click::create([
                    'url_id' => $url->id,
                    'userAgent' => $request->userAgent(),
                    'ip' => $request->ip(),
                ]);
            }
            
            if($url->expiry_at!=null) {
                $today = Carbon::today(); // La date actuelle sans heure
                $dateToCheck = Carbon::createFromFormat('Y-m-d', $url->expiry_at);
                if ($today->greaterThan($dateToCheck)) {
                    abort(404);
                }
            }
            
            return redirect($url->original_url);
        } else {
            abort(404);
        }
    }
}
