<?php

namespace KirbyGram;

class Instagram {

	protected $_config = [];

	function __construct() {
		$this->load_config();	
	}

	public function load_config(){

		$filename = __DIR__ . '../../config/details.txt';

		if(\f::exists($filename)){
			$this->set_config(['installed' => true]);
		} else {
			$this->set_config(['installed' => false]);
		}

	}

	public function is_installed(){
		return $this->get_config('installed');
	}

	protected function set_config($options){
		foreach($options as $key => $val){
			$this->_config[$key] = $val;
		}
	}

	public function get_config($key){
		return $this->_config[$key];
	}


}


?>