<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'image',
        'correct_option',
    ];

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
