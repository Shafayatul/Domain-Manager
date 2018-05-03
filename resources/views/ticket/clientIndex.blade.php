@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <div class="row">
                <div class="col-md-12">
                     @if(Session::has('success'))
                        <div class="alert alert-success">
                            <strong>Success!</strong> {{ Session::get('success') }}
                        </div>
                    @endif

                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {{ Session::get('error') }}
                    </div>
                    @endif   

                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <strong>Error!</strong> 
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif


                </div>
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>TASK INFOS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos" id="users-table">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Submission Date</th>
                                            <th>Last Update</th>
                                            <th>Action</th>
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
            ajax: '{{ url("/client/datatable/tickets/index") }}',
            columns: [
                {data: 'subject', name: 'tickets.subject'},
                {data: 'status', name: 'tickets.status'},
                {data: 'created_at', name: 'tickets.created_at'},
                {data: 'updated_at', name: 'tickets.updated_at'},
                {data: 'action'}
            ]
        });
          
    }); 
</script>
    
@endsection