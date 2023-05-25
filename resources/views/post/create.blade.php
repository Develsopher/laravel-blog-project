<x-layout>
    <div class="h-full flex justify-center items-center">
        <div class="container bg-white width-4/5 max-w-screen-md rounded-md px-20 py-10 shadow-lg shadow-gray-500">
            <form action="/post/store" method="POST">
                @csrf
                <h1 class="text-3xl text-center">Let's Write !</h1>
                <div class="flex flex-col mt-4">
                    <label for="title" class="text-xl">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="border border-gray-300 rounded-lg p-2.5 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300" placeholder="Enter the title..." required>
                    @error('title')
                        <p class="m-0 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col mt-4">
                    <label for="content" class="text-xl">Content</label>
                    <textarea name="content" cols="30" rows="10" class="border border-gray-300 rounded-lg p-2.5 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300" placeholder="Enter the Contents..." required>{{ old('content') }}</textarea>
                    @error('content')
                    <p class="m-0 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-center mt-4 gap-x-4">
                    <button type="submit" class="bg-gray-500 text-white hover:bg-gray-700 rounded-lg text-lg px-5 py-2.5 focus:outline-none focus:ring focus:ring-gray-300">Save The Post</button>
                    <a href="{{route('feed')}}" class="text-lg px-5 py-2.5 text-center focus:outline-none focus:ring focus:ring-gray-300">Return To Main</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
