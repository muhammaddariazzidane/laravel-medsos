<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-gray-300 mb-6 font-bold text-2xl text-center">Edit post</h1>
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('patch')
            <textarea name="body"
                class="block w-full ring-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('body', $post->body) }}</textarea>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                {{-- <a href="{{ route('post.index') }}">{{ __('Cancel') }}</a> --}}
            </div>
        </form>
    </div>
</x-app-layout>
