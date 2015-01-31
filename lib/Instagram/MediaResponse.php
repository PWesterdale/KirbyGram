<?php

namespace Instagram;

abstract class MediaResponse {

	protected $_data = [];
	protected $_limit = false;
	protected $_offset = 0;
	protected $_only = false;

	function __construct($feed){
		$this->_data = $feed;
	}

	function offset($offset){
		$this->_offset = $offset;
		return $this;
	}

	function limit($limit){
		$this->_limit = $limit - 1;
		return $this;
	}

	function only($limiter){
		if($limiter == 'video' || $limiter == 'image'){
			$this->_only = $limiter;
		}
		return $this;
	}

	function get(){

		$images = [];

		if($this->_only){
			$this->_data = array_filter($this->_data, function($media) {
    			return ($media->type == $this->_only);
			});

			// Re-index the array to remove any leftover keys
			$this->_data = array_values($this->_data);
		}

		if($this->_limit !== false){
			if($this->_limit == 0){
				return new Media($this->_data[0]);
			} else {
				for($x = $this->_offset; $x <= $this->_limit; $x++){
					if(isset($this->_data[$x])){
						$images[] = new Media($this->_data[$x]);
					} else {
						break;
					}
				}
			}
		} elseif($this->_offset){
			$images = array_walk($this->_data, function($media){
				return new Media($media);
			});
			$images = array_splice($images, 0, $this->_offset);
		} else {
			$images = array_walk($this->_data, function($media){
				return new Media($media);
			});
		}

		return $images;

	}

}