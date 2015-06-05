@extends('app')

@section('content')

<div class="container">

{!! Form::model($user, ['url' => action('UserController@update', $user->id), 'method' => 'PATCH']) !!}

<h2>{{ $user->points }}</h2>


<div class="form-group">
	{!! Form::label('name') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('email') !!}
	{!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

@foreach($user->oauth_data as $provider)
<div>
	{{ $provider->provider }}
	{{ $provider->user_data->id }}
	{{ $provider->user_data->nickname }}
	{{ $provider->user_data->name }}
	{{ $provider->user_data->email }}
	<img src="{{ $provider->user_data->avatar }}">
</div>
@endforeach

{!! Form::close() !!}

</div>

@stop