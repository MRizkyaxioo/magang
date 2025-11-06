/* ============================================
   JAVASCRIPT UNTUK FORM PENGADUAN & LEAFLET MAPS
   Dengan Fitur Search Lokasi & SweetAlert Confirmation
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
    Swal.fire({
      icon: 'warning',
      title: 'Perhatian!',
      text: 'Mohon masukkan minimal 3 karakter untuk mencari lokasi',
      confirmButtonColor: '#FFD700',
      confirmButtonText: 'OK'
    });
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
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Terjadi kesalahan saat mencari lokasi. Silakan coba lagi.',
      confirmButtonColor: '#FFD700',
      confirmButtonText: 'OK'
    });
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
    Swal.fire({
      icon: 'error',
      title: 'Tidak Didukung',
      text: 'Browser Anda tidak mendukung Geolocation. Silakan pilih lokasi secara manual di peta.',
      confirmButtonColor: '#FFD700',
      confirmButtonText: 'OK'
    });
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

      Swal.fire({
        icon: 'error',
        title: 'Gagal Mendapatkan Lokasi',
        text: errorMessage,
        confirmButtonColor: '#FFD700',
        confirmButtonText: 'OK'
      });

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

  // ========================================
  // VALIDASI FORM DENGAN SWEETALERT CONFIRMATION
  // ========================================
  const form = document.getElementById('pengaduanForm');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault(); // Prevent default submit

      const latitude = document.getElementById('latitude').value;
      const longitude = document.getElementById('longitude').value;
      const lokasi = document.getElementById('lokasi_kejadian').value;

      // Validasi lokasi
      if (!latitude || !longitude || !lokasi) {
        Swal.fire({
          icon: 'warning',
          title: 'Lokasi Belum Dipilih!',
          html: `
            <p>Mohon pilih lokasi kejadian terlebih dahulu!</p>
            <br>
            <p><strong>Anda bisa:</strong></p>
            <ul style="text-align: left; padding-left: 30px;">
              <li>Ketik nama lokasi dan klik "Cari"</li>
              <li>Klik pada peta</li>
              <li>Gunakan tombol "Gunakan Lokasi Saya"</li>
            </ul>
          `,
          confirmButtonColor: '#FFD700',
          confirmButtonText: 'OK, Saya Mengerti'
        }).then(() => {
          document.getElementById('map').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        });

        return false;
      }

      // Dapatkan data form
      const kategori = document.getElementById('id_pengaduan');
      const kategoriText = kategori.options[kategori.selectedIndex].text;
      const deskripsi = document.getElementById('deskripsi').value;
      const tanggal = document.getElementById('tanggal_kejadian').value;
      const bukti = document.getElementById('bukti_foto').files[0];

      // Format tanggal untuk ditampilkan
      const tanggalFormatted = new Date(tanggal).toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });

      // Tampilkan konfirmasi dengan SweetAlert
      Swal.fire({
        title: 'Konfirmasi Pengiriman Laporan',
        html: `
          <div style="text-align: left; padding: 10px;">
            <p style="margin-bottom: 15px;"><strong>Apakah Anda yakin ingin mengirim laporan ini?</strong></p>

            <div style="background: #FFF9E6; padding: 15px; border-radius: 8px; margin-bottom: 10px;">
              <p style="margin: 5px 0;"><strong>📌 Kategori:</strong> ${kategoriText}</p>
              <p style="margin: 5px 0;"><strong>📅 Tanggal Kejadian:</strong> ${tanggalFormatted}</p>
              <p style="margin: 5px 0;"><strong>📍 Lokasi:</strong> ${lokasi}</p>
              <p style="margin: 5px 0;"><strong>📸 Bukti Foto:</strong> ${bukti ? bukti.name : 'Tidak ada'}</p>
              <p style="margin: 5px 0;"><strong>📝 Deskripsi:</strong> ${deskripsi.substring(0, 100)}${deskripsi.length > 100 ? '...' : ''}</p>
            </div>

            <p style="color: #8B4513; font-size: 14px; margin-top: 10px;">
              <em>Pastikan semua informasi yang Anda berikan sudah benar.</em>
            </p>
          </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#FFD700',
        cancelButtonColor: '#d33',
        confirmButtonText: '✅ Ya, Kirim Laporan!',
        cancelButtonText: '❌ Batal',
        reverseButtons: true,
        width: '600px',
        customClass: {
          confirmButton: 'swal-confirm-btn',
          cancelButton: 'swal-cancel-btn'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          // User mengkonfirmasi, submit form
          const button = form.querySelector('.btn-lapor');
          button.innerHTML = '⏳ Mengirim laporan...';
          button.disabled = true;

          console.log('Form valid, mengirim data...');
          console.log('Lokasi:', lokasi);
          console.log('Koordinat:', latitude, longitude);

          // Submit form secara programmatis
          form.submit();
        }
      });
    });
  }
});

// ========================================
// CONSOLE LOG
// ========================================
console.log('Form Pengaduan dengan Leaflet Maps, Search & SweetAlert berhasil dimuat');
