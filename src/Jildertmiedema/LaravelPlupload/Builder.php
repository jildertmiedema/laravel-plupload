<?php namespace Jildertmiedema\LaravelPlupload;

use Illuminate\View\Compilers\CompilerInterface;

class Builder {

    /**
     * Plupload Instance
     *
     * @var Plupload
     */
    protected $plupload;

    /**
     * Constructor
     *
     * @param  Plupload $plupload
     * @return void
     */
    public function __construct()
    {
        //Plupload $plupload
        //$this->plupload = $plupload;
    }

    public function createJsInit($prefix, array $settings)
    {
        return sprintf('var %s_uploader = new plupload.Uploader(%s);', $prefix, json_encode($settings));
    }

    public function createJsRun($prefix)
    {
        $script = sprintf('%s_uploader.init();', $prefix);
        $script .= sprintf('document.getElementById(\'%s-start-upload\').onclick = function() {%s_uploader.start();};', $prefix, $prefix);

        return $script;
    }

    public function addScripts()
    {
        $scriptUrl = '/packages/jildertmiedema/' . 'laravel-plupload/assets/js/plupload.full.min.js';
        return sprintf('<script type="text/javascript" src="%s"></script>', $scriptUrl);
    }

    public function getContainer($prefix)
    {
        $html = "<div id=\"{$prefix}-container\">";
        $html .= "<button type=\"button\" id=\"{$prefix}-browse-button\" class=\"btn btn-primary\">Browse...</button>";
        $html .= "<button type=\"button\" id=\"{$prefix}-start-upload\" class=\"btn btn-success\">Upload</button>";
        $html .= "</div>";

        return $html;
    }

    public function createHtml($prefix, array $settings)
    {
        $html = '';
        $html .= $this->getContainer($prefix);
        $html .= $this->addScripts();
        $html .= '<script type="text/javascript">';
        $html .= $this->createJsInit($prefix, $settings);
        $html .= $this->createJsRun($prefix);
        $html .= '</script>';

        return $html;
    }

    public function make()
    {
        $prefix = 'upload1';
        $settings = [];
        $settings['runtimes'] = 'html5';
        $settings['browse_button'] = $prefix.'-browse-button';
        $settings['container'] = $prefix.'-container';
        $settings['max_file_size'] = '10000000000';
        $settings['url'] = '?';

        return $this->createHtml($prefix, $settings);
    }
}