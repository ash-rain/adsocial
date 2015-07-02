<div class="modal fade" id="shortlinkModal" tabindex="-1" role="dialog" aria-labelledby="shortlinkModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="shortlinkModalLabel">@lang('app.shorten')</h4>
			</div>
			<div class="modal-body">
				<div class="form-horizontal form-groups-bordered">
						<div class="form-group">
							<label class="col-sm-3 control-label">@lang('app.shorten_url')</label>
							<div class="col-sm-9">
								<input type="url" name="url" class="form-control">
							</div>
						</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.cancel') }}</button>
				<button type="button" class="submit btn btn-primary" data-dismiss="modal">
					{{ trans('app.shorten') }}
				</button>
			</div>
		</div>
	</div>
</div>
