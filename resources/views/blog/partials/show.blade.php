<p>{{ $blog->id }}</p>
<p>{{ $blog->title }}</p>
<p>{{ $blog->body }}</p>
<p>{{ $blog->published }}</p>
<p>{{ $blog->created_at }}</p>
<p>{{ $blog->updated_at }}</p>
<p>
    <a href="{{ route('blog.edit', ['id' => $id]) }}">編集</a>
</p>
<p>
<form action="{{ route('blog.destroy', ['id' => $blog->id]) }}" method="post">
    @csrf
    @method('delete')
    <button>削除</button>
</form>
</p>
