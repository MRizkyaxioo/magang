// Image Modal Functions
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').style.display = 'block';
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// FIXED: Combined Filter Function
function applyFilters() {
    const selectedStatus = document.getElementById('statusFilter').value;
    const selectedKategori = document.getElementById('kategoriFilter').value;
    const cards = document.querySelectorAll('.pengaduan-card');

    cards.forEach(card => {
        let showCard = true;

        // Check Status Filter
        if (selectedStatus !== 'all') {
            const statusSelect = card.querySelector('select[name="status"]');
            const cardStatus = statusSelect ? statusSelect.value : '';
            if (cardStatus !== selectedStatus) {
                showCard = false;
            }
        }

        // Check Kategori Filter
        if (selectedKategori !== 'all' && showCard) {
            const kategoriBadge = card.querySelector('.kategori-badge');
            const cardKategori = kategoriBadge ? kategoriBadge.textContent.trim() : '';
            if (cardKategori !== selectedKategori) {
                showCard = false;
            }
        }

        // Show/Hide card based on both filters
        card.style.display = showCard ? 'block' : 'none';
    });

    updateEmptyState();
}

// Updated Filter Functions to use combined filter
function filterByStatus() {
    applyFilters();
}

function filterByKategori() {
    applyFilters();
}

function updateEmptyState() {
    const visibleCards = Array.from(document.querySelectorAll('.pengaduan-card')).filter(card =>
        card.style.display !== 'none'
    );
    const emptyState = document.querySelector('.empty-state');
    const grid = document.querySelector('.pengaduan-grid');

    // Remove existing empty state if it exists
    if (emptyState) {
        emptyState.remove();
    }

    if (visibleCards.length === 0) {
        const emptyStateHTML = `
            <div class="empty-state">
                <div class="empty-icon">🔍</div>
                <h3 class="empty-title">Tidak Ada Data</h3>
                <p class="empty-message">Tidak ditemukan pengaduan sesuai dengan filter yang dipilih.</p>
            </div>
        `;
        grid.insertAdjacentHTML('beforeend', emptyStateHTML);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Konfirmasi hapus dengan SweetAlert
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Auto-refresh stats setiap 30 detik
    setInterval(() => {
        // Update stats numbers dengan animasi
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            stat.style.transform = 'scale(1.1)';
            setTimeout(() => {
                stat.style.transform = 'scale(1)';
            }, 200);
        });
    }, 30000);

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
});