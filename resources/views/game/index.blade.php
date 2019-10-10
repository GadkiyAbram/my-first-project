@extends('layouts.app')

@section('title', 'Game')

@section('content')
	<div class="row">
		<div class="col-12">
			<h2>Game</h2>
			<p>You won:  {{ $prize }}, and {{ $giftSelected }}</p>
			<p>Remains:  </p>
			<ul>
				@foreach($giftsArray as $gift)
					<div>{{ $gift }}</div>
				@endforeach
			</ul>
		</div>
		<div>Final Prize: {{ $finalPrize }}</div>
	</div>

@endsection