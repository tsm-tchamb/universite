document.getElementById('formEtablissement').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('php/etablissement.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById('message').innerText = data;
        this.reset();
    })
    .catch(() => {
        document.getElementById('message').innerText = "Erreur lors de l'envoi.";
    });
});