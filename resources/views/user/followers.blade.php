<x-profile_header :userData="$userData">
    <ul class="w-1/2 mx-auto">
        @forelse ($userData['user']->followers as $follower)
            <li
                class="flex justify-between items-center bg-gray-900 border-gray-200 rounded-lg shadow-sm mt-4 px-10 py-4">
                <img src="/storage/avatars/{{ $follower->followerUser->avatar }}" alt="avatar"
                    class="w-12 h-12 rounded-full">
                <div class="text-white">{{ $follower->followerUser->name }}</div>
                @foreach ($userData['user']->following as $following)
                    @if ($following->followingUser->id  === $follower->followerUser->id)
                        {{-- Am i following ? YES --}}
                        <button type="submit"
                            class="rounded-lg text-white bg-red-800 hover:bg-red-400 focust:outlien-none text-sm px-5 py-2.5 text-center">
                            Unfollow</button>
                    @else
                        {{-- Am i following ? NO --}}
                        <button type="submit"
                            class="rounded-lg text-white bg-blue-800 hover:bg-blue-400 focust:outlien-none text-sm px-5 py-2.5 text-center">
                            Follow</button>
                    @endif
                @endforeach
            </li>
        @empty
            <div class="text-white">There is no follower.</div>
        @endforelse
    </ul>
</x-profile_header>
