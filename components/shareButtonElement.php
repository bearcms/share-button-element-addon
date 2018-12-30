<?php

use BearFramework\App;

$app = App::get();
$context = $app->context->get(__FILE__);

$url = (string) $component->url;
if ($url === 'home') {
    $url = $app->urls->get();
} elseif ($url === 'current') {
    $url = $app->urls->get($app->request->path);
}
echo '<component src="social-sharing-button" url="' . htmlentities($url) . '" class="bearcms-share-button-element"/>';
