$(document).ready(function() {
    $('table.display').DataTable();

} );
table = $('#dt-material-checkbox').dataTable({

    columnDefs: [{
    orderable: false,
    responsive: true,
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