$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('input[name=property_type]').on('change', function() {
        var property_type = this.value
        $('#property_1 ul, #property_2 ul, #property_3 ul').empty()

        if (property_type == 'Residential') {
            $.ajax({
                type: 'POST',
                url: "/get-residential-units",
                success: function (res) {
                    var properties = res.properties
                    var ul = $('<ul>')
                    ul.addClass('dropdown-menu')
    
                    $.each(properties, function(key, value) {
                        var li = $('<li>')
                        var h5 = $('<h5>')
                        h5.html(key)
                        h5.addClass('dropdown-header')
                        li.append(h5)
                        ul.append(li)

                        for (var property of value) {
                            var li = $('<li>')
                            var h6 = $('<h6>')
                            h6.html(property)
                            h6.addClass('dropdown-item')
                            h6.attr({
                                'onclick': `select_property()`,
                            })
                            li.append(h6)
                            ul.append(li)
                        }  
                    })
                    $('#property_1, #property_2, #property_3').append(ul)
                },
                error: function (xhr, status, error) {
                    console.log(xhr)
                },
            })   
        } 
        else {
            $.ajax({
                type: 'POST',
                url: "/get-commercial-units",
                success: function (res) {
                    var properties = res.properties
                    var ul = $('<ul>')
                    ul.addClass('dropdown-menu')
    
                    $.each(properties, function(key, value) {
                        var li = $('<li>')
                        var h5 = $('<h5>')
                        h5.html(key)
                        h5.addClass('dropdown-header')
                        li.append(h5)
                        ul.append(li)

                        for (var property of value) {
                            var li = $('<li>')
                            var h6 = $('<h6>')
                            h6.html(property)
                            h6.addClass('dropdown-item')
                            li.append(h6)
                            ul.append(li)
                        }  
                    })
                    $('#property_1, #property_2, #property_3').append(ul)
                },
                error: function (xhr, status, error) {
                    console.log(xhr)
                },
            })   
        }
    })

    $('#property_form').submit(function(e) {
        e.preventDefault()

        var form_types = ['#br1', '#br2', '#br3', '#ph', '#studio']
        var types = []

        for (var form_type of form_types) {
            if ($(form_type).prop('checked') == true) {
                if (form_type == '#br1') {
                    form_type = '1BR'
                }
                else if (form_type == '#br2') {
                    form_type = '2BR'
                }
                else if (form_type == '#br3') {
                    form_type = '3BR'
                }
                else if (form_type == '#ph') {
                    form_type = 'PH'
                }
                else if (form_type == '#studio') {
                    form_type = 'Studio'
                }
                types.push(form_type)
            }
        }

        var form_statuses = ['#fully_furnished', '#semi_furnished', '#unfurnished']
        var statuses = []

        for (var form_status of form_statuses) {
            if ($(form_status).prop('checked') == true) {
                if (form_status == '#fully_furnished') {
                    form_status = 'Fully Furnished'
                }
                else if (form_status == '#semi_furnished') {
                    form_status = 'Semi-furnished'
                }
                else if (form_status == '#unfurnished') {
                    form_status = 'Unfurnished'
                }
                statuses.push(form_status)
            }
        }

        var data = {
            'selected_properties': selected_properties,
            'property_type': $('input[name=property_type]').val(),
            'min_rate': $('#min_rate').val(),
            'max_rate': $('#max_rate').val(),
            'types': types,
            'min_area': $('#min_area').val(),
            'max_area': $('#max_area').val(),
            'statuses': statuses,
        }

        // console.log(data)

        $.ajax({
          type: 'POST',
          url: "/compare-properties",
          data: {
            'selected_properties': selected_properties,
          },
          success: function (res) {
            // console.log(res)
            var properties = res.properties
            var properties_div = $('.properties')
            let money = new Intl.NumberFormat('fil-PH', {
                style: 'currency',
                currencyDisplay: 'code',
                currency: 'PHP',
            });

            for (var property of properties) {
                var property_div = $('<div>').addClass('col-4 property')

                var property_data = {
                    'Property Type': 'Residential',
                    'Rentail Rate': `${money.format(property.min_rate)} - ${money.format(property.max_rate)} / mo.`,
                    'Unit Type': property.types,
                    'Unit Area (sqm)': `${property.min_area} - ${property.max_area} sqm`,
                    'Unit Status': property.statuses,
                    'Location': property.location,
                }

                var property_picture = $('<div>').addClass('picture d-flex justify-content-center align-items-end')
                property_picture.css({
                    'background-image': `url(uploads/properties/pictures/${property.picture})`
                })
                var name = $('<h5>').html(property.name)
                property_picture.append(name)
                property_div.append(property_picture)
    
                var details = $('<div>').addClass('details')

                $.each(property_data, function(key, value) {
                    var title = $('<h5>').html(key)
                    var data = $('<h6>').html(value)
                    details.append(title, data)
                })   

                property_div.append(details)
                properties_div.append(property_div)
            }
          },
          error: function (xhr, status, error) {
            console.log(xhr)
          },
        })   
        
        $.ajax({
            type: 'POST',
            url: "/compare-residential-units",
            data: data,
            success: function (res) {
                // console.log(res)
                var properties = res.properties
                var r_units_container = $('.residential_units_container')
                let money = new Intl.NumberFormat('fil-PH', {
                    style: 'currency',
                    currencyDisplay: 'code',
                    currency: 'PHP',
                });

                for (var property of properties) {
                    var r_units_div = $('<div>').addClass('residential_units_div row')
                    var col = $('<div>').addClass('col')
                    var row = $('<div>').addClass('row')
                    var h5 = $('<h5>').html(`${property.name} (${property.count}) results`)
                    
                    row.append(h5)
                    col.append(row)
                    r_units_div.append(col)

                    var row = $('<div>').addClass('row')
                    for (var r_unit of property['units']) {
                        var unit_data = {
                            'Unit ID': r_unit.unit_id,
                            'Property Type': 'Residential',
                            'Monthly Rate': money.format(r_unit.rate),
                            'Unit Type': r_unit.type,
                            'Unit Area (sqm)': `${r_unit.area} sqm`,
                            'Unit Status': r_unit.status,
                        }

                        var unit_col = $('<div>').addClass('col-4 unit')

                        var card = $('<div>').addClass('card')
                        var img = $('<img>').addClass('card-img-top snapshot').attr({
                            src: `uploads/residential_units/snapshots/${r_unit.snapshot}`
                        })

                        card.append(img)

                        var card_body = $('<div>').addClass('card-body')
                        var title = $('<div>').addClass('title')
                        var i = $('<i>').addClass('fa-solid fa-location-dot fa-lg')
                        var h6 = $('<h6>').html(r_unit.location)
                        var h5 = $('<h5>').html(r_unit.name)

                        title.append(i, h6, h5)
                        card_body.append(title)

                        var details_row = $('<div>').addClass('row')
                        var fields_col = $('<div>').addClass('col fields')
                        var values_col = $('<div>').addClass('col')

                        $.each(unit_data, function(key, value) {
                            var field = $('<h6>').html(key)
                            var value = $('<h6>').html(value)
                            fields_col.append(field)
                            values_col.append(value)
                        })   

                        details_row.append(fields_col, values_col)
                        card_body.append(details_row)

                        var a = $('<a>').addClass('btn btn-warning').attr({
                            'href': `/for-lease/category/residential_units/${r_unit.id}`
                        }).html('VIEW UNIT')
                        card_body.append(a)

                        card.append(card_body)
                        unit_col.append(card)
                        row.append(unit_col)
                    }

                    r_units_div.append(row)
                    r_units_container.append(r_units_div)
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr)
            },
        })   
    })  

})

var selected_properties = {
    'property_1': '',
    'property_2': '',
    'property_3': '',
}

function select_property() {
    var element = event.target
    var property = element.innerHTML
    var parents = $(element).parents()

    var button = $(parents[1]).prev()
    button.html(property)

    var dropdown = $(parents[2])
    dropdown = dropdown.attr('id')
    selected_properties[dropdown] = property
}