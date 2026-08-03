@php
  $email = config('portfolio.admin_email');
  $legalName = config('portfolio.legal.operator_name') ?: config('portfolio.seo.brand_name');
  $inn = config('portfolio.legal.operator_inn');
  $ogrnip = config('portfolio.legal.operator_ogrnip');
  $updated = config('portfolio.legal.policy_updated') ?: now()->format('d.m.Y');
@endphp

<h1 class="legal-doc__h1">Personal data processing policy</h1>
<p class="legal-doc__meta">{{ __('legal.common.updated', ['date' => $updated]) }}</p>

<p>This document describes how sole proprietor (ИП) <strong>{{ $legalName }}</strong> (the “Operator”) processes personal data in connection with the website at <strong>{{ parse_url(url('/'), PHP_URL_HOST) ?? '' }}</strong> (the “Site”).</p>

<p><strong>Applicable law.</strong> For users in the Russian Federation, Federal Law No. 152-FZ applies. This English text is for convenience; the Russian version prevails for Russian users.</p>

<h2>1. Operator</h2>
<p><strong>ИП {{ $legalName }}</strong></p>
@if($ogrnip)<p>OGRNIP: {{ $ogrnip }}</p>@endif
@if($inn)<p>INN: {{ $inn }}</p>@endif
<p>E-mail: <a class="legal-doc__a" href="mailto:{{ $email }}">{{ $email }}</a></p>

<h2>2. Data we process</h2>
<p>No public HTML lead forms are available on the Site. We may process: technical/session data; data you send voluntarily via messengers or email; testimonial data (name, role, quote, photo) published on the Site.</p>

<h2>3. Purposes and legal bases</h2>
<p>We process data to operate and secure the Site, publish portfolio/testimonials, respond to inquiries, prepare contracts when requested, and comply with law. Bases include consent (where required), steps prior to a contract at your request, and legitimate interests where permitted.</p>

<h2>4. Recipients and transfers</h2>
<p>Hosting/IT providers may process data under agreements. Messenger operators process communications under their own terms (cross-border processing possible). See <a class="legal-doc__a" href="https://telegram.org/privacy" target="_blank" rel="noopener noreferrer">Telegram’s privacy policy</a>.</p>

<h2>5. Retention</h2>
<p>We keep data only as long as needed for the purposes above, unless a longer period is required by law.</p>

<h2>6. Your rights</h2>
<p>Subject to applicable law (including 152-FZ for Russian data subjects), you may request access, rectification, deletion/restriction, object to certain processing, and withdraw consent where processing is consent-based. Contact: <a class="legal-doc__a" href="mailto:{{ $email }}">{{ $email }}</a>.</p>

<p>See also the <a class="legal-doc__a" href="{{ route('legal.privacy') }}">Privacy policy</a>.</p>
