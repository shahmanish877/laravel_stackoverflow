<div class="position-relative">
    <form id="ajax_add_answer">
        @csrf

        <div class="row mb-3">
            <label for="answer" class="col-md-1 col-form-label text-md-end">Answer</label>
            <input type="hidden" name="question_id" value="{{$question->id}}">
            <div class="col-md-10">
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
