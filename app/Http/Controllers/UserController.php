<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // Mengembalikan semua data pengguna dalam format JSON
        return response()->json(User::all());
    }

    public function show($id)
    {
        // Mencari pengguna berdasarkan ID
        $user = User::find($id);

        // Jika pengguna tidak ditemukan, kembalikan respons 404
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        
        // Kembalikan data pengguna dalam format JSON
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        // Mencari pengguna berdasarkan ID
        $user = User::find($id);

        // Jika pengguna tidak ditemukan, kembalikan respons 404
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Validasi data yang diinput
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6|confirmed',
        ]);

        // Jika validasi gagal, kembalikan pesan kesalahan
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Perbarui data pengguna
        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->all());

        // Kembalikan data pengguna yang diperbarui dalam format JSON
        return response()->json($user);
    }

    public function destroy($id)
    {
        // Mencari pengguna berdasarkan ID
        $user = User::find($id);

        // Jika pengguna tidak ditemukan, kembalikan respons 404
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Hapus pengguna
        $user->delete();

        // Kembalikan pesan sukses
        return response()->json(['message' => 'User deleted successfully']);
    }
}
