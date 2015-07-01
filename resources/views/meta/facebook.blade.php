@if(isset($item->meta->likes->data))

<span class="label label-info">
  <i class="fa fa-fw fa-{{ config('br.actions.facebook.like.icon') }}"></i>
  {{ count($item->meta->likes->data) }}
</span>

@endif
