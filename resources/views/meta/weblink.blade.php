@if(isset($item->meta->visits))

<span class="label label-info">
  <i class="fa fa-fw fa-{{ config('br.actions.weblink.visit.icon') }}"></i>
  {{ $item->meta->visits }}
</span>

@endif
