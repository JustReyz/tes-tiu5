<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Result;
use App\Models\UserAnswer;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('result')->where('role', 'user')->get();
        return view('admin', compact('users'));
    }

    public function viewResult(User $user)
    {
        $answers = UserAnswer::with('question')->where('user_id', $user->id)->get();
        return view('result-user', compact('user', 'answers'));
    }

    public function deleteResult(User $user)
    {
        $user->result()->delete();
        $user->answers()->delete();
        return redirect()->route('admin.results')->with('success', 'Hasil user berhasil dihapus.');
    }
}
