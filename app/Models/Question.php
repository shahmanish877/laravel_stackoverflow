<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class)->orderBy('created_at', 'desc');
    }

    public function getQuestionedDateAttribute(){
        if($this->updated_at->gt($this->created_at)){
            return 'Updated at: '.$this->updated_at->toDateString();
        }else{
            return 'Questioned at: '.$this->created_at->toDateString();
        }
    }
}
