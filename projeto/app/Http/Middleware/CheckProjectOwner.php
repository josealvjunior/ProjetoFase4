<?php

namespace project\Http\Middleware;

use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use project\Repositories\ProjectsRepository;

class CheckProjectOwner
{
    /**
     * @var ProjectsRepository
     */
    public function __construct(ProjectsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        return $next($request);
    }
}
