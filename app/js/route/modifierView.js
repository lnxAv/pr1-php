class ModifierView {
    constructor() {
        this.setHTMLParams();
    }

    setHTMLParams() {
    }

    render(){
        this.setHTMLParams();
        titleElement.innerHTML = "Maquette - Modifier";
        submitActionElement.innerHTML = "Modifier";
        submitActionElement.className = "btn btn-primary";
        submitActionElement.hidden = false;
        submitActionElement.onclick = ()=>{ console.log('put-etudiant')};
        submitAddElement.onclick = ()=>{ routeChange('ajouter', {})};
        submitAddElement.classList = "btn btn-outline-success";
        const emailElement = formElement.querySelector("#email");
        emailElement.disabled = true;
        const nomElement = formElement.querySelector("#nom");
        nomElement.disabled = false;
        const prenomElement = formElement.querySelector("#prenom");
        prenomElement.disabled = false;
        const dateNaissanceElement = formElement.querySelector("#dateNaissance");
        dateNaissanceElement.disabled = false;
    }
}