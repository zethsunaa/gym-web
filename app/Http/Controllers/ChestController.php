<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon for current datetime

class ChestController extends Controller
{
    public function read_chest(Request $request){
        $exercises = DB::table("content")
                        ->where('categories', 'chest') // Filter by 'chest' category
                        ->get();

        return view("chest_manage", compact('exercises'));
    }

    public function insert_chest(Request $request){
    try {
        $request->validate([
            'name_exercise' => 'required|string|max:100',
            'description' => 'required|string',
            'categories' => 'required|string|max:50',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ]);

        $file = $request->file('img');
        $filename = time() . '_' . $file->getClientOriginalName();
        
        $tujuan_upload = 'chest'; // Target directory for chest images
        $file->move(public_path($tujuan_upload), $filename);

        $currentDateTime = Carbon::now();
        $createdBy = 'Admin'; // Replace with actual authenticated user or Auth::user()->name;

        DB::table('content')->insert([
            'name_exercise' => $request->name_exercise,
            'description' => $request->description,
            'created_date' => $currentDateTime,
            'created_by' => $createdBy,
            'updated_date' => $currentDateTime,
            'updated_by' => $createdBy,
            'categories' => $request->categories,
            'img' => $tujuan_upload . '/' . $filename, // Store full path relative to public
        ]);

        return redirect()->back()->with('success', 'Chest exercise added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error inserting chest exercise: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors([
                'insert_error' => 'Error: ' . $e->getMessage()
            ]);
        }
    }


    public function update_chest(Request $request){
        try {
            $request->validate([
                'id' => 'required|integer',
                'name_exercise' => 'required|string|max:100',
                'description' => 'required|string',
                // updated_date will be set dynamically
                'updated_by' => 'required|string|max:50',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = [
                'name_exercise' => $request->name_exercise,
                'description' => $request->description,
                'updated_date' => Carbon::now(), // Update timestamp
                'updated_by' => $request->updated_by,
            ];

            if ($request->hasFile('img')) {
                $old = DB::table('content')->where('id', $request->id)->first();
                if ($old && $old->img && file_exists(public_path($old->img))) {
                    unlink(public_path($old->img));
                }

                $file = $request->file('img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('chest'), $filename); // Move to 'chest' directory
                $data['img'] = 'chest/' . $filename; // Store full path relative to public
            }

            DB::table('content')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Chest exercise updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating chest exercise: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update chest exercise: '.$e->getMessage());
        }
    }

    public function delete_chest(Request $request){
        try {
            $id = $request->id;

            $record = DB::table('content')->where('id', $id)->first();
            // Delete image from public/chest directory if it exists
            if ($record && $record->img && file_exists(public_path($record->img))) {
                unlink(public_path($record->img));
            }

            DB::table('content')->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Chest exercise deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting chest exercise: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete chest exercise: '.$e->getMessage());
        }
    }
}   