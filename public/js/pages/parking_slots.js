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

        var data = {
            'property_type': 'Parking',
            'location': $('#location button h6').html(),
            'name': $('#property button h6').html(),
            'min_rate': min_rate,
            'max_rate': max_rate,
            'origin': 'parking_slots_page',
        }

        $.ajax({
            type: 'POST',
            url: "/for-lease/category/parking_slots",
            data: data,
            success: function (res) {
                // console.log(res)
                var slots = res.slots
                var units_div = $('.units')
                units_div.empty()

                let money = new Intl.NumberFormat('fil-PH', {
                    style: 'currency',
                    currencyDisplay: 'code',
                    currency: 'PHP',
                });

                $.each(slots, function(row, field) {
                    var unit_html = `<div class='col-xxl-4 unit'>
                                        <div class='card'>
                                            <img class='card-img-top' src='/uploads/properties/pictures/${field.picture}' alt=''>
                                            <div class='card-body details'>
                                                <h3>${field.name}</h3>
                                                <i class="fa-solid fa-location-dot fa-xl"></i>
                                                <h4>${field.location}</h4>

                                                <div class="row table">
                                                    <div class="col-3">
                                                        <h6>Rate</h6>
                                                    </div>
                                                    <div class="col-9 text-dark">
                                                        <h6>${field.price}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer border-0">
                                                <a class="btn btn-warning" href="/for-lease/category/parking_slots/${field.id}">View Details</a>
                                            </div>
                                        </div>
                                    </div>`

                    units_div.append(unit_html)
                })
            },
            error: function (xhr, status, error) {
                console.log(xhr)
            },
        })  
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