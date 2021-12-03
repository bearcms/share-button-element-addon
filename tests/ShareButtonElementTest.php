<?php

/*
 * Share button element addon for Bear CMS
 * https://github.com/bearcms/share-button-element-addon
 * Copyright (c) Amplilabs Ltd.
 * Free to use under the MIT license.
 */

/**
 * @runTestsInSeparateProcesses
 */
class ShareButtonElementTest extends BearCMS\AddonTests\PHPUnitTestCase
{
    /**
     * 
     */
    public function testOutput()
    {
        $app = $this->getApp();

        $html = '<bearcms-share-button-element url="https://google.com/"/>';
        $result = $app->components->process($html);

        $this->assertTrue(strpos($result, '<div class="bearcms-share-button-element">') !== false);
        $this->assertTrue(strpos($result, 'https://google.com/') !== false);
    }
}
