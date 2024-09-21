// ELEMENTS
const titleElement = document.getElementById("title");
const formElement = document.getElementById("form");
const submitActionElement = document.getElementById("submit-action");
const submitAddElement = document.getElementById("submit-add");
const tableBody = document.getElementById("etudiantsList");
const emailElement = document.getElementById("email");
const nomElement = document.getElementById("nom");
const prenomElement = document.getElementById("prenom");
const dateNaissanceElement = document.getElementById("dateNaissance");
const memoryElement = document.getElementById("memory");
const alertsElement = document.getElementById("alerts");

// ALERTS
function showAlert(message, type) {
    alertsElement.innerHTML = message;
    alertsElement.className = `alert alert-${type}`;
    alertsElement.hidden = false;
}

function hideAlert() {
    alertsElement.innerHTML = "";
    alertsElement.className = "";
    alertsElement.hidden = true;
}

// INIT
hideAlert();
dispatchUpdateTable();

// INIT ROUTE
document.addEventListener('DOMContentLoaded', function() {
    const params = Object.fromEntries(new URLSearchParams(window.location.search));
    const {route, ...data} = params;
    if(route === null) route = 'ajouter';
    routeChange(route, data);
});