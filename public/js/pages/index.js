$(document).ready( function () {
    // var header_data = [
    //     {'picture': 'header-1.jpg', 'h3': 'Register My Unit'},
    //     {'picture': 'header-2.jpg', 'h3': 'Check Available Units'},
    //     {'picture': 'header-3.jpg', 'h3': 'Connect With Us'}, 
    // ]

    // var header_div = $('.header')

    // for (var header of header_data) {
    //     var col = $('<div>').addClass('col')
    //     var picture = $('<div>').css({
    //         'background-image': `url('img/pages/home/${header.picture}')`,
    //         'background-size': 'cover',
    //     })
    //     var h3 = $('<h3>').html(header.h3)

    //     picture.append(h3)
    //     col.append(picture)
    //     header_div.append(col)
    // }

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

    $('.header .col').click(function (e) { 

    });
})