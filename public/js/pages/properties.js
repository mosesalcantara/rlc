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
                var property_div = $('<div>').addClass('col')

                var property_picture = $('<div>').addClass('property_picture')
                var name = $('<h5>').html(property.name)
                property_picture.append(name)
                property_div.append(property_picture)
    
                var details = $('<div>').addClass('details')

                var title = $('<h5>').html('Property Type')
                var data = $('<h6>').html()
                details.append(title, data)
    
                var title = $('<h5>').html('Rental Rate')
                var data = $('<h6>').html(`${property.min_rate} - ${property.max_rate}`)
                details.append(title, data)
    
                var title = $('<h5>').html('Unit Type')
                var data = $('<h6>').html(property.types)
                details.append(title, data)
    
                var title = $('<h5>').html('Unit Area (sqm)')
                var data = $('<h6>').html(`${property.min_area} - ${property.max_area}`)
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