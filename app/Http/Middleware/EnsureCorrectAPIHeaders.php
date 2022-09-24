<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCorrectAPIHeaders
{
    private array $exceptRoutes;

    public function __construct()
    {
        $this->exceptRoutes = array_values([
            route('home'),
            route('docs'),
            route('spec')
        ]);
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!empty(array_intersect($this->exceptRoutes, [$request->url()]))) {
            return $next($request);
        }

        if ($request->headers->get('Accept') !== 'application/vnd.api+json') {
            return $this->addCorrectContentType(response('', Response::HTTP_NOT_ACCEPTABLE));
        }

        if ($request->isMethod(Request::METHOD_POST)
            || $request->isMethod(Request::METHOD_PATCH)) {
            if ($request->headers->get('Content-Type') !== 'application/vnd.api+json') {
                return $this->addCorrectContentType(response('', Response::HTTP_UNSUPPORTED_MEDIA_TYPE));
            }
        }

        return $this->addCorrectContentType($next($request));
    }

    private function addCorrectContentType(Response $response): Response
    {
        $response->headers->set('Content-Type', 'application/vnd.api+json');

        return $response;
    }
}
