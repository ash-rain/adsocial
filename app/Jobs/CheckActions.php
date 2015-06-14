<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Services\SocialManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckActions extends Job implements SelfHandling, ShouldQueue
{
	use InteractsWithQueue, SerializesModels;

	public function __construct()
	{
		$this->social = new SocialManager(app());
	}

	public function handle($job, $data)
	{
		dd($data);
		if ($this->attempts() > 3) {
		}
		$market = $data['log']->marketItem;
		var_dump($market);
		$ok = $this->social->with($market->provider)
			->check($market->action, $market->id, $data['log']->user);
		dd($ok);
	}
}
