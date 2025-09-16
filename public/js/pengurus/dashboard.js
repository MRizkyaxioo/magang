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