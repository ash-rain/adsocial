<div class="modal fade" id="boostModal" tabindex="-1" role="dialog" aria-labelledby="boostModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="boostModalLabel">Boost Post</h4>
			</div>
			<div class="modal-body">
				<form class="row">
					<input type="hidden" name="provider">
					<input type="hidden" name="provider_id">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="post panel-body"></div>
						</div>
					</div>
					<div class="col-md-6">
						@foreach(config("adsocial.trade_actions.twitter") as $action => $default)
						<div class="form-group">
							<label>
								<b>{{ trans("trade.$action") }}</b>
								<input type="number" name="{{ $action }}" class="form-control" placeholder="{{ trans('trade.reward') }}" value="{{ $default }}">
								{{ trans('trade.points') }}
							</label>
						</div>
						@endforeach
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.cancel') }}</button>
				<button type="button" class="submit btn btn-primary" data-dismiss="modal">
					{{ trans('trade.boost') }}
				</button>
			</div>
		</div>
	</div>
</div>