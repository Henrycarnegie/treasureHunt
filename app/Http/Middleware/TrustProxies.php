<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class TrustProxies
{
    protected $proxies;
    protected $headers = Request::HEADER_X_FORWARDED_FOR
                        | Request::HEADER_X_FORWARDED_HOST
                        | Request::HEADER_X_FORWARDED_PROTO
                        | Request::HEADER_X_FORWARDED_PORT;

    public function __construct()
    {
        $this->setCloudflareProxies();
    }

    public function handle(Request $request, Closure $next): Response
    {
        $request->setTrustedProxies($this->proxies, $this->headers);

        return $next($request);
    }

    private function setCloudflareProxies()
    {
        $response = Http::get('https://api.cloudflare.com/client/v4/ips');

        if ($response->successful()) {
            $ipv4 = $response->json('result.ipv4_cidrs');
            $ipv6 = $response->json('result.ipv6_cidrs');

            $this->proxies = array_merge($ipv4, $ipv6);
        } else {
            throw new \Exception('Gagal mendapatkan daftar IP dari Cloudflare.');
        }
    }
}
