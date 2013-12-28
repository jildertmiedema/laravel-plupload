<?php

use Mockery as m;

use JildertMiedema\LaravelPlupload\Builder;

class BuilderTest extends PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        Mockery::close();
    }

    public function testGetContainer()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);

        $container = $builder->getContainer('test');

        $this->assertEquals('<div id="test-container"><button type="button" id="test-browse-button" class="btn btn-primary">Browse...</button><button type="button" id="test-start-upload" class="btn btn-success">Upload</button></div>', $container);
    }

    public function testAddScripts()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);

        $result = $builder->addScripts('test');

        $this->assertEquals('<script type="text/javascript" src="/packages/jildertmiedema/laravel-plupload/assets/js/plupload.full.min.js"></script>', $result);
    }


    public function testCreateJsInit()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);

        $result = $builder->createJsInit('test', []);

        $this->assertEquals('var test_uploader = new plupload.Uploader([]);', $result);
    }

    public function testCreateJsRun()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);

        $result = $builder->createJsRun('test');

        $this->assertEquals('test_uploader.init();document.getElementById(\'test-start-upload\').onclick = function() {test_uploader.start();};', $result);
    }

}