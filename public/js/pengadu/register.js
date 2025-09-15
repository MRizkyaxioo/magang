// Toggle show/hide password
document.querySelectorAll('[data-toggle="password"]').forEach(btn=>{
  btn.addEventListener('click', ()=>{
    const target = document.querySelector(btn.dataset.target);
    const isPwd = target.type === 'password';
    target.type = isPwd ? 'text' : 'password';
    btn.classList.toggle('on', isPwd);
  });
});

// Batasi NIK hanya angka
const nik = document.getElementById('nik');
nik.addEventListener('input', e=>{
  e.target.value = e.target.value.replace(/\D/g,'').slice(0,16);
});
