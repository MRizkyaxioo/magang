/* ============================================
   JAVASCRIPT UNTUK FORM PENGADUAN & LEAFLET MAPS
   Dengan Fitur Search Lokasi
   ============================================ */

let map;
let marker;
let searchTimeout;

// ========================================
// INISIALISASI LEAFLET MAP
// ========================================
function initMap() {
  const banjarmasin = [-3.3194374, 114.5897825];
  
  map = L.map('map').setView(banjarmasin, 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 19,
    minZoom: 10
  }).addTo(map);

  map.on('click', function(e) {
    const { lat, lng } = e.latlng;
    placeMarker(lat, lng);
    getAddress(lat, lng);
  });

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function(position) {
        const userLat = position.coords.latitude;
        const userLng = position.coords.longitude;
        map.setView([userLat, userLng], 15);
        console.log('Lokasi pengguna berhasil didapatkan');
      },
      function(error) {
        console.log('Geolocation tidak tersedia:', error.message);
      }
    );
  }
}

// ========================================
// MENEMPATKAN MARKER DI PETA
// ========================================
function placeMarker(lat, lng) {
  if (marker) {
    map.removeLayer(marker);
  }

  const customIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

  marker = L.marker([lat, lng], {
    draggable: true,
    icon: customIcon
  }).addTo(map);

  marker.bindPopup('<b>Lokasi Kejadian</b><br>Drag marker untuk menyesuaikan posisi').openPopup();

  marker.on('dragend', function(e) {
    const position = e.target.getLatLng();
    getAddress(position.lat, position.lng);
  });

  document.getElementById('latitude').value = lat;
  document.getElementById('longitude').value = lng;
  
  document.getElementById('coordinatesDisplay').textContent = 
    `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
}

// ========================================
// KONVERSI KOORDINAT KE ALAMAT
// ========================================
function getAddress(lat, lng) {
  showLoadingIndicator();

  const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`;

  fetch(url, {
    headers: {
      'User-Agent': 'SIPAMA Pengaduan App'
    }
  })
  .then(response => response.json())
  .then(data => {
    hideLoadingIndicator();
    
    if (data.display_name) {
      const address = data.display_name;
      
      document.getElementById('lokasi_kejadian').value = address;
      document.getElementById('addressDisplay').textContent = address;
      document.getElementById('locationInfo').style.display = 'block';
      
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
  if (document.getElementById('geocodingLoading')) return;
  
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
// SEARCH LOKASI BERDASARKAN NAMA
// ========================================
function searchLocationByName(query) {
  if (!query || query.trim().length < 3) {
    alert('Mohon masukkan minimal 3 karakter untuk mencari lokasi');
    return;
  }

  const button = document.getElementById('btnSearchLocation');
  button.innerHTML = '⏳ Mencari...';
  button.disabled = true;

  // Tambahkan "Banjarmasin" ke query untuk hasil lebih akurat
  const searchQuery = query.includes('Banjarmasin') ? query : `${query}, Banjarmasin`;
  const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery)}&limit=5&addressdetails=1`;
  
  fetch(url, {
    headers: {
      'User-Agent': 'SIPAMA Pengaduan App'
    }
  })
  .then(response => response.json())
  .then(data => {
    button.innerHTML = '🔍 Cari';
    button.disabled = false;

    if (data && data.length > 0) {
      displaySearchResults(data);
    } else {
      displayNoResults();
    }
  })
  .catch(error => {
    button.innerHTML = '🔍 Cari';
    button.disabled = false;
    console.error('Error searching location:', error);
    alert('Terjadi kesalahan saat mencari lokasi. Silakan coba lagi.');
  });
}

// ========================================
// TAMPILKAN HASIL PENCARIAN
// ========================================
function displaySearchResults(results) {
  const resultsContainer = document.getElementById('searchResults');
  resultsContainer.innerHTML = '';
  
  results.forEach((result, index) => {
    const item = document.createElement('div');
    item.className = 'search-result-item';
    
    const name = document.createElement('div');
    name.className = 'result-name';
    name.textContent = result.name || result.display_name.split(',')[0];
    
    const address = document.createElement('div');
    address.className = 'result-address';
    address.textContent = result.display_name;
    
    item.appendChild(name);
    item.appendChild(address);
    
    // Event klik pada hasil
    item.addEventListener('click', function() {
      selectSearchResult(result);
    });
    
    resultsContainer.appendChild(item);
  });
  
  resultsContainer.classList.add('active');
}

// ========================================
// TAMPILKAN JIKA TIDAK ADA HASIL
// ========================================
function displayNoResults() {
  const resultsContainer = document.getElementById('searchResults');
  resultsContainer.innerHTML = '<div class="search-no-results">Lokasi tidak ditemukan. Coba dengan kata kunci lain.</div>';
  resultsContainer.classList.add('active');
}

// ========================================
// PILIH HASIL PENCARIAN
// ========================================
function selectSearchResult(result) {
  const lat = parseFloat(result.lat);
  const lng = parseFloat(result.lon);
  
  // Pindahkan peta ke lokasi
  map.setView([lat, lng], 16);
  
  // Tempatkan marker
  placeMarker(lat, lng);
  
  // Set alamat
  document.getElementById('lokasi_kejadian').value = result.display_name;
  document.getElementById('addressDisplay').textContent = result.display_name;
  document.getElementById('locationInfo').style.display = 'block';
  
  // Update marker popup
  if (marker) {
    marker.bindPopup(`<b>Lokasi Kejadian</b><br>${result.display_name}`).openPopup();
  }
  
  // Kosongkan search input dan hasil
  document.getElementById('locationSearch').value = '';
  document.getElementById('searchResults').classList.remove('active');
  document.getElementById('searchResults').innerHTML = '';
  
  console.log('Lokasi dipilih:', result.display_name);
}

// ========================================
// MENDAPATKAN LOKASI PENGGUNA
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
      
      map.setView([lat, lng], 16);
      placeMarker(lat, lng);
      getAddress(lat, lng);
      
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

  setTimeout(initMap, 500);
});

// ========================================
// EVENT LISTENERS
// ========================================
document.addEventListener('DOMContentLoaded', function() {
  // Event listener untuk tombol GPS
  const btnGetLocation = document.getElementById('btnGetLocation');
  if (btnGetLocation) {
    btnGetLocation.addEventListener('click', getCurrentLocation);
  }

  // Event listener untuk tombol search
  const btnSearchLocation = document.getElementById('btnSearchLocation');
  if (btnSearchLocation) {
    btnSearchLocation.addEventListener('click', function() {
      const query = document.getElementById('locationSearch').value;
      searchLocationByName(query);
    });
  }

  // Event listener untuk Enter key di search input
  const locationSearch = document.getElementById('locationSearch');
  if (locationSearch) {
    locationSearch.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        const query = this.value;
        searchLocationByName(query);
      }
    });

    // Auto-hide results when clicking outside
    document.addEventListener('click', function(e) {
      const searchResults = document.getElementById('searchResults');
      if (!e.target.closest('.location-search-container')) {
        searchResults.classList.remove('active');
      }
    });
  }

  // Validasi form
  const form = document.getElementById('pengaduanForm');
  if (form) {
    form.addEventListener('submit', function(e) {
      const latitude = document.getElementById('latitude').value;
      const longitude = document.getElementById('longitude').value;
      const lokasi = document.getElementById('lokasi_kejadian').value;
      
      if (!latitude || !longitude || !lokasi) {
        e.preventDefault();
        alert('⚠️ Mohon pilih lokasi kejadian terlebih dahulu!\n\nAnda bisa:\n• Ketik nama lokasi dan klik "Cari"\n• Klik pada peta\n• Gunakan tombol "Gunakan Lokasi Saya"');
        
        document.getElementById('map').scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
        
        return false;
      }
      
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
// CONSOLE LOG
// ========================================
console.log('Form Pengaduan dengan Leaflet Maps & Search berhasil dimuat');
console.log('Fitur: Klik peta, GPS, Search lokasi - 100% GRATIS!');