<?php namespace App\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\User;
use App\Log;

class ScheduleController extends Controller {

	public function __construct(Guard $auth)
	{
		$this->middleware('auth', ['except' => ['store']]);
		$this->middleware('checkUser');
		$this->auth = $auth;
	}

	public function getIndex()
	{
		return view('schedule');
	}
}
