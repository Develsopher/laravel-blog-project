<x-layout :doctitle="$post->title">
    <div class="h-full flex justify-center items-center">
        <div class="container bg-white width-4/5 max-w-screen-md rounded-md px-20 py-10 shadow-lg shadow-gray-500">
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
                <h1 class="text-3xl text-center">The Post # {{ $post->id }}</h1>
                <div class="flex flex-col mt-4">
                    <label for="title" class="text-xl">Title</label>
                    <input type="text" name="title" value="{{ $post->title }}" class="border border-gray-300 rounded-lg p-2.5 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300" placeholder="Enter the title..." disabled required>
                    @error('title')
                        <p class="m-0 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col mt-4">
                    <label for="content" class="text-xl">Content</label>
                    <textarea name="content" cols="30" rows="10" class="border border-gray-300 rounded-lg p-2.5 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300" placeholder="Enter the Contents..." disabled required>{{  $post->content  }}</textarea>
                    @error('content')
                    <p class="m-0 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-center mt-4 gap-x-4">
                    <button type="submit" id="save_button" class="bg-gray-500 text-white hover:bg-gray-700 rounded-lg text-lg px-5 py-2.5 focus:outline-none focus:ring focus:ring-gray-300 hidden">Edit
                        The Post</button>
                    <a href="{{ route('feed') }}" class="text-lg px-5 py-2.5 text-center focus:outline-none focus:ring focus:ring-gray-300">Return To Main</a>
                </div>
            </form>
        </div>
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
