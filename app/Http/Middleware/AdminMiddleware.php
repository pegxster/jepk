<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Non authentifié.'], 401);
            }
            return redirect()->route('admin.login');
        }

        /** @var \App\Models\User $adminUser */
        $adminUser = Auth::guard('admin')->user();

        if (!$adminUser->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Accès non autorisé.'], 403);
            }
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')
                ->with('error', 'Ce compte n\'a pas les droits administrateur.');
        }

        // Rend le guard admin le guard par défaut pour toute cette requête
        // (toutes les views peuvent utiliser auth()->user() normalement)
        Auth::shouldUse('admin');

        return $next($request);
    }
}
