<div class="row">
    <ul class="answer_list col-md-10 offset-md-1">
        @foreach($question->answers as $answer)
            <li data-id="{{$answer->id}}">
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
            </li>
        @endforeach
    </ul>
</div>

<script type="text/javascript">
    function edit_answer(answer_id){
        $('.ajax_edit_form[data-id='+answer_id+']').removeClass('visually-hidden')
        $('.answer_text[data-id='+answer_id+']').hide()
        $('.update_delete[data-id='+answer_id+']').addClass('visually-hidden')
    }

    function delete_answer(answer_id){
        var conf = confirm('Are you sure you want to delete answer?')
        if(conf == false){
            return ''
        }

        var url = "{{route('answers.destroy',":id") }}"
        url = url.replace(':id', answer_id);
        $.ajax({
            type: 'Delete',
            url: url,
            data: {_token: "{{ csrf_token() }}"},
            success: function (data) {
                if(data.success)
                    $('.answer_list li[data-id='+answer_id+']').fadeOut(300, function(){ $(this).remove();});
            }
        });
    }
</script>
