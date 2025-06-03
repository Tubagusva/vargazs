<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SaveController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // atau auth()->user();
        $savedPosts = $user->savedPosts()->get(); // ini harus nyambung ke method di model User

        return view('saved.index', compact('savedPosts'));
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $savedPosts = $user->savedPosts;

        return view('saved', compact('savedPosts'));
    }
}
