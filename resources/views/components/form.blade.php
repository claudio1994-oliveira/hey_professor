@props(['action', 'post' => null, 'put' => null, 'delete' => null, 'patch' => null])

<form action="{{ $action }}" method="POST">
    @csrf
    @if ($put)
        @method('PUT')
    @endif
    @if ($patch)
        @method('PATCH')
    @endif
    @if ($delete)
        @method('DELETE')
    @endif
    {{ $slot }}
</form>
