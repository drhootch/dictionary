<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="antialiased">
    <div
        class="font-tajawal relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <div
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <p class="mt-4 text-gray-800 dark:text-gray-200 text-lg leading-relaxed">
                                «قُلۡ هُوَ ٱللَّهُ أَحَدٌ (1) ٱللَّهُ ٱلصَّمَدُ (2) لَمۡ يَلِدۡ وَلَمۡ يُولَدۡ (3)
                                وَلَمۡ يَكُن لَّهُۥ كُفُوًا أَحَدُۢ (4)»
                            </p>
                            <p class="text-gray-800 dark:text-gray-200 text-lg leading-relaxed text-left">-
                                سورة الإخلاص
                                -</p>
                        </div>
                    </div>
                    <div
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <p class="mt-4 text-gray-800 dark:text-gray-200 text-lg leading-relaxed">
                                إن في الجنة شجرة يستظل الراكب في ظلها مائة سنة واقرؤوا إن شئتم: {وَظِلٍّ مَمْدُودٍ}،
                                ولقاب قوس أحدكم من الجنة خير مما طلعت عليه الشمس أو تغرب
                            </p>
                            <p class="text-gray-800 dark:text-gray-200 text-lg leading-relaxed text-left">- رواه أحمد في
                                مسنده عن أبي هريرة
                                -</p>
                        </div>
                    </div>
                    <div
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <p class="mt-4 text-gray-800 dark:text-gray-200 text-lg leading-relaxed">
                                «الشباب هم الطاقة الحقيقية والقوة الحقيقية لتحقيق هذه الرؤية، وأهم ميزة لدينا هي أن
                                شبابنا واعٍ ومثقف ومبدع ولديه قيم عالية.»
                            </p>
                            <p class="text-gray-800 dark:text-gray-200 text-lg leading-relaxed text-left">- محمد بن
                                سلمان
                                -</p>
                        </div>
                    </div>
                    <div
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <p class="mt-4 text-gray-800 dark:text-gray-200 text-lg leading-relaxed">
                                «دائمًا ما تبدأ قصص النجاح برؤية، وأنجح الرؤى هي تلك التي تُبنى على مكامن القوة»
                            </p>
                            <p class="text-gray-800 dark:text-gray-200 text-lg leading-relaxed text-left">- محمد بن
                                سلمان
                                -</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                    <div class="flex items-center gap-4">
                        <a href="https://github.com/"
                            class="group gap-2 inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">

                            <svg width="20" height="20" viewBox="0 0 20 20" fill="white"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 0C8.68678 0 7.38642 0.258658 6.17317 0.761205C4.95991 1.26375 3.85752 2.00035 2.92893 2.92893C1.05357 4.8043 0 7.34784 0 10C0 14.42 2.87 18.17 6.84 19.5C7.34 19.58 7.5 19.27 7.5 19V17.31C4.73 17.91 4.14 15.97 4.14 15.97C3.68 14.81 3.03 14.5 3.03 14.5C2.12 13.88 3.1 13.9 3.1 13.9C4.1 13.97 4.63 14.93 4.63 14.93C5.5 16.45 6.97 16 7.54 15.76C7.63 15.11 7.89 14.67 8.17 14.42C5.95 14.17 3.62 13.31 3.62 9.5C3.62 8.39 4 7.5 4.65 6.79C4.55 6.54 4.2 5.5 4.75 4.15C4.75 4.15 5.59 3.88 7.5 5.17C8.29 4.95 9.15 4.84 10 4.84C10.85 4.84 11.71 4.95 12.5 5.17C14.41 3.88 15.25 4.15 15.25 4.15C15.8 5.5 15.45 6.54 15.35 6.79C16 7.5 16.38 8.39 16.38 9.5C16.38 13.32 14.04 14.16 11.81 14.41C12.17 14.72 12.5 15.33 12.5 16.26V19C12.5 19.27 12.66 19.59 13.17 19.5C17.14 18.16 20 14.42 20 10C20 8.68678 19.7413 7.38642 19.2388 6.17317C18.7362 4.95991 17.9997 3.85752 17.0711 2.92893C16.1425 2.00035 15.0401 1.26375 13.8268 0.761205C12.6136 0.258658 11.3132 0 10 0Z"
                                    fill="grey" />
                            </svg>

                            Github
                        </a>
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                    تطوير فريق رياض اللّغة
                </div>
            </div>
        </div>
    </div>
    <x-mujam />
    @yield('scripts')
</body>

</html>
