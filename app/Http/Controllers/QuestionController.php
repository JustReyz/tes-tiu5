<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function showTutorial()
    {
        $userId = auth()->id();

        $sudahTes = Result::where('user_id', $userId)->exists();
        if ($sudahTes) {
               return view('test.already-submitted');
        }


        $dummyQuestion = (object)[
            'id' => 999,
            'image' => 'soal5.png',
        ];

        return view('test.tutorial', ['dummy' => $dummyQuestion]);
    }


    public function submitTutorial(Request $request)
    {
        $userAnswer = $request->input('dummy_answer');
        $correctAnswer = 5;

        if ($userAnswer != $correctAnswer) {
            return redirect()
                ->route('test.tutor')
                ->with([
                    'userAnswer' => $userAnswer,
                    'correctAnswer' => $correctAnswer,
                    'showFeedback' => true
                ]);
        }


        return redirect()->route('test.start');
    }


    public function index()
    {
        $userId = auth()->id();


        $hasSubmitted = Result::where('user_id', $userId)->exists();
        if ($hasSubmitted) {
            return redirect()->route('test.result')->with('warning', 'Kamu sudah menyelesaikan tes.');
        }

        
        $questions = Question::orderBy('id')->get();
        $totalQuestions = $questions->count();

        return view('test.start-test', compact('questions', 'totalQuestions'));
    }


    public function submit(Request $request)
    {
        $userId = auth()->id();


        $hasSubmitted = Result::where('user_id', $userId)->exists();
        if ($hasSubmitted) {
               return view('test.already-submitted');
        }

        $answers = $request->input('answers'); 
        $correctCount = 0;

        foreach ($answers as $questionId => $selectedOption) {
            $question = Question::find($questionId);
            $isCorrect = $question && $selectedOption == $question->correct_option;

            if ($isCorrect) {
                $correctCount++;
            }

            UserAnswer::create([
                'user_id' => $userId,
                'question_id' => $questionId,
                'selected_option' => $selectedOption,
            ]);
        }

        Result::create([
            'user_id' => $userId,
            'total_questions' => count($answers),
            'correct_answers' => $correctCount,
            'score' => $ws = $this->convertToWS($correctCount),
            'category' => $this->getCategory($ws),
        ]);

        return redirect()->route('test.result')->with('success', 'Tes berhasil disimpan.');
    }


    public function result()
    {
        $userId = auth()->id();
        $result = Result::where('user_id', $userId)->first();

        if (!$result) {
            return redirect()->route('test.tutor')->with('warning', 'Anda belum mengikuti tes.');
        }

        $answers = UserAnswer::with('question')
            ->where('user_id', $userId)
            ->get();

        return view('test.test-result', [
            'score' => $result->correct_answers,
            'totalQuestions' => $result->total_questions,
            'ws' => $result->score,
            'category' => $result->category ?? 'Tidak tersedia',
            'answers' => $answers
        ]);
    }

    private function convertToWS($score)
    {
        if ($score >= 29) return 17;
        if ($score >= 27) return 16;
        if ($score >= 25) return 15;
        if ($score >= 23) return 14;
        if ($score == 22) return 13;
        if ($score >= 20) return 12;
        if ($score >= 18) return 11;
        if ($score >= 16) return 10;
        if ($score >= 14) return 9;
        if ($score >= 12) return 8;
        if ($score >= 10) return 7;
        if ($score >= 8)  return 6;
        if ($score >= 6)  return 5;
        if ($score >= 4)  return 4;
        if ($score == 3)  return 3;
        if ($score >= 1)  return 2;
        if ($score == 0)  return 1;
        return 0;
    }

    private function getCategory($ws)
    {
        if ($ws >= 17) return 'BS';
        if ($ws >= 13) return 'B';
        if ($ws >= 9)  return 'S';
        if ($ws >= 5)  return 'K';
        return 'KS';
    }
}
