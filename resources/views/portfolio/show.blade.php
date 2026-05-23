<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} - {{ $settings['hero_name'] ?? 'Portfolio' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Outfit:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    
    <!-- Tailwind Browser Script -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- GSAP & ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
</head>
<body x-data="projectDetail()" x-init="init()" class="bg-[#050505] text-[#f0f0f0] antialiased selection:bg-indigo-500/30 selection:text-white overflow-x-hidden">

    <!-- Noise Texture -->
    <div class="bg-noise"></div>
    
    <!-- Ambient Lighting Glow -->
    <div class="ambient-glow"></div>

    <!-- Background Grid -->
    <div class="bg-mesh"></div>

    <!-- Header / Navigation -->
    <header class="fixed top-0 left-0 w-full z-[100] px-8 md:px-24 py-8 flex justify-between items-center bg-gradient-to-b from-[#050505] to-transparent pointer-events-none">
        <a href="{{ route('portfolio.index') }}" class="font-heading text-xl font-bold tracking-widest text-white pointer-events-auto flex items-center group">
            <svg class="w-5 h-5 mr-4 transform group-hover:-translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Home
        </a>
    </header>

    <main class="relative z-10 pt-32 pb-24 px-4 md:px-12 lg:px-24 max-w-7xl mx-auto">
        
        <!-- Project Header -->
        <div class="mb-16 md:mb-24">
            <div class="overflow-hidden mb-4">
                <p class="reveal-text text-xs md:text-sm tracking-[0.4em] uppercase text-indigo-500/60 mb-4">Case Study</p>
            </div>
            <h1 class="font-heading text-4xl md:text-7xl font-light text-white leading-tight tracking-tighter reveal-text">
                {{ $project->title }}
            </h1>
        </div>

        <!-- Hero Image -->
        <div class="project-hero-container aspect-[21/9] w-full overflow-hidden mb-16 md:mb-24 relative group border border-white/5 rounded-lg shadow-2xl">
            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover reveal-scale">
            <div class="absolute inset-0 bg-gradient-to-t from-[#050505]/60 to-transparent"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            <!-- Left Column: Details -->
            <div class="lg:col-span-8 space-y-12">
                <div class="space-y-6">
                    <h2 class="text-xs tracking-[0.3em] uppercase text-white/30">Project Description</h2>
                    <div class="text-xl md:text-2xl font-light leading-relaxed text-white/80">
                        {{ $project->description }}
                    </div>
                </div>

                <!-- Placeholder for more content if needed -->
                <div class="p-8 md:p-12 border border-white/5 bg-white/[0.02] rounded-xl backdrop-blur-sm">
                    <p class="text-white/60 leading-relaxed italic">
                        This project represents a synthesis of technical engineering and aesthetic design. By leveraging modern frameworks and secure architecture, we achieved a resilient digital environment that prioritizes both performance and user experience.
                    </p>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-4 space-y-12 lg:sticky lg:top-32">
                <div class="space-y-6 border-l border-indigo-500/20 pl-8">
                    <div>
                        <h3 class="text-[10px] tracking-[0.3em] uppercase text-white/30 mb-2">Category</h3>
                        <p class="text-white font-light text-lg">Digital Exhibit</p>
                    </div>
                    
                    @if($project->url && $project->url !== '#')
                    <div>
                        <h3 class="text-[10px] tracking-[0.3em] uppercase text-white/30 mb-2">Live Access</h3>
                        <a href="{{ $project->url }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 transition-colors font-light text-lg flex items-center">
                            Launch Project
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Decorative Element -->
                <div class="relative h-48 w-full border border-white/5 rounded-lg overflow-hidden flex items-center justify-center group bg-black/40">
                    <div class="absolute inset-0 bg-mesh opacity-20 group-hover:opacity-40 transition-opacity duration-700"></div>
                    <div class="text-[10px] tracking-[1em] uppercase text-white/20 group-hover:text-white/40 transition-colors duration-700">Detailed Analytics</div>
                </div>
            </div>
        </div>

        <!-- Footer Navigation -->
        <div class="mt-32 pt-16 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8">
            <a href="{{ route('portfolio.index') }}" class="text-xs tracking-[0.3em] uppercase text-white/40 hover:text-white transition-all duration-300">
                Close Project
            </a>
            
            <div class="text-[10px] tracking-[0.2em] uppercase text-white/20">
                {{ $settings['hero_name'] ?? 'Portfolio' }} &copy; {{ date('Y') }}
            </div>
        </div>
    </main>

    <script>
        function projectDetail() {
            return {
                init() {
                    gsap.from('.reveal-text', {
                        y: 100,
                        opacity: 0,
                        duration: 1.2,
                        stagger: 0.2,
                        ease: 'power4.out'
                    });
                    
                    gsap.from('.reveal-scale', {
                        scale: 1.2,
                        duration: 2,
                        ease: 'power2.out'
                    });
                }
            }
        }
    </script>
</body>
</html>
