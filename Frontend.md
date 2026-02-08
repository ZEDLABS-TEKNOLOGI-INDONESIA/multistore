# Frontend Blueprint

Dokumentasi lengkap file-file frontend dari project ini.

**Generated at:** 2026-02-08 22:23:55

## Struktur Frontend

### Views (Blade Templates)


---

**File:** `./resources/views/components/brand/logo.blade.php`

```blade
<svg {{ $attributes }}
     xmlns="http://www.w3.org/2000/svg"
     fill="none"
     viewBox="0 0 521 326">
    <path fill="currentColor"
          d="m515.89 235.2-.01-.01c-.96-2.27-2.09-4.46-3.29-6.59L416.63 36.43l-.05.02C405.91 15.15 383.94.5 358.49.5c-35.9 0-65 29.1-65 65 0 10.46 2.53 20.3 6.91 29.05l-.05.02 96.61 193.17c-.2-.44-.38-.89-.57-1.33.75 1.72 1.55 3.42 2.44 5.06a62.532 62.532 0 0 0 3.73 5.98c.93 1.35 1.91 2.66 2.94 3.93.15.19.29.38.44.57 1.17 1.41 2.42 2.76 3.7 4.07.33.34.67.66 1.01.99 1.1 1.07 2.24 2.11 3.41 3.1.28.23.54.48.82.71 1.42 1.16 2.89 2.25 4.4 3.29.36.24.72.47 1.09.71 1.27.83 2.57 1.62 3.89 2.37.38.21.76.44 1.14.64 1.63.87 3.29 1.68 5 2.41.33.14.68.27 1.02.4 1.45.59 2.92 1.13 4.42 1.62.46.15.91.3 1.38.44 1.81.54 3.64 1.03 5.5 1.41.24.05.49.08.73.13 1.66.33 3.35.58 5.06.77.51.06 1.03.11 1.54.16 1.95.18 3.92.3 5.92.3 35.9 0 65-29.1 65-65 .03-8.94-1.79-17.49-5.08-25.27Zm-123.41 39.04c.36 1.68.79 3.34 1.28 4.97-.49-1.63-.91-3.29-1.28-4.97ZM221.63 36.43l-.05.02C210.91 15.15 188.94.5 163.49.5c-25.43 0-47.4 14.64-58.07 35.93h-.07S7.19 232.72 6.27 234.85l-.11.23A64.999 64.999 0 0 0 1 261.74c.63 33.85 28.16 62.17 61.98 63.7C100.26 327.11 131 297.4 131 260.5c0-27.52-17.11-51.01-41.27-60.49-9.1-3.57-13.25-14.1-8.88-22.85l25.78-51.62c2.93-5.86 11.29-5.86 14.22 0 0 0 82.33 164.71 82.99 165.93v.01c12.04 22.16 36.58 36.53 64.15 33.65 30.61-3.19 55.19-28.4 57.77-59.07 1.15-13.69-2-26.55-8.17-37.48L221.63 36.43Z" />
</svg>

```


---

**File:** `./resources/views/components/collection-sale.blade.php`

```blade
<section>
    <div class="p-8 overflow-hidden border-4 border-gray-900 rounded-lg">
        <div class="sm:py-32 sm:relative">
            <div>
                <h2 class="text-3xl font-extrabold sm:text-5xl">
                    {{ $this->saleCollection->translateAttribute('name') }}
                </h2>

                @if ($this->saleCollection->translateAttribute('description'))
                    <p class="mt-1 text-lg font-medium">
                        {!! $this->saleCollection->translateAttribute('description') !!}
                    </p>
                @endif

                <a href="{{ route('collection.view', $this->saleCollection->defaultUrl->slug) }}"
                   class="inline-block px-5 py-3 mt-6 text-sm font-medium text-white bg-black rounded-lg hover:ring-1 hover:ring-black"
                   wire:navigate
                >
                    Shop the Sale
                </a>
            </div>

            <div class="mt-8 sm:absolute sm:right-0 sm:top-0 sm:mt-0">
                <div class="flex flex-col">
                    @foreach ($this->saleCollectionImages as $imageGroup)
                        <div class="gap-8 first:flex last:sm:flex last:hidden">
                            @foreach ($imageGroup as $image)
                                <img class="object-cover w-48 h-48 rounded-lg lg:h-72 lg:w-72 odd:mt-8"
                                     src="{{ $image->getUrl('medium') }}"
                                     loading="lazy" />
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

```


---

**File:** `./resources/views/components/footer.blade.php`

```blade
<footer class="bg-gray-50">
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <x-brand.logo class="w-auto h-8 text-indigo-600" />

        <p class="max-w-sm mt-4 text-gray-700">
            This is an example of a classic e-commerce store built with Lunar.
            We are currently making a screencast series to show you how we did it!
        </p>

        <p class="pt-4 mt-4 text-sm text-gray-500 border-t border-gray-100">
            &copy; {{ now()->year }} Company Name
        </p>
    </div>
</footer>

```


---

**File:** `./resources/views/components/header/search.blade.php`

```blade
<form {{ $attributes->merge(['class' => 'w-full relative']) }}
      action="{{ route('search.view') }}">
    <input name="term"
           type="search"
           placeholder="Search for products"
           class="w-full pl-10 text-sm border-2 border-gray-100 rounded-lg"
           value="{{ $this->term }}" />

    <button class="absolute p-2 text-gray-600 transition -translate-y-1/2 rounded-md left-1 top-1/2 hover:bg-gray-50">
        <span class="sr-only">Submit Search</span>

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </button>
</form>

```


---

**File:** `./resources/views/components/icon/loading.blade.php`

```blade
<svg class="w-4 h-4 ml-2 animate-spin"
     xmlns="http://www.w3.org/2000/svg"
     fill="none"
     viewBox="0 0 24 24">
    <circle class="opacity-25"
            cx="12"
            cy="12"
            r="10"
            stroke="currentColor"
            stroke-width="4"></circle>
    <path class="opacity-75"
          fill="currentColor"
          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
    </path>
</svg>

```


---

**File:** `./resources/views/components/input/group.blade.php`

```blade
@props([
    'label' => null,
    'errors' => [],
    'required' => false,
])

<label {{ $attributes->merge(['class' => 'space-y-1']) }}>
    <div class="font-medium font-sm">
        {{ $label }} @if ($required)
            <small class="text-xs text-red-500">&#42;</small>
        @endif
    </div>

    {{ $slot }}
    @foreach ($errors as $error)
        <p class="my-1 text-sm text-red-500">
            {{ $error }}
        </p>
    @endforeach
</label>

```


---

**File:** `./resources/views/components/input/text.blade.php`

```blade
@props([
    'error' => false,
])
<input {{ $attributes->merge([
        'type' => 'text',
        'class' => 'w-full p-3 border border-gray-200 rounded-lg sm:text-sm',
    ])->class([
        'border-red-400' => !!$error,
    ]) }}
       maxlength="255">

```


---

**File:** `./resources/views/components/product-card.blade.php`

```blade
@props(['product'])

<a class="block group"
   href="{{ route('product.view', $product->defaultUrl->slug) }}"
   wire:navigate
>
    <div class="overflow-hidden rounded-lg aspect-w-1 aspect-h-1">
        @if ($product->thumbnail)
            <img class="object-cover transition-transform duration-300 group-hover:scale-105"
                 src="{{ $product->thumbnail->getUrl('medium') }}"
                 alt="{{ $product->translateAttribute('name') }}" />
        @endif
    </div>

    <strong class="mt-2 text-sm font-medium">
        {{ $product->translateAttribute('name') }}
    </strong>

    <p class="mt-1 text-sm text-gray-600">
        <span class="sr-only">
            Price
        </span>

        <x-product-price :product="$product" />
    </p>
</a>

```


---

**File:** `./resources/views/components/product-price.blade.php`

```blade
<span {{ $attributes }}>
    {{ $price?->price->formatted() }}
</span>

```


---

**File:** `./resources/views/components/welcome-banner.blade.php`

```blade
<section class="bg-gray-50">
    <div class="max-w-screen-xl px-4 py-32 mx-auto sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Welcome to the

                <span class="text-indigo-600">
                    Lunar
                </span>

                Demo Store

                <span role="img"
                      aria-hidden="true">
                    👋
                </span>
            </h1>

            <p class="mt-4 font-medium sm:leading-relaxed sm:text-xl">
                This is an example of a classic e-commerce store built with Lunar.
                We are currently making a screencast series to show you how we did it!
            </p>

            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a class="block w-full px-12 py-3 font-medium text-white bg-indigo-600 rounded shadow sm:w-auto active:bg-indigo-500 hover:bg-indigo-700 focus:outline-none focus:ring"
                   href="https://lunarphp.io/"
                   target="_blank"
                   rel="noopener noreferrer">
                    Lunar Website
                </a>

                <a class="block w-full px-12 py-3 font-medium text-indigo-600 rounded shadow sm:w-auto hover:text-indigo-700 active:text-indigo-500 focus:outline-none focus:ring"
                   href="https://github.com/lunarphp/demo-store"
                   target="_blank"
                   rel="noopener noreferrer">
                    Demo Store Repo
                </a>
            </div>
        </div>
    </div>
</section>

```


---

**File:** `./resources/views/errors/401.blade.php`

```blade
@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))

```


---

**File:** `./resources/views/errors/402.blade.php`

```blade
@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required'))

```


---

**File:** `./resources/views/errors/403.blade.php`

```blade
@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

```


---

**File:** `./resources/views/errors/404.blade.php`

```blade
@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))

```


---

**File:** `./resources/views/errors/419.blade.php`

```blade
@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))

```


---

**File:** `./resources/views/errors/429.blade.php`

```blade
@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))

```


---

**File:** `./resources/views/errors/500.blade.php`

```blade
@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

```


---

**File:** `./resources/views/errors/503.blade.php`

```blade
@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))

```


---

