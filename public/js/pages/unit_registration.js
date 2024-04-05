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
})