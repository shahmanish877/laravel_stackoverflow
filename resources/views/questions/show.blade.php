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
                    <div class="card-body">
                        <div>
                            <h1> {{ $question->title }} </h1>
                            <hr>
                            <p> {{ $question->description }} </p>
                            <hr>

                            <div class="text-end d-flex justify-content-between" style="font-size: 12px;">
                                <div class="d-flex">
                                    @can(['update','delete'], $question)
                                        <a href="{{ route('questions.edit', $question) }}" class="btn btn-success me-2"> Edit </a>
                                        <form action="{{ route('questions.destroy',$question) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete it?');">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    @endcan
                                </div>

                                <div class="d-flex">
                                    <p>
                                        Questioned By: <strong> {{ $question->user->name }} </strong>
                                    </p>
                                    <p class="ms-3">
                                        {{ $question->questioned_date }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h2> {{ Str::plural('Answer', $question->answers->count()) }} </h2>
                    </div>

                    <div class="card-body">
                        <div>
                            @auth
                                @include('answers.create')
                            @endauth
                        </div>

                        <div class="answer_list">
                            @foreach($question->answers as $answer)
                                <div class="border-bottom mt-2 pt-2">
                                    <p> {{ $answer->answer }} </p>
                                    <div class="text-end d-flex justify-content-end" style="font-size: 12px;">
                                        <p>
                                            Answered By: <strong> {{ $answer->user->name }} </strong>
                                        </p>
                                        <p class="ms-3">
                                            {{ $answer->answered_date }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
