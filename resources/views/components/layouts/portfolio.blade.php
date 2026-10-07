@props([
    'title' => 'Ivan Almadin — UI/UX Designer & Full-Stack Developer',
    'description' => null,
    'pageCss' => null,
    'pageJs' => null,
    'active' => '',
    'bodyClass' => 'portfolio-page',
    'showHeader' => true,
    'showFooter' => true,
    'footerCopyright' => '© 2025 Ivan Kim Almadin. All rights reserved.'
])
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="color-scheme" content="light">
  <meta name="theme-color" content="#0a1610">
  <title>{{ $title }}</title>
  @if ($description)
    <meta name="description" content="{{ $description }}">
  @endif
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/components/site-footer.css') }}">
  @if ($pageCss)
    <link rel="stylesheet" href="{{ asset($pageCss) }}">
  @endif
</head>
<body @class([$bodyClass])>
  @if ($showHeader)
    <x-site-header :active="$active" />
  @endif

  {{ $slot }}

  @if ($showFooter)
    <x-site-footer :copyright="$footerCopyright" />
  @endif

  @if ($pageJs)
    <script src="{{ asset($pageJs) }}"></script>
  @endif
</body>
</html>
