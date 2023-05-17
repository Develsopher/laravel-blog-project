<x-layout>
    <div class="h-full bg-gray-700">
        <div class="container mx-auto p-10">
            {{-- posts's header --}}
            <div class="grid grid-cols-4 px-44">
                {{-- headers' avatar --}}
                <div class="flex flex-col gap-2 items-center">
                    <a href="{{ route('user.posts', $user->name) }}">
                        <img src="/storage/avatars/{{ $user->avatar }}" alt="avatar" class="w-24 h-24 rounded-full">
                    </a>
                    <p class="text-white text-xl">{{ $user->name }}</p>
                    @auth
                        {{-- 본인일 경우, 아바타 수정이 가능하다. --}}
                        @if ($user->name == auth()->user()->name)
                            <a href="{{ route('user.avatar') }}" role="button"
                                class="rounded-lg text-white bg-blue-800 hover:bg-blue-400 focust:outlien-none text-sm px-5 py-2.5 text-center">
                                Manage Avatar
                            </a>
                        @elseif($isFollowing)
                            <form action="{{ route('unfollow', $user->name) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="rounded-lg text-white bg-red-800 hover:bg-red-400 focust:outlien-none text-sm px-5 py-2.5 text-center">-
                                    Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('follow', $user->name) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="rounded-lg text-white bg-blue-800 hover:bg-blue-400 focust:outlien-none text-sm px-5 py-2.5 text-center">+
                                    Follow</button>
                            </form>
                        @endif


                    @endauth
                </div>
                {{-- headers's posting count --}}
                <a href="{{ route('user.posts', $user->name) }}" class="flex flex-col justify-center items-center">
                    <p class="text-white">Posts</p>
                    <p class="text-white text-xl font-semibold">{{ $postCount }}</p>
                </a>
                {{-- header's followers count --}}
                <div class="flex flex-col justify-center items-center">
                    <p class="text-white">Followers</p>
                    <p class="text-white text-xl font-semibold">{{ $postCount }}</p>
                </div>
                {{-- header's following count --}}
                <div class="flex flex-col justify-center items-center">
                    <p class="text-white">Following</p>
                    <p class="text-white text-xl font-semibold">{{ $postCount }}</p>
                </div>
            </div>
            {{-- profile's body (my posts, followers, followings, follwers' posting etc anyone) --}}

            {{ $slot }}
        </div>
    </div>
</x-layout>
