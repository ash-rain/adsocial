@if(isset($item->meta->retweet_count))

<i class="fa fa-fw fa-{{ config('br.actions.twitter.retweet.icon') }}"></i>
{{ count($item->meta->retweet_count) }}

@endif

@if(isset($item->meta->retweet_count))

<i class="fa fa-fw fa-{{ config('br.actions.twitter.favorite.icon') }}"></i>
{{ count($item->meta->favorite_count) }}

@endif
