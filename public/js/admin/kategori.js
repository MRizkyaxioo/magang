// kategori.js (versi fix final)
document.addEventListener('DOMContentLoaded', function() {
    // Pastikan Bootstrap loaded
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap JS not loaded!');
        return;
    }

    console.log('Bootstrap loaded successfully');

    // Inisialisasi semua modal
    const modalList = document.querySelectorAll('.modal');
    modalList.forEach(modalEl => {
        try {
            new bootstrap.Modal(modalEl);
        } catch (err) {
            console.warn('Could not init modal', modalEl, err);
        }
    });

    // Auto-hide alert sukses setelah 5 detik
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            try {
                successAlert.style.animation = 'slideInDown 0.5s ease reverse';
                setTimeout(() => successAlert.remove(), 500);
            } catch (e) {
                successAlert.remove();
            }
        }, 5000);
    }

    // Tombol simpan animasi
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.classList.contains('delete-btn')) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span>⏳</span> Menyimpan...';
                submitBtn.disabled = true;

                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }
        });
    });

    // Fokus otomatis pada input di modal
    modalList.forEach(modalEl => {
        modalEl.addEventListener('shown.bs.modal', function() {
            const input = this.querySelector('input[type="text"]');
            if (input) setTimeout(() => input.focus(), 100);
        });
    });

    // Bersihkan backdrop saat halaman dimuat
    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
    document.body.classList.remove('modal-open');
    document.body.style.paddingRight = '';

    // Event log modal
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

    // ✅ Real-time input validation untuk nama kategori (maks 15 karakter)
    document.querySelectorAll('input[name="kategori"]').forEach(input => {
        input.addEventListener('input', function() {
            const value = this.value.trim();
            const form = this.closest('form');
            const submitBtn = form.querySelector('button[type="submit"]');
            const warningText = form.querySelector('small[id^="kategori-warning"]');

            if (value.length > 15) {
                this.style.borderColor = '#FF6B6B';
                warningText.textContent = 'Nama kategori maksimal 15 karakter.';
                warningText.style.display = 'block';
                submitBtn.disabled = true;
            } else if (value.length < 3) {
                this.style.borderColor = '#FF8C00';
                warningText.textContent = 'Nama kategori minimal 3 karakter.';
                warningText.style.display = 'block';
                submitBtn.disabled = true;
            } else {
                this.style.borderColor = '#32CD32';
                warningText.style.display = 'none';
                submitBtn.disabled = false;
            }
        });
    });

    // SweetAlert konfirmasi hapus
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

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
                    form.removeEventListener('submit', arguments.callee);
                    form.submit();
                }
            });
        });
    });
});