**File:** `./resources/views/errors/layout.blade.php`

```blade
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 36px;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    @yield('message')
                </div>
            </div>
        </div>
    </body>
</html>

```


---

**File:** `./resources/views/errors/minimal.blade.php`

```blade
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        @yield('code')
                    </div>

                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                        @yield('message')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

```


---

**File:** `./resources/views/layouts/checkout.blade.php`

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>Demo Storefront</title>
    <meta
        name="description"
        content="Example of an ecommerce storefront built with Lunar."
    >
    <link
        href="{{ asset('css/app.css') }}"
        rel="stylesheet"
    >
    <link
        rel="icon"
        href="{{ asset('favicon.svg') }}"
    >
    @livewireStyles
    @stripeScripts
</head>

<body class="antialiased text-gray-900">
    <header class="relative border-b border-gray-100">
        <div class="flex items-center h-16 px-4 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
            <a
                class="flex items-center flex-shrink-0"
                href="{{ url('/') }}"
            >
                <span class="sr-only">Home</span>

                <x-brand.logo class="w-auto h-6 text-indigo-600" />
            </a>
        </div>
    </header>


    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>

```


---

**File:** `./resources/views/layouts/storefront.blade.php`

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>Demo Storefront</title>
    <meta
        name="description"
        content="Example of an ecommerce storefront built with Lunar."
    >
    <link
        href="{{ asset('css/app.css') }}"
        rel="stylesheet"
    >

    <link
        rel="icon"
        href="{{ asset('favicon.svg') }}"
    >
    @livewireStyles
</head>

<body class="antialiased text-gray-900">
    @livewire('components.navigation')

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>

```


---

**File:** `./resources/views/livewire/checkout-page.blade.php`

```blade
<div>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:items-start">
            <div class="px-6 py-8 space-y-4 bg-white border border-gray-100 lg:sticky lg:top-8 rounded-xl lg:order-last">
                <h3 class="font-medium">
                    Order Summary
                </h3>

                <div class="flow-root">
                    <div class="-my-4 divide-y divide-gray-100">
                        @foreach ($cart->lines as $line)
                            <div class="flex items-center py-4"
                                 wire:key="cart_line_{{ $line->id }}">
                                <img class="object-cover w-16 h-16 rounded"
                                     src="{{ $line->purchasable->getThumbnail()->getUrl() }}" />

                                <div class="flex-1 ml-4">
                                    <p class="text-sm font-medium max-w-[35ch]">
                                        {{ $line->purchasable->getDescription() }}
                                    </p>

                                    <span class="block mt-1 text-xs text-gray-500">
                                        {{ $line->quantity }} @ {{ $line->subTotal->formatted() }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flow-root">
                    <dl class="-my-4 text-sm divide-y divide-gray-100">
                        <div class="flex flex-wrap py-4">
                            <dt class="w-1/2 font-medium">
                                Sub Total
                            </dt>

                            <dd class="w-1/2 text-right">
                                {{ $cart->subTotal->formatted() }}
                            </dd>
                        </div>

                        @if ($this->shippingOption)
                            <div class="flex flex-wrap py-4">
                                <dt class="w-1/2 font-medium">
                                    {{ $this->shippingOption->getDescription() }}
                                </dt>

                                <dd class="w-1/2 text-right">
                                    {{ $this->shippingOption->getPrice()->formatted() }}
                                </dd>
                            </div>
                        @endif

                        @foreach ($cart->taxBreakdown->amounts as $tax)
                            <div class="flex flex-wrap py-4">
                                <dt class="w-1/2 font-medium">
                                    {{ $tax->description }}
                                </dt>

                                <dd class="w-1/2 text-right">
                                    {{ $tax->price->formatted() }}
                                </dd>
                            </div>
                        @endforeach

                        <div class="flex flex-wrap py-4">
                            <dt class="w-1/2 font-medium">
                                Total
                            </dt>

                            <dd class="w-1/2 text-right">
                                {{ $cart->total->formatted() }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-2">
                @include('partials.checkout.address', [
                    'type' => 'shipping',
                    'step' => $steps['shipping_address'],
                ])

                @include('partials.checkout.shipping_option', [
                    'step' => $steps['shipping_option'],
                ])

                @include('partials.checkout.address', [
                    'type' => 'billing',
                    'step' => $steps['billing_address'],
                ])

                @include('partials.checkout.payment', [
                    'step' => $steps['payment'],
                ])
            </div>
        </div>
    </div>
</div>

```


---

**File:** `./resources/views/livewire/checkout-success-page.blade.php`

```blade
<section class="bg-white">
    <div class="max-w-screen-xl px-4 py-32 mx-auto sm:px-6 lg:px-8 lg:py-48">
        <div class="max-w-xl mx-auto text-center">
            <span class="text-xs font-medium text-center bg-orange-100 text-orange-700 px-3 py-1.5 rounded-lg">
                This was a test order
            </span>

            <h1 class="mt-8 text-3xl font-extrabold sm:text-5xl">
                <span class="block"
                      role="img">
                    🥳
                </span>

                <span class="block mt-1 text-blue-500">
                    Order Successful!
                </span>
            </h1>

            <p class="mt-4 font-medium sm:text-lg">
                Your order reference number is

                <strong>
                    {{ $order->reference }}
                </strong>
            </p>

            <a class="inline-block px-8 py-3 mt-8 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:ring-1 hover:ring-blue-600"
               href="{{ url('/') }}">
                Back Home
            </a>
        </div>
    </div>
</section>

```


---

**File:** `./resources/views/livewire/collection-page.blade.php`

```blade
<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            {{ $this->collection->translateAttribute('name') }}
        </h1>

        <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($this->collection->products as $product)
                <x-product-card :product="$product" />
            @empty
            @endforelse
        </div>
    </div>
</section>

```


---

**File:** `./resources/views/livewire/components/add-to-cart.blade.php`

```blade
<div>
    <div class="flex gap-4">
        <div>
            <label for="quantity"
                   class="sr-only">
                Quantity
            </label>

            <input class="w-16 px-1 py-4 text-sm text-center transition border border-gray-100 rounded-lg no-spinner"
                   type="number"
                   id="quantity"
                   min="1"
                   value="1"
                   wire:model.live="quantity" />
        </div>

        <button type="submit"
                class="w-full px-6 py-4 text-sm font-medium text-center text-white bg-indigo-600 rounded-lg hover:bg-indigo-700"
                wire:click.prevent="addToCart">
            Add to Cart
        </button>
    </div>

    @if ($errors->has('quantity'))
        <div class="p-2 mt-4 text-xs font-medium text-center text-red-700 rounded bg-red-50"
             role="alert">
            @foreach ($errors->get('quantity') as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
</div>

```


---

**File:** `./resources/views/livewire/components/cart.blade.php`

```blade
<div class="sm:relative"
     x-data="{
         linesVisible: @entangle('linesVisible').live
     }">
    <button class="grid w-16 h-16 transition border-l border-gray-100 lg:border-l-transparent hover:opacity-75"
            x-on:click="linesVisible = !linesVisible">
        <span class="sr-only">Cart</span>

        <span class="place-self-center">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
        </span>
    </button>

    <div class="absolute inset-x-0 top-auto z-50 w-screen max-w-sm px-6 py-8 mx-auto mt-4 bg-white border border-gray-100 shadow-xl sm:left-auto rounded-xl"
         x-show="linesVisible"
         x-on:click.away="linesVisible = false"
         x-transition
         x-cloak>
        <button class="absolute text-gray-500 transition-transform top-3 right-3 hover:scale-110"
                type="button"
                aria-label="Close"
                x-on:click="linesVisible = false">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div>
            @if ($this->cart)
                @if ($lines)
                    <div class="flow-root">
                        <ul class="-my-4 overflow-y-auto divide-y divide-gray-100 max-h-96">
                            @foreach ($lines as $index => $line)
                                <li>
                                    <div class="flex py-4"
                                         wire:key="line_{{ $line['id'] }}">
                                        @if($line['thumbnail'])
                                        <img class="object-cover w-16 h-16 rounded"
                                             src="{{ $line['thumbnail'] }}">
                                        @endif

                                        <div class="flex-1 ml-4">
                                            <p class="max-w-[20ch] text-sm font-medium">
                                                {{ $line['description'] }}
                                            </p>

                                            <span class="block mt-1 text-xs text-gray-500">
                                                {{ $line['identifier'] }} / {{ $line['options'] }}
                                            </span>

                                            <div class="flex items-center mt-2">
                                                <input class="w-16 p-2 text-xs transition-colors border border-gray-100 rounded-lg hover:border-gray-200"
                                                       type="number"
                                                       wire:model.live="lines.{{ $index }}.quantity" />

                                                <p class="ml-2 text-xs">
                                                    @ {{ $line['unit_price'] }}
                                                </p>

                                                <button class="p-2 ml-auto text-gray-600 transition-colors rounded-lg hover:bg-gray-100 hover:text-gray-700"
                                                        type="button"
                                                        wire:click="removeLine('{{ $line['id'] }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="w-4 h-4"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($errors->get('lines.' . $index . '.quantity'))
                                        <div class="p-2 mb-4 text-xs font-medium text-center text-red-700 rounded bg-red-50"
                                             role="alert">
                                            @foreach ($errors->get('lines.' . $index . '.quantity') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <p class="py-4 text-sm font-medium text-center text-gray-500">
                        Your cart is empty
                    </p>
                @endif

                <dl class="flex flex-wrap pt-4 mt-6 text-sm border-t border-gray-100">
                    <dt class="w-1/2 font-medium">
                        Sub Total
                    </dt>

                    <dd class="w-1/2 text-right">
                        {{ $this->cart->subTotal->formatted() }}
                    </dd>
                </dl>
            @else
                <p class="py-4 text-sm font-medium text-center text-gray-500">
                    Your cart is empty
                </p>
            @endif
        </div>

        @if ($this->cart)
            <div class="mt-4 space-y-4 text-center">
                <button class="block w-full p-3 text-sm font-medium text-blue-800 border border-blue-600 rounded-lg hover:ring-1 hover:ring-blue-600"
                        type="button"
                        wire:click="updateLines">
                    Update Cart
                </button>

                <a class="block w-full p-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                   href="{{ route('checkout.view') }}"
                   wire:navigate
                >
                    Checkout
                </a>

                <a class="inline-block text-sm font-medium text-gray-600 underline hover:text-gray-500"
                   href="{{ url('/') }}">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>
</div>

```


