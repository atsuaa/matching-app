<p>{{ $entity->id }}</p>
<p>{{ $entity->title }}</p>
<p>{{ $entity->body }}</p>
<p>{{ $entity->published }}</p>
<p>{{ $entity->created_at }}</p>
<p>{{ $entity->updated_at }}</p>
<p>
    <a href="{{ route('blog.edit', ['id' => $id]) }}">編集</a>
</p>
<p>
<form action="{{ route('blog.destroy', ['id' => $entity->id]) }}" method="post">
    @csrf
    @method('delete')
    <button>削除</button>
</form>
</p>
