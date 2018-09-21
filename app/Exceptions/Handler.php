<?php

namespace App\Exceptions;

use App\Category;
use App\Menu;
use App\NavigationMenu;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        //check if exception is an instance of ModelNotFoundException.
        //or NotFoundHttpException

        if ($exception instanceof ModelNotFoundException or $exception instanceof NotFoundHttpException) {
            // ajax 404 json feedback
            if ($request->ajax()) {
                return response()->json(['error' => 'Não Encontrado'], 404);
            }

            // normal 404 view page feedback
            //return response()->view('errors.404', [], 404, compact('menuNav', 'menuNavegacao', 'categoriaSubCat'));
            return redirect()->route('index');
        }

        return parent::render($request, $exception);
        //return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Usuário não logado'], 401);
        }

        $guard = array_get($exception->guards(), 0);

        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            default:
                $login = 'client.login';
                break;
        }

        return redirect()->guest(route($login));
    }
}
