<x-layout doctitle="{{ $userData['user']->name }}'s Profile">
    <div class="h-full">
        <div class="container mx-auto p-10">
            {{-- posts's header --}}
            <div class="grid grid-cols-4 px-44">
                {{-- headers' avatar --}}
                <div class="flex flex-col gap-2 items-center">
                    <a href="{{ route('user.posts', $userData['user']->name) }}">
                        <img src="/storage/avatars/{{ $userData['user']->avatar }}" alt="avatar" class="w-24 h-24 rounded-full">
                    </a>
                    <p class="text-white text-xl">{{ $userData['user']->name }}</p>
                    @auth
                        {{-- 본인일 경우, 아바타 수정이 가능하다. --}}
                        @if ($userData['user']->name == auth()->user()->name)
                            <a href="{{ route('user.avatar') }}" role="button"
                                class="rounded-lg text-white bg-blue-800 hover:bg-blue-400 focust:outlien-none text-sm px-5 py-2.5 text-center">
                                Manage Avatar
                            </a>
                        @elseif($userData['isFollowing'])
                            <form action="{{ route('unfollow', $userData['user']->name) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="rounded-lg text-white bg-red-800 hover:bg-red-400 focust:outlien-none text-sm px-5 py-2.5 text-center">
                                    Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('follow', $userData['user']->name) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="rounded-lg text-white bg-blue-800 hover:bg-blue-400 focust:outlien-none text-sm px-5 py-2.5 text-center">
                                    Follow</button>
                            </form>
                        @endif


                    @endauth
                </div>
                {{-- headers's posting count --}}
                <a href="{{ route('user.posts', $userData['user']->name) }}" class="flex flex-col justify-center items-center">
                    <p class=" {{ Request::segment(2) == "posts" ? "text-gray-900" : "text-white" }}">Posts</p>
                    <p class=" {{ Request::segment(2) == "posts" ? "text-gray-900" : "text-white" }} text-xl font-semibold">{{ $userData['postCount'] }}</p>
                </a>

                {{-- header's followers count --}}
                <a href="{{ route('followers', $userData['user']->name) }}" class="flex flex-col justify-center items-center">
                    <p class="{{ Request::segment(2) == "followers" ? "text-gray-900" : "text-white" }}">Followers</p>
                    <p class="{{ Request::segment(2) == "followers" ? "text-gray-900" : "text-white" }} text-xl font-semibold">{{ $userData['user']->followers->count() }}</p>
                </a>
                {{-- header's following count --}}
                <a href="{{ route('followings', $userData['user']->name) }}" class="flex flex-col justify-center items-center">
                    <p class="{{ Request::segment(2) == "followings" ? "text-gray-900" : "text-white" }}">Following</p>
                    <p class="{{ Request::segment(2) == "followings" ? "text-gray-900" : "text-white" }} text-xl font-semibold">{{ $userData['user']->following->count() }}</p>
                </a>
            </div>
            {{-- profile's body (my posts, followers, followings, follwers' posting etc anyone) --}}

            {{ $slot }}
        </div>
    </div>
</x-layout>
