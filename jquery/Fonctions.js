var tableau;
var nbLignes;
var nbColonnes;

var tableauCons;
var nbLignesCons;
var nbColonnesCons;

var tableauFact;
var nbLignesFact;
var nbColonnesFact;

var tableauTS;
var nbLignesTS;
var nbColonnesTS;

var tableauDep;
var nbLignesDep;
var nbColonnesDep;

                function toggleDetails(){
                    $(".details").slideToggle();
                    $("a.toggle-details").toggleClass("expanded");
                }                                
                
                function toggleDetails2(){
                    $(".details2").slideToggle();
                    $("a.toggle-details2").toggleClass("expanded");
                }
                
                function toggleDetails3(){
                    $(".details3").slideToggle();
                    $("a.toggle-details3").toggleClass("expanded");
                }
                
                function toggleDetails4(){
                    $(".details4").slideToggle();
                    $("a.toggle-details4").toggleClass("expanded");
                }
                
                function toggleDetails5(){
                    $(".details5").slideToggle();
                    $("a.toggle-details5").toggleClass("expanded");
                }
                
                function toggleDetails6(){
                    $(".details6").slideToggle();
                    $("a.toggle-details6").toggleClass("expanded");
                }
                
                function toggleDetailsM(){
                    $(".detail").slideToggle();
                    $("a.toggle-detail").toggleClass("expanded");
                }
                
                function toggleDetailsM2(){
                    $(".detail2").slideToggle();
                    $("a.toggle-detail2").toggleClass("expanded");
                }
                
                function toggleDetailsM3(){
                    $(".detail3").slideToggle();
                    $("a.toggle-detail3").toggleClass("expanded");
                }
                
                function toggleDetailsM4(){
                    $(".detail4").slideToggle();
                    $("a.toggle-detail4").toggleClass("expanded");
                }
                
                
                function toggleDetailsM5(){
                    $(".detail5").slideToggle();
                    $("a.toggle-detail5").toggleClass("expanded");
                }
                
                function toggleDetailsM6(){
                    $(".detail6").slideToggle();
                    $("a.toggle-detail6").toggleClass("expanded");
                }

function titre(){
    return '<tr>' +
                '<th> Dept</th>' +
                '<th> Manager</th>' +
                '<th> Associé</th>' +
           '</tr>';
}

function nouvelleligne(nbligne){
    return '<tr name="'+ nbligne +'" ondblclick="ajouterligne($(this));" >' +                    
                    '<td><input type="text" name="deptList" list="deptList" /></td>' +
                    '<td><input type="text" name="managerList" list="managerList" /></td>' +
                    '<td><input type="text" name="assocList" list="assocList" /></td>' +
            '</tr>';
}

function ajouterligne(ligne){
    // Si c'est la derière ligne	
    var nouvelle_ligne;    
    if(ligne.attr('name') === nbligne){
                        
            // On insert la nouvelle ligne
            nbligne ++;
            nouvelle_ligne = nouvelleligne(nbligne);
            $(nouvelle_ligne).insertAfter(ligne);            
            
            // on change la variable nbligne et on l'affiche 
            //$("#result").html("nb ligne = " + nbligne);
            //$("#tab1").html("nb ligne = " + nbligne);
    }
}

function insererLigne_FinCde(){
    var cell, ligne;
 
    try{
         // récupère l'identifiant (id) de la table qui sera modifiée
        tableau = document.getElementById("idCde");    
        nbLignes = tableau.rows.length;    
        nbColonnes = tableau.rows[0].cells.length;        
        var numero;

        ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
        cell = ligne.insertCell(0);
        cell.innerHTML = " <input type='text' name='deptList[]' list='deptList' onblur='verifChampNul(this)'/>";
        cell = ligne.insertCell(1);
        cell.innerHTML = " <input type='text' name='managerList[]' list='managerList' onblur='verifChampNul(this)'/>";
        cell = ligne.insertCell(2);
        cell.innerHTML = " <input type='text' name='assocList[]' list='assocList' onblur='verifChampNul(this)'/>";         
        cell = ligne.insertCell(3);
        numero = ligne.rowIndex;
        cell.innerHTML = "<a href='#' onclick='if(confirm(\"Voulez vous vraiment supprimer cette ligne ?\")){load_page(\"./Time/supprimeLigneM.php?num="+numero+"\");}'><input type='button' value='x' /></a>";
        //cell.innerHTML = " <a href='supprimer.php' >Supprimer</a>";         
        //alert("Nombre de lignes " + nbLignes + "colonnes " +nbColonnes);       
    }
    catch(e){
        alert('Error JS in function inserer Affectation mission.\n\n' + e.message);
    }
}

