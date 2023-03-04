<x-admin-layout>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-2 mt-6">
        @foreach ($movies as $movie)
            <x-card class="flex">



                <img src="{{ $movie->poster_link }}" alt="" class=" w-1/3 object-cover">
                <div class="p-2 ">
                    <h2 class="font-bold text-lg">{{ $movie->title }}</h2>
                    <p>release date: {{ $movie->release_date }}</p>
                    <x-secondary-button data-trailer="{{ $movie->trailer_link }}" x-data=""
                        x-on:click.prevent="openModal(event), $dispatch('open-modal', 'trailer_preview')">Preview
                        Trailer</x-secondary-button>
                    <div class="flex gap-2 mt-2">
                        <a href="{{ route('admin.movies.edit', $movie->id) }}"
                            class="bg-green-200 dark:bg-green-800 rounded px-2 py-1">
                            <x-ri-edit-2-fill />
                        </a>
                        <a class="bg-green-200 dark:bg-green-800 rounded px-2 py-1">
                            <x-ri-eye-fill />
                        </a>
                        <button class="bg-red-200 dark:bg-red-800 rounded px-2 py-1" x-data=""
                            x-on:click.prevent=" $dispatch('open-modal', 'confirm-movie-deletion{{ $movie->id }}')">
                            <x-ri-delete-bin-5-fill />
                        </button>


                        <x-modal name="confirm-movie-deletion{{ $movie->id }}" focusable>
                            <form method="post" action="{{ route('admin.movies.delete', $movie->id) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to delete this movie?') }}
                                </h2>

                                <img id="select_poster_preview" style="height: 5rem" src="{{ $movie->poster_link }}" />
                                <p>Title: {{ $movie->title }} </p>
                                <p>release date: {{ $movie->release_date }}</p>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3">
                                        {{ __('Delete Movie') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>
                </div>
            </x-card>
        @endforeach


    </div>
    <div class="my-5 p-2">
        {{ $movies->appends(Request::all())->onEachSide(1)->links('pagination.tailwind') }}
    </div>


    <x-modal name="trailer_preview">
        <div class="container">
            <iframe id="videoLink" frameborder="0" allowfullscreen class="video"></iframe>
        </div>
    </x-modal>
    <style>
        .container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
        }

        .video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <script>
        function openModal(el) {

            // alert('asd')

            var iframe = document.getElementById('videoLink')
            var src = el.target.getAttribute('data-trailer')
            iframe.setAttribute('src', 'https://www.youtube.com/embed/' + getId(src))

        }

        function getId(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            const match = url.match(regExp);

            return (match && match[2].length === 11) ?
                match[2] :
                null;
        }
    </script>


</x-admin-layout>
