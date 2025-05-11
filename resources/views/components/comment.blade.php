<div class="comment_connection">
    <div class="comment_card">
        <h3 class="comment_Title">{{ $comment->user->username ?? 'Guest' }}</h3>
        <p class="commenet_Text">{{ $comment->comment }}</p>
        <h1 class="parent d-none" >{{ $comment->id }}</h1>

        <div class="comment_card_footer">
            <i class="fa-solid fa-thumbs-up d-none"></i>
            <i class="fa-solid fa-share-nodes d-none"></i>
            @if ($get_userId != 0 || $get_userId != null)
                <i class="fa-solid fa-reply replyTo"></i>
            @endif
            <div class="viewReplies">
                Replies ({{ $comment->replies->count() }})
                <i class="fa-solid fa-caret-down"></i>
            </div>
        </div>


        @if ($get_userId != 0 || $get_userId != null)
            <div class="d-flex justify-content-center addComment_container d-none">
                <div class="commentContainer">
                    <form action="{{url('/add-comment')}}" method="POST" class="commentForm">
                        @csrf
                        <input name="book_id" type="hidden" value="{{$book->id}}">
                        <input type="hidden" name="parent_id" class="parent_id_input" value="">
                        <textarea name="comment" class="commentTextArea replyToInput"
                            placeholder="Write your comment here..."></textarea>
                        <button type="submit" class="btnSend">
                            <span class="material-symbols-outlined sendIcon">
                                send
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>

@if ($comment->replies->count())
    <div class="comment_replies" > {{-- indented replies --}}
        @foreach ($comment->replies as $reply)
            <div class="comment_container d-none">
                @include('components.comment', ['comment' => $reply])
            </div>
        @endforeach
    </div>
@endif
