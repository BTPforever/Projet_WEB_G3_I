window.onload = function() {
    const souvenir = localStorage.getItem('souvenir');
    if (souvenir === 'true') {
        document.getElementById('souvenir').checked = true;
    }
}

function sesouvenir() {
    const checkbox = document.getElementById('souvenir');
    localStorage.setItem('souvenir', checkbox.checked);
}