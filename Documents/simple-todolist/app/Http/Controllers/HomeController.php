<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $token = auth()->user()->token; // ambil data token di tabel token
        // if(auth()->user()->token->hasExpired()) {
        //     dd(true);
        // }
        if (!$token) {
            // dd($token);
            $todos = auth()->user()->todos ?? null;
            if (!$todos) {
                return view('home', ['todos' => false]);
            }
            return view('home', ['todos' => $todos]);
        }
    }
}
