document.getElementById('formPiece').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    // Pour chaque case à cocher, si non cochée, envoyer 0
    ['Acte_Naissance','Demande_Manuscrite','Releve_Note','Attestation','Casier_Judiciaire','Certificat_Nationalite'].forEach(name => {
        if (!formData.has(name)) formData.append(name, 0);
    });
    fetch('php/piece.php', {
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