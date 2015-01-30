<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>KirbyGram Install</title>

        <link rel="stylesheet" href="/assets/css/main.css">

        <style>
        	.btn {
        		background: #222;
        		color: #fff;
        		display: inline-block;
        		padding: 10px;
        	}

        	.btn:hover {
        		background: red;
        		color: #fff;
        	}
        </style>

    </head>
	<body>
		<h1>Hello!</h1>
		<p>Welcome to KirbyGram, a small plugin that allows you to display items from your instagram feed in Kirby.
			Before you continue there are a few things you need to know.<br /><br />
			To gain access to your feed you will need to authorise your account with the 'Kirby - Your Feed' instagram application authored by myself
			<a href="https://twitter.com/PaulWesterdale">(Paul Westerdale)</a>.
			<br /><br />
			The Kirby - Your Feed application is written in such a way that I do not store your credentials, so although the application has rights to access your image feed, 
			I do not store the Access Token required to do so.
			<br /><br />
			This access token is stored on <strong>Your</strong> hosting environment and is entirely <strong>Your</strong> responsibility.
			The access token only has permission to <strong>read</strong> so nothing destructive can be acheieved with it.
		</p>
		<br />
		<h3>I get it! Let's go!</h3>
		<a class="btn" href="http://kirbygram.threadstud.io/auth.php?origin=<?= server::get('HTTP_HOST') ?>&kgt=<?= $instagram->get_config('csrf') ?>">Authorize</a>
	</body>
</html>
