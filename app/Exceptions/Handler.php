<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function handleApiExceptions($request, $exception){
        if($exception instanceof ModelNotFoundException){
            return response()->json(['error'=>'Model Not Found'], 404);
            // return \response()->json(['error'=>'Model Not Found'], 404,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE);
        }
        
        // Si no es para una API nos devuelve en formato html => For Web
        return parent::render($request, $exception);

    }

    public function render($request, Exception $exception)
    {
        // El objeto request tiene una funcion, si la app tiene los encabezados Application/JSON
        // dd(null);
        if($request->expectsJson()){
            return $this->handleApiExceptions($request, $exception);
        }
        return parent::render($request, $exception);
    }
}
