<x-layout>
    <div class="h-screen bg-gray-700 p-10">
        <form action="/post/store" method="POST">
            @csrf
            <h1 class="text-3xl text-center text-white">Let's Write !</h1>
            <div class="space-y-8 mt-8 px-52">
                <div>
                    <label for="title" class="block mb-2 text-md font-medium text-white">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    @error('title')
                    <p class="m-0 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="content" class="block mb-2 text-md font-medium text-white">Content</label>
                    <textarea type="text" name="content" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="height:350px;" required>{{ old('content') }}</textarea>
                    @error('content')
                    <p class="m-0 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save The Post</button>
                <a href="{{route('home')}}" class="ml-4 text-white bg-gray-800 hover:bg-gray-400 focus:outline-none rounded-lg text-sm px-5 py-2.5 text-center">Return To Main</a>
            </div>
        </form>
    </div>
</x-layout>
