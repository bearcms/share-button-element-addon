<?php

/*
 * Share button element addon for Bear CMS
 * https://github.com/bearcms/share-button-element-addon
 * Copyright (c) Amplilabs Ltd.
 * Free to use under the MIT license.
 */

use BearFramework\App;

$app = App::get();

$app->bearCMS->addons
        ->register('bearcms/share-button-element-addon', function(\BearCMS\Addons\Addon $addon) use ($app) {
            $addon->initialize = function() use ($app) {
                $context = $app->contexts->get(__DIR__);

                $context->assets->addDir('assets');

                $app->localization
                ->addDictionary('en', function() use ($context) {
                    return include $context->dir . '/locales/en.php';
                })
                ->addDictionary('bg', function() use ($context) {
                    return include $context->dir . '/locales/bg.php';
                });

                \BearCMS\Internal\ElementsTypes::add('shareButton', [
                    'componentSrc' => 'bearcms-share-button-element',
                    'componentFilename' => $context->dir . '/components/shareButtonElement.php',
                    'fields' => [
                        [
                            'id' => 'url',
                            'type' => 'textbox'
                        ]
                    ]
                ]);

                \BearCMS\Internal\Themes::$elementsOptions['shareButton'] = function($context, $idPrefix, $parentSelector) {
                    $group = $context->addGroup(__('bearcms/share-button-element-addon/Share button'));
                    $group->addOption($idPrefix . "ShareButtonCSS", "css", '', [
                        "cssOutput" => [
                            ["rule", $parentSelector . " .bearcms-share-button-element-button", "box-sizing:border-box;cursor:pointer;display:inline-block;text-decoration:none;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:100%;"],
                            ["selector", $parentSelector . " .bearcms-share-button-element-button"]
                        ],
                        "value" => '{"background-color":"#3374ce","border-top":"1px solid #3169c4","border-right":"1px solid #3169c4","border-bottom":"1px solid #3169c4","border-left":"1px solid #3169c4","font-size":"12px","font-family":"Arial","font-weight":"bold","height":"33px","line-height":"32px","padding-left":"10px","padding-right":"10px","color":"#ffffff","border-top-left-radius":"2px","border-top-right-radius":"2px","border-bottom-left-radius":"2px","border-bottom-right-radius":"2px"}'
                    ]);

                    $groupContainer = $group->addGroup(__("bearcms/share-button-element-addon/Container"));
                    $groupContainer->addOption($idPrefix . "ShareButtonContainerCSS", "css", '', [
                        "cssTypes" => ["cssPadding", "cssMargin", "cssBorder", "cssRadius", "cssShadow", "cssBackground", "cssSize", "cssTextAlign"],
                        "cssOutput" => [
                            ["rule", $parentSelector . " .bearcms-share-button-element", "box-sizing:border-box;"],
                            ["selector", $parentSelector . " .bearcms-share-button-element"]
                        ]
                    ]);
                };
            };
        });
