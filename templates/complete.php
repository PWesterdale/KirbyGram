<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>KirbyGram Done!</title>

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
            div.code {
                font-size: 14px;
                background: #FDFDFD;
                border: 1px solid #EFEFEF;
                margin: 0 !important;
                padding: 6px 10px !important;
            }
            code {
                margin: 0;
                padding: 0;
            }
            ul {
                list-style-type: none;
            }
            ul li {
                display: inline-block;
            }

        </style>

    </head>
	<body>

		<h1>Done!</h1>

		<p>Your account is now hooked up and we can start to play with Instagram!</p><br />

        <h2>Feed</h2>
        <ul>
            <? foreach($instagram->feed()->limit(5)->get() as $image): ?>
            <li>
                <img src="<?= $image->thumbnail() ?>" />
            </li>
            <? endforeach; ?>
        </ul>

        <div class="code">
        <? highlight_string('<? foreach($instagram->feed()->limit(5)->get() as $image): ?>   
    <img src="<?= $image->thumbnail() ?>" />
<? endforeach; ?>'); ?>
        </div>

        <h2>Liked</h2>

        <ul>
            <? foreach($instagram->liked()->only('image')->limit(5)->get() as $image): ?>
            <li>
                <img src="<?= $image->thumbnail() ?>" />
            </li>
            <? endforeach; ?>
        </ul>
        
        <div class="code">
        <? highlight_string('<? foreach($instagram->liked()->only("image")->limit(5)->get() as $image): ?>   
    <img src="<?= $image->thumbnail() ?>" />
<? endforeach; ?>'); ?>
        </div>

        <h2>Video</h2>
        <? 
        $video = $instagram->liked()->only('video')->limit(1)->get();
        if($video): 
        ?>
            <video controls>
                <source src="<?= $video->max_video() ?>" type="video/mp4">
            </video>
        <? else : ?>
            <p>You have no liked videos</p>
        <? endif ?>

        <div class="code">
<? highlight_string('<? $video = $instagram->liked()->only("video")->limit(1)->get();
if($video): 
?>
<video width="320" height="240" controls>
    <source src="<?= $video->max_video() ?>" type="video/mp4">
</video>
<? else : ?>
    <p>You have no liked videos</p>
<? endif ?>'); ?>
        </div>

	</body>
</html>
