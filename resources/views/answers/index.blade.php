<div class="col-md-10 mt-5">
    @auth
        <div class="card mb-5">
            <div class="card-header">
                <h2> Add New Answer </h2>
            </div>

            <div class="card-body">
                    @include('answers.create')
            </div>
        </div>
    @endauth

    <div class="card">
        <div class="card-header">
            <h2> {{ Str::plural('Answer', $question->answers->count()) }} </h2>
        </div>

        <div class="card-body">
            @include('answers.show')

        </div>
    </div>
</div>
