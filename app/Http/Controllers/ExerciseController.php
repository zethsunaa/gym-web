<?php
namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function show($categories, $id)
{
    $exercise = \App\Models\Content::where('id', $id)
        ->where('categories', $categories)
        ->firstOrFail();

    return view('exercises.show', compact('exercise'));
}
}