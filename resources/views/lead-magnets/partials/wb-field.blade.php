{{-- props: $id, $label (opt), $hint (opt), $placeholder (opt), $rows (opt) --}}
<div class="mb-[14px]">
    @if (!empty($label))
        <div class="wb-mono text-[11px] tracking-wider text-gray-300 mb-[5px]">{!! $label !!}</div>
    @endif
    @if (!empty($hint))
        <div class="text-[11px] italic text-gray-600 mb-[5px]">{!! $hint !!}</div>
    @endif
    <textarea class="wb-field"
              data-wb="{{ $id }}"
              rows="{{ $rows ?? 3 }}"
              placeholder="{{ $placeholder ?? '' }}"></textarea>
</div>
