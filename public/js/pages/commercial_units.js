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
        var areas = $('#area button h6').html()
        var words = areas.split(' ')

        var min_area = parseFloat(words[0].replace(/,/g, ''))
        var max_area = parseFloat(words[2].replace(/,/g, ''))

        var data = {
            'property_type': 'Commercial',
            'location': $('#location button h6').html(),
            'min_area': min_area,
            'max_area': max_area,
            'origin': 'commercial_units_page',
        }

        $.ajax({
            type: 'POST',
            url: "/for-lease/category/commercial_units",
            data: data,
            success: function (res) {
                var c_units = res.c_units
                var units_div = $('.units')
                units_div.empty()

                $.each(c_units, function(row, field) {
                    var unit_html = `<div class='col-xxl-4 unit'>
                                        <div class='card'>
                                            <img class='card-img-top' src='/uploads/properties/pictures/${field.picture}' alt=''>
                                            <div class='card-body details'>
                                                <h3>${field.name}</h3>
                                                <i class="fa-solid fa-location-dot fa-xl"></i>
                                                <h4>${field.location}</h4>

                                                <div class="row table">
                                                    <div class="col-xxl-4 col-5">
                                                        <h6>Code</h6>
                                                        <h6>Area</h6>
                                                    </div>
                                                    <div class="col-xxl col-7 text-dark">
                                                        <h6>${field.building} - ${field.retail_id}</h6>
                                                        <h6>${field.size.toFixed(2)} SQM</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer border-0">
                                                <a class="btn btn-warning" href="/for-lease/category/commercial_units/${field.id}">VIEW RETAIL</a>
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
        data: {'property_type': 'Commercial'},
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