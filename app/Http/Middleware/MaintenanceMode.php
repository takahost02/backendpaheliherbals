<?php

namespace App\Http\Middleware;

use App\Constants\Status;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        // Always allow maintenance page itself
        if ($request->is('maintenance')) {
            return $next($request);
        }

        // Check maintenance flag
        if (gs('maintenance_mode') == Status::ENABLE) {

            // API requests → JSON response
            if ($request->is('api/*')) {
                return response()->json([
                    'remark'  => 'maintenance_mode',
                    'status'  => 'error',
                    'message' => [
                        'error' => ['Our application is currently in maintenance mode']
                    ]
                ], 503);
            }

            // Web requests → Redirect to maintenance route
            return redirect('/maintenance');
        }

        return $next($request);
    }
}
