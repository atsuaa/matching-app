<p>{{ $user->id }}</p>
<p>{{ $user->name }}</p>
<p>{{ $user->created_at }}</p>
<p>{{ $user->updated_at }}</p>
<p>
<form id="favorite-user-form" action="{{ route('user.favorite', ['id' => $user->id]) }}" method="post">
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
                url: "{{ route('user.favorite', ['id' => $user->id]) }}",
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
