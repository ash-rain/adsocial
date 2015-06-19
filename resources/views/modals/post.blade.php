<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="postModalLabel">@lang('app.new_post')</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="{{ action('SiteController@postPost') }}" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">@lang('app.provider')</label>
						<div class="col-sm-9">
							<input type="text" class="form-control datepicker" data-start-date="-2d" data-end-date="+1w">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">@lang('app.schedule_post')</label>
						<div class="col-sm-9">
							<input type="text" class="form-control datepicker" data-start-date="Today">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">@lang('app.schedule_post')</label>
						<div class="col-sm-9">
							<select name="test" class="select2" data-allow-clear="true" data-placeholder="Select one city...">
								<option></option>
								<optgroup label="United States">
									<option value="1">Alabama</option>
									<option value="2">Boston</option>
									<option value="3">Ohaio</option>
									<option value="4">New York</option>
									<option value="5">Washington</option>
								</optgroup>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					{{ trans('app.cancel') }}
				</button>
				<button type="button" class="btn submit btn-primary" data-dismiss="modal">
					{{ trans('app.save') }}
				</button>
			</div>
		</div>
	</div>
</div>