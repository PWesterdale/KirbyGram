<?php

namespace Instagram;

class Media {

	protected $_raw;

	function __construct($raw_image){
		$this->_raw = $raw_image;
	}

	function caption(){
		return $this->_raw->caption->text;
	}

	function likes(){
		return $this->_raw->likes->count;
	}

	function tags(){
		return $this->_raw->tags;
	}

	function created($format = 'd/m/Y'){
		return (new \DateTime())->setTimestamp($this->_raw->created_time)->format($format);
	}

	function raw(){
		return $this->_raw;
	}

	function thumbnail(){
		return $this->_raw->images->thumbnail->url;
	}

	function small(){
		return $this->_raw->images->low_resolution->url;
	}

	function max(){
		return $this->_raw->images->standard_resolution->url;
	}

	function small_video(){
		return $this->_raw->videos->low_bandwidth->url;
	}

	function max_video(){
		return $this->_raw->videos->standard_resolution->url;
	}

	function is_video(){
		return ($this->_raw->type == 'video');
	}

	function is_image(){
		return ($this->_raw->type == 'image');
	}

	function link(){
		return $this->_raw->link;
	}

}