<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BackViewController extends Controller
{
    public function index()
    {
        $exercises = DB::table('content')
                        ->where('categories', 'back')
                        ->get();

        return view('back_content', compact('exercises'));
    }
}