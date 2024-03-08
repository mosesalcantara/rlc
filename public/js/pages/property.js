$(document).ready( function () {
    $('.picture_carousel_item').first().addClass('active')

    $( ".amenity" ).on( "click", function() {
        var name = $( this ).attr('data-name');
        var picture = $( this ).attr('data-picture');

        $('#amenity_name').text(name)
        $('#amenity_picture').attr({
            'src': `/uploads/amenities/pictures/${picture}`,
            'width': '100%',
            'height': '100%',
        })
    });
})