function insererLigne_Fin(){
    var cell, ligne;
 
    try{
         // récupère l'identifiant (id) de la table qui sera modifiée
        tableau = document.getElementById("idTable");         
        
        nbLignes = tableau.rows.length;    
        nbColonnes = tableau.rows[0].cells.length;         
        var numero;
        
        ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
        cell = ligne.insertCell(0);
        cell.innerHTML = " <input type='text' name='deptList[]' id='deptList[]' class='removeField' list='deptList' onblur='verifChampNul(this)' />";        
        cell = ligne.insertCell(1);
        cell.innerHTML = " <input type='text' name='managerList[]' id='managerList[]' class='removeField' list='managerList' onblur=\"verifChampNul(this)\" />";
        cell = ligne.insertCell(2);
        cell.innerHTML = " <input type='text' name='assocList[]' id='assocList[]' class='removeField' list='assocList' onblur=\"verifChampNul(this)\" />";         
        cell = ligne.insertCell(3);
        //cell.innerHTML = " <input type='button' name='bouton[" + nbLigne + "]' class=bouton value='x'  onclick='removeLigne("+ nbLigne +");' />";                     
        numero = ligne.rowIndex;
        cell.innerHTML = "<a href='#' onclick='if(confirm(\"Voulez vous vraiment supprimer cette ligne \")){load_page(\"./Time/supprimeLigne.php?num="+numero+"\");}'><input type='button' value='x' /></a>";
        
//        alert("Nombre de lignes " + nbLignes + "colonnes " +nbColonnes); 
//        
        //ligne.cells[0].innerHTML = numero-1;
        
        
    }
    catch(e){
        alert('Error JS in function insererLigne_Fin\n\n' + e.message);        
    }
}

function load_page(page) {
    $("#content").load(page);
}

function insererLigne_Fin_Cons_Code(){
    var cell, ligne;
 
    try{
         // récupère l'identifiant (id) de la table qui sera modifiée
        tableauCons = document.getElementById("consCode");    
        nbLignesCons = tableauCons.rows.length;    
        nbColonnesCons = tableauCons.rows[0].cells.length;        
        var numero;

        ligne = tableauCons.insertRow(-1); // création d'une ligne pour ajout en fin de table
        cell = ligne.insertCell(0);
        cell.innerHTML = " <input type='text' name='nameCons[]' list='nameCons' onblur='verifChampNul(this)' />";
        cell = ligne.insertCell(1);
        cell.innerHTML = " <input type='text' name='prof[]' list='prof' onblur='verifChampNul(this)' />";
        cell = ligne.insertCell(2);
        cell.innerHTML = " <input type='double' name='nbJH[]' onblur='verifChampNul(this)' onclick='verifChampDynClear(this)' />";         
        cell = ligne.insertCell(3);
        cell.innerHTML = " <td><input type='double' name='tarifJH[]' onblur='verifChampNul(this)' onclick='verifChampDynClear(this)' />";         
        cell = ligne.insertCell(4);
        cell.innerHTML = " <input type='double' name='montant[]' readonly='true' />";        
        cell = ligne.insertCell(5);
        numero = ligne.rowIndex;
        cell.innerHTML = "<a href='#' onclick='if(confirm(\"Voulez vous vraiment supprimer cette ligne ?\")){load_page(\"./Time/supprimeLigneConsM.php?num="+numero+"\");}'><input type='button' value='x' /></a>";
//        cell.innerHTML = " <a href='supprimer.php' >x</a>";         
        //alert("Nombre de lignes " + nbLignesCons + "colonnes " +nbColonnesCons);       
    }
    catch(e){
        alert('Error JS in function insererLigne_Fin_Cons\n\n' + e.message);
    }
}

