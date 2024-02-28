$(document).ready( function () {
    $('#tbl_records').DataTable();

    function get_all() {
        $('#tbl_div').empty()

        $.ajax({
        type: 'POST',
        url: "/admin/amenities/add",
        headers: {
            'X-CSRFToken': ''
        },
        success: function (res) {
            var code = res.code
            var records = res.records

            var tbl = $('<table>').addClass('table table-hover w-100')
            tbl.attr('id', 'tbl_records')

            var thead = $('<thead>')
            var thr = $('<tr>')
            thr.append($('<th>').text('Name'))
            thr.append($('<th>').text('Type'))
            thr.append($('<th>').text('Picture'))
            thr.append($('<th>').text('Action'))
            thead.append(thr)
            tbl.append(thead)

            var tbody = $('<tbody>')
            $.each(records, function(row, field) {
                var tr = $('<tr>')
                tr.append($('<td>').text(field.name))
                tr.append($('<td>').text(field.type))
                tr.append($('<td>').text(field.picture))

                var td_action = $('<td>')
                tr.append(td_action)

                var i_edit = $('<i>')
                i_edit.attr({
                    'class' : 'fa fa-pencil',
                    'title' : "Edit",
                    'onclick' : `get_upd_id(${field.user_id})`,
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
                    'onclick' : `get_del_id(${field.user_id})`,
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

});