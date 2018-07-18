// JavaScript Document
// Ajax c'est g&eacute;nial--------------------
function getRequeteHttp(){
var requeteHttp;
if (window.XMLHttpRequest){
	requeteHttp = new XMLHttpRequest();
	if (requeteHttp.overrideMimeType){
		requeteHttp.overrideMimeType('text/xml');
	}	
}
else if (window.ActiveXObject){
	try{
		requeteHttp = new ActiveXObject('Msxml2.XMLHTTP');
	}
	catch(e){
		try{
			requeteHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e){
			requeteHttp = null;
		}
	}
}
return requeteHttp;
}

//It's start here!, have fun*******//

function traiterReponseInfoPro(reponse){
	var prod = reponse.split('|');
	document.getElementById("pro").innerHTML 	    = prod[0];
	document.getElementById("libpro").innerHTML 	= prod[1];
	document.getElementById("HTpro").innerHTML 	    = prod[2];
	document.getElementById("TTCpro").innerHTML 	= prod[3];
	document.getElementById("qtepro").innerHTML 	= prod[4];
}
function getReponseInfoPro(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseInfoPro(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}
//les info_offre
function infoRequetePro(id){
	var id_resp = id.split('/');
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/infoOffre.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseInfoPro(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		requeteHttp.send('debut='+id_resp[1]+'&option=offre');
	}
	return;
}

function traiterReponseInfoType(reponse){
	var prod = reponse.split('|');
	document.getElementById("Codetype").innerHTML 		= prod[0];
	document.getElementById("Codetype1").innerHTML 		= prod[1];
	document.getElementById("Designtype").innerHTML 	= prod[2];
	document.getElementById("Designtype1").innerHTML 	= prod[3];
	document.getElementById("Mintype").innerHTML 		= prod[4];
	document.getElementById("Mintype1").innerHTML 		= prod[5];
	document.getElementById("Maxtype").innerHTML 		= prod[6];
	document.getElementById("Maxtype1").innerHTML 		= prod[7];
	document.getElementById("verifCode").innerHTML 		= prod[8];
}
function getReponseInfoType(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseInfoType(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}
//les info_Type
function infoRequeteType(id){
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/infooffre.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseInfoType(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		requeteHttp.send('debut='+id+'&option=type');
	}
	return;
}

function traiterReponseInfoCli(reponse){
	var prod = reponse.split('|');
	document.getElementById("Codecli").innerHTML 	= prod[0];
	document.getElementById("Designcli").innerHTML 	= prod[1];
	document.getElementById("Adrcli").innerHTML 	= prod[2];
	document.getElementById("Telcli").innerHTML 	= prod[3];
	document.getElementById("Villecli").innerHTML 	= prod[4];
	document.getElementById("Cpcli").innerHTML 		= prod[5];
	document.getElementById("Nifcli").innerHTML 	= prod[6];
	document.getElementById("Statcli").innerHTML 	= prod[7];
}

function getReponseInfoCli(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseInfoCli(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

//les info_Client
function infoRequeteCli(id){
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/infoOffre.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseInfoCli(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		requeteHttp.send('debut='+id+'&option=client');
	}
	return;
}

//Traitements de modif offre---
function modificationArt(){
		var i;
		for(i = 0; i < document.form.check.length; i++)
		if (document.form.check[i].checked==true)
			infoRequetePro(document.form.check[i].value);
		
}
//Traitements de modif Typeoffre---
function modificationType(){
		var i;
		for(i = 0; i < document.form.check.length; i++)
		if (document.form.check[i].checked==true)
			infoRequeteType(document.form.check[i].value);
		
}
//Traitements de modif Client---
function modificationCli(){
		var i;
		for(i = 0; i < document.form.check.length; i++)
		if (document.form.check[i].checked==true)
			infoRequeteCli(document.form.check[i].value);
		
}


//---cocher Typeoffre
function traiterReponseType(reponse,id){
	document.getElementById("ChoixType"+id).innerHTML = reponse;
}
	
function getReponseType(requeteHttp,id){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseType(requeteHttp.responseText,id);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}
	
function sendCheckedType(id,coche){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/Update.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseType(requeteHttp,id);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('id_resp'+id);
		idcode = sel.value;
		requeteHttp.send('debut='+idcode+'&test='+coche+'&option=type');
	}
	return;
}

//---cocher offre
function traiterReponsePro(reponse,id){
	document.getElementById("ChoixPro"+id).innerHTML = reponse;
}
	
function getReponsePro(requeteHttp,id){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponsePro(requeteHttp.responseText,id);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}
	
function sendCheckedPro(id,coche){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/Update.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponsePro(requeteHttp,id);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('NumPro'+id);
		idcode = sel.value;
		requeteHttp.send('debut='+idcode+'&test='+coche+'&option=offre');
	}
	return;
}

//---cocher Stock
function traiterReponseStock(reponse,id){
	document.getElementById("ChoixPro"+id).innerHTML = reponse;
}
	
function getReponseStock(requeteHttp,id){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseStock(requeteHttp.responseText,id);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}
	
function sendChangedPro(id,coche){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/Update.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseStock(requeteHttp,id);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('NumPro'+id);
		idcode = sel.value;
		requeteHttp.send('debut='+idcode+'&test='+coche+'&option=stock');
	}
	return;
}

//---cocher Client
function traiterReponseCli(reponse,id){
	var cli = reponse.split('-');
	document.getElementById("ChoixCli"+id).innerHTML = cli[0];
	document.getElementById("facture").innerHTML = cli[1];	
}
	
function getReponseCli(requeteHttp,id){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseCli(requeteHttp.responseText,id);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}
	
function sendCheckedCli(id,coche,user){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/update.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseCli(requeteHttp,id);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('NumCli'+id);
		idcode = sel.value;
		requeteHttp.send('debut='+idcode+'&test='+coche+'&option=client&user='+user);
	}
	return;
}

