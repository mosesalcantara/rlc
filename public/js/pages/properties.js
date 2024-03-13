$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $('#residential').prop('checked', true)
    // $('input[name=property_type]').trigger('change')
    // get_residential_properties()

    $('input[name=property_type]').on('change', function() {
        property_type = this.value
        $('.dropdown-menu').remove()

        if (property_type == 'Residential') {
            $('.filter_rate, .filter_rate, .filter_unit_type, .filter_status').removeClass('d-none')
            get_residential_properties()
        } 
        else {
            $('.filter_rate, .filter_rate, .filter_unit_type, .filter_status').addClass('d-none')
            get_commercial_properties()
        }
    })

    $('#property_form').submit(function(e) {
        e.preventDefault()

        if (property_type == 'Residential') {
            compare_residential_properties()
            compare_residential_units()
        }
        else {
            compare_commercial_properties()
            compare_commercial_units()
        }
    })  

})

var selected_properties = {
    'property_1': '',
    'property_2': '',
    'property_3': '',
}

var property_type = ''

function get_residential_properties() {
    $.ajax({
        type: 'POST',
        url: "/get-residential-units",
        success: function (res) {
            var properties = res.properties
            var ul = $('<ul>').addClass('dropdown-menu')

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

function get_commercial_properties() {
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

function select_property() {
    var element = event.target
    var property = element.innerHTML
    // console.log(property)
    var parents = $(element).parents()

    var button = $(parents[1]).prev()
    // console.log($(parents[1]).prev())
    button.empty()

    var row = $('<div>').addClass('row')
    var h6_col = $('<div>').addClass('col-10 d-flex justify-content-start')
    var h6 = $('<h6>').html(property)
    var i_col = $('<div>').addClass('col-2 d-flex justify-content-end')
    var i = $('<i>').addClass('fa-solid fa-chevron-right')

    h6_col.append(h6)
    i_col.append(i)
    row.append(h6_col, i_col)
    button.append(row)

    var dropdown = $(parents[2])
    // console.log($(parents[2]))
    dropdown = dropdown.attr('id')
    selected_properties[dropdown] = property
}

function compare_residential_properties() {
    $.ajax({
        type: 'POST',
        url: "/compare-residential-properties",
        data: {
            'selected_properties': selected_properties,
        },
        success: function (res) {
            var properties = res.properties
            var properties_div = $('.properties')

            if (property_type == 'Residential') {
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
            }
        },
        error: function (xhr, status, error) {
        console.log(xhr)
        },
    })   
}

function compare_commercial_properties() {
    // console.log(selected_properties)
    $.ajax({
        type: 'POST',
        url: "/compare-commercial-properties",
        data: {
            'selected_properties': selected_properties,
        },
        success: function (res) {
            var properties = res.properties
            var properties_div = $('.properties')

            if (property_type == 'Commercial') {
                for (var property of properties) {
                    var property_div = $('<div>').addClass('col-4 property')
        
                    var property_data = {
                        'Property Type': 'Commercial',
                        'Unit Area (sqm)': `${property.min_area} - ${property.max_area} sqm`,
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
            }
        },
        error: function (xhr, status, error) {
        console.log(xhr)
        },
    })  
}

function compare_residential_units() {
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

    $.ajax({
        type: 'POST',
        url: "/compare-residential-units",
        data: data,
        success: function (res) {
            // console.log(res)
            var properties = res.properties
            var units_container = $('.units_container')
            let money = new Intl.NumberFormat('fil-PH', {
                style: 'currency',
                currencyDisplay: 'code',
                currency: 'PHP',
            });

            for (var property of properties) {
                var units_div = $('<div>').addClass('units_div row')
                var col = $('<div>').addClass('col')
                var row = $('<div>').addClass('row')
                var h5 = $('<h5>').html(`${property.name} (${property.count}) results`)
                
                row.append(h5)
                col.append(row)
                units_div.append(col)

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

                units_div.append(row)
                units_container.append(units_div)
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr)
        },
    })   
}

function compare_commercial_units() {
    var data = {
        'selected_properties': selected_properties,
        'min_area': $('#min_area').val(),
        'max_area': $('#max_area').val(),
    }

    $.ajax({
        type: 'POST',
        url: "/compare-commercial-units",
        data: data,
        success: function (res) {
            console.log(res)
            var properties = res.properties
            var units_container = $('.units_container')

            for (var property of properties) {
                var units_div = $('<div>').addClass('units_div row')
                var col = $('<div>').addClass('col')
                var row = $('<div>').addClass('row')
                var h5 = $('<h5>').html(`${property.name} (${property.count}) results`)
                
                row.append(h5)
                col.append(row)
                units_div.append(col)

                var row = $('<div>').addClass('row')
                for (var c_unit of property['units']) {
                    var unit_data = {
                        'Unit ID': `${c_unit.building} - ${c_unit.retail_id}`,
                        'Property Type': 'Commercial',
                        'Unit Area (sqm)': `${c_unit.size} sqm`,
                    }

                    var unit_col = $('<div>').addClass('col-4 unit')

                    var card = $('<div>').addClass('card')
                    var img = $('<img>').addClass('card-img-top snapshot').attr({
                        src: `uploads/properties/pictures/${c_unit.picture}`
                    })

                    card.append(img)

                    var card_body = $('<div>').addClass('card-body')
                    var title = $('<div>').addClass('title')
                    var i = $('<i>').addClass('fa-solid fa-location-dot fa-lg')
                    var h6 = $('<h6>').html(c_unit.location)
                    var h5 = $('<h5>').html(c_unit.name)

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
                        'href': `/for-lease/category/commercial_units/${c_unit.id}`
                    }).html('VIEW UNIT')
                    card_body.append(a)

                    card.append(card_body)
                    unit_col.append(card)
                    row.append(unit_col)
                }

                units_div.append(row)
                units_container.append(units_div)
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr)
        },
    })   
}