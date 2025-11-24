// FAQ Toggle Function
function toggleFAQ(index) {
    const dropdown = document.querySelectorAll('.faq-dropdown')[index];
    const answer = document.getElementById(`faq-answer-${index}`);

    // Close all other FAQ items
    document.querySelectorAll('.faq-dropdown').forEach((item, i) => {
        if (i !== index) {
            item.classList.remove('active');
            document.getElementById(`faq-answer-${i}`).classList.remove('show');
        }
    });

    // Toggle current FAQ item
    dropdown.classList.toggle('active');
    answer.classList.toggle('show');
}

// Logout Function
function logout() {
    const confirmed = confirm('Apakah Anda yakin ingin keluar dari sistem SIPAMA?');
    if (confirmed) {
        alert('Anda telah berhasil logout dari sistem SIPAMA. Terima kasih telah menggunakan layanan kami.');
        // window.location.href = '/login';
    }
}

// Complaint Form Function
function openComplaintForm(url) {
    const button = document.querySelector('.complaint-button');
    const originalText = button.innerHTML;

    button.innerHTML = '<span class="loading"></span>Memuat Form...';
    button.disabled = true;

    setTimeout(() => {
        window.location.href = url;
    }, 1500);

    setTimeout(() => {
        button.innerHTML = originalText;
        button.disabled = false;
    }, 3000);
}

// Add smooth animations on page load
window.addEventListener('load', function() {
    const elements = document.querySelectorAll('.simara-section, .complaint-section, .faq-section');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';

        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, index * 200);
    });
});

// Add hover effects to cards
document.querySelectorAll('.simara-section, .complaint-section, .faq-section').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
        this.style.boxShadow = '0 20px 40px rgba(255, 193, 7, 0.3)';
    });

    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = '0 15px 35px rgba(255, 193, 7, 0.2)';
    });
});

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
