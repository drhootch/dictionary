<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>رياض اللغة</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;400;600;700&display=swap" rel="stylesheet">
    <style type="text/css">
        @font-face {
            font-family: UthmanicHafs;
            src: url('{{ asset("fonts/uthmanicHafs.otf") }}');
        }
    </style>
</head>

<body class="antialiased font-tajawal bg-dots-darker bg-center bg-gray-100">
    <div class="h-screen flex flex-col  selection:bg-yellow-500">
        <div class="w-full max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex mb-4 sm:items-center justify-between">
                <div class="ml-4 text-center text-lg font-bold text-teal-600  sm:text-right sm:ml-0">
                    رياض اللّغة
                </div>
                <div class="text-center text-sm text-gray-500 sm:text-left flex gap-8 justify-center items-center">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('filament.validator.resources.posts.index') }}"
                            class="group gap-2 flex items-center underline justify-center text-lg font-medium hover:text-grey-700 text-grey-600  sm:text-right sm:ml-0 focus:outline focus:outline-2 focus:rounded-sm focus:outline-yellow-500">
                            إضافة نصّ
                        </a>
                        <a href="{{ route('filament.validator.pages.dashboard') }}"
                            class="group gap-2 flex items-center underline justify-center text-lg font-medium hover:text-grey-700 text-grey-600  sm:text-right sm:ml-0 focus:outline focus:outline-2 focus:rounded-sm focus:outline-yellow-500">
                            الدخول إلى المنصّة
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col flex-1 overflow-y-scroll">
            <div class="mt-4 flex-1 flex flex-col items-center">


                <div class="mt-4 w-full text-right flex gap-2 items-center max-w-7xl mx-auto px-6 lg:px-8">
                    <svg width="12" height="17" viewBox="0 0 12 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.19512 15.6339H3.80488C3.72439 15.6339 3.65854 15.7022 3.65854 15.7857V16.3929C3.65854 16.7287 3.92012 17 4.2439 17H7.7561C8.07988 17 8.34146 16.7287 8.34146 16.3929V15.7857C8.34146 15.7022 8.27561 15.6339 8.19512 15.6339ZM6 0C2.68719 0 0 2.78717 0 6.22321C0 8.52656 1.20732 10.5377 3 11.6135V13.8125C3 14.1483 3.26159 14.4196 3.58537 14.4196H8.41463C8.73841 14.4196 9 14.1483 9 13.8125V11.6135C10.7927 10.5377 12 8.52656 12 6.22321C12 2.78717 9.3128 0 6 0ZM8.33963 10.4315L7.68293 10.8261V13.0536H4.31707V10.8261L3.66037 10.4315C2.22073 9.56819 1.31707 7.97824 1.31707 6.22321C1.31707 3.5404 3.41341 1.36607 6 1.36607C8.58658 1.36607 10.6829 3.5404 10.6829 6.22321C10.6829 7.97824 9.77927 9.56819 8.33963 10.4315Z"
                            fill="#EBB305" />
                    </svg>

                    <div>يرجى الضغط على الكلمة مرتين لتحديد معناها</div>

                </div>
                <div class="max-w-7xl mx-auto px-6 lg:px-8 pb-12 pt-6 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <div
                        class="min-h-fit scale-100 p-6 bg-white  from-gray-700/50 via-transparent  rounded-lg shadow-2xl shadow-gray-500/20  flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-yellow-500">
                        <div class="w-full flex flex-col justify-between">
                            <p class="mt-4 text-gray-800  text-lg leading-relaxed text-justify">
                                «إن في الجنة شجرة يستظل الراكب في ظلها مائة سنة واقرؤوا إن شئتم: {وَظِلٍّ
                                مَمْدُودٍ}،
                                ولقاب قوس أحدكم من الجنة خير مما طلعت عليه الشمس أو تغرب»
                            </p>
                            <p class="text-gray-800 font-semibold text-lg leading-relaxed text-left">
                                - حديث النبي صلى الله عليه وسلم، متفقٌ عليهِ -
                            </p>
                        </div>
                    </div>
                    <div
                        class="min-h-fit scale-100 p-6 bg-white  from-gray-700/50 via-transparent  rounded-lg shadow-2xl shadow-gray-500/20  flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-yellow-500">
                        <div class="w-full flex flex-col justify-between">
                            <p class="mt-4 text-gray-800  text-lg leading-relaxed text-justify">
                                «عليكم بذكر الله تعالى فإنه دواء وإياكم وذكر الناس فإنه داء.»
                            </p>
                            <p class="text-gray-800 font-semibold text-lg leading-relaxed text-left">
                                - عمر بن الخطاب رضي الله عنه -
                            </p>
                        </div>
                    </div>
                    <div
                        class="min-h-fit scale-100 p-6 bg-white  from-gray-700/50 via-transparent  rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-yellow-500">
                        <div class="w-full flex flex-col justify-between">
                            <p class="mt-4 text-gray-800  text-lg leading-relaxed text-justify">
                                «الشباب هم الطاقة الحقيقية والقوة الحقيقية لتحقيق هذه الرؤية، وأهم ميزة لدينا هي أن
                                شبابنا واعٍ ومثقف ومبدع ولديه قيم عالية.»
                            </p>
                            <p class="text-gray-800 font-semibold text-lg leading-relaxed text-left">
                                - محمد بن سلمان -
                            </p>
                        </div>
                    </div>
                    <div
                        class="min-h-fit scale-100 p-6 bg-white  from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-yellow-500">
                        <div class="w-full flex flex-col justify-between">
                            <p class="mt-4 text-gray-800  text-lg leading-relaxed text-justify">
                                «كُن مقياسًا للجودة، فهناك بعض الأشخاص لا يجب أن يقبلوا إلا بكل ما هو مميز.»
                            </p>
                            <p class="text-gray-800 font-semibold text-lg leading-relaxed text-left">
                                - ستيف جوبز -
                            </p>
                        </div>
                    </div>
                    @foreach (App\Models\Post::all() as $text)
                    <div
                        class="min-h-fit scale-100 p-6 bg-white  from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-yellow-500">
                        <div class="w-full flex flex-col justify-between">
                            <p class="mt-4 text-gray-800 text-lg leading-relaxed text-justify">
                                {{ $text->post_body }}
                            </p>
                            <p class="text-gray-800 font-semibold text-lg leading-relaxed text-left">
                                - {{ $text->post_title }} -
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="flex sm:items-center justify-between w-full max-w-7xl mx-auto p-6 lg:p-8">
            <div class=" flex gap-6 text-center text-sm text-gray-500 sm:text-right">
                <div class="flex items-center gap-4">
                    <a href="https://dictionary.ksaa.gov.sa/"
                        class="group gap-2 inline-flex items-center hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-yellow-500">
                        <img src="{{ asset('assets/mujam_riadh.svg') }}" alt="logo" class="h-10">
                    </a>
                </div>
            </div>
            <div class=" flex gap-6 text-center text-sm text-gray-500 sm:text-left">
                <div class="flex items-center gap-4">
                    <a href="https://arabicthon.ksaa.gov.sa/"
                        class="group gap-2 inline-flex items-center hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-yellow-500">
                        <img src="{{ asset('assets/arabicaton.svg') }}" alt="logo" class="h-10">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <x-mujam />
    @yield('scripts')
</body>

</html>
