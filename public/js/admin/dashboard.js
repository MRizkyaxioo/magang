// Image Modal Functions
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').style.display = 'block';
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Filter Functions
function filterByStatus() {
    const selectedStatus = document.getElementById('statusFilter').value;
    const cards = document.querySelectorAll('.pengaduan-card');

    cards.forEach(card => {
        if (selectedStatus === 'all') {
            card.style.display = 'block';
        } else {
            const statusSelect = card.querySelector('select[name="status"]');
            const cardStatus = statusSelect ? statusSelect.value : '';
            card.style.display = cardStatus === selectedStatus ? 'block' : 'none';
        }
    });

    updateEmptyState();
}

function filterByKategori() {
    const selectedKategori = document.getElementById('kategoriFilter').value;
    const cards = document.querySelectorAll('.pengaduan-card');

    cards.forEach(card => {
        if (selectedKategori === 'all') {
            card.style.display = 'block';
        } else {
            const kategoriBadge = card.querySelector('.kategori-badge');
            const cardKategori = kategoriBadge ? kategoriBadge.textContent.trim() : '';
            card.style.display = cardKategori === selectedKategori ? 'block' : 'none';
        }
    });

    updateEmptyState();
}

function updateEmptyState() {
    const visibleCards = Array.from(document.querySelectorAll('.pengaduan-card')).filter(card =>
        card.style.display !== 'none'
    );
    const emptyState = document.querySelector('.empty-state');

    if (visibleCards.length === 0 && !emptyState) {
        const grid = document.querySelector('.pengaduan-grid');
        grid.innerHTML = `
            <div class="empty-state">
                <div class="empty-icon">🔍</div>
                <h3 class="empty-title">Tidak Ada Data</h3>
                <p class="empty-message">Tidak ditemukan pengaduan sesuai dengan filter yang dipilih.</p>
            </div>
        `;
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
