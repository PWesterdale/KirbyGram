<?php

namespace Instagram;

class Url extends \Url {
	
	static public function hasQuery($url = NULL) {
		return (bool)strpos('?', $url);
	}

}
