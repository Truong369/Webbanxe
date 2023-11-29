<?php
$name = $attributes['name'];
$class = $attributes['class'];
$label = $attributes['label'] ?? '';
$value = $attributes['value'] ?? old($name);
?>

<div class="form-group mt-2">
    <label class="form-label">{{ $label }}</label>
    <textarea name="{{ $name }}" class="form-control {{$class}}" style="height: 100px">{{ $value }}</textarea>
</div>
@error($name)
    <p class="text-danger">{{ $message }}</p>
@enderror
