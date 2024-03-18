$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax( {
        method:"POST",
        url:'/get-settings',
        success: function(res) {
          var settings = res.settings

          $('#logo').attr({'src': `/uploads/settings/logos/${settings.logo}`})

          $('#office').html(settings.office)
          $('#address').html(settings.address)
          $('#email').html(settings.email)

          $('#telephone').html(settings.telephone)
          $('#mobile').html(settings.mobile)

          $('#facebook').attr({'href': settings.facebook})
          $('#twitter').attr({'href': settings.twitter})
          $('#instagram').attr({'href': settings.instagram})
          $('#youtube').attr({'href': settings.youtube})
        },
        error: function(res) {
            console.log(res)
        }
    })
})