// delete offre, Client, Type
function supprimerArt(id,optype,login){
	if (optype=='offre'){
		var id_resp = id.split('/');
		var id1 = parseInt(id_resp[1].substr(id_resp[0].length,id_resp[1].length));
             //Ex&eacute;cution du script PHP avec Ajax  
             $('#liste tr[id="commentaire' + id_resp[1] + '"] td').css({  
                         'backgroundImage': 'none',  
                         'backgroundColor': '#ebe9e7',  
             });  
             $('#liste tr[id="commentaire' + id_resp[1] + '"] td').animate({  
                         'backgroundColor': '#ebe9e7',  
                         'color': '#941010'  
             }, 1000);  
			 var diag = confirm('Voulez-vous vraiment supprimer l\'offre ? ');
			if (diag==1){
             $.get('script.php', {
                 idsup:id_resp[1], action:'delete', option:optype, numuser:login //variable de type GET (on r&eacute;cupèrera la variable avec $_GET['idsup'])  
             }, function(data){  
                 //si la requête s'est bien déroulée  
                 if (data) {  
                     $('#liste tr[id="commentaire' + id_resp[1] + '"] td').fadeTo("slow", 0, function(){  
                         $(this).hide();  
                     });  
					 document.getElementById('capt').innerHTML = 'Suppr&eacute;ssion r&eacute;ussite!';
                 } else{  
                     alert('Problème de connexion à la base de donn&eacute;e');  
                 }  
             });
			}
			else {
				$('#liste tr[id="commentaire' + id_resp[1] + '"] td').css({  
            	    	'backgroundImage': 'none',  
                		'backgroundColor': 'white',  
              	});
				document.getElementById('capt').innerHTML = '';
			}
	}
	else{
			$('#liste tr[id="commentaire' + id + '"] td').css({  
                         'backgroundImage': 'none',  
                         'backgroundColor': '#ebe9e7',  
             });  
             $('#liste tr[id="commentaire' + id + '"] td').animate({  
                         'backgroundColor': '#ebe9e7',  
                         'color': '#941010'  
             }, 1000); 
			if (optype=='client') var diag = confirm('Voulez-vous vraiment supprimer le client ? ');
			else var diag = confirm('Voulez-vous vraiment supprimer le type d\'offre ? ');
			if (diag==1){
             $.get('script.php', {
                 idsup:id, action:'delete', option:optype, numuser:login //variable de type GET (on r&eacute;cupèrera la variable avec $_GET['idsup'])  
             }, function(data){  
                 //si la requ&ecirc;te s'est bien d&eacute;roul&eacute;e  
                 if (data) {  
                     $('#liste tr[id="commentaire' + id + '"] td').fadeTo("slow", 0, function(){  
                         $(this).hide();  
                     });  
					 document.getElementById('capt').innerHTML = 'Suppr&eacute;ssion r&eacute;ussite!';
                 } else{  
                     alert('Problème de connexion à la base de donn&eacute;e');  
                 }  
             });
			}
			else {
				$('#liste tr[id="commentaire' + id + '"] td').css({  
            	    	'backgroundImage': 'none',  
                		'backgroundColor': 'white',  
              	});	
				document.getElementById('capt').innerHTML = '';
			}
	}		 
}  
function suppressionArt(option,login){
	var i ;
	for(i = 0; i < document.form.check.length; i++)
	if (document.form.check[i].checked==true){
		supprimerArt(document.form.check[i].value,option,login);
		document.form.check[i].checked = false;
	}
	if(option=='client') sendRequete1();// re-selection des clients
}

