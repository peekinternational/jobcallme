@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Gifts Detail</span>
                </h1>
            </div>
			<div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>#</th>
										<th>User Name</th>
                                        <th>User Email</th>
										<th>User Phone Number</th>
										<th>Token Number</th>
										<th>Created Date</th>
                                        
                                    </thead>
                                     <tbody>
                                        @foreach($gift as $i => $job)
										
                                            <tr>
                                                <td>{{ $i+1 }}</td>
												<td>{!! $job->username!!}</td>
                                                <td>{!! $job->useremail !!}</td>
                                                <td>{!! $job->userphone !!}</td>
												<td>{!! $job->token_num!!}</td>
                                                <td>{!! $job->created_at!!}</td>
												
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <?php echo $gift->render(); ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection