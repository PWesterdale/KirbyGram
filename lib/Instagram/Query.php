<?php

namespace Instagram;

class Query {

	protected $apiUrl = 'https://api.instagram.com/v1';
	protected $name;
	protected $igInstance;
	protected $response;
	protected $page = 1;
	protected $content = array();

	public function __construct($name, $endPoint, $instagram)
	{
		$this->name = $name;
		$this->endPoint = $endPoint;
		$this->igInstance = $instagram;
	}

	public function get()
	{
		$this->response = $this->igInstance->check_cache($this->name);

		if(!$this->response){
			$this->response = \Instagram\Remote::get($this->apiUrl . $this->endPoint, array(
				'data' => array(
					'access_token' => $this->igInstance->get_config('token'),
					'count' => 20
				)
			));
		}

		$this->content = json_decode($this->response->content);

		//echo '<pre>' . json_encode($this->response->content, JSON_PRETTY_PRINT) . '</pre>';
		
		$this->igInstance->set_cache($this->name, $this->response);
		
		$this->parsePagination();
		return $this->content->data;
	}

	public function getNext()
	{
		if(!property_exists($this->pagination, 'next_url')){
			return false;
		}

		$this->response = \Instagram\Remote::get($this->pagination->next_url);

		if($this->response){
			$this->content = json_decode($this->response->content);
			$this->page++;
			$this->parsePagination();
			//echo '<pre>' . json_encode($this->content, JSON_PRETTY_PRINT) . '</pre>';
			return true;
		} else {
			return false;
		}
	
	}

	public function getData()
	{
		return $this->content->data;
	}

	public function parsePagination()
	{
		$content = $this->response->content;
		$this->pagination = json_decode($content)->pagination;
	}

}