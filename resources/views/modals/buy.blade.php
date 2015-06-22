<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="buyModalLabel">@lang('app.buy_points')</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					@foreach(config('br.plans') as $plan => $details)
					<form action="{{ action('CheckoutController@postIndex') }}" method="POST">
						<input type="hidden" name="plan" value="{{ $plan }}">
						<div class="col-sm-4">
							<div class="market-item tile-block tile-aqua" data-plan="{{ $plan }}">
								<div class="tile-header">@lang("app.plans.$plan")</div>
								<div class="tile-content">
									<div>
										<strong>{{ $details['points'] }}</strong>
										@lang('app.points')
									</div>
									<div>
										@if($details['promoDays'])
										{{ $details['promoDays'] }}
										@endif
										{{ trans_choice('app.promo_days', $details['promoDays']) }}*
									</div>
									<div>
										{{ $details['cost'] }}
										{{ config('br.checkout.currency') }}
									</div>
								</div>
								<div class="tile-footer">
									<a href="#" class="btn submit btn-success btn-block">
										<i class="fa fa-check"></i>
										@lang('app.checkout')
									</a>
								</div>
							</div>
						</div>
					</form>
					@endforeach
				</div>
				<div>
					<button type="button" class="btn btn-default pull-right" data-dismiss="modal">
						{{ trans('app.cancel') }}
					</button>
					<p>* @lang('app.promo_text')</p>
				</div>
			</div>
		</div>
	</div>
</div>