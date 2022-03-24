<form method="POST" action="{{ route('answers.store') }}" id="ajax_answer_submit">
    @csrf

    <div class="row mb-3">
        <label for="answer" class="col-md-1 col-form-label text-md-end">Answer</label>
        <input type="hidden" name="question_id" value="{{$question->id}}">
        <div class="col-md-11">
            <textarea id="answer" class="form-control @error('answer') is-invalid @enderror" name="answer" rows="5" required>{{ old('answer') }}</textarea>
            @error('answer')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <div class="row mb-0">
        <div class="col-md-8 offset-md-1">
            <button type="submit" class="btn btn-primary">
                Add Answer
            </button>
        </div>
    </div>
</form>

<hr>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

{{--<script type="text/javascript">--}}
{{--    $('#ajax_answer_submit').submit(function(e){--}}
{{--        e.preventDefault();--}}
{{--        var frm = $(this);--}}
{{--        $.ajax({--}}
{{--            type: frm.attr('method'),--}}
{{--            url: frm.attr('action'),--}}
{{--            data: frm.serialize(),--}}
{{--            success: function (data) {--}}

{{--            }--}}
{{--        });--}}

{{--    })--}}
{{--</script>--}}
