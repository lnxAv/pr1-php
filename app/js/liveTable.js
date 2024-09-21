function updateTable(table, data) {
    table.innerHTML = "";
    data.forEach(student => {
        const row = document.createElement("tr");
        student.email = student.email.replaceAll(/(\n)/gm, "");
        row.innerHTML = /*html*/`
            <td>${student.email}</td>
            <td>${student.nom}</td>
            <td>${student.prenom}</td>
            <td>${student.date_naissance}</td>
            <td><button type="button" class="btn btn-outline-primary" onclick="routeChange('modifier', {email: '${student.email}'})">Modifier</button></td>
            <td><button type="button" class="btn btn-outline-danger" onclick="routeChange('supprimer', {email: '${student.email}'})">Supprimer</button></td>
        `;
        table.appendChild(row);
    });
}

function dispatchUpdateTable(){
    document.dispatchEvent(new CustomEvent('update-table'));
}

document.addEventListener('update-table', async function(e) {
    const data = await getEtudiants()
    updateTable(tableBody, data);
});