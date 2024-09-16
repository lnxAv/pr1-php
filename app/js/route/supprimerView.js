class SupprimerView {
    constructor() {
        this.setHTMLParams();
    }

    setHTMLParams() {
    }

    render(){
        this.setHTMLParams();
        titleElement.innerHTML = "Maquette - Supprimer";
        submitActionElement.innerHTML = "Supprimer";
        submitActionElement.className = "btn btn-danger";
        submitActionElement.hidden = false;
        submitActionElement.onclick = ()=>{
            if(confirm("Êtes-vous sûr de vouloir supprimer cet étudiant ?")){
                deleteEtudiant(emailElement.value);
            }else{
                return;
            }
        };
        submitAddElement.onclick = ()=>{ routeChange('ajouter', {})};
        submitAddElement.classList = "btn btn-outline-success";
        const emailElement = formElement.querySelector("#email");
        emailElement.disabled = true;
        const nomElement = formElement.querySelector("#nom");
        nomElement.disabled = true;
        const prenomElement = formElement.querySelector("#prenom");
        prenomElement.disabled = true;
        const dateNaissanceElement = formElement.querySelector("#dateNaissance");
        dateNaissanceElement.disabled = true;
    }
}