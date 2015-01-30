<?php

namespace KirbyGram;

class Instagram {

	protected $_config = [];

	function __construct() {

		$config = $this->load_config();	

		if(!$config){
			$this->set_config([
				'installed' => false,
				'csrf' => uniqid()
			]);
			$this->save_config();
		}
	}

	public function is_installed(){
		return $this->get_config('installed');
	}

	protected function set_config($options){
		if(!$options){
			return false;
		}

		foreach($options as $key => $val){
			$this->_config[$key] = $val;
		}
	}

	public function get_config($key = false){
		if($key){
			return $this->_config[$key];
		} else {
			return $this->_config;
		}
	}

	public function load_config(){

		$result = \f::load(__DIR__ . '../../config.txt');

		$this->set_config($result ? $result : []);

		return $this->get_config();
	}

	public function save_config(){
		return \f::write(__DIR__ . '../../config.txt', $this->_config);
	}


}


?>