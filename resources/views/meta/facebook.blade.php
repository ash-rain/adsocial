@if(isset($item->meta->likes->data))

<li>
  <i class="fa fa-fw fa-{{ config('br.actions.facebook.like.icon') }}"></i>
  {{ count($item->meta->likes->data) }}
</li>

@endif
