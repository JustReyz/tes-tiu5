<?php

namespace App\Http\Controllers; // Pastikan namespace ini sesuai

use Illuminate\Http\Request;
use App\Models\Soal;

class TestController extends Controller
{
    public function showTestPage()
    {

        return view('test.start-test');
    }

    public function getQuestion($questionIndex)
    {
      
    }

    public function submitTest(Request $request)
    {
       
    }





}
