async function getEtudiants(filter = 'all', info = null) {
    const response = await fetch(
        `http://localhost/pr1-php/api/v1/etudiant.php/filter?${filter}=${info}`,
        {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            }
        }
    ).then(response => {
        return response.json();
    })
    .catch(error => console.log(error));
    return response;
}

async function postEtudiant(student){
    const response = await fetch(
        "http://localhost/pr1-php/api/v1/etudiant.php",
        {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(student)
        }
    ).then(response => {
        dispatchUpdateTable();
        return response.json();
    })
    .catch(error => console.log(error));
    return response;
}

async function putEtudiant(student){
    const response = await fetch(
        `http://localhost/pr1-php/api/v1/etudiant.php/${student.email}`,
        {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                nom: student.nom,
                prenom: student.prenom,
                date_naissance: student.date_naissance
            })
        }
    ).then(response => {
        dispatchUpdateTable();
        return response.json();
    })
    .catch(error => console.log(error));
    return response;
}

async function deleteEtudiant({email}){
    const response = await fetch(
        `http://localhost/pr1-php/api/v1/etudiant.php/${email}`,
        {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            }
        }
    ).then(response => {
        dispatchUpdateTable();
        return response.json();
    })
    .catch(error => console.log(error));
    return response;
}