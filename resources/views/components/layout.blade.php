<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@isset($doctitle)
        {{ $doctitle }} | OurApp
        @else
        OurApp
        @endisset
    </title>
    @vite('resources/js/app.js')
</head>

<body class="h-full bg-gray-700">

    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex items-center justify-between mx-10 p-4">
            <a href="{{ auth()->check() ? route('feed') : route('home') }}" class="flex items-center">
                <img src="/images/code-break.svg" class="h-8 mr-3" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Develsopher's
                    Blog</span>
            </a>
            <div class="flex items-center" id="navbar-default">
                @auth
                    {{-- 로그인 된 화면 --}}
                    <div>
                        <a href="#" class="text-white mr-2 header-search-icon" title="Search" data-toggle="tooltip" data-placement="bottom">Search</a>
                    </div>
                    <div class="ml-2">
                        <a href="#" class="text-white mr-2 header-chat-icon" title="Chat" data-toggle="tooltip" data-placement="bottom">Chat</a>
                    </div>
                    <div class=" ml-4 flex items-center space-x-2">
                        <a href="/{{ auth()->user()->name }}/posts" role="button">
                            <img src="/storage/avatars/{{ auth()->user()->avatar }}" alt="avatar" class="w-10 h-10 rounded-full">
                        </a>
                        <p class="text-white"><span class="text-indigo-400">Welcome,</span> {{ auth()->user()->name }}</p>
                    </div>
                    <button type="button" onclick="location.href='{{ route('post.create') }}'" class="ml-4 text-white bg-blue-800 hover:bg-blue-400 focus:outline-none rounded-lg text-sm px-5 py-2.5 text-center">Create Post</button>
                    <form action="/logout" method="POST" class="">
                        @csrf
                        <button class="ml-4 text-white bg-gray-800 hover:bg-gray-400 focus:outline-none rounded-lg text-sm px-5 py-2.5 text-center">Sign Out</button>
                    </form>
                @else
                    {{-- 로그인 폼 --}}
                    <form action="/login" method="POST" class="mb-0 pt-2">
                        @csrf
                        <div class="flex items-center">
                            <div class="col-md mr-3 pr-md-0 mb-3 mb-md-0">
                                <input type="email" id="email" name="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="email" required>
                            </div>
                            <div class="col-md mr-3 pr-md-0 mb-3 mb-md-0">
                                <input type="password" id="password" name="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="password" required>
                            </div>
                            <div class="col-md pr-md-0 mb-3 mb-md-0">
                                <button
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
                            </div>
                        </div>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    @if (session()->has('success'))
        <div class="bg-gray-900 w-full py-4">
            <div class="w-80 bg-gray-500 shadow-inner shadow-gray-500/50 ml-auto mr-auto rounded-lg">
                <p class="text-center text-white">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    @endif

    @if (session()->has('failure'))
        <div class="bg-gray-900 w-full py-4">
            <div class="w-80 bg-gray-500 shadow-inner shadow-gray-500/50 ml-auto mr-auto rounded-lg">
                <p class="text-center text-red-700">
                    {{ session('failure') }}
                </p>
            </div>
        </div>
    @endif

    {{ $slot }}
    <footer class="w-full border-top bg-gray-900 text-center small text-muted py-3">
        <p class="m-0 text-white">Copyright &copy; {{ date('Y') }} <a href="/" class="text-muted">OurApp</a>.
            All rights reserved.
        </p>
    </footer>
    @auth
    <div data-username="{{ auth()->user()->name }}" data-avatar="{{ auth()->user()->avatar }}"id="chat-wrapper" class="chat-wrapper shadow-ls"></div>
    @endauth
    @yield('scripts')
    <script>
        // $('[data-toggle="tooltip"]').tooltip()
    </script>
</body>
</html>
