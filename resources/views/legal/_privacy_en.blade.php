@php
  $email = config('portfolio.admin_email');
  $legalName = config('portfolio.legal.operator_name') ?: config('portfolio.seo.brand_name');
  $inn = config('portfolio.legal.operator_inn');
  $ogrnip = config('portfolio.legal.operator_ogrnip');
  $updated = config('portfolio.legal.policy_updated') ?: now()->format('d.m.Y');
@endphp

<h1 class="legal-doc__h1">Privacy policy</h1>
<p class="legal-doc__meta">{{ __('legal.common.updated', ['date' => $updated]) }}</p>

<p>This policy describes how information is handled when you use the website at <strong>{{ parse_url(url('/'), PHP_URL_HOST) ?? 'this site' }}</strong> (the “Site”) operated by sole proprietor (ИП) <strong>{{ $legalName }}</strong> (the “Operator”).</p>

<p>For personal data processing details, see the <a class="legal-doc__a" href="{{ route('legal.personal_data') }}">Personal data processing policy</a>. If you contact us from Russia, processing is primarily governed by Federal Law No. 152-FZ. If this English text conflicts with the Russian version, the Russian version prevails for Russian users.</p>

<h2>1. Data we may process</h2>
<p>The Site has <strong>no public lead/contact forms</strong>. Contact happens via outbound links to messengers and email. While you browse, technical data (IP, browser, language, session/cookies) may be processed for operation and security. Testimonials may show a client’s name, role, quote, and photo when published by the Operator.</p>

<h2>2. Cookies</h2>
<p>The Site may use cookies or browser storage for preferences (e.g. language). Third-party analytics are not enabled in this policy version. You can restrict cookies in browser settings; some features may not work as intended.</p>

<h2>3. Third-party services</h2>
<p>Hosting providers may process technical data under contract. Messenger providers process messages under their own terms. See the <a class="legal-doc__a" href="{{ route('legal.personal_data') }}">Personal data processing policy</a>.</p>

<h2>4. Your rights</h2>
<p>Depending on applicable law, you may have rights to access, correct, delete, or restrict processing, and to object to certain processing. Russian data subjects’ rights under 152-FZ are described in the <a class="legal-doc__a" href="{{ route('legal.personal_data') }}">Personal data processing policy</a>.</p>

<h2>5. Contact / Operator</h2>
<p><strong>ИП {{ $legalName }}</strong></p>
@if($ogrnip)<p>OGRNIP: {{ $ogrnip }}</p>@endif
@if($inn)<p>INN: {{ $inn }}</p>@endif
<p>E-mail: <a class="legal-doc__a" href="mailto:{{ $email }}">{{ $email }}</a></p>

<h2>6. Changes</h2>
<p>We may update this policy. The current version is always published on this page.</p>
