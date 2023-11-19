@section('scripts')
@vite('resources/js/main.js')
@endsection

<div dir="rtl" id="riadh_app"
    style="pointer-events: none; top:0; left: 0; right: 0; bottom: 0; position: absolute; z-index: 99999">
    <div xyz-data="riadh_app" xyz-on:click.outside="info={}" xyz-show="show"
        xyz-bind:style="`top:${info.bottom+4}px; left:${info.left-125}px`"
        class="font-tajawal text-right pointer-events-auto transition-all absolute w-[250px] flex flex-col gap-2 items-end max-w-[15.44rem] mx-auto p-2.5 bg-white border-teal-600 border border-solid rounded-[0.63rem] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.3)]">
        <div class="flex  flex-row justify-between items-center w-full">
            <button class="flex flex-row gap-1.5 items-center">
                <p class="block text-right font-semibold text-teal-600 " xyz-text="info.word"></p>
                <img src="assets/audio.svg" alt="استمع إلى الكلمة">
            </button>
            <button class="flex flex-row gap-1 items-center">
                <img src="assets/link.svg" alt="رابط">
                <img src="assets/mujam_riadh_logo.svg" alt="معجم الرياض">
            </button>
        </div>
        <div xyz-show="loading" class="w-full" xyz-collapse>
            <div role="status">
                <svg aria-hidden="true" class="w-3 h-3 text-gray-200 animate-spin dark:text-gray-600 fill-teal-600"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            جاري البحث عن أقرب معنى حسب السياق
        </div>
        <div xyz-show="!loading && answer?.error" class="w-full text-red-800" xyz-collapse>
            لم يتم العثور على معنى لهذه الكلمة
        </div>
        <div xyz-show="!loading && answer?.ai" xyz-collapse class="w-full flex flex-col gap-2">

            <div xyz-show="isGoodAnswer" class="flex flex-col w-full gap-2">
                <div class="flex items-center gap-2">
                    <p class="block text-xs text-neutral-500 ">المعنى في السياق:</p>
                    <div xyz-show="secondRequestLoading" role="status">
                        <svg aria-hidden="true"
                            class="w-3 h-3 text-gray-200 animate-spin dark:text-gray-600 fill-teal-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                    <button xyz-show="!showClosestDetails && answer?.ai?.analysis?.[0].explanation"
                        xyz-on:click="showClosestDetails=true"
                        class="px-1 py-0.5 opacity-70 cursor-pointer border-teal-600 border-solid border rounded-lg text-[0.63rem] text-teal-600">
                        تفصيل
                    </button>
                </div>
                <p class="block w-full text-md text-green-800 "
                    xyz-text="answer?.meanings?.[answer?.ai?.analysis?.[0].meaningNumber-1]">
                </p>
                <div class="flex flex-col w-full gap-1" xyz-show="showClosestDetails" xyz-collapse>
                    <p class="block text-xs text-neutral-500 ">تفصيل:</p>
                    <p class="block w-full text-md text-violet-800 " xyz-text="answer?.ai?.analysis?.[0].explanation">
                    </p>
                </div>
            </div>

            <div xyz-show="answer?.ai?.analysis?.length && !isGoodAnswer || showOtherMeanings" xyz-collapse
                class="flex flex-col w-full gap-1">
                <div class="w-full h-[1px] opacity-50 bg-teal-600 mt-1 mb-1"></div>
                <p class="block w-full text-xs text-neutral-500 ">معاني أخرى:</p>
                <template
                    xyz-for="meaning in answer?.meanings.filter((m,i)=>i!==answer?.ai?.analysis?.[0].meaningNumber-1)">
                    <p class="block w-full text-md text-black " xyz-text="'- '+meaning"></p>
                </template>
            </div>

            <div xyz-show="!isGoodAnswer && answer?.ai?.suggestion" class="flex flex-col w-full gap-2">
                <div class="w-full h-[1px] opacity-50 bg-teal-600 mt-1 mb-1"></div>
                <div class="flex items-center gap-2">
                    <p class="block text-xs text-neutral-500 ">معنى مقترح:</p>
                    <button xyz-show="!showSuggestedDetails" xyz-on:click="showSuggestedDetails=true"
                        class="px-1 py-0.5 opacity-70 cursor-pointer border-teal-600 border-solid border rounded-lg text-[0.63rem] text-teal-600">
                        تفصيل
                    </button>
                </div>
                <p class="block w-full text-md text-violet-800 " xyz-text="answer?.ai?.suggestion?.meaning"></p>
                <div class="flex flex-col w-full gap-1" xyz-show="showSuggestedDetails" xyz-collapse>
                    <p class="block text-xs text-neutral-500 ">تفصيل:</p>
                    <p class="block w-full text-md text-violet-800 " xyz-text="answer?.ai?.suggestion?.explanation">
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
