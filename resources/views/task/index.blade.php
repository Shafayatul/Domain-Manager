@extends('layouts.app')


@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Tasks</h2>
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-borderless"  id="users-table">
                                <thead>
                                    <tr>
                                        <td>Due Date</td>
                                        <td>Assign To</td>
                                        <td>Domain</td>
                                        <td>Type</td>
                                        <td>Status</td>
                                        <td>Description</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>

                            </table>
                        </div>                     
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
    </section>
@endsection



@section('footer-script')
<script type="text/javascript">
    $(function(){

        
        $('#users-table').DataTable({
            // dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            ajax: '{{ url("/datatable/task/index") }}',
            columns: [
                {data: 'due_date', name: 'tasks.due_date'},
                {data: 'name_assign_to', name: 'users.name'},
                {data: 'domain_name', name: 'tasks.domain_name'},
                {data: 'task_type', name: 'tasks.task_type'},
                {data: 'status', name: 'tasks.status'},
                {data: 'description', name: 'tasks.description'},
                {data: 'action'}
            ]
        });
        
        $(document).on('click', '.ajax_delete', function(){
            var row = $(this).closest("tr");
            var id = $(this).attr('id');
            $.ajax({
                 type:'POST',
                 url:'/task/ajax_delete',
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 data:{
                    'id' : id,
                 },
                 success:function(data){
                    if(data.msg=="Success"){
                       row.remove();
                    }
                 }
            });
        });

    }); 
</script>
    
@endsection