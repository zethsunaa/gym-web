<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShoulderController extends Controller
{
    public function read_shoulder(Request $request){
        $exercises = DB::table("content")
                        ->where('categories', 'shoulder')
                        ->get();

        return view("shoulder_manage", compact('exercises'));
    }

    public function insert_shoulder(Request $request){
    try {
        $request->validate([
            'name_exercise' => 'required|string|max:100',
            'description' => 'required|string',
            'categories' => 'required|string|max:50',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ]);

        $file = $request->file('img');
        $filename = time() . '_' . $file->getClientOriginalName();
        
        $tujuan_upload = 'shoulder'; // Target directory for shoulder images
        $file->move(public_path($tujuan_upload), $filename);

        $currentDateTime = Carbon::now();
        $createdBy = Session::get('user_name'); 

        DB::table('content')->insert([
            'name_exercise' => $request->name_exercise,
            'description' => $request->description,
            'created_date' => $currentDateTime,
            'created_by' => $createdBy,
            'updated_date' => $currentDateTime,
            'updated_by' => $createdBy,
            'categories' => $request->categories,
            'img' => $tujuan_upload . '/' . $filename,
        ]);

        return redirect()->back()->with('success', 'Shoulder exercise added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error inserting shoulder exercise: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors([
                'insert_error' => 'Error: ' . $e->getMessage()
            ]);
        }
    }


    public function update_shoulder(Request $request){
        try {
            $request->validate([
                'id' => 'required|integer',
                'name_exercise' => 'required|string|max:100',
                'description' => 'required|string',
                'updated_by' => 'required|string|max:50',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = [
                'name_exercise' => $request->name_exercise,
                'description' => $request->description,
                'updated_date' => Carbon::now(),
                'updated_by' => $request->updated_by,
            ];

            if ($request->hasFile('img')) {
                $old = DB::table('content')->where('id', $request->id)->first();
                if ($old && $old->img && file_exists(public_path($old->img))) {
                    unlink(public_path($old->img));
                }

                $file = $request->file('img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('shoulder'), $filename); // Move to 'shoulder' directory
                $data['img'] = 'shoulder/' . $filename;
            }

            DB::table('content')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Shoulder exercise updated successfully!');
        } catch (\Exception | \Illuminate\Database\QueryException $e) { // Catch QueryException specifically
            \Log::error('Error updating shoulder exercise: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update shoulder exercise: '.$e->getMessage());
        }
    }

    public function delete_shoulder(Request $request){
        try {
            $id = $request->id;

            $record = DB::table('content')->where('id', $id)->first();
            if ($record && $record->img && file_exists(public_path($record->img))) {
                unlink(public_path($record->img));
            }

            DB::table('content')->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Shoulder exercise deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting shoulder exercise: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete shoulder exercise: '.$e->getMessage());
        }
    }
}