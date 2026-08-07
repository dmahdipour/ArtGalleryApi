@extends('templates.project')
@section('title', 'پروژه ی')

@section('main-content')
<div dir="rtl" class="min-h-screen bg-[#f7f6f1] flex justify-center py-10">
    <div class="w-[794px] min-h-[1123px] bg-white shadow-xl relative overflow-hidden">
        <!-- Left Green Panel -->
        <div class="absolute left-0 top-0 w-[130px] h-full bg-[{{$item->theme}}]"></div>
        <!-- Vertical Text -->
        <div class="absolute left-7 top-32 text-[#cbb982] rotate-[-90deg] tracking-[5px] text-xs">
            {{$item->name_en}}
        </div>


        <!-- Header -->
        <section class="relative z-10 flex justify-end px-16 pt-16">

            <div class="text-right">
                <h1 class="font-serif text-7xl text-[#123326] leading-none">
                    {{$item->name_fa}}
                </h1>
                <p class="mt-4 text-[#8d7650] text-lg">
                    {{$item->description}}
                </p>
                <div class="mt-10 flex items-center gap-5">
                    <span class="w-20 h-[1px] bg-gray-400"></span>
                    <h2 class="text-xl font-bold text-gray-700">
                        {{$item->member->name_fa}}
                    </h2>
                    <span class="w-20 h-[1px] bg-gray-400"></span>
                </div>
                <p class="text-center text-sm mt-2 tracking-widest">
                    {{$item->member->name_en}}
                </p>
            </div>
        </section>


        <!-- Main Image -->
        <section class="absolute top-[70px] left-[55px]">
            <div class="border border-[#cbb982] p-5">
                /////////////////////
                
                <img 
                src="/storage/{{$item->image}}"
                class="w-[350px] h-[500px] object-cover"
                >

            </div>
        </section>
        <!-- Artist Statement -->
        <section class="relative mt-20 mr-[430px] ml-16">
            <h3 class="text-xl font-bold text-[#123326] mb-5">
                ✦ بیانیه هنرمند 
            </h3>
            <p class="leading-9 text-gray-700 text-justify text-sm">
               {{$item->artist_describe}}
            </p>
            <p class="leading-9 text-gray-700 text-justify text-sm mt-5">
                {{$item->about_project}}
            </p>
        </section>
        <!-- About Flower -->
        <section class="absolute top-[600px] right-16 w-[300px]">
            <h3 class="font-bold text-xl text-[#123326] mb-5">
                ✦ درباره {{$item->name_fa}} 
            </h3>
            <p class="text-sm leading-8 text-gray-700 text-justify">
               {{$item->about_project}}
            </p>
        </section>
        <!-- Specification Table -->
        <section class="absolute top-[600px] left-[55px] w-[330px]">
            <h3 class="text-xl font-bold text-[#123326] mb-5">
                ✦ مشخصات اثر 
            </h3>
            <table class="w-full border border-[#d4c69c] text-sm">
                <tr>
                    <td class="p-3 border">عنوان اثر</td>
                    <td class="p-3 border font-bold">
                        {{$item->name_fa}}
                    </td>
                </tr>
                <tr>
                    <td class="p-3 border">
                        سبک
                    </td>
                    <td class="p-3 border">
                        {{$item->style->name_fa}} ({{$item->style->name_en}})
                    </td>
                </tr>
                <tr>
                    <td class="p-3 border">
                        تکنیک
                    </td>
                    <td class="p-3 border">
                        {{$item->technique->name_fa}} ({{$item->technique->name_en}})
                    </td>
                </tr>
                <tr>
                    <td class="p-3 border">
                        ابعاد
                    </td>
                    <td class="p-3 border">
                        {{$item->width}} x {{$item->height}}
                    </td>
                </tr>
                <tr>
                    <td class="p-3 border">
                        سال خلق
                    </td>
                    <td class="p-3 border">
                        {{$item->year}}
                    </td>
                </tr>
                <tr>
                    <td class="p-3 border">
                        موضوع
                    </td>
                    <td class="p-3 border">
                        {{$item->subject->name_fa}} ({{$item->subject->name_en}})
                    </td>
                </tr>
            </table>
        </section>
        <!-- Quote -->
        <section class="absolute bottom-28 left-16 w-[330px]">
            <div class="border border-[#cbb982] p-8">
                <p class="text-center text-xl text-gray-700 leading-10">
                    طبیعت،
                    پیش از آنکه دیده شود،
                    باید احساس شود.
                </p>
            </div>
        </section>
        <!-- Footer -->
        <footer class="absolute bottom-10 right-16 left-16 border-t pt-5 flex justify-between">
            <div>
                <h4 class="font-bold text-[#123326]">
                    درباره هنرمند
                </h4>
                <p class="text-xs mt-2 text-gray-600">
                    {{$item->member->name_fa}}
                    <br>
                    {{$item->member->about}}
                </p>
            </div>
            <div class="text-left text-xs text-gray-600">
                Instagram: {{$item->member->instagram}}
                <br>
                {{$item->member->email}}
                <br>
                {{$item->member->website}}
            </div>
        </footer>
    </div>
</div>
@endsection

@section('page-js')
<script>
    
</script>
@endsection