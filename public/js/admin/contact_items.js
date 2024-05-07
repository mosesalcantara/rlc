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
          url: "/admin/contact/update",
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function (res) {
            alert(res.msg)
          },
          error: function (res) {
            var errors = res.responseJSON.errors

            var inputs = $('#updForm input')
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
      url:'/admin/contact/edit',
      success: function(res) {
        var record = res.record

        $('#heading_title').val(record.heading_title)
        $('#title').val(record.title)
        $('#subtitle').val(record.subtitle)
        $('#upd_id').val(record.id)
      }
    })
}