@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Edit User</div>
				<div class="card-body">
					{{Form::open(['route'=>['editUser', 'id' =>$data->id], 'method' => 'POST'])}}
					@csrf
					<div class="form-group">
						<label class="col-md-4 control-label" for="val-username">Name<span class="text-danger">*</span></label>

						{{Form::text('name', $data->name, ['placeholder'=>'Name', 'class'=>'form-control', 'rows'=>'6','required'])}}

					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="val-email">Email<span class="text-danger">*</span></label>

						{{Form::text('email', $data->email, ['placeholder'=>'abc@gmail.com', 'class'=>'form-control', 'rows'=>'6','required'])}}

					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="val-password">Password<span class="text-danger">*</span></label>

						{{Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control'))}}

					</div>
					<div class="form-group">
						<div class="col-md col-md-offset-4">
							<a href="{{route('viewUser')}}" class="btn btn-sm btn-danger" type="submit">Back</a>
							<button class="btn btn-sm btn-primary" type="submit">Submit</button>
						</div>
					</div>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection