<div class="row">
    <ul class="answer_list col-md-10 offset-md-1">
        @foreach($question->answers as $answer)
            <li data-id="{{$answer->id}}" class="position-relative">
                <p class="answer_text" data-id="{{$answer->id}}">
                    {{ $answer->answer }}
                    @if( in_array($loop->index+1, array(1, 5, 10), true ) )
                        <span class="badge rounded-pill bg-info"> {{ str_ordinal($loop->index+1, true) }} comment</span>
                    @endif
                </p>
                @can(['update-answer'], $answer)
                    @include('answers.edit')
                @endcan

                <div class="text-end d-flex justify-content-end" style="font-size: 12px;">
                    <p>
                        Answered By: <strong> {{ $answer->user->name }} </strong>
                    </p>
                    <p class="ms-3">
                        {{ $answer->answered_date }}
                    </p>
                </div>
                <div class="d-flex update_delete" data-id="{{$answer->id}}">
                    @can(['update-answer'], $answer)
                        <a class="btn btn-success me-2 edit_btn" onclick="edit_answer({{$answer->id}})" data-id="{{$answer->id}}"> Edit </a>
                        <a class="btn btn-outline-danger delete_btn" onclick="delete_answer({{$answer->id}})" data-id="{{$answer->id}}">Delete</a>
                    @endcan
                </div>

                @auth()
                    @include('answers.votes')
                @endauth
            </li>
        @endforeach
    </ul>
</div>
