<?php

class Instagram {

	protected $_config = array();

	function __construct() {

		$config = $this->load_config();	

		if(!$config){
			$this->set_config(array(
				'installed' => false,
				'csrf' => uniqid()
			));
			$this->save_config();
		}
	}

	public function is_installed(){
		return $this->get_config('installed');
	}

	public function set_config($options){
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

		$result = \f::read(__DIR__ . '/../config.json', 'json');

		$this->set_config($result ? json_decode($result) : array());

		return $this->get_config();
	}

	public function save_config(){
		return \f::write(__DIR__ . '/../config.json', json_encode($this->_config));
	}

	public function check_cache($type){
		$cache_path = __DIR__ . '/../cache/' . $type . '.json';

		if(\f::exists($cache_path)){
			$cache = json_decode(\f::read($cache_path, 'json'));
			if($cache->to < time()){
				return false;
			} else {
				return $cache->payload;
			}
		} else {
			return false;
		}
	}

	public function set_cache($type, $result){
		$cache_path = __DIR__ . '/../cache/' . $type . '.json';

		$period = c::get('kg.cache_period') ? c::get('kg.cache_period') : '30 Minutes';
		$cache = array('to' => strtotime($period), 'payload' => $result);
		\f::write($cache_path, json_encode($cache));
	}

	public function feed(){

		$query = new \Instagram\Query('feed', '/users/' . $this->get_config('uid') . '/media/recent', $this);
		return new \Instagram\Feed($query);

	}

	public function liked(){
		$liked = $this->check_cache('liked');
		if(!$liked){
			$liked = \Instagram\Remote::get('https://api.instagram.com/v1/users/self/media/liked', array(
				'data' => array(
					'access_token' => $this->get_config('token')
				)
			));
			$this->set_cache('liked', $liked->content);
			$liked = $liked->content;
		}
		return new \Instagram\Liked(json_decode($liked)->data);
	}

	static function text_format($content){
		preg_match("/@[a-z0-9][a-z0-9\-_\.]*/", $content, $users);
		if($users){
			foreach($users as $user){
				$content = str_replace($user, '<a href="http://instagram.com/'.str_replace('@', '', $user).'">'. $user.'</a>', $content);
			}
		}
		return $content;
	}

}
?>