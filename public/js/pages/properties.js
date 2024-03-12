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

                        for (property of value) {
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

                        for (property of value) {
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

        $.ajax({
          type: 'POST',
          url: "/compare-properties",
          data: {
            'form_data': $(this).serialize(),
            'selected_properties': selected_properties,
          },
          success: function (res) {
            var properties = res.properties
            var properties_div = $('.properties')

            for (property of properties) {
                var property_div = $('<div>').addClass('col-4 property')

                var property_picture = $('<div>').addClass('picture d-flex justify-content-center align-items-end')
                property_picture.css({
                    'background-image': `url(uploads/properties/pictures/${property.picture})`
                })
                var name = $('<h5>').html(property.name)
                property_picture.append(name)
                property_div.append(property_picture)
    
                var details = $('<div>').addClass('details')

                var title = $('<h5>').html('Property Type')
                var data = $('<h6>').html('Residential')
                details.append(title, data)
    
                var title = $('<h5>').html('Rental Rate')
                let money = new Intl.NumberFormat('fil-PH', {
                    style: 'currency',
                    currencyDisplay: 'code',
                    currency: 'PHP',
                });
                var data = $('<h6>').html(`${money.format(property.min_rate)} - ${money.format(property.max_rate)} / mo.`)
                details.append(title, data)
    
                var title = $('<h5>').html('Unit Type')
                var data = $('<h6>').html(property.types)
                details.append(title, data)
    
                var title = $('<h5>').html('Unit Area (sqm)')
                var data = $('<h6>').html(`${property.min_area} - ${property.max_area} sqm`)
                details.append(title, data)
    
                var title = $('<h5>').html('Unit Status')
                var data = $('<h6>').html(property.statuses)
                details.append(title, data)
    
                var title = $('<h5>').html('Location')
                var data = $('<h6>').html(property.location)
                details.append(title, data)

                property_div.append(details)
                properties_div.append(property_div)
            }
          },
          error: function (xhr, status, error) {

          },
        })   
        
        $.ajax({
            type: 'POST',
            url: "/compare-residential-units",
            data: {
              'form_data': $(this).serialize(),
              'selected_properties': selected_properties,
            },
            success: function (res) {
                console.log(res)
                var properties = res.properties
                var r_units_container = $('.residential_units_container')

                for (property of properties) {
                    var r_units_div = $('<div>').addClass('residential_units_div row')
                    var col = $('<div>').addClass('col')
                    var row = $('<div>').addClass('row')
                    var h5 = $('<h5>').html(`${property.name} (${property.count}) results`)
                    
                    row.append(h5)
                    col.append(row)
                    r_units_div.append(col)

                    var row = $('<div>').addClass('row')
                    for (r_unit of property['units']) {
                        console.log(r_unit)

                        var unit_col = $('<div>').addClass('col-3 unit')

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

                        var field = $('<h6>').html('Unit ID')
                        fields_col.append(field)

                        var field = $('<h6>').html('Property Type')
                        fields_col.append(field)

                        var field = $('<h6>').html('Monthly Rate')
                        fields_col.append(field)

                        var field = $('<h6>').html('Unit Type')
                        fields_col.append(field)

                        var field = $('<h6>').html('Unit Area')
                        fields_col.append(field)

                        var field = $('<h6>').html('Unit Status')
                        fields_col.append(field)

                        details_row.append(fields_col)

                        var values_col = $('<div>').addClass('col')

                        var value = $('<h6>').html(r_unit.unit_id)
                        values_col.append(value)

                        var value = $('<h6>').html('Residential')
                        values_col.append(value)

                        var value = $('<h6>').html(r_unit.rate)
                        values_col.append(value)

                        var value = $('<h6>').html(r_unit.type)
                        values_col.append(value)

                        var value = $('<h6>').html(r_unit.area)
                        values_col.append(value)

                        var value = $('<h6>').html(r_unit.status)
                        values_col.append(value)

                        details_row.append(values_col)

                        card_body.append(details_row)
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