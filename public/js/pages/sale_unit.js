$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    get_filters()

    $('.snapshot_carousel_item').first().addClass('active')
    $('.unit_video_carousel_item').first().addClass('active')
    $('.amenity_carousel_item').first().addClass('active')

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

        var min_price = words[1].replace('M', '')
        var max_price = words[3].replace('M', '')

        $('input[name=sale_status]').val(sale_status)
        $('input[name=location]').val($('#location button h6').html())
        $('input[name=type]').val($('#type button h6').html())
        $('input[name=min_price]').val(min_price)
        $('input[name=max_price]').val(max_price)

        $('#search_form').submit()
    })

    $('#viewingForm').submit(function (e) { 
        e.preventDefault()
        $.ajax({
            type: 'POST',
            url: "/request-viewing",
            data: $(this).serialize(),
            success: function (res) {
              alert(res.msg)
              $(`#viewingForm`).trigger('reset')
              $(`#viewingModal`).modal('hide')
            },
            error: function (res) {
                var errors = res.responseJSON.errors
                // console.log(errors)
    
                var inputs = $('#viewingForm input, #viewingForm select, #viewingForm textarea')
                $.each(inputs, function(index, input) {
                  var name = $(input).attr('name')
    
                  if (name in errors) {
                    for (error of errors[name]) {
                        var error_msg = $(`<span class='text-danger'>${error}</span>`)
                        error_msg.insertAfter($(input))
                    }
                  }
                })
              },
        })
    });
})

var sale_status = $('.title h1').html()
sale_status = sale_status.split(' ')[0]

function get_filters() {
    $.ajax({
        type: 'POST',
        url: "/for-sale/get-filters",
        data: {'sale_status': sale_status},
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
        error: function (res) {

        },
    })  
}