function insererLigne_Fin_Cons(){
    var cell, ligne;
 
    try{
         // récupère l'identifiant (id) de la table qui sera modifiée
        tableauCons = document.getElementById("tableCons");    
        nbLignesCons = tableauCons.rows.length;    
        nbColonnesCons = tableauCons.rows[0].cells.length;        
        var numero;

        ligne = tableauCons.insertRow(-1); // création d'une ligne pour ajout en fin de table
        cell = ligne.insertCell(0);
        cell.innerHTML = " <input type='text' name='nameCons[]' list='nameCons'  onblur='verifChampNul(this)' />";        
        cell = ligne.insertCell(1);
        cell.innerHTML = " <input type='text' name='prof[]' list='prof' onblur='verifChampNul(this)' />";        
        cell = ligne.insertCell(2);
        cell.innerHTML = " <input type='double' name='nbJH[]' onblur='verifChampNul(this)' onclick='verifChampDynClear(this)'/>";        
        cell = ligne.insertCell(3);
        cell.innerHTML = " <td><input type='double' name='tarifJH[]' onblur='verifChampNul(this)' onclick='verifChampDynClear(this)' />";        
        cell = ligne.insertCell(4);
        numero = ligne.rowIndex;
        cell.innerHTML = "<a href='#' onclick='if(confirm(\"Voulez vous vraiment supprimer cette ligne "+numero +"?\")){load_page(\"./Time/supprimeLigneCons.php?num="+numero+"\");}'><input type='button' value='x' /></a>";
        //cell.innerHTML = " <input type='double' name='montant[]' readonly='true' />";
//        cell = ligne.insertCell(4);
//        cell.innerHTML = " <a href='supprimer.php' >x</a>";         
        //alert("Nombre de lignes " + nbLignesCons + "colonnes " +nbColonnesCons);       
    }
    catch(e){
        alert('Error JS in function insererLigne_Fin_Cons\n\n' + e.message);
    }
}

function insererLigne_Fin_Fact(){
    var cell, ligne;
 
    try{
         // récupère l'identifiant (id) de la table qui sera modifiée
        tableauFact = document.getElementById("tableFact");    
        nbLignesFact = tableauFact.rows.length;    
        nbColonnesFact = tableauFact.rows[0].cells.length;
        var numero;

        ligne = tableauFact.insertRow(-1); // création d'une ligne pour ajout en fin de table
        cell = ligne.insertCell(0);
        cell.innerHTML = " <input type='text' name='echeanceDate[]' id='echeanceDate" +nbLignesFact + "' onblur='verifChampNul(this)' />";        
        cell = ligne.insertCell(1);
        cell.innerHTML = " <input type='text' name='honodebours[]' list='honodebours'  onblur='verifChampNul(this)' />";        
        cell = ligne.insertCell(2);
        cell.innerHTML = " <input type='text' name='intitule[]'  onblur='verifChampNul(this)' />";        
        cell = ligne.insertCell(3);
        cell.innerHTML = " <td><input type='text' name='PContrat[]'  onblur='verifChampNul(this)' onclick='verifChampDynClear(this)'/>";        
        cell = ligne.insertCell(4);
        cell.innerHTML = " <input type='double' name='devise[]' list='devise' onblur='verifChampNul(this)' />";        
        cell = ligne.insertCell(5);
        cell.innerHTML = " <input type='double' name='montantPrevisionnel[]' onblur='verifChampNul(this)' onclick='verifChampDynClear(this)'/>";        
        cell = ligne.insertCell(6);
        numero = ligne.rowIndex;
        cell.innerHTML = "<a href='#' onclick='if(confirm(\"Voulez vous vraiment supprimer cette ligne "+numero +"?\")){load_page(\"./Time/supprimeLigneFact.php?num="+numero+"\");}'><input type='button' value='x' /></a>";
//        cell.innerHTML = " <a href='supprimer.php' >Supprimer</a>";         
        //alert("Nombre de lignes " + nbLignesFact + " colonnes " +nbColonnesFact);
        
        
        $("#echeanceDate" + nbLignesFact).datepicker({
                        autoclose: true,
                        format: "dd-mm-yyyy",
                        //format: "yyyy-mm-dd",
                        //daysOfWeekDisabled: [0, 6],
                        todayHighlight: true
                        //endDate: 'today'
                    });
        
        
    }
    catch(e){
        alert('Error JS in function insererLigne_Fin_Fact\n\n' + e.message);
    }
}

