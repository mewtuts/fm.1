
@props(['category'])

<option value="{{ $category->id }}">{{ $category->title }}

    @foreach ($category->children as $child)

            <x-select-category :category="$child" />

    @endforeach

</option>
