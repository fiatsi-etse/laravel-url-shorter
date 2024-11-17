<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Click;
use App\Models\Url;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUrls = Url::count();

        $mostVisitedUrl = Url::withCount('clicks')
            ->orderBy('clicks_count', 'desc')
            ->first();

        $userWithMostUrls = User::withCount('urls')
            ->orderBy('urls_count', 'desc')
            ->first();

        return view('home', ['totalUrls' => $totalUrls, 'mostVisitedUrl' => $mostVisitedUrl, 'userWithMostUrls' => $userWithMostUrls]);
    }
}
