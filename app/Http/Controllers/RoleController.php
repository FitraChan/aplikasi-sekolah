<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\LogModel;




class RoleController extends Controller
{
    public function index()
    {
        // $users = User::all();
        // $roles = Role::all();

        return view('role.index', [
            // 'users' => $users,
            // 'roles' => $roles,
            'roles' => Role::all(),
            'side'  => 'role',
        ]);
    }

    public function dataRole()
    {
        // Ambil semua data dari tabel roles
        $roles = Role::select('id', 'name')->get()->map(function ($role) {
            return [
                'id'   => $role->id,
                // ucfirst untuk mengubah huruf pertama jadi kapital di tampilan tabel (misal: "admin" jadi "Admin")
                'name' => ucfirst($role->name), 
            ];
        });

        return response()->json($roles);
    }

    public function data()
    {
        $users = User::all()->map(function ($user) {

            $role = $user->getRoleNames()->first() ?? '';

            return [

                'id'    => $user->id,

                'name'  => $user->name,

                'email' => $user->email,

                'role'  => $role,

                
            ];
        });

        return response()->json($users);
    }


    // CREATE ROLE BARU
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create([
            'name' => $request->name
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'roles',
            'aksi' => 'create',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($request->all()),
            'serial' => url('simpan-role')
        ]);

        return response()->json([
            'message' => 'Role berhasil dibuat'
        ]);
    }

   
    public function storeUser(Request $request)
    {
        // Validasi data input user baru
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'  => 'required|exists:roles,name'
        ]);

        // Membuat user baru
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password, // Otomatis ter-hash berkat casts di model
        ]);

        // Memberikan role Spatie ke user baru tersebut
        $user->assignRole($request->role);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'users',
            'aksi' => 'create',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($request->all()),
            'serial' => url('simpan-user')
        ]);

        return response()->json(['message' => 'User baru berhasil ditambahkan!']);
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        // Mengambil nama role pertama yang dimiliki user
        $user->role = $user->getRoleNames()->first();

        // Sekarang objek $user sudah ketambahan properti 'role'
        return response()->json($user);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // 1. Validasi Input (Tambahkan validasi untuk role)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required|string', // Pastikan role wajib diisi
        ]);

        // 2. Update data dasar User
        $user->name = $request->name;
        $user->email = $request->email;

        // Kalau password diisi, baru di-hash dan update
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // 3. Proses Update Role (Pilih salah satu sesuai sistem yang Anda gunakan)

        // Opsi A: Jika Anda menggunakan package Spatie Laravel-Permission (Sangat umum)
        $user->syncRoles($request->role);

        // Opsi B: Jika role disimpan langsung di kolom tabel users (misal kolom 'role')
        // $user->role = $request->role;
        // $user->save();

        // Opsi C: Jika Anda menggunakan relasi manual/tabel pivot biasa (misal belongsToMany)
        // $user->roles()->sync([$request->role]); 


        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'users',
            'aksi' => 'update',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($request->all()),
            'serial' => url('ubah-user/' . $id)
        ]);

        // 4. Kembalikan Response JSON (Wajib untuk AJAX)
        return response()->json([
            'success' => true,
            'message' => 'User dan Role berhasil diperbarui'
        ]);
    }

    public function deleteRole($id)
{
    try {
        // Cari role berdasarkan ID
        $role = Role::findOrFail($id);
        
        // Eksekusi hapus
        $role->delete();

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'roles',
            'aksi' => 'delete',
            'user' => auth()->user()->id,
            'ip' => request()->ip(),
            'keterangan' => json_encode($role),
            'serial' => url('hapus-role/' . $id)
        ]);

        // Kembalikan respon sukses ke AJAX
        return response()->json([
            'success' => true,
            'message' => 'Role berhasil dihapus!'
        ]);
        
    } catch (\Exception $e) {
        // Jika gagal (misal role masih dipakai oleh user lain jika ada restriksi database)
        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus role. Kemungkinan role masih digunakan.'
        ], 500);
    }
}
}