//event PU
function eventPU(id){
    $("#polHT"+id).hide();
	$("#valHT"+id).fadeIn('slow');
	$("#polTTC"+id).hide();
	$("#valTTC"+id).fadeIn('slow');
}

//reset stock update
function resetStock(){
	var i ;
	for(i = 0; i < document.tableau.check.length; i++)
	  if(document.tableau.check[i].checked==true){
		var num = document.tableau.check[i].value;
		var id_offre = num.split('/');
		var libelle = document.getElementById("LibPro"+id_offre[1]).value; 
             $('#liste tr[id="commentaire' + id_offre[1] + '"] td').css({  
                         'backgroundImage': 'none',  
                         'backgroundColor': '#ebe9e7',  
             });  
             $('#liste tr[id="commentaire' + id_offre[1] + '"] td').animate({  
                         'backgroundColor': '#ebe9e7',  
                         'color': '#941010'  
             }, 1000);  
	    var cf = confirm("Vous voulez vraiment annuler pour l'offre \""+libelle+"\" ?");
        if (cf==1) {
			document.getElementById("Depot"+id_offre[1]).value = document.getElementById("Depot0"+id_offre[1]).value;
			document.getElementById("Mag"+id_offre[1]).value   = document.getElementById("Mag0"+id_offre[1]).value;
			sendChangedPro(id_offre[1],1);
			$('#liste tr[id="commentaire' + id_offre[1] + '"] td').css({  
            	    	'backgroundImage': 'none',  
                		'backgroundColor': 'white',  
            });	
			$('#liste tr[id="commentaire' + id_offre[1] + '"] td[id="qty"]').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#CCCC99',  
		    });
			$("#valHT"+id_offre[1]).hide();
	        $("#polHT"+id_offre[1]).fadeIn();
	        $("#valTTC"+id_offre[1]).hide();
	        $("#polTTC"+id_offre[1]).fadeIn();
			document.getElementById('capt').innerHTML = '';
		}
	}
}

function verifTotal(id){
  var depot = parseInt(document.getElementById("Depot"+id).value);
  var mag   = parseInt(document.getElementById("Mag"+id).value);
  var stock = parseInt(document.getElementById("Stock"+id).value);
  som = mag+depot;
  if (stock!=som){
    alert("La somme ne donne pas la quantite total. Veuillez réessayer!");
	document.getElementById("Depot"+id).value = document.getElementById("Depot0"+id).value;
	document.getElementById("Mag"+id).value   = document.getElementById("Mag0"+id).value;
	return (false);
  }
  else return (true);
}

//go stock update
function goStock(login){
	var i ;
	for(i = 0; i < document.tableau.check.length; i++)
	  if (document.tableau.check[i].checked==true){
		var num = document.tableau.check[i].value;
		var id_offre = num.split('/');
		var libelle = document.getElementById("LibPro"+id_offre[1]).value;
		$('#liste tr[id="commentaire' + id_offre[1] + '"] td').css({  
                         'backgroundImage': 'none',  
                         'backgroundColor': '#ebe9e7',  
         });  
		$('#liste tr[id="commentaire' + id_offre[1] + '"] td').animate({  
					 'backgroundColor': '#ebe9e7',  
					 'color': '#941010'  
		 }, 1000);
		if (!verifTotal(id_offre[1])) {
			sendChangedPro(id_offre[1],1);
			$('#liste tr[id="commentaire' + id_offre[1] + '"] td').css({  
            	    	'backgroundImage': 'none',  
                		'backgroundColor': 'white',  
              	});	
			$('#liste tr[id="commentaire' + id_offre[1] + '"] td[id="qty"]').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#CCCC99',  
		        });
			$("#valHT"+id_offre[1]).hide();
	        $("#polHT"+id_offre[1]).fadeIn();
	        $("#valTTC"+id_offre[1]).hide();
	        $("#polTTC"+id_offre[1]).fadeIn();
		}
		else{
	    var cf = confirm("Vous voulez vraiment modifier le stock de \""+libelle+"\" ?");
        if (cf==1) {
	      var depot = document.getElementById("Depot"+id_offre[1]).value;
	      var mag   = document.getElementById("Mag"+id_offre[1]).value;
		  var ht   = document.getElementById("HTPro"+id_offre[1]).value;
		  var ttc   = document.getElementById("TTCPro"+id_offre[1]).value;
          $.get('script.php', {
		     idsup:id_offre[1], qte_dpt:depot, qte_mag:mag, pu_ttc:ttc, pu_ht:ht, action:'update', option:'stock', numuser:login 
			 //variable de type GET (on r&eacute;cupèrera la variable avec $_GET['idsup'])  
	         }, function(data){  
		     //si la requête s'est bien déroulée  
		     if (data) {
				 sendChangedPro(id_offre[1],1);
				 document.getElementById('capt').innerHTML = 'Modification r&eacute;ussie!';
			 }
			   else alert('Problème de conn&eacute;xion &agrave; la base de donn&eacute;e');  
	      });
	    }
		else{
			document.getElementById("Depot"+id_offre[1]).value = document.getElementById("Depot0"+id_offre[1]).value;
			document.getElementById("Mag"+id_offre[1]).value   = document.getElementById("Mag0"+id_offre[1]).value;
			sendChangedPro(id_offre[1],1);
			$('#liste tr[id="commentaire' + id_offre[1] + '"] td').css({  
            	    	'backgroundImage': 'none',  
                		'backgroundColor': 'white',  
              	});	
			$('#liste tr[id="commentaire' + id_offre[1] + '"] td[id="qty"]').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#CCCC99',  
		        });
			$("#valHT"+id_offre[1]).hide();
	        $("#polHT"+id_offre[1]).fadeIn();
	        $("#valTTC"+id_offre[1]).hide();
	        $("#polTTC"+id_offre[1]).fadeIn();
			document.getElementById('capt').innerHTML = '';
		}
		}
	  }
}

