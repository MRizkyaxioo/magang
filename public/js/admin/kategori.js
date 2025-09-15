// Enhanced delete confirmation
function confirmDelete(kategoriName) {
    return confirm(`⚠️ Apakah Anda yakin ingin menghapus kategori "${kategoriName}"?\n\nTindakan ini tidak dapat dibatalkan dan akan mempengaruhi pengaduan yang menggunakan kategori ini.`);
}

// Export data function
function exportData() {
    const totalKategori = document.querySelectorAll('.kategori-card').length;
    if (totalKategori === 0) {
        alert('📂 Tidak ada data kategori untuk diekspor!');
        return;
    }

    alert('🚧 Fitur export data sedang dalam pengembangan.\n\n📊 Data yang akan diekspor:\n• Total ' + totalKategori + ' kategori\n• Format: Excel/CSV\n\nFitur ini akan segera tersedia!');
}

// Refresh data function
function refreshData() {
    const btn = event.target.closest('.quick-action-btn');
    const originalText = btn.innerHTML;

    btn.innerHTML = '<span>⟳</span> Memuat...';
    btn.style.pointerEvents = 'none';

    setTimeout(() => {
        location.reload();
    }, 1000);
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Pastikan Bootstrap loaded
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap JS not loaded!');
        return;
    }

    console.log('Bootstrap loaded successfully');

    // Initialize all modals
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        new bootstrap.Modal(modal);
    });

    // Auto-hide success alert after 5 seconds
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.animation = 'slideInDown 0.5s ease reverse';
            setTimeout(() => {
                successAlert.remove();
            }, 500);
        }, 5000);
    }

    // Enhanced form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
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

    // Auto-focus on modal inputs
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', function() {
            const input = this.querySelector('input[type="text"]');
            if (input) {
                setTimeout(() => input.focus(), 100);
            }
        });
    });

    // Remove any existing modal backdrops on page load
    const existingBackdrops = document.querySelectorAll('.modal-backdrop');
    existingBackdrops.forEach(backdrop => backdrop.remove());

    // Reset body classes
    document.body.classList.remove('modal-open');
    document.body.style.paddingRight = '';

    // Handle modal events properly
    modals.forEach(modal => {
        modal.addEventListener('show.bs.modal', function() {
            console.log('Modal showing:', this.id);
        });

        modal.addEventListener('shown.bs.modal', function() {
            console.log('Modal shown:', this.id);
            // Ensure modal is visible
            this.style.display = 'block';
            this.style.zIndex = '1056';
        });

        modal.addEventListener('hidden.bs.modal', function() {
            console.log('Modal hidden:', this.id);
            // Clean up any remaining backdrops
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
        });
    });

    // Real-time input validation
    document.querySelectorAll('input[name="kategori"]').forEach(input => {
        input.addEventListener('input', function() {
            const value = this.value.trim();
            const submitBtn = this.closest('form').querySelector('button[type="submit"]');

            if (value.length < 3) {
                this.style.borderColor = '#FF6B6B';
                submitBtn.disabled = true;
            } else if (value.length > 50) {
                this.style.borderColor = '#FF8C00';
                this.setCustomValidity('Nama kategori maksimal 50 karakter');
            } else {
                this.style.borderColor = '#32CD32';
                this.setCustomValidity('');
                submitBtn.disabled = false;
            }
        });
    });
});
