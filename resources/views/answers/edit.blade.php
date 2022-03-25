<div class="position-relative">
    <form class="ajax_edit_form visually-hidden" data-id="{{$answer->id}}">
        @csrf
        <div class="row mb-3">
            <label for="answer" class="col-md-0 col-form-label text-md-start">Edit Answer</label>
            <div class="col-md-12">
                <textarea class="form-control" name="answer" rows="5" required>{{ $answer->answer  }}</textarea>
            </div>
        </div>


        <div class="row mb-0">
            <div class="col-md-12 offset-md-0">
                <button type="button" class="btn btn-success edit_form_button" data-id="{{$answer->id}}" onclick="ajax_edit_answer({{$answer->id}})">
                    Update Answer
                </button>
                <button type="reset" class="btn btn-danger reset_form_button" data-id="{{$answer->id}}" onclick="hide_edit_form({{$answer->id}})">
                    Cancel
                </button>
            </div>
        </div>

    </form>

    <div class="spinner-border position-absolute top-50 start-50 visually-hidden ajax_submit_loading" role="status" data-id="{{$answer->id}}">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
