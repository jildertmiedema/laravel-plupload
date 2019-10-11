<?php

use JildertMiedema\LaravelPlupload\Builder;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testGetContainer()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);
        $builder->setPrefix('test');

        $container = $builder->getContainer();

        $this->assertEquals('<div id="test-container"><button type="button" id="test-browse-button" class="btn btn-primary">Browse...</button><button type="button" id="test-start-upload" class="btn btn-success">Upload</button></div>', $container);
    }

    public function testAddScripts()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);

        $result = $builder->addScripts();

        $this->assertEquals('<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/plupload.full.min.js"></script>', $result);
    }

    public function testCreateJsInit()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);
        $builder->setPrefix('test');

        $result = $builder->createJsInit();

        $this->assertStringContainsString('var test_uploader = new plupload.Uploader({', $result);
    }

    public function testCreateJsRun()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);
        $builder->setPrefix('test');

        $result = $builder->createJsRun();

        $this->assertEquals('test_uploader.init();document.getElementById(\'test-start-upload\').onclick = function() {test_uploader.start();};', $result);
    }

    public function testGetSettings()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);

        $result = $builder->getSettings();

        $this->assertTrue(is_array($result));
    }

    public function testUpdateSettings()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);
        $builder->updateSettings(['a' => 'b']);

        $result = $builder->getSettings();

        $this->assertEquals('b', $result['a']);
    }

    public function testSetPrefix()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);
        $builder->setPrefix('abcd');

        $result = $builder->getSettings();

        $this->assertEquals('abcd-browse-button', $result['browse_button']);
        $this->assertEquals('abcd-container', $result['container']);
    }

    public function testSetScriptUrl()
    {
        $plupload = m::mock('JildertMiedema\LaravelPlupload\Plupload');

        $builder = new Builder($plupload);
        $builder->setPrefix('abcd');
        $builder->setScriptUrl('path/to/plupload.js');

        $html = $builder->createHtml();

        $this->assertEquals('<div id="abcd-container"><button type="button" id="abcd-browse-button" class="btn btn-primary">Browse...</button><button type="button" id="abcd-start-upload" class="btn btn-success">Upload</button></div><script type="text/javascript" src="path/to/plupload.js"></script><script type="text/javascript">var abcd_uploader = new plupload.Uploader({"runtimes":"html5","browse_button":"abcd-browse-button","container":"abcd-container","url":"\/upload","headers":{"Accept":"application\/json","X-CSRF-TOKEN":"test-token"}});abcd_uploader.init();document.getElementById(\'abcd-start-upload\').onclick = function() {abcd_uploader.start();};</script>', $html);
    }
}
