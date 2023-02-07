<x-app-layout>
    {{-- <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot> --}}
    <h1 class="text-3xl text-white">

    </h1>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 px-6 lg:px-8">
            <button id="myBtn"
                class="p-2 mb-4 rounded-lg bg-indigo-600 text-slate-200 hover:bg-indigo-600/80 transition-all duration-300">Create
                Post </button>
            @if (session()->has('success'))
                <div class="p-4 mb-4 bg-emerald-400 rounded-lg">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            <div class="mb-5 hidden" id="myForm">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <textarea name="body" placeholder="{{ __('What\'s on your mind?') }}"
                        class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 ring-2 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm focus:ring-2">{{ old('message') }}</textarea>
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    <x-primary-button class="mt-4">{{ __('kirim') }}</x-primary-button>
                </form>
            </div>
            {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg"> --}}
            {{-- <div class="p-6 text-gray-900 dark:text-gray-100"> --}}
            @foreach ($posts as $p)
                <div class="p-6 relative mb-3 flex rounded-lg shadow-sm shadow-indigo-600 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-100">{{ $p->user->name }}</span>
                                {{-- <small
                                    class="ml-2 text-sm text-gray-600">{{ $p->created_at->format('j M Y, g:i a') }}</small> --}}
                                <small class="ml-2 text-sm text-gray-600">{{ $p->created_at->diffForhumans() }}</small>
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-100">{{ $p->body }}</p>

                    </div>
                    @if ($p->user->is(auth()->user()))
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
                                <x-dropdown-link :href="route('posts.edit', $p)">
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('posts.destroy', $p) }}">
                                    @csrf
                                    @method('delete')
                                    <x-dropdown-link :href="route('posts.destroy', $p)"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @endif
                    <div class="absolute bottom-3 right-8">

                        <div class="flex justify-end ">
                            <a href="{{ route('posts.show', $p) }}" class="text-gray-100">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-chat-square-dots-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>
                            </a>
                            <span class="text-white text-sm -mt-1 ml-1">
                                {{ $p->comments->count() }}

                            </span>

                        </div>
                    </div>

                </div>
            @endforeach

            {{-- </div> --}}
            {{-- </div> --}}

        </div>

        <script>
            const myBtn = document.getElementById('myBtn')
            const myForm = document.getElementById('myForm')
            myBtn.addEventListener('click', () => {
                // console.log('helo');
                myForm.classList.toggle('hidden')
            })
        </script>
</x-app-layout>
