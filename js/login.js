
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('php/login_etudiant.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            if(data === "success") {
                window.location.href = "espace_etudiant.html";
            } else {
                document.getElementById('login-message').innerText = data;
            }
        })
        .catch(() => {
            document.getElementById('login-message').innerText = "Erreur lors de la connexion.";
        });
    });
    