<x-profile_header :userData="$userData">
    <ul class="w-1/2 mx-auto">
        @forelse ($userData['user']->followers as $follower)
            <li
                class="flex items-center gap-10 bg-gray-900 border-gray-200 rounded-lg shadow-sm mt-4 px-10 py-4">
                <img src="/storage/avatars/{{ $follower->followerUser->avatar }}" alt="avatar"
                    class="w-12 h-12 rounded-full">
                <a href="{{ route('user.posts', $follower->followerUser->name) }}">
                    <div class="text-white">{{ $follower->followerUser->name }}</div>
                </a>
                {{-- <div class="text-white">{{ $userData['user']->following }}</div> --}}
                {{-- @foreach ($userData['user']->following as $following)
                    @if ($following->followingUser->id === $follower->followerUser->id)
                        <button type="submit"
                            class="rounded-lg text-white bg-red-800 hover:bg-red-400 focust:outlien-none text-sm px-5 py-2.5 text-center">
                            Unfollow</button>
                    @else
                        <form action="{{ route('follow', $follower->followerUser->name) }}" method="POST">
                            @csrf
                            <button type="submit"
                            class="rounded-lg text-white bg-blue-800 hover:bg-blue-400 focust:outlien-none text-sm px-5 py-2.5 text-center">
                            Follow</button>
                        </form>
                    @endif
                @endforeach --}}
            </li>
        @empty
            <div class="text-white">There is no follower.</div>
        @endforelse
    </ul>
    <?=var_dump(gettype($userData['user']->following))?>
    <div class="text-white">{{ $userData['user']->following[0]->id  }}</div>
    <div class="text-white">{{ auth()->user() }}</div>
    <div class="text-white">{{ $userData['user']->name }}</div>
</x-profile_header>
