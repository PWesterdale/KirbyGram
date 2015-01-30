<?php
	

if(!class_exists('KirbyGram/Instagram')){
	require_once('lib/instagram.php');
}

$instagram = new \KirbyGram\Instagram();
$kirby = $this;

$this->options['routes'][] = array(
	'pattern' => 'kirbygram/install',
	'method'  => 'GET',
	'action'  => function($path = null) use($instagram, $kirby) {

		if(!$instagram->is_installed()){

			return f::load(__DIR__.'/templates/install.php');
			
		} else {
			die('hurr durr nerr');
		}

	}
);

$this->options['routes'][] = array(
	'pattern' => 'kirbygram/done',
	'method'  => 'GET',
	'action'  => function($path = null) {
		
		// Handle Complete

	}
);

$this->options['routes'][] = array(
	'pattern' => 'kirbygram/complete',
	'method'  => 'POST',
	'action'  => function($path = null) use($instagram) {
		if(!$instagram->is_installed()){

			//write to cache
			$data = $_POST;
			$data['referrer'] = r::referer();

			f::write(__DIR__.'/cache/latest.json', $data);

			exit;

		} else {
			die('hurr durr nerr');
		}

	}
);



?>