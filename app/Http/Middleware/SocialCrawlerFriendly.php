<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Telegram/WA/etc. часто ломают preview на Laravel-страницах с Set-Cookie.
 * Статика (tg-preview-test.html) без cookies — ок; / с session+XSRF — нет.
 */
class SocialCrawlerFriendly
{
    /** @var list<string> */
    private const UA_NEEDLES = [
        'TelegramBot',
        'Twitterbot',
        'facebookexternalhit',
        'Facebot',
        'LinkedInBot',
        'WhatsApp',
        'Slackbot',
        'Discordbot',
        'VKShare',
        'OdklBot',
        'SkypeUriPreview',
        'redditbot',
        'Viber',
        'Pinterest',
        'Applebot',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->isCrawler($request)) {
            return $next($request);
        }

        $request->attributes->set('social_crawler', true);
        // array → StartSession не пишет session-cookie
        config(['session.driver' => 'array']);

        $response = $next($request);

        $response->headers->remove('Set-Cookie');
        $response->headers->set('Cache-Control', 'public, max-age=600');

        return $response;
    }

    private function isCrawler(Request $request): bool
    {
        $ua = (string) $request->userAgent();
        if ($ua === '') {
            return false;
        }

        foreach (self::UA_NEEDLES as $needle) {
            if (stripos($ua, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}
