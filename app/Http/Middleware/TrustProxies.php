<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * Render (comme la plupart des PaaS) termine le HTTPS sur son propre
     * load balancer et transmet les requêtes à l'app en HTTP interne, avec
     * l'en-tête X-Forwarded-Proto. Sans faire confiance à ce proxy, Laravel
     * croit que la requête est en HTTP et génère des URLs (dont les
     * `action` de formulaires) en http:// — d'où l'avertissement navigateur
     * "informations transmises en clair" sur une page pourtant servie en
     * HTTPS.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies = '*';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
