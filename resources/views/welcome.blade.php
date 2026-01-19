<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Self-Check & Chatbot System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-white font-sans antialiased text-[#3E5C66]">
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
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
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

    <section class="w-full bg-white">
        <div class="container mx-auto px-6 md:px-16 py-12 md:py-20 flex flex-col-reverse lg:flex-row items-center justify-between gap-10">
            <div class="w-full lg:w-1/2 space-y-6 text-center lg:text-left">
                <h1 class="text-6xl md:text-8xl font-bold text-[#1C1C84] leading-tight">
                    Your Mental Wellness <br> Checker
                </h1>
                <p class="text-lg md:text-xl text-[#000000] max-w-md mx-auto lg:mx-0">
                    AI-powered stress detection through interactive quizzes and conversations.
                </p>
                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                    <a href="#" class="group bg-[#1C1C84] text-white border-2 border-[#1C1C84] px-8 py-4 rounded-2xl flex items-center justify-center gap-3 shadow-md transition-all duration-300 hover:bg-white hover:text-[#1C1C84] hover:shadow-lg hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            <path d="M9 12l2 2 4-4"></path>
                        </svg>
                        <span class="font-bold text-lg">Try Now</span>
                    </a>

                    <a href="#tools" class="group border-2 border-[#1C1C84] text-[#1C1C84] px-8 py-4 rounded-2xl flex items-center justify-center gap-3 transition-all duration-300 hover:bg-[#1C1C84] hover:text-white hover:shadow-lg hover:-translate-y-1">
                        <span class="font-bold text-lg">Learn More</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-300 group-hover:translate-y-1">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <polyline points="19 12 12 19 5 12"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <img src="{{ asset('pictures/img1.jpg') }}" class="rounded-2xl shadow-xl border-4 border-white w-full h-auto" alt="image1">
            </div>
        </div>
    </section>

    <section id="tools" class="w-full bg-white py-16 md:py-24">
        <div class="container mx-auto px-6 md:px-16 text-center">
            <h2 class="text-5xl md:text-5xl font-bold text-[#1C1C84] mb-4">Comprehensive Mental Health Tools</h2>
            <p class="text-2xl text-[#000000] mb-12">Evidence-based tools to understand and manage your stress levels</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-transparent border-2 border-[#1C1C84]/30 p-8 md:p-10 rounded-[40px] text-center shadow-sm hover:shadow-md hover:border-[#1C1C84] transition-all duration-300 group">
                    <div class="relative mb-8 mx-auto w-28 h-28 flex items-center justify-center">
                        <div class="absolute inset-0 bg-[#1C1C84] opacity-5 blur-2xl rounded-full group-hover:opacity-10 transition-opacity"></div>
                        <div class="relative w-24 h-24 bg-gradient-to-br from-white to-[#f8faff] border border-white rounded-[32px] shadow-sm flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#1C1C84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-[#1C1C84] mb-4">Interactive Quiz</h3>
                    <p class="text-black opacity-80 mb-8 text-lg leading-relaxed">
                        Answer carefully designed questions that help identify your stress patterns and mental health indicators through evidence-based methods.
                    </p>
                    <a href="#" class="font-bold text-[#1C1C84] flex items-center justify-center gap-2 hover:underline">
                        Try Quiz →
                    </a>
                </div>

                <div class="bg-transparent border-2 border-[#1C1C84]/30 p-8 md:p-10 rounded-[40px] text-center shadow-sm hover:shadow-md hover:border-[#1C1C84] transition-all duration-300 group">
                    <div class="relative mb-8 mx-auto w-28 h-28 flex items-center justify-center">
                        <div class="absolute inset-0 bg-[#1C1C84] opacity-5 blur-2xl rounded-full group-hover:opacity-10 transition-opacity"></div>
                        <div class="relative w-24 h-24 bg-gradient-to-br from-white to-[#f8faff] border border-white rounded-[32px] shadow-sm flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#1C1C84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-[#1C1C84] mb-4">AI Chatbot</h3>
                    <p class="text-black opacity-80 mb-8 text-lg leading-relaxed">
                        Talk to our AI assistant anytime. Share your feelings in a safe, judgement-free space and receive empathetic, personalized support and guidance.
                    </p>
                    <a href="#" class="font-bold text-[#1C1C84] flex items-center justify-center gap-2 hover:underline">
                        Start Chat →
                    </a>
                </div>

                <div class="bg-transparent border-2 border-[#1C1C84]/30 p-8 md:p-10 rounded-[40px] text-center shadow-sm hover:shadow-md hover:border-[#1C1C84] transition-all duration-300 group md:col-span-2 lg:col-span-1">
                    <div class="relative mb-8 mx-auto w-28 h-28 flex items-center justify-center">
                        <div class="absolute inset-0 bg-[#1C1C84] opacity-5 blur-2xl rounded-full group-hover:opacity-10 transition-opacity"></div>
                        <div class="relative w-24 h-24 bg-gradient-to-br from-white to-[#f8faff] border border-white rounded-[32px] shadow-sm flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#1C1C84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0a2 2 0 002 2h2a2 2 0 002-2v-6a2 2 0 00-2-2h-2a2 2 0 00-2 2v6z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-[#1C1C84] mb-4">Stress Analysis</h3>
                    <p class="text-black opacity-80 mb-8 text-lg leading-relaxed">
                        Get detailed reports and visualizations of your stress levels over time. Understand patterns and track your mental wellness journey with actionable insights.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="container mx-auto px-6 md:px-16 py-16 md:py-24 flex flex-col lg:flex-row items-center justify-between gap-12">
            <div class="w-full lg:w-1/2 space-y-8 text-center lg:text-left">
                <h2 class="text-6xl md:text-6xl font-bold text-[#1C1C84] min-h-[120px] lg:min-h-[150px]">
                    <span id="typewriter"></span><span class="animate-pulse">|</span>
                </h2>
                <p class="text-lg md:text-xl text-black opacity-70">
                    Join thousands of users improving their mental health with AI-powered insights
                </p>
                <button class="bg-[#1C1C84] border-2 border-[#1C1C84] text-white px-10 md:px-12 py-4 md:py-5 rounded-[25px] text-xl font-bold shadow-lg hover:bg-white hover:text-[#1C1C84] transition">
                    Start Now
                </button>
            </div>
            <div class="w-full lg:w-1/2">
                <img src="{{ asset('pictures/img2.jpg') }}" class="rounded-3xl shadow-2xl w-full h-auto" alt="Man looking at sky">
            </div>
        </div>
    </section>

    <script>
        const typewriterElement = document.getElementById('typewriter');
        const text = "Ready to Start Your Wellness Journey?";
        let index = 0;
        let isDeleting = false;
        let typeSpeed = 100;

        function handleType() {
            const currentText = text.substring(0, index);
            typewriterElement.innerHTML = currentText.replace("Your ", "Your <br>");
            let dynamicSpeed = isDeleting ? 50 : 100;
            if (!isDeleting && index === text.length) {
                dynamicSpeed = 2000;
                isDeleting = true;
            } else if (isDeleting && index === 0) {
                isDeleting = false;
                dynamicSpeed = 500;
            }
            index = isDeleting ? index - 1 : index + 1;
            setTimeout(handleType, dynamicSpeed);
        }
        document.addEventListener('DOMContentLoaded', handleType);
    </script>

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
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3893.364402636603!2d124.0041!3d12.9687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTLCsDU4JzA3LjMiTiAxMjTCsDAwJzE0LjgiRQ!5e0!3m2!1sen!2sph!4v1620000000000">
                            </iframe>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-center lg:justify-end">
                        <a href="#" target="_blank" class="px-6 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-full text-xs font-bold text-gray-300 flex items-center gap-2 transition-all">
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