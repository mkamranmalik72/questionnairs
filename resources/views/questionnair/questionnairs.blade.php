@extends('layouts.app')
@section('style')
    {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">--}}
    {{--<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" />--}}
    <link href="{{ URL::asset('css/material.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/dataTables.material.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/buttons.dataTables.min.css') }}" rel="stylesheet" />
    <style>
        .mdl-grid{
            width: 100% !important;
        }
        #DataTables_Table_0_length > label{
            float: left;
        }
        #DataTables_Table_0_filter > label{
            float: right;
        }
        #DataTables_Table_0 > tbody > tr > .dataTables_empty{
            text-align: left;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="mdl-grid" >
                <div class="text-right">
                <a href="{{ route('questionnair.create') }}" class="btn btn-success"> Create</a>
                </div>
            </div>
            <div class="table-responsive-md">
                <table class="table datatable mdl-data-table dataTable display">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Number Of Questions</th>
                        <th>Duration</th>
                        <th>Resumeable</th>
                        <th>Published</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($questionnairs->count() > 0)
                        @foreach($questionnairs as $questionnair)
                            <tr>
                                <td>{{ @$questionnair->id }}</td>
                                <td>{{ @$questionnair->name }}</td>
                                <td>{{ @$questionnair->questions->count() }}</td>
                                <td>{{ @$questionnair->duration }}</td>
                                <td>{{ @$questionnair->published }}</td>
                            <tr>
                        @endforeach
                                @else
                        <tr>
                            <td class="text-left">No Questionnairs Found</td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Number Of Questions</th>
                    <th>Duration</th>
                    <th>Resumeable</th>
                    <th>Published</th>
                    <th>Action</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>--}}
    {{--<script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>--}}
    <script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('js/dataTables.material.min.js') }}"></script>

    <script>

        $(document).ready(function() {
            var table = jQuery('.dataTable').DataTable( {
                processing: true,
                serverSide: true,
                language: {
                    processing: "<img height='100px' width='100px' src='{{ url('images/preloader.gif') }}'>"
                },
                "ajax": "{{ route('api.questionnairs') }}",
                columnDefs: [{
                    targets: [5],
                    // className: 'mdl-data-table__cell--non-numeric'
                }],
                columns: [
                    { "data": "id" },
                    { "data": "name" },
                    {
                        "data": "questions_count",
                        "searchable": false
                    },
                    { "data": "duration" },
                    {
                        "data": "resumeable",
                        "searchable": false
                    },
                    {
                        "data": "published",
                        "searchable": false
                    },
                    {
                        "data": "action",
                        "className":      'td-actions text-right',
                        "orderable":      false,
                        "defaultContent": '',
                        "searchable": false
                    }
                ],
                "order": [[1, 'asc']]
            } );

            $('.dataTable tfoot th').each( function () {
                var title = $(this).text();
                if (title.trim() !== 'Number Of Questions' && title.trim() !== 'Action' && title.trim() !== 'Resumeable' && title.trim() !== 'Published' ){
                    $(this).html( '<input type="text" placeholder="Search '+title.trim()+'" />' );
                }
            } );
            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            $('.datatable tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );
        } );

    </script>
@endsection