function insererLigne_Fin_Fact_Cde(){
    var cell, ligne;
 
    try{
         // récupère l'identifiant (id) de la table qui sera modifiée
        tableauFact = document.getElementById("factCde");    
        nbLignesFact = tableauFact.rows.length;    
        nbColonnesFact = tableauFact.rows[0].cells.length; 
        var numero;

        ligne = tableauFact.insertRow(-1); // création d'une ligne pour ajout en fin de table
        cell = ligne.insertCell(0);
        cell.innerHTML = " <input type='text' name='echeanceDate[]' id='echeanceDate" +nbLignesFact + "' onblur='verifChampNul(this)'/>";
        cell = ligne.insertCell(1);
        cell.innerHTML = " <input type='text' name='honodebours[]' list='honodebours' onblur='verifChampNul(this)'/>";
        cell = ligne.insertCell(2);
        cell.innerHTML = " <input type='text' name='intitule[]' onblur='verifChampNul(this)' />";         
        cell = ligne.insertCell(3);
        cell.innerHTML = " <td><input type='text' name='PContrat[]' onblur='verifChampNul(this)' onclick='verifChampDynClear(this)'/>";         
        cell = ligne.insertCell(4);
        cell.innerHTML = " <input type='double' name='devise[]' list='devise' onblur='verifChampNul(this)'/>";
        cell = ligne.insertCell(5);
        cell.innerHTML = " <input type='double' name='montantPrevisionnel[]' onblur='verifChampNul(this)' onclick='verifChampDynClear(this)'/>";
        cell = ligne.insertCell(6);
        numero = ligne.rowIndex;
        cell.innerHTML = "<a href='#' onclick='if(confirm(\"Voulez vous vraiment supprimer cette ligne?\")){load_page(\"./Time/supprimeLigneFactM.php?num="+numero+"\");}'><input type='button' value='x' /></a>";
//        cell.innerHTML = " <a href='supprimer.php' >Supprimer</a>";         
        //alert("Nombre de lignes " + nbLignesFact + "colonnes " +nbColonnesFact); 
        
        $("#echeanceDate" + nbLignesFact).datepicker({
                        autoclose: true,
                        format: "dd-mm-yyyy",
                        //format: "yyyy-mm-dd",
                        //daysOfWeekDisabled: [0, 6],
                        todayHighlight: true
                        //endDate: 'today'
                    });
        
    }
    catch(e){
        alert('Error JS in function insererLigne_Fin_Fact\n\n' + e.message);
    }
}

function insererLigne_Fin_Fact_Cde_Test(){
    var cell, ligne;
 
    try{
         // récupère l'identifiant (id) de la table qui sera modifiée
        tableauFact = document.getElementById("factCde");    
        nbLignesFact = tableauFact.rows.length;    
        nbColonnesFact = tableauFact.rows[0].cells.length;        

        ligne = tableauFact.insertRow(-1); // création d'une ligne pour ajout en fin de table
        cell = ligne.insertCell(0);
        cell.innerHTML = " <input type='text' name='echeanceDate[]' id='echeanceDate" +nbLignesFact + "' />";
        cell = ligne.insertCell(1);
        cell.innerHTML = " <input type='date' name='date_reactu[]'  />";
        cell = ligne.insertCell(2);
        cell.innerHTML = " <input type='text' name='intitule[]'  />";         
        cell = ligne.insertCell(3);
        cell.innerHTML = " <input type='double' name='montantPrevisionnel[]' />";         
        cell = ligne.insertCell(4);
        cell.innerHTML = " <input type='double' name='devise[]' list='devise' />";
        cell = ligne.insertCell(5);
        cell.innerHTML = " <td><input type='text' name='PContrat[]' onclick='verifChampDynClear(this)' />";        
//        cell = ligne.insertCell(6);
//        cell.innerHTML = " <a href='supprimer.php' >Supprimer</a>";         
        //alert("Nombre de lignes " + nbLignesFact + "colonnes " +nbColonnesFact);   
        
        $("#echeanceDate" + nbLignesFact).datepicker({
                        autoclose: true,
                        //format: "dd/mm/yyyy",
                        format: "yyyy-mm-dd",
                        //daysOfWeekDisabled: [0, 6],
                        todayHighlight: true
                        //endDate: 'today'
                    });
    }
    catch(e){
        alert('Error JS in function insererLigne_Fin_Fact\n\n' + e.message);
    }
}

