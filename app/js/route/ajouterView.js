class AjouterView {
    constructor() {
        this.setHTMLParams();
    }

    setHTMLParams() {
    }

    render(){
        this.setHTMLParams();
        titleElement.innerHTML = "Maquette - Ajouter"; 
        submitActionElement.innerHTML = "";
        submitActionElement.hidden = true;
        submitAddElement.onclick = ()=>{ console.log('HELLO')};
        submitAddElement.classList = "btn btn-success";
        const emailElement = formElement.querySelector("#email");
        emailElement.disabled = false;
        const nomElement = formElement.querySelector("#nom");
        nomElement.disabled = false;
        const prenomElement = formElement.querySelector("#prenom");
        prenomElement.disabled = false;
        const dateNaissanceElement = formElement.querySelector("#dateNaissance");
        dateNaissanceElement.disabled = false;
    }
}