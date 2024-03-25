$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('.picture_carousel_item').first().addClass('active')

    $( ".amenity" ).on( "click", function() {
        var name = $( this ).attr('data-name');
        var picture = $( this ).attr('data-picture');

        $('#amenity_name').text(name)
        $('#amenity_picture').attr({
            'src': `/uploads/amenities/pictures/${picture}`,
        })
    })
})