<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class ForceToHttps
{ 

    public function handle(Request $request, Closure $next): Response
{
    // Cek semua kemungkinan domain ngrok
    if (str_contains($request->getHost(), 'ngrok-free.app')) {
        URL::forceScheme('https');
        
        // Untuk memastikan proxy di-handle dengan benar
        $request->server->set('HTTPS', 'on');
        $request->headers->set('X-Forwarded-Proto', 'https');
    }
    
    // Fallback untuk semua request non-ngrok
    if (!$request->isSecure()) {
        URL::forceScheme('https');
    }

    return $next($request);
}
  
    }