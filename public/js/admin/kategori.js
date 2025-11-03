// kategori.js (ganti isi file dengan ini)

document.addEventListener('DOMContentLoaded', function() {
    // Pastikan Bootstrap loaded
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap JS not loaded!');
        return;
    }
    console.log('Bootstrap loaded successfully');

    // Semua modal
    const modalList = document.querySelectorAll('.modal');
    modalList.forEach(modalEl => {
        // create bootstrap modal instances only if needed
        try {
            new bootstrap.Modal(modalEl);
        } catch (err) {
            console.warn('Could not init modal', modalEl, err);
        }
    });

    // Auto-hide success alert after 5 seconds
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            // safe removal animation fallback
            try {
                successAlert.style.animation = 'slideInDown 0.5s ease reverse';
                setTimeout(() => successAlert.remove(), 500);
            } catch (e) {
                successAlert.remove();
            }
        }, 5000);
    }

    // Enhanced form validation (tombol simpan)
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // jika tombol submit ada dan bukan delete button
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.classList.contains('delete-btn')) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span>⏳</span> Menyimpan...';
                submitBtn.disabled = true;

                // Re-enable button after 3 seconds as fallback
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }
        });
    });

    // Auto-focus input on modal show
    modalList.forEach(modalEl => {
        modalEl.addEventListener('shown.bs.modal', function() {
            const input = this.querySelector('input[type="text"]');
            if (input) setTimeout(() => input.focus(), 100);
        });
    });

    // Remove any existing modal backdrops on page load
    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
    document.body.classList.remove('modal-open');
    document.body.style.paddingRight = '';

    // Modal event logs + cleanup
    modalList.forEach(modalEl => {
        modalEl.addEventListener('show.bs.modal', function() {
            console.log('Modal showing:', this.id);
        });
        modalEl.addEventListener('shown.bs.modal', function() {
            console.log('Modal shown:', this.id);
            this.style.display = 'block';
            this.style.zIndex = '1056';
        });
        modalEl.addEventListener('hidden.bs.modal', function() {
            console.log('Modal hidden:', this.id);
            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
        });
    });

    // Real-time input validation untuk nama kategori
    document.querySelectorAll('input[name="kategori"]').forEach(input => {
        input.addEventListener('input', function() {
            const value = this.value.trim();
            const form = this.closest('form');
            if (!form) return;
            const submitBtn = form.querySelector('button[type="submit"]');

            if (value.length < 3) {
                this.style.borderColor = '#FF6B6B';
                if (submitBtn) submitBtn.disabled = true;
            } else if (value.length > 50) {
                this.style.borderColor = '#FF8C00';
                this.setCustomValidity('Nama kategori maksimal 50 karakter');
                if (submitBtn) submitBtn.disabled = true;
            } else {
                this.style.borderColor = '#32CD32';
                this.setCustomValidity('');
                if (submitBtn) submitBtn.disabled = false;
            }
        });
    });

    // Konfirmasi hapus dengan SweetAlert — inisialisasi di sini agar pasti element ada
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // ambil nama kategori (jika tersedia di card)
            const kategoriEl = form.closest('.kategori-card')?.querySelector('h3');
            const kategoriName = kategoriEl ? kategoriEl.textContent.trim() : 'kategori ini';

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Kategori "${kategoriName}" akan dihapus permanen dan tidak dapat dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FF4757',
                cancelButtonColor: '#B8860B',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // submit form tanpa memicu event lagi
                    form.removeEventListener('submit', arguments.callee);
                    form.submit();
                }
            });
        });
    });
});
