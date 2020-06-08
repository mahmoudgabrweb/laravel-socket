<?php 

namespace App\Traits;

use App\Logger;

trait LoggerTrait {

	private $type, $method;

	public function store_log($id, $log) { 
		$logger = new Logger;
		$logger->instance_type = $this->type;
		$logger->instance_method = $this->method;
		$logger->reference_id = $id;
		$logger->log = $log;
		$logger->user_id = \Auth::id();
		$logger->save();
	}
}