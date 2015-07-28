<?php

namespace Instagram;

abstract class MediaResponse {

	protected $data = array();
	protected $query;
	protected $images;
	protected $limit = false;
	protected $offset = 0;
	protected $only = false;

	function __construct($query){
		$this->query = $query;
		$this->data = $query->get();
		$this->images = array();
	}

	function offset($offset){
		$this->offset = $offset;
		return $this;
	}

	function limit($limit){
		$this->limit = $limit - 1;
		return $this;
	}

	function only($limiter){
		if($limiter == 'video' || $limiter == 'image'){
			$this->only = $limiter;
		}
		return $this;
	}

	function get(){

		$images = array();
		
		if(!$this->data){
			return $images;
		}

		if($this->only){
			$this->data = array_filter($this->data, function($media) {
    			return ($media->type == $this->only);
			});

			// Re-index the array to remove any leftover keys
			$this->data = array_values($this->data);
		}

		if($this->limit !== false){
			if($this->limit == 0){
				return new Media($this->data[0]);
			} else {
				for($x = $this->offset; $x <= $this->limit; $x++){
					if(isset($this->data[$x])){
						$this->images[] = new Media($this->data[$x]);
					} else {
						break;
					}
				}
			}
		} elseif($this->offset){

			foreach($this->data as $media){
				$images[] = new Media($media);
			}

			$this->images = array_splice($images, $this->offset);

		} else {

			$images = array();

			foreach($this->data as $media){
				$this->images[] = new Media($media);
			}

			count($this->images);
			//var_dump($images);

		}

		while((count($this->images) < $this->limit) && $this->query->getNext()){
			$this->data = $this->query->getData();
			$this->get();
			if(count($this->images) > $this->limit){
				array_splice($this->images, ($this->limit + 1));
			}
		}

		return $this->images;

	}

}
