<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TrustCloudflareProxies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = Http::get('https://api.cloudflare.com/client/v4/ips');

        if ($response->successful()) {
            $ipv4 = $response->json('result.ipv4_cidrs');
            $ipv6 = $response->json('result.ipv6_cidrs');

            // Gabungkan daftar IP
            $proxies = array_merge($ipv4, $ipv6);

            // Setel daftar IP yang dipercaya
            $request->setTrustedProxies($proxies, Request::HEADER_X_FORWARDED_ALL);
        } else {
            // Tangani kesalahan jika API gagal
            throw new \Exception('Gagal mendapatkan daftar IP dari Cloudflare.');
        }

        return $next($request);
    }
}
