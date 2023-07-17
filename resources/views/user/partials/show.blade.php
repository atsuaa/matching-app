<p>{{ $entity->id }}</p>
<p>{{ $entity->name }}</p>
<p>{{ $entity->created_at }}</p>
<p>{{ $entity->updated_at }}</p>
<p>
<form id="favorite-user-form" action="{{ route('user.favorite', ['id' => $entity->id]) }}" method="post">
    @csrf
    <input name="favorite" type="hidden" value="{{ $isFavoritedUser ? 0 : 1 }}">
</form>
<button id="favorite-user-form-submit" @class([
    'is-favorite' => $isFavoritedUser,
])>いいね</button>
</p>

<script>
    $(function() {
        $('#favorite-user-form-submit').click(function() {
            const formData = $('#favorite-user-form');
            $.ajax({
                type: "post",
                url: "{{ route('user.favorite', ['id' => $entity->id]) }}",
                data: formData.serialize(),
            }).done(function(response) {
                location.reload();
            }).fail(function(response) {
                location.reload();
            })
        })
    })
</script>

<style>
    .is-favorite {
        color: red;
    }
</style>
