laravel-plupload
================

Laravel plupload support.

Handeling chunked uploads.

## Installation

Composer add

```json
	"require": {
		// ...

        "jildertmiedema/laravel-plupload": "dev-master"
    },
```

Changes `app.config`

```php
	'providers' => array(
		// ...

		'JildertMiedema\LaravelPlupload\LaravelPluploadServiceProvider',
	)
```


And:

```php
    'aliases' => array(
        // ...
        'Plupload'        => 'JildertMiedema\LaravelPlupload\Facades\Plupload',
    ),
```

To publish the assets:

```sh
	php artisan asset:publish "jildertmiedema/laravel-plupload"
```
## Receiving files

Use this route to receive a file on the url `/upload`. Of cource you can place this is a controller.

```php
Route::post('/upload', function()
{
	return Plupload::receive('file', function ($file)
	{
		$file->move(storage_path() . '/test/', $file->getClientOriginalName());

		return 'ready';
	});
});
```

## Sending files

There are 3 ways to send files with this plugin.

### 1. Use default plupload html

Use the [examples](http://www.plupload.com/examples/) found on the plupload site.


### 2. Simple plupload builder
To use the builder for creating send form you can use this function:

```php
	echo Plupload::make([
		'url' => 'upload',
		'chunk_size' => '100kb',
	]);
```

**Note:** The options given to the make function are found on in the [pluload documentation](http://www.plupload.com/docs/Options).


### 2. Extended plupload builder

```php
	echo Plupload::init([
		'url' => 'upload',
		'chunk_size' => '100kb',
	])->withPrefix('current')->createHtml();
```


## Alternatives

Other packages supporting plupload:

* [fojuth/plupload](https://github.com/fojuth/plupload)
