{{-- props: $id, $text --}}
<div class="flex gap-3 items-start mb-[10px] cursor-pointer select-none group" data-wb-check="{{ $id }}">
    <span data-box class="w-[18px] h-[18px] rounded shrink-0 mt-[1px] flex items-center justify-center border-2 transition-colors" style="border-color:#555;background:transparent;">
        <svg class="w-3 h-3 transition-opacity" style="opacity:0" viewBox="0 0 24 24" fill="none" stroke="#06231f" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6L9 17l-5-5"/>
        </svg>
    </span>
    <span class="text-[13px] leading-relaxed text-gray-400 group-hover:text-gray-200 transition-colors">{!! $text !!}</span>
</div>
