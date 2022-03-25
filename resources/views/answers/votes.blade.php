<div class="vote-button">
    <div class="vote-up w-25" onclick="vote_submit(1, {{$answer->id}})">
        <i class="fa-solid fa-caret-up fa-2xl"></i>
    </div>

    <div class="vote-down w-25" onclick="vote_submit(-1, {{$answer->id}})">
        <i class="fa-solid fa-caret-down fa-2xl"></i>
    </div>

    <div>
        <span class="vote_count" data-id="{{$answer->id}}"> {{ $answer->votes->sum('vote') }}  </span>
        {{ Str::plural('Vote', $answer->votes) }}
    </div>
</div>
