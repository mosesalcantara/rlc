$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addForm').submit(function(e) {
        e.preventDefault()
        $.ajax({
          url: "/admin/properties/add/",
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
          url: "/admin/properties/update/",
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
            thr.append($('<th>').text('Action'))
            thead.append(thr)
            tbl.append(thead)

            var tbody = $('<tbody>')
            $.each(records, function(row, field) {
                var tr = $('<tr>')
                var td_img = $('<td>')
                var img = $('<img>')
                img.attr({
                    'src' : `/uploads/properties/logo/${field.logo}`,
                })
                td_img.append(img)
                tr.append(td_img)
                tr.append($('<td>').text(field.name))
                tr.append($('<td>').text(field.location))
                tr.append($('<td>').text(field.description))


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
        console.log(record)
        $('#name').val(record.name)
        $('#location').val(record.location)
        $('#description').val(record.description)
      }
    })
  }

function get_del_id(id){
    $('#del_id').val(parseInt(id))
}