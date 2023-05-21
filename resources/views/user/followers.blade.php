<x-profile_header :userData="$userData">
    <ul class="w-1/2 mx-auto">
        @forelse ($userData['user']->followers as $follower)
            <li
                class="flex flex-row items-center bg-gray-900 border-gray-200 rounded-lg shadow-sm mt-4 px-10 py-4">
                <div class="basis-1/3">
                    <img src="/storage/avatars/{{ $follower->followerUser->avatar }}" alt="avatar"
                    class="w-12 h-12 rounded-full">
                </div>
                <div class="text-white basis-1/3 text-center">
                    <a href="{{ route('user.posts', $follower->followerUser->name) }}">
                        {{ $follower->followerUser->name }}
                    </a>
                </div>

            </li>
        @empty
            <div class="text-white">There is no follower.</div>
        @endforelse
    </ul>
</x-profile_header>
