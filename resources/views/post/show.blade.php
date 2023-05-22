<x-layout>
    <div class="h-full p-10">
        <div class="mt-2 flex justify-end items-center space-x-2">
            @can('update', $post)
                <button type="button" id="edit_button">수정하기</button>
            @endcan
            @can('delete', $post)
                <form id="delete_form" action="/post/{{ $post->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" onclick="handleDelete()"><img class="w-5 h-5" src="/images/delete-icon.svg" /></button>
            @endcan
        </div>

        <form action="/post/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="text-3xl text-center text-white">The Post # {{ $post->id }}</h1>
            <div class="space-y-8 mt-8 px-52">
                <div>
                    <label for="title" class="block mb-2 text-md font-medium text-white">Title</label>
                    <input type="text" name="title" value="{{ $post->title }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled required>
                    @error('title')
                        <p class="m-0 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="content" class="block mb-2 text-md font-medium text-white">Content</label>
                    <textarea type="text" name="content"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        style="height:350px;" disabled required>{{ $post->content }}</textarea>
                    @error('content')
                        <p class="m-0 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button type="submit" id="save_button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hidden">Edit
                    The Post</button>
                <a href="{{ route('home') }}"
                    class="ml-4 text-white bg-gray-800 hover:bg-gray-400 focus:outline-none rounded-lg text-sm px-5 py-2.5 text-center">Return
                    To Main</a>
            </div>
        </form>
    </div>
</x-layout>
<script type="text/javascript">
    const editBtn = document.getElementById('edit_button');
    const saveBtn = document.getElementById('save_button');
    const buttonPressed = (e) => {
        e.target.classList.toggle("bg-red-400");
        e.target.innerText = e.target.innerText.trim() === "수정 중" ? "수정하기" : "수정 중";

        if (e.target.classList.contains('bg-red-400')) {
            document.getElementsByName('title')[0].removeAttribute('disabled');
            document.getElementsByName('content')[0].removeAttribute('disabled');
            saveBtn.classList.remove('hidden');
        } else {
            document.getElementsByName('title')[0].setAttribute('disabled', true);
            document.getElementsByName('content')[0].setAttribute('disabled', true);
            saveBtn.classList.add('hidden');
        }

    }
    if(editBtn) {
        editBtn.addEventListener("click", buttonPressed);
    }

    function handleDelete() {
        if(confirm('해당 게시글을 정말 삭제하시겠습니까?')){
            document.getElementById('delete_form').submit();
        }
    }
</script>
