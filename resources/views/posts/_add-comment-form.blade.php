@auth
    <x-panel>
        <form method="POST" action="/posts/{{$post->slug}}/comments">
            @csrf
            <header class="flex item-center">
                <img src="https://i.pravatar.cc/60?u={{auth()->id()}}" alt="" width="40" height="40" class="rounded-full mr-3">
                <h2>Want to participate?</h2>
            </header>
            <x-form.textarea name="body" />

            <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
                <x-submit-button>Post</x-submit-button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/login" class="hover:underline">Login to leave a comment </a>
    </p>
@endauth
