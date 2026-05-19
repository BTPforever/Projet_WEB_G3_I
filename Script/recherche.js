const recherche = document.getElementById("recherche");
recherche.addEventListener("input", function () {
    const valeur = recherche.value.toLowerCase();
    const events = document.querySelectorAll(".event-item");
    events.forEach(function (event) {
        const texte = event.textContent.toLowerCase();
        if (texte.includes(valeur)) {
            event.style.display = "";
        } else {
            event.style.display = "none";
        }
    });
});