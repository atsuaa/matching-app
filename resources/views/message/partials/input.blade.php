<form action="{{ route('message.store', ['thread_id' => $threadEntity->id]) }}" method="post">
    @csrf
    <input name="to_user_id" type="hidden" value="{{ $threadEntity->anotherUser(Auth::user()->id)->id }}">
    <div class="mb-2 border-t-2 border-gray-200 px-4 pt-4 sm:mb-0">
        <div class="relative flex">
            <input
                class="w-full rounded-md bg-gray-200 py-3 pl-12 text-gray-600 placeholder-gray-600 focus:placeholder-gray-400 focus:outline-none"
                name="message" type="text" placeholder="Write your message!">
            <div class="absolute inset-y-0 right-0 hidden items-center sm:flex">
                <button
                    class="inline-flex items-center justify-center rounded-lg bg-blue-500 px-4 py-3 text-white transition duration-500 ease-in-out hover:bg-blue-400 focus:outline-none">
                    <span class="font-bold">Send</span>
                    <svg class="ml-2 h-6 w-6 rotate-90 transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</form>
