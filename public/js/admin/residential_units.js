$(document).ready( function () {    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addModal').on('show.bs.modal', function(e) {
        $('#addForm span').remove()

        $.ajax({
            url: "/admin/residential/related-properties",
            method: 'POST',
            success: function (res) {
                var records = res.records
                $.each(records, function(row, field) {
                    var option = $('<option>').text(field.name).val(field.id)
                    $('#add_property_id').append(option)
                })
                $('#add_property_id').val('')
            },
            error: function (xhr, status, error) {

            },
        })    
    })

    $("#add_property_id").on( "change", function() {
        $('#add_building_id').empty()

        $.ajax({
            url: "/admin/residential/related-buildings",
            method: 'POST',
            data: { 
                'property_id': $('#add_property_id').val(),
            },
            success: function (res) {
                var records = res.records
                $.each(records, function(row, field) {
                    var option = $('<option>').text(field.name).val(field.id)
                    $('#add_building_id').append(option)
                })
            },
            error: function (xhr, status, error) {

            },
        })    
    })

    $('#addModal').on('hide.bs.modal', function(e) {
        $('#add_property_id').empty()
        $('#add_building_id').empty()
    })

    $('#addForm').submit(function(e) {
        e.preventDefault()
        $('#addForm span').remove()

        $.ajax({
          url: "/admin/residential/add/",
          method: 'POST',
          data: $(this).serialize(),
          success: function (res) {
            alert(res.msg)
            get_all()
            $(`#addForm`).trigger('reset')
            $(`#addModal`).modal('hide')
          },
          error: function (res) {
            var errors = res.responseJSON.errors
            // console.log(errors)

            var inputs = $('#addForm input, #addForm select, #addForm textarea')
            $.each(inputs, function(index, input) {
              var name = $(input).attr('name')

              if (name in errors) {
                for (error of errors[name]) {
                    var error_msg = $(`<span class='text-danger'>${error}</span>`)
                    error_msg.insertAfter($(input))
                }
              }
            })
          },    
        })    
    })  
    
    $("#upd_property_id").on( "change", function() {
        $('#upd_building_id').empty()
        var property_id = $('#upd_property_id').val()

        $.ajax({
            url: "/admin/residential/related-buildings",
            method: 'POST',
            data: { 
                'property_id': property_id,
            },
            success: function (res) {
                var records = res.records
                $.each(records, function(row, field) {
                    var option = $('<option>').text(field.name).val(field.id)
                    $('#upd_building_id').append(option)
                })

            },
            error: function (xhr, status, error) {
                console.log(xhr)
            },
        })    
    })

    $('#updModal').on('show.bs.modal', function(e) {
        $('#updForm span').remove()
    })

    $('#updModal').on('hide.bs.modal', function(e) {
        $('#upd_property_id').empty()
        $('#upd_building_id').empty()
    })

    $('#updForm').submit(function(e) {
        e.preventDefault()
        $('#updForm span').remove()

        $.ajax({
          type: 'POST',
          url: "/admin/residential/update/",
          data: $(this).serialize(),
          success: function (res) {
            alert(res.msg)
            get_all()
            $(`#updForm`).trigger('reset')
            $(`#updModal`).modal('hide')
          },
          error: function (res) {
            var errors = res.responseJSON.errors
            // console.log(errors)

            var inputs = $('#updForm input, #updForm select, #updForm textarea')
            $.each(inputs, function(index, input) {
              var name = $(input).attr('name')

              if (name in errors) {
                for (error of errors[name]) {
                    var error_msg = $(`<span class='text-danger'>${error}</span>`)
                    error_msg.insertAfter($(input))
                }
              }
            })
          },
        })    
    })  

    $('#delForm').submit(function(e) {
        e.preventDefault()
        $.ajax({
          type: 'POST',
          url: "/admin/residential/delete/",
          data: $(this).serialize(),
          success: function (res) {
            alert(res.msg)
            get_all()
            $(`#delModal`).modal('hide')
          },
          error: function (xhr, status, error) {

          },
        })    
    })  

    get_all()
});