function insererLigne_Fin_Fact_Facture(){
    var cell, ligne;
 
    try{
         // récupère l'identifiant (id) de la table qui sera modifiée
        tableauFact = document.getElementById("factCde");    
        nbLignesFact = tableauFact.rows.length;    
        nbColonnesFact = tableauFact.rows[0].cells.length;        

        ligne = tableauFact.insertRow(-1); // création d'une ligne pour ajout en fin de table
        cell = ligne.insertCell(0);
        cell.innerHTML = " <input type='text' name='echeanceDate[]' id='echeanceDate" +nbLignesFact + "' />";
        cell = ligne.insertCell(1);
        cell.innerHTML = " <input type='text' name='date_reactu[]' id='date_reactu" +nbLignesFact + "' />";
        cell = ligne.insertCell(2);
        cell.innerHTML = " <input type='text' name='intitule[]'  />";         
        cell = ligne.insertCell(3);
        cell.innerHTML = " <input type='double' name='montantPrevisionnel[]' />";         
        cell = ligne.insertCell(4);
        cell.innerHTML = " <input type='double' name='devise[]' list='devise' />";
        cell = ligne.insertCell(5);
        cell.innerHTML = " <td><input type='text' name='PContrat[]' onclick='verifChampDynClear(this)' />"; 
//        cell = ligne.insertCell(6);
//        cell.innerHTML = " <a href='supprimer.php' >Supprimer</a>";         
        //alert("Nombre de lignes " + nbLignesFact + "colonnes " +nbColonnesFact);    
        
        $("#echeanceDate" + nbLignesFact).datepicker({
                        autoclose: true,
                        //format: "dd/mm/yyyy",
                        format: "yyyy-mm-dd",
                        //daysOfWeekDisabled: [0, 6],
                        todayHighlight: true
                        //endDate: 'today'
                    });
                    
        $("#date_reactu" + nbLignesFact).datepicker({
                        autoclose: true,
                        //format: "dd/mm/yyyy",
                        format: "yyyy-mm-dd",
                        //daysOfWeekDisabled: [0, 6],
                        todayHighlight: true
                        //endDate: 'today'
                    });            
    }
    catch(e){
        alert('Error JS in function insererLigne_Fin_Fact\n\n' + e.message);
    }
}

function toggleDetails($task){
    try{
        $(".details", $task).slideToggle();
        $("button.toggle-details", $task).toggleClass("expanded");
        //alert('OUUUUUUUUUU');
    }
    catch(e){
        alert('pfffff' + e.message);
    }
}

