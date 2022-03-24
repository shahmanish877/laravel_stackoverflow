@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-baseline">
                        All Questions
                        <div>
                            @can('create', \App\Models\Question::class)
                                <a href="{{ route('questions.create') }}" class="btn btn-success"> Add New </a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">

                        @foreach($questions as $q )
                            <div>
                                <a href="{{ route('questions.show',$q->id) }}" class="h4 text-decoration-none fw-bold">
                                    {{ $q->title }}
                                    <small class="h6 fw-bold">
                                        ({{ $q->answers->count() }}
                                        {{ Str::plural('answer', $q->answers->count()) }})
                                    </small>
                                </a>

                                <p> {{ $q->description }} </p>

                                @if (!$loop->last)
                                    <hr>
                                @endif
                            </div>
                        @endforeach

                            <div class="d-flex">
                                {!! $questions->links() !!}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
