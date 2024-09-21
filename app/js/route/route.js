const routes = []
routes['ajouter'] = new AjouterView();
routes['modifier'] =  new ModifierView();
routes['supprimer'] = new SupprimerView();

const routeChange = (route, data) => {
    document.dispatchEvent(new CustomEvent('route-change', {
        detail: {
            route,
            data
        }
    }));
}

// ROUTE CHANGE
document.addEventListener('route-change', function(e) {
    const route = e.detail.route;
    const component = routes[route];
    let params = new URLSearchParams(window.location.search);
    try {
        params.set('route', route);
        Object.keys(e.detail.data).forEach(key => {
            if(e.detail.data[key] === undefined || e.detail.data[key] === null) return;
            params.set(key, e.detail.data[key]);
        });
        window.history.pushState({}, '', `?${params.toString()}`);
        
        component.render();
    }
    catch (error) {
    }
});
