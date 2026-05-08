@php
  $name = config('portfolio.seo.brand_name');
  $email = config('portfolio.admin_email');
@endphp

<h1 class="legal-doc__h1">Privacy policy</h1>
<p class="legal-doc__meta">{{ __('legal.common.updated', ['date' => now()->format('d.m.Y')]) }}</p>

<p>This policy describes how information is handled when you use the website at <strong>{{ parse_url(url('/'), PHP_URL_HOST) ?? 'this site' }}</strong> (the “Site”) operated by <strong>{{ $name }}</strong> (the “Operator”).</p>

<p>For personal data processing (including forms), the <a class="legal-doc__a" href="{{ route('legal.personal_data') }}">Personal data processing policy</a> applies. If you contact us from Russia, processing of your personal data is primarily governed by Russian law, including Federal Law No. 152-FZ “On Personal Data”.</p>

<h2>1. Data we may collect</h2>
<p>We do not require registration to browse the Site. If you submit a form, you choose what to provide (e.g. name, phone, Telegram username, message). Technical data (such as IP address, browser type, language preference) may be processed by hosting/software as needed for security and operation.</p>

<h2>2. Cookies</h2>
<p>The Site may use cookies or browser storage for preferences (e.g. language). You can restrict cookies in your browser settings; some features may not work as intended.</p>

<h2>3. Third-party services</h2>
<p>Form submissions may be delivered via messaging APIs (e.g. Telegram). Those services process data under their own terms. See the <a class="legal-doc__a" href="{{ route('legal.personal_data') }}">Personal data processing policy</a> for details.</p>

<h2>4. Your rights</h2>
<p>Depending on applicable law, you may have rights to access, correct, delete, or restrict processing of your personal data, and to object to certain processing. For Russian data subjects, rights under Federal Law No. 152-FZ are described in the <a class="legal-doc__a" href="{{ route('legal.personal_data') }}">Personal data processing policy</a>.</p>

<h2>5. Contact</h2>
<p><strong>{{ $name }}</strong><br>
E-mail: <a class="legal-doc__a" href="mailto:{{ $email }}">{{ $email }}</a></p>

<h2>6. Changes</h2>
<p>We may update this policy. The current version is always published on this page.</p>
