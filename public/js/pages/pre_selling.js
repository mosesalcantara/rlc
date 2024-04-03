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
        var price_range = $('#price_range button h6').html()
        var words = price_range.split(' ')

        var min_price = words[1].replace('M', '')
        var max_price = words[3].replace('M', '')

        var data = {
            'sale_status': 'Pre-Selling',
            'location': $('#location button h6').html(),
            'unit_type': $('#unit_type button h6').html(),
            'min_price': min_price,
            'max_price': max_price,
            'origin': 'pre_selling_page',
        }

        $.ajax({
            type: 'POST',
            url: "/for-sale/search",
            data: data,
            success: function (res) {
                var properties = res.properties
                var properties_div = $('.properties')
                properties_div.empty()

                $.each(properties, function(row, field) {
                    var property_html = `                
                                        <div class="col-xxl-4 property">
                                            <div class="card">
                                                <img class='card-img-top' src="/uploads/sale_units/snapshots/${field.snapshot}" alt="">
                                                <div class="card-body details">
                                                    <h3>${field.name}</h3>
                                                    <i class="fa-solid fa-location-dot fa-xl"></i>
                                                    <h4>${field.location}</h4>
                                                    <div class="row table">
                                                        <div class="col-xxl-4 col-5">
                                                            <h6>Unit ID</h6>
                                                            <h6>Unit Type</h6>
                                                            <h6>Price</h6>
                                                            <h6>Area</h6>
                                                        </div>
                                                        <div class="col-xxl col-7 text-dark">
                                                            <h6>${field.unit_id}</h6>
                                                            <h6>${field.type}</h6>
                                                            <h6>PHP ${field.price}M</h6>
                                                            <h6>${field.area}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer border-0">
                                                    <a class="btn btn-warning" href="">VIEW UNIT</a>
                                                </div>
                                            </div>
                                        </div>
                                        `

                    properties_div.append(property_html)
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
        url: "/for-sale/get-filters",
        data: {'sale_status': 'Pre-Selling'},
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