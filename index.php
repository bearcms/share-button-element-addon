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
    ->register('bearcms/share-button-element-addon', function (\BearCMS\Addons\Addon $addon) use ($app) {
        $addon->initialize = function () use ($app) {
            $context = $app->contexts->get(__DIR__);

            $context->assets->addDir('assets');

            $app->localization
                ->addDictionary('en', function () use ($context) {
                    return include $context->dir . '/locales/en.php';
                })
                ->addDictionary('bg', function () use ($context) {
                    return include $context->dir . '/locales/bg.php';
                });

            $type = new \BearCMS\Internal\ElementType('shareButton', 'bearcms-share-button-element', $context->dir . '/components/shareButtonElement.php');
            $type->properties = [
                [
                    'id' => 'url',
                    'type' => 'string'
                ]
            ];
            $type->canStyle = true;
            $type->canImportExport = true;
            \BearCMS\Internal\ElementsTypes::add($type);

            \BearCMS\Internal\Themes::$elementsOptions['shareButton'] = ['v1', function ($options, $idPrefix, $parentSelector, $context, $details) {
                $isElementContext = $context === \BearCMS\Internal\Themes::OPTIONS_CONTEXT_ELEMENT;
                if ($isElementContext) {
                    $optionsGroup = $options;
                    $defaultStyleSelector = '';
                } else {
                    $optionsGroup = $options->addGroup(__('bearcms/share-button-element-addon/Share button'));
                    $defaultStyleSelector = ' .bearcms-element:not([class*="bearcms-element-style-"])';
                    $optionsGroup->details['internalElementSelector'] = [$idPrefix, $parentSelector . " .bearcms-share-button-element"];
                }

                $optionsGroup->addOption($idPrefix . "ShareButtonCSS", "css", '', [
                    "cssOptions" => ["*/hoverState", "*/focusState", "*/activeState", "*/visibilityState", "*/sizeState", "*/screenSizeState", "*/pageTypeState", "*/tagsState"],
                    "cssOutput" => [
                        ["rule", $parentSelector . " .bearcms-share-button-element-button", "box-sizing:border-box;cursor:pointer;display:inline-block;text-decoration:none;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:100%;"],
                        ["selector", $parentSelector . $defaultStyleSelector . "> .bearcms-share-button-element  .bearcms-share-button-element-button"]
                    ],
                    "defaultValue" => '{"background-color":"#3374ce","border-top":"1px solid #3169c4","border-right":"1px solid #3169c4","border-bottom":"1px solid #3169c4","border-left":"1px solid #3169c4","font-size":"12px","font-family":"Arial","font-weight":"bold","height":"33px","line-height":"32px","padding-left":"10px","padding-right":"10px","color":"#ffffff","border-top-left-radius":"2px","border-top-right-radius":"2px","border-bottom-left-radius":"2px","border-bottom-right-radius":"2px"}'
                ]);

                $groupContainer = $optionsGroup->addGroup(__("bearcms/share-button-element-addon/Container"));
                $groupContainer->addOption($idPrefix . "ShareButtonContainerCSS", "css", '', [
                    "cssTypes" => ["cssPadding", "cssMargin", "cssBorder", "cssRadius", "cssShadow", "cssBackground", "cssSize", "cssTextAlign"],
                    "cssOptions" => ["*/hoverState", "*/activeState", "*/visibilityState", "*/sizeState", "*/screenSizeState", "*/pageTypeState", "*/tagsState"],
                    "cssOutput" => [
                        ["rule", $parentSelector . " .bearcms-share-button-element", "box-sizing:border-box;display:flex;"],
                        ["selector", $parentSelector . $defaultStyleSelector . "> .bearcms-share-button-element"]
                    ]
                ]);
            }];
        };
    });
