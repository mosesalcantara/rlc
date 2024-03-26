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

        $.ajax({
          url: "/admin/videos/add/",
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

            var inputs = $('#addForm input')
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

        $.ajax({
          type: 'POST',
          url: "/admin/videos/update/",
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

            var inputs = $('#updForm input')
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
          url: "/admin/videos/delete/",
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
      url: "/admin/videos/",
      success: function (res) {
          var records = res.records

          var tbl = $('<table>').addClass('table table-hover w-100')
          tbl.attr('id', 'tbl_records')

          var thead = $('<thead>')
          var thr = $('<tr>')
          thr.append($('<th>').text('Code'))
          thr.append($('<th>').text('Action'))
          thead.append(thr)
          tbl.append(thead)

          var tbody = $('<tbody>')
          $.each(records, function(row, field) {
              var tr = $('<tr>')
              tr.append($('<td>').text(field.code))

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
      url:'/admin/videos/edit/',
      data: {'upd_id' : target_id},
      success: function(res) {
        var record = res.record
        $('#code').val(record.code)
      }
    })
  }

function get_del_id(id){
    $('#del_id').val(parseInt(id))
}