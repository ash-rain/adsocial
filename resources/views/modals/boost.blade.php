<div class="modal fade" id="{{ $provider }}BoostModal" tabindex="-1" role="dialog" aria-labelledby="{{ $provider }}BoostModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="{{ $provider }}BoostModalLabel">@lang('app.boost')</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-groups-bordered">
					<input type="hidden" name="post_id">
					<div>
						<div class="post-preview"></div>
						<br style="clear: both;">
					</div>
					<hr>
					<p>@lang('app.boost_text')</p>
				
					<div class="row">
						@foreach(config("br.actions.$provider") as $action => $settings)
						@if(is_array($settings))
						<div class="col-sm-6">
							<label>
								<b>{{ trans("app.actions.$action") }}</b>
								<div class="input-spinner">
									<button type="button" class="btn btn-default">
										<i class="fa fa-minus"></i>
									</button>
									
									<input type="text" name="{{ $action }}" class="form-control" placeholder="{{ trans('app.noreward') }}" value="{{ $settings['default'] }}" data-min="1" data-mask="decimal">
									
									<button type="button" class="btn btn-default">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</label>
						</div>
						@endif
						@endforeach
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.cancel') }}</button>
				<button type="button" class="submit btn btn-primary" data-dismiss="modal">
					{{ trans('app.boost') }}
				</button>
			</div>
		</div>
	</div>
</div>