<section>
    <header class="mb-6">
        <h2 class="text-xl font-black text-on-surface headline-font dark:text-white">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-on-surface-variant font-medium dark:text-surface-container/60">
            {{ __("Perbarui nama profil dan foto akun Anda.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">Nama</label>
                <input id="name" name="name" type="text" 
                       class="w-full px-5 py-3 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-0 text-on-surface font-medium dark:bg-dark-surface-high dark:border-dark-outline dark:text-white" 
                       value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                @if($errors->get('name'))
                    <p class="text-xs text-error font-bold mt-1">{{ $errors->get('name')[0] }}</p>
                @endif
            </div>

            <div>
                <label for="email" class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">Email (Tetap)</label>
                <input id="email" name="email" type="email" 
                       class="w-full px-5 py-3 bg-surface-container/50 rounded-xl border border-outline-variant/20 text-on-surface-variant/60 font-medium cursor-not-allowed dark:bg-dark-surface/50 dark:border-dark-outline dark:text-surface-container/30" 
                       value="{{ $user->email }}" readonly />
                <p class="text-[10px] text-on-surface-variant/40 mt-1 dark:text-surface-container/20">* Email tidak dapat diubah untuk alasan keamanan.</p>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-8 py-3 bg-primary text-on-primary rounded-full font-bold hover:brightness-110 transition-all shadow-md active:scale-95">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-primary font-bold animate-pulse">{{ __('Berhasil disimpan.') }}</p>
            @endif
        </div>
    </form>
</section>


