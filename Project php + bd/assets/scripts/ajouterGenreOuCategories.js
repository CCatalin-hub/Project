function ajouterDepuisSelect(type) {
    const select = document.getElementById('select-' + type);
    const valeur = select.value;

    if (!valeur) return;
    
    const selecteurDbl = 'input[name="' + type + '[]"][value="' + valeur + '"]';
    const existeDeja = document.querySelector(selecteurDbl);

    if (existeDeja) {
        alert('Ce posibilite a déjà été ajouté !');
        select.value = "";
        return;
    }
    
    const nouveauBadge = '<label class="platform_badge"><input type="checkbox" name="' + type + '[]" value="' + valeur + '" checked> ' + valeur + '</label>';

    select.parentNode.insertAdjacentHTML('beforebegin', nouveauBadge);
    select.value = "";
}

function ouvrirConfirmation() {
    const fenetre = document.getElementById('fenetre-suppression');
    if (fenetre) {
        fenetre.showModal(); 
    }
}

function fermerConfirmation() {
    const fenetre = document.getElementById('fenetre-suppression');
    if (fenetre) {
        fenetre.close();
    }
}