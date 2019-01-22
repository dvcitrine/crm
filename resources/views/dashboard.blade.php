@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					@if(count($posts) > 0)
                    <h3>Your Posts</h3>
					<table class="table table-striped">
					<th>Title</th>
					<th></th>
					<th></th>
					
						@foreach($posts as $post)
						<tr>
							<td>{{$post->title}}</td>
							<td><a href="/posts/{{$post->id}}/edit">Edit</a></td>
							<td>	
								{!! Form::open(['action' => ['PostsController@destroy',$post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
									{{Form::hidden('_method', 'DELETE')}}
									{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
								{!! Form::close() !!}
							</td>
						</tr>
						@endforeach
					</table>
					@else
						<h3>No Posts</h3>
					@endif
					<a href="/posts/create" class="btn btn-primary">Create post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
