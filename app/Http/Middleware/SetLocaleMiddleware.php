<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Supponendo che tu abbia un campo 'locale' nel tuo modello User
        if (auth()->check()) {
            $locale = auth()->user()->locale; // Ottieni la lingua dell'utente
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
