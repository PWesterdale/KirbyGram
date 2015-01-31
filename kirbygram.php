<?php
	
if(!class_exists('Instagram')){
	require_once('lib/instagram.php');
}
if(!class_exists('\Instagram\MediaResponse')){
	require_once('lib/media_response.php');
}
if(!class_exists('\Instagram\Feed')){
	require_once('lib/feed.php');
}
if(!class_exists('\Instagram\Liked')){
	require_once('lib/liked.php');
}
if(!class_exists('\Instagram\Media')){
	require_once('lib/media.php');
}
if(!class_exists('\Instagram\Remote')){
	require_once('lib/remote.php');
}
if(!class_exists('\Instagram\Url')){
	require_once('lib/url.php');
}


$instagram = new Instagram();
$kirby = $this;

$this->options['routes'][] = array(
	'pattern' => 'kirbygram/install',
	'method'  => 'GET',
	'action'  => function($path = null) use($instagram, $kirby) {

		if(!$instagram->is_installed()){

			return f::load(__DIR__.'/templates/install.php', ['instagram' => $instagram]);
			
		} else {
			die('hurr durr nerr');
		}

	}
);

$this->options['routes'][] = array(
	'pattern' => 'kirbygram/done',
	'method'  => 'GET',
	'action'  => function($path = null) use($instagram) {

		if($instagram->is_installed()){
			return f::load(__DIR__.'/templates/complete.php', ['instagram' => $instagram]);
		} else {
			return f::load(__DIR__.'/templates/error.php', ['instagram' => $instagram]);
		}

	}
);

$this->options['routes'][] = array(
	'pattern' => 'kirbygram/complete',
	'method'  => 'POST',
	'action'  => function($path = null) use($instagram) {
		if(!$instagram->is_installed()){

			//write to cache
			$data = $_POST;

			if($data['kgt'] == $instagram->get_config('csrf')){

				if($data['token'] && $data['user']){
					$instagram->set_config([
						'token' => $data['token'],
						'user' => $data['user'],
						'installed' => true
					]);
				}

				$instagram->save_config();

			}

			exit;

		} else {
			die('hurr durr nerr');
		}

	}
);



?>