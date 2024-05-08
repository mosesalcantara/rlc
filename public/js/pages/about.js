$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('.year').click(function (e) { 
        $('.awards').empty()
        var year = $(this).text().trim()

        $.ajax({
            type: "post",
            url: "/about-us/get-awards",
            data: {'year': year},
            success: function (res) {
                var records = res.records

                $.each(records, function (ind, field) { 
                    var award = `
                                    <div class="col-xxl-2 col-12 mb-3 text-center award">
                                        <img src="/uploads/awards/pictures/${field.picture}" alt="">
                                        <h5>${field.title}</h5>
                                    </div>
                                `
                    $('.awards').append(award)
                })
            },
            error: function (res) {
                console.log(res)
            },
        });
    });

    $('.year').first().trigger('click')
})