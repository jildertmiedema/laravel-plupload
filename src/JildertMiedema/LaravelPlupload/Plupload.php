<?php

namespace JildertMiedema\LaravelPlupload;

use Illuminate\Config\Repository as Config;

class Plupload
{
        /**
         * Config Instance.
         *
         * @var Illuminate\Config\Repository
         */
        protected $config;

        /**
         * Constructor.
         *
         * @param  Illuminate\Config\Repository $config
         */
        public function __construct(Config $config)
        {
            $this->config = $config;
        }

    /**
     * Get a plupload configuration option.
     *
     * @param string $option
     *
     * @return mixed
     */
    public function getConfigOption($option)
    {
        return $this->config->get("laravel-plupload::plupload.{$option}");
    }

    public function getDefaultView()
    {
        return $this->getConfigOption('view');
    }
}
