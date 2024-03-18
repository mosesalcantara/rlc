$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addForm').submit(function(e) {
        e.preventDefault()
        $.ajax({
          url: "/admin/settings/add/",
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
          error: function (xhr, status, error) {

          },
        })    
    })   

    $('#updForm').submit(function(e) {
        e.preventDefault()
        $.ajax({
          type: 'POST',
          url: "/admin/settings/update/",
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

          },
        })    
    })  

    $('#delForm').submit(function(e) {
        e.preventDefault()
        $.ajax({
          type: 'POST',
          url: "/admin/settings/delete/",
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
        url: "/admin/settings/",
        success: function (res) {
            var records = res.records

            var tbl = $('<table>').addClass('table table-hover w-100')
            tbl.attr('id', 'tbl_records')

            var thead = $('<thead>')
            var thr = $('<tr>')
            thr.append($('<th>').text('Logo'))
            thr.append($('<th>').text('Office'))
            thr.append($('<th>').text('Address'))
            thr.append($('<th>').text('Email'))
            thr.append($('<th>').text('Telephone'))
            thr.append($('<th>').text('Mobile'))
            thr.append($('<th>').text('Facebook'))
            thr.append($('<th>').text('Twitter'))
            thr.append($('<th>').text('Instagram'))
            thr.append($('<th>').text('YouTube'))
            thr.append($('<th>').text('Action'))
            thead.append(thr)
            tbl.append(thead)

            var tbody = $('<tbody>')
            $.each(records, function(row, field) {
                var tr = $('<tr>')
                var td_img = $('<td>')
                var img = $('<img>')
                img.attr({
                    'src' : `/uploads/settings/logos/${field.logo}`,
                })
                td_img.append(img)
                tr.append(td_img)
                tr.append($('<td>').text(field.office))
                tr.append($('<td>').text(field.address))
                tr.append($('<td>').text(field.email))
                tr.append($('<td>').text(field.telephone))
                tr.append($('<td>').text(field.mobile))
                tr.append($('<td>').text(field.facebook))
                tr.append($('<td>').text(field.twitter))
                tr.append($('<td>').text(field.instagram))
                tr.append($('<td>').text(field.youtube))

                var td_action = $('<td>')
                tr.append(td_action)

                var i_edit = $('<i>')
                i_edit.attr({
                    'class' : 'fa fa-pencil mr-2',
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
                    'class' : 'fa fa-trash',
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
            $('#tbl_records').DataTable({
                scrollX: true
            })

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
      url:'/admin/settings/edit/',
      data: {'upd_id' : target_id},
      success: function(res) {
        var record = res.record

        $('#office').val(record.office)
        $('#address').val(record.address)
        $('#email').val(record.email)
        $('#telephone').val(record.telephone)
        $('#mobile').val(record.mobile)
        $('#facebook').val(record.facebook)
        $('#twitter').val(record.twitter)
        $('#instagram').val(record.instagram)
        $('#youtube').val(record.youtube)
      }
    })
}

function get_del_id(id){
    $('#del_id').val(parseInt(id))
}