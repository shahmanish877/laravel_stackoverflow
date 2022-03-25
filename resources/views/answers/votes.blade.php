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

<script type="text/javascript">
    function vote_submit(index, answer_id){
        var vote_url = "{{route('vote_answer') }}"


        $.ajax({
            type: 'POST',
            url: vote_url,
            data: {_token: "{{ csrf_token() }}", vote: index, answer_id: answer_id},
            success: function (data) {
                console.log(data)
                if(data.success){
                    var current_vote = $('.vote_count[data-id='+answer_id+']')
                    current_vote.html(data.vote_count)
                }
                if(data.error){
                    alert(data.error)
                }
            }
        });
    }
</script>
