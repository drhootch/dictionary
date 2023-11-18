@section('scripts')
@vite('resources/js/main.js')
@endsection

<div dir="rtl" id="riadh_app"
    style="pointer-events: none; top:0; left: 0; right: 0; bottom: 0; position: absolute; z-index: 99999">
    <div xyz-data="riadh_app" xyz-on:click.outside="info={}" xyz-show="show"
        xyz-bind:style="`top:${info.bottom+4}px; left:${info.left-125}px`"
        class="text-right pointer-events-auto transition-all absolute w-[250px] flex flex-col gap-2 items-end max-w-[15.44rem] mx-auto p-2.5 bg-white border-teal-600 border border-solid rounded-[0.63rem] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.3)]">
        <div class="flex  flex-row justify-between items-center w-full">
            <button class="flex flex-row gap-1.5 items-center">
                <p class="block text-right text-teal-600 " xyz-text="info.word"></p>
                <img src="assets/audio.svg" alt="استمع إلى الكلمة">
            </button>
            <button class="flex flex-row gap-1 items-center">
                <img src="assets/link.svg" alt="رابط">
                <img src="assets/mujam_riadh_logo.svg" alt="معجم الرياض">
            </button>
        </div>
        <div xyz-show="loading" class="w-full" xyz-collapse>
            جاري البحث عن أقرب معنى حسب السياق
        </div>
        <div xyz-show="!loading && answer?.error" class="w-full text-red-800" xyz-collapse>
            لم يتم العثور على معنى لهذه الكلمة
        </div>
        <div xyz-show="!loading && answer?.ai" xyz-collapse class="w-full flex flex-col gap-2">

            <div xyz-show="isGoodAnswer" class="flex flex-col w-full gap-2">
                <div class="flex items-center gap-2">
                    <p class="block text-xs text-neutral-500 ">المعنى في السياق:</p>
                    <button xyz-show="!showClosestDetails && answer?.ai?.analysis?.[0].explanation"
                        xyz-on:click="showClosestDetails=true"
                        class="px-1 py-0.5 opacity-70 cursor-pointer border-teal-600 border-solid border rounded-lg text-[0.63rem] text-teal-600">
                        تفصيل
                    </button>
                </div>
                <p class="block w-full text-sm text-green-800 "
                    xyz-text="answer?.meanings?.[answer?.ai?.analysis?.[0].meaningNumber-1]">
                </p>
                <div class="flex flex-col w-full gap-1" xyz-show="showClosestDetails" xyz-collapse>
                    <p class="block text-xs text-neutral-500 ">تفصيل:</p>
                    <p class="block w-full text-sm text-violet-800 " xyz-text="answer?.ai?.analysis?.[0].explanation">
                    </p>
                </div>
            </div>

            <div xyz-show="answer?.ai?.analysis?.length && !isGoodAnswer || showOtherMeanings" xyz-collapse
                class="flex flex-col w-full gap-1">
                <div class="w-full h-[1px] opacity-50 bg-teal-600 mt-1 mb-1"></div>
                <p class="block w-full text-xs text-neutral-500 ">معاني أخرى:</p>
                <template
                    xyz-for="meaning in answer?.meanings.filter((m,i)=>i!==answer?.ai?.analysis?.[0].meaningNumber-1)">
                    <p class="block w-full text-sm text-black " xyz-text="'- '+meaning"></p>
                </template>
            </div>

            <div xyz-show="answer?.ai?.suggestion" class="flex flex-col w-full gap-2">
                <div class="w-full h-[1px] opacity-50 bg-teal-600 mt-1 mb-1"></div>
                <div class="flex items-center gap-2">
                    <p class="block text-xs text-neutral-500 ">معنى مقترح:</p>
                    <button xyz-show="!showSuggestedDetails" xyz-on:click="showSuggestedDetails=true"
                        class="px-1 py-0.5 opacity-70 cursor-pointer border-teal-600 border-solid border rounded-lg text-[0.63rem] text-teal-600">
                        تفصيل
                    </button>
                </div>
                <p class="block w-full text-sm text-violet-800 " xyz-text="answer?.ai?.suggestion?.meaning"></p>
                <div class="flex flex-col w-full gap-1" xyz-show="showSuggestedDetails" xyz-collapse>
                    <p class="block text-xs text-neutral-500 ">تفصيل:</p>
                    <p class="block w-full text-sm text-violet-800 " xyz-text="answer?.ai?.suggestion?.explanation">
                    </p>
                </div>
            </div>

            <div class="flex justify-between items-center w-full flex-row-reverse">
                <div class="flex flex-row gap-2">
                    <img src="assets/thumb_up.svg" alt="إجابة مفيدة">
                    <img src="assets/thumb_down.svg" alt="إجابة غير مفيدة">
                </div>
                <button
                    xyz-show="isGoodAnswer && !showOtherMeanings && answer?.meanings.filter((m,i)=>i!==answer?.ai?.analysis?.[0].meaningNumber-1).length"
                    xyz-on:click="showOtherMeanings=true"
                    class="px-1.5 py-1 border-teal-600 border-solid border rounded-lg text-[0.63rem] text-teal-600">
                    معاني أخرى
                </button>
            </div>

        </div>
    </div>
</div>
