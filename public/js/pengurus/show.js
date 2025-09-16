// Back Button Function
function goBack() {
    const confirmed = confirm('Apakah Anda yakin ingin kembali ke halaman utama?');
    if (confirmed) {
        // window.location.href = '/dashboard';
        alert('Mengarahkan ke halaman dashboard...');
        // Simulate navigation with loading
        const button = document.querySelector('.back-button');
        const originalText = button.innerHTML;
        button.innerHTML = '<span class="loading"></span>Loading...';

        setTimeout(() => {
            button.innerHTML = originalText;
            alert('Redirecting to dashboard page...');
        }, 1500);
    }
    return false; // Prevent default link behavior
}

// Image Modal Functions
function openModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImg.src = imageSrc;

    // Add click event to close modal when clicking outside image
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
}

function closeModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Add smooth animations on page load
window.addEventListener('load', function() {
    const cards = document.querySelectorAll('.info-card');

    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.8s ease';

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 200);
    });

    // Animate title
    const title = document.querySelector('.main-title');
    title.style.opacity = '0';
    title.style.transform = 'translateX(-30px)';
    title.style.transition = 'all 0.6s ease';

    setTimeout(() => {
        title.style.opacity = '1';
        title.style.transform = 'translateX(0)';
    }, 100);

    // Animate back button
    const backBtn = document.querySelector('.back-button');
    backBtn.style.opacity = '0';
    backBtn.style.transform = 'translateY(20px)';
    backBtn.style.transition = 'all 0.6s ease';

    setTimeout(() => {
        backBtn.style.opacity = '1';
        backBtn.style.transform = 'translateY(0)';
    }, 800);
});

// Add subtle parallax effect on scroll
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const cards = document.querySelectorAll('.info-card');

    cards.forEach((card, index) => {
        const speed = 0.02 + (index * 0.01);
        card.style.transform = `translateY(${scrolled * speed}px)`;
    });
});

// Enhanced hover effects
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.info-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
            this.style.boxShadow = '0 20px 50px rgba(255, 193, 7, 0.3)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 10px 30px rgba(255, 193, 7, 0.15)';
        });
    });
});