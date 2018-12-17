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
							<th>Action</th>
					</thead>

					<tbody>
						<?php $i=1; ?>
						@foreach($users as $key=>$data)
						<tr>
							<td align="center">{{$i++}}</td>
							<td class="">{{$data->name}}</td>
							<td class="hidden-xs hidden-sm">{{ $data->email}}</td>
							<td class="text-center">
							<form name ="frmdelete" action="{{route('deleteUser',['id'=>$data->id])}}" method="POST">
								<a href="{{route('viewEditUser',['id' =>$data->id])}}" class="btn btn-sm btn-success push-5-r push-10" type="button"><i class="fa fa-eye"></i>View</a>

						         <input type="hidden" name="_method" value="DELETE">
						         <input type="hidden" name="_token" value="{{ csrf_token() }}">
						         <button type="submit" class="btn btn-sm btn-danger push-5-r push-10" onclick="return myFunction()"><i class="fa fa-times"></i> Delete</button>
  
							</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function myFunction()
	{
		var r = confirm('Are you sure want to delete record?');

		if(r == true)
		{
			document.frmdelete.submit();
			return true;
		}

		else
			return false;
	}
</script>
@endsection