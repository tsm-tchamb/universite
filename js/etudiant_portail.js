 document.getElementById('formEtudiantPortail').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('php/etudiant.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            document.getElementById('message').innerText = data;
            document.getElementById('menuGestion').style.display = 'block';
            this.reset();
        })
        .catch(() => {
            document.getElementById('message').innerText = "Erreur lors de l'envoi.";
        });
    });