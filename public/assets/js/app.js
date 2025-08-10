const viewUserStatusLogin = document.getElementById('viewUserStatusLogin');
const viewUserStatusLogout = document.getElementById('viewUserStatusLogout');


function handleViewStatusClick(event) {
    event.preventDefault();
    let textContent = event.target.textContent;
    console.log('viewUserStatus clicked with text:', textContent);

    // Vérifier si l'overlay existe déjà
    if (!document.getElementById('overlay')) {
        createOverlay();
        if (textContent === 'Connexion') {
            console.log('User clicked on login');
            createElementCustom('name', 'id', 'className', 'textContent', 'elementAppendChild');
          
        }
        else if (textContent === 'Déconnexion') {
            console.log('User clicked on logout');
            createElementCustom('name', 'id', 'className', 'textContent', 'elementAppendChild');
        }
    }
};

viewUserStatusLogin.addEventListener('click', handleViewStatusClick);
viewUserStatusLogout.addEventListener('click', handleViewStatusClick);




function createOverlay() {
    console.log('Creating overlay');
    // Créer une nouvelle div pour l'overlay
    const overlay = document.createElement('div');
    overlay.classList.add('overlay');
    overlay.id = 'overlay';
    overlay.innerHTML = "<button class=\"btn-cancel\">Annuler</button>";
    document.body.appendChild(overlay);

    const cancelButton = document.querySelector('.btn-cancel');
    if (cancelButton) {
        cancelButton.addEventListener('click', function () {
            console.log('Cancel button clicked in overlay');
            // Supprimer l'overlay
            overlay.remove();
        });
    }
};

