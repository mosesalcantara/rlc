$(document).ready( function () {
    show_front()
 
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

    $(document).on('click', '.header .col', function(){
        var header_back = [
            {'picture': 'header-1.jpg'},
            {'picture': 'header-2.jpg'},
            {'picture': 'header-3.jpg'}, 
        ]
        
        var header_div = $('.header')
        var id = $(this).data('id')

        $('.header .col').remove()

        var col = $('<div>').addClass('col-12 back')
        var picture = $('<div>').css({
            'background-image': `url('img/pages/home/${header_back[id]['picture']}')`,
        })

        col.append(picture)
        header_div.append(col)
        header_div.append(col)

        setTimeout(() => {
            $('.header .col-12').remove()
            show_front()
        }, 3000)

    })
})

function show_front() {
    var header_front = [
        {'picture': 'family.png', 'h3': 'Register My Unit'},
        {'picture': 'building.png', 'h3': 'Check Available Units'},
        {'picture': 'agent.png', 'h3': 'Connect With Us'}, 
    ]

    var header_div = $('.header')

    header_front.forEach(function (header, index) {
        var col = $('<div>').addClass('col').data('id', index)
        var picture = $('<div>').css({
            'background-image': `url('img/pages/home/${header.picture}')`,
        })
        var h3 = $('<h3>').html(header.h3)

        picture.append(h3)
        col.append(picture)
        header_div.append(col)
    })
}
