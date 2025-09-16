// Form validation and submission
document.getElementById('registrationForm').addEventListener('submit', function(e) {
    hideErrors();
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);

    const errors = validateForm(data);
    if (errors.length > 0) {
        e.preventDefault();
        showErrors(errors);
        return;
    }

    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="loading"></span>Membuat Akun...';
    submitBtn.disabled = true;

    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            html: `
                Akun pengurus berhasil dibuat.<br><br>
                <b>Instansi:</b> ${data.instansi_pemerintahan}<br>
                <b>Email:</b> ${data.email}<br>
                <b>Kategori:</b> ${getKategoriName(data.id_pengaduan)}
            `,
            confirmButtonColor: '#8B4513',
            confirmButtonText: 'OK'
        });

        this.reset();
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        clearValidationStates();
    }, 1500);
});

// Form validation function
function validateForm(data) {
    const errors = [];

    if (!data.instansi_pemerintahan || data.instansi_pemerintahan.length < 3) {
        errors.push('Nama instansi harus diisi minimal 3 karakter');
        markInvalid('instansi');
    } else {
        markValid('instansi');
    }

    if (!data.email || !isValidEmail(data.email)) {
        errors.push('Email tidak valid atau belum diisi');
        markInvalid('email');
    } else {
        markValid('email');
    }

    if (!data.password || data.password.length < 6) {
        errors.push('Password harus minimal 6 karakter');
        markInvalid('password');
    } else {
        markValid('password');
    }

    if (data.password !== data.password_confirmation) {
        errors.push('Konfirmasi password tidak cocok');
        markInvalid('password_confirmation');
    } else if (data.password_confirmation) {
        markValid('password_confirmation');
    }

    if (!data.id_pengaduan) {
        errors.push('Kategori pengaduan harus dipilih');
        markInvalid('kategori');
    } else {
        markValid('kategori');
    }

    return errors;
}

// Email validation
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Mark input as invalid
function markInvalid(fieldId) {
    const field = document.getElementById(fieldId);
    field.classList.remove('valid');
    field.classList.add('invalid');
}

// Mark input as valid
function markValid(fieldId) {
    const field = document.getElementById(fieldId);
    field.classList.remove('invalid');
    field.classList.add('valid');
}

// Clear validation states
function clearValidationStates() {
    const inputs = document.querySelectorAll('.form-input, .form-select');
    inputs.forEach(input => {
        input.classList.remove('valid', 'invalid');
    });
}

// Show errors
function showErrors(errors) {
    const errorAlert = document.getElementById('errorAlert');
    const errorList = document.getElementById('errorList');

    errorList.innerHTML = '';
    errors.forEach(error => {
        const li = document.createElement('li');
        li.textContent = error;
        errorList.appendChild(li);
    });

    errorAlert.style.display = 'block';
    errorAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// Hide errors
function hideErrors() {
    document.getElementById('errorAlert').style.display = 'none';
}

// Get category name by ID
function getKategoriName(id) {
    const categories = {
        '1': 'Infrastruktur',
        '2': 'Lingkungan',
        '3': 'Pelayanan Publik',
        '4': 'Keamanan',
        '5': 'Sosial',
        '6': 'Ekonomi',
        '7': 'Pendidikan',
        '8': 'Kesehatan'
    };
    return categories[id] || 'Tidak diketahui';
}

// Password strength checker
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthDiv = document.getElementById('passwordStrength');

    if (password.length === 0) {
        strengthDiv.classList.remove('show');
        return;
    }

    strengthDiv.classList.add('show');

    let strength = 0;
    if (password.length >= 6) strength++;
    if (password.match(/[a-z]/)) strength++;
    if (password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;

    if (strength <= 2) {
        strengthDiv.textContent = 'Password lemah';
        strengthDiv.className = 'password-strength show strength-weak';
    } else if (strength <= 3) {
        strengthDiv.textContent = 'Password sedang';
        strengthDiv.className = 'password-strength show strength-medium';
    } else {
        strengthDiv.textContent = 'Password kuat';
        strengthDiv.className = 'password-strength show strength-strong';
    }
});

// Back button function
function goBack() {
    const confirmed = confirm('Apakah Anda yakin ingin kembali ke dashboard?\nData yang belum disimpan akan hilang.');
    if (confirmed) {
        alert('Mengarahkan ke dashboard admin...');
        // window.location.href = '/admin/dashboard';
    }
    return false;
}

// Real-time validation on input
document.querySelectorAll('.form-input, .form-select').forEach(input => {
    input.addEventListener('blur', function() {
        const formData = new FormData(document.getElementById('registrationForm'));
        const data = Object.fromEntries(formData);

        // Validate only this field
        if (this.name === 'instansi_pemerintahan') {
            if (!data.instansi_pemerintahan || data.instansi_pemerintahan.length < 3) {
                markInvalid('instansi');
            } else {
                markValid('instansi');
            }
        } else if (this.name === 'email') {
            if (!data.email || !isValidEmail(data.email)) {
                markInvalid('email');
            } else {
                markValid('email');
            }
        } else if (this.name === 'password') {
            if (!data.password || data.password.length < 6) {
                markInvalid('password');
            } else {
                markValid('password');
            }
        } else if (this.name === 'password_confirmation') {
            if (data.password !== data.password_confirmation) {
                markInvalid('password_confirmation');
            } else if (data.password_confirmation) {
                markValid('password_confirmation');
            }
        } else if (this.name === 'id_pengaduan') {
            if (!data.id_pengaduan) {
                markInvalid('kategori');
            } else {
                markValid('kategori');
            }
        }
    });
});

// Add smooth animations on page load
window.addEventListener('load', function() {
    const container = document.querySelector('.container');
    container.style.opacity = '0';
    container.style.transform = 'scale(0.9) translateY(20px)';
    container.style.transition = 'all 0.8s ease';

    setTimeout(() => {
        container.style.opacity = '1';
        container.style.transform = 'scale(1) translateY(0)';
    }, 100);

    // Animate form elements
    const formElements = document.querySelectorAll('.form-group, .button-container');
    formElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'all 0.6s ease';

        setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, 300 + (index * 100));
    });
});