---

**File:** `./resources/views/livewire/components/checkout-address.blade.php`

```blade
<form wire:submit="save"
      class="border rounded shadow-lg">
    <div class="flex justify-between p-4 font-medium border-b">
        <span class="text-xl">{{ ucfirst($type) }} Details</span>
        @if ($type == 'shipping' && $editing)
            <label class="text-sm">
                <input type="checkbox"
                       value="1"
                       wire:model.live="shippingIsBilling" />
                Same as billing
            </label>
        @endif
    </div>
    <div class="p-4 space-y-4">
        @if ($editing)
            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="First name"
                               :errors="$errors->get('address.first_name')"
                               required>
                    <x-input.text wire:model.live="address.first_name"
                                  required />
                </x-input.group>

                <x-input.group label="Last name"
                               :errors="$errors->get('address.last_name')">
                    <x-input.text wire:model.live="address.last_name" />
                </x-input.group>
            </div>

            <div>
                <x-input.group label="Company name"
                               :errors="$errors->get('address.company_name')"
                               required>
                    <x-input.text wire:model.live="address.company_name"
                                  required />
                </x-input.group>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="Contact phone"
                               :errors="$errors->get('address.contact_phone')">
                    <x-input.text wire:model.live="address.contact_phone" />
                </x-input.group>

                <x-input.group label="Contact email"
                               :errors="$errors->get('address.contact_email')">
                    <x-input.text wire:model.live="address.contact_email"
                                  type="email" />
                </x-input.group>
            </div>

            <hr />

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="Address line 1"
                               :errors="$errors->get('address.line_one')"
                               required>
                    <x-input.text wire:model.live="address.line_one"
                                  required />
                </x-input.group>

                <x-input.group label="Address line 2"
                               :errors="$errors->get('address.line_two')">
                    <x-input.text wire:model.live="address.line_two" />
                </x-input.group>

                <x-input.group label="Address line 3"
                               :errors="$errors->get('address.line_three')">
                    <x-input.text wire:model.live="address.line_three" />
                </x-input.group>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="City"
                               :errors="$errors->get('address.city')"
                               required>
                    <x-input.text wire:model.live="address.city"
                                  required />
                </x-input.group>

                <x-input.group label="State / Province"
                               :errors="$errors->get('address.state')">
                    <x-input.text wire:model.live="address.state" />
                </x-input.group>

                <x-input.group label="Postcode"
                               :errors="$errors->get('address.postcode')"
                               required>
                    <x-input.text wire:model.live="address.postcode"
                                  required />
                </x-input.group>
            </div>

            <div>
                <x-input.group label="Country"
                               required>
                    <select class="w-full p-4 text-sm border-2 border-gray-200 rounded-lg"
                            wire:model.live="address.country_id">
                        <option value>Select a country</option>
                        @foreach ($this->countries as $country)
                            <option value="{{ $country->id }}"
                                    wire:key="country_{{ $country->id }}">
                                {{ $country->native }}
                            </option>
                        @endforeach
                    </select>
                </x-input.group>
            </div>
        @else
            <dl class="flex">
                <div class="w-1/2">
                    <div class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium">Name</dt>
                            <dd>{{ $address->first_name }} {{ $address->last_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Company</dt>
                            <dd>{{ $address->company_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Phone Number</dt>
                            <dd>{{ $address->contact_phone }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Email</dt>
                            <dd>{{ $address->contact_email }}</dd>
                        </div>
                    </div>
                </div>

                <div class="w-1/2">
                    <dt class="text-sm font-medium">Address</dt>
                    <dd>
                        {{ $address->line_one }}<br>
                        @if ($address->line_two)
                            {{ $address->line_two }}<br>
                        @endif
                        @if ($address->line_three)
                            {{ $address->line_three }}<br>
                        @endif
                        @if ($address->city)
                            {{ $address->city }}<br>
                        @endif
                        {{ $address->state }}<br>
                        {{ $address->postcode }}<br>
                        {{ $address->country()->first()->native }}
                    </dd>
                </div>
            </dl>
        @endif
    </div>
    <div class="flex justify-end w-full p-4 bg-gray-100">
        <div>
            @if ($editing)
                <button type="submit"
                        wire:key="submit_btn"
                        class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                    Continue
                </button>
            @else
                <button type="button"
                        wire:key="edit_btn"
                        wire:click.prevent="$set('editing', true)"
                        class="px-5 py-3 font-medium bg-white border rounded-lg shadow-sm hover:bg-gray-50">
                    Edit Details
                </button>
            @endif
        </div>
    </div>
</form>

```


---

**File:** `./resources/views/livewire/components/navigation.blade.php`

```blade
<header class="relative border-b border-gray-100">
    <div class="flex items-center justify-between h-16 px-4 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
        <div class="flex items-center">
            <a class="flex items-center flex-shrink-0"
               href="{{ url('/') }}"
               wire:navigate
            >
                <span class="sr-only">Home</span>

                <x-brand.logo class="w-auto h-6 text-indigo-600" />
            </a>

            <nav class="hidden lg:gap-4 lg:flex lg:ml-8">
                @foreach ($this->collections as $collection)
                    <a class="text-sm font-medium transition hover:opacity-75"
                       href="{{ route('collection.view', $collection->defaultUrl->slug) }}"
                       wire:navigate
                    >
                        {{ $collection->translateAttribute('name') }}
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="flex items-center justify-between flex-1 ml-4 lg:justify-end">
            <x-header.search class="max-w-sm mr-4" />

            <div class="flex items-center -mr-4 sm:-mr-6 lg:mr-0">
                @livewire('components.cart')

                <div x-data="{ mobileMenu: false }">
                    <button x-on:click="mobileMenu = !mobileMenu"
                            class="grid flex-shrink-0 w-16 h-16 border-l border-gray-100 lg:hidden">
                        <span class="sr-only">Toggle Menu</span>

                        <span class="place-self-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </span>
                    </button>

                    <div x-cloak
                         x-transition
                         x-show="mobileMenu"
                         class="absolute right-0 top-auto z-50 w-screen p-4 sm:max-w-xs">
                        <ul x-on:click.away="mobileMenu = false"
                            class="p-6 space-y-4 bg-white border border-gray-100 shadow-xl rounded-xl">
                            @foreach ($this->collections as $collection)
                                <li>
                                    <a class="text-sm font-medium"
                                       href="{{ route('collection.view', $collection->defaultUrl->slug) }}"
                                       wire:navigate
                                    >
                                        {{ $collection->translateAttribute('name') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

```


---

**File:** `./resources/views/livewire/components/shipping-options.blade.php`

```blade
<form wire:submit="save"
      class="border rounded shadow-lg">
    <div class="flex justify-between p-4 font-medium">
        <span class="text-xl">Shipping Option</span>
    </div>
    @if ($this->shippingAddress)
        <div class="p-4 border-t">
            @foreach ($this->shippingOptions as $option)
                <label class="flex items-center w-full cursor-pointer"
                       wire:key="shipping_option_{{ $option->getIdentifier() }}">
                    <input type="radio"
                           wire:model.live="chosenOption"
                           value="{{ $option->getIdentifier() }}" />
                    <div class="flex items-center ml-2">
                        <span class="block mr-2 text-2xl">{{ $option->getPrice()->formatted() }}</span>
                        {{ $option->name }}
                    </div>
                </label>
            @endforeach
        </div>
    @else
    @endif
    @if ($errors->has('chosenOption'))
        <p class="p-4 text-sm text-red-500">{{ $errors->first('chosenOption') }}</p>
    @endif
    <div class="flex justify-end w-full p-4 bg-gray-100">
        <div>
            <button type="submit"
                    wire:key="submit_btn"
                    class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                Continue
            </button>
        </div>
    </div>
</form>

```


---

**File:** `./resources/views/livewire/home.blade.php`

```blade
<div>
    <x-welcome-banner />

    <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-12 sm:px-6 lg:px-8">
        @if ($this->saleCollection)
            <x-collection-sale />
        @endif

        @if ($this->randomCollection)
            <section>
                <h2 class="text-3xl font-bold">
                    {{ $this->randomCollection->translateAttribute('name') }}
                </h2>

                <div class="grid grid-cols-2 mt-8 lg:grid-cols-4 gap-x-4 gap-y-8">
                    @foreach ($this->randomCollection->products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

```


---

**File:** `./resources/views/livewire/product-page.blade.php`

