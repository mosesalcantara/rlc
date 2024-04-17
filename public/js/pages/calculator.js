$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('#compute_btn').click(function (e) { 
        let money = new Intl.NumberFormat('fil-PH', {
            style: 'currency',
            currencyDisplay: 'code',
            currency: 'PHP',
        })

        var price = $('#price').val()
        var down = $('#down').val().replace('%', '') / 100
        var terms = $('#terms').val()
        var interest = 0.07

        var downpayment = price * down
        var financed = price - downpayment
        var amortization = (financed * (interest / 12)) / (1 - (1 + (interest / 12))** (-12 * terms))
    });
})