<?php

namespace Instagram;

class Url extends \Url {
	
	static public function hasQuery($url) {
		return (bool)strpos('?', $url);
	}

}