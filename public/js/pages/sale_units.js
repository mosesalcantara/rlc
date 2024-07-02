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

        var min_price = words[1].replace('M', '')
        var max_price = words[3].replace('M', '')

        var data = {
            'sale_status': sale_status,
            'location': $('#location button h6').html(),
            'type': $('#type button h6').html(),
            'min_price': min_price,
            'max_price': max_price,
            'origin': 'sale_units_page',
        }

        $.ajax({
            type: 'POST',
            url: "/for-sale/search",
            data: data,
            success: function (res) {
                var units = res.sale_units
                var units_div = $('.units')
                units_div.empty()

                $.each(units, function(row, field) {
                    var unit_html = `                
                                        <div class="col-xxl-4 unit">
                                            <div class="card">
                                                <img class='card-img-top' src="/uploads/residential_units/snapshots/${field.snapshot}" alt="">
                                                <div class="card-body details">
                                                    <h3>${field.name}</h3>
                                                    <i class="fa-solid fa-location-dot fa-xl"></i>
                                                    <h4>${field.location}</h4>
                                                    <div class="row table">
                                                        <div class="col-xxl-4 col-5">
                                                            <h6>Code</h6>
                                                            <h6>Unit Type</h6>
                                                            <h6>Selling Price</h6>
                                                            <h6>Area</h6>
                                                        </div>
                                                        <div class="col-xxl col-7 text-dark">
                                                            <h6>${field.unit_id}</h6>
                                                            <h6>${field.type}</h6>
                                                            <h6>PHP ${field.price}M</h6>
                                                            <h6>${field.area} SQM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer border-0">
                                                    <a class="btn btn-warning" href="/for-sale/category/${field.sale_status}/${field.id}">VIEW UNIT</a>
                                                </div>
                                            </div>
                                        </div>
                                        `

                    units_div.append(unit_html)
                })
            },
            error: function (res) {

            },
        })  
    })
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