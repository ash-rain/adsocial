<?php namespace App\Providers;

use Queue;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Log;

class EventServiceProvider extends ServiceProvider {

	protected $listen = [
		'App\Events\PlanWasPurchased' => [
			'App\Listeners\PromoteUserPosts',
		],
	];

	public function boot(DispatcherContract $events)
	{
		parent::boot($events);
		/*Queue::failing(function($connection, $job, $data)
		{
			$log = Log::find($data['log']);
			if($log) {
				$log->delete();
			}
		});*/
	}

}
