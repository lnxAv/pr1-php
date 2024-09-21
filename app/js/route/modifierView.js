class ModifierView {
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
        let isValid = true;

        emailElement.setCustomValidity("");
        emailElement.classList.remove("is-invalid");

        if(!nomElement.value) {
            isValid = false;
            nomElement.setCustomValidity(true);
            nomElement.classList.add("is-invalid");
            showAlert("Le nom est obligatoire", "danger");
        }else{
            nomElement.setCustomValidity("");
            nomElement.classList.remove("is-invalid");
        }

        if(!prenomElement.value) {
            isValid = false;
            prenomElement.setCustomValidity(true);
            prenomElement.classList.add("is-invalid");
            showAlert("Le prénom est obligatoire", "danger");
        }else{
            prenomElement.setCustomValidity("");
            prenomElement.classList.remove("is-invalid");
        }

        if(!dateNaissanceElement.value) {
            isValid = false;
            dateNaissanceElement.setCustomValidity(true);
            dateNaissanceElement.classList.add("is-invalid");
            showAlert("La date de naissance est obligatoire", "danger");
        }else{
            dateNaissanceElement.setCustomValidity("");
            dateNaissanceElement.classList.remove("is-invalid");
        }

        if(isValid) {
            hideAlert();
        }

        return isValid;
    }

    render(){
        this.setHTMLParams();
        hideAlert();
        this.isValid();
        titleElement.innerHTML = "Maquette - Modifier";
        submitActionElement.innerHTML = "Modifier";
        submitActionElement.className = "btn btn-primary";
        submitActionElement.hidden = false;
        formElement.onchange = ()=>{
            this.isValid();
        }
        submitActionElement.onclick = async ()=>{
            if(!this.isValid()) return;
            const result = await putEtudiant({
                email: emailElement.value,
                nom: nomElement.value,
                prenom: prenomElement.value,
                date_naissance:dateNaissanceElement.value
            })
            showAlert(result.res ?? result.error, result.res? "success" : "danger");
        };
        submitAddElement.onclick = ()=>{ routeChange('ajouter', {})};
        submitAddElement.classList = "btn btn-outline-success";
        emailElement.disabled = true;
        nomElement.disabled = false;
        prenomElement.disabled = false;
        dateNaissanceElement.disabled = false;
    }
}