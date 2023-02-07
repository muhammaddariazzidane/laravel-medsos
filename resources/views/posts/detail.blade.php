<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-gray-300 mb-6 font-bold text-2xl text-center">Detail post
            {{-- {{ dd($comments) }} --}}

        </h1>
        @if (session()->has('success'))
            <div class="p-4 mb-4 bg-emerald-400 rounded-lg">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="p-6 relative mb-3 flex rounded-lg shadow-sm shadow-indigo-600 space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-100">{{ $post->user->name }}</span>
                        {{-- <small
                          class="ml-2 text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small> --}}
                        <small class="ml-2 text-sm text-gray-600">{{ $post->created_at->diffForhumans() }}</small>
                    </div>
                </div>
                <p class="mt-4 text-lg text-gray-100">{{ $post->body }}</p>

            </div>
            @if ($post->user->is(auth()->user()))
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 rotate-90 text-gray-400"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('posts.edit', $post)">
                            {{ __('Edit') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('delete')
                            <x-dropdown-link :href="route('posts.destroy', $post)"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Delete') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endif
            <div class="absolute bottom-3 right-8">

                <div class="flex justify-end ">
                    <a href="{{ route('posts.show', $post) }}" class="text-gray-100">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chat-square-dots-fill" viewBox="0 0 16 16">
                            <path
                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                    </a>
                    <span class="text-white text-sm -mt-1 ml-1">{{ $post->comments->count() }}</span>

                </div>
            </div>

        </div>
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            {{-- @method('patch') --}}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <textarea name="value"
                class="block w-full ring-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm ">
              </textarea>
            {{-- <x-input-error :messages="$errors->get('body')" class="mt-2" /> --}}
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Comment') }}</x-primary-button>
                {{-- <a href="{{ route('post.index') }}">{{ __('Cancel') }}</a> --}}
            </div>
        </form>
        @foreach ($comments as $c)
            <div class="text-white my-4">
                {{ $c->value }}
                ||||| nama: {{ $c->user->name }} || {{ $c->created_at->diffForhumans() }}
            </div>
        @endforeach
    </div>

</x-app-layout>
