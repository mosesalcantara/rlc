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

        var results_div = $('.results')
        var result = `
                        <div class='card'>
                            <div class='card-body'>
                                <h4 class='mb-3'>Result</h4>

                                <div class='row'>
                                    <div class='col-6'>
                                        <h6>Selling Price</h6>
                                        <h6>Downpayment</h6>
                                        <h6>Amount Financed</h6>
                                        <h6>Monthly Amortization</h6>
                                    </div>
                                    <div class='col-6'>
                                        <h6>${money.format(price)}</h6>
                                        <h6>${money.format(downpayment)}</h6>
                                        <h6>${money.format(financed)}</h6>
                                        <h6>${money.format(amortization)}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>    
                     `
        results_div.append(result)
    });
})