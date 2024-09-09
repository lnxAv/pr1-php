async function test() {
    const response = await fetch(
        "http://localhost/pr1-php/api/v1/etudiant.php"
    ).then(response => response.text())
    .catch(error => console.log(error));

    console.log(response);
    return response;
}