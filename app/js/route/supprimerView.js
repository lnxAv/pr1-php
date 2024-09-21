class SupprimerView {
    constructor() {
        this.setHTMLParams();
    }

    async setHTMLParams() {
        const params = new URLSearchParams(window.location.search);
        const email = params.get('email');
        const studentFound = await getEtudiants("email", email).then(response => response[0]);
        if(!studentFound) return;
        emailElement.value = studentFound.email;
        nomElement.value = studentFound.nom;
        prenomElement.value = studentFound.prenom;
        dateNaissanceElement.value = studentFound.date_naissance;
    }

    isValid() {
        nomElement.setCustomValidity("");
        nomElement.classList.remove("is-invalid");

        prenomElement.setCustomValidity("");
        prenomElement.classList.remove("is-invalid");

        dateNaissanceElement.setCustomValidity("");
        dateNaissanceElement.classList.remove("is-invalid");

        emailElement.setCustomValidity("");
        emailElement.classList.remove("is-invalid");

        return true;
    }

    render(){
        this.setHTMLParams();
        hideAlert();
        this.isValid();
        titleElement.innerHTML = "Maquette - Supprimer";
        submitActionElement.innerHTML = "Supprimer";
        submitActionElement.className = "btn btn-danger";
        submitActionElement.hidden = false;
        formElement.onchange = ()=>{
            this.isValid();
        }
        submitActionElement.onclick = async ()=>{
            if(confirm("Êtes-vous sûr de vouloir supprimer cet étudiant ?")){
                const result = await deleteEtudiant({
                    email: emailElement.value
                });
                showAlert(result.res ?? result.error, result.res? "success" : "danger");
            }else{
                return;
            }
        };
        submitAddElement.onclick = ()=>{ routeChange('ajouter', {})};
        submitAddElement.classList = "btn btn-outline-success";
        emailElement.disabled = true;
        nomElement.disabled = true;
        prenomElement.disabled = true;
        dateNaissanceElement.disabled = true;
    }
}