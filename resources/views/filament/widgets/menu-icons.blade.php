
<div class="grid grid-cols-2 gap-4">
    <a
        href="{{ \App\Filament\Resources\ProjectResource::getUrl('index') }}"
        class="flex flex-col items-center justify-center gap-3 rounded-xl border border-[#e3dfd5] bg-[#faf9f5] p-6 text-center transition hover:border-[#8d7650] hover:bg-[#f7f5ef]"
    >
        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#17352a] text-[#cbb982]">
            <x-heroicon-o-photo class="h-9 w-9" />
        </div>
        <span class="font-bold text-[#17352a]">
            تابلوها
        </span>
    </a>
    <a
        href="{{ \App\Filament\Resources\StoryResource::getUrl('index') }}"
        class="flex flex-col items-center justify-center gap-3 rounded-xl border border-[#e3dfd5] bg-[#faf9f5] p-6 text-center transition hover:border-[#8d7650] hover:bg-[#f7f5ef]"
    >
        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#17352a] text-[#cbb982]">
            <x-heroicon-o-play-circle class="h-9 w-9" />
        </div>
        <span class="font-bold text-[#17352a]">
            استوری‌ها
        </span>
    </a>
</div>