function get_all() {
    $('#tbl_div').empty()

    $.ajax({
        type: 'POST',
        url: "/admin/residential/",
        success: function (res) {
            var records = res.records

            var tbl = $('<table>').addClass('table table-hover w-100')
            tbl.attr('id', 'tbl_records')

            var thead = $('<thead>')
            var thr = $('<tr>')
            thr.append($('<th>').text('Property'))
            thr.append($('<th>').text('Location'))
            thr.append($('<th>').text('Unit ID'))
            thr.append($('<th>').text('Building'))
            thr.append($('<th>').text('Retail Status'))
            thr.append($('<th>').text('Type'))
            thr.append($('<th>').text('Area (SQM)'))
            thr.append($('<th>').text('Price'))
            thr.append($('<th>').text('Status'))
            thr.append($('<th>').text('Action'))
            thead.append(thr)
            tbl.append(thead)

            var tbody = $('<tbody>')
            $.each(records, function(row, field) {
                var tr = $('<tr>')
                tr.append($('<td>').text(field.property))
                tr.append($('<td>').text(field.location))
                tr.append($('<td>').text(field.unit_id))
                tr.append($('<td>').text(field.building))
                tr.append($('<td>').text(field.retail_status))
                tr.append($('<td>').text(field.type))
                tr.append($('<td>').text(`${field.area} SQM`))
                field.retail_status == 'For Sale' ? tr.append($('<td>').text(`${field.price}M`)) : tr.append($('<td>').text(field.price))
                tr.append($('<td>').text(field.status))

                var td_action = $('<td>')
                tr.append(td_action)

                var i_edit = $('<i>')
                i_edit.attr({
                    'class' : 'fa fa-pen-to-square mr-2',
                    'title' : "Edit",
                    'onclick' : `get_upd_id(${field.id})`,
                    'data-bs-toggle' : "modal",
                    'data-bs-target' : "#updModal",
                })
                i_edit.css({
                    'cursor' : 'pointer',
                })
                td_action.append(i_edit)

                var i_delete = $('<i>')
                i_delete.attr({
                    'class' : 'fa-solid fa-trash',
                    'title' : "Delete",
                    'onclick' : `get_del_id(${field.id})`,
                    'data-bs-toggle' : "modal",
                    'data-bs-target' : "#delModal",
                })
                i_delete.css({
                    'cursor' : 'pointer',
                })
                td_action.append(i_delete)

                tbody.append(tr)
            });

            tbl.append(tbody)
            $('#tbl_div').append(tbl)
            $('#tbl_records').DataTable();
        },
        error: function(res) {
            console.log(res)
        }
    })
}

function get_upd_id(id){
    var target_id = parseInt(id)
    $('#upd_id').val(target_id)

    $.ajax( {
      method:"POST",
      url:'/admin/residential/edit/',
      data: {'upd_id' : target_id},
      success: function(res) {
        var record = res.record
        var properties = res.properties
        var buildings = res.buildings

        $.each(properties, function(row, field) {
            var option = $('<option>').text(field.name).val(field.id)
            $('#upd_property_id').append(option)
        })
        $('#upd_property_id').val(record.property_id)

        $.each(buildings, function(row, field) {
            var option = $('<option>').text(field.name).val(field.id)
            $('#upd_building_id').append(option)
        })
        $('#upd_building_id').val(record.building_id)  

        $('#unit_id').val(record.unit_id)
        $('#retail_status').val(record.retail_status)
        $('#type').val(record.type)
        $('#area').val(record.area)
        $('#price').val(record.price)
        $('#status').val(record.status)
      },
      error: function(res) {
        console.log(res)
      }
    })
}

function get_del_id(id){
    $('#del_id').val(parseInt(id))
}