function insererLigne_Fin_TS(){
    var cell, ligne;
 
    try{
         // récupère l'identifiant (id) de la table qui sera modifiée
        tableauTS = document.getElementById("TSTable");    
        nbLignesTS = tableauTS.rows.length;    
        nbColonnesTS = tableauTS.rows[0].cells.length;        

        ligne = tableauTS.insertRow(-1); // création d'une ligne pour ajout en fin de table
        cell = ligne.insertCell(0);
        cell.innerHTML = " <button name='previsualise[]' class='toggle-details' onclick='toggleDetails()'>^</button>";
        cell = ligne.insertCell(1);
        cell.innerHTML = " <input type='date' name='dateList[]' list='dateList'  />";
        cell = ligne.insertCell(2);
        cell.innerHTML = " <input type='text' name='cdeMissionList[]' list='cdeMissionList'  />";
        cell = ligne.insertCell(3);
        cell.innerHTML = " <input type='text' name='dptList[]' list='dptList' />";         
        cell = ligne.insertCell(4);
        cell.innerHTML = " <td><input type='text' name='heure[]'  />";         
        cell = ligne.insertCell(5);
        cell.innerHTML = " <input type='text' name='description[]' />";
//        cell = ligne.insertCell(6);
//        cell.innerHTML = " <a href='supprimer.php' >Supprimer</a>";         
        //alert("Nombre de lignes " + nbLignesTS + "colonnes " +nbColonnesTS);                                 
                
    }
    catch(e){
        alert('Error JS in function insererLigne_Fin_TS\n\n' + e.message);
    }
}

function insererLigne_Fin_Depense(){
    var cell, ligne;
 
    try{
         // récupère l'identifiant (id) de la table qui sera modifiée
        tableauDep = document.getElementById("tableDepense");    
        nbLignesDep = tableauDep.rows.length;    
        nbColonnesDep = tableauDep.rows[0].cells.length;        

        ligne = tableauDep.insertRow(-1); // création d'une ligne pour ajout en fin de table
        cell = ligne.insertCell(0);
        cell.innerHTML = " <input type='text' name='categList[]' list='categList' />";
        cell = ligne.insertCell(1);
        cell.innerHTML = " <input type='text' name='montantMGA[]' />";
        cell = ligne.insertCell(2);
        cell.innerHTML = " <input type='text' name='desc[]' />";                                
        //alert("Nombre de lignes " + nbLignesDep + "colonnes " +nbColonnesDep);       
    }
    catch(e){
        alert('Error JS in function insererLigne_Fin\n\n' + e.message);
    }
}


function verif_champ(mot){
    if (mot===""){
        alert("un champs n'est pas rempli");
        return false;
    }
    return true;
}



function formhash(form, password) {
    // Créez un nouvel élément input, il nous servira de champ pour le mot de passe hashé.
    var p = document.createElement("input");
 
    // Ajoutez le nouvel élément au formulaire. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Assurez-vous que le mot de passe sous sa forme de texte brut n’est pas envoyé au script. 
    password.value = "";
 
    // Finissez en envoyant le formulaire. 
    form.submit();
}

function afficheDepense(reference){
    try{
        alert("Ref " + reference); 
    }
    catch(e){
        alert('Error JS in function insererLigne_Fin_Cons\n\n' + e.message);
    }
}

function saveTaskList(){
    if (timeoutId) clearTimeout(timeoutId);
    setStatus("saving changes...", true);

    timeoutId = setTimeout(function(){
        appStorage.setValue("taskList", taskList.getTasks());
        timeoutId = 0;
        setStatus("changes saved.");
    },
    2000);
}

function addTask(){
    var taskName = $("#new-task-name").val();
    if (taskName)
    {
        var task = new Task(taskName);
        taskList.addTask(task);
        appStorage.setValue("nextTaskId", Task.nextTaskId);
        addTaskElement(task);
        saveTaskList();
        // Reset the field
        $("#new-task-name").val("").focus();
    }
}

 function addTaskElement(task){
    var $task = $("#TSTable .task").clone();
    $task.data("task-id", task.id);
    $("span.task-name", $task).text(task.name);

    // Populate all of the details fields
    $(".details input, .details select", $task).each(function(i, e) {
        var $input = $(this);
        var fieldName = $input.data("field");
        $input.val(task[fieldName]);
    });

    $("#task-list").append($task);

    // Task events
    $task.click(function() { onSelectTask($task); });

   
    // Task name events
    $("span.task-name", $task).click(function() { onEditTaskName($(this)); });
    $("input.task-name", $task).change(function() { onChangeTaskName($(this)); })
                          .blur(function() { $(this).hide().siblings("span.task-name").show(); });

    // Task details events
    $(".details input, .details select", $task).change(function() { onChangeTaskDetails(task.id, $(this)); });
}
    
