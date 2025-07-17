<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // Import DB facade

class ChestViewController extends Controller
{
    /**
     * Menampilkan daftar latihan dada untuk pengguna.
     *
     * @return \Illuminate\View\View
     */
    
    public function index()
    {
        // Mengambil semua data dari tabel 'content' dengan kategori 'chest'
        $exercises = DB::table('content')
                        ->where('categories', 'chest')
                        ->get();

        // Mengirimkan data 'exercises' ke view 'chest'
        return view('chest_content', compact('exercises'));
    }

    // Anda bisa menambahkan metode lain di sini jika diperlukan,
    // misalnya untuk menampilkan detail satu latihan.
    // public function show($id)
    // {
    //     $exercise = DB::table('content')->where('id', $id)->first();
    //     return view('chest_detail', compact('exercise'));
    // }
}