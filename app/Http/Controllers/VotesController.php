<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vote_answer(Request $request, Answer $answer)
    {
        $request->validate([
            'vote'=>'required',
            'answer_id'=>'required',
        ]);

        $answer_id = $request->input('answer_id');
        $vote_index = $request->input('vote');
        $vote = Votes::where('user_id', Auth::id())->where('answer_id', $answer_id)->first();

        if($vote){
            if($vote->vote == $vote_index){
                return response()->json(['error' => 'You cannot vote twice.']);
            }
        }else{
            $vote = new Votes();
            $vote->answer_id = $answer_id;
            $vote->user_id = Auth::id();
        }

        $vote->vote = $vote_index;
        $vote->save();

        $vote_count = Votes::where('answer_id', $answer_id)->sum('vote');
        return response()->json(['success' => 1, 'vote_count' => $vote_count]);


    }

}