//regler echeance client
function reglerCli(id,rouge,num,login){
	 //Ex&eacute;cution du script PHP avec Ajax  
	 $('#liste tr[id="commentaire' + id + '"] td').css({  
				 'backgroundImage': 'none',  
				 'backgroundColor': '#ebe9e7',  
	 });  
	 $('#liste tr[id="commentaire' + id + '"] td').animate({  
				 'backgroundColor': '#ebe9e7',  
				 'color': '#941010'  
	 }, 1000);  
	 var diag = confirm('Voulez-vous vraiment regler l\'echeance du client ? ');
	if (diag==1){
	 $.get('script.php', {
		 idsup:num, action:'delete', option:'echeanceCli', numuser:login //variable de type GET (on r&eacute;cupèrera la variable avec $_GET['idsup'])  
	 }, function(data){  
		 //si la requête s'est bien déroulée  
		 if (data) {  
			 $('#liste tr[id="commentaire' + id + '"] td').fadeTo("slow", 0, function(){  
				 $(this).hide();  
			 });  
			 document.getElementById('capt').innerHTML = 'Ech&eacute;ance regl&eacute;e!';
		 } else{  
			 alert('Problème de connexion à la base de donn&eacute;e');  
		 }  
	 });
	}
	else {
	   if(rouge!='rouge')
		$('#liste tr[id="commentaire' + id + '"] td').css({  
				'backgroundImage': 'none',  
				'backgroundColor': 'white',  
		});
	    else{
		  $('#liste tr[id="commentaire' + id + '"] td').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#FFC2A6',  
		  });
          $('#payer' + id).css({  
				'backgroundImage': 'none',  
				'backgroundColor': 'white',  
		  });		  
		}
		document.getElementById('capt').innerHTML = '';
	}
}

//regler echeance fournisseur
function reglerFrs(id,rouge,num,login){
	 //Ex&eacute;cution du script PHP avec Ajax  
	 $('#liste tr[id="commentaire' + id + '"] td').css({  
				 'backgroundImage': 'none',  
				 'backgroundColor': '#ebe9e7',  
	 });  
	 $('#liste tr[id="commentaire' + id + '"] td').animate({  
				 'backgroundColor': '#ebe9e7',  
				 'color': '#941010'  
	 }, 1000);  
	 var diag = confirm('Voulez-vous vraiment regler l\'echeance du fournisseur ? ');
	if (diag==1){
	 $.get('script.php', {
		 idsup:num, action:'delete', option:'echeanceFrs', numuser:login //variable de type GET (on r&eacute;cupèrera la variable avec $_GET['idsup'])  
	 }, function(data){  
		 //si la requête s'est bien déroulée  
		 if (data) {  
			 $('#liste tr[id="commentaire' + id + '"] td').fadeTo("slow", 0, function(){  
				 $(this).hide();  
			 });  
			 document.getElementById('capt').innerHTML = 'Ech&eacute;ance regl&eacute;e!';
		 } else{  
			 alert('Problème de connexion à la base de donn&eacute;e');  
		 }  
	 });
	}
	else {
	   if(rouge!='rouge')
		$('#liste tr[id="commentaire' + id + '"] td').css({  
				'backgroundImage': 'none',  
				'backgroundColor': 'white',  
		});
	    else{
		  $('#liste tr[id="commentaire' + id + '"] td').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#FFC2A6',  
		  });
          $('#payer' + id).css({  
				'backgroundImage': 'none',  
				'backgroundColor': 'white',  
		  });		  
		}
		document.getElementById('capt').innerHTML = '';
	}
}