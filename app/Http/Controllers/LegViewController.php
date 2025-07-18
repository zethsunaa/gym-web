<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LegViewController extends Controller
{
    public function index()
    {
        $exercises = DB::table('content')
                        ->where('categories', 'leg')
                        ->get();

        return view('leg_content', compact('exercises'));
    }
}