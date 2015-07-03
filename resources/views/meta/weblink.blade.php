@if(isset($item->meta->visits))

<li>
  <i class="fa fa-fw fa-{{ config('br.actions.weblink.visit.icon') }}"></i>
  {{ $item->meta->visits }}
</li>

@endif
