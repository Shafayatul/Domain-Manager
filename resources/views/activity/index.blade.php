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
                                        <td>ID</td>
                                        <td>Log Name</td>
                                        <td>Description</td>
                                        <td>Subject Id</td>
                                        <td>Subject Type</td>
                                        <td>Causer Td</td>
                                        <td>Causer Type</td>
                                        <td>Properties</td>
                                        <td>Created At</td>
                                        <td>Updated At</td>
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
            processing: true,
            serverSide: true,
            ajax: '{{ url("/datatable/activity/index") }}',
            columns: [
                {data: 'id', name: 'activity_log.id'},
                {data: 'log_name', name: 'activity_log.log_name'},
                {data: 'description', name: 'activity_log.description'},
                {data: 'subject_id', name: 'activity_log.subject_id'},
                {data: 'subject_type', name: 'activity_log.subject_type'},
                {data: 'causer_id', name: 'activity_log.causer_id'},
                {data: 'causer_type', name: 'activity_log.causer_type'},
                {data: 'properties', name: 'activity_log.properties'},
                {data: 'created_at', name: 'activity_log.created_at'},
                {data: 'updated_at', name: 'activity_log.updated_at'}
            ],
            error: function (xhr, status, error) {
                console.log(error.responseTextss);
            }
        });

    }); 
</script>
    
@endsection