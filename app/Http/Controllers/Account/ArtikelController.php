<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

//load model
use App\Models\Artikel;
use App\Models\Comentar;
use App\Models\Tag;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $artikels = Artikel::all();
        $kategoris = Kategori::all();
        return Inertia::render('Account/Artikel/Index', [
            'artikels' => $artikels,
            'kategoris' => $kategoris,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //validasi
        $request->validate([
            'isi' => ['required'],
            'judul' => ['required'],
            'kategori_id' => ['required'],
            'tumbnail'  => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload image
        $tumbnail = $request->file('tumbnail');
        $tumbnail->storeAs('public/artikel', $tumbnail->hashName());

        //insert ke tabel
        Artikel::create([
            'user_id' => auth()->user()->id,
            'isi' => $request->isi,
            'judul' => $request->judul,
            'slug' => $request['slug'] = Str::slug($request->judul),
            'kategori_id' => $request->kategori_id,
            'tumbnail'  => $tumbnail->hashName(),
        ]);

        //alert and redirect
        return redirect()->back()->with('success', 'Saved successfully');
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
        $artikel = Artikel::findOrFail($id);
        Storage::delete('public/artikel/' . $artikel->tumbnail);
        $artikel->delete();

        //alert and redirect
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    //kategori
    /**
     * Display a listing of the resource.
     */
    public function index_kategori()
    {
        //
        $kategoris = Kategori::all();
        return Inertia::render('Account/Artikel/Kategori/Index', [
            'kategoris' => $kategoris,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store_kategori(Request $request)
    {
        //validasi
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        //insert ke tabel
        Kategori::create([
            'name' => $request->name,
        ]);

        //alert and redirect
        return redirect()->back()->with('success', 'Saved successfully');
    }


    //tag
    /**
     * Display a listing of the resource.
     */
    public function index_tag()
    {
        //
        $tags = Tag::all();
        return Inertia::render('Account/Artikel/Tag/Index', [
            'tags' => $tags,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store_tag(Request $request)
    {
        //validasi
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        //insert ke tabel
        Tag::create([
            'name' => $request->name,
        ]);

        //alert and redirect
        return redirect()->back()->with('success', 'Saved successfully');
    }



    //komentar
    /**
     * Display a listing of the resource.
     */
    public function index_komentar()
    {
        //
        return Inertia::render('Account/Artikel/Komentar/Index');
    }
}
