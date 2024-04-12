$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addModal').on('show.bs.modal', function(e) {
        $('#addForm span').remove()

        $.ajax({
            url: "/admin/reviews/get-related/",
            method: 'POST',
            success: function (res) {
                var records = res.records
                $.each(records, function(row, field) {
                    var option = $('<option>').text(field.name).val(field.id)
                    $('#add_property_id').append(option)
                })
            },
            error: function (xhr, status, error) {

            },
          })    
    })

    $('#addModal').on('hide.bs.modal', function(e) {
        $('#add_property_id').empty()
    })

    $('#addForm').submit(function(e) {
        e.preventDefault()
        $('#addForm span').remove()

        $.ajax({
          url: "/admin/reviews/add/",
          method: 'POST',
          data: new FormData(this),
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

    $('#updModal').on('hide.bs.modal', function(e) {
        $('#upd_property_id').empty()
    })

    $('#updForm').submit(function(e) {
        e.preventDefault()
        $('#updForm span').remove()

        $.ajax({
          type: 'POST',
          url: "/admin/reviews/update/",
          data: new FormData(this),
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
          url: "/admin/reviews/delete/",
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
        url: "/admin/reviews/",
        success: function (res) {
            var records = res.records

            var tbl = $('<table>').addClass('table table-hover w-100')
            tbl.attr('id', 'tbl_records')

            var thead = $('<thead>')
            var thr = $('<tr>')
            thr.append($('<th>').text('Profile Picture'))
            thr.append($('<th>').text('Fullname'))
            thr.append($('<th>').text('Property'))
            thr.append($('<th>').text('Reviewed On'))
            thr.append($('<th>').text('Review'))
            thr.append($('<th>').text('Publish Status'))
            thr.append($('<th>').text('Action'))
            thead.append(thr)
            tbl.append(thead)

            var tbody = $('<tbody>')
            $.each(records, function(row, field) {
                var tr = $('<tr>')
                var td_img = $('<td>')
                var img = $('<img>')
                img.attr({
                    'src' : `/uploads/reviews/profile_pics/${field.picture}`,
                })
                td_img.append(img)
                tr.append(td_img)
                tr.append($('<td>').text(field.fullname))
                tr.append($('<td>').text(field.name))
                var reviewed_on = field.reviewed_on
                reviewed_on = new Date(reviewed_on)
                reviewed_on = reviewed_on.toLocaleString('default', {month: 'long', day: 'numeric', year: 'numeric'});
                tr.append($('<td>').text(reviewed_on))
                tr.append($('<td>').text(field.review))
                tr.append($('<td>').text(field.publish_status))

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
      url:'/admin/reviews/edit/',
      data: {'upd_id' : target_id},
      success: function(res) {
        var record = res.record
        var records = res.records

        $.each(records, function(row, field) {
            var option = $('<option>').text(field.name).val(field.id)
            $('#upd_property_id').append(option)
        })

        $('#upd_property_id').val(record.property_id)
        $('#fullname').val(record.fullname)
        $('#reviewed_on').val(record.reviewed_on)
        $('#review').val(record.review)
        $('#publish_status').val(record.publish_status)
      }
    })
}

function get_del_id(id){
    $('#del_id').val(parseInt(id))
}