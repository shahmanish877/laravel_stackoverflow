<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function getAnsweredDateAttribute(){
        if($this->updated_at->gt($this->created_at)){
            return 'Updated at: '.$this->updated_at->toDateString();
        }else{
            return 'Answered at: '.$this->created_at->toDateString();
        }
    }
}
