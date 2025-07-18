<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ShoulderViewController extends Controller
{
    public function index()
    {
        $exercises = DB::table('content')
                        ->where('categories', 'shoulder')
                        ->get();

        return view('shoulder_content', compact('exercises'));
    }
}