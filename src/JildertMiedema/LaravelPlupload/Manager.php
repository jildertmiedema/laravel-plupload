<?php namespace JildertMiedema\LaravelPlupload;

use Input;
use Closure;
use Illuminate\Http\Request;
use Illuminate\View\Compilers\CompilerInterface;

class Manager {

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function make (array $settings = null)
    {
        return Builder::make($settings);
    }

    public function receive($name, Closure $receiver)
    {
        $response = [];
        $response['jsonrpc'] = "2.0";

        if ($this->request->file($name)) {
            $result = $receiver($this->request->file($name));

            $response['result'] = $result;
        }

        return $response;
    }
}