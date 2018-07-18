function insererLigne_Fin()
{
    var cell, ligne;
 
     // récupère l'identifiant (id) de la table qui sera modifiée
    var tableau = document.getElementById("idTable");
    var nbLignesAvant = tableau.rows.length;
    
    ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
    cell = ligne.insertCell(0);
    cell.innerHTML = " <textarea class='sizepopulation' rows='1' cols='15' ></textarea>";
    cell = ligne.insertCell(1);
    cell.innerHTML = " <input type='button' name='add' value='Add' onclick='insererLigne_Fin()' />";
 
    var nbLignesApres = tableau.rows.length; // egal à nbLignesAvant + 1 normalement

    var textareas = tableau.querySelectorAll("textarea.sizepopulation");
    var ch_size = textareas[nbLignesAvant-1].value;
    alert('Valeur de la dernière ligne avant insertion: '+ ch_size);
}