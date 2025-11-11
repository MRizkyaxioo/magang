// Image Modal Functions
function openModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImg.src = imageSrc;
}

function closeModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Add smooth animations on page load
window.addEventListener('load', function() {
    const table = document.querySelector('.table-section');
    table.style.opacity = '0';
    table.style.transform = 'translateY(30px)';
    table.style.transition = 'all 0.8s ease';

    setTimeout(() => {
        table.style.opacity = '1';
        table.style.transform = 'translateY(0)';
    }, 300);

    // Animate table rows
    const rows = document.querySelectorAll('.data-table tbody tr');
    rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';
        row.style.transition = 'all 0.6s ease';

        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, 500 + (index * 100));
    });
});

// Add hover effects to table section
document.addEventListener('DOMContentLoaded', function() {
    const tableSection = document.querySelector('.table-section');

    if (tableSection) {
        tableSection.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 20px 40px rgba(255, 193, 7, 0.3)';
        });

        tableSection.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 15px 35px rgba(255, 193, 7, 0.2)';
        });
    }
});

// Buka modal ubah password
function openPasswordModal() {
    const modal = document.getElementById('passwordModal');
    if (modal) modal.style.display = 'block';
}

// Tutup modal ubah password
function closePasswordModal() {
    const modal = document.getElementById('passwordModal');
    if (modal) modal.style.display = 'none';
}

// Tutup modal jika klik di luar area modal
window.addEventListener('click', function (event) {
    const modal = document.getElementById('passwordModal');
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

// Tampilkan notifikasi sukses/gagal dengan SweetAlert2
function showPasswordAlert(message, type = 'success') {
    Swal.fire({
        icon: type,
        title: type === 'success' ? 'Berhasil!' : 'Gagal!',
        text: message,
        toast: true,
        timer: 2500,
        position: 'top-end',
        showConfirmButton: false
    });
}

function togglePassword(id, icon) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈"; // Ganti ikon kalau password sedang ditampilkan
    } else {
        input.type = "password";
        icon.textContent = "👁️"; // Balik lagi
    }
}


// Dropdown Profil
document.addEventListener("DOMContentLoaded", () => {
    const profileIcon = document.getElementById("profileIcon");
    const dropdown = document.getElementById("profileDropdown");

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
});
