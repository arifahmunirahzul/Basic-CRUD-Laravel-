@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">User Management</div>
				<div class="card-body">
					<div class="text-right">
						<a href="{{route('viewAddUser')}}" class="btn btn-sm btn-success push-5-r push-10" type="button"><i class="fa fa-eye"></i>Add New User</a>
					</div>
					<br>
				<table class="table table=bordered table-striped js-dataTable-full">
					<thead>
							<th class="text-center"></th>
							<th>Name</th>
							<th class="hidden-xs">Email</th>
					</thead>

					<tbody>
						<?php $i=1; ?>
						@foreach($users as $key=>$data)
						<tr>
							<td align="center">{{$i++}}</td>
							<td class="">{{$data->name}}</td>
							<td class="hidden-xs hidden-sm">{{ $data->email}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection