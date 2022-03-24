<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Http\Requests\AnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request)
    {
        $answer = Answer::create($request->all() + ['user_id'=> Auth::id()]);

        $answer->user = Auth::user()->name;
        $answer->date = $answer->answered_date;

        unset($answer->updated_at);
        unset($answer->created_at);
        unset($answer->question_id);
        unset($answer->user_id);

//        return redirect()->route('questions.show',$request->question_id)->with('success', "Answer submitted successfully");
        return response()->json(['answer' => $answer]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AnswerRequest  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(AnswerRequest $request, Answer $answer)
    {
        $answer->answer = $request->input('answer');
        $answer->save();
        return response()->json(['success' => 1, 'answer'=>$answer->answer]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return response()->json(['success' => 1]);

    }
}
