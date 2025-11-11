<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori; // <-- Import model

class KategoriController extends Controller
{
    /**
     * Mengembalikan semua kategori.
     */
    public function index()
    {
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        return response()->json($kategoris);
    }
}