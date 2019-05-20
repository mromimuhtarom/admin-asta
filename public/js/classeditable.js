$(document).ready(function() {
    $('table.display').DataTable();

} );
table = $('#dt-material-checkbox').dataTable({

    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
        }],
        select: {
        style: 'os',
        selector: 'td:first-child'
        },
    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".deleteuseradmin").click(function(e) {
            e.preventDefault();

              // $("#btnDeleteGroup").attr('data-pk',$(this).data('pk'));
            var id = $(this).attr('data-pk');
            var test = $("#userid").val(id);
        });

        $('.usertext').editable({
            mode :'popup'
        });


        $('.category').editable({
            //value: 'drink',
            source: [
              {value: 'drink', text: 'Drink'},
              {value: 'food', text: 'Food'},
              {value: 'emoji', text: 'Emoji'},
            ]
        }); 
        
    }
    });