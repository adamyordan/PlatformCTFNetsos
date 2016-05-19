@extends('layouts.app')

@section('content')

<br><br><br><br>
<div class="ui container">

	<h1 class="ui header">
	<a href="{{ url('/contest/' . $contest->id) }}"><i class="fa fa-arrow-left"></i>  {{$contest->name}}</a>
	</h1>
	<!-- <h4>{{$contest->description}}</h4> -->

	<div class="ui grid">
		<div class="ten wide column">

			@if(isset($status))
			    @if($status == 0)
					<div class="ui negative message">
						<i class="close icon"></i>
						<div class="header">
							Flag Mismatch!
						</div>
						<p>You submit the wrong flag.</p>
					</div>
			    @else
					<div class="ui positive message">
						<i class="close icon"></i>
						<div class="header">
							Correct Flag!
						</div>
						<p>You solve this challenge.</p>
					</div>
			    @endif
			@endif
			
			<div class="ui segment">
				<h4 class="ui header"> {{$task->category->name}}</h4>

				<h2 class="ui header">
					{{$task->title}}
					@if(Auth::user()->hasSolvedAndGraded($task))
						<span class="ui teal tag label">solved</span>
					@elseif(Auth::user()->hasSolved($task))
						<span class="ui tag label">solved</span>
					@endif
				</h2>
				<p>{{$task->description}}</p>

				<form action="{{ url('/contest/' . $contest->id . '/task/' . $task->id) }}" method="POST" class="ui form">
                    {!! csrf_field() !!}
                    {!! method_field('PUT') !!}
                    <div class="field">
						<input name="answer" class="form-control" placeholder="insert flag here">
                    </div>
					<button class="ui button" type="submit">submit</button>
				</form>
			</div>

		</div>

		<div class="six wide column">
			<h3 class="ui header">Solved by</h3>
			<table class="ui table">
				<thead>
					<th>#</th>
					<th>time</th>
					<th>username</th>
				</thead>
				<tbody>
					<?php $index = 0 ?>
					@foreach ($task->getSolver($contest) as $solver)
						<?php $index++ ?>
						<tr>
							<td>{{$index}}</td>
							<td>{{$solver->added_time}}</td>
							<td>
								{{$solver->getUser()->username}}
								@if ($index <= 3)
									<a class="ui green circular label">{{$index}}</a>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

</div>

@endsection