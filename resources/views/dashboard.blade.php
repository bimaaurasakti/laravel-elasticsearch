<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 leading-tight">
            {{ __('Articles') }} <span class="text-gray-400">({{ $articles->count() }})</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('dashboard') }}" method="get" class="pb-4">
                        <div class="form-group">
                            <input type="text" name="q" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search...">
                        </div>
                    </form>
                    @if (request()->has('q'))
                        <p class="text-sm">Using search: <strong>"{{ request('q') }}"</strong>. <a class="border-b border-indigo-800 text-indigo-800" href="{{ route('dashboard') }}">Clear filters</a></p>
                    @endif
                    <div class="mt-8 space-y-8">
                        @forelse ($articles as $article)
                            <article class="space-y-1">
                                <h2 class="font-semibold text-2xl">{{ $article->title }}</h2>
                                <p class="m-0">{{ $article->body }}</body>
                                <div>
                                    @foreach ($article->tags as $tag)
                                        <span class="text-xs px-2 py-1 rounded bg-indigo-50 text-indigo-500">{{ $tag}}</span>
                                    @endforeach
                                </div>
                            </article>
                        @empty
                            <p>No articles found</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
