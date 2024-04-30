<?php

namespace App\Http\Controllers;

//import model
use App\Models\jadwal;
use App\Models\User;
use Carbon\Carbon;
//return view
use Illuminate\View\View;

//redirect
use Illuminate\Http\RedirectResponse;
//request
use Illuminate\Http\Request;
//auth login
use Illuminate\Support\Facades\Auth;
//encrypt password
use Illuminate\Support\Facades\Hash;
//session
use Illuminate\Support\Facades\Session;
//database
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;

class jadwalController extends Controller
{
    public function index(): View
    {
        //tabel jadwal berdasarkan id_user
        $jadwals = jadwal::where('id_user', session('user.id'))->get();

        return view('jadwal.index', compact('jadwals'));
    }

    public function store(Request $request): RedirectResponse
    {
        //Checking Request
        // dd($request->all());

        $this->validate($request, [
            'judul' => 'required',
            'start' => 'required',
            'end' => 'required',
            'id_user' => 'required'
        ]);

        jadwal::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'start' => $request->start,
            'end' => $request->end,
            'id_user' => $request->id_user
        ]);

        return redirect()->route('jadwal.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function edit(string $id): View
    {
        $jadwal = jadwal::findOrFail($id);

        return view('jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate
        $this->validate($request, [
            'judul' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);
        //get ID
        $jadwal = jadwal::findOrFail($id);
        //update
        $jadwal->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'start' => $request->start,
            'end' => $request->end
        ]);
        //return
        return redirect()->route('jadwal.index')->with(['success' => 'Data Telah Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        // find id jadwal
        $jadwal = jadwal::findOrFail($id);
        //delete
        $jadwal->delete();
        // return view
        return redirect()->route('jadwal.index')->with(['success' => 'Data Berhasil Dihapus!!!']);
    }

    //Autentikasi User
    function login(): View
    {
        return view('login');
    }

    function register(): View
    {
        return view('register');
    }

    function loginPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            session(['user' => Auth::user()]);
            if (session('user.role') == 1) {
                return redirect()->intended(route('admin.index'))->with(['success' => 'Login Berhasil!']);
            } else {
                //mengambil deadline tugas terdekat dari database
                $nearestDeadline = jadwal::where('id_user', session('user.id'))
                    ->whereDate('end', '>=', now())
                    ->orderBy('end', 'asc')
                    ->first();
                if ($nearestDeadline) {
                    return redirect()->intended(route('jadwal.index', compact('nearestDeadline')))->with(['warning' => "Deadline tugas terdekat: $nearestDeadline->judul. Tanggal: $nearestDeadline->end"]);
                }
                return redirect()->intended(route('jadwal.index'))->with(['success' => 'Login Berhasil!']);
            }
        }
        return redirect()->route('login')->with(['error' => 'Login Gagal, Informasi yang Anda Masukkan Salah']);
    }

    function registerPost(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if (!$user) {
            return redirect()->route('register')->with(['error' => 'Register Gagal, Silahkan Coba Lagi']);
        }

        return redirect()->route('login')->with(['success' => 'Register Berhasil, Silahkan Login Terlebih Dahulu']);
    }

    function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login')->with(['warning' => 'Anda Telah Log Out!']);
    }

    public function test(): View
    {
        return view('test');
    }

    //admin
    public function viewAdmin(): View
    {
        $jadwals = DB::select('select * from jadwals_admin');

        return view('admin.index', compact('jadwals'));
    }
}
