@extends('main')
@section('title' , '| Index')
@section('content')

<div class = "row">
	<div class = "col-md-10">
		<h1>All Posts</h1>
	</div>
	<div class = "col-md-2">
		<a href = "{{route('posts.create')}}" class = "btn btn-primary btn-block btn-lg btn-h1-spacing">Create New Post</a>	
	</div>
	
	<div class = "col-md-12">
		 <hr>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<table class = "table">
			<thead>
				<th>#</th>
				<th>Title</th>
				<th>Body</th>
				<th>Created At</th>
				<th>Controls</th>
			</thead>
			<tbody>
				@foreach ($posts as $post)
					<tr>
						<th>{{ $post->id }}</th>
						<td>{{ $post->title }}</td>
						<td>{{ substr($post->body, 0 , 50) }} {{ strlen($post->body) > 50 ? "..." : "" }}</td>
						<td>{{ date('M j. Y h:ia',strtotime($post->created_at)) }}</td>
						<td>
							{!! Html::linkRoute('posts.show' , 'View' , array($post->id) , array('class' => 'btn btn-primary')) !!}
							
							{!! Html::linkRoute('posts.edit' , 'Edite' , array($post->id) , array('class' => 'btn btn-success')) !!}
							
								
							
						</td>
					</tr>
					
				@endforeach
			</tbody>
		</table>
		<div class = "text-center">
			{!! $posts->links() !!}
		</div>
	</div>
</div>
@endsection