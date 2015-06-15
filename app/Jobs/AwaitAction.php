<?php namespace App\Jobs;

use App\Services\SocialManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Log;

class AwaitAction extends Job implements SelfHandling, ShouldQueue
{
	use InteractsWithQueue, SerializesModels;

	public function __construct()
	{
		$this->social = new SocialManager(app());
	}

	public function fire($job, $data)
	{
		if($job->attempts() > 8) {
			$job->delete();
		}
		$log = Log::find($data['log']);
		$market = $log->market;
		$confirm = $this->social->with($market->provider)->check($market, $log->user);
		$log->flag = $confirm;
		$log->save();
		if($confirm) {
			$job->delete();
		} else {
			$job->release(20);
		}
	}
}