<div class="modal fade" id="boostModal" tabindex="-1" role="dialog" aria-labelledby="boostModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="boostModalLabel">Boost Post</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-groups-bordered">
					<input type="hidden" name="post_id">
					<div class="well">
						<div class="post-preview"></div>
						<br style="clear: both;">
					</div>

					<p>@lang('trade.boost_instructions')</p>
				
					<div class="row">
						@foreach(config("adsocial.actions.$provider") as $action => $settings)
						<div class="col-sm-6">
							<label>
								<b>{{ trans("trade.actions.$action") }}</b>
								<div class="input-spinner">
									<button type="button" class="btn btn-default"><i class="fa fa-minus"></i></button>
									<input type="text" name="{{ $action }}" class="form-control" placeholder="{{ trans('trade.reward') }}" value="{{ $settings['default'] }}">
									<button type="button" class="btn btn-default"><i class="fa fa-plus"></i></button>
								</div>
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