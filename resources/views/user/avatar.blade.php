<x-layout>
    <div class="h-full bg-gray-700 flex justify-center items-center">

        <div class="container mx-auto  p-10 bg-gray-900 rounded-xl drop-shadow-lg">
            <div class="grid grid-cols-4">
                <div class="flex flex-col justify-center items-center gap-2">
                    <img src="/storage/avatars/{{ auth()->user()->avatar }}" alt="avatar" class="w-48 h-48 rounded-full">
                    <p class="text-center text-white text-xl">{{ auth()->user()->name }}</p>
                </div>
                <div class="flex items-center">
                    <form action="{{ route('user.avatar.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input class="mb-2" type="file" name="avatar" required>
                        <button type="submit"
                            class="rounded-full text-white bg-blue-800 hover:bg-blue-400 focust:outlien-none text-sm px-5 py-2.5 text-center">Upload
                            Avatar</button>
                        @error('avatar')
                            <p class="m-0 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
