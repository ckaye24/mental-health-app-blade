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

<body class="bg-[#FFFFF7] font-sans antialiased text-[#3E5C66]">
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

    <section class="py-12 md:py-24 text-center px-4 md:px-6 bg-white overflow-hidden flex flex-col items-center">
        <div class="inline-flex justify-center w-full mb-6">
            <h1 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-extrabold text-[#1C1C84] overflow-hidden border-r-4 border-[#1C1C84] whitespace-nowrap animate-typewriter max-w-fit">
                About Our Platform
            </h1>
        </div>

        <h2 class="text-xl sm:text-2xl md:text-4xl font-medium text-black mb-6 md:mb-8">
            Understanding Stress, Supporting Wellness
        </h2>

        <div class="h-1.5 w-24 md:w-32 bg-[#1C1C84] mx-auto mb-8 rounded-full"></div>

        <p class="max-w-7xl mx-auto text-lg sm:text-xl md:text-2xl text-gray-800 leading-relaxed md:leading-loose px-2 mb-12">
            Our AI-powered self-check system and intelligent chatbot are designed to help you understand and manage stress levels effectively. Through interactive quizzes and personalized conversations, we provide insights and support for your mental wellness journey. Experience a compassionate, human-centered approach to stress detection and emotional well-being.
        </p>

        <a href="#vision-mission" class="animate-bounce inline-block p-4 bg-gray-50 rounded-full hover:bg-gray-100 transition-colors shadow-sm border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#1C1C84]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
            </svg>
        </a>
    </section>



    <style>
        /* Pulse/Bounce combination for the arrow */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(-10%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: none;
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        .animate-bounce {
            animation: bounce 1s infinite;
        }

        /* Your existing Typewriter CSS */
        .animate-typewriter {
            width: 0;
            animation: typing 4s steps(18, end) infinite alternate, blink 0.8s step-end infinite;
        }

        @keyframes typing {
            0% {
                width: 0;
            }

            70%,
            100% {
                width: 100%;
            }
        }

        @keyframes blink {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: #1C1C84
            }
        }

        @media (max-width: 380px) {
            .animate-typewriter {
                font-size: 1.5rem;
            }
        }
    </style>

    <section id="vision-mission" class="py-24 bg-white px-6">
        <div class="container mx-auto text-center mb-16">
            <h2 class="text-6xl font-bold text-[#1C1C84] mb-4">Our Vision & Mission</h2>
            <p class="text-gray-500 text-2xl">Building a future where mental wellness is accessible, proactive, and free from stigma.</p>
        </div>

        <div class="container mx-auto grid md:grid-cols-2 gap-10 max-w-5xl">
            <div class="bg-transparent border-2 border-[#1C1C84]/30 p-8 md:p-12 rounded-[40px] text-center shadow-sm hover:shadow-md hover:border-[#1C1C84] transition-all duration-300 group">
                <div class="relative mb-8 mx-auto w-28 h-28 flex items-center justify-center">
                    <div class="absolute inset-0 bg-[#1C1C84] opacity-5 blur-2xl rounded-full group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative w-24 h-24 bg-gradient-to-br from-white to-[#f8faff] border border-white rounded-[32px] shadow-sm flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#1C1C84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#1C1C84] mb-4">Our Vision</h3>
                <p class="text-black opacity-80 text-lg leading-relaxed">
                    A world where mental health support is as accessible and normalized as physical healthcare, empowering individuals to take control of their emotional well-being.<br> <br>
                    We envision a future where AI technology bridges the gap between awareness and actin, making stress detection immediate and intervention timely.
                </p>
            </div>

            <div class="bg-transparent border-2 border-[#1C1C84]/30 p-8 md:p-12 rounded-[40px] text-center shadow-sm hover:shadow-md hover:border-[#1C1C84] transition-all duration-300 group">
                <div class="relative mb-8 mx-auto w-28 h-28 flex items-center justify-center">
                    <div class="absolute inset-0 bg-[#1C1C84] opacity-5 blur-2xl rounded-full group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative w-24 h-24 bg-gradient-to-br from-white to-[#f8faff] border border-white rounded-[32px] shadow-sm flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#1C1C84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#1C1C84] mb-4">Our Mission</h3>
                <p class="text-black opacity-80 text-lg leading-relaxed">
                    To provide intelligent, compassionate, and scientifically-backed tools that help individuals identify stress patterns and receive personalized support when they need it most. <br> <br>
                    We are committed to combining cutting-edge AI with human-centered design to create a safe space for self-reflection and proactive mental health management.
                </p>
            </div>
        </div>
    </section>

    <section class="py-24 px-6 bg-white">
        <div class="container mx-auto text-center mb-16">
            <h2 class="text-6xl font-bold text-[#1C1C84] mb-4">Our Core Values</h2>
            <p class="text-gray-500 text-2xl">Our mission is guided by principles that ensure every interaction is meaningful and secure.</p>
        </div>

        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-transparent border-2 border-[#1C1C84]/30 p-8 rounded-[40px] text-center shadow-sm hover:shadow-md hover:border-[#1C1C84] transition-all duration-300 group">
                <div class="relative mb-6 mx-auto w-24 h-24 flex items-center justify-center">
                    <div class="absolute inset-0 bg-[#1C1C84] opacity-5 blur-xl rounded-full group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative w-20 h-20 bg-gradient-to-br from-white to-[#f8faff] border border-white rounded-[28px] shadow-sm flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#1C1C84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </div>
                </div>
                <h4 class="text-2xl font-bold text-[#1C1C84] mb-3">Empathy</h4>
                <p class="text-black opacity-70 text-sm leading-relaxed">We deeply understand the human behind stress and mental health challenges, creating solutions with genuine care.</p>
            </div>

            <div class="bg-transparent border-2 border-[#1C1C84]/30 p-8 rounded-[40px] text-center shadow-sm hover:shadow-md hover:border-[#1C1C84] transition-all duration-300 group">
                <div class="relative mb-6 mx-auto w-24 h-24 flex items-center justify-center">
                    <div class="absolute inset-0 bg-[#1C1C84] opacity-5 blur-xl rounded-full group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative w-20 h-20 bg-gradient-to-br from-white to-[#f8faff] border border-white rounded-[28px] shadow-sm flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#1C1C84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                        </svg>
                    </div>
                </div>
                <h4 class="text-2xl font-bold text-[#1C1C84] mb-3">Innovation</h4>
                <p class="text-black opacity-70 text-sm leading-relaxed">We leverage cutting-edge AI technology to provide personalized stress detection and support.</p>
            </div>

            <div class="bg-transparent border-2 border-[#1C1C84]/30 p-8 rounded-[40px] text-center shadow-sm hover:shadow-md hover:border-[#1C1C84] transition-all duration-300 group">
                <div class="relative mb-6 mx-auto w-24 h-24 flex items-center justify-center">
                    <div class="absolute inset-0 bg-[#1C1C84] opacity-5 blur-xl rounded-full group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative w-20 h-20 bg-gradient-to-br from-white to-[#f8faff] border border-white rounded-[28px] shadow-sm flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#1C1C84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </div>
                </div>
                <h4 class="text-2xl font-bold text-[#1C1C84] mb-3">Privacy</h4>
                <p class="text-black opacity-70 text-sm leading-relaxed">Your data security and confidentiality are our absolute top priorities. We maintain strict privacy standards.</p>
            </div>

            <div class="bg-transparent border-2 border-[#1C1C84]/30 p-8 rounded-[40px] text-center shadow-sm hover:shadow-md hover:border-[#1C1C84] transition-all duration-300 group">
                <div class="relative mb-6 mx-auto w-24 h-24 flex items-center justify-center">
                    <div class="absolute inset-0 bg-[#1C1C84] opacity-5 blur-xl rounded-full group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative w-20 h-20 bg-gradient-to-br from-white to-[#f8faff] border border-white rounded-[28px] shadow-sm flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#1C1C84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                </div>
                <h4 class="text-2xl font-bold text-[#1C1C84] mb-3">Trust</h4>
                <p class="text-black opacity-70 text-sm leading-relaxed">We are committed to building trustworthy relationships through transparent practices and relaible results.</p>
            </div>
        </div>
    </section>

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