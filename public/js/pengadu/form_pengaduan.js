// Animasi masuk elemen
window.addEventListener('load', function() {
  const elements = document.querySelectorAll('.header, .form-container');
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

// Feedback tombol submit
document.querySelector('form').addEventListener('submit', function() {
  const button = document.querySelector('.btn-lapor');
  button.innerHTML = '⏳ Mengirim...';
  button.disabled = true;
});

/* ============================================
   JAVASCRIPT UNTUK FORM PENGADUAN & LEAFLET MAPS
   Letakkan di: public/js/pengadu/form_pengaduan.js
   100% GRATIS - TIDAK PERLU API KEY!
   ============================================ */

// Variabel global untuk Maps
let map;
let marker;

// ========================================
// INISIALISASI LEAFLET MAP
// ========================================
function initMap() {
  // Lokasi default: Banjarmasin, Kalimantan Selatan
  const banjarmasin = [-3.3194374, 114.5897825];
  
  // Buat peta dengan OpenStreetMap (GRATIS!)
  map = L.map('map').setView(banjarmasin, 13);

  // Tambahkan tile layer dari OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 19,
    minZoom: 10
  }).addTo(map);

  // Event listener untuk klik pada peta
  map.on('click', function(e) {
    const { lat, lng } = e.latlng;
    placeMarker(lat, lng);
    getAddress(lat, lng);
  });

  // Coba dapatkan lokasi pengguna saat halaman dimuat
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function(position) {
        const userLat = position.coords.latitude;
        const userLng = position.coords.longitude;
        map.setView([userLat, userLng], 15);
        console.log('Lokasi pengguna berhasil didapatkan');
      },
      function(error) {
        console.log('Geolocation tidak diizinkan atau tidak tersedia:', error.message);
      }
    );
  }
}

// ========================================
// MENEMPATKAN MARKER DI PETA
// ========================================
function placeMarker(lat, lng) {
  // Hapus marker lama jika ada
  if (marker) {
    map.removeLayer(marker);
  }

  // Custom icon untuk marker
  const customIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

  // Buat marker baru
  marker = L.marker([lat, lng], {
    draggable: true,
    icon: customIcon
  }).addTo(map);

  // Tambahkan popup
  marker.bindPopup('<b>Lokasi Kejadian</b><br>Drag marker untuk menyesuaikan posisi').openPopup();

  // Event listener untuk marker yang di-drag
  marker.on('dragend', function(e) {
    const position = e.target.getLatLng();
    getAddress(position.lat, position.lng);
  });

  // Simpan koordinat ke input hidden
  document.getElementById('latitude').value = lat;
  document.getElementById('longitude').value = lng;
  
  // Tampilkan koordinat di UI
  document.getElementById('coordinatesDisplay').textContent = 
    `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
}

// ========================================
// KONVERSI KOORDINAT KE ALAMAT (GEOCODING)
// Menggunakan Nominatim API dari OpenStreetMap (GRATIS!)
// ========================================
function getAddress(lat, lng) {
  // Tampilkan loading indicator
  showLoadingIndicator();

  // URL untuk Nominatim Reverse Geocoding API
  const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`;

  fetch(url, {
    headers: {
      'User-Agent': 'SIPAMA Pengaduan App' // Required by Nominatim
    }
  })
  .then(response => response.json())
  .then(data => {
    hideLoadingIndicator();
    
    if (data.display_name) {
      const address = data.display_name;
      
      // Simpan alamat ke input hidden
      document.getElementById('lokasi_kejadian').value = address;
      
      // Tampilkan alamat di UI
      document.getElementById('addressDisplay').textContent = address;
      document.getElementById('locationInfo').style.display = 'block';
      
      // Update popup marker
      if (marker) {
        marker.bindPopup(`<b>Lokasi Kejadian</b><br>${address}`).openPopup();
      }
      
      console.log('Alamat berhasil ditemukan:', address);
    } else {
      hideLoadingIndicator();
      document.getElementById('lokasi_kejadian').value = `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
      document.getElementById('addressDisplay').textContent = 'Alamat tidak ditemukan, menggunakan koordinat';
      document.getElementById('locationInfo').style.display = 'block';
    }
  })
  .catch(error => {
    hideLoadingIndicator();
    console.error('Error mendapatkan alamat:', error);
    
    // Fallback: gunakan koordinat saja
    const fallbackAddress = `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
    document.getElementById('lokasi_kejadian').value = fallbackAddress;
    document.getElementById('addressDisplay').textContent = 'Alamat tidak dapat dimuat, menggunakan koordinat';
    document.getElementById('locationInfo').style.display = 'block';
  });
}

// ========================================
// LOADING INDICATOR
// ========================================
function showLoadingIndicator() {
  const loading = document.createElement('div');
  loading.id = 'geocodingLoading';
  loading.className = 'geocoding-loading';
  loading.textContent = '🔍 Mencari alamat...';
  document.getElementById('map').parentElement.style.position = 'relative';
  document.getElementById('map').parentElement.appendChild(loading);
}

function hideLoadingIndicator() {
  const loading = document.getElementById('geocodingLoading');
  if (loading) {
    loading.remove();
  }
}

// ========================================
// MENDAPATKAN LOKASI PENGGUNA SAAT INI
// ========================================
function getCurrentLocation() {
  const button = document.getElementById('btnGetLocation');
  
  if (!navigator.geolocation) {
    alert('Browser Anda tidak mendukung Geolocation. Silakan pilih lokasi secara manual di peta.');
    return;
  }

  button.innerHTML = '⏳ Mendapatkan lokasi...';
  button.disabled = true;

  navigator.geolocation.getCurrentPosition(
    function(position) {
      const lat = position.coords.latitude;
      const lng = position.coords.longitude;
      
      // Pusatkan peta ke lokasi pengguna
      map.setView([lat, lng], 16);
      
      // Tempatkan marker dan dapatkan alamat
      placeMarker(lat, lng);
      getAddress(lat, lng);
      
      // Reset tombol
      button.innerHTML = '✅ Lokasi Berhasil Didapat';
      setTimeout(() => {
        button.innerHTML = '📍 Gunakan Lokasi Saya';
        button.disabled = false;
      }, 2000);
      
      console.log('Lokasi pengguna berhasil didapatkan:', { lat, lng });
    },
    function(error) {
      console.error('Error mendapatkan lokasi:', error);
      
      let errorMessage = 'Tidak dapat mendapatkan lokasi Anda. ';
      
      switch(error.code) {
        case error.PERMISSION_DENIED:
          errorMessage += 'Izin lokasi ditolak. Silakan aktifkan izin lokasi di browser Anda.';
          break;
        case error.POSITION_UNAVAILABLE:
          errorMessage += 'Informasi lokasi tidak tersedia.';
          break;
        case error.TIMEOUT:
          errorMessage += 'Waktu permintaan lokasi habis.';
          break;
        default:
          errorMessage += 'Terjadi kesalahan yang tidak diketahui.';
      }
      
      alert(errorMessage);
      
      // Reset tombol
      button.innerHTML = '📍 Gunakan Lokasi Saya';
      button.disabled = false;
    },
    {
      enableHighAccuracy: true,
      timeout: 10000,
      maximumAge: 0
    }
  );
}

// ========================================
// ANIMASI MASUK ELEMEN SAAT LOAD
// ========================================
window.addEventListener('load', function() {
  const elements = document.querySelectorAll('.header, .form-container');
  
  elements.forEach((el, index) => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'all 0.6s ease';

    setTimeout(() => {
      el.style.opacity = '1';
      el.style.transform = 'translateY(0)';
    }, index * 200);
  });

  // Inisialisasi peta setelah semua elemen dimuat
  setTimeout(initMap, 500);
});

