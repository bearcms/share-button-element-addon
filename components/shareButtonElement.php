<?php

use BearFramework\App;

$app = App::get();

$url = (string) $component->url;
if ($url === 'home') {
    $url = $app->urls->get();
} elseif ($url === 'current') {
    $url = $app->urls->get($app->request->path);
}
echo '<div class="bearcms-share-button-element">';
echo '<component src="social-sharing-button" url="' . htmlentities($url) . '" class="bearcms-share-button-element-button"/>';
echo '</div>';
