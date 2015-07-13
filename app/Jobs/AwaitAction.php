<?php namespace App\Jobs;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Log;
use App\Services\SocialManager;

class AwaitAction extends Job implements SelfHandling, ShouldQueue
{
	use InteractsWithQueue, SerializesModels;

	private $log;

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function handle()
	{
		$social = new SocialManager(app());
		$market = $this->log->market;
		$confirm = $social->with($market->provider)->check($market, $this->log->user);
		$this->log->flag = $confirm;
		$this->log->save();
		if($confirm) {
			$job->delete();
		} else {
			$job->release(20);
		}
	}
}
