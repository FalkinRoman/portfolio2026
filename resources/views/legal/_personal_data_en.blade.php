@php
  $name = config('portfolio.seo.brand_name');
  $email = config('portfolio.admin_email');
@endphp

<h1 class="legal-doc__h1">Personal data processing policy</h1>
<p class="legal-doc__meta">{{ __('legal.common.updated', ['date' => now()->format('d.m.Y')]) }}</p>

<p>This document describes how <strong>{{ $name }}</strong> (the “Operator”) processes personal data collected through the website at <strong>{{ parse_url(url('/'), PHP_URL_HOST) ?? '' }}</strong> (the “Site”).</p>

<p><strong>Applicable law.</strong> If you are located in the Russian Federation or contact us from Russia, your personal data is primarily processed in accordance with Federal Law No. 152-FZ “On Personal Data” and other applicable Russian law. This English text is for convenience; in case of discrepancy with the Russian version, the Russian version prevails for Russian users.</p>

<h2>1. Data we process</h2>
<p>Depending on the form you use, we may process: name; phone number; Telegram username; message content; technical data (IP address, browser/language, timestamps).</p>

<h2>2. Purposes and legal bases</h2>
<p>We process data to respond to your request, to deliver form notifications (including via Telegram when configured), to secure the Site, and to comply with legal obligations. Processing is based on your consent (where required), steps prior to a contract at your request, and/or our legitimate interests where permitted by law.</p>

<h2>3. Recipients and transfers</h2>
<p>We may use hosting/IT providers under appropriate agreements. If Telegram (or similar) is used to deliver notifications, data is transmitted to those service operators, which may involve cross-border processing. See <a class="legal-doc__a" href="https://telegram.org/privacy" target="_blank" rel="noopener noreferrer">Telegram’s privacy policy</a>.</p>

<h2>4. Retention</h2>
<p>We keep data only as long as needed for the purposes above, unless a longer period is required by law.</p>

<h2>5. Your rights</h2>
<p>Subject to applicable law (including Russian law for Russian data subjects), you may have the right to access, rectify, delete or restrict processing, object to certain processing, and withdraw consent where processing is consent-based. Contact: <a class="legal-doc__a" href="mailto:{{ $email }}">{{ $email }}</a>.</p>

<h2>6. Contact</h2>
<p><strong>{{ $name }}</strong><br>
E-mail: <a class="legal-doc__a" href="mailto:{{ $email }}">{{ $email }}</a></p>

<p>See also the <a class="legal-doc__a" href="{{ route('legal.privacy') }}">Privacy policy</a>.</p>
