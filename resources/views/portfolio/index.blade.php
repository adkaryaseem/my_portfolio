<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['hero_name'] ?? 'Portfolio' }} - {{ $settings['hero_title'] ?? 'Digital Experience' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Outfit:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    
    <!-- Tailwind Browser Script for seamless CDN usage without build step -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- GSAP & ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    @if(isset($settings['profile_picture']))
        <link rel="icon" type="image/png" href="{{ $settings['profile_picture'] }}">
    @endif
</head>
<body x-data="portfolioExperience()" x-init="initExperience()" class="bg-black text-gray-300 antialiased selection:bg-white/10 selection:text-white" @mousemove="updateCursor($event)">

    <!-- Noise Texture -->
    <div class="bg-noise"></div>
    
    <!-- Ambient Lighting Glow -->
    <div class="ambient-glow"></div>

    <!-- Cinematic Custom Cursor -->
    <div class="cursor-dot" x-ref="cursorDot"></div>
    <div class="cursor-outline" x-ref="cursorOutline" :class="{'scale-150 bg-white/10 border-transparent': isHovering}"></div>

    <!-- Loading Screen -->
    <div id="cinematic-loader" x-ref="loader" x-show="!loaderComplete" class="fixed inset-0 z-[1000] bg-[#050505] flex flex-col justify-center items-center">
        <div class="w-16 h-16 border-t-2 border-indigo-500 rounded-full animate-spin mb-8"></div>
        <div class="text-xs tracking-[0.8em] uppercase text-indigo-500/50 animate-pulse">Initializing System</div>
    </div>

    <!-- Background Grid -->
    <div class="bg-mesh"></div>

    <!-- Desktop Navigation -->
    <header class="fixed top-0 left-0 w-full z-[100] px-8 md:px-24 py-8 hidden lg:flex justify-between items-center bg-gradient-to-b from-[#050505] to-transparent pointer-events-none">
        <a href="#hero" class="font-heading text-2xl font-bold tracking-widest text-white pointer-events-auto" @mouseenter="isHovering = true" @mouseleave="isHovering = false">{{ $settings['hero_name'] ?? 'Portfolio' }}</a>
        <nav class="flex space-x-12 pointer-events-auto">
            <a href="#about" class="text-xs tracking-[0.2em] uppercase text-white/50 hover:text-indigo-400 transition-colors" @mouseenter="isHovering = true" @mouseleave="isHovering = false">About</a>
            <a href="#projects" class="text-xs tracking-[0.2em] uppercase text-white/50 hover:text-indigo-400 transition-colors" @mouseenter="isHovering = true" @mouseleave="isHovering = false">Work</a>
            <a href="#experience" class="text-xs tracking-[0.2em] uppercase text-white/50 hover:text-indigo-400 transition-colors" @mouseenter="isHovering = true" @mouseleave="isHovering = false">Experience</a>
            <a href="#contact" class="text-xs tracking-[0.2em] uppercase text-white/50 hover:text-indigo-400 transition-colors" @mouseenter="isHovering = true" @mouseleave="isHovering = false">Contact</a>
        </nav>
    </header>

    <!-- Hidden Navigation System (Mobile) -->
    <button @click="toggleMenu" class="hamburger-btn lg:hidden" :class="{'open': menuOpen}" @mouseenter="isHovering = true" @mouseleave="isHovering = false" aria-label="Toggle Navigation">
        <div class="hamburger-lines"></div>
    </button>

    <nav class="nav-overlay lg:hidden" :class="{'open': menuOpen}">
        <div class="flex flex-col items-center space-y-6 md:space-y-8">
            <a href="#hero" @click="toggleMenu" class="nav-link text-2xl md:text-4xl" @mouseenter="isHovering = true" @mouseleave="isHovering = false">Home</a>
            <a href="#about" @click="toggleMenu" class="nav-link text-2xl md:text-4xl" @mouseenter="isHovering = true" @mouseleave="isHovering = false">About</a>
            <a href="#projects" @click="toggleMenu" class="nav-link text-2xl md:text-4xl" @mouseenter="isHovering = true" @mouseleave="isHovering = false">Work</a>
            <a href="#experience" @click="toggleMenu" class="nav-link text-2xl md:text-4xl" @mouseenter="isHovering = true" @mouseleave="isHovering = false">Experience</a>
            <a href="#contact" @click="toggleMenu" class="nav-link text-2xl md:text-4xl" @mouseenter="isHovering = true" @mouseleave="isHovering = false">Contact</a>
        </div>
        
        <div class="absolute bottom-12 text-white/30 text-xs tracking-widest uppercase">
            {{ $settings['hero_name'] ?? 'Portfolio' }} &copy; {{ date('Y') }}
        </div>
    </nav>

    <!-- Main Content Flow -->
    <main class="relative z-10 w-full overflow-x-hidden" x-show="loaderComplete" style="display: none;">
        
        <!-- Hero Section -->
        <section id="hero" class="min-h-screen flex flex-col justify-center px-4 md:px-12 lg:px-24 relative pt-32 lg:pt-20 pb-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center w-full max-w-7xl mx-auto">
                <div class="max-w-xl mt-12 lg:mt-0 text-center lg:text-left">
                    <div class="overflow-hidden mb-4">
                        <p class="hero-reveal text-xs md:text-sm tracking-[0.3em] uppercase text-white/50 translate-y-full">{{ $settings['hero_title'] ?? 'Creative Developer' }}</p>
                    </div>
                    
                    <h1 class="font-heading text-4xl md:text-6xl lg:text-7xl xl:text-8xl font-light text-white leading-tight tracking-tighter mb-6 lg:mb-8">
                        @php
                            $nameParts = explode(' ', $settings['hero_name'] ?? 'Your Name');
                        @endphp
                        @foreach($nameParts as $part)
                            <div class="overflow-hidden inline-block mr-2 lg:mr-4">
                                <span class="hero-reveal inline-block translate-y-full">{{ $part }}</span>
                            </div>
                        @endforeach
                    </h1>
                    
                    <div class="max-w-md mx-auto lg:mx-0 overflow-hidden">
                        <p class="hero-reveal text-base md:text-lg text-white/60 font-light leading-relaxed translate-y-full">
                            {{ $settings['about_subtitle'] ?? 'Creating immersive digital experiences through code and design.' }}
                        </p>
                    </div>
                </div>

                <!-- Interactive 3D Cube -->
                <div class="hero-reveal opacity-0 flex justify-center items-center h-[250px] md:h-[400px] lg:h-[500px]" @mouseenter="isHovering = true" @mouseleave="isHovering = false" style="perspective: 1500px;">
                    <div class="cinematic-cube-container w-[150px] h-[150px] md:w-[200px] md:h-[200px]" x-ref="cubeContainer" style="transform-style: preserve-3d;">
                        <div class="cinematic-cube" x-ref="cube">
                            <div class="cube-face front"><img src="{{ asset('images/3d/cube_front_1778646854886.png') }}" alt="Texture" class="w-full h-full object-cover"></div>
                            <div class="cube-face back"><img src="{{ asset('images/3d/cube_back_1778646931478.png') }}" alt="Texture" class="w-full h-full object-cover"></div>
                            <div class="cube-face right"><img src="{{ asset('images/3d/cube_right_1778647145610.png') }}" alt="Texture" class="w-full h-full object-cover"></div>
                            <div class="cube-face left"><img src="{{ asset('images/3d/cube_left_1778647002353.png') }}" alt="Texture" class="w-full h-full object-cover"></div>
                            <div class="cube-face top"><img src="{{ asset('images/3d/cube_top_1778647205974.png') }}" alt="Texture" class="w-full h-full object-cover"></div>
                            <div class="cube-face bottom"><img src="{{ asset('images/3d/cube_bottom_1778647350626.png') }}" alt="Texture" class="w-full h-full object-cover"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="absolute bottom-12 left-8 md:left-24 hero-reveal opacity-0">
                <p class="text-xs tracking-[0.2em] uppercase text-white/30 rotate-90 origin-left">Scroll to explore</p>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="min-h-screen py-24 md:py-32 px-4 md:px-12 lg:px-24 border-t border-white/5 relative">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                <div class="lg:col-span-4 gsap-reveal">
                    <h2 class="text-[10px] md:text-xs tracking-[0.4em] uppercase text-indigo-500/60 mb-6 md:mb-8">01 // About</h2>
                    @if(isset($settings['profile_picture']))
                        <div class="w-32 h-48 md:w-48 md:h-64 overflow-hidden transition duration-1000 mx-auto lg:mx-0">
                            <img src="{{ $settings['profile_picture'] }}" alt="Profile" class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>
                
                <div class="lg:col-span-8 gsap-reveal delay-100 mt-8 lg:mt-0 text-center lg:text-left">
                    <div class="text-xl md:text-3xl lg:text-4xl font-light leading-snug text-white/80 max-w-3xl mb-12 md:mb-16 mx-auto lg:mx-0">
                        {{ $settings['about_me'] ?? 'I build digital environments that breathe. A fusion of logic and aesthetics.' }}
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
                        @foreach($skills as $skill)
                            <div class="flex flex-col group cursor-default">
                                <span class="text-white/60 font-light text-lg mb-2 group-hover:text-white transition-colors duration-500">{{ $skill->name }}</span>
                                <div class="w-full h-[1px] bg-indigo-500/10 relative overflow-hidden">
                                    <div class="absolute top-0 left-0 h-full bg-indigo-500/50 w-0 group-hover:w-full transition-all duration-1000 ease-out" style="width: {{ $skill->proficiency }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Selected Works Section -->
        <section id="projects" class="py-24 md:py-32 px-4 md:px-12 lg:px-24 border-t border-white/5">
            <div class="mb-16 md:mb-24 gsap-reveal text-center lg:text-left">
                <h2 class="text-[10px] md:text-xs tracking-[0.4em] uppercase text-indigo-500/60 mb-4">02 // Work</h2>
                <div class="text-3xl md:text-5xl lg:text-6xl font-light text-white uppercase tracking-tighter">Work</div>
            </div>

            <div class="space-y-24 md:space-y-32 lg:space-y-48">
                @foreach($projects as $index => $project)
                <div class="project-card grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-center gsap-reveal">
                    <!-- Alternate layout left/right -->
                    <div class="lg:col-span-7 {{ $index % 2 !== 0 ? 'lg:order-last' : '' }}">
                        <a href="{{ route('project.show', $project->slug) }}" class="block project-image-container aspect-[4/3] group" @mouseenter="isHovering = true" @mouseleave="isHovering = false">
                            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="project-image w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition duration-700"></div>
                        </a>
                    </div>
                    
                    <div class="lg:col-span-5 flex flex-col justify-center">
                        <div class="text-white/30 text-sm tracking-[0.2em] mb-4 font-mono">{{ sprintf('%02d', $index + 1) }}</div>
                        <h3 class="text-3xl md:text-5xl font-light text-white mb-6">{{ $project->title }}</h3>
                        <p class="text-white/50 font-light text-lg leading-relaxed mb-8">{{ $project->description }}</p>
                        
                        <a href="{{ route('project.show', $project->slug) }}" class="inline-flex items-center text-xs tracking-[0.3em] uppercase text-white/60 hover:text-white transition-colors duration-300 group" @mouseenter="isHovering = true" @mouseleave="isHovering = false">
                            <span class="mr-4">Explore</span>
                            <div class="w-8 h-[1px] bg-white/30 group-hover:w-16 group-hover:bg-white transition-all duration-500"></div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Experience & Certs -->
        <section id="experience" class="py-24 md:py-32 px-4 md:px-12 lg:px-24 border-t border-white/5 bg-gradient-to-b from-transparent to-[#050505]">
            <div class="mb-16 md:mb-24 gsap-reveal text-center lg:text-left">
                <h2 class="text-[10px] md:text-xs tracking-[0.4em] uppercase text-indigo-500/60 mb-4">03 // Experience</h2>
                <div class="text-3xl md:text-5xl lg:text-6xl font-light text-white uppercase tracking-tighter">Experience</div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 max-w-6xl mx-auto">
                <!-- Experience -->
                <div>
                    <h3 class="text-lg md:text-xl font-light text-white/70 mb-8 md:mb-12 border-b border-white/10 pb-4 inline-block">Experience</h3>
                    <div class="space-y-12 md:space-y-16">
                        @foreach($experiences as $exp)
                        <div class="gsap-reveal border-l border-white/10 pl-8 relative group">
                            <div class="absolute w-2 h-2 rounded-full bg-white/20 -left-[4.5px] top-2 group-hover:bg-white group-hover:shadow-[0_0_10px_rgba(255,255,255,0.8)] transition-all duration-500"></div>
                            <div class="text-xs tracking-widest text-white/40 mb-2 font-mono">{{ $exp->start_date }} &mdash; {{ $exp->end_date }}</div>
                            <h4 class="text-2xl text-white font-light mb-1">{{ $exp->title }}</h4>
                            <div class="text-white/60 text-sm tracking-wide uppercase mb-4">{{ $exp->company }}</div>
                            <p class="text-white/50 font-light leading-relaxed">{{ $exp->description }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Certifications -->
                <div>
                    <h3 class="text-lg md:text-xl font-light text-white/70 mb-8 md:mb-12 border-b border-white/10 pb-4 inline-block">Certifications</h3>
                    <div class="space-y-8 md:space-y-12">
                        @foreach($certifications as $cert)
                        <div class="gsap-reveal glass-panel p-8 group hover:bg-white/[0.02] transition duration-500">
                            <div class="text-xs tracking-widest text-white/40 mb-2 font-mono">{{ $cert->date }}</div>
                            <h4 class="text-xl text-white font-light mb-2">{{ $cert->name }}</h4>
                            <div class="text-white/50 text-sm mb-6">{{ $cert->issuer }}</div>
                            
                            @if($cert->certificate_file)
                                <button @click="openCert('{{ $cert->certificate_file }}')" class="text-xs tracking-[0.2em] uppercase text-white/40 hover:text-white transition-colors duration-300 flex items-center gap-2" @mouseenter="isHovering = true" @mouseleave="isHovering = false">
                                    <span>View Document</span>
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="flex flex-col justify-center items-center pt-24 md:pt-32 pb-0 px-4 md:px-12 lg:px-24 border-t border-white/5 relative overflow-hidden">
            <!-- Subtle background circle -->
            <div class="absolute w-[400px] h-[400px] md:w-[800px] md:h-[800px] border border-white/5 rounded-full pointer-events-none opacity-50 scale-150"></div>
            
            <div class="text-center mb-12 md:mb-16 relative z-10 gsap-reveal">
                <h2 class="text-[10px] md:text-xs tracking-[0.4em] uppercase text-indigo-500/60 mb-4">04 // Contact</h2>
                <div class="text-4xl md:text-6xl lg:text-8xl font-light text-white tracking-tighter uppercase">Contact</div>
            </div>

            <div class="w-full max-w-2xl relative z-10 gsap-reveal delay-100">
                @if(session('success'))
                    <div class="border border-white/20 text-white/80 p-4 text-center text-sm tracking-widest uppercase mb-8 backdrop-blur-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-8" x-data="contactForm()" @submit="validateForm">
                    @csrf
                    <!-- Honeypot Field -->
                    <div style="display: none;">
                        <input type="text" name="honeypot" value="">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="group relative">
                            <input type="text" name="name" x-model="form.name" required maxlength="255" placeholder="YOUR NAME" class="w-full bg-transparent border-b border-white/20 py-4 text-white focus:outline-none focus:border-white transition-colors placeholder:text-white/20 text-sm tracking-widest font-light" :class="{'border-red-500/50': errors.name}">
                            @error('name') <span class="absolute -bottom-5 left-0 text-red-400 text-xs tracking-widest">{{ $message }}</span> @enderror
                            <span x-show="errors.name" x-text="errors.name" class="absolute -bottom-5 left-0 text-red-400 text-xs tracking-widest" style="display: none;"></span>
                        </div>
                        <div class="group relative">
                            <input type="email" name="email" x-model="form.email" required maxlength="255" placeholder="YOUR EMAIL" class="w-full bg-transparent border-b border-white/20 py-4 text-white focus:outline-none focus:border-white transition-colors placeholder:text-white/20 text-sm tracking-widest font-light" :class="{'border-red-500/50': errors.email}">
                            @error('email') <span class="absolute -bottom-5 left-0 text-red-400 text-xs tracking-widest">{{ $message }}</span> @enderror
                            <span x-show="errors.email" x-text="errors.email" class="absolute -bottom-5 left-0 text-red-400 text-xs tracking-widest" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="group relative mt-8">
                        <textarea name="message" x-model="form.message" required minlength="10" placeholder="YOUR MESSAGE" class="w-full bg-transparent border-b border-white/20 py-4 text-white focus:outline-none focus:border-white transition-colors placeholder:text-white/20 text-sm tracking-widest font-light min-h-[150px] resize-none" :class="{'border-red-500/50': errors.message}"></textarea>
                        @error('message') <span class="absolute -bottom-5 left-0 text-red-400 text-xs tracking-widest">{{ $message }}</span> @enderror
                        <span x-show="errors.message" x-text="errors.message" class="absolute -bottom-5 left-0 text-red-400 text-xs tracking-widest" style="display: none;"></span>
                    </div>
                    <div class="pt-12 text-center relative">
                        <button type="submit" class="text-xs tracking-[0.4em] uppercase text-white bg-indigo-600 hover:bg-indigo-500 px-12 py-5 transition-colors duration-500 disabled:opacity-50 disabled:cursor-not-allowed shadow-[0_0_20px_rgba(99,102,241,0.2)]" @mouseenter="isHovering = true" @mouseleave="isHovering = false" :disabled="isSubmitting">
                            <span x-show="!isSubmitting">Send Message</span>
                            <span x-show="isSubmitting" style="display: none;">Sending...</span>
                        </button>
                    </div>
                </form>

                <div class="mt-16 md:mt-24 flex flex-wrap justify-center gap-6 md:gap-12 border-t border-white/10 pt-12">
                    @php
                        $socials = [
                            'contact_email' => [
                                'name' => 'Mail',
                                'prefix' => 'mailto:',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>'
                            ],
                            'github_url' => [
                                'name' => 'Github',
                                'prefix' => '',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>'
                            ],
                            'linkedin_url' => [
                                'name' => 'LinkedIn',
                                'prefix' => '',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>'
                            ],
                            'twitter_url' => [
                                'name' => 'Twitter',
                                'prefix' => '',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>'
                            ],
                            'facebook_url' => [
                                'name' => 'Facebook',
                                'prefix' => '',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>'
                            ],
                            'blog_url' => [
                                'name' => 'Blog',
                                'prefix' => '',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>'
                            ]
                        ];
                    @endphp
                    @foreach($socials as $key => $data)
                        @if(!empty($settings[$key]))
                            <a href="{{ $data['prefix'] === 'mailto:' ? $data['prefix'] . $settings[$key] : $settings[$key] }}" target="_blank" class="flex flex-col items-center gap-3 text-white/40 hover:text-white hover:-translate-y-1 transition-all duration-300 group" @mouseenter="isHovering = true" @mouseleave="isHovering = false">
                                <div class="p-3 rounded-full bg-white/5 group-hover:bg-white/10 transition-colors duration-300">
                                    {!! $data['icon'] !!}
                                </div>
                                <span class="text-[10px] tracking-widest uppercase">{{ $data['name'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
                
                <div class="mt-8 mb-4 text-center text-[10px] tracking-widest text-white/20 uppercase">
                    &copy; {{ date('Y') }} {{ $settings['hero_name'] ?? 'Portfolio' }}. All rights reserved.
                </div>
            </div>
        </section>
    </main>

    <!-- Certificate Modal -->
    <div x-show="certModalOpen" style="display: none;" class="fixed inset-0 bg-black/90 z-[11000] flex justify-center items-center backdrop-blur-md" @click="certModalOpen = false">
        <div class="relative max-w-[90vw] max-h-[90vh]">
            <button @click="certModalOpen = false" class="absolute -top-12 right-0 text-white/50 hover:text-white text-sm tracking-widest uppercase transition-colors" @mouseenter="isHovering = true" @mouseleave="isHovering = false">Close [X]</button>
            <img :src="certUrl" alt="Certificate" class="max-w-full max-h-[85vh] border border-white/10 opacity-0 transition-opacity duration-500" :class="{'opacity-100': certUrl}" oncontextmenu="return false;" draggable="false">
        </div>
    </div>

    <!-- Scripts for logic and animation -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('contactForm', () => ({
                form: {
                    name: '',
                    email: '',
                    message: ''
                },
                errors: {
                    name: '',
                    email: '',
                    message: ''
                },
                isSubmitting: false,

                validateEmail(email) {
                    return String(email)
                        .toLowerCase()
                        .match(
                        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        );
                },

                validateForm(e) {
                    this.errors = { name: '', email: '', message: '' };
                    let isValid = true;

                    if (!this.form.name.trim()) {
                        this.errors.name = 'Identification is required.';
                        isValid = false;
                    }

                    if (!this.form.email.trim()) {
                        this.errors.email = 'Transmission node is required.';
                        isValid = false;
                    } else if (!this.validateEmail(this.form.email)) {
                        this.errors.email = 'Invalid node format.';
                        isValid = false;
                    }

                    if (!this.form.message.trim()) {
                        this.errors.message = 'Payload cannot be empty.';
                        isValid = false;
                    } else if (this.form.message.trim().length < 10) {
                        this.errors.message = 'Payload too short. Minimum 10 characters.';
                        isValid = false;
                    }

                    if (!isValid) {
                        e.preventDefault();
                    } else {
                        this.isSubmitting = true;
                    }
                }
            }));

            Alpine.data('portfolioExperience', () => ({
                menuOpen: false,
                loaderComplete: false,
                isHovering: false,
                certModalOpen: false,
                certUrl: '',
                
                initExperience() {
                    // GSAP register
                    gsap.registerPlugin(ScrollTrigger);

                    // Loading Sequence
                    const tl = gsap.timeline({
                        onComplete: () => {
                            this.loaderComplete = true;
                            // Small delay to allow v-dom rendering before firing main animations
                            setTimeout(() => this.initScrollAnimations(), 100);
                        }
                    });

                    tl.to('.loader-text', { y: 0, opacity: 1, duration: 1, ease: 'power3.out' })
                      .to('.loader-progress', { width: '100%', duration: 1.5, ease: 'power2.inOut' }, '-=0.5')
                      .to('.loader-text', { y: '-100%', opacity: 0, duration: 0.8, ease: 'power3.in' })
                      .to(this.$refs.loader, { opacity: 0, duration: 1, ease: 'power2.inOut' });
                },
                
                initScrollAnimations() {
                    // Hero Elements Reveal
                    gsap.to('.hero-reveal', {
                        y: 0,
                        opacity: 1,
                        duration: 1.5,
                        stagger: 0.15,
                        ease: 'power4.out',
                        delay: 0.2
                    });

                    // Scroll Triggered Reveals for Sections
                    const revealElements = document.querySelectorAll('.gsap-reveal');
                    revealElements.forEach(el => {
                        gsap.to(el, {
                            scrollTrigger: {
                                trigger: el,
                                start: 'top 85%',
                                toggleActions: 'play none none reverse'
                            },
                            opacity: 1,
                            y: 0,
                            duration: 1.5,
                            ease: 'power3.out'
                        });
                    });

                    // Parallax on Projects
                    const projects = document.querySelectorAll('.project-image');
                    projects.forEach(img => {
                        gsap.to(img, {
                            scrollTrigger: {
                                trigger: img.parentElement,
                                start: 'top bottom',
                                end: 'bottom top',
                                scrub: 1
                            },
                            y: '10%',
                            scale: 1.15,
                            ease: 'none'
                        });
                    });

                    // Interactive Cube Rotation (Random Continuous Tumbling)
                    if (this.$refs.cube) {
                        const spinCube = () => {
                            gsap.to(this.$refs.cube, {
                                rotationX: `+=${gsap.utils.random(90, 180)}`,
                                rotationY: `+=${gsap.utils.random(90, 180)}`,
                                rotationZ: `+=${gsap.utils.random(-90, 90)}`,
                                duration: gsap.utils.random(4, 7),
                                ease: 'sine.inOut',
                                onComplete: spinCube
                            });
                        };
                        spinCube();
                    }

                    // Random Floating Animation for the Cube
                    if (this.$refs.cubeContainer) {
                        const floatCube = () => {
                            gsap.to(this.$refs.cubeContainer, {
                                x: gsap.utils.random(-30, 30),
                                y: gsap.utils.random(-30, 30),
                                z: gsap.utils.random(-20, 20),
                                duration: gsap.utils.random(3, 5),
                                ease: 'sine.inOut',
                                onComplete: floatCube
                            });
                        };
                        floatCube();
                    }
                },

                updateCursor(e) {
                    // Custom cursor logic
                    if (this.$refs.cursorDot && this.$refs.cursorOutline) {
                        gsap.set(this.$refs.cursorDot, { x: e.clientX, y: e.clientY });
                        gsap.to(this.$refs.cursorOutline, { 
                            x: e.clientX, 
                            y: e.clientY, 
                            duration: 0.15, 
                            ease: 'power2.out' 
                        });
                    }
                    // Interactive Cube Mouse Parallax
                    if (this.$refs.cubeContainer) {
                        const mouseX = (e.clientX / window.innerWidth) - 0.5;
                        const mouseY = (e.clientY / window.innerHeight) - 0.5;
                        
                        gsap.to(this.$refs.cubeContainer, {
                            rotationY: mouseX * 90,
                            rotationX: -mouseY * 90,
                            duration: 1,
                            ease: 'power2.out'
                        });
                    }
                },

                toggleMenu() {
                    this.menuOpen = !this.menuOpen;
                    if(this.menuOpen) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = 'auto';
                    }
                },

                openCert(url) {
                    this.certUrl = url;
                    this.certModalOpen = true;
                }
            }));
        });
    </script>
</body>
</html>
