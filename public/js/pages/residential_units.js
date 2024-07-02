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
            'property_type': 'Residential',
            'location': $('#location button h6').html(),
            'type': $('#type button h6').html(),
            'min_price': min_price,
            'max_price': max_price,
            'origin': 'residential_units_page',
        }

        $.ajax({
            type: 'POST',
            url: "/for-lease/category/residential_units",
            data: data,
            success: function (res) {
                var r_units = res.r_units
                var units_div = $('.units')
                units_div.empty()

                let money = new Intl.NumberFormat('fil-PH', {
                    style: 'currency',
                    currencyDisplay: 'code',
                    currency: 'PHP',
                })

                $.each(r_units, function(row, field) {
                    var unit_html = `<div class='col-xxl-4 unit'>
                                        <div class='card'>
                                            <img class='card-img-top' src='/uploads/residential_units/snapshots/${field.snapshot}' alt=''>
                                            <div class='card-body details'>
                                                <h3>${field.name}</h3>
                                                <i class="fa-solid fa-location-dot fa-xl"></i>
                                                <h4>${field.location}</h4>

                                                <div class="row table">
                                                    <div class="col-xxl-4 col-5">
                                                        <h6>Code</h6>
                                                        <h6>Unit Type</h6>
                                                        <h6>Rental Rate</h6>
                                                        <h6>Area</h6>
                                                    </div>
                                                    <div class="col-xxl col-7 text-dark">
                                                        <h6>${field.unit_id}</h6>
                                                        <h6>${field.type}</h6>
                                                        <h6>${money.format(field.price)} / mo</h6>
                                                        <h6>${field.area.toFixed(2)} SQM</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer border-0">
                                                <a class="btn btn-warning" href="/for-lease/category/residential_units/${field.id}">VIEW UNIT</a>
                                            </div>
                                        </div>
                                    </div>`

                    units_div.append(unit_html)
                })
            },
            error: function (res) {
                console.log(res)
            },
        })  
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