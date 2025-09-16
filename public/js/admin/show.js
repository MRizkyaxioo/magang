function openModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Add event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners for filters if they exist
    const statusFilter = document.getElementById('statusFilter');
    const kategoriFilter = document.getElementById('kategoriFilter');
    
    if (statusFilter) {
        statusFilter.addEventListener('change', filterByStatus);
    }
    
    if (kategoriFilter) {
        kategoriFilter.addEventListener('change', filterByKategori);
    }
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Filter functions (placeholder - implement based on your needs)
function filterByStatus() {
    // Implementation for status filtering
    console.log('Filter by status');
}

function filterByKategori() {
    // Implementation for kategori filtering
    console.log('Filter by kategori');
}