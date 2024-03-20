<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
// use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        $artikels = Artikel::with('kategori')->where('publish', 'Y')->get();
        return Inertia::render('Welcome', [
            'artikels' => $artikels,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)->first();
        return Inertia::render('ArtikelDetail', [
            'artikel' => $artikel,
        ]);
    }
}
