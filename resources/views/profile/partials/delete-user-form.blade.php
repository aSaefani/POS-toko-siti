<section class="space-y-6">
    <header>
        <h2 class="text-xl font-black text-error headline-font">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-on-surface-variant font-medium dark:text-surface-container/60">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.') }}
        </p>
    </header>

    <button type="button" 
            onclick="openDeleteModal()"
            class="px-8 py-3 bg-error/10 text-error rounded-full font-bold hover:bg-error hover:text-on-primary transition-all active:scale-95 border border-error/20">
        {{ __('Hapus Akun Saya') }}
    </button>

    <!-- Delete Confirmation Modal -->
    <div id="confirm-user-deletion" class="fixed inset-0 z-[200] flex items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 invisible transition-all duration-200 p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl transform scale-95 transition-all overflow-hidden dark:bg-dark-surface dark:border dark:border-error/20">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
                @csrf
                @method('delete')

                <div class="w-20 h-20 bg-error/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-error text-5xl" style="font-variation-settings: 'FILL' 1;">warning</span>
                </div>

                <h2 class="text-2xl font-black text-on-surface headline-font text-center dark:text-white">
                    {{ __('Apakah Anda yakin?') }}
                </h2>

                <p class="mt-4 text-sm text-on-surface-variant text-center font-medium dark:text-surface-container/60">
                    {{ __('Setelah akun Anda dihapus, semua data akan hilang secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun secara permanen.') }}
                </p>

                <div class="mt-8">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input id="delete-password" name="password" type="password" 
                           class="w-full px-5 py-4 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-error focus:ring-0 text-on-surface text-center dark:bg-dark-surface-high dark:border-dark-outline dark:text-white" 
                           placeholder="{{ __('Masukkan Kata Sandi') }}" />
                    @if($errors->userDeletion->get('password'))
                        <p class="text-xs text-error font-bold mt-2 text-center">{{ $errors->userDeletion->get('password')[0] }}</p>
                    @endif
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 py-4 bg-surface-container-high text-on-surface-variant rounded-xl font-bold hover:bg-surface-container transition-all dark:bg-dark-surface-high dark:text-surface-container/70">
                        {{ __('Batal') }}
                    </button>

                    <button type="submit" class="flex-1 py-4 bg-error text-on-primary rounded-xl font-bold hover:bg-error/90 transition-all shadow-md">
                        {{ __('Hapus Permanen') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const deleteUserModal = document.getElementById('confirm-user-deletion');

    function openDeleteModal() {
        deleteUserModal.classList.remove('opacity-0', 'invisible');
        deleteUserModal.classList.add('opacity-100', 'visible');
        deleteUserModal.querySelector('.transform').classList.remove('scale-95');
        deleteUserModal.querySelector('.transform').classList.add('scale-100');
    }

    function closeDeleteModal() {
        deleteUserModal.classList.add('opacity-0', 'invisible');
        deleteUserModal.classList.remove('opacity-100', 'visible');
        deleteUserModal.querySelector('.transform').classList.add('scale-95');
        deleteUserModal.querySelector('.transform').classList.remove('scale-100');
    }

    // Close on click outside
    deleteUserModal.addEventListener('click', (e) => {
        if (e.target === deleteUserModal) closeDeleteModal();
    });
</script>
