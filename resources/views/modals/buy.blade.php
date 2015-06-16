<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="buyModalLabel">@lang('app.buy_points')</h4>
			</div>
			<div class="modal-body">
				<form action="{{ url('/checkout') }}" method="POST">
					<label>
						<b>{{ trans('app.points') }}</b>
						<div class="input-spinner">
							<button type="button" class="btn btn-default"><i class="fa fa-minus"></i></button>
							<input type="text" name="points" class="form-control" value="1000">
							<button type="button" class="btn btn-default"><i class="fa fa-plus"></i></button>
						</div>
					</label>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.cancel') }}</button>
				<button type="button" class="submit btn btn-primary" data-dismiss="modal">
					<i class="fa fa-paypal"></i>
					{{ trans('app.checkout') }}
				</button>
			</div>
		</div>
	</div>
</div>