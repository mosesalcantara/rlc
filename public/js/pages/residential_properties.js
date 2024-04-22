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

    $(document).on('click', '.search_btn button', function(){
        var prices = $('#price button h6').html()
        var words = prices.split(' ')

        var min_price = parseFloat(words[1].replace(/,/g, ''))
        var max_price = parseFloat(words[3].replace(/,/g, ''))

        var data = {
            'location': $('#location button h6').html(),
            'type': $('#type button h6').html(),
            'min_price': min_price,
            'max_price': max_price,
            'origin': 'residential_properties_page',
        }

        $('input[name=location]').val($('#location button h6').html())
        $('input[name=type]').val($('#type button h6').html())
        $('input[name=min_price]').val(min_price)
        $('input[name=max_price]').val(max_price)

        url = '/for-lease/category/residential_units'
        $('#search_form').attr('action', url).submit()    
    })

    $(document).on('click', '.view_units_btn', function(){
        var property_id = $(this).data('property_id')
        $('#view_units_form input[name=property_id]').val(property_id)

        url = `/for-lease/category/residential_units`
        $('#view_units_form').attr('action', url).submit()
    })
})

function get_filters() {
    $.ajax({
        type: 'POST',
        url: "/for-lease/get-filters",
        data: {'property_type': 'Residential'},
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