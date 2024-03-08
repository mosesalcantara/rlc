$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('input[name=property_type]').on('change', function() {
        var property_type = this.value

        $.ajax({
            type: 'POST',
            url: "/get-residential-units",
            success: function (res) {
                var properties = res.properties

                $.each(properties, function(key, value) {
                    for (property of value) {
                        console.log(property)
                    }  
                })

            },
            error: function (xhr, status, error) {
                console.log(xhr)
            },
        })    
    })
})