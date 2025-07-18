<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;

class LoginController extends Controller{
    public function index(){
        return view("login");
    }

    public function home(Request $request){
        return view("/index");
    }

    public function process_login(Request $request)
{
    $username = $request->input("username");
    $password = $request->input("password");

    $process = DB::table("user")
                ->where("username", $username)
                ->where("password", $password) // ⚠️ sebaiknya gunakan hash
                ->first();

    if ($process) {
        // Simpan nama dan id ke session
        Session::put('user_name', $process->nama); // pastikan kolom 'name' ada di tabel
        return redirect('/admin_dashboard');
    } else {
        return redirect('/login')->with('error', 'Login gagal. Cek username atau password.');
    }
}
    public function process_logout(){
        Session::flush(); // hapus semua session
        return redirect()->action([LoginController::class, 'index']);
    }

}