```blade
<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <div class="grid items-start grid-cols-1 gap-8 md:grid-cols-2">
            <div class="grid grid-cols-2 gap-4 md:grid-cols-1">
                @if ($this->image)
                    <div class="aspect-w-1 aspect-h-1">
                        <img class="object-cover rounded-xl"
                             src="{{ $this->image->getUrl('large') }}"
                             alt="{{ $this->product->translateAttribute('name') }}" />
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                    @foreach ($this->images as $image)
                        <div class="aspect-w-1 aspect-h-1"
                             wire:key="image_{{ $image->id }}">
                            <img loading="lazy"
                                 class="object-cover rounded-xl"
                                 src="{{ $image->getUrl('small') }}"
                                 alt="{{ $this->product->translateAttribute('name') }}" />
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-bold">
                        {{ $this->product->translateAttribute('name') }}
                    </h1>

                    <x-product-price class="ml-4 font-medium"
                                     :variant="$this->variant" />
                </div>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $this->variant->sku }}
                </p>

                <article class="mt-4 text-gray-700">
                    {!! $this->product->translateAttribute('description') !!}
                </article>

                <form class="mt-4">
                    <div class="space-y-4">
                        @foreach ($this->productOptions as $option)
                            <fieldset>
                                <legend class="text-xs font-medium text-gray-700">
                                    {{ $option['option']->translate('name') }}
                                </legend>

                                <div class="flex flex-wrap gap-2 mt-2 text-xs tracking-wide uppercase"
                                     x-data="{
                                         selectedOption: @entangle('selectedOptionValues').live,
                                         selectedValues: [],
                                     }"
                                     x-init="selectedValues = Object.values(selectedOption);
                                     $watch('selectedOption', value =>
                                         selectedValues = Object.values(selectedOption)
                                     )">
                                    @foreach ($option['values'] as $value)
                                        <button class="px-6 py-4 font-medium border rounded-lg focus:outline-none focus:ring"
                                                type="button"
                                                wire:click="
                                                $set('selectedOptionValues.{{ $option['option']->id }}', {{ $value->id }})
                                            "
                                                :class="{
                                                    'bg-indigo-600 border-indigo-600 text-white hover:bg-indigo-700': selectedValues
                                                        .includes({{ $value->id }}),
                                                    'hover:bg-gray-100': !selectedValues.includes({{ $value->id }})
                                                }">
                                            {{ $value->translate('name') }}
                                        </button>
                                    @endforeach
                                </div>
                            </fieldset>
                        @endforeach
                    </div>

                    <div class="max-w-xs mt-8">
                        <livewire:components.add-to-cart :purchasable="$this->variant"
                                                         :wire:key="$this->variant->id">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

```


---

**File:** `./resources/views/livewire/search-page.blade.php`

```blade
<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            Search Results
            @if (isset($term))
                for <u>{{ $term }}</u>
            @endif
        </h1>

        <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($this->results as $result)
                <x-product-card :product="$result" />
            @endforeach
        </div>
    </div>
</section>

```


---

**File:** `./resources/views/mcp/authorize.blade.php`

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Inline script to detect system dark mode preference and apply it immediately --}}
    <script>
        (function() {
            const appearance = '{{ $appearance ?? "system" }}';

            if (appearance === 'system') {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (prefersDark) {
                    document.documentElement.classList.add('dark');
                }
            }
        })();
    </script>

    <style>
        html {
            background-color: oklch(1 0 0);
        }

        html.dark {
            background-color: oklch(0.145 0 0);
        }
    </style>

    <title>Authorize Application - {{ config('app.name', 'MCP Server') }}</title>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Authorize MCP" />
    <link rel="manifest" href="/site.webmanifest" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css'])
</head>
<body class="font-sans antialiased bg-background text-foreground">
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card Container -->
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <!-- Header -->
            <div class="flex flex-col space-y-1.5 p-6">
                <div class="flex items-center justify-center mb-4">
                    <!-- Shield Icon -->
                    <svg class="h-12 w-12 text-primary" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>

                <h3 class="text-2xl font-semibold leading-none tracking-tight text-center">
                    Authorize {{ $client->name }}
                </h3>

                <p class="text-sm text-muted-foreground text-center">
                    This application will be able to:<br/>Use available MCP functionality.
                </p>
            </div>

            <!-- Content -->
            <div class="p-6 pt-0 space-y-4">
                <!-- User Info -->
                <div class="rounded-lg border p-4 bg-muted/50">
                    <p class="text-sm text-muted-foreground mb-2">Logged in as:</p>
                    <p class="font-medium">{{ $user->email }}</p>
                </div>

                <!-- Scopes / Permissions -->
                @if(count($scopes) > 0)
                    <div class="space-y-2">
                        <p class="text-sm font-medium">Permissions:</p>

                        <ul class="space-y-2">
                            @foreach($scopes as $scope)
                                <li class="flex items-start gap-2">
                                    <div class="rounded-full bg-primary/10 p-1 mt-0.5">
                                        <div class="h-1.5 w-1.5 rounded-full bg-primary"></div>
                                    </div>
                                    <span class="text-sm text-muted-foreground">
                                        {{ $scope->description }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Footer With Buttons -->
            <div class="flex items-center p-6 pt-0 gap-3">
                <!-- Deny Form -->
                <form method="POST" action="{{ route('passport.authorizations.deny') }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="state" value="">
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="auth_token" value="{{ $authToken }}">
                    <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full">
                        <svg class="mr-2 h-4 w-4" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </button>
                </form>

                <!-- Approve Form -->
                <form method="POST" action="{{ route('passport.authorizations.approve') }}" class="flex-1" id="authorizeForm">
                    @csrf
                    <input type="hidden" name="state" value="">
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="auth_token" value="{{ $authToken }}">
                    <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full" id="authorizeButton">
                        <span id="authorizeText">Authorize</span>

                        <svg id="loadingSpinner" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('authorizeForm');
        const button = document.getElementById('authorizeButton');
        const authorizeText = document.getElementById('authorizeText');
        const loadingSpinner = document.getElementById('loadingSpinner');

        form.addEventListener('submit', function(e) {
            // Show loading state...
            button.disabled = true;
            authorizeText.textContent = 'Authorizing...';
            loadingSpinner.classList.remove('hidden');

            // After form submission, watch for redirect and close window...
            setTimeout(function() {
                const checkRedirect = setInterval(function() {
                    // If URL changed or we have OAuth params, redirect happened...
                    if (!window.location.href.includes('/oauth/authorize') ||
                        window.location.search.includes('code=') ||
                        window.location.search.includes('error=')) {
                        clearInterval(checkRedirect);
                        window.close();
                    }
                }, 100);

                // Fallback: Close after five seconds...
                setTimeout(function() {
                    clearInterval(checkRedirect);
                    window.close();
                }, 5000);
            }, 200);
        });

        // Handle cancel button...
        const cancelForm = document.querySelector('form[method="POST"]:has(input[name="_method"][value="DELETE"])');
        if (cancelForm) {
            cancelForm.addEventListener('submit', function(e) {
                setTimeout(function() {
                    window.close();
                }, 200);
            });
        }
    });
</script>
</body>
</html>

```


---

**File:** `./resources/views/partials/checkout/address.blade.php`

```blade
<form wire:submit="saveAddress('{{ $type }}')"
      class="bg-white border border-gray-100 rounded-xl">
    <div class="flex items-center justify-between h-16 px-6 border-b border-gray-100">
        <h3 class="text-lg font-medium">
            {{ ucfirst($type) }} Details
        </h3>

        @if ($type == 'shipping' && $step == $currentStep)
            <label class="flex items-center p-2 rounded-lg cursor-pointer hover:bg-gray-50">
                <input class="w-5 h-5 text-green-600 border-gray-100 rounded"
                       type="checkbox"
                       value="1"
                       wire:model.live="shippingIsBilling" />

                <span class="ml-2 text-xs font-medium">
                    Same as billing
                </span>
            </label>
        @endif

        @if ($currentStep > $step)
            <button class="px-5 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-700"
                    type="button"
                    wire:click.prevent="$set('currentStep', {{ $step }})">
                Edit
            </button>
        @endif
    </div>

    @if ($currentStep >= $step)
        <div class="p-6">
            @if ($step == $currentStep)
                <div class="grid grid-cols-6 gap-4">
                    <x-input.group class="col-span-3"
                                   label="First name"
                                   :errors="$errors->get($type . '.first_name')"
                                   required>
                        <x-input.text wire:model.live="{{ $type }}.first_name"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-3"
                                   label="Last name"
                                   :errors="$errors->get($type . '.last_name')"
                                   required>
                        <x-input.text wire:model.live="{{ $type }}.last_name"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-6"
                                   label="Company name"
                                   :errors="$errors->get($type . '.company_name')">
                        <x-input.text wire:model.live="{{ $type }}.company_name" />
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3"
                                   label="Contact phone"
                                   :errors="$errors->get($type . '.contact_phone')">
                        <x-input.text wire:model.live="{{ $type }}.contact_phone" />
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3"
                                   label="Contact email"
                                   :errors="$errors->get($type . '.contact_email')"
                                   required>
                        <x-input.text wire:model.live="{{ $type }}.contact_email"
                                      type="email"
                                      required />
                    </x-input.group>

                    <div class="col-span-6">
                        <hr class="h-px my-4 bg-gray-100 border-none">
                    </div>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="Address line 1"
                                   :errors="$errors->get($type . '.line_one')"
                                   required>
                        <x-input.text wire:model.live="{{ $type }}.line_one"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="Address line 2"
                                   :errors="$errors->get($type . '.line_two')">
                        <x-input.text wire:model.live="{{ $type }}.line_two" />
                    </x-input.group>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="Address line 3"
                                   :errors="$errors->get($type . '.line_three')">
                        <x-input.text wire:model.live="{{ $type }}.line_three" />
                    </x-input.group>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="City"
                                   :errors="$errors->get($type . '.city')"
                                   required>
                        <x-input.text wire:model.live="{{ $type }}.city"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="State / Province"
                                   :errors="$errors->get($type . '.state')">
                        <x-input.text wire:model.live="{{ $type }}.state" />
                    </x-input.group>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="Postcode"
                                   :errors="$errors->get($type . '.postcode')"
                                   required>
                        <x-input.text wire:model.live="{{ $type }}.postcode"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-6"
                                   label="Country"
                                   required>
                        <select class="w-full p-3 border border-gray-200 rounded-lg sm:text-sm"
                                wire:model.live="{{ $type }}.country_id">
                            <option value>Select a country</option>
                            @foreach ($this->countries as $country)
                                <option value="{{ $country->id }}"
                                        wire:key="country_{{ $country->id }}">
                                    {{ $country->native }}
                                </option>
                            @endforeach
                        </select>
                    </x-input.group>
                </div>
            @elseif($currentStep > $step)
                <dl class="grid grid-cols-1 gap-8 text-sm sm:grid-cols-2">
                    <div>
                        <div class="space-y-4">
                            <div>
                                <dt class="font-medium">
                                    Name
                                </dt>

                                <dd class="mt-0.5">
                                    {{ $this->{$type}->first_name }} {{ $this->{$type}->last_name }}
                                </dd>
                            </div>

                            @if ($this->{$type}->company_name)
                                <div>
                                    <dt class="font-medium">
                                        Company
                                    </dt>

                                    <dd class="mt-0.5">
                                        {{ $this->{$type}->company_name }}
                                    </dd>
                                </div>
                            @endif

                            @if ($this->{$type}->contact_phone)
                                <div>
                                    <dt class="font-medium">
                                        Phone Number
                                    </dt>

                                    <dd class="mt-0.5">
                                        {{ $this->{$type}->contact_phone }}
                                    </dd>
                                </div>
                            @endif

                            <div>
                                <dt class="font-medium">
                                    Email
                                </dt>

                                <dd class="mt-0.5">
                                    {{ $this->{$type}->contact_email }}
                                </dd>
                            </div>
                        </div>
                    </div>

                    <div>
                        <dt class="font-medium">
                            Address
                        </dt>

                        <dd class="mt-0.5">
                            {{ $this->{$type}->line_one }}<br>
                            @if ($this->{$type}->line_two)
                                {{ $this->{$type}->line_two }}<br>
                            @endif
                            @if ($this->{$type}->line_three)
                                {{ $this->{$type}->line_three }}<br>
                            @endif
                            @if ($this->{$type}->city)
                                {{ $this->{$type}->city }}<br>
                            @endif
                            @if ($this->{$type}->state)
                                {{ $this->{$type}->state }}<br>
                            @endif
                            {{ $this->{$type}->postcode }}<br>
                            {{ $this->{$type}->country?->native }}
                        </dd>
                    </div>
                </dl>
            @endif

            @if ($step == $currentStep)
                <div class="mt-6 text-right">
                    <button class="px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                            type="submit"
                            wire:key="submit_btn"
                            wire:loading.attr="disabled"
                            wire:target="saveAddress">
                        <span wire:loading.remove
                              wire:target="saveAddress">
                            Save Address
                        </span>

                        <span wire:loading
                              wire:target="saveAddress">
                            <span class="inline-flex items-center">
                                Saving

                                <x-icon.loading />
                            </span>
                        </span>
                    </button>
                </div>
            @endif
        </div>

    @endif
