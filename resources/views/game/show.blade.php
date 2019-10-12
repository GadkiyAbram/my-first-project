@extends('layouts.app')

@section('title', 'Game')

@section('content')
	<div class="row">

		<div>
			<div>You won: {{ $finalPrize }}</div>
			{{--<div>You won: @php--}}

				{{--$finalPrizeIndex = rand(0, count($finalPrizeArray) - 1);--}}
				{{--$finalPrize = $finalPrizeArray[$finalPrizeIndex];--}}
				{{--if ($finalPrizeIndex == 0){echo $finalPrize . ' USD';}--}}
				{{--else if ($finalPrizeIndex == 1){echo $finalPrize;}--}}
				{{--else {echo $finalPrize . ' bonuses';}--}}

				{{--@endphp</div>--}}
			<div class="pt-3 d-flex">
				<form class="pr-3" action="/game">
					<button type="submit" class="btn btn-primary">No, I don't need it</button>
				</form>
				<form action="/game/update" method="POST">
					@method('PATCH')
					@csrf
					<button type="submit" class="btn btn-primary">Take Prize of {{ $finalPrize }}</button>
					<input type="hidden" name="finalPrize" value="{{ $finalPrize }}"/>
				</form>
			</div>
		</div>

	</div>

@endsection