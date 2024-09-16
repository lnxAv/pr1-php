async function getEtudiants(email) {
    console.log('get');
    const response = await fetch(
        "http://localhost/pr1-php/api/v1/etudiant.php",
        {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                email: email || null
            })
        }
    ).then(response => response.json())
    .catch(error => console.log(error));
    return response;
}

async function postEtudiant(email, nom, prenom, dateNaissance){
    const response = await fetch(
        "http://localhost/pr1-php/api/v1/etudiant.php",
        {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                email: email,
                nom: nom,
                prenom: prenom,
                dateNaissance: dateNaissance
            })
        }
    ).then(response => response.json())
    .catch(error => console.log(error));
    console.log(response)
    return response;
}

async function putEtudiant(email, nom, prenom, dateNaissance){
    const response = await fetch(
        "http://localhost/pr1-php/api/v1/etudiant.php",
        {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                email: email,
                nom: nom,
                prenom: prenom,
                dateNaissance: dateNaissance
            })
        }
    ).then(response => response.json())
    .catch(error => console.log(error));
    return response;
}

async function deleteEtudiant(email){
    const response = await fetch(
        "http://localhost/pr1-php/api/v1/etudiant.php",
        {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                email: email || null
            })
        }
    ).then(response => response.json())
    .catch(error => console.log(error));
    return response;
}