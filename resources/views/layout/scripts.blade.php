<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="{{ asset('vendor.js') }}"></script>
<script type="text/javascript">

@yield('js')

$(function() {
  var form = $('#postModal form');
  var modal = $('#postModal');

  modal.find('.btn.submit').click(function() {
    $.post(form.attr('action'), form.serialize(), function() {
      window.location.reload()
    });
  });

  modal.find('textarea').on('keyup', function() {
    var l = this.value.length;
    var m = false;
    if(modal.find("select[name='provider']").val() == 'twitter') m = l > 140;
    $('#charcount').text(l).css('color', (m ? 'red' : ''));
  });

  modal.on('show.bs.modal', function (e) {
    var id = $(e.relatedTarget).data('id')
    modal.find("select[name='provider']").attr('disabled', !!id)
    modal.find("input[name='id']").val(id)
    if(id) $.ajax({
  		url: '/api/v1/post/' + id,
  		complete: function(d) {
  			var data = d.responseJSON
  			form.find('[name]').each(function() {
          var k = $(this).attr('name');
          switch(k) {
            case 'schedule_date':
              $(this).val(moment(data.posted_at).format('MM/DD/YYYY'))
              break;
            case 'schedule_time':
              $(this).val(moment(data.posted_at).format('HH:MM'))
              break;
            case 'categories[]':
              $(this).val($.map(data.categories, function(c) { return c.id })).trigger('change')
              break;
            default:
  				    $(this).val(data[k])
              break;
          }
          if(k == 'text') $(this).trigger('keyup')
  			})
  		}
    });
  }).on('hidden.bs.modal', function (e) {
    form[0].reset();
  });
});
</script>
