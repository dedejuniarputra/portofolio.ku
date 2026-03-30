<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:#0a0a0a;min-height:100vh;display:flex;align-items:center;justify-content:center;font-family:Inter,sans-serif">

<div class="w-full max-w-sm mx-auto px-6 animate-fade-in-up">
    <!-- Logo/Name -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center bg-surface-2 border border-white/5 overflow-hidden shadow-2xl">
            <img src="/logo.png" alt="Logo" class="w-full h-full object-cover">
        </div>
        <h1 class="text-xl font-bold text-white mb-1">Admin Login</h1>
        <p class="text-sm" style="color:#737373">Sign in to manage your portfolio</p>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="mb-5 p-4 rounded-lg text-sm bg-rose-950/30 text-rose-300 border border-rose-900/50">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="form-label text-center block mb-4 text-gray-400 font-bold uppercase tracking-[0.3em] text-[10px] opacity-60">Enter Administrator PIN</label>
            <div class="flex justify-center">
                <input
                    type="password"
                    name="pin"
                    id="pin-input"
                    class="form-input text-center text-3xl tracking-[1em] font-black w-56 border-white/10 bg-white/5 focus:border-primary-dark focus:shadow-[0_0_20px_rgba(13,226,130,0.4)] transition-all duration-300 rounded-2xl outline-none"
                    placeholder="PIN"
                    maxlength="4"
                    autofocus
                    required
                >
            </div>
            @error('pin')
                <p class="text-red-500 text-xs mt-2 text-center font-bold">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full py-4 rounded-full bg-surface-2 border border-primary-dark/30 text-primary-dark font-black text-lg tracking-widest uppercase shadow-[0_0_15px_rgba(13,226,130,0.1)] hover:shadow-[0_0_25px_rgba(13,226,130,0.3)] hover:border-primary-dark/60 transition-all duration-300 active:scale-95 flex items-center justify-center relative group overflow-hidden">
            <span class="relative z-10">Unlock Admin</span>
            <!-- Signature Neon Dot -->
            <div class="absolute right-6 w-1.5 h-1.5 bg-primary-dark rounded-full shadow-[0_0_10px_#0de282] group-hover:scale-125 transition-transform duration-300"></div>
        </button>
    </form>

    <script>
        // Auto-focus enforcement
        const pinInput = document.getElementById('pin-input');
    </script>

    <div class="mt-8 text-center">
        <a href="{{ route('home') }}" class="text-[11px] font-bold uppercase tracking-[0.2em] text-primary-dark/50 hover:text-primary-dark transition-all duration-300 flex items-center justify-center gap-2">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Portfolio
        </a>
    </div>
</div>
</body>
</html>