</form>

```


---

**File:** `./resources/views/partials/checkout/payment.blade.php`

```blade
<div class="bg-white border border-gray-100 rounded-xl">
    <div class="flex items-center h-16 px-6 border-b border-gray-100">
        <h3 class="text-lg font-medium">
            Payment
        </h3>
    </div>

    @if ($currentStep >= $step)
        <div class="p-6 space-y-4">
            <div class="flex gap-4">
                <button @class([
                    'px-5 py-2 text-sm border font-medium rounded-lg',
                    'text-green-700 border-green-600 bg-green-50' => $paymentType === 'card',
                    'text-gray-500 hover:text-gray-700' => $paymentType !== 'card',
                ])
                        type="button"
                        wire:click.prevent="$set('paymentType', 'card')">
                    Pay by card
                </button>

                <button @class([
                    'px-5 py-2 text-sm border font-medium rounded-lg',
                    'text-green-700 border-green-600 bg-green-50' => $paymentType === 'cash-in-hand',
                    'text-gray-500 hover:text-gray-700' => $paymentType !== 'cash-in-hand',
                ])
                        type="button"
                        wire:click.prevent="$set('paymentType', 'cash-in-hand')">
                    Pay with cash
                </button>
            </div>

            @if ($paymentType == 'card')
                <livewire:stripe.payment :cart="$cart"
                                         :returnUrl="route('checkout.view')" />
            @endif

            @if ($paymentType == 'cash-in-hand')
                <form wire:submit="checkout">
                    <div class="p-4 text-sm text-center text-blue-700 rounded-lg bg-blue-50">
                        Payment is offline, no card details needed.
                    </div>

                    <button class="px-5 py-3 mt-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                            type="submit"
                            wire:key="payment_submit_btn">
                        <span wire:loading.remove.delay
                              wire:target="checkout">
                            Submit Order
                        </span>
                        <span wire:loading.delay
                              wire:target="checkout">
                            <svg class="w-5 h-5 text-white animate-spin"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75"
                                      fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </button>
                </form>
            @endif
        </div>
    @endif
</div>

```


---

**File:** `./resources/views/partials/checkout/shipping_option.blade.php`

```blade
<form wire:submit="saveShippingOption"
      class="bg-white border border-gray-100 rounded-xl">
    <div class="flex items-center justify-between h-16 px-6 border-b border-gray-100">
        <h3 class="font-medium">
            Shipping Options
        </h3>

        @if ($currentStep > $step)
            <button class="px-5 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-700"
                    type="button"
                    wire:click.prevent="$set('currentStep', {{ $step }})">
                Edit
            </button>
        @endif
    </div>

    @if ($currentStep >= $step)
        <div class="p-6">
            @if ($currentStep == $step)
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @foreach ($this->shippingOptions as $option)
                        <div>
                            <input class="hidden peer"
                                   type="radio"
                                   wire:model.live="chosenShipping"
                                   name="shippingOption"
                                   value="{{ $option->getIdentifier() }}"
                                   id="{{ $option->getIdentifier() }}" />

                            <label class="flex items-center justify-between p-4 text-sm font-medium border border-gray-100 rounded-lg shadow-sm cursor-pointer peer-checked:border-blue-500 hover:bg-gray-50 peer-checked:ring-1 peer-checked:ring-blue-500"
                                   for="{{ $option->getIdentifier() }}">
                                <p>
                                    {{ $option->getName() }}
                                </p>

                                <p>
                                    {{ $option->getPrice()->formatted() }}
                                </p>
                            </label>
                        </div>
                    @endforeach
                </div>

                @if ($errors->has('chosenShipping'))
                    <p class="p-4 text-sm text-red-500">
                        {{ $errors->first('chosenShipping') }}
                    </p>
                @endif
            @elseif($currentStep > $step && $this->shippingOption)
                <dl class="flex flex-wrap max-w-xs text-sm">
                    <dt class="w-1/2 font-medium">
                        {{ $this->shippingOption->getDescription() }}
                    </dt>

                    <dd class="w-1/2 text-right">
                        {{ $this->shippingOption->getPrice()->formatted() }}
                    </dd>
                </dl>
            @endif

            @if ($step == $currentStep)
                <div class="mt-6 text-right">
                    <button class="px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                            type="submit"
                            wire:key="shipping_submit_btn">
                        <span wire:loading.remove.delay
                              wire:target="saveShippingOption">
                            Choose Shipping
                        </span>
                        <span wire:loading.delay
                              wire:target="saveShippingOption">
                            <svg class="w-5 h-5 text-white animate-spin"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75"
                                      fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </button>
                </div>
            @endif
        </div>
    @endif
</form>

