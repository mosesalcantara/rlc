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

    $(document).on('click', '#sale_status .dropdown-item', function(){
        $('#location .dropdown-menu').remove()
        $('#search_form')[0].reset()

        var sale_status = $(this).html()
        get_filters(sale_status)
    })

    $(document).on('click', '.search_btn button', function(){
        var price_range = $('#price_range button h6').html()
        var words = price_range.split(' ')

        var min_price = words[1].replace('M', '')
        var max_price = words[3].replace('M', '')

        $('input[name=sale_status]').val($('#sale_status button h6').html())
        $('input[name=location]').val($('#location button h6').html())
        $('input[name=unit_type]').val($('#unit_type button h6').html())
        $('input[name=min_price]').val(min_price)
        $('input[name=max_price]').val(max_price)

        $('#search_form').submit()
    })
})

function get_filters(sale_status) {
    $.ajax({
        type: 'POST',
        url: "/for-sale/get-filters",
        data: {'sale_status': sale_status},
        success: function (res) {
            // console.log(res)
            var records = res.records
            var ul = $('<ul>').addClass('dropdown-menu')

            for (var record of records) {
                var dropdown_item = `<li><h6 class='dropdown-item'>${record['location']}</h6></li>`
                ul.append(dropdown_item)
            }  

            $('#location').append(ul)
        },
        error: function (xhr, status, error) {
            console.log(xhr)
        },
    })  
}