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

    <div class="flex justify-between max-w-7xl mx-auto p-6 px-8 sm:items-center selection:bg-yellow-500">

        <div class="ml-4 text-center text-lg font-bold text-teal-600  sm:text-right sm:ml-0">
            مشروع رياض اللّغة
        </div>
        <div class="text-center text-sm text-gray-500 sm:text-left">
            <div class="flex items-center gap-4">
                <a href="https://github.com/drhootch/dictionary"
                    class="group gap-2 flex items-center justify-center font-medium text-lg hover:text-gray-700  focus:outline focus:outline-2 focus:rounded-sm focus:outline-yellow-500">

                    <div class="pt-1.5">Github</div>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 0C8.68678 0 7.38642 0.258658 6.17317 0.761205C4.95991 1.26375 3.85752 2.00035 2.92893 2.92893C1.05357 4.8043 0 7.34784 0 10C0 14.42 2.87 18.17 6.84 19.5C7.34 19.58 7.5 19.27 7.5 19V17.31C4.73 17.91 4.14 15.97 4.14 15.97C3.68 14.81 3.03 14.5 3.03 14.5C2.12 13.88 3.1 13.9 3.1 13.9C4.1 13.97 4.63 14.93 4.63 14.93C5.5 16.45 6.97 16 7.54 15.76C7.63 15.11 7.89 14.67 8.17 14.42C5.95 14.17 3.62 13.31 3.62 9.5C3.62 8.39 4 7.5 4.65 6.79C4.55 6.54 4.2 5.5 4.75 4.15C4.75 4.15 5.59 3.88 7.5 5.17C8.29 4.95 9.15 4.84 10 4.84C10.85 4.84 11.71 4.95 12.5 5.17C14.41 3.88 15.25 4.15 15.25 4.15C15.8 5.5 15.45 6.54 15.35 6.79C16 7.5 16.38 8.39 16.38 9.5C16.38 13.32 14.04 14.16 11.81 14.41C12.17 14.72 12.5 15.33 12.5 16.26V19C12.5 19.27 12.66 19.59 13.17 19.5C17.14 18.16 20 14.42 20 10C20 8.68678 19.7413 7.38642 19.2388 6.17317C18.7362 4.95991 17.9997 3.85752 17.0711 2.92893C16.1425 2.00035 15.0401 1.26375 13.8268 0.761205C12.6136 0.258658 11.3132 0 10 0Z"
                            fill="grey" />
                    </svg>

                </a>
            </div>
        </div>

    </div>
    <div class="relative flex flex-col sm:justify-center sm:items-center selection:bg-yellow-500">

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="mt-4 w-full text-right flex gap-2 items-center">
                <svg width="12" height="17" viewBox="0 0 12 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.19512 15.6339H3.80488C3.72439 15.6339 3.65854 15.7022 3.65854 15.7857V16.3929C3.65854 16.7287 3.92012 17 4.2439 17H7.7561C8.07988 17 8.34146 16.7287 8.34146 16.3929V15.7857C8.34146 15.7022 8.27561 15.6339 8.19512 15.6339ZM6 0C2.68719 0 0 2.78717 0 6.22321C0 8.52656 1.20732 10.5377 3 11.6135V13.8125C3 14.1483 3.26159 14.4196 3.58537 14.4196H8.41463C8.73841 14.4196 9 14.1483 9 13.8125V11.6135C10.7927 10.5377 12 8.52656 12 6.22321C12 2.78717 9.3128 0 6 0ZM8.33963 10.4315L7.68293 10.8261V13.0536H4.31707V10.8261L3.66037 10.4315C2.22073 9.56819 1.31707 7.97824 1.31707 6.22321C1.31707 3.5404 3.41341 1.36607 6 1.36607C8.58658 1.36607 10.6829 3.5404 10.6829 6.22321C10.6829 7.97824 9.77927 9.56819 8.33963 10.4315Z"
                        fill="#EBB305" />
                </svg>

                <div>يرجى الضغط على الكلمة مرتين لتحديد معناها</div>

            </div>
            <div class="mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <div
                        class="scale-100 p-6 bg-white  from-gray-700/50 via-transparent  rounded-lg shadow-2xl shadow-gray-500/20  flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-yellow-500">
                        <div class="w-full flex flex-col justify-between">
                            <p class="mt-4 text-gray-800  text-lg leading-relaxed text-justify">
                                «إن في الجنة شجرة يستظل الراكب في ظلها مائة سنة واقرؤوا إن شئتم: {وَظِلٍّ مَمْدُودٍ}،
                                ولقاب قوس أحدكم من الجنة خير مما طلعت عليه الشمس أو تغرب»
                            </p>
                            <p class="text-gray-800 font-semibold text-lg leading-relaxed text-left">
                                - حديث النبي صلى الله عليه وسلم، متفقٌ عليهِ -
                            </p>
                        </div>
                    </div>
                    <div
                        class="scale-100 p-6 bg-white  from-gray-700/50 via-transparent  rounded-lg shadow-2xl shadow-gray-500/20  flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-yellow-500">
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
                        class="scale-100 p-6 bg-white  from-gray-700/50 via-transparent  rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-yellow-500">
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
                        class="scale-100 p-6 bg-white  from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-yellow-500">
                        <div class="w-full flex flex-col justify-between">
                            <p class="mt-4 text-gray-800  text-lg leading-relaxed text-justify">
                                «كُن مقياسًا للجودة، فهناك بعض الأشخاص لا يجب أن يقبلوا إلا بكل ما هو مميز.»
                            </p>
                            <p class="text-gray-800 font-semibold text-lg leading-relaxed text-left">
                                - ستيف جوبز -
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex mt-20 px-0 sm:items-center justify-between">
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
    </div>
    <x-mujam />
    @yield('scripts')
</body>

</html>
