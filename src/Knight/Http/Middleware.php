<?php

namespace Knight\Http;

use Closure;


interface Middleware
{
	public function handle(Request $request, Closure $next): Closure;
}
