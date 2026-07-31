@php
  $pricing = $cms['pricing'] ?? [];
  $plansJs = [];
  foreach (($pricing['plans'] ?? []) as $plan) {
      $key = $plan['key'] ?? '';
      if ($key === '') {
          continue;
      }
      $plansJs[$key] = [
          'title' => $plan['title'] ?? '',
          'sub' => $plan['sub'] ?? '',
          'highlight' => $plan['hi'] ?? '',
          'priceHtml' => $plan['price_html'] ?? '',
          'points' => array_values($plan['points'] ?? []),
      ];
  }
@endphp
<script>
window.PORTFOLIO_I18N = {
  brandAriaAbout: @json(__('site.brand.aria_open')),
  assets: { check: @json(asset('assets/icons/pricing/check.svg')) },
  pricing: @json($plansJs),
};
</script>
