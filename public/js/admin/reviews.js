$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addModal').on('show.bs.modal', function(e) {
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
          error: function (xhr, status, error) {

          },
        })    
    })   

    // $('#updModal').on('hide.bs.modal', function(e) {
    //     $('#upd_property_id').empty()
    // })

    // $('#updForm').submit(function(e) {
    //     e.preventDefault()
    //     $.ajax({
    //       type: 'POST',
    //       url: "/admin/residential/update/",
    //       data: new FormData(this),
    //       contentType: false,
    //       processData: false,
    //       success: function (res) {
    //         alert(res.msg)
    //         get_all()
    //         $(`#updForm`).trigger('reset')
    //         $(`#updModal`).modal('hide')
    //       },
    //       error: function (res) {

    //       },
    //     })    
    // })  

    // $('#delForm').submit(function(e) {
    //     e.preventDefault()
    //     $.ajax({
    //       type: 'POST',
    //       url: "/admin/residential/delete/",
    //       data: $(this).serialize(),
    //       success: function (res) {
    //         alert(res.msg)
    //         get_all()
    //         $(`#delModal`).modal('hide')
    //       },
    //       error: function (xhr, status, error) {

    //       },
    //     })    
    // })  

    // get_all()
});

// function get_all() {
//     $('#tbl_div').empty()

//     $.ajax({
//         type: 'POST',
//         url: "/admin/residential/",
//         success: function (res) {
//             var records = res.records

//             var tbl = $('<table>').addClass('table table-hover w-100')
//             tbl.attr('id', 'tbl_records')

//             var thead = $('<thead>')
//             var thr = $('<tr>')
//             thr.append($('<th>').text('Property'))
//             thr.append($('<th>').text('Location'))
//             thr.append($('<th>').text('Unit ID'))
//             thr.append($('<th>').text('Building'))
//             thr.append($('<th>').text('Type'))
//             thr.append($('<th>').text('Area'))
//             thr.append($('<th>').text('Rate'))
//             thr.append($('<th>').text('Status'))
//             thr.append($('<th>').text('Action'))
//             thead.append(thr)
//             tbl.append(thead)

//             var tbody = $('<tbody>')
//             $.each(records, function(row, field) {
//                 var tr = $('<tr>')
//                 tr.append($('<td>').text(field.name))
//                 tr.append($('<td>').text(field.location))
//                 tr.append($('<td>').text(field.unit_id))
//                 tr.append($('<td>').text(field.building))
//                 tr.append($('<td>').text(field.type))
//                 tr.append($('<td>').text(field.area))
//                 tr.append($('<td>').text(field.rate))
//                 tr.append($('<td>').text(field.status))

//                 var td_action = $('<td>')
//                 tr.append(td_action)

//                 var i_edit = $('<i>')
//                 i_edit.attr({
//                     'class' : 'fa fa-pencil mr-2',
//                     'title' : "Edit",
//                     'onclick' : `get_upd_id(${field.id})`,
//                     'data-bs-toggle' : "modal",
//                     'data-bs-target' : "#updModal",
//                 })
//                 i_edit.css({
//                     'cursor' : 'pointer',
//                 })
//                 td_action.append(i_edit)

//                 var i_delete = $('<i>')
//                 i_delete.attr({
//                     'class' : 'fa fa-trash',
//                     'title' : "Delete",
//                     'onclick' : `get_del_id(${field.id})`,
//                     'data-bs-toggle' : "modal",
//                     'data-bs-target' : "#delModal",
//                 })
//                 i_delete.css({
//                     'cursor' : 'pointer',
//                 })
//                 td_action.append(i_delete)

//                 tbody.append(tr)
//             });

//             tbl.append(tbody)
//             $('#tbl_div').append(tbl)
//             $('#tbl_records').DataTable();
//         },
//         error: function(res) {

//         }
//     })
// }

// function get_upd_id(id){
//     var target_id = parseInt(id)
//     $('#upd_id').val(target_id)

//     $.ajax( {
//       method:"POST",
//       url:'/admin/residential/edit/',
//       data: {'upd_id' : target_id},
//       success: function(res) {
//         var record = res.record
//         var records = res.records

//         $.each(records, function(row, field) {
//             var option = $('<option>').text(field.name).val(field.id)
//             $('#upd_property_id').append(option)
//         })

//         $('#upd_property_id').val(record.property_id)
//         $('#unit_id').val(record.unit_id)
//         $('#building').val(record.building)
//         $('#type').val(record.type)
//         $('#area').val(record.area)
//         $('#rate').val(record.rate)
//         $('#status').val(record.status)
//       }
//     })
// }

// function get_del_id(id){
//     $('#del_id').val(parseInt(id))
// }