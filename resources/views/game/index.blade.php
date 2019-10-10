@extends('layouts.app')

@section('title', 'Result')

@section('content')
	<div>Hello, {{ Auth::user()->name }}, you have {{ Auth::user()->profile->bonus_count }} bonuses</div>
	<div class="pt-2">
		<form action="game/show" method="GET">

			<button type="submit" class="btn btn-primary">Play Game</button>

		</form>
	</div>

@endsection