$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
        $('#location .dropdown-menu').remove()
        $('#search_form')[0].reset()

        var property_type = $(this).html()

        if (property_type == 'Residential') {
            $('#type').parent().removeClass('d-none')
            $('#price').parent().removeClass('d-none')

            $('#property_type').parent().removeClass('col-xxl-5')
            $('#location').parent().removeClass('col-xxl-6')

            $('#property_type').parent().addClass('col-xxl-3')
            $('#location').parent().addClass('col-xxl-3')
        }
        else {
            $('#type').parent().addClass('d-none')
            $('#price').parent().addClass('d-none')

            $('#property_type').parent().removeClass('col-xxl-3')
            $('#location').parent().removeClass('col-xxl-3')

            $('#property_type').parent().addClass('col-xxl-5')
            $('#location').parent().addClass('col-xxl-6')
        }

        get_filters(property_type)
    })

    $(document).on('click', '.search_btn button', function(){
        var property_type = $('#property_type button h6').html()
        var url = ''

        if (property_type == 'Residential') {
            var prices = $('#price button h6').html()
            var words = prices.split(' ')

            var min_price = parseFloat(words[1].replace(/,/g, ''))
            var max_price = parseFloat(words[3].replace(/,/g, ''))

            $('input[name=property_type]').val($('#property_type button h6').html())
            $('input[name=location]').val($('#location button h6').html())
            $('input[name=type]').val($('#type button h6').html())
            $('input[name=min_price]').val(min_price)
            $('input[name=max_price]').val(max_price)

            url = '/for-lease/category/residential_units'
        }
        else if (property_type == 'Commercial') {
            $('input[name=location]').val($('#location button h6').html())
            url = '/for-lease/category/commercial_units'
        }
        else if (property_type == 'Parking') {
            $('input[name=location]').val($('#location button h6').html())
            url = '/for-lease/category/parking_slots'
        }
        
        $('#search_form').attr('action', url).submit()    
    })
})

function get_filters(property_type) {
    $.ajax({
        type: 'POST',
        url: "/for-lease/get-filters",
        data: {'property_type': property_type},
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
