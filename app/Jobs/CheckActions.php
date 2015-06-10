<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckActions extends Job implements SelfHandling, ShouldQueue
{
	use InteractsWithQueue, SerializesModels;

	public function __construct()
	{
		//
	}

	public function handle()
	{
		//
	}
}
