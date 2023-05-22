<x-layout>
    <div class="bg-gray-700">
        <div class="container mx-auto p-10">
            <div class="grid gap-8 mt-4">
                @forelse ($feeds as $feed)
                    <article
                        class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-900 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            {{-- userData['posts'] topic (나중에 추가예정) --}}
                            <span
                                class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                    </path>
                                </svg>
                                Tutorial
                            </span>
                            {{-- Carbon, Diff For Humans --}}
                            <span class="text-sm">{{ $feed->created_at->diffForHumans() }}</span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a
                                href="{{ route('post.show', $feed->id) }}">{{ $feed->title }}</a></h2>
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ Str::limit($feed->content, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('user.posts', $feed->user->name) }}" class="flex gap-4">
                                    <img class="w-7 h-7 rounded-full"
                                    src="/storage/avatars/{{ $feed->user->avatar }}"
                                        alt="avatar" />
                                    <span class="font-medium dark:text-white">
                                        {{ $feed->user->name }}
                                    </span>
                                </a>
                            </div>
                            <a href="{{ route('post.show', $feed->id) }}"
                                class="inline-flex items-center font-medium text-white hover:underline">
                                Read more
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="h-screen">
                        <div class="ml-auto mr-auto rounded-lg border border-gray-200 shadow-md dark:bg-gray-900 dark:border-gray-700">
                            <h1 class="text-center text-white text-3xl font-semibold p-10">No Feeds. :< </h1>
                        </div>
                    </div>
                @endforelse
                {{ $feeds->links() }}
            </div>
        </div>
    </div>
</x-layout>
