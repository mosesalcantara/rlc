$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('#compute_btn').click(function (e) { 
        var result = $('.result')
        result.empty()

        let money = new Intl.NumberFormat('fil-PH', {
            style: 'currency',
            currencyDisplay: 'code',
            currency: 'PHP',
        })

        var price = $('#price').val()
        var down = $('#down').val().replace('%', '') / 100
        var terms = $('#terms').val()
        var interest = $('#interest').val() / 100

        var downpayment = price * down
        var financed = price - downpayment
        var amortization = (financed * (interest / 12)) / (1 - (1 + (interest / 12))** (-12 * terms))

        var result_content = `
                        <div class='card'>
                            <div class='card-body'>
                                <div class='row title mb-3'>
                                    <h4>Result</h4>
                                </div>
                                <div class='row'>
                                    <div class='col fields'>
                                        <h6>Selling Price</h6>
                                        <h6>Downpayment</h6>
                                        <h6>Amount Financed</h6>
                                        <h6>Monthly Amortization</h6>
                                    </div>
                                    <div class='col'>
                                        <h6>${money.format(price)}</h6>
                                        <h6>${money.format(downpayment)}</h6>
                                        <h6>${money.format(financed)}</h6>
                                        <h6>${money.format(amortization)}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>    
                     `
        result.append(result_content)
    });

    $('#clear_btn').click(function (e) { 
        $('.calculator input, .calculator select').val('')
    })
})