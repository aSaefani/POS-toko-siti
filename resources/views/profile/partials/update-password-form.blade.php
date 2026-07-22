<section>
    <header class="mb-6">
        <h2 class="text-xl font-black text-on-surface headline-font dark:text-white">
            {{ __('Perbarui Kata Sandi') }}
        </h2>

        <p class="mt-1 text-sm text-on-surface-variant font-medium dark:text-surface-container/60">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-full">
                <label for="update_password_current_password" class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">Kata Sandi Saat Ini</label>
                <input id="update_password_current_password" name="current_password" type="password" 
                       class="w-full px-5 py-3 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-0 text-on-surface dark:bg-dark-surface-high dark:border-dark-outline dark:text-white" 
                       autocomplete="current-password" />
                @if($errors->updatePassword->get('current_password'))
                    <p class="text-xs text-error font-bold mt-1">{{ $errors->updatePassword->get('current_password')[0] }}</p>
                @endif
            </div>

            <div>
                <label for="update_password_password" class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">Kata Sandi Baru</label>
                <input id="update_password_password" name="password" type="password" 
                       class="w-full px-5 py-3 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-0 text-on-surface dark:bg-dark-surface-high dark:border-dark-outline dark:text-white" 
                       autocomplete="new-password" />
                @if($errors->updatePassword->get('password'))
                    <p class="text-xs text-error font-bold mt-1">{{ $errors->updatePassword->get('password')[0] }}</p>
                @endif
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">Konfirmasi Kata Sandi Baru</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                       class="w-full px-5 py-3 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-0 text-on-surface dark:bg-dark-surface-high dark:border-dark-outline dark:text-white" 
                       autocomplete="new-password" />
                @if($errors->updatePassword->get('password_confirmation'))
                    <p class="text-xs text-error font-bold mt-1">{{ $errors->updatePassword->get('password_confirmation')[0] }}</p>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-8 py-3 bg-secondary text-on-primary rounded-full font-bold hover:brightness-110 transition-all shadow-md active:scale-95">
                {{ __('Ubah Kata Sandi') }}
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-secondary font-bold animate-pulse">{{ __('Berhasil diperbarui.') }}</p>
            @endif
        </div>
    </form>
</section>