```


---

**File:** `./resources/views/welcome.blade.php`

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
          rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div
         class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}"
                       class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <svg viewBox="0 0 651 192"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg"
                     class="h-16 w-auto text-gray-700 sm:h-20">
                    <g clip-path="url(#clip0)"
                       fill="#EF3B2D">
                        <path
                              d="M248.032 44.676h-16.466v100.23h47.394v-14.748h-30.928V44.676zM337.091 87.202c-2.101-3.341-5.083-5.965-8.949-7.875-3.865-1.909-7.756-2.864-11.669-2.864-5.062 0-9.69.931-13.89 2.792-4.201 1.861-7.804 4.417-10.811 7.661-3.007 3.246-5.347 6.993-7.016 11.239-1.672 4.249-2.506 8.713-2.506 13.389 0 4.774.834 9.26 2.506 13.459 1.669 4.202 4.009 7.925 7.016 11.169 3.007 3.246 6.609 5.799 10.811 7.66 4.199 1.861 8.828 2.792 13.89 2.792 3.913 0 7.804-.955 11.669-2.863 3.866-1.908 6.849-4.533 8.949-7.875v9.021h15.607V78.182h-15.607v9.02zm-1.431 32.503c-.955 2.578-2.291 4.821-4.009 6.73-1.719 1.91-3.795 3.437-6.229 4.582-2.435 1.146-5.133 1.718-8.091 1.718-2.96 0-5.633-.572-8.019-1.718-2.387-1.146-4.438-2.672-6.156-4.582-1.719-1.909-3.032-4.152-3.938-6.73-.909-2.577-1.36-5.298-1.36-8.161 0-2.864.451-5.585 1.36-8.162.905-2.577 2.219-4.819 3.938-6.729 1.718-1.908 3.77-3.437 6.156-4.582 2.386-1.146 5.059-1.718 8.019-1.718 2.958 0 5.656.572 8.091 1.718 2.434 1.146 4.51 2.674 6.229 4.582 1.718 1.91 3.054 4.152 4.009 6.729.953 2.577 1.432 5.298 1.432 8.162-.001 2.863-.479 5.584-1.432 8.161zM463.954 87.202c-2.101-3.341-5.083-5.965-8.949-7.875-3.865-1.909-7.756-2.864-11.669-2.864-5.062 0-9.69.931-13.89 2.792-4.201 1.861-7.804 4.417-10.811 7.661-3.007 3.246-5.347 6.993-7.016 11.239-1.672 4.249-2.506 8.713-2.506 13.389 0 4.774.834 9.26 2.506 13.459 1.669 4.202 4.009 7.925 7.016 11.169 3.007 3.246 6.609 5.799 10.811 7.66 4.199 1.861 8.828 2.792 13.89 2.792 3.913 0 7.804-.955 11.669-2.863 3.866-1.908 6.849-4.533 8.949-7.875v9.021h15.607V78.182h-15.607v9.02zm-1.432 32.503c-.955 2.578-2.291 4.821-4.009 6.73-1.719 1.91-3.795 3.437-6.229 4.582-2.435 1.146-5.133 1.718-8.091 1.718-2.96 0-5.633-.572-8.019-1.718-2.387-1.146-4.438-2.672-6.156-4.582-1.719-1.909-3.032-4.152-3.938-6.73-.909-2.577-1.36-5.298-1.36-8.161 0-2.864.451-5.585 1.36-8.162.905-2.577 2.219-4.819 3.938-6.729 1.718-1.908 3.77-3.437 6.156-4.582 2.386-1.146 5.059-1.718 8.019-1.718 2.958 0 5.656.572 8.091 1.718 2.434 1.146 4.51 2.674 6.229 4.582 1.718 1.91 3.054 4.152 4.009 6.729.953 2.577 1.432 5.298 1.432 8.162 0 2.863-.479 5.584-1.432 8.161zM650.772 44.676h-15.606v100.23h15.606V44.676zM365.013 144.906h15.607V93.538h26.776V78.182h-42.383v66.724zM542.133 78.182l-19.616 51.096-19.616-51.096h-15.808l25.617 66.724h19.614l25.617-66.724h-15.808zM591.98 76.466c-19.112 0-34.239 15.706-34.239 35.079 0 21.416 14.641 35.079 36.239 35.079 12.088 0 19.806-4.622 29.234-14.688l-10.544-8.158c-.006.008-7.958 10.449-19.832 10.449-13.802 0-19.612-11.127-19.612-16.884h51.777c2.72-22.043-11.772-40.877-33.023-40.877zm-18.713 29.28c.12-1.284 1.917-16.884 18.589-16.884 16.671 0 18.697 15.598 18.813 16.884h-37.402zM184.068 43.892c-.024-.088-.073-.165-.104-.25-.058-.157-.108-.316-.191-.46-.056-.097-.137-.176-.203-.265-.087-.117-.161-.242-.265-.345-.085-.086-.194-.148-.29-.223-.109-.085-.206-.182-.327-.252l-.002-.001-.002-.002-35.648-20.524a2.971 2.971 0 00-2.964 0l-35.647 20.522-.002.002-.002.001c-.121.07-.219.167-.327.252-.096.075-.205.138-.29.223-.103.103-.178.228-.265.345-.066.089-.147.169-.203.265-.083.144-.133.304-.191.46-.031.085-.08.162-.104.25-.067.249-.103.51-.103.776v38.979l-29.706 17.103V24.493a3 3 0 00-.103-.776c-.024-.088-.073-.165-.104-.25-.058-.157-.108-.316-.191-.46-.056-.097-.137-.176-.203-.265-.087-.117-.161-.242-.265-.345-.085-.086-.194-.148-.29-.223-.109-.085-.206-.182-.327-.252l-.002-.001-.002-.002L40.098 1.396a2.971 2.971 0 00-2.964 0L1.487 21.919l-.002.002-.002.001c-.121.07-.219.167-.327.252-.096.075-.205.138-.29.223-.103.103-.178.228-.265.345-.066.089-.147.169-.203.265-.083.144-.133.304-.191.46-.031.085-.08.162-.104.25-.067.249-.103.51-.103.776v122.09c0 1.063.568 2.044 1.489 2.575l71.293 41.045c.156.089.324.143.49.202.078.028.15.074.23.095a2.98 2.98 0 001.524 0c.069-.018.132-.059.2-.083.176-.061.354-.119.519-.214l71.293-41.045a2.971 2.971 0 001.489-2.575v-38.979l34.158-19.666a2.971 2.971 0 001.489-2.575V44.666a3.075 3.075 0 00-.106-.774zM74.255 143.167l-29.648-16.779 31.136-17.926.001-.001 34.164-19.669 29.674 17.084-21.772 12.428-43.555 24.863zm68.329-76.259v33.841l-12.475-7.182-17.231-9.92V49.806l12.475 7.182 17.231 9.92zm2.97-39.335l29.693 17.095-29.693 17.095-29.693-17.095 29.693-17.095zM54.06 114.089l-12.475 7.182V46.733l17.231-9.92 12.475-7.182v74.537l-17.231 9.921zM38.614 7.398l29.693 17.095-29.693 17.095L8.921 24.493 38.614 7.398zM5.938 29.632l12.475 7.182 17.231 9.92v79.676l.001.005-.001.006c0 .114.032.221.045.333.017.146.021.294.059.434l.002.007c.032.117.094.222.14.334.051.124.088.255.156.371a.036.036 0 00.004.009c.061.105.149.191.222.288.081.105.149.22.244.314l.008.01c.084.083.19.142.284.215.106.083.202.178.32.247l.013.005.011.008 34.139 19.321v34.175L5.939 144.867V29.632h-.001zm136.646 115.235l-65.352 37.625V148.31l48.399-27.628 16.953-9.677v33.862zm35.646-61.22l-29.706 17.102V66.908l17.231-9.92 12.475-7.182v33.841z" />
                    </g>
                </svg>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg fill="none"
                                 stroke="currentColor"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2"
                                 viewBox="0 0 24 24"
                                 class="w-8 h-8 text-gray-500">
                                <path
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs"
                                   class="underline text-gray-900 dark:text-white">Documentation</a></div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laravel has wonderful, thorough documentation covering every aspect of the framework.
                                Whether you are new to the framework or have previous experience with Laravel, we
                                recommend reading all of the documentation from beginning to end.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <svg fill="none"
                                 stroke="currentColor"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2"
                                 viewBox="0 0 24 24"
                                 class="w-8 h-8 text-gray-500">
                                <path
                                      d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                </path>
                                <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laracasts.com"
                                   class="underline text-gray-900 dark:text-white">Laracasts</a></div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript
                                development. Check them out, see for yourself, and massively level up your development
                                skills in the process.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <svg fill="none"
                                 stroke="currentColor"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2"
                                 viewBox="0 0 24 24"
                                 class="w-8 h-8 text-gray-500">
                                <path
                                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                </path>
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel-news.com/"
                                   class="underline text-gray-900 dark:text-white">Laravel News</a></div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laravel News is a community driven portal and newsletter aggregating all of the latest
                                and most important news in the Laravel ecosystem, including new package releases and
                                tutorials.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                        <div class="flex items-center">
                            <svg fill="none"
                                 stroke="currentColor"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2"
                                 viewBox="0 0 24 24"
                                 class="w-8 h-8 text-gray-500">
                                <path
                                      d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant
                                Ecosystem</div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laravel's robust library of first-party tools and libraries, such as <a
                                   href="https://forge.laravel.com"
                                   class="underline">Forge</a>, <a href="https://vapor.laravel.com"
                                   class="underline">Vapor</a>, <a href="https://nova.laravel.com"
                                   class="underline">Nova</a>, and <a href="https://envoyer.io"
                                   class="underline">Envoyer</a> help you take your projects to the next level. Pair
                                them with powerful open source libraries like <a href="https://laravel.com/docs/billing"
                                   class="underline">Cashier</a>, <a href="https://laravel.com/docs/dusk"
                                   class="underline">Dusk</a>, <a href="https://laravel.com/docs/broadcasting"
                                   class="underline">Echo</a>, <a href="https://laravel.com/docs/horizon"
                                   class="underline">Horizon</a>, <a href="https://laravel.com/docs/sanctum"
                                   class="underline">Sanctum</a>, <a href="https://laravel.com/docs/telescope"
                                   class="underline">Telescope</a>, and more.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">
                        <svg fill="none"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             stroke-width="2"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             class="-mt-px w-5 h-5 text-gray-400">
                            <path
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>

                        <a href="https://laravel.bigcartel.com"
                           class="ml-1 underline">
                            Shop
                        </a>

                        <svg fill="none"
                             stroke="currentColor"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             stroke-width="2"
                             viewBox="0 0 24 24"
                             class="ml-4 -mt-px w-5 h-5 text-gray-400">
                            <path
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>

                        <a href="https://github.com/sponsors/taylorotwell"
                           class="ml-1 underline">
                            Sponsor
                        </a>
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </div>
</body>

</html>

```

### JavaScript Files


---

**File:** `./resources/js/app.js`

```javascript
// Lunar 🚀

```

### CSS Files


---

**File:** `./resources/css/app.css`

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer components {
    .no-spinner {
        @apply [-moz-appearance:_textfield];
    }

    .no-spinner::-webkit-outer-spin-button,
    .no-spinner::-webkit-inner-spin-button {
        @apply appearance-none m-0;
    }
}

[x-cloak] {
    display: none;
}

