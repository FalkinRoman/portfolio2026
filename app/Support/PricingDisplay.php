<?php

namespace App\Support;

class PricingDisplay
{
    /** HTML строка цены для карточки прайса (RU: ₽ из lang, EN: $ из config) */
    public static function priceLineHtml(string $plan): string
    {
        if (! app()->isLocale('en')) {
            return match ($plan) {
                'mobile' => __('site.pricing.mobile_price'),
                default => __('site.pricing.web_price'),
            };
        }

        $usd = (int) match ($plan) {
            'mobile' => config('portfolio.pricing.mobile_usd_from', 4_000),
            default => config('portfolio.pricing.web_usd_from', 2_000),
        };
        $usd = max(1, $usd);
        $withCurrency = '$'.number_format($usd, 0, '.', ',');

        return __('site.pricing.price_usd_line', ['amount' => $withCurrency]);
    }
}
