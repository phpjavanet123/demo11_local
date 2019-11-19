<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //POSTMAN header: Accept: application/json
        //We will not create own exception class and check here like:
        //if ($exception instanceof ModelNotFoundException) {response()->json(..., getHTTPCode());}
        // or set by static codes. Let's all exeption for now will have status code: 404 - NOT FOUND, user, exchangecurrency

        //Some issue with apiResource error responses - so we disable it and will not process
        if ($request->wantsJson()) {
            /*
            return response()->json([
                'data' => $exception->getMessage()
            ], 404);

            //problem to find header CODE!!!!!!
            */
            //print_r($exception->getMessage());
            //print_r($exception->errors());
            //print_r($exception->getStatusCode());
            //die('s');

            //WE FOUND STATUS
            //$exception = $this->prepareException($exception);
            //print_r($exception->status);
            //die('s');
        }
        return parent::render($request, $exception);
    }
}
