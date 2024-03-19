$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    get_filters()

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

    $(document).on('click', '#location .dropdown-item', function(){
        $('#property button h6').html('Property')
        $('#property .dropdown-menu').remove()

        $.ajax({
            type: 'POST',
            url: "/for-lease/get-properties",
            data: {'location': $(this).html()},
            success: function (res) {
                // console.log(res)
                var properties = res.properties
                var ul = $('<ul>').addClass('dropdown-menu')
    
                for (var property of properties) {
                    var dropdown_item = `<li><h6 class='dropdown-item'>${property}</h6></li>`
                    ul.append(dropdown_item)
                }  
    
                $('#property').append(ul)
            },
            error: function (xhr, status, error) {
                console.log(xhr)
            },
        })  
    })

    $(document).on('click', '.search_btn button', function(){
        var rates = $('#rate button h6').html()
        var words = rates.split(' ')

        var min_rate = parseFloat(words[1].replace(/,/g, ''))
        var max_rate = parseFloat(words[3].replace(/,/g, ''))

        $('input[name=location]').val($('#location button h6').html())
        $('input[name=name]').val($('#property button h6').html())
        $('input[name=min_rate]').val(min_rate)
        $('input[name=max_rate]').val(max_rate)

        url = '/for-lease/category/parking_slots'
        $('#search_form').attr('action', url).submit() 
    })
})

function get_filters() {
    $.ajax({
        type: 'POST',
        url: "/for-lease/get-filters",
        data: {'property_type': 'Parking'},
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