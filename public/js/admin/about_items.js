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
          url: "/admin/about/update",
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function (res) {
            alert(res.msg)
          },
          error: function (res) {
            var errors = res.responseJSON.errors
            // console.log(errors)

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
      url:'/admin/about/edit',
      success: function(res) {
        var record = res.record

        $('#heading_title').val(record.heading_title)
        $('#description').val(record.description)
        $('#tagline_title').val(record.tagline_title)
        $('#tagline').val(record.tagline)
        $('#video_code').val(record.video_code)
        $('#video_title').val(record.video_title)
        $('#video_description').val(record.video_description)
        $('#upd_id').val(record.id)
      }
    })
}