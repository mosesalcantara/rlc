$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    
    $('#addModal').on('show.bs.modal', function(e) {
      $('#addForm span').remove()
    })

    $('#addForm').submit(function(e) {
        e.preventDefault()
        $('#addForm span').remove()

        var form_unit_types = ['#add_1br', '#add_2br', '#add_3br', '#add_ph', '#add_studio']
        var unit_types = ''
    
        for (var form_unit_type of form_unit_types) {
            if ($(form_unit_type).prop('checked') == true) {
                if (form_unit_type == '#add_1br') {
                    form_unit_type = '1BR'
                }
                else if (form_unit_type == '#add_2br') {
                  form_unit_type = '2BR'
                }
                else if (form_unit_type == '#add_3br') {
                  form_unit_type = '3BR'
                }
                else if (form_unit_type == '#add_ph') {
                  form_unit_type = 'PH'
                }
                else if (form_unit_type == '#add_studio') {
                  form_unit_type = 'Studio'
                }
                unit_types += ` ${form_unit_type}`
            }
        }

        var formData = new FormData(this)
        formData.append('unit_types', unit_types)

        $.ajax({
          url: "/admin/properties/add/",
          method: 'POST',
          data: formData,
          contentType: false,
          processData: false,
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
    
    $('#updModal').on('show.bs.modal', function(e) {
      $('#updForm span').remove()
    })

    $('#updForm').submit(function(e) {
        e.preventDefault()
        $('#updForm span').remove()
        
        var form_unit_types = ['#upd_1br', '#upd_2br', '#upd_3br', '#upd_ph', '#upd_studio']
        var unit_types = ''
    
        for (var form_unit_type of form_unit_types) {
            if ($(form_unit_type).prop('checked') == true) {
                if (form_unit_type == '#upd_1br') {
                    form_unit_type = '1BR'
                }
                else if (form_unit_type == '#upd_2br') {
                  form_unit_type = '2BR'
                }
                else if (form_unit_type == '#upd_3br') {
                  form_unit_type = '3BR'
                }
                else if (form_unit_type == '#upd_ph') {
                  form_unit_type = 'PH'
                }
                else if (form_unit_type == '#upd_studio') {
                  form_unit_type = 'Studio'
                }
                unit_types += ` ${form_unit_type}`
            }
        }

        var formData = new FormData(this)
        formData.append('unit_types', unit_types)

        $.ajax({
          type: 'POST',
          url: "/admin/properties/update/",
          data: formData,
          contentType: false,
          processData: false,
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
          url: "/admin/properties/delete/",
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
        url: "/admin/properties/",
        success: function (res) {
            var records = res.records

            var tbl = $('<table>').addClass('table table-hover w-100')
            tbl.attr('id', 'tbl_records')

            var thead = $('<thead>')
            var thr = $('<tr>')
            thr.append($('<th>').text('Logo'))
            thr.append($('<th>').text('Name'))
            thr.append($('<th>').text('Location'))
            thr.append($('<th>').text('Description'))
            thr.append($('<th>').text('Sale Status'))
            thr.append($('<th>').text('Minimum Price'))
            thr.append($('<th>').text('Maximum Price'))
            thr.append($('<th>').text('Unit Types'))
            thr.append($('<th>').text('Action'))
            thead.append(thr)
            tbl.append(thead)

            var tbody = $('<tbody>')
            $.each(records, function(row, field) {
                var tr = $('<tr>')
                var td_img = $('<td>')
                var img = $('<img>')
                img.attr({
                    'src' : `/uploads/properties/logos/${field.logo}`,
                })
                td_img.append(img)
                tr.append(td_img)
                tr.append($('<td>').text(field.name))
                tr.append($('<td>').text(field.location))
                tr.append($('<td>').text(field.description))
                tr.append($('<td>').text(field.sale_status))
                tr.append($('<td>').text(`${field.min_price}M`))
                tr.append($('<td>').text(`${field.max_price}M`))
                tr.append($('<td>').text(field.unit_types))

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

        }
    })
}

function get_upd_id(id){
    var target_id = parseInt(id)
    $('#upd_id').val(target_id)

    $.ajax( {
      method:"POST",
      url:'/admin/properties/edit/',
      data: {'upd_id' : target_id},
      success: function(res) {
        var record = res.record
        // console.log(record)
        $('#name').val(record.name)
        $('#location').val(record.location)
        $('#description').val(record.description)
        $('#sale_status').val(record.sale_status)
        $('#min_price').val(record.min_price)
        $('#max_price').val(record.max_price)

        var unit_types = record.unit_types
        unit_types = unit_types.split(' ')
        var unit_type = ''

        var form_unit_types = ['#upd_1br', '#upd_2br', '#upd_3br', '#upd_ph', '#upd_studio']

        for (var form_unit_type of form_unit_types) {
          if (form_unit_type == '#upd_1br') {
            unit_type = '1BR'
          }
          else if (form_unit_type == '#upd_2br') {
            unit_type = '2BR'
          }
          else if (form_unit_type == '#upd_3br') {
            unit_type = '3BR'
          }
          else if (form_unit_type == '#upd_ph') {
            unit_type = 'PH'
          }
          else if (form_unit_type == '#upd_studio') {
            unit_type = 'Studio'
          }

          if (unit_types.includes(unit_type) == true) { $(form_unit_type).prop("checked", true) }
        }
      }
    })
  }

function get_del_id(id){
    $('#del_id').val(parseInt(id))
}