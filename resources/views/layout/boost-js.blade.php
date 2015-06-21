@section('js')
@parent
$(function() {
	var modals = $('.boost.modal')
	modals.find('.submit.btn').on('click', function() {
		$.ajax({
			method: 'POST',
			url: '/api/v1/trade/boost',
			data: modals.find('form').serialize(),
			complete: function(){ window.location.reload() }
		})
	})

	$('[data-post-id]').click(function() {
		var id = $(this).data('post-id')
		modals.find('[name="post_id"]').val(id)
		$.ajax({
			url: '/api/v1/post/details/' + id,
			complete: function(d) {
				var data = d.responseJSON
				modals.find('.post-preview').attr('href', data.link).text(data.text)
				modals.find('input.reward').each(function() {
					var v
					for(var i=0; i<data.market.length; i++) {
						if($(this).attr('name') == data.market[i].action) v = data.market[i].reward
					}
					$(this).val(v)
				})
			}
		})
	})
})
@stop