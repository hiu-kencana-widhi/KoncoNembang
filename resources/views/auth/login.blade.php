<x-guest-layout>
    @if(session('status'))
        <div class="alert" style="margin-bottom: 20px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email') <small style="color:var(--danger); display:block; margin-top:5px;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            @error('password') <small style="color:var(--danger); display:block; margin-top:5px;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
            <input id="remember_me" type="checkbox" name="remember" style="accent-color: var(--accent); width: 16px; height: 16px; cursor: pointer;">
            <label for="remember_me" style="margin-bottom: 0; cursor: pointer;">Ingat Saya</label>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 30px;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size: 0.85rem;">
                    Lupa password?
                </a>
            @endif

            <button type="submit" class="btn">Masuk</button>
        </div>
        
        <div style="margin-top: 25px; text-align: center; font-size: 0.85rem; color: var(--text-muted); border-top: 1px solid var(--border-color); padding-top: 20px;">
            Belum punya akun? <a href="{{ route('register') }}" style="font-weight: 600;">Daftar di sini</a>
        </div>
    </form>
</x-guest-layout>
