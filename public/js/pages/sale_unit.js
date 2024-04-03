$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('.snapshot_carousel_item').first().addClass('active')
    $('.unit_video_carousel_item').first().addClass('active')
    $('.amenity_carousel_item').first().addClass('active')

})