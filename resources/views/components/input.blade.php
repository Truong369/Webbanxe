<?php
$name = $attributes['name'];
$class = $attributes['class'];
$placeholder = $attributes['placeholder'];
$label = $attributes['label'];
$id = $attributes['id'];
$value = $attributes['value'] ?? old($name);
$type = $attributes['type'] ?? 'text';
?>
<div class="form-group">
    <label class="form-label">{{ $label }} @error($name)<span class="text-danger">*</span>@enderror</label>
    <input value="{{ $value }}" placeholder="{{ $placeholder }}" id="{{ $id }}" name="{{ $name }}" type="{{ $type }}"
        class="form-control {{$class}} @error($name) is-invalid @enderror">
</div>
{{-- Show lỗi --}}
@error($name)
<p class="text-danger">{{ $message }}</p>
@enderror