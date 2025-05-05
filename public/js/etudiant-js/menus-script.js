const menuButton = document.getElementById('menu-active');
const closeButton = document.getElementById('close-menu');
const mobileMenu = document.getElementById('mobilenav');
const overlay = document.getElementById('overlay');

function openMobileMenu() {
    mobileMenu.classList.add('active');
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeMobileMenu() {
    mobileMenu.classList.remove('active');
    overlay.classList.remove('active');
    document.body.style.overflow = '';
}

menuButton.addEventListener('click', openMobileMenu);
closeButton.addEventListener('click', closeMobileMenu);
overlay.addEventListener('click', closeMobileMenu);

document.querySelectorAll('#mobilenav li').forEach(item => {
    item.addEventListener('click', closeMobileMenu);
});
