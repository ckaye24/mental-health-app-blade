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

    <main class="max-w-5xl mx-auto px-6 py-12 md:py-20">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#1C1C84] mb-4">Terms of Service</h1>
            <p class="text-lg text-gray-500">Please read these terms carefully before using our AI Self-Check & Chatbot Platform.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-blue-50 overflow-hidden">
            <div class="h-2 bg-[#1C1C84]"></div>

            <div class="p-8 md:p-16 space-y-12">

                <section>
                    <h2 class="text-2xl font-bold text-[#1C1C84] mb-4">Acceptance of Terms</h2>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p>By accessing and using the AI Self-Check & Chatbot Platform, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service. If you do not agree to these terms, please discontinue use of the platform immediately.</p>
                        <p>These terms constitute a legally binding agreement between you and the platform operators. Your continued use of the service indicates your acceptance of any modifications to these terms.</p>
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#1C1C84] mb-4">User Accounts</h2>
                    <p class="mb-4">To access certain features of the platform, you must create an account. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</p>
                    <h3 class="font-bold text-[#1C1C84] mb-2">Account Requirements:</h3>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>You must provide accurate and complete information during registration</li>
                        <li>You must be 16 years old and above to create an account</li>
                        <li>You must notify us immediately of any unauthorized use of your account</li>
                        <li>You are solely responsible for maintaining password security</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#1C1C84] mb-4">Privacy & Data Protection</h2>
                    <p class="mb-6">We are committed to protecting your privacy and personal information. All data collected through the platform is handled in accordance with applicable data protection regulations.</p>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-[#F6F6F6] p-6 rounded-2xl">
                            <h3 class="font-bold text-[#1C1C84] mb-2">Data Collection</h3>
                            <p class="text-sm text-gray-600">We collect information necessary to provide our services, including account details, quiz responses, chat history, and stress assessment results. This data is encrypted and stored securely.</p>
                        </div>
                        <div class="bg-[#F6F6F6] p-6 rounded-2xl">
                            <h3 class="font-bold text-[#1C1C84] mb-2">Data Usage</h3>
                            <p class="text-sm text-gray-600">Your data is used solely to improve service quality, provide personalized recommendations, and generate stress level insights. We do not sell your personal information to third parties.</p>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#1C1C84] mb-4">AI Service Usage</h2>
                    <p class="mb-4 italic">Our AI-powered services are designed to detect and report stress levels based on user responses. These services are provided for informational and educational purposes only and do not constitute medical advice.</p>
                    <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4 rounded-r-xl">
                        <h3 class="font-bold text-yellow-800 mb-2 underline">AI Limitations:</h3>
                        <ul class="list-disc pl-6 space-y-1 text-yellow-900 text-sm">
                            <li>AI assessments are not a substitute for professional medical diagnosis</li>
                            <li>Results should be interpreted as general guidance only</li>
                            <li>The platform does not guarantee accuracy of stress level detection</li>
                            <li>Users should consult healthcare professionals for medical concerns</li>
                        </ul>
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#1C1C84] mb-4">Quiz and Assessment</h2>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p>The quiz feature allows users to assess their stress levels through a series of questions. Your responses are analyzed by our AI system to provide insights into your mental well-being.</p>
                        <p>Quiz results are stored in your profile and can be reviewed at any time. You may retake assessments as oftens as you wish to track changes in your stress levels over time.</p>
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#1C1C84] mb-4">Chatbot Interaction</h2>
                    <p class="mb-4">Our AI chatbot provides conversational support and can detect stress indicators through your messages. All conversations are confidential and stored securely.</p>
                    <h3 class="font-bold text-[#1C1C84] mb-2">Chatbot Guidelines:</h3>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Be respectful and avoid abusive or inappropriate language.</li>
                        <li>Do not share sensitive personal information beyond what is necessary.</li>
                        <li>Understand that responses are generated by AI and may have limitations.
                        </li>
                        <li>Seek emergency help if experiencing a mental health crisis.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#1C1C84] mb-4">User Responsibilities</h2>
                    <p class="mb-4">As a user of this platform, you agree to use the service responsibly and in accordance with all applicable laws and regulations.</p>
                    <h3 class="font-bold text-[#1C1C84] mb-2">Prohibited Activities:</h3>
                    <ul class="grid md:grid-cols-2 gap-2 list-none text-sm">
                        <li class="flex items-center gap-2"><span class="text-red-500">✕</span> Attempting to compromise the security of the platform</li>
                        <li class="flex items-center gap-2"><span class="text-red-500">✕</span> Uploading malicious code or harmful content</li>
                        <li class="flex items-center gap-2"><span class="text-red-500">✕</span> Impersonating other users or entities.</li>
                        <li class="flex items-center gap-2"><span class="text-red-500">✕</span>Using the service for commercial purposes without authorization.</li>
                        <li class="flex items-center gap-2"><span class="text-red-500">✕</span>Attempting to reverse engineer or extract proprietary algorithms</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#1C1C84] mb-4">Intellectual Property</h2>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p>You may not reproduce, distribute, modify, or create derivative works from any content on the platform without express written permission.</p>
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#1C1C84] mb-4">Limitation of Liability</h2>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p>The platform is provided on an 'as is' and 'as available' basis. We make no warranties express or implied, regarding the accuracy, reliability, or availability of the service.</p>
                    </div>
                </section>

                <section class="border-t border-gray-100 pt-8">
                    <h2 class="text-2xl font-bold text-[#1C1C84] mb-4">Changes to Terms</h2>
                    <p class="text-gray-600 italic text-sm">We reserve the right to modify these Terms of Service at any time. Changes will be effective immediately upon posting to the platform. Your continued use of the service after changes are posted constitutes acceptance of the modified terms.<br><br> We encourage you to review these terms periodically to stay informed of any updates. Mateial changes will be communicated through email notification or prominent notice on the platform.</p>
                </section>

            </div>
        </div>
    </main>

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