<?php

/*
 * Share button element addon for Bear CMS
 * https://github.com/bearcms/share-button-element-addon
 * Copyright (c) Amplilabs Ltd.
 * Free to use under the MIT license.
 */

BearFramework\Addons::register('bearcms/share-button-element-addon', __DIR__, [
    'require' => [
        'bearcms/bearframework-addon',
        'ivopetkov/social-sharing-bearframework-addon'
    ]
]);
