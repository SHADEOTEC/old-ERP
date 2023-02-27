@php
$value = null;
for ($i = 0; $i < $child_category->level; $i++) {
    $value .= '--';
}
@endphp
@if ($child_category->level == 1)
    <optgroup data-value="{{ $child_category->id }}" data-parent="{{ $child_category->parent_id }}" label="{{ $child_category->name }}">
        @if ($child_category->categories)
            @foreach ($child_category->categories as $childCategory)
                @include('categories.child_category', ['child_category' => $childCategory])
            @endforeach
        @endif
    </optgroup>
@else
    <option value="{{ $child_category->id }}" data-parent="{{ $child_category->parent_id }}">{{ $child_category->name }}</option>
@endif
