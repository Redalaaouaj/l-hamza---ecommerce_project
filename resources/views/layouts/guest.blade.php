<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-200">
    <div class="min-h-screen ">
        <nav x-data="{ open: false }" class="bg-gray-200 border-b border-gray-400">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">

                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('products.index') }}">
                            <img src="{{asset('favicon.ico')}}" alt="logo">
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="flex">
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                {{ __('Register') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                {{ __('Login') }}
                            </x-nav-link>
                        </div>
                    </div>


                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white  shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <div class="w-full sm:max-w-md mt-6 mx-auto px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>