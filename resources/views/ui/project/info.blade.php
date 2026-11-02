@extends('templates.ui')
@section('title', $title)

@section('main-content')
<div dir="rtl" class="container min-h-screen mx-auto md:pt-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="grid lg:col-span-2 lg:order-1 order-2 gap-4">
            <div class="text-center">
                <span class="text-gold text-4xl">✦</span>
                <h1 class="font-nastaliq text-6xl md:text-8xl text-green-950 leading-none mt-10">
                    {{$item->name_fa}}
                </h1>
                <p class="text-gold text-lg font-bold m-10">
                    {{$item->description}}
                </p>
                <div class="flex items-center justify-center gap-4">
                    <div class="w-20 h-px bg-[#cbb982]"></div>
                    <h2 class="text-xl font-bold text-gray-700 whitespace-nowrap">
                        {{$item->member->name_fa}}
                    </h2>
                    <div class="w-20 h-px bg-[#cbb982]"></div>
                </div>
                <p class="text-sm text-gold mt-2 tracking-widest">
                    {{$item->member->name_en}}
                </p>
                <span class="text-gold text-1xl">✦</span>
            </div>
            <div class="grid lg:grid-cols-2 mx-10 mt-4 gap-10">
                @if($item->about_project)
                <div>
                    <h3 class="font-bold text-xl text-green-950 mb-5">
                        <span class="text-[#cbb982]">✦</span> درباره {{$item->name_fa}} 
                    </h3>
                    <p class="text-sm leading-8 text-gray-700 text-justify pr-5">
                        {{$item->about_project}}
                    </p>
                </div>
                @endif
                @if($item->member_description)
                <div>
                    <h3 class="text-xl font-bold text-green-950 mb-5">
                        <span class="text-[#cbb982]">✦</span> بیانیه هنرمند 
                    </h3>
                    <p class="text-sm leading-8 text-gray-700 text-justify pr-5">
                        {{$item->member_description}}
                    </p>
                </div>
                @endif
            </div>
        </div>

        <!-- Share Button -->
        <div class="flex md:hidden mr-2 -mb-16 h-14 w-14 z-2 justify-start">
            <button
                type="button"
                data-modal-target="share-modal"
                data-modal-toggle="share-modal"
                class="inline-flex items-center gap-2 rounded-full
                    bg-[#17352a] p-4 text-md text-white
                    shadow-sm transition hover:bg-[#244b3b]"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.7">
                    <circle cx="18" cy="5" r="3"/>
                    <circle cx="6" cy="12" r="3"/>
                    <circle cx="18" cy="19" r="3"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m8.7 10.7 6.6-4.4m-6.6 9 6.6 4.4"/>
                </svg>
            </button>
        </div>

        <!-- IMAGE MODAL -->
        <div class="lg:col-span-1 lg:order-2 order-1">
            <button
                data-modal-target="image-modal"
                data-modal-toggle="image-modal"
                type="button"
                class="relative cursor-zoom-in"
            >
                <img
                    src="{{ asset('storage/' . $item->thumbnail) }}"
                    alt="{{ $item->name_fa }}"
                    class="block w-full max-w-none h-auto"
                >
                <div
                    class="absolute left-0 top-0 -translate-x-full
                        rotate-[-90deg] origin-top-right text-[#cbb982]
                        tracking-[5px] text-sm whitespace-nowrap"
                >
                    {{ $item->name_en }}
                </div>
            </button>

            <!-- Fullscreen Image Modal -->
            <div
                id="image-modal"
                tabindex="-1"
                aria-hidden="true"
                class="hidden fixed inset-0 z-50
                    w-full h-full
                    items-center justify-center
                    bg-black/90"
            >
                <!-- Close -->
                <button
                    type="button"
                    data-modal-hide="image-modal"
                    class="absolute top-5 right-5 z-10
                        rounded-full p-3
                        text-white/80
                        hover:bg-white/10
                        hover:text-white
                        transition"
                >
                    <svg
                        class="h-7 w-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
                <!-- Image -->
                <div class="flex h-full w-full items-center justify-center p-4 md:p-8">
                    <img
                        src="{{ asset('storage/' . $item->image) }}"
                        alt="{{ $item->name_fa }}"
                        class="max-h-full max-w-full object-contain"
                    >
                </div>
            </div>
        </div>
    </div>
    <hr class="my-10 border-[#cbb982] mx-10" />
    <div class="grid lg:grid-cols-8 gap-10 mx-10 my-10">
        <div class="order-4 lg:order-1 col-span-1 flex flex-col gap-4 items-center justify-center">
            <img src="/storage/{{$item->signature}}"/>
            <a href="{{ route('projectQr', $item->uuid) }}">
                {!! QrCode::size(100)->generate(url()->current()) !!}
            </a>    
        </div>
        <div class="order-1 lg:order-2 lg:col-span-2">
            <div>
                <h4 class="font-bold text-green-950">
                    <span class="text-gold text-xl">✦</span> درباره هنرمند
                </h4>
                <p class="text-xs text-gray-600 mr-4 mt-4">
                    {{$item->member->name_fa}}
                    <br>
                    {{$item->member->about}}
                </p>
            </div>
            <div class="text-left text-xs text-gray-600">
                <div>{{$item->member->instagram}}
                    <svg class="size-4 text-gold inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    {{$item->member->user->email}}
                    <svg class="size-4 text-gold inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                    </svg>
                </div>
                <div>
                    {{$item->member->website}}
                    <svg class="size-4 text-gold inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M21.721 12.752a9.711 9.711 0 0 0-.945-5.003 12.754 12.754 0 0 1-4.339 2.708 18.991 18.991 0 0 1-.214 4.772 17.165 17.165 0 0 0 5.498-2.477ZM14.634 15.55a17.324 17.324 0 0 0 .332-4.647c-.952.227-1.945.347-2.966.347-1.021 0-2.014-.12-2.966-.347a17.515 17.515 0 0 0 .332 4.647 17.385 17.385 0 0 0 5.268 0ZM9.772 17.119a18.963 18.963 0 0 0 4.456 0A17.182 17.182 0 0 1 12 21.724a17.18 17.18 0 0 1-2.228-4.605ZM7.777 15.23a18.87 18.87 0 0 1-.214-4.774 12.753 12.753 0 0 1-4.34-2.708 9.711 9.711 0 0 0-.944 5.004 17.165 17.165 0 0 0 5.498 2.477ZM21.356 14.752a9.765 9.765 0 0 1-7.478 6.817 18.64 18.64 0 0 0 1.988-4.718 18.627 18.627 0 0 0 5.49-2.098ZM2.644 14.752c1.682.971 3.53 1.688 5.49 2.099a18.64 18.64 0 0 0 1.988 4.718 9.765 9.765 0 0 1-7.478-6.816ZM13.878 2.43a9.755 9.755 0 0 1 6.116 3.986 11.267 11.267 0 0 1-3.746 2.504 18.63 18.63 0 0 0-2.37-6.49ZM12 2.276a17.152 17.152 0 0 1 2.805 7.121c-.897.23-1.837.353-2.805.353-.968 0-1.908-.122-2.805-.353A17.151 17.151 0 0 1 12 2.276ZM10.122 2.43a18.629 18.629 0 0 0-2.37 6.49 11.266 11.266 0 0 1-3.746-2.504 9.754 9.754 0 0 1 6.116-3.985Z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="order-2 lg:order-3 lg:col-span-3">
            <h4 class="font-bold text-green-950">
                <span class="text-gold text-xl">✦</span> مشخصات اثر 
            </h4>
            <table class="w-full border border-[#d4c69c] text-sm mr-4 mt-4">
                <tr>
                    <td class="p-3 bg-green-950 text-white w-10">
                        <svg class="size-6 text-white inline" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7h.01m3.486 1.513h.01m-6.978 0h.01M6.99 12H7m9 4h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 3.043 12.89 9.1 9.1 0 0 0 8.2 20.1a8.62 8.62 0 0 0 3.769.9 2.013 2.013 0 0 0 2.03-2v-.857A2.036 2.036 0 0 1 16 16Z"/>
                        </svg>
                    </td>
                    <td class="p-3">عنوان اثر</td>
                    <td class="p-3 font-bold">
                        {{$item->name_fa}}
                    </td>
                </tr>
                <tr>
                    <td class="p-3 bg-green-950 text-white">
                        <svg class="size-6 text-white inline" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                        </svg>
                    </td>
                    <td class="p-3">
                        سبک
                    </td>
                    <td class="p-3">
                        {{$item->style->name_fa}} ({{$item->style->name_en}})
                    </td>
                </tr>
                <tr>
                    <td class="p-3 bg-green-950 text-white">
                        <svg class="size-6 text-white inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.622 1.602a.75.75 0 0 1 .756 0l2.25 1.313a.75.75 0 0 1-.756 1.295L12 3.118 10.128 4.21a.75.75 0 1 1-.756-1.295l2.25-1.313ZM5.898 5.81a.75.75 0 0 1-.27 1.025l-1.14.665 1.14.665a.75.75 0 1 1-.756 1.295L3.75 8.806v.944a.75.75 0 0 1-1.5 0V7.5a.75.75 0 0 1 .372-.648l2.25-1.312a.75.75 0 0 1 1.026.27Zm12.204 0a.75.75 0 0 1 1.026-.27l2.25 1.312a.75.75 0 0 1 .372.648v2.25a.75.75 0 0 1-1.5 0v-.944l-1.122.654a.75.75 0 1 1-.756-1.295l1.14-.665-1.14-.665a.75.75 0 0 1-.27-1.025Zm-9 5.25a.75.75 0 0 1 1.026-.27L12 11.882l1.872-1.092a.75.75 0 1 1 .756 1.295l-1.878 1.096V15a.75.75 0 0 1-1.5 0v-1.82l-1.878-1.095a.75.75 0 0 1-.27-1.025ZM3 13.5a.75.75 0 0 1 .75.75v1.82l1.878 1.095a.75.75 0 1 1-.756 1.295l-2.25-1.312a.75.75 0 0 1-.372-.648v-2.25A.75.75 0 0 1 3 13.5Zm18 0a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.372.648l-2.25 1.312a.75.75 0 1 1-.756-1.295l1.878-1.096V14.25a.75.75 0 0 1 .75-.75Zm-9 5.25a.75.75 0 0 1 .75.75v.944l1.122-.654a.75.75 0 1 1 .756 1.295l-2.25 1.313a.75.75 0 0 1-.756 0l-2.25-1.313a.75.75 0 1 1 .756-1.295l1.122.654V19.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                    </td>
                    <td class="p-3">
                        تکنیک
                    </td>
                    <td class="p-3">
                        {{$item->technique->name_fa}} ({{$item->technique->name_en}})
                    </td>
                </tr>
                <tr>
                    <td class="p-3 bg-green-950 text-white">
                        <svg class="size-6 text-white inline" stroke="currentColor" fill="currentColor" stroke-width="0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g id="Ruler"><g><path d="M9.479,3.5a1.5,1.5,0,0,0-2.12,0L3.5,7.35a1.516,1.516,0,0,0-.44,1.06A1.5,1.5,0,0,0,3.5,9.47L14.519,20.5a1.509,1.509,0,0,0,2.13,0l3.85-3.86a1.491,1.491,0,0,0,0-2.12ZM8.359,7.08a.5.5,0,0,0,0,.71.524.524,0,0,0,.71,0c.55-.56,1.09-1.1,1.65-1.64l1.25,1.25-.9.9a.483.483,0,0,0,0,.7.5.5,0,0,0,.71,0c.29-.3.6-.6.9-.89l1.25,1.25-1.64,1.65a.495.495,0,0,0,.7.7c.56-.55,1.1-1.09,1.65-1.64l1.25,1.25-.9.9a.524.524,0,0,0-.14.36.5.5,0,0,0,.14.35.513.513,0,0,0,.71,0l.9-.9,1.26,1.26-1.65,1.64a.5.5,0,0,0,.71.71c.55-.56,1.09-1.1,1.65-1.64l1.23,1.23a.5.5,0,0,1,0,.7l-3.86,3.86a.5.5,0,0,1-.71,0L4.209,8.77a.491.491,0,0,1-.15-.36.485.485,0,0,1,.15-.35L8.069,4.2a.508.508,0,0,1,.7,0l1.24,1.24Z"></path><path d="M18.939,12.96l-.04-.04c.01,0,.01,0,.02.01S18.939,12.95,18.939,12.96Z"></path></g></g>
                        </svg>
                    </td>
                    <td class="p-3">
                        ابعاد
                    </td>
                    <td class="p-3">
                        {{$item->height}}x{{$item->width}}
                    </td>
                </tr>
                <tr>
                    <td class="p-3 bg-green-950 text-white">
                        <svg class="size-6 text-white inline" stroke="currentColor" fill="currentColor" stroke-width="0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g id="Calendar"><path d="M18.438,4.954H16.5c0-0.346,0-0.691,0-1.036c0-0.124,0-0.248,0-0.372c0-0.262-0.23-0.512-0.5-0.5
            c-0.271,0.012-0.5,0.22-0.5,0.5c0,0.469,0,0.939,0,1.408h-7c0-0.346,0-0.691,0-1.036c0-0.124,0-0.248,0-0.372
            c0-0.262-0.23-0.512-0.5-0.5c-0.271,0.012-0.5,0.22-0.5,0.5c0,0.469,0,0.939,0,1.408H5.562c-1.378,0-2.5,1.122-2.5,2.5v11
            c0,1.379,1.122,2.5,2.5,2.5h12.875c1.379,0,2.5-1.121,2.5-2.5v-11C20.938,6.076,19.816,4.954,18.438,4.954z M5.562,5.954H7.5
            c0,0.073,0,0.147,0,0.22c0,0.124,0,0.248,0,0.372c0,0.262,0.23,0.512,0.5,0.5c0.271-0.012,0.5-0.22,0.5-0.5c0-0.197,0-0.394,0-0.592
            h7c0,0.073,0,0.147,0,0.22c0,0.124,0,0.248,0,0.372c0,0.262,0.23,0.512,0.5,0.5c0.271-0.012,0.5-0.22,0.5-0.5
            c0-0.197,0-0.394,0-0.592h1.937c0.827,0,1.5,0.673,1.5,1.5v1.584H4.062V7.454C4.062,6.627,4.735,5.954,5.562,5.954z M18.438,19.954
            H5.562c-0.827,0-1.5-0.673-1.5-1.5v-8.416h15.875v8.416C19.938,19.281,19.265,19.954,18.438,19.954z"></path></g>
                        </svg>
                    </td>
                    <td class="p-3">
                        سال خلق
                    </td>
                    <td class="p-3">
                        {{$item->year}}
                    </td>
                </tr>
                <tr>
                    <td class="p-3 bg-green-950 text-white">
                        <svg class="size-6 text-white inline" fill="none" stroke-width="1.5" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z"></path>
                        </svg>
                    </td>
                    <td class="p-3">
                        موضوع
                    </td>
                    <td class="p-3">
                        {{$item->subject->name_fa}} ({{$item->subject->name_en}})
                    </td>
                </tr>
            </table>
        </div>
        <div class="order-3 lg:order-4 lg:col-span-2 lg:flex lg:flex-col lg:justify-between">
            <div>
                <h4 class="font-bold text-green-950 mb-5">
                    <span class="text-gold text-1xl">✦</span> اطلاعات فروش
                </h4>
                <div class="text-xs text-gray-950 leading-8 mr-4 mt-4">
                    @if($item->available)
                    <table class="w-full">
                        <tr>
                            <td>قیمت پایه</td>
                            <td class="pr-1">{{number_format($item->price)}} تومان</td>
                        </tr>
                        <tr>
                            <td>موجود</td>
                            <td class="pr-1">
                                @if($item->available)
                                    <span>هست</span>
                                @else
                                    <span>نیست</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>آدرس</td>
                            <td class="pr-1">{{$item->address}}</td>
                        </tr>
                        <tr>
                            <td>شماره تماس</td>
                            <td class="pr-1">{{$item->phone}}</td>
                        </tr>
                    </table>
                    @else
                    <div> هیچ اطلاعات فروش در دسترس نیست. </div>
                    @endif
                </div>
            </div>
            <div class="font-nastaliq text-3xl text-center text-gold leading-14 pt-10">
               {{$item->theme}}
            </div>
        </div>
    </div>

    {{-- Share Artwork --}}
    <div class="mx-10 my-8 flex justify-center">
        <button
            type="button"
            data-modal-target="share-modal"
            data-modal-toggle="share-modal"
            class="inline-flex items-center gap-2 rounded-full
                   bg-[#17352a] px-7 py-3 text-sm text-white
                   shadow-sm transition hover:bg-[#244b3b]"
        >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.7">
                <circle cx="18" cy="5" r="3"/>
                <circle cx="6" cy="12" r="3"/>
                <circle cx="18" cy="19" r="3"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m8.7 10.7 6.6-4.4m-6.6 9 6.6 4.4"/>
            </svg>
            اشتراک‌گذاری اثر
        </button>
    </div>

    {{-- Share Modal --}}
    <div
        id="share-modal"
        tabindex="-1"
        aria-hidden="true"
        class="hidden fixed inset-0 z-[60] h-full w-full
               items-center justify-center overflow-y-auto
               bg-black/60 p-4"
    >
        <div class="relative w-full max-w-md rounded-2xl bg-[#faf9f5] p-6 shadow-2xl">
            <button
                type="button"
                data-modal-hide="share-modal"
                aria-label="بستن"
                class="absolute left-4 top-4 rounded-full p-2 text-[#746f64]
                       transition hover:bg-[#e9e5dc]"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m6 6 12 12M18 6 6 18"/>
                </svg>
            </button>

            <div class="mb-6 text-center">
                <span class="text-2xl text-[#b99959]">✦</span>
                <h3 class="mt-2 text-xl font-bold text-[#17352a]">
                    اشتراک‌گذاری اثر
                </h3>
                <p class="mt-2 text-xs leading-6 text-[#777268]">
                    تصویر و اطلاعات این اثر را با دیگران به اشتراک بگذارید.
                </p>
            </div>

            <div class="mb-5 flex items-center gap-3 rounded-xl border border-[#e3dfd5] bg-white p-3">
                <img
                    src="{{ asset('storage/' . $item->thumbnail) }}"
                    alt="{{ $item->name_fa }}"
                    class="h-20 w-16 rounded-lg object-cover"
                >
                <div class="min-w-0">
                    <div class="truncate font-bold text-[#17352a]">
                        {{ $item->name_fa }}
                    </div>
                    <div class="mt-1 text-xs text-[#8b806d]">
                        {{ $item->member->name_fa }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <button
                    type="button"
                    id="shareArtworkButton"
                    class="flex items-center justify-center gap-2 rounded-xl
                           bg-[#17352a] px-3 py-3 text-sm text-white
                           transition hover:bg-[#244b3b]"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.7">
                        <circle cx="18" cy="5" r="3"/>
                        <circle cx="6" cy="12" r="3"/>
                        <circle cx="18" cy="19" r="3"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m8.7 10.7 6.6-4.4m-6.6 9 6.6 4.4"/>
                    </svg>
                    ارسال تصویر و متن
                </button>

                <a
                    id="whatsappShareLink"
                    href="#"
                    target="_blank"
                    rel="noopener"
                    class="flex items-center justify-center gap-2 rounded-xl
                           border border-[#ded8cb] bg-white px-3 py-3
                           text-sm text-[#17352a] transition hover:border-[#b99959]"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.04 2a9.8 9.8 0 0 0-8.36 14.91L2.3 22l5.22-1.37A9.96 9.96 0 0 0 12.04 22 10 10 0 0 0 12.04 2Zm0 18.2a8.2 8.2 0 0 1-4.18-1.14l-.3-.18-3.1.81.83-3.02-.2-.31A8.18 8.18 0 1 1 12.04 20.2Zm4.5-6.13c-.25-.13-1.48-.73-1.71-.81-.23-.08-.4-.13-.57.13-.17.25-.65.81-.8.98-.15.17-.3.19-.55.06-.25-.13-1.05-.39-2-.1.74-.67-.55-.74-.8-.99-.22-.22-.5-.56-.7-.84-.18-.25-.02-.39.12-.52.12-.12.25-.3.38-.45.13-.15.17-.25.25-.42.08-.17.04-.32-.02-.45-.06-.13-.57-1.37-.78-1.87-.2-.49-.41-.42-.57-.43h-.49c-.17 0-.45.06-.68.32-.23.25-.89.87-.89 2.12s.91 2.46 1.04 2.63c.13.17 1.79 2.73 4.33 3.83.6.26 1.07.42 1.44.53.61.19 1.16.16 1.6.1.49-.07 1.48-.61 1.69-1.2.21-.59.21-1.09.15-1.2-.06-.1-.23-.17-.49-.3Z"/>
                    </svg>
                    واتساپ
                </a>

                <button
                    type="button"
                    id="copyShareLinkButton"
                    class="rounded-xl border border-[#ded8cb] bg-white px-3 py-3
                           text-sm text-[#17352a] transition hover:border-[#b99959]"
                >
                    کپی لینک صفحه
                </button>

                <button
                    type="button"
                    id="copyShareTextButton"
                    class="rounded-xl border border-[#ded8cb] bg-white px-3 py-3
                           text-sm text-[#17352a] transition hover:border-[#b99959]"
                >
                    کپی توضیحات
                </button>

                <button
                    type="button"
                    id="downloadArtworkButton"
                    class="col-span-2 rounded-xl border border-[#ded8cb] bg-white px-3 py-3
                           text-sm text-[#17352a] transition hover:border-[#b99959]"
                >
                    دانلود تصویر اثر
                </button>
            </div>

            <p
                id="shareFeedback"
                role="status"
                aria-live="polite"
                class="mt-4 min-h-6 text-center text-xs text-[#8b806d]"
            ></p>

            <p class="text-center text-[11px] leading-5 text-[#9b9589]">
                برای انتشار در استوری یا وضعیت، گزینه «ارسال تصویر و متن» را بزنید
                و برنامه‌ی موردنظر را از منوی اشتراک‌گذاری گوشی انتخاب کنید.
            </p>
        </div>
    </div>

</div>
@endsection

@section('page-js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const artwork = {
            title: @json($item->name_fa),
            artist: @json($item->member->name_fa),
            description: @json($item->description),
            about: @json($item->about_project),
            url: @json(url()->current()),
            image: @json(asset('storage/' . $item->image)),
        };

        const shareText = [
            artwork.title,
            `هنرمند: ${artwork.artist}`,
            artwork.description,
            artwork.about,
            `مشاهده اثر: ${artwork.url}`,
        ].filter(value => value && String(value).trim()).join('\n\n');

        const feedback = document.getElementById('shareFeedback');
        const showFeedback = (message) => {
            if (feedback) feedback.textContent = message;
        };

        const copyText = async (value, successMessage) => {
            try {
                await navigator.clipboard.writeText(value);
                showFeedback(successMessage);
            } catch (error) {
                showFeedback('کپی خودکار انجام نشد؛ لطفاً لینک را از نوار آدرس کپی کنید.');
            }
        };

        document.getElementById('whatsappShareLink')?.addEventListener('click', (event) => {
            event.currentTarget.href =
                `https://wa.me/?text=${encodeURIComponent(shareText)}`;
        });

        document.getElementById('copyShareLinkButton')?.addEventListener('click', () => {
            copyText(artwork.url, 'لینک صفحه کپی شد.');
        });

        document.getElementById('copyShareTextButton')?.addEventListener('click', () => {
            copyText(shareText, 'متن توضیحات کپی شد.');
        });

        document.getElementById('downloadArtworkButton')?.addEventListener('click', () => {
            const link = document.createElement('a');
            link.href = artwork.image;
            link.download = `${artwork.title || 'artwork'}.jpg`;
            document.body.appendChild(link);
            link.click();
            link.remove();
            showFeedback('دانلود تصویر آغاز شد.');
        });

        document.getElementById('shareArtworkButton')?.addEventListener('click', async () => {
            try {
                const response = await fetch(artwork.image);
                if (!response.ok) throw new Error('Image download failed');

                const blob = await response.blob();
                const extension = blob.type.includes('png') ? 'png' : 'jpg';
                const file = new File(
                    [blob],
                    `artwork-${Date.now()}.${extension}`,
                    { type: blob.type || 'image/jpeg' }
                );

                if (navigator.canShare && navigator.canShare({ files: [file] }) && navigator.share) {
                    await navigator.share({
                        title: artwork.title,
                        text: shareText,
                        files: [file],
                    });
                    showFeedback('منوی اشتراک‌گذاری باز شد.');
                    return;
                }

                if (navigator.share) {
                    await navigator.share({
                        title: artwork.title,
                        text: shareText,
                        url: artwork.url,
                    });
                    showFeedback('لینک و توضیحات به اشتراک گذاشته شد.');
                    return;
                }

                showFeedback('مرورگر شما اشتراک‌گذاری مستقیم تصویر را پشتیبانی نمی‌کند. تصویر را دانلود و سپس ارسال کنید.');
            } catch (error) {
                if (error.name !== 'AbortError') {
                    showFeedback('اشتراک‌گذاری انجام نشد. می‌توانید تصویر را دانلود و متن یا لینک را کپی کنید.');
                }
            }
        });
    });
</script>
@endsection