// ========================================
// VALIDASI FORM SEBELUM SUBMIT
// ========================================
document.addEventListener('DOMContentLoaded', function() {
  // Event listener untuk tombol lokasi
  const btnGetLocation = document.getElementById('btnGetLocation');
  if (btnGetLocation) {
    btnGetLocation.addEventListener('click', getCurrentLocation);
  }

  // Validasi form
  const form = document.getElementById('pengaduanForm');
  if (form) {
    form.addEventListener('submit', function(e) {
      const latitude = document.getElementById('latitude').value;
      const longitude = document.getElementById('longitude').value;
      const lokasi = document.getElementById('lokasi_kejadian').value;
      
      // Validasi apakah lokasi sudah dipilih
      if (!latitude || !longitude || !lokasi) {
        e.preventDefault();
        alert('⚠️ Mohon pilih lokasi kejadian pada peta terlebih dahulu!\n\nAnda bisa:\n• Klik pada peta untuk memilih lokasi\n• Gunakan tombol "Gunakan Lokasi Saya"');
        
        // Scroll ke bagian peta
        document.getElementById('map').scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
        
        return false;
      }
      
      // Ubah tampilan tombol submit
      const button = document.querySelector('.btn-lapor');
      button.innerHTML = '⏳ Mengirim laporan...';
      button.disabled = true;
      
      console.log('Form valid, mengirim data...');
      console.log('Lokasi:', lokasi);
      console.log('Koordinat:', latitude, longitude);
    });
  }
});

// ========================================
// FUNGSI TAMBAHAN: CARI LOKASI BERDASARKAN NAMA
// ========================================
function searchLocation(query) {
  const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`;
  
  fetch(url, {
    headers: {
      'User-Agent': 'SIPAMA Pengaduan App'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data && data.length > 0) {
      const location = data[0];
      const lat = parseFloat(location.lat);
      const lng = parseFloat(location.lon);
      
      map.setView([lat, lng], 16);
      placeMarker(lat, lng);
      getAddress(lat, lng);
    } else {
      alert('Lokasi tidak ditemukan. Silakan coba dengan kata kunci yang berbeda.');
    }
  })
  .catch(error => {
    console.error('Error searching location:', error);
    alert('Terjadi kesalahan saat mencari lokasi.');
  });
}

// ========================================
// CONSOLE LOG UNTUK DEBUGGING
// ========================================
console.log('Form Pengaduan dengan Leaflet Maps berhasil dimuat');
console.log('Menggunakan OpenStreetMap - 100% GRATIS, tidak perlu API Key!');