<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voteAnswers()
    {
        return $this->belongsToMany(User::class, 'vote_answers');
    }

    public function getBodyHtmlAttribute()
    {
        $parsedown = new Parsedown();
        $parsedown->setSafeMode(true);
        $bodyHtml = Parsedown::instance()->text($this->body);

        return clean($bodyHtml);
    }

    public function getStatusAttribute()
    {
        return $this->id === $this->question->best_answer_id ? 'answer-accepted' : '';
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($answer) {
            $answer->question->increment('answers_count');
        });

        static::deleted(function ($answer) {
            $question = $answer->question;

            $answer->question->decrement('answers_count');
            if ($question->best_answer_id === $answer->id) {
                $question->best_answer_id = null;
                $question->save();
            }
        });
    }

    public function getBestAnswerAttribute()
    {
        return $this->id === $this->question->best_answer_id;
    }
}
