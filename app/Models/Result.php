<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'user_id',
        'total_questions',
        'correct_answers',
        'score',
        'category'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
