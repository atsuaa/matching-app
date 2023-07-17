<div class="scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch flex flex-col space-y-4 overflow-y-auto p-3"
    id="messages">
    @foreach ($entities as $entity)
        @if ($entity->from_user_id === Auth::user()->id)
            <div class="chat-message">
                <div class="flex items-end justify-end">
                    <div class="order-1 mx-2 flex max-w-xs flex-col items-end space-y-2 text-xs">
                        <div>
                            <span
                                class="inline-block rounded-lg rounded-br-none bg-blue-600 px-4 py-2 text-white">{{ $entity->message }}</span>
                        </div>
                    </div>
                    <img class="order-2 h-6 w-6 rounded-full"
                        src="https://images.unsplash.com/photo-1590031905470-a1a1feacbb0b?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                        alt="My profile">
                </div>
            </div>
        @else
            <div class="chat-message">
                <div class="flex items-end">
                    <div class="order-2 mx-2 flex max-w-xs flex-col items-start space-y-2 text-xs">
                        <div>
                            <span
                                class="inline-block rounded-lg rounded-bl-none bg-gray-300 px-4 py-2 text-gray-600">{{ $entity->message }}</span>
                        </div>
                    </div>
                    <img class="order-1 h-6 w-6 rounded-full"
                        src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                        alt="My profile">
                </div>
            </div>
        @endif
    @endforeach
</div>
