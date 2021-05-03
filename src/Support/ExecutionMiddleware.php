<?php

declare(strict_types = 1);
namespace Rebing\GraphQL\Support;

use Closure;

abstract class ExecutionMiddleware
{
    /**
     * @param string|mixed $query
     * @param array<mixed>|mixed $args
     * @return Closure|array<mixed>
     */
    public function handle($query, $args, Closure $next)
    {
        return $next($query, $args);
    }

    /**
     * @param array<string,mixed> $arguments
     * @return Closure|array<mixed>
     */
    public function resolve(array $arguments, Closure $next)
    {
        return $this->handle(...$arguments, ...[
            function (...$arguments) use ($next) {
                return $next($arguments);
            },
        ]);
    }
}
