@php
  $sameAs = array_values(array_filter([
    'https://t.me/falroman',
    config('portfolio.seo.same_as_threads'),
    config('portfolio.seo.same_as_instagram'),
    config('portfolio.seo.same_as_telegram'),
  ], fn ($u) => is_string($u) && filter_var($u, FILTER_VALIDATE_URL)));
@endphp
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'Person',
  'name' => config('portfolio.seo.brand_name'),
  'url' => url('/'),
  'image' => asset(config('portfolio.seo.default_og_image')),
  'email' => config('portfolio.admin_email'),
  'jobTitle' => 'Web & Mobile Developer',
  'sameAs' => count($sameAs) ? $sameAs : ['https://t.me/falroman'],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
