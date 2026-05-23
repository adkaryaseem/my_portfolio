<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication - {{ config('app.name') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Outfit:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    
    <!-- Tailwind Browser Script -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#050505] text-[#f0f0f0] min-h-screen flex items-center justify-center p-6 selection:bg-indigo-500/30">

    <!-- Noise Texture -->
    <div class="bg-noise"></div>
    
    <!-- Ambient Lighting Glow -->
    <div class="ambient-glow"></div>

    <!-- Background Grid -->
    <div class="bg-mesh"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="glass-panel p-8 md:p-12 rounded-2xl border border-white/5 shadow-2xl backdrop-blur-xl">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-500/10 border border-indigo-500/20 mb-6">
                    <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-heading font-light text-white mb-2 uppercase tracking-tighter">Identity Verification</h1>
                <p class="text-white/40 text-sm tracking-widest uppercase">Security Protocol Initialized</p>
            </div>

            <p class="text-center text-white/60 mb-8 text-sm leading-relaxed">
                A 6-digit authentication code has been dispatched to your secure channel. Please enter it below to proceed.
            </p>

            <form action="{{ route('login.2fa') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <input type="text" name="code" required autofocus placeholder="000000" maxlength="6"
                           class="w-full bg-black/40 border border-white/10 rounded-lg py-4 text-center text-3xl tracking-[0.5em] text-white focus:outline-none focus:border-indigo-500/50 transition-colors font-mono">
                    @error('code')
                        <p class="mt-2 text-red-400 text-[10px] tracking-widest uppercase text-center">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-light py-4 rounded-lg transition-all duration-300 uppercase tracking-[0.3em] text-xs shadow-[0_0_20px_rgba(99,102,241,0.2)]">
                    Authorize Access
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('login') }}" class="text-[10px] tracking-widest uppercase text-white/30 hover:text-white transition-colors">
                    Back to Standard Login
                </a>
            </div>
        </div>

        <div class="mt-12 text-center text-[10px] tracking-[0.4em] uppercase text-white/10">
            System Managed by {{ config('app.name') }} Secure Core
        </div>
    </div>
</body>
</html>
