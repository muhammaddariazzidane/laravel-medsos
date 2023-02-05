<x-app-layout>
    {{-- <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot> --}}

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 px-6 lg:px-8">
            <button id="myBtn"
                class="p-2 mb-4 rounded-lg bg-indigo-600 text-slate-200 hover:bg-indigo-600/80 transition-all duration-300">Create
                Post</button>
            <div class="mb-5 hidden" id="myForm">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <textarea name="body" placeholder="{{ __('What\'s on your mind?') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm bg-slate-200">{{ old('message') }}</textarea>
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    <x-primary-button class="mt-4">{{ __('kirim') }}</x-primary-button>
                </form>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                </div>
            </div>
        </div>
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
