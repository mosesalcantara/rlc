$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

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

    $(document).on('click', '.dropdown button', function() {
        $(this).next().toggleClass('show')
    })

    $(document).on('click', '.dropdown-item', function(){
        var selected = $(this)

        var parents = $(selected).parents()
        $(parents[1]).toggleClass('show')

        var button = $(parents[1]).prev()
        button.find('h6').html(selected.html())
    })

    $(document).on('click', '#property_type .dropdown-item', function(){
        var selected = $(this)

        if (selected.html() == 'Residential') {
            get_filters()
        } 
    })

    $(document).on('click', '#property_type .dropdown-item', function(){
        $('#location .dropdown-menu').remove()
        $('#search_form')[0].reset()

        var property_type = $(this).html()

        if (property_type != 'Residential') {
            $('#type').parent().toggleClass('d-none')
            $('#rate').parent().toggleClass('d-none')

            $('#property_type').parent().removeClass('col-3')
            $('#location').parent().removeClass('col-3')

            $('#property_type').parent().addClass('col-5')
            $('#location').parent().addClass('col-6')
        }
        else {
            $('#type').parent().toggleClass('d-none')
            $('#rate').parent().toggleClass('d-none')

            $('#property_type').parent().removeClass('col-5')
            $('#location').parent().removeClass('col-6')

            $('#property_type').parent().addClass('col-3')
            $('#location').parent().addClass('col-3')
        }
    })

    $(document).on('click', '.search_btn button', function(){
        var rates = $('#rate button h6').html()
        var words = rates.split(' ')

        var min_rate = parseFloat(words[1].replace(/,/g, ''))
        var max_rate = parseFloat(words[3].replace(/,/g, ''))

        $('input[name=property_type]').val($('#property_type button h6').html())
        $('input[name=location]').val($('#location button h6').html())
        $('input[name=type]').val($('#type button h6').html())
        $('input[name=min_rate]').val(min_rate)
        $('input[name=max_rate]').val(max_rate)

        var url = ''

        if ($('#property_type button h6').html() == 'Residential') {url = '/for-lease/category/residential_units'}
        else if ($('#property_type button h6').html() == 'Commercial') {url = '/for-lease/category/commercial_units'}
        else if ($('#property_type button h6').html() == 'Parking') {url = '/for-lease/category/parking_slots'}
        // console.log(url)
        $('#search_form').attr('action', url).submit()
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

function get_filters() {
    $.ajax({
        type: 'POST',
        url: "/for-lease/get-filters",
        success: function (res) {
            // console.log(res)
            var locations = res.locations
            var ul = $('<ul>').addClass('dropdown-menu')

            for (var location of locations) {
                var dropdown_item = `<li><h6 class='dropdown-item'>${location}</h6></li>`
                ul.append(dropdown_item)
            }  

            $('#location').append(ul)
        },
        error: function (xhr, status, error) {
            console.log(xhr)
        },
    })  
}
