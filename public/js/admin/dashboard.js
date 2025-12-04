// ====================== PASSWORD MODAL ADMIN ======================

// Buka modal ubah password
function openPasswordModal() {
    const modal = document.getElementById('passwordModal');
    if (modal) {
        modal.style.display = 'block';
        // Clear previous input values on open (optional)
        // document.getElementById('current_password').value = '';
        // document.getElementById('new_password').value = '';
        // document.getElementById('new_password_confirmation').value = '';
    }
}

// Tutup modal ubah password
function closePasswordModal() {
    const modal = document.getElementById('passwordModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Tutup modal jika klik di luar area modal
window.addEventListener('click', function (event) {
    const modal = document.getElementById('passwordModal');
    const modalContent = document.querySelector('.modal-content');

    if (event.target === modal) {
        closePasswordModal();
    }
});

// Tutup modal dengan tombol Escape
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        closePasswordModal();
    }
});

// Toggle show/hide password
function togglePassword(id, icon) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈";
    } else {
        input.type = "password";
        icon.textContent = "👁️";
    }
}

// ====================== PROFILE DROPDOWN ======================

document.addEventListener("DOMContentLoaded", () => {
    const profileIcon = document.getElementById("profileIcon");
    const dropdown = document.getElementById("profileDropdown");

    if (profileIcon && dropdown) {
        profileIcon.addEventListener("click", (e) => {
            e.stopPropagation();
            dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
        });

        // Tutup dropdown kalau klik di luar
        document.addEventListener("click", (e) => {
            if (!profileIcon.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = "none";
            }
        });
    }
});

// ====================== IMAGE MODAL ======================

function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').style.display = 'block';
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Close image modal dengan ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// ====================== FILTERS ======================

function applyFilters() {
    const status = document.getElementById('statusFilter').value;
    const kategori = document.getElementById('kategoriFilter').value;
    const pengurus = document.getElementById('pengurusFilter').value;
    const bulan    = document.getElementById('bulanFilter').value;

    let params = new URLSearchParams();

    if (status && status !== 'all') params.set('status', status);
    if (kategori && kategori !== 'all') params.set('kategori', kategori);
    if (pengurus && pengurus !== 'all') params.set('pengurus', pengurus);
    if (bulan) params.set('bulan', bulan);

    window.location.href = "/dashboard-admin" + (params.toString() ? "?" + params.toString() : "");
}

function resetFilters() {
    window.location.href = "/dashboard-admin";
}

// Set filter dropdown sesuai URL saat halaman load
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);

    const status = urlParams.get('status');
    const kategori = urlParams.get('kategori');
    const pengurus = urlParams.get('pengurus');
    const bulan = urlParams.get('bulan');


    if (status) document.getElementById('statusFilter').value = status;
    if (kategori) document.getElementById('kategoriFilter').value = kategori;
    if (pengurus) document.getElementById('pengurusFilter').value = pengurus;
    if (bulan) document.getElementById('bulanFilter').value = bulan;


    // ====================== DELETE CONFIRMATION ======================

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

    // ====================== ANIMATIONS ======================

    // Animasi stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Animasi fade-in untuk cards
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

    // Smooth scroll
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

    // Keyboard shortcut Ctrl+R untuk reset filter
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
            e.preventDefault();
            if (typeof resetFilters === 'function') {
                resetFilters();
            }
        }
    });
});


function cetakPDF() {
    const bulan = document.getElementById('bulanFilter').value;

    if (!bulan) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops!',
            text: 'Silakan pilih bulan terlebih dahulu!',
        });
        return;
    }

    window.open(`/admin/statistik-pdf?bulan=${bulan}`, '_blank');
}

