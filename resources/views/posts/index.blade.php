@extends('layouts.app')

@section('content')
	<div class="content">
	<h1></h1>
		<div>Posts page</div>
		@if(count($posts) > 0)
			@foreach($posts as $post)
			<div class="well">
				<h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
				<small>{{$post->created_at}} by {{$post->user->name}}</small>
			</div>
			@endforeach
			{{$posts->links()}}
		@else
			<p>No posts found</p>
		@endif
	</div>
@endsection
