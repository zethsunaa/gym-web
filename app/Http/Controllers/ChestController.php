<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon for current datetime

class ChestController extends Controller
{
    public function read_chest(Request $request){
        $exercises = DB::table("content")
                        ->where('categories', 'chest')
                        ->get();

        return view("chest_manage", compact('exercises'));
    }

    public function insert_chest(Request $request){
    try {
        $request->validate([
            'name_exercise' => 'required|string|max:100',
            'description' => 'required|string', // Changed from deskripsi to description
            // created_date, created_by, updated_date, updated_by will be set by the controller
            'categories' => 'required|string|max:50',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Added gif and max size
        ]);

        // Get the uploaded file
        $file = $request->file('img');
        // Generate a unique filename using timestamp
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Define the target directory within public
        // Ensure this 'chest' directory exists in your 'public' folder
        $tujuan_upload = 'chest';
        
        // Move the uploaded file to the target directory
        $file->move(public_path($tujuan_upload), $filename);

        // Prepare data for database insertion
        $currentDateTime = Carbon::now();
        // You would typically get the authenticated user's ID/name here
        // For demonstration, using a placeholder 'Admin'
        $createdBy = 'Admin'; 

        // Simpan ke database
        DB::table('content')->insert([
            'name_exercise' => $request->name_exercise,
            'description' => $request->description,
            'created_date' => $currentDateTime,
            'created_by' => $createdBy,
            'updated_date' => $currentDateTime, // For initial insert, updated_date is same as created_date
            'updated_by' => $createdBy, // For initial insert, updated_by is same as created_by
            'categories' => $request->categories,
            'img' => $tujuan_upload . '/' . $filename, // Store the full path relative to public
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
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
                'description' => 'required|string', // Changed from deskripsi to description
                'updated_date' => 'required|date',
                'updated_by' => 'required|string|max:50',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Added gif and max size
            ]);

            $data = [
                'name_exercise' => $request->name_exercise,
                'description' => $request->description, // Changed from deskripsi to description
                'updated_date' => $request->updated_date,
                'updated_by' => $request->updated_by,
            ];

            if ($request->hasFile('img')) {
                // Hapus gambar lama
                $old = DB::table('content')->where('id', $request->id)->first();
                if ($old && $old->img && file_exists(public_path($old->img))) {
                    unlink(public_path($old->img));
                }

                // Simpan gambar baru
                $file = $request->file('img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('chest'), $filename);
                $data['img'] = 'chest/' . $filename; // Store the full path relative to public
            }

            DB::table('content')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            \Log::error('Error updating chest exercise: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal update data: '.$e->getMessage());
        }
    }

    public function delete_chest(Request $request){
        try {
            $id = $request->id;

            $record = DB::table('content')->where('id', $id)->first();
            if ($record && $record->img && file_exists(public_path($record->img))) {
                unlink(public_path($record->img));
            }

            DB::table('content')->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Error deleting chest exercise: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus data: '.$e->getMessage());
        }
    }
}