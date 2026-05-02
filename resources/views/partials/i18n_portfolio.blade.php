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
};
</script>
