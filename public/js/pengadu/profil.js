function openModal() {
document.getElementById('passwordModal').style.display = 'block';
}

function closeModal() {
document.getElementById('passwordModal').style.display = 'none';
document.getElementById('passwordForm').reset();
}

window.onclick = function(event) {
const modal = document.getElementById('passwordModal');
if (event.target === modal) {
closeModal();
}
}

function togglePassword(id, icon) {
const input = document.getElementById(id);
if (input.type === "password") {
input.type = "text";
icon.textContent = "🙈";
} else {
input.type = "password";
icon.textContent = "👁";
}
}