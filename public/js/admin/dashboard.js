// Image Modal Functions
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').style.display = 'block';
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Apply gabungan filter kategori + status ke URL path
function applyFilters() {
    const status = document.getElementById('statusFilter').value;
    const kategori = document.getElementById('kategoriFilter').value;
    const pengurus = document.getElementById('pengurusFilter').value;

    let params = new URLSearchParams();

     if (status && status !== 'all') params.set('status', status);
    if (kategori && kategori !== 'all') params.set('kategori', kategori);
    if (pengurus && pengurus !== 'all') params.set('pengurus', pengurus);

    window.location.href = "/dashboard-admin" + (params.toString() ? "?" + params.toString() : "");
}

// Reset ke default (semua → pending)
function resetFilters() {
    window.location.href = "/dashboard-admin";
}

// Set filter dropdown sesuai URL path saat halaman load
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);

    const status = urlParams.get('status');
    const kategori = urlParams.get('kategori');
    const pengurus = urlParams.get('pengurus');

    if (status) document.getElementById('statusFilter').value = status;
    if (kategori) document.getElementById('kategoriFilter').value = kategori;
    if (pengurus) document.getElementById('pengurusFilter').value = pengurus;
});


// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Set filter values dari URL saat halaman load
    const urlParams = new URLSearchParams(window.location.search);

    // Set status filter berdasarkan URL
    const status = urlParams.get('status');
    const statusFilter = document.getElementById('statusFilter');
    if (status && statusFilter) {
        statusFilter.value = status;
    }

    // Set kategori filter berdasarkan URL
    const kategori = urlParams.get('kategori');
    const kategoriFilter = document.getElementById('kategoriFilter');
    if (kategori && kategoriFilter) {
        kategoriFilter.value = kategori;
    }

    // Konfirmasi hapus dengan SweetAlert
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data pengaduan akan dihapus permanen dan tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FF4757',
                cancelButtonColor: '#B8860B',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Animasi untuk stat cards saat hover
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Auto-refresh animasi stats setiap 30 detik (opsional)
    setInterval(() => {
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            stat.style.transition = 'transform 0.3s ease';
            stat.style.transform = 'scale(1.1)';
            setTimeout(() => {
                stat.style.transform = 'scale(1)';
            }, 300);
        });
    }, 30000);

    // Smooth scroll untuk navigasi internal
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Animasi fade-in untuk cards saat pertama load
    const cards = document.querySelectorAll('.pengaduan-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Tambahkan loading indicator saat form disubmit
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        // Skip delete forms (sudah punya handler sendiri)
        if (!form.classList.contains('delete-form')) {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.classList.contains('loading')) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.classList.add('loading');
                    submitBtn.innerHTML = '<span class="loading"></span> Memproses...';
                    submitBtn.disabled = true;
                }
            });
        }
    });

    // Keyboard shortcut untuk filter
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + R untuk reset filter
        if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
            e.preventDefault();
            if (typeof resetFilters === 'function') {
                resetFilters();
            }
        }
    });
});

// Fungsi helper untuk menampilkan notifikasi
function showNotification(message, type = 'success') {
    Swal.fire({
        icon: type,
        title: type === 'success' ? 'Berhasil!' : 'Perhatian!',
        text: message,
        showConfirmButton: false,
        timer: 2000,
        toast: true,
        position: 'top-end'
    });
}

// Close modal dengan ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
