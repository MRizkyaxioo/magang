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