```

### Livewire Component Views


---

**File:** `./resources/views/livewire/checkout-page.blade.php`

```blade
<div>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:items-start">
            <div class="px-6 py-8 space-y-4 bg-white border border-gray-100 lg:sticky lg:top-8 rounded-xl lg:order-last">
                <h3 class="font-medium">
                    Order Summary
                </h3>

                <div class="flow-root">
                    <div class="-my-4 divide-y divide-gray-100">
                        @foreach ($cart->lines as $line)
                            <div class="flex items-center py-4"
                                 wire:key="cart_line_{{ $line->id }}">
                                <img class="object-cover w-16 h-16 rounded"
                                     src="{{ $line->purchasable->getThumbnail()->getUrl() }}" />

                                <div class="flex-1 ml-4">
                                    <p class="text-sm font-medium max-w-[35ch]">
                                        {{ $line->purchasable->getDescription() }}
                                    </p>

                                    <span class="block mt-1 text-xs text-gray-500">
                                        {{ $line->quantity }} @ {{ $line->subTotal->formatted() }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flow-root">
                    <dl class="-my-4 text-sm divide-y divide-gray-100">
                        <div class="flex flex-wrap py-4">
                            <dt class="w-1/2 font-medium">
                                Sub Total
                            </dt>

                            <dd class="w-1/2 text-right">
                                {{ $cart->subTotal->formatted() }}
                            </dd>
                        </div>

                        @if ($this->shippingOption)
                            <div class="flex flex-wrap py-4">
                                <dt class="w-1/2 font-medium">
                                    {{ $this->shippingOption->getDescription() }}
                                </dt>

                                <dd class="w-1/2 text-right">
                                    {{ $this->shippingOption->getPrice()->formatted() }}
                                </dd>
                            </div>
                        @endif

                        @foreach ($cart->taxBreakdown->amounts as $tax)
                            <div class="flex flex-wrap py-4">
                                <dt class="w-1/2 font-medium">
                                    {{ $tax->description }}
                                </dt>

                                <dd class="w-1/2 text-right">
                                    {{ $tax->price->formatted() }}
                                </dd>
                            </div>
                        @endforeach

                        <div class="flex flex-wrap py-4">
                            <dt class="w-1/2 font-medium">
                                Total
                            </dt>

                            <dd class="w-1/2 text-right">
                                {{ $cart->total->formatted() }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-2">
                @include('partials.checkout.address', [
                    'type' => 'shipping',
                    'step' => $steps['shipping_address'],
                ])

                @include('partials.checkout.shipping_option', [
                    'step' => $steps['shipping_option'],
                ])

                @include('partials.checkout.address', [
                    'type' => 'billing',
                    'step' => $steps['billing_address'],
                ])

                @include('partials.checkout.payment', [
                    'step' => $steps['payment'],
                ])
            </div>
        </div>
    </div>
</div>

```


---

**File:** `./resources/views/livewire/checkout-success-page.blade.php`

```blade
<section class="bg-white">
    <div class="max-w-screen-xl px-4 py-32 mx-auto sm:px-6 lg:px-8 lg:py-48">
        <div class="max-w-xl mx-auto text-center">
            <span class="text-xs font-medium text-center bg-orange-100 text-orange-700 px-3 py-1.5 rounded-lg">
                This was a test order
            </span>

            <h1 class="mt-8 text-3xl font-extrabold sm:text-5xl">
                <span class="block"
                      role="img">
                    🥳
                </span>

                <span class="block mt-1 text-blue-500">
                    Order Successful!
                </span>
            </h1>

            <p class="mt-4 font-medium sm:text-lg">
                Your order reference number is

                <strong>
                    {{ $order->reference }}
                </strong>
            </p>

            <a class="inline-block px-8 py-3 mt-8 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:ring-1 hover:ring-blue-600"
               href="{{ url('/') }}">
                Back Home
            </a>
        </div>
    </div>
</section>

```


---

**File:** `./resources/views/livewire/collection-page.blade.php`

```blade
<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            {{ $this->collection->translateAttribute('name') }}
        </h1>

        <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($this->collection->products as $product)
                <x-product-card :product="$product" />
            @empty
            @endforelse
        </div>
    </div>
</section>

```


---

**File:** `./resources/views/livewire/components/add-to-cart.blade.php`

```blade
<div>
    <div class="flex gap-4">
        <div>
            <label for="quantity"
                   class="sr-only">
                Quantity
            </label>

            <input class="w-16 px-1 py-4 text-sm text-center transition border border-gray-100 rounded-lg no-spinner"
                   type="number"
                   id="quantity"
                   min="1"
                   value="1"
                   wire:model.live="quantity" />
        </div>

        <button type="submit"
                class="w-full px-6 py-4 text-sm font-medium text-center text-white bg-indigo-600 rounded-lg hover:bg-indigo-700"
                wire:click.prevent="addToCart">
            Add to Cart
        </button>
    </div>

    @if ($errors->has('quantity'))
        <div class="p-2 mt-4 text-xs font-medium text-center text-red-700 rounded bg-red-50"
             role="alert">
            @foreach ($errors->get('quantity') as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
</div>

```


---

**File:** `./resources/views/livewire/components/cart.blade.php`

```blade
<div class="sm:relative"
     x-data="{
         linesVisible: @entangle('linesVisible').live
     }">
    <button class="grid w-16 h-16 transition border-l border-gray-100 lg:border-l-transparent hover:opacity-75"
            x-on:click="linesVisible = !linesVisible">
        <span class="sr-only">Cart</span>

        <span class="place-self-center">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
        </span>
    </button>

    <div class="absolute inset-x-0 top-auto z-50 w-screen max-w-sm px-6 py-8 mx-auto mt-4 bg-white border border-gray-100 shadow-xl sm:left-auto rounded-xl"
         x-show="linesVisible"
         x-on:click.away="linesVisible = false"
         x-transition
         x-cloak>
        <button class="absolute text-gray-500 transition-transform top-3 right-3 hover:scale-110"
                type="button"
                aria-label="Close"
                x-on:click="linesVisible = false">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div>
            @if ($this->cart)
                @if ($lines)
                    <div class="flow-root">
                        <ul class="-my-4 overflow-y-auto divide-y divide-gray-100 max-h-96">
                            @foreach ($lines as $index => $line)
                                <li>
                                    <div class="flex py-4"
                                         wire:key="line_{{ $line['id'] }}">
                                        @if($line['thumbnail'])
                                        <img class="object-cover w-16 h-16 rounded"
                                             src="{{ $line['thumbnail'] }}">
                                        @endif

                                        <div class="flex-1 ml-4">
                                            <p class="max-w-[20ch] text-sm font-medium">
                                                {{ $line['description'] }}
                                            </p>

                                            <span class="block mt-1 text-xs text-gray-500">
                                                {{ $line['identifier'] }} / {{ $line['options'] }}
                                            </span>

                                            <div class="flex items-center mt-2">
                                                <input class="w-16 p-2 text-xs transition-colors border border-gray-100 rounded-lg hover:border-gray-200"
                                                       type="number"
                                                       wire:model.live="lines.{{ $index }}.quantity" />

                                                <p class="ml-2 text-xs">
                                                    @ {{ $line['unit_price'] }}
                                                </p>

                                                <button class="p-2 ml-auto text-gray-600 transition-colors rounded-lg hover:bg-gray-100 hover:text-gray-700"
                                                        type="button"
                                                        wire:click="removeLine('{{ $line['id'] }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="w-4 h-4"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($errors->get('lines.' . $index . '.quantity'))
                                        <div class="p-2 mb-4 text-xs font-medium text-center text-red-700 rounded bg-red-50"
                                             role="alert">
                                            @foreach ($errors->get('lines.' . $index . '.quantity') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <p class="py-4 text-sm font-medium text-center text-gray-500">
                        Your cart is empty
                    </p>
                @endif

                <dl class="flex flex-wrap pt-4 mt-6 text-sm border-t border-gray-100">
                    <dt class="w-1/2 font-medium">
                        Sub Total
                    </dt>

                    <dd class="w-1/2 text-right">
                        {{ $this->cart->subTotal->formatted() }}
                    </dd>
                </dl>
            @else
                <p class="py-4 text-sm font-medium text-center text-gray-500">
                    Your cart is empty
                </p>
            @endif
        </div>

        @if ($this->cart)
            <div class="mt-4 space-y-4 text-center">
                <button class="block w-full p-3 text-sm font-medium text-blue-800 border border-blue-600 rounded-lg hover:ring-1 hover:ring-blue-600"
                        type="button"
                        wire:click="updateLines">
                    Update Cart
                </button>

                <a class="block w-full p-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                   href="{{ route('checkout.view') }}"
                   wire:navigate
                >
                    Checkout
                </a>

                <a class="inline-block text-sm font-medium text-gray-600 underline hover:text-gray-500"
                   href="{{ url('/') }}">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>
</div>

```


---

**File:** `./resources/views/livewire/components/checkout-address.blade.php`

```blade
<form wire:submit="save"
      class="border rounded shadow-lg">
    <div class="flex justify-between p-4 font-medium border-b">
        <span class="text-xl">{{ ucfirst($type) }} Details</span>
        @if ($type == 'shipping' && $editing)
            <label class="text-sm">
                <input type="checkbox"
                       value="1"
                       wire:model.live="shippingIsBilling" />
                Same as billing
            </label>
        @endif
    </div>
    <div class="p-4 space-y-4">
        @if ($editing)
            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="First name"
                               :errors="$errors->get('address.first_name')"
                               required>
                    <x-input.text wire:model.live="address.first_name"
                                  required />
                </x-input.group>

                <x-input.group label="Last name"
                               :errors="$errors->get('address.last_name')">
                    <x-input.text wire:model.live="address.last_name" />
                </x-input.group>
            </div>

            <div>
                <x-input.group label="Company name"
                               :errors="$errors->get('address.company_name')"
                               required>
                    <x-input.text wire:model.live="address.company_name"
                                  required />
                </x-input.group>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="Contact phone"
                               :errors="$errors->get('address.contact_phone')">
                    <x-input.text wire:model.live="address.contact_phone" />
                </x-input.group>

                <x-input.group label="Contact email"
                               :errors="$errors->get('address.contact_email')">
                    <x-input.text wire:model.live="address.contact_email"
                                  type="email" />
                </x-input.group>
            </div>

            <hr />

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="Address line 1"
                               :errors="$errors->get('address.line_one')"
                               required>
                    <x-input.text wire:model.live="address.line_one"
                                  required />
                </x-input.group>

                <x-input.group label="Address line 2"
                               :errors="$errors->get('address.line_two')">
                    <x-input.text wire:model.live="address.line_two" />
                </x-input.group>

                <x-input.group label="Address line 3"
                               :errors="$errors->get('address.line_three')">
                    <x-input.text wire:model.live="address.line_three" />
                </x-input.group>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="City"
                               :errors="$errors->get('address.city')"
                               required>
                    <x-input.text wire:model.live="address.city"
                                  required />
                </x-input.group>

                <x-input.group label="State / Province"
                               :errors="$errors->get('address.state')">
                    <x-input.text wire:model.live="address.state" />
                </x-input.group>

                <x-input.group label="Postcode"
                               :errors="$errors->get('address.postcode')"
                               required>
                    <x-input.text wire:model.live="address.postcode"
                                  required />
                </x-input.group>
            </div>

            <div>
                <x-input.group label="Country"
                               required>
                    <select class="w-full p-4 text-sm border-2 border-gray-200 rounded-lg"
                            wire:model.live="address.country_id">
                        <option value>Select a country</option>
                        @foreach ($this->countries as $country)
                            <option value="{{ $country->id }}"
                                    wire:key="country_{{ $country->id }}">
                                {{ $country->native }}
                            </option>
                        @endforeach
                    </select>
                </x-input.group>
            </div>
        @else
            <dl class="flex">
                <div class="w-1/2">
                    <div class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium">Name</dt>
                            <dd>{{ $address->first_name }} {{ $address->last_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Company</dt>
                            <dd>{{ $address->company_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Phone Number</dt>
                            <dd>{{ $address->contact_phone }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Email</dt>
                            <dd>{{ $address->contact_email }}</dd>
                        </div>
                    </div>
                </div>

                <div class="w-1/2">
                    <dt class="text-sm font-medium">Address</dt>
                    <dd>
                        {{ $address->line_one }}<br>
                        @if ($address->line_two)
                            {{ $address->line_two }}<br>
                        @endif
                        @if ($address->line_three)
                            {{ $address->line_three }}<br>
                        @endif
                        @if ($address->city)
                            {{ $address->city }}<br>
                        @endif
                        {{ $address->state }}<br>
                        {{ $address->postcode }}<br>
                        {{ $address->country()->first()->native }}
                    </dd>
                </div>
            </dl>
        @endif
    </div>
    <div class="flex justify-end w-full p-4 bg-gray-100">
        <div>
            @if ($editing)
                <button type="submit"
                        wire:key="submit_btn"
                        class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                    Continue
                </button>
            @else
                <button type="button"
                        wire:key="edit_btn"
                        wire:click.prevent="$set('editing', true)"
                        class="px-5 py-3 font-medium bg-white border rounded-lg shadow-sm hover:bg-gray-50">
                    Edit Details
                </button>
            @endif
        </div>
    </div>
</form>

```


---

**File:** `./resources/views/livewire/components/navigation.blade.php`

```blade
<header class="relative border-b border-gray-100">
    <div class="flex items-center justify-between h-16 px-4 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
        <div class="flex items-center">
            <a class="flex items-center flex-shrink-0"
               href="{{ url('/') }}"
               wire:navigate
            >
                <span class="sr-only">Home</span>

                <x-brand.logo class="w-auto h-6 text-indigo-600" />
            </a>

            <nav class="hidden lg:gap-4 lg:flex lg:ml-8">
                @foreach ($this->collections as $collection)
                    <a class="text-sm font-medium transition hover:opacity-75"
                       href="{{ route('collection.view', $collection->defaultUrl->slug) }}"
                       wire:navigate
                    >
                        {{ $collection->translateAttribute('name') }}
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="flex items-center justify-between flex-1 ml-4 lg:justify-end">
            <x-header.search class="max-w-sm mr-4" />

            <div class="flex items-center -mr-4 sm:-mr-6 lg:mr-0">
                @livewire('components.cart')

                <div x-data="{ mobileMenu: false }">
                    <button x-on:click="mobileMenu = !mobileMenu"
                            class="grid flex-shrink-0 w-16 h-16 border-l border-gray-100 lg:hidden">
                        <span class="sr-only">Toggle Menu</span>

                        <span class="place-self-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </span>
                    </button>

                    <div x-cloak
                         x-transition
                         x-show="mobileMenu"
                         class="absolute right-0 top-auto z-50 w-screen p-4 sm:max-w-xs">
                        <ul x-on:click.away="mobileMenu = false"
                            class="p-6 space-y-4 bg-white border border-gray-100 shadow-xl rounded-xl">
                            @foreach ($this->collections as $collection)
                                <li>
                                    <a class="text-sm font-medium"
                                       href="{{ route('collection.view', $collection->defaultUrl->slug) }}"
                                       wire:navigate
                                    >
                                        {{ $collection->translateAttribute('name') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

```


---

**File:** `./resources/views/livewire/components/shipping-options.blade.php`

```blade
<form wire:submit="save"
      class="border rounded shadow-lg">
    <div class="flex justify-between p-4 font-medium">
        <span class="text-xl">Shipping Option</span>
    </div>
    @if ($this->shippingAddress)
        <div class="p-4 border-t">
            @foreach ($this->shippingOptions as $option)
                <label class="flex items-center w-full cursor-pointer"
                       wire:key="shipping_option_{{ $option->getIdentifier() }}">
                    <input type="radio"
                           wire:model.live="chosenOption"
                           value="{{ $option->getIdentifier() }}" />
                    <div class="flex items-center ml-2">
                        <span class="block mr-2 text-2xl">{{ $option->getPrice()->formatted() }}</span>
                        {{ $option->name }}
                    </div>
                </label>
            @endforeach
        </div>
    @else
    @endif
    @if ($errors->has('chosenOption'))
        <p class="p-4 text-sm text-red-500">{{ $errors->first('chosenOption') }}</p>
    @endif
    <div class="flex justify-end w-full p-4 bg-gray-100">
        <div>
            <button type="submit"
                    wire:key="submit_btn"
                    class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                Continue
            </button>
        </div>
    </div>
</form>

```


---

**File:** `./resources/views/livewire/home.blade.php`

```blade
<div>
    <x-welcome-banner />

    <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-12 sm:px-6 lg:px-8">
        @if ($this->saleCollection)
            <x-collection-sale />
        @endif

        @if ($this->randomCollection)
            <section>
                <h2 class="text-3xl font-bold">
                    {{ $this->randomCollection->translateAttribute('name') }}
                </h2>

                <div class="grid grid-cols-2 mt-8 lg:grid-cols-4 gap-x-4 gap-y-8">
                    @foreach ($this->randomCollection->products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

```


---

**File:** `./resources/views/livewire/product-page.blade.php`

```blade
<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <div class="grid items-start grid-cols-1 gap-8 md:grid-cols-2">
            <div class="grid grid-cols-2 gap-4 md:grid-cols-1">
                @if ($this->image)
                    <div class="aspect-w-1 aspect-h-1">
                        <img class="object-cover rounded-xl"
                             src="{{ $this->image->getUrl('large') }}"
                             alt="{{ $this->product->translateAttribute('name') }}" />
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                    @foreach ($this->images as $image)
                        <div class="aspect-w-1 aspect-h-1"
                             wire:key="image_{{ $image->id }}">
                            <img loading="lazy"
                                 class="object-cover rounded-xl"
                                 src="{{ $image->getUrl('small') }}"
                                 alt="{{ $this->product->translateAttribute('name') }}" />
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-bold">
                        {{ $this->product->translateAttribute('name') }}
                    </h1>

                    <x-product-price class="ml-4 font-medium"
                                     :variant="$this->variant" />
                </div>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $this->variant->sku }}
                </p>

                <article class="mt-4 text-gray-700">
                    {!! $this->product->translateAttribute('description') !!}
                </article>

                <form class="mt-4">
                    <div class="space-y-4">
                        @foreach ($this->productOptions as $option)
                            <fieldset>
                                <legend class="text-xs font-medium text-gray-700">
                                    {{ $option['option']->translate('name') }}
                                </legend>

                                <div class="flex flex-wrap gap-2 mt-2 text-xs tracking-wide uppercase"
                                     x-data="{
                                         selectedOption: @entangle('selectedOptionValues').live,
                                         selectedValues: [],
                                     }"
                                     x-init="selectedValues = Object.values(selectedOption);
                                     $watch('selectedOption', value =>
                                         selectedValues = Object.values(selectedOption)
                                     )">
                                    @foreach ($option['values'] as $value)
                                        <button class="px-6 py-4 font-medium border rounded-lg focus:outline-none focus:ring"
                                                type="button"
                                                wire:click="
                                                $set('selectedOptionValues.{{ $option['option']->id }}', {{ $value->id }})
                                            "
                                                :class="{
                                                    'bg-indigo-600 border-indigo-600 text-white hover:bg-indigo-700': selectedValues
                                                        .includes({{ $value->id }}),
                                                    'hover:bg-gray-100': !selectedValues.includes({{ $value->id }})
                                                }">
                                            {{ $value->translate('name') }}
                                        </button>
                                    @endforeach
                                </div>
                            </fieldset>
                        @endforeach
                    </div>

                    <div class="max-w-xs mt-8">
                        <livewire:components.add-to-cart :purchasable="$this->variant"
                                                         :wire:key="$this->variant->id">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

```


---

**File:** `./resources/views/livewire/search-page.blade.php`

```blade
<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            Search Results
            @if (isset($term))
                for <u>{{ $term }}</u>
            @endif
        </h1>

        <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($this->results as $result)
                <x-product-card :product="$result" />
            @endforeach
        </div>
    </div>
</section>

```

### Configuration Files


---

**File:** `./package.json`

```json
{
    "private": true,
    "type": "module",
    "scripts": {
        "dev": "vite",
        "build": "vite build"
    },
    "devDependencies": {
        "@ryangjchandler/alpine-clipboard": "^2.3.0",
        "@tailwindcss/forms": "^0.5.7",
        "autoprefixer": "^10.4.17",
        "axios": "^1.6.1",
        "laravel-vite-plugin": "^0.8.0",
        "postcss": "^8.4.35",
        "tailwindcss": "^3.4.1",
        "vite": "^4.0.0"
    }
}

```


---

**File:** `./tailwind.config.js`

```javascript
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/lunarphp/stripe-payments/resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [require('@tailwindcss/forms')],
};

```


---

**File:** `./vite.config.js`

```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});

```

