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

// Add smooth animations on page load
window.addEventListener('load', function() {
    // Auto-refresh stats setiap 30 detik
    setInterval(() => {
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            stat.style.transform = 'scale(1.1)';
            setTimeout(() => {
                stat.style.transform = 'scale(1)';
            }, 200);
        });
    }, 30000);

    // Add hover effects to cards
    document.querySelectorAll('.simara-section, .faq-section, .pending-section, .stats-section-wrapper').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 20px 40px rgba(255, 193, 7, 0.3)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 15px 35px rgba(255, 193, 7, 0.2)';
        });
    });
});

// Smooth scroll untuk navigasi
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
