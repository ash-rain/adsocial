<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="postModalLabel">@lang('app.post_new')</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="{{ action('SiteController@postPost') }}" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">@lang('app.provider')</label>
						<div class="col-sm-4">
							<select class="form-control" name="provider">
								@foreach($user->providers as $provider)
								<option value="{{ $provider }}">@lang("app.providers.$provider")</option>
								@endforeach
							</select>
						</div>

						<div class="col-sm-5">
							<div class="date-and-time">
								<input type="text" name="schedule_date" class="form-control datepicker" data-start-date="{{ date('Y-m-d') }}" placeholder="@lang('app.post_schedule')">
								<input type="text" name="schedule_time" class="form-control timepicker" data-template="dropdown" data-show-meridian="false" data-minute-step="5"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">@lang('app.categories')</label>
						<div class="col-sm-9">
							<select name="test" class="select2" multiple>
								<option value="3" >Ohaio</option>
								<option value="2" >Boston</option>
								<option value="5" >Washington</option>
								<option value="1" >Alabama</option>
								<option value="4" >New York</option>
								<option value="12" >Bostons</option>
								<option value="11" >Alabama</option>
								<option value="13" >Ohaio</option>
								<option value="14" >New York</option>
								<option value="15" >Washington II</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">@lang('app.post_text')</label>
						<div class="col-sm-9">
							<textarea class="form-control" rows="6"></textarea>
							<p>
								<span id="charcount">0</span>
								@lang('app.characters')
							</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">@lang('app.post_link')</label>
						<div class="col-sm-9">
							<input type="text" class="form-control">
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