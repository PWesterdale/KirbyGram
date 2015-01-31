<?php

namespace Instagram;

class Remote extends \Remote {

	static public function get($url, $params = array()) {

		$defaults = array(
			'method' => 'GET',
			'data'   => array(),
		);

		$options = array_merge($defaults, $params);
		$query   = http_build_query($options['data']);

		if(!empty($query)) {
			$url = (\Instagram\Url::hasQuery($url)) ? $url . '&' . $query : $url . '?' . $query;
		}

		// remove the data array from the options
		unset($options['data']);

		$request = new self($url, $options);
		return $request->response();

	}

}