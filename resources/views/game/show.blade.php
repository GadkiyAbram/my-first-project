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
		<div>
			<div>Final Prize: {{ $finalPrize }}</div>
			<div class="pt-3">
				<form action="game" method="GET">

					<button type="submit" class="btn btn-primary">No, I don't need it</button>
					<button type="submit" class="btn btn-primary">Take Prize of {{ $finalPrize }}</button>

				</form>
			</div>
		</div>

	</div>

@endsection