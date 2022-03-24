<div class="position-relative">
    <form method="POST" action="{{ route('answers.store') }}" id="ajax_answer_form">
        @csrf

        <div class="row mb-3">
            <label for="answer" class="col-md-1 col-form-label text-md-end">Answer</label>
            <input type="hidden" name="question_id" value="{{$question->id}}">
            <div class="col-md-11">
                <textarea class="form-control @error('answer') is-invalid @enderror" name="answer" rows="5" required>{{ old('answer') }}</textarea>
                @error('answer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="row mb-0">
            <div class="col-md-8 offset-md-1">
                <button type="submit" class="btn btn-primary" id="form_button">
                    Add Answer
                </button>
            </div>
        </div>

    </form>

    <div class="spinner-border position-absolute top-50 start-50 visually-hidden" role="status" id="ajax_submit_loading">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<hr>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $('#ajax_answer_form').submit(function(e){
        e.preventDefault();
        var frm = $(this);

        $('#ajax_submit_loading').removeClass('visually-hidden')
        $(this).css('opacity', '0.2')
        $(this).css('cursor', 'not-allowed')
        $('#ajax_answer_form #form_button').prop( "disabled", true )

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                // console.log(data)
                $(".answer_list").prepend("<li> " +
                    "<p>"+data.answer.answer +"</p> "+
                        "<div class='text-end d-flex justify-content-end' style='font-size: 12px;'>" +
                    "<p> Answered By: <strong> "+data.answer.user +" </strong> </p> "+
                    "<p class='ms-3'> "+data.answer.date +" </p>"+
                    "</div></li>");

                $('#ajax_answer_form textarea').val('')
                $('#ajax_submit_loading').addClass('visually-hidden')
                $('#ajax_answer_form').css('opacity', '1')
                $('#ajax_answer_form').css('cursor', 'initial')
                $('#ajax_answer_form #form_button').prop( "disabled", false )
            }
        });

    })
</script>
