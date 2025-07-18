<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BackController extends Controller
{
    public function read_back(Request $request){
        $exercises = DB::table("content")
                        ->where('categories', 'back')
                        ->get();

        return view("back_manage", compact('exercises'));
    }

    public function insert_back(Request $request){
    try {
        $request->validate([
            'name_exercise' => 'required|string|max:100',
            'description' => 'required|string',
            'categories' => 'required|string|max:50',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ]);

        $file = $request->file('img');
        $filename = time() . '_' . $file->getClientOriginalName();
        
        $tujuan_upload = 'back'; // Target directory for back images
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

        return redirect()->back()->with('success', 'Back exercise added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error inserting back exercise: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors([
                'insert_error' => 'Error: ' . $e->getMessage()
            ]);
        }
    }


    public function update_back(Request $request){
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
                $file->move(public_path('back'), $filename); // Move to 'back' directory
                $data['img'] = 'back/' . $filename;
            }

            DB::table('content')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Back exercise updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating back exercise: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update back exercise: '.$e->getMessage());
        }
    }

    public function delete_back(Request $request){
        try {
            $id = $request->id;

            $record = DB::table('content')->where('id', $id)->first();
            if ($record && $record->img && file_exists(public_path($record->img))) {
                unlink(public_path($record->img));
            }

            DB::table('content')->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Back exercise deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting back exercise: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete back exercise: '.$e->getMessage());
        }
    }
}