class AjouterView {
    constructor() {
        this.setHTMLParams();
    }

    async setHTMLParams() {
    }

    isValid() {
        let isValid = true;
        if(!emailElement.value) {
            isValid = false;
            emailElement.setCustomValidity(true);
            emailElement.classList.add("is-invalid");
            showAlert("L'email est obligatoire", "danger");
        }
        else {
            emailElement.setCustomValidity("");
            emailElement.classList.remove("is-invalid");
        }

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
        titleElement.innerHTML = "Maquette - Ajouter"; 
        submitActionElement.innerHTML = "";
        submitActionElement.hidden = true;
        formElement.onchange = ()=>{
            this.isValid();
        }
        submitAddElement.onclick = async (e)=>{
            if(!this.isValid()) return;
            const result = await postEtudiant({
                email:emailElement.value,
                nom: nomElement.value,
                prenom: prenomElement.value,
                date_naissance: dateNaissanceElement.value
            });
            showAlert(result.res ?? result.error, result.res? "success" : "danger");
        };
        submitAddElement.classList = "btn btn-success";
        emailElement.disabled = false;
        nomElement.disabled = false;
        prenomElement.disabled = false;
        dateNaissanceElement.disabled = false;
    }
}