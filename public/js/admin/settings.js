$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }) 

    get_upd_id()

    $('#updForm').submit(function(e) {
        e.preventDefault()
        $('#updForm span').remove()

        $.ajax({
          type: 'POST',
          url: "/admin/settings/update/",
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function (res) {
            alert(res.msg)
          },
          error: function (res) {
            var errors = res.responseJSON.errors
            console.log(errors)

            var inputs = $('#updForm input, #updForm select, #updForm textarea')
            $.each(inputs, function(index, input) {
              var name = $(input).attr('name')

              if (name in errors) {
                for (error of errors[name]) {
                    var error_msg = $(`<span class='text-danger'>${error}</span>`)
                    error_msg.insertAfter($(input))
                }
              }
            })
          },
        })    
    })  
})


function get_upd_id(){
    $.ajax( {
      method:"POST",
      url:'/admin/settings/edit/',
      success: function(res) {
        var record = res.record

        $('#office').val(record.office)
        $('#address').val(record.address)
        $('#email').val(record.email)
        $('#telephone').val(record.telephone)
        $('#mobile').val(record.mobile)
        $('#messenger').val(record.messenger)
        $('#messenger_text').val(record.messenger_text)
        $('#telegram').val(record.telegram)
        $('#telegram_text').val(record.telegram_text)
        $('#facebook').val(record.facebook)
        $('#twitter').val(record.twitter)
        $('#instagram').val(record.instagram)
        $('#youtube').val(record.youtube)
        $('#upd_id').val(record.id)
      }
    })
}