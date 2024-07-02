$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('.subscribe_btn').click(function (e) { 
        var email = $('input[name=email]').val()

        $.ajax({
            url: "/subscribe",
            method: 'POST',
            data: {email: email},
            success: function (res) {
              alert(res.msg)
              $('input[name=email]').val('')
            },
          })    
    })

})