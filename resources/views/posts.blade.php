<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-search-bar />

    {{ $posts->links() }}

    <div class="my-4 py-4 px-4 mx-auto max-w-screen-xl lg:py-5 lg:px-0">
        <div class="grid gap-8 lg:grid-cols-3 md:grid-cols-2">
            @forelse ($posts as $post)
            <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-5 text-gray-500">
                    <a href="/posts?category={{ $post->category->slug }}">
                        <span class="bg-{{ $post->category->color }}-100 text-black-900 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                            {{ $post->category->name }}
                        </span>
                    </a>
                    <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <a href="/posts/{{ $post->slug }}">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:underline">{{ $post['title'] }}</h2>
                </a>
                <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ Str::limit($post['body'], 150) }}</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <img class="w-7 h-7 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Leos avatar" />
                        <a href="/posts?author={{ $post->author->username }}">
                            <span class="font-medium text-sm dark:text-white">
                                {{ $post->author->name }}
                            </span>
                        </a>
                    </div>
                    <a href="/posts/{{ $post->slug }}" class="inline-flex items-center text-sm font-medium text-primary-600 dark:text-primary-500 hover:underline">
                        Read more
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </article>
            @empty
            <div>
                <p class="font-semibold text-xl my-4">Article not found!</p>
                <A href="/posts" class="black text-blue-600 hover:underline">&laquo; Back to all posts</A>
            </div>
            @endforelse
        </div>
    </div>

    {{ $posts->links() }}

</x-layout>