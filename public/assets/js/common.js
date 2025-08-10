
// public/assets/js/common.js
'use strict';
// Fichier JavaScript commun pour le site web

// Fonction pour la création d'un overlay

function createOverlay() {
        console.log('Creating overlay');
    // Créer une nouvelle div pour l'overlay
    const overlay = document.createElement('div');
    overlay.classList.add('overlay');
    overlay.id = 'overlay';
    overlay.innerHTML = "<button class=\"btn-cancel\">Annuler</button>";
    document.body.appendChild(overlay);

    const cancelButton = document.querySelector('.btn-cancel');
    console.log('Cancel button:', cancelButton);
    if (cancelButton) {
        cancelButton.addEventListener('click', function () {
            console.log('Cancel button clicked in overlay');
            // Supprimer l'overlay
            overlay.remove();
        });
    }
};


// Fonction pour créer un élément HTML avec des attributs et du contenu
// et l'insérer dans un élément parent spécifié

function createElementCustom(nameElement, nameId, className, textContent, elementAppendChild) {
    console.log('Creating element:');
    
    // Étape 1 : Créer un nouvel élément de type div
    const element = document.createElement(nameElement);
    element.id = nameId; // Attribuer un ID à l'élément
    element.className = className; // Attribuer une classe CSS à l'élément

    // Étape 2 : Ajouter des attributs ou du contenu à l'élément
    element.classList.add(className); // Ajoute une classe CSS
    element.textContent = textContent; // Ajoute du texte

    // Étape 4 : Insérer l'élément dans la page
    elementAppendChild.appendChild(element);
    
}

