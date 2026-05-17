<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name') <small style="color:var(--danger); display:block; margin-top:5px;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @error('email') <small style="color:var(--danger); display:block; margin-top:5px;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            @error('password') <small style="color:var(--danger); display:block; margin-top:5px;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation') <small style="color:var(--danger); display:block; margin-top:5px;">{{ $message }}</small> @enderror
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 30px;">
            <a href="{{ route('login') }}" style="font-size: 0.85rem;">
                Sudah punya akun?
            </a>

            <button type="submit" class="btn">Mendaftar</button>
        </div>
    </form>
</x-guest-layout>
