@extends('layouts.app')

@section('content')

<div class="container">
	<h1>{{$category->name}}</h1>
	<h4>{{$category->description}}</h4>

	<br>

	<div class="row">
		<div class="col-md-8">

			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>task name</th>
						<th>solved by</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($category->tasks as $task)
						<tr>
							<td>{{$task->id}}</td>
							<td>{{$task->title}}</td>
							<td>0</td>
							<td><a href="{{ url('task/' . $task->id ) }}" class="btn btn-default">solve</a></td>
						</tr>

					@empty


					@endforelse
				</tbody>
			</table>

		</div>
	</div>
</div>

@endsection