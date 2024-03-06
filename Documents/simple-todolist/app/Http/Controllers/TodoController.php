<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = auth()->user()->todos()->with(['user', 'category'])->sortByLatest()->get();
        return $todos;
    }

    public function store(Request $request)
    {
        // Validasi permintaan
        $validatedData = $request->validate([
            'body' => ['required', 'string'],
            'category_id' => ['required', 'integer']
        ]);

        // Buat todo untuk pengguna saat ini
        $user = auth()->user(); // Mendapatkan pengguna saat ini
        $todo = $user->todos()->create([
            'body' => $validatedData['body'],
            'category_id' => $validatedData['category_id']
        ])->load('user', 'category'); // Pastikan Anda telah memuat relasi 'user'
        // $todos = $request->user()->todos()->with(['user', 'category'])->sortByLatest()->get();
        // Kembalikan hasilnya
        return $todo;
    }
}
