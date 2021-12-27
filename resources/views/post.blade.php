<x-layout>
    @include('posts-header')
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                <img src="/images/illustration-1.png" alt="" class="rounded-xl">

                <p class="mt-4 block text-gray-400 text-xs">
                    Published <time>{{ $post->created_at->diffForHumans() }}</time>
                </p>

                <div class="flex items-center lg:justify-center text-sm mt-4">
                    <img src="/images/lary-avatar.svg" alt="Lary avatar">
                    <div class="ml-3 text-left">
                        <a href="/blog/?author={{$post->user->id}}">
                            <h5 class="font-bold">{{ $post->user->name }}</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-between mb-6">
                    <a href="/blog"
                        class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                        <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                </path>
                                <path class="fill-current"
                                    d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                </path>
                            </g>
                        </svg>

                        Back to Posts
                    </a>

                    <div class="space-x-2">
                        <a href="/blog/?category = /{{ $post->category->name }} && {{ http_build_query(request()->except('category')) }}"
                            class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                            style="font-size: 10px">{{ $post->category->name }}</a>

                    </div>
                </div>

                <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                    {{ $post->title }}
                </h1>

                <div class="space-y-4 lg:text-lg leading-loose">
                    <p>{{ $post->body }}</p>

                </div>
            </div>
            <section class="col-span-8 col-start-5 mt-10 space-y-6">
                @auth
                <form method="POST" action="/posts/{{ $post->id }}/comments"
                    class="border border-gray-200 p-6 rounded-xl">
                    @csrf
                    <header class="flex itens-center">
                        <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40" height="40"
                            class="rounded-full">
                        <h2 class="ml-4">Want to Participate ?</h2>
                    </header>
                    <div class="mt-6">
                        <textarea name="body" class="w-full text-sm focus:outline:none focus:ring" rows="5"
                            placeholder="Quick, Type Something">{{ old('body') }}</textarea>
                        @error('body')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Post</button>
                    </div>

                </form>
                @else
                <p><a href="/register" class="hover:underline">Register</a> or <a href="/login"
                        class="hover:underline">Log in</a> to Leave a Comment.</p>
                @endauth
                @foreach($post->comments as $comment)
                <x-post-comment :comment="$comment">

                </x-post-comment>
                @endforeach

            </section>
        </article>
    </main>

</x-layout>