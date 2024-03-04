$(document).ready( function () {
    $('.property_carousel_item').first().addClass('active')
    $('.video_carousel_item').first().addClass('active')
    $('.review_carousel_item').first().addClass('active')

    $( ".front_switch" ).on( "click", function() {
        var front = $(this).parents()
        front = $(front[1])
        front.css({'z-index': '-1'})
        var back = front.next()
        back.css({'z-index': '0'})
    })

    $( ".back_switch" ).on( "click", function() {
        var back = $(this).parents()
        back = $(back[3])
        back.css({'z-index': '-1'})
        var front = back.prev()
        front.css({'z-index': '0'})
    })
})