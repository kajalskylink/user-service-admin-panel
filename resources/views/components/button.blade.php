<div {{ $attributes->merge(['class' => '']) }}>
    <button {{ $attributes->merge(['type' => 'submit']) }}>{{ $slot }}</button>
</div>
