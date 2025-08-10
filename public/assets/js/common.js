function createElementCustom(nameElement, nameId, className, textContent, elementAppendChild) {
    console.log('Creating element:');
    
    const nameElement = nameElement;
    const id = nameId;
    const className = className;
    const textContent = textContent;
    const elementAppendChild = elementAppendChild;

    // Étape 1 : Créer un nouvel élément de type div
    const namnameElemente = document.createElement('div');

    // Étape 2 : Ajouter des attributs ou du contenu à l'élément
    namnameElemente.classList.add(className); // Ajoute une classe CSS
    nameElement.textContent = 'Ceci est un élément créé en JavaScript !'; // Ajoute du texte

    // Étape 4 : Insérer l'élément dans la page
    elementAppendChild.appendChild(nameElement);
    
}