$('#ajax_add_answer').submit(function(e){
    e.preventDefault();
    var frm = $(this);

    $('#ajax_submit_loading').removeClass('visually-hidden')
    $(this).css('opacity', '0.2')
    $(this).css('cursor', 'not-allowed')
    $('#ajax_add_answer #form_button').prop( "disabled", true )

    $.ajax({
        type: 'POST',
        url: '/answers',
        data: frm.serialize(),
        success: function (data) {
            // console.log(data)
            $(".answer_list").prepend("<li data-id="+data.answer.id+"> " +
                "<p class='answer_text' data-id="+data.answer.id+">"+data.answer.answer +"</p> "+
                "<div class='text-end d-flex justify-content-end' style='font-size: 12px;'>" +
                "<p> Answered By: <strong> "+data.answer.user +" </strong> </p> "+
                "<p class='ms-3'> "+data.answer.date +" </p>"+
                "</div>" +
                "<div class='d-flex'>" +
                "<a class='btn btn-outline-danger delete_btn' onclick='delete_answer("+data.answer.id +")' data-id="+data.answer.id+">Delete</a>" +
                "</div></li>");

            $('#ajax_add_answer textarea').val('')
            $('#ajax_submit_loading').addClass('visually-hidden')
            $('#ajax_add_answer').css('opacity', '1')
            $('#ajax_add_answer').css('cursor', 'initial')
            $('#ajax_add_answer #form_button').prop( "disabled", false )

        }
    });

})


function ajax_edit_answer(answer_id){
    if($('.ajax_edit_form[data-id='+answer_id+'] textarea').val() == ''){
        alert("Please write some answer.")
        return false
    }

    $('.ajax_submit_loading[data-id='+answer_id+']').removeClass('visually-hidden')
    var frm = $('.ajax_edit_form[data-id='+answer_id+']')
    frm.css('opacity', '0.2')
    frm.css('cursor', 'not-allowed')
    $('.ajax_edit_form[data-id='+answer_id+'] button').prop( "disabled", true )

    var update_url = "/answers/"+answer_id

    $.ajax({
        type: 'PUT',
        url: update_url,
        data: frm.serialize(),
        success: function (data) {
            console.log(data)

            $('.ajax_submit_loading[data-id='+answer_id+']').addClass('visually-hidden')
            frm.css('opacity', '1')
            frm.css('cursor', 'initial')
            $('.ajax_edit_form[data-id='+answer_id+'] button').prop( "disabled", false )
            $('.answer_text[data-id='+answer_id+']').html(data.answer)
            $('.ajax_edit_form[data-id='+answer_id+'] textarea').val(data.answer)

            hide_edit_form(answer_id)

        }
    });

}

function hide_edit_form(answer_id){
    $('.ajax_edit_form[data-id='+answer_id+']').addClass('visually-hidden')
    $('.answer_text[data-id='+answer_id+']').show()
    $('.update_delete[data-id='+answer_id+']').removeClass('visually-hidden')

}

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

    var url = "/answers/"+answer_id
    $.ajax({
        type: 'Delete',
        url: url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            if(data.success)
                $('.answer_list li[data-id='+answer_id+']').fadeOut(300, function(){ $(this).remove();});
        }
    });
}


function vote_submit(index, answer_id){
    var vote_url = "/vote"


    $.ajax({
        type: 'POST',
        url: vote_url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {vote: index, answer_id: answer_id},
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

