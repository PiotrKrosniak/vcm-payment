@extends('layout.app')
@section('title','Ward Master')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                   <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Ward Master</h4>

                        <div class="heading-elements">
                            <a href="{{ route('wardmaster.create') }}" class="btn bg-blue btn-labeled heading-btn"><b><i class="icon-plus3"></i></b> Create New</a>
                        </div>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">
                    <!-- Basic table -->
                    <div class="panel panel-flat">
                        <table class="table datatable-basic" id="datatable">
                            <thead>
                                <tr>
                                     <th>Ward ID</th>
                                    <th>Ward Name</th>
                                    <th>LGA Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                            @foreach($wards as $ward)

                            <tr>
                            <td> {{ $ward->id }} </td>
                            <td> {{ $ward->ward_name  }}</td>

                            <td> {{ $ward->lga_name  }} </td>
                            <td><a href="{{ route('wardmaster.edit',$ward->id)}}" class="btn btn-primary btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>&nbsp&nbsp
                                            <button class="btn btn-danger btn-icon btn-rounded btn-xs" onclick="deleteit({{$ward->id}})"><i class="icon-trash"></i></button></td>

                            </tr>

                            @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /basic table -->
                    
                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->
@push('footerscript')   
<script type="text/javascript" src="{{ asset('theme/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script>
    $(function() {
    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
    });
    // Basic datatable

    $('.datatable-basic').DataTable();



});
   
</script>
<script>
     // Alert combination
    function deleteit(id){
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax({
                url: "wardmaster"+'/'+id,
                type: 'delete',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_token":"{{ csrf_token() }}"
                },
            });
            $('.datatable-basic').DataTable().draw(false);
            swal("Deleted!", "User has been deleted!", "success");
            }
            else {
                swal({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
            }
        });
    }
</script>   
@endpush  
@endsection