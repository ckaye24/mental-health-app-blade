<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Self-Check & Chatbot System</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        [x-cloak] {
            display: none !important;
        }

        .step.active {
            animation: fadeIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .option-card:hover {
            border-color: #1C1C84;
            background-color: #f8faff;
        }
    </style>
</head>

<body class="bg-[#F8FAFC] font-sans antialiased text-[#3E5C66]">

    <nav x-data="{ open: false, toolsOpen: false }" class="sticky top-0 z-50 bg-[#F6F6F6]/90 backdrop-blur-md border-b border-gray-200 shadow-sm px-6 md:px-16 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('pictures/icon.png') }}" class="w-8 h-8 md:w-12 md:h-12" alt="Logo">
                <span class="text-xl md:text-2xl font-bold text-[#1C1C84]">AI Self-Check</span>
            </div>

            <div class="hidden lg:flex items-center space-x-10 text-[#1C1C84] text-lg">
                <a href="/" class="hover:underline underline-offset-8 transition decoration-2">Home</a>

                <div class="relative" @mouseenter="toolsOpen = true" @mouseleave="toolsOpen = false">
                    <button class="flex items-center gap-1 hover:underline underline-offset-8 transition decoration-2 focus:outline-none">
                        Tools
                        <svg class="w-4 h-4 transition-transform duration-200" :class="toolsOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="toolsOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="absolute left-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                        <div class="p-2 flex flex-col">
                            <a href="#quiz" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#F6F6F6] transition group">
                                <span class="text-xl">📋</span>
                                <div>
                                    <p class="font-bold text-sm text-[#1C1C84]">Interactive Quiz</p>
                                    <p class="text-xs text-gray-500">Check your wellness</p>
                                </div>
                            </a>
                            <a href="#chatbot" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#F6F6F6] transition group">
                                <span class="text-xl">💬</span>
                                <div>
                                    <p class="font-bold text-sm text-[#1C1C84]">AI Chatbot</p>
                                    <p class="text-xs text-gray-500">Personal AI support</p>
                                </div>
                            </a>
                            <a href="#analysis" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#F6F6F6] transition group">
                                <span class="text-xl">📊</span>
                                <div>
                                    <p class="font-bold text-sm text-[#1C1C84]">Stress Analysis</p>
                                    <p class="text-xs text-gray-500">View your patterns</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('about') }}" class="hover:underline underline-offset-8 transition decoration-2">About Us</a>
                <a href="{{ route('terms') }}" class="hover:underline underline-offset-8 transition decoration-2">Terms of Service</a>

                <a href="/register" class="bg-[#1C1C84] text-white px-6 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow-md transition-all hover:bg-white hover:text-[#1C1C84] border-2 border-[#1C1C84]">
                    Sign Up
                </a>
            </div>

            <div class="lg:hidden flex items-center">
                <button @click="open = !open" class="text-[#3E5C66] focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4"
            class="lg:hidden mt-4 pb-4 space-y-4 font-bold text-[#547B87]">
            <a href="/" class="block">Home</a>

            <div x-data="{ mobileTools: false }">
                <button @click="mobileTools = !mobileTools" class="flex items-center justify-between w-full">
                    <span>Tools</span>
                    <svg class="w-4 h-4 transition-transform" :class="mobileTools ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="mobileTools" class="pl-4 mt-2 space-y-3 font-medium text-sm">
                    <a href="#quiz" class="block">📋 Interactive Quiz</a>
                    <a href="#chatbot" class="block">💬 AI Chatbot</a>
                    <a href="#analysis" class="block">📊 Stress Analysis</a>
                </div>
            </div>

            <a href="#about" class="block">About</a>
            <a href="#terms" class="block">Terms of Service</a>
            <a href="/register" class="block text-[#1C1C84]">Sign Up</a>
        </div>
    </nav>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-6">
        @if(!session()->has('score'))
        <div id="step-selection" class="step active text-center">
            <div class="mb-12">
                <h2 class="text-4xl md:text-5xl font-black text-[#1C1C84] mb-4 tracking-tight">Select Your Path</h2>
                <div class="h-1.5 w-20 bg-blue-600 mx-auto rounded-full mb-6"></div>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
                    Access our evidence-based tools designed to help you monitor, understand, and manage your mental well-being.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <button onclick="nextStep(0)" class="group relative bg-white p-1.5 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-200 text-left">
                    <div class="p-8 md:p-10 rounded-[2.2rem] bg-white h-full transition-colors">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-[#1C1C84] transition-all duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#1C1C84] group-hover:text-white transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <path d="m9 14 2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-3">Interactive Assessment</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">Complete a structured, validated self-check to quantify your stress levels.</p>
                        <div class="flex items-center text-[#1C1C84] font-bold text-sm tracking-wide uppercase">Begin Quiz →</div>
                    </div>
                </button>

                <a href="{{ route('chatbot') }}" class="group relative bg-white p-1.5 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-200 text-left">
                    <div class="p-8 md:p-10 rounded-[2.2rem] bg-white h-full transition-colors">
                        <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-red-500 transition-all duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-500 group-hover:text-white transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 8V4H8"></path>
                                <rect width="16" height="12" x="4" y="8" rx="2"></rect>
                                <path d="M2 14h2"></path>
                                <path d="M20 14h2"></path>
                                <path d="M15 13v2"></path>
                                <path d="M9 13v2"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-3">AI Consultation</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">Connect with our assistant for immediate, personalized support.</p>
                        <div class="flex items-center text-red-500 font-bold text-sm tracking-wide uppercase">Start Chatbot →</div>
                    </div>
                </a>
            </div>

        </div>

        @endif

        <div id="step-0" class="step">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden max-w-2xl mx-auto">
                <div class="bg-slate-50 px-8 py-10 text-center border-b border-slate-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#1C1C84]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h1 class="text-[#1C1C84] text-3xl font-extrabold tracking-tight">Disclaimer</h1>
                    <p class="text-gray-500 mt-2 text-sm px-4">Please review these essential guidelines regarding our self-assessment tool.</p>
                </div>

                <div class="p-8 md:p-12">
                    <div class="grid grid-cols-1 gap-6 mb-10">
                        <div class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-50 text-[#1C1C84] flex items-center justify-center font-bold text-sm">1</span>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm uppercase tracking-wider">Guide, Not Diagnosis</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">This tool is for informational purposes and cannot replace professional medical advice or a formal clinical diagnosis.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-50 text-[#1C1C84] flex items-center justify-center font-bold text-sm">2</span>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm uppercase tracking-wider">Privacy & Integrity</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">Your data is handled with care for service improvement. There are no wrong answers; please reflect your true feelings.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-50 text-[#1C1C84] flex items-center justify-center font-bold text-sm">3</span>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm uppercase tracking-wider">Quiz Protocol</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">The assessment consists of 20 questions. You must complete all items for the system to calculate your stress analysis.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-red-50 border-l-4 border-red-500 p-5 rounded-r-xl mb-8">
                        <p class="text-xs text-red-800 italic">
                            <strong>Safety Notice:</strong> If you are in immediate distress or considering self-harm, please do not rely on this website. By proceeding, you acknowledge this is an informational tool only.
                        </p>
                    </div>

                    <div x-data="{ agreed: false }" class="space-y-4">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" x-model="agreed" class="w-5 h-5 rounded border-gray-300 text-[#1C1C84]">
                            <span class="text-xs text-gray-500">I have read and agree to the terms of the assessment.</span>
                        </label>
                        <button :disabled="!agreed" onclick="nextStep(1)" :class="agreed ? 'bg-[#10B981] hover:bg-green-600' : 'bg-gray-300 cursor-not-allowed'" class="w-full text-white font-bold py-4 rounded-2xl transition-all shadow-lg">Start Quiz</button>
                        <button onclick="goToSelection()" class="w-full text-gray-400 font-bold text-xs uppercase tracking-widest hover:text-[#1C1C84]">Back to Selection</button>
                    </div>
                </div>
            </div>
        </div>

        @if(session()->has('score'))
        <div id="result-section" class="step active max-w-4xl mx-auto mt-12 space-y-8">
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-200 overflow-hidden">
                <div class="h-2 w-full @if(session('score') <= 33) bg-emerald-500 @elseif(session('score') <= 66) bg-amber-500 @else bg-red-500 @endif"></div>
                <div class="p-10 md:p-14">
                    <div class="flex flex-col md:flex-row items-center gap-12">
                        <div class="relative h-56 w-56 flex-shrink-0">
                            <canvas id="stressChart"></canvas>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-5xl font-black text-slate-800">{{ session('score') }}%</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Score</span>
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h2 class="text-sm font-bold text-[#1C1C84] uppercase tracking-widest mb-2">Assessment Report</h2>
                            <h3 class="text-3xl font-extrabold mb-6 @if(session('score') <= 33) text-emerald-600 @elseif(session('score') <= 66) text-slate-800 @else text-red-600 @endif">
                                @if(session('score') <= 33) Low Stress @elseif(session('score') <=66) Moderate Stress @else High Stress @endif
                                    </h3>

                                    <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full border-2 mb-6 @if(session('score') <= 33) border-emerald-100 bg-emerald-50 text-emerald-700 @elseif(session('score') <= 66) border-amber-100 bg-amber-50 text-amber-700 @else border-red-100 bg-red-50 text-red-700 @endif">
                                        <span class="text-xs font-black uppercase tracking-widest">
                                            @if(session('score') <= 33) Low Stress Level @elseif(session('score') <=66) Moderate Stress Level @else High Stress Level @endif
                                                </span>
                                    </div>

                                    <p class="text-gray-500 text-sm leading-relaxed mb-8">
                                        @if(session('score') <= 33)
                                            You are maintaining a healthy balance. Continue your current self-care routines to stay resilient against future stressors.
                                            @elseif(session('score') <=66)
                                            You are experiencing moderate stress. Consider implementing stress-reduction techniques and seeking support when needed to maintain balance.
                                            @else
                                            Your stress levels are significantly high. It is important to prioritize your well-being immediately. We recommend speaking with a counselor or using our AI chatbot for immediate coping strategies.
                                            @endif
                                            </p>
                                            <div class="flex flex-col gap-4">
                                                <div class="flex items-center gap-2 px-1">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-slate-400"></div>
                                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
                                                        Completed on: {{ now()->format('M d, Y') }}
                                                    </span>
                                                </div>

                                                <div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
                                                    <button onclick="location.reload()"
                                                        class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-slate-200 text-slate-600 font-bold text-xs uppercase tracking-widest transition-all duration-300 hover:border-[#1C1C84] hover:text-[#1C1C84] hover:bg-slate-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform group-hover:rotate-180 duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                        </svg>
                                                        Retake
                                                    </button>

                                                    <a href="{{ route('quiz.history') }}"
                                                        class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-slate-200 text-slate-600 font-bold text-xs uppercase tracking-widest transition-all duration-300 hover:border-blue-500 hover:text-blue-500 hover:bg-slate-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        History
                                                    </a>

                                                    <a href="{{ route('chatbot') }}"
                                                        class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#1C1C84] text-white font-bold text-xs uppercase tracking-widest transition-all duration-300 hover:bg-[#2a2a9b] hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                                                        <span>Discuss with AI</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 p-8 md:p-12">
                <div class="mb-8 border-b border-slate-100 pb-6">
                    <h3 class="text-2xl font-black text-slate-800">Personalized Recommendations</h3>
                    <p class="text-slate-500 text-sm">Evidence-based strategies tailored to your current score.</p>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    @php
                    $score = session('score');
                    $themeClass = $score <= 33 ? 'bg-white border-emerald-100' : ($score <=66 ? 'bg-white border-amber-100' : 'bg-white border-red-100' );
                        $iconBg=$score <=33 ? 'bg-emerald-50' : ($score <=66 ? 'bg-amber-50' : 'bg-red-50' );
                        $accentColor=$score <=33 ? 'text-emerald-600' : ($score <=66 ? 'text-amber-600' : 'text-red-600' );
                        @endphp

                        <div class="p-8 rounded-[2rem] border-2 shadow-sm transition-all duration-300 hover:shadow-md {{ $themeClass }}">
                        <div class="flex items-center gap-4 mb-5">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $iconBg }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ $accentColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h4 class="font-black text-slate-800 tracking-tight text-lg">Academic Focus</h4>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            @if($score <= 33) Continue using current organizational tools. Practice "Deep Work" sessions to stay ahead of deadlines.
                                @elseif($score <=66) Address procrastination using the Pomodoro Technique. Break tasks into 25-minute micro-tasks.
                                @else Emergency Prioritization. Pick the top 2 critical tasks and let the rest wait. Speak to instructors about extensions.
                                @endif
                                </p>
                </div>

                <div class="p-8 rounded-[2rem] border-2 shadow-sm transition-all duration-300 hover:shadow-md {{ $themeClass }}">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $iconBg }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ $accentColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h4 class="font-black text-slate-800 tracking-tight text-lg">Emotional Focus</h4>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        @if($score <= 33) Practice Gratitude Journaling. Reinforcing positive achievements protects you during high-pressure weeks.
                            @elseif($score <=66) Set Boundaries. Practice saying "no" to extra social commitments until your energy returns.
                            @else Practice Self-Compassion. Mental exhaustion is a signal that your brain needs a "system reset."
                            @endif
                            </p>
                </div>

                <div class="p-8 rounded-[2rem] border-2 shadow-sm transition-all duration-300 hover:shadow-md {{ $themeClass }}">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $iconBg }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ $accentColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h4 class="font-black text-slate-800 tracking-tight text-lg">Social Focus</h4>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        @if($score <= 33) Keep engaging with classmates. These connections act as your primary emotional buffer.
                            @elseif($score <=66) Don't avoid asking for help. Speaking to a peer now can prevent a small problem from growing.
                            @else Seek Professional Guidance. Use the AI Chatbot or visit a counselor to discuss immediate strategies.
                            @endif
                            </p>
                </div>

                <div class="p-8 rounded-[2rem] border-2 shadow-sm transition-all duration-300 hover:shadow-md {{ $themeClass }}">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $iconBg }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ $accentColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h4 class="font-black text-slate-800 tracking-tight text-lg">Physical Focus</h4>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        @if($score <= 33) Maintain your sleep schedule. Consistency is key to your cognitive focus and energy.
                            @elseif($score <=66) Try Progressive Muscle Relaxation during study breaks to release stored physical tension.
                            @else Sleep Restoration. Try a "Brain Dump" — writing worries on paper — to clear your mind for rest.
                            @endif
                            </p>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>

    <form id="quizForm" action="{{ route('quiz.submit') }}" method="POST">
        @csrf
        @php $currentCategory = 1; $totalCats = count($questions); @endphp
        @foreach($questions as $category => $set)
        <div id="step-{{ $currentCategory }}" class="step max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 mb-8">
                @if($currentCategory == 1)
                <div class="text-center mb-10 border-b border-slate-50 pb-8">
                    <span class="bg-blue-50 text-[#1C1C84] text-[10px] font-bold uppercase tracking-widest px-4 py-1.5 rounded-full border border-blue-100">Mental Health Check</span>
                    <h2 class="text-3xl font-black text-slate-800 mt-4 mb-3">Stress Self-Assessment Quiz</h2>
                    <p class="text-slate-500 text-sm max-w-xl mx-auto leading-relaxed mb-4">Answer honestly to help us understand your current stress levels.</p>

                    <div class="flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#EF4444]" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-[#EF4444] text-sm font-bold uppercase tracking-wide">
                            ALL QUESTIONS WERE VALIDATED BY THE REGISTERED GUIDANCE COUNSELOR.
                        </p>
                    </div>
                </div>
                @endif

                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Focus Area</p>
                        <h2 class="text-2xl font-black text-[#1C1C84]">{{ $category }}</h2>
                    </div>
                    <div class="text-right">
                        <span class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Section {{ $currentCategory }} of {{ $totalCats }}</span>
                    </div>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full mt-6 overflow-hidden">
                    <div class="bg-[#1C1C84] h-full transition-all duration-700" style="width: {{ ($currentCategory / $totalCats) * 100 }}%"></div>
                </div>
            </div>

            <div class="space-y-6">
                @foreach($set as $id => $text)
                <div id="qblock-{{ $id }}" class="question-block bg-white rounded-[2rem] shadow-sm border border-slate-200 p-8 md:p-10 transition-all duration-300">
                    <div class="flex items-start gap-5 mb-8">
                        <span class="flex-shrink-0 w-10 h-10 rounded-2xl bg-blue-50 text-[#1C1C84] flex items-center justify-center font-black text-sm border border-blue-100">{{ $id }}</span>
                        <p class="text-slate-800 font-bold text-xl leading-snug pt-1">{{ $text }}</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                        @foreach(['Never' => 0, 'Rarely' => 1, 'Sometimes' => 2, 'Often' => 3, 'Always' => 4] as $label => $val)
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="q{{ $id }}" value="{{ $val }}" class="peer hidden" required onclick="clearQuestionError('{{ $id }}')">
                            <div class="option-content flex flex-col items-center justify-center p-5 rounded-2xl border-2 border-slate-50 bg-slate-50/50 transition-all duration-200 group-hover:bg-white group-hover:border-blue-200 peer-checked:bg-blue-50 peer-checked:border-[#1C1C84] peer-checked:shadow-md">
                                <div class="w-4 h-4 rounded-full border-2 border-slate-300 mb-3 flex items-center justify-center peer-checked:border-[#1C1C84]">
                                    <div class="w-2 h-2 rounded-full bg-transparent peer-checked:bg-[#1C1C84]"></div>
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500 peer-checked:text-[#1C1C84]">{{ $label }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    <p id="qerror-{{ $id }}" class="text-red-500 text-[10px] mt-4 hidden error-msg font-bold uppercase tracking-widest text-center italic">⚠️ Please provide a response for this item</p>
                </div>
                @endforeach
            </div>

            <div class="mt-12 mb-12 flex flex-col sm:flex-row justify-between items-center gap-6">
                <button type="button" onclick="nextStep({{ $currentCategory === 1 ? '0' : $currentCategory - 1 }})" class="text-slate-400 font-bold text-xs uppercase tracking-widest hover:text-[#1C1C84] px-8 py-4 transition-colors">← Previous Section</button>
                <div class="w-full sm:w-auto">
                    @if($currentCategory < $totalCats)
                        <button type="button" onclick="validateAndNext({{ $currentCategory }})" class="w-full bg-[#1C1C84] text-white px-12 py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl hover:bg-[#2a2a9b] hover:-translate-y-1 transition-all">Next Section</button>
                        @else
                        <button type="submit" class="w-full bg-emerald-500 text-white px-12 py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl hover:bg-emerald-600 hover:-translate-y-1 transition-all">Finish Assessment</button>
                        @endif
                </div>
            </div>

            <a href="{{ route('chatbot') }}" target="_blank" class="bg-blue-900/5 rounded-3xl p-8 flex flex-col md:flex-row items-center gap-6 border border-blue-100 mb-24 transition-all duration-300 hover:bg-blue-900/10 hover:border-[#1C1C84] hover:shadow-md group block decoration-none">
                <div class="bg-[#1C1C84] p-4 rounded-2xl transition-transform duration-300 group-hover:scale-110 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>

                <div class="text-center md:text-left flex-grow">
                    <h3 class="text-xl font-bold text-slate-800">Need immediate help?</h3>
                    <p class="text-slate-500 text-sm">Our AI chatbot is available 24/7 to answer questions and provide support during your stress assessment journey.</p>
                </div>

                <div class="md:ml-auto text-[#1C1C84] opacity-0 group-hover:opacity-100 transition-opacity duration-300 font-bold text-xs uppercase tracking-widest hidden md:block">
                    Chat Now ↗
                </div>
            </a>
        </div>

        @php $currentCategory++; @endphp
        @endforeach
    </form>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check session via Blade and store in JS variable safely
            const sessionScore = "{{ session('score') }}";

            if (sessionScore !== "") {
                const score = parseInt(sessionScore);
                const ctx = document.getElementById('stressChart').getContext('2d');

                let graphColor = '#10B981';
                if (score > 33) graphColor = '#EAB308';
                if (score > 66) graphColor = '#EF4444';

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [score, 100 - score],
                            backgroundColor: [graphColor, '#F3F4F6'],
                            borderWidth: 0,
                            borderRadius: 10,
                            cutout: '85%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            tooltip: {
                                enabled: false
                            }
                        },
                        animation: {
                            duration: 2000,
                            easing: 'easeOutQuart'
                        }
                    }
                });

                const resultEl = document.getElementById('result-section');
                if (resultEl) resultEl.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });

        function clearQuestionError(id) {
            const block = document.getElementById('qblock-' + id);
            const errorMsg = document.getElementById('qerror-' + id);
            if (block) block.classList.remove('border-red-400', 'bg-red-50/20');
            if (errorMsg) errorMsg.classList.add('hidden');
        }

        function validateAndNext(currentStep) {
            const currentStepEl = document.getElementById('step-' + currentStep);
            const questions = currentStepEl.querySelectorAll('.question-block');
            let allAnswered = true;

            questions.forEach(block => {
                const radios = block.querySelectorAll('input[type="radio"]');
                const errorMsg = block.querySelector('.error-msg');
                let isChecked = Array.from(radios).some(r => r.checked);

                if (!isChecked) {
                    allAnswered = false;
                    block.classList.add('border-red-400', 'bg-red-50/20');
                    errorMsg.classList.remove('hidden');
                }
            });

            if (allAnswered) {
                nextStep(currentStep + 1);
            } else {
                const firstError = currentStepEl.querySelector('.border-red-400');
                if (firstError) firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }

        function nextStep(stepNumber) {
            document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
            const target = document.getElementById('step-' + stepNumber);
            const selection = document.getElementById('step-selection');
            if (selection) selection.classList.remove('active');
            if (target) target.classList.add('active');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function goToSelection() {
            document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
            const selection = document.getElementById('step-selection');
            if (selection) selection.classList.add('active');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
    <div>
        <footer class="bg-[#0F172A] text-white pt-16 pb-8 px-6 md:px-16 border-t border-[#1C1C84]/20">
            <div class="container mx-auto">
                <div class="flex flex-col lg:flex-row justify-between gap-16">

                    <div class="flex flex-col justify-between space-y-10 w-full lg:w-1/2">
                        <div class="text-center md:text-left space-y-6">
                            <div>
                                <h4 class="text-2xl font-bold tracking-tight text-white mb-2">AI Self-Check & Chatbot</h4>
                                <div class="h-1 w-12 bg-[#3B82F6] rounded-full mx-auto md:mx-0"></div>
                            </div>

                            <p class="text-gray-400 text-base leading-relaxed max-w-md">
                                Empowering students through AI-driven mental health insights. A dedicated tool for the ACLC College Sorsogon community.
                            </p>

                            <div class="space-y-4">
                                <div class="flex items-center justify-center md:justify-start gap-4 text-gray-300 group hover:text-white transition-colors">
                                    <div class="p-2 bg-white/5 rounded-lg border border-white/10">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-light">Magsaysay St, Sorsogon City, 4700</span>
                                </div>
                                <div class="flex items-center justify-center md:justify-start gap-4 text-gray-300 group hover:text-white transition-colors">
                                    <div class="p-2 bg-white/5 rounded-lg border border-white/10">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-light">support@aiselfcheck.edu.ph</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="w-full lg:w-1/2">
                        <div class="relative p-2 bg-white/5 border border-white/10 rounded-[40px] shadow-2xl overflow-hidden group">
                            <div class="h-64 md:h-80 rounded-[32px] overflow-hidden grayscale-[0.3] group-hover:grayscale-0 transition-all duration-700">
                                <iframe
                                    width="100%"
                                    height="100%"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.600642231669!2d124.0018151758788!3d12.965413315025983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a0efa84f2334a5%3A0xc3b7727c90070765!2sACLC%20College%20@%20Sorsogon!5e0!3m2!1sen!2sph!4v1715850000000!5m2!1sen!2sph">
                                </iframe>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-center lg:justify-end">
                            <a href="https://maps.app.goo.gl/pTojT6jvoDMRZQcHk" target="_blank" class="px-6 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-full text-xs font-bold text-gray-300 flex items-center gap-2 transition-all">
                                VIEW ON GOOGLE MAPS ↗
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">
                        © 2026 AI SELF-CHECK & CHATBOT SYSTEM.
                    </p>
                    <div class="flex gap-6">
                        <a href="{{ route('about') }}" class="text-[10px] text-gray-500 hover:text-white transition uppercase tracking-widest font-bold">About Us</a>
                        <a href="{{ route('terms') }}" class="text-[10px] text-gray-500 hover:text-white transition uppercase tracking-widest font-bold">Privacy Policy</a>
                        <a href="{{ route('terms') }}" class="text-[10px] text-gray-500 hover:text-white transition uppercase tracking-widest font-bold">Terms</a>
                    </div>
                </div>
            </div>
        </footer>
</body>

</html>