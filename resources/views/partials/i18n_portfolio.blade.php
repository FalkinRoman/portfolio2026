<script>
window.PORTFOLIO_I18N = {
  brandAriaAbout: @json(__('site.brand.aria_open')),
  assets: { check: @json(asset('assets/icons/pricing/check.svg')) },
  pricing: {
    web: {
      title: @json(__('site.pricing.web_title')),
      sub: @json(__('site.pricing.web_sub')),
      highlight: @json(__('site.pricing.web_hi')),
      priceHtml: @json(\App\Support\PricingDisplay::priceLineHtml('web')),
      points: @json(trans('site.pricing_points.web')),
    },
    mobile: {
      title: @json(__('site.pricing.mobile_title')),
      sub: @json(__('site.pricing.mobile_sub')),
      highlight: @json(__('site.pricing.mobile_hi')),
      priceHtml: @json(\App\Support\PricingDisplay::priceLineHtml('mobile')),
      points: @json(trans('site.pricing_points.mobile')),
    },
  },
  leads: {
    contactOk: @json(__('site.leads.contact_ok')),
    contactErr: @json(__('site.leads.contact_err')),
    contactRate: @json(__('site.leads.contact_rate')),
    newsOk: @json(__('site.leads.news_ok')),
    newsErr: @json(__('site.leads.news_err')),
    newsRate: @json(__('site.leads.news_rate')),
    telegramErr: @json(__('site.leads.telegram_err')),
    csrfErr: @json(__('site.leads.csrf_err')),
    networkErr: @json(__('site.leads.network_err')),
  },
};
</script>
