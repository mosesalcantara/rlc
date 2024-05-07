$(document).ready( function () {
    $.ajax({
        url: "/admin/chart-data",
        method: 'GET',
        success: function (res) {
           display_charts(res)
            
        },
        error: function (xhr, status, error) {

        },
    })    
})

function display_charts(res) {
    var keys = Object.keys(res.retail_status)
    var labels = keys.map(key => key.charAt(0).toUpperCase() + key.slice(1))

    var data = {
        labels: labels,
        datasets: [{
          label: 'Retail Shares',
          data: Object.values(res.retail_status),
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
          ],
          hoverOffset: 4
        }]
    }

    var ctx = document.getElementById('retail_status');

    new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            responsive: false,
        }
    })

    var keys = Object.keys(res.for_lease)
    var labels = keys.map(key => key.charAt(0).toUpperCase() + key.slice(1))

    var data = {
        labels: labels,
        datasets: [{
          label: 'For Lease Shares',
          data: Object.values(res.for_lease),
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
          ],
          hoverOffset: 4
        }]
    }

    var ctx = document.getElementById('for_lease');

    new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            responsive: false,
        }
    })

    var labels = []
    res.amenities_property.map(record => labels.push(record.name))

    var data = []
    res.amenities_property.map(record => data.push(record.amenities))

    var data = {
        labels: labels,
        datasets: [{
          label: 'Amenities Per Property',
          data: data,
          backgroundColor: [
            'rgba(255, 99, 132)',
            'rgba(255, 159, 64)',
            'rgba(255, 205, 86)',
            'rgba(75, 192, 192)',
            'rgba(54, 162, 235)',
            'rgba(153, 102, 255)',
            'rgba(201, 203, 207)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
          ],
          borderWidth: 1
        }]
    }

    var ctx = document.getElementById('amenities_property');

    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                  beginAtZero: true
                }
            }
        }
    })

    var labels = []
    res.reviews_property.map(record => labels.push(record.name))

    var data = []
    res.reviews_property.map(record => data.push(record.reviews))

    var data = {
        labels: labels,
        datasets: [{
          label: 'Reviews Per Property',
          data: data,
          backgroundColor: [
            'rgba(255, 99, 132)',
            'rgba(255, 159, 64)',
            'rgba(255, 205, 86)',
            'rgba(75, 192, 192)',
            'rgba(54, 162, 235)',
            'rgba(153, 102, 255)',
            'rgba(201, 203, 207)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
          ],
          borderWidth: 1
        }]
    }

    var ctx = document.getElementById('reviews_property');

    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                  beginAtZero: true
                }
            }
        }
    })
}