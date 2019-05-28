@extends('index')


@section('sidebarmenu')
@include('menu.menuplayer');
@endsection


@section('content')
    <div class="searching bg-blue-dark">
        
        <!-- widget content -->
        <div class="widget-body">

            <form class="form" action="{{ route('Chip-search') }}" method="get" role="search">
                <div class="btn-input-group">
                    <input type="text" name="inputPlayer" class="form-control" placeholder="username">
                </div>
                <div class="btn-input-group">
                    <input type="date" name="inputMinDate" class="form-control">
                </div>
                <div class="btn-input-group">
                    <input type="date" name="inputMaxDate" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>

            </form>

        </div>
        <!-- end widget content -->
    </div>

    <div class="table-aii">
        <div class="table-header">
                Chip Player
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Username</th>
                <th class="th-sm">Action</th>
                <th class="th-sm">Debit</th>
                <th class="th-sm">Credit</th>
                <th class="th-sm">Total</th>
                <th class="th-sm">Timestamp</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                    @foreach ($balancedetails as $bd)

                <tr class="gradeX">
                    <td></td>
                    <td>{{ $bd->username }}</td>
                    <td>{{ $bd->action }}</td>
                    <td>{{ $bd->debit }}</td>
                    <td>{{ $bd->credit }}</td>
                    <td>{{ $bd->total }}</td>
                    <td>{{ $bd->timestamp }}</td>
                    <td></td>

                </tr>


                @endforeach
            </tbody>
          </table>
         
    </div>
<script>
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
      });
</script>
@endsection