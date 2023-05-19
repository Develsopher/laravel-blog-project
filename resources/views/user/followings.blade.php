<x-profile_header :userData="$userData">
    <ul class="w-1/2 mx-auto">
        @forelse ($userData['user']->following as $following)
            <li
                class="flex justify-between items-center bg-gray-900 border-gray-200 rounded-lg shadow-sm mt-4 px-10 py-4">
                <img src="/storage/avatars/{{ $following->followingUser->avatar }}" alt="avatar"
                    class="w-12 h-12 rounded-full">
                    <a href="{{ route('user.posts', $following->followingUser->name) }}">
                <div class="text-white">{{ $following->followingUser->name }}</div>
                    </a>
                {{-- Am i following ? YES --}}
                <button type="submit"
                class="rounded-lg text-white bg-red-800 hover:bg-red-400 focust:outlien-none text-sm px-5 py-2.5 text-center">
                Unfollow</button>
            </li>
        @empty
            <div class="text-white">There is no follower.</div>
        @endforelse
    </ul>
</x-profile_header>
