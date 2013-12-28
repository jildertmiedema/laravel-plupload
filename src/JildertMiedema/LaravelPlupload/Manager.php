<?php namespace JildertMiedema\LaravelPlupload;

use Illuminate\View\Compilers\CompilerInterface;

class Manager {

    public function make ()
    {
        return (new Builder)->make();
    }

    public function receive($name, closure $receiver)
    {
        $response = [];
        $response['jsonrpc'] = "2.0";

        if (Input::file($name)) {
            $receiver(Input::file($name));
        }

        return $response;
    }
}