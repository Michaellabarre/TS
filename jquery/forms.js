function formhash(form, password) {
    //document.write("KO");
    // Créez un nouvel élément input, il servira de champ pour le mot de passe hashé.
    var p = document.createElement("input");
 
    // Ajoutez le nouvel élément au formulaire. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    //p.value = hex_sha512(password.value);
    p.value = (password.value);
 
    // Assurez-vous que le mot de passe sous sa forme de texte brut n’est pas envoyé au script. 
    password.value = "";
 
    // Finissez en envoyant le formulaire. 
    form.submit();
}
 
function regformhash(form, uid, email, password, conf) {
     // Vérifiez qu’aucun champ n’a été laissé vide
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('Vous devez fournir tous les détails nécessaires. Veuillez essayer de nouveau');
        return false;
    }
 
    // Vérifiez le nom d’utilisateur
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Le nom d’utilisateur ne doit contenir que des lettres, des chiffres et des underscores. Essayez de nouveau"); 
        form.username.focus();
        return false; 
    }
 
    // Vérifiez que le mot de passe a la longueur nécessaire (au moins 6 caractères)
    // La même vérification est répétée ci-dessous, mais nous l’avons laissée pour vous en montrer plus
    // Guide pour l’utilisateur
    if (password.value.length < 6) {
        alert('Votre mot de passe doit avoir au moins 6 caractères.  Essayez de nouveau');
        form.password.focus();
        return false;
    }
 
    // Au moins un chiffre, une lettre en minuscule et une lettre en majuscule
    // Au moins six caractères 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Le mot de passe doit contenir au moins un chiffre, une lettre en minuscule et une lettre en majuscule.  Essayez de nouveau');
        return false;
    }
 
    // Vérifiez que les deux mots de passe sont les mêmes
    if (password.value != conf.value) {
        alert('Votre mot de passe et sa confirmation ne sont pas les mêmes. Essayez de nouveau');
        form.password.focus();
        return false;
    }
 
    // Crée un nouvel élément input qui nous servira de champs pour notre mot de passe hashé.
    var p = document.createElement("input");
 
    // Ajoute le nouvel élément au formulaire. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Assurez-vous que le mot de passe sous sa forme de texte brut n’est pas envoyé au script. 
    password.value = "";
    conf.value = "";
 
    // Finalement envoie le formulaire. 
    form.submit();
    return true;
}