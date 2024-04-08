$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('.step-2, .step-3').hide()

    $( ".next_btn" ).on( "click", function() {
        var step_div = $(this).parents()
        step_div = step_div[2]

        var next_step = $(step_div).next()
        $(step_div).hide()
        next_step.show()
    })

    $( ".prev_btn" ).on( "click", function() {
        var step_div = $(this).parents()
        step_div = step_div[2]

        var prev_step = $(step_div).prev()
        $(step_div).hide()
        prev_step.show()
    })

    $("select[name=property_id]").val('')

    $("select[name=property_id]").on( "change", function() {
        $('select[name=building_id]').empty()

        $.ajax({
            url: "/unit-registration/related-buildings",
            method: 'POST',
            data: { 
                'property_id': $('select[name=property_id]').val(),
            },
            success: function (res) {
                var records = res.records
                $.each(records, function(row, field) {
                    var option = $('<option>').text(field.name).val(field.id)
                    $('select[name=building_id]').append(option)
                })
            },
            error: function (xhr, status, error) {

            },
        })    
    })

    $('#registration_form').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
          url: "/unit-registration",
          method: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function (res) {
            alert(res.msg)
            $('#registration_form').trigger('reset')
            $('.step-2, .step-3').hide()
            $('.step-1').show()
          },
          error: function (res) {
            console.log(res)
          },
        })   
    })
})