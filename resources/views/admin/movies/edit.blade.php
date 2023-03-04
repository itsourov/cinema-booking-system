<x-admin-layout>
    <div class="my-10 px-2 md:px-5 ">
        <x-card class="max-w-3xl mx-auto py-8 px-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Movie</h2>


            <form action="{{ route('admin.movies.update', $movie->id) }}" method="post" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label :value="__('Movie title')" />
                    <x-text-input placeholder="Title here" name="title" type="text" :value="old('title', $movie->title)" />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />

                </div>
                <div>
                    <x-input-label :value="__('Movie synopsis')" />
                    <x-text-input placeholder="Synopsis here" name="synopsis" type="text" :value="old('synopsis', $movie->synopsis)" />
                    <x-input-error class="mt-2" :messages="$errors->get('synopsis')" />

                </div>
                <div>
                    <x-input-label :value="__('Movie trailer link')" />
                    <x-text-input placeholder="trailer link here" name="trailer_link" type="text"
                        :value="old('trailer_link', $movie->trailer_link)" />
                    <x-input-error class="mt-2" :messages="$errors->get('trailer_link')" />

                </div>
                <div>
                    <img id="select_poster_preview" style="height: 5rem"
                        src="{{ old('poster_link', $movie->poster_link) }}" />
                    <x-input-label :value="__('poster link')" />
                    <div class="flex items-center">
                        <x-text-input id="select_poster_input" placeholder="poster_link" name="poster_link"
                            type="text" :value="old('poster_link', $movie->poster_link)" />
                        <x-secondary-button class="mb-0 " id="select_poster_button" data-input="select_poster_input"
                            data-preview="select_poster_preview">
                            Chose</x-secondary-button>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('poster_link')" />

                </div>
                <div>
                    <x-input-label :value="__('Movie release date')" />
                    <x-text-input placeholder="release_date" name="release_date" :value="old('release_date', $movie->release_date)" type="date" />
                    <x-input-error class="mt-2" :messages="$errors->get('release_date')" />

                </div>

                <x-primary-button>
                    Submit
                </x-primary-button>
            </form>
        </x-card>
    </div>



    <script>
        var lfm = function(id, type, options) {
            let button = document.getElementById(id);

            button.addEventListener('click', function() {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                var target_input = document.getElementById(button.getAttribute('data-input'));
                var target_preview = document.getElementById('select_poster_preview');

                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                    'width=900,height=600');
                window.SetUrl = function(items) {
                    var file_path = items.map(function(item) {
                        return item.url;
                    }).join(',');


                    // set the value of the desired input to image url
                    target_input.value = file_path;
                    target_input.dispatchEvent(new Event('change'));

                    // clear previous preview
                    target_preview.innerHtml = '';

                    // set or change the preview image src
                    items.forEach(function(item) {


                        select_poster_preview.setAttribute('src', item.thumb_url)
                    });


                    // trigger change event
                    target_preview.dispatchEvent(new Event('change'));
                };
            });
        };

        lfm('select_poster_button', 'image', {
            type: 'image',
        });
    </script>
</x-admin-layout>
