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

//traitement --- //
/****---- hover&out ----****/
//Article
function surpasse(id,rouge){
	if(rouge=='rouge'){
		  $('#liste tr[id="commentaire' + id + '"] td').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#FFC2A6',  
		  });
		  $('#liste tr[id="commentaire' + id + '"] td[id="qty"]').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#FFC2A6',  
		  });
	}
	  else {
	    $('#liste tr[id="commentaire' + id + '"] td').css({  
            	    	'backgroundImage': 'none',  
                		'backgroundColor': 'white',  
         });
		$('#liste tr[id="commentaire' + id + '"] td[id="qty"]').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#CCCC99',  
		  });
	  }
}
function survole(id,rouge){
    if(rouge=='rouge')
		  $('#liste tr[id="commentaire' + id + '"] td').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#FFC2A6',  
		  });
	  else
	  $('#liste tr[id="commentaire' + id + '"] td').css({  
                         'backgroundImage': 'none',  
                         'backgroundColor': '#ebe9e7',  
             });
}
//Client
function surpasseCli(id){
	$('#liste tr[id="commentaire' + id + '"] td').css({  
            	    	'backgroundImage': 'none',  
                		'backgroundColor': 'white',  
           	 });
}
function survoleCli(id){
	$('#liste tr[id="commentaire' + id + '"] td').css({  
                         'backgroundImage': 'none',  
                         'backgroundColor': '#ebe9e7',  
             });  
}
//TypeArtcile
function surpasseType(id){
	$('#liste tr[id="commentaire' + id + '"] td').css({  
            	    	'backgroundImage': 'none',  
                		'backgroundColor': 'white',  
           	 });
	$('#liste tr[id="commentaire' + id + '"] td[id="qty"]').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#CCCC99',  
		  });
}
function surpasseTypeS(id,color){
	if(color=='color'){
		$('#liste tr[id="commentaire' + id + '"] td').css({  
            	    	'backgroundImage': 'none',  
                		'backgroundColor': '#D2FFE9',  
        });
		$('#liste tr[id="commentaire' + id + '"] td[id="qty"]').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#CCCC99',  
		});
	}else{
		$('#liste tr[id="commentaire' + id + '"] td').css({  
            	    	'backgroundImage': 'none',  
                		'backgroundColor': 'white',  
        });
		$('#liste tr[id="commentaire' + id + '"] td[id="qty"]').css({  
				'backgroundImage': 'none',  
				'backgroundColor': '#CCCC99',  
		});
	}
}

function survoleType(id){
	$('#liste tr[id="commentaire' + id + '"] td').css({  
                         'backgroundImage': 'none',  
                         'backgroundColor': '#ebe9e7',  
             });  
}

/* FANTASTIC
* La chance souris aux imb&eacute;ciles !!!
*  FANTASTIC
*/

//-----Type_article select
function traiterReponse(reponse){
	var nom = reponse.split('&');
	document.getElementById("code").innerHTML = nom[0];
	document.getElementById("enreg").innerHTML = nom[1];
}
	
function getReponse(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponse(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function sendRequete(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/select_type.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponse(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('Categpro');
		idcode = sel.value;
		requeteHttp.send('debut='+idcode);
	}
	return;
}

//-----Client select
function traiterReponse1(reponse){
	document.getElementById("select_cli").innerHTML = reponse;
}
	
function getReponse1(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponse1(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function sendRequete1(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/select_client.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponse1(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		requeteHttp.send('debut=""');
	}
	return;
}

//-----Type_article search
function traiterReponseSearch(reponse){
	document.getElementById("liste").innerHTML = reponse;
}
	
function getReponseSearch(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseSearch(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function sendRequeteSearch(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/SearchByResp.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseSearch(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('Categsearch');
		idcode = sel.value;
		requeteHttp.send('debut='+idcode);
	}
	return;
}

//-----Type_article stock search
function traiterReponseSearchStock(reponse){
	var val = reponse.split('@');
	document.getElementById("liste").innerHTML       = val[0];
	document.getElementById("print").innerHTML = val[1];
}
	
function getReponseSearchStock(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseSearchStock(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function sendRequeteSearchStock(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/SearchByTypeStock.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseSearchStock(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('Categsearch');
		idcode = sel.value;
		requeteHttp.send('debut='+idcode);
	}
	return;
}

//-----Type_article insert
function traiterReponseInsertType(reponse,id){
	var val = reponse.split('&');
	switch (id){
		case 1 : 	document.getElementById("Numtest").innerHTML 	= val[0];
					document.getElementById("getTest"+id).innerHTML = val[1];
		break;
		case 2 : 	document.getElementById("Typetest").innerHTML 	= val[0]; 
					document.getElementById("getTest"+id).innerHTML = val[1]; 
		break;
		case 3 : 	document.getElementById("Mintest").innerHTML 	= val[0];
					document.getElementById("getTest"+id).innerHTML = val[1];
		break;
		case 4 : 	document.getElementById("Maxtest").innerHTML 	= val[0];
					document.getElementById("getTest"+id).innerHTML = val[1];
		break;
		case 5 : {
				document.getElementById("Numtest").innerHTML  = val[0]; 
				document.getElementById("Typetest").innerHTML = val[0]; 
				document.getElementById("Mintest").innerHTML  = val[0]; 
				document.getElementById("Maxtest").innerHTML  = val[0]; 
				for(var i=1;i<id;i++)
					document.getElementById("getTest"+i).innerHTML  = val[0];
				break;
		}
	}
}
	
function getReponseInsertType(requeteHttp,id){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseInsertType(requeteHttp.responseText,id);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function sendRequeteInsertType(id){
	var Num,Type;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','moteur/insertType.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseInsertType(requeteHttp,id);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		Num  = document.getElementById('Num').value;
		Type = document.getElementById('Type').value;
		Min  = document.getElementById('Min').value;
		Max  = document.getElementById('Max').value;
		switch(id){
			case 1 : requeteHttp.send('Code='+id+'&Num='+Num);  break;
			case 2 : requeteHttp.send('Code='+id+'&Type='+Type); break;
			case 3 : requeteHttp.send('Code='+id+'&Min='+Min); break;
			case 4 : requeteHttp.send('Code='+id+'&Max='+Max); break;
			case 5 : requeteHttp.send('Code='+id); break;
		}
		//requeteHttp.send('Num='+Num+'&Type='+Type+'&Min='+Min+'&Max='+Max);
	}
	return;
}

//-----Type_article update
function traiterReponseUpdateType(reponse,id){
	var val = reponse.split('&');
	switch (id){
		case 1 : 	document.getElementById("NumtestMod").innerHTML 	= val[0];
					document.getElementById("Codetype").innerHTML 		= val[1];
		break;
		case 2 : 	document.getElementById("TypetestMod").innerHTML 	= val[0]; 
					document.getElementById("Designtype").innerHTML 	= val[1]; 
		break;
		case 3 : 	document.getElementById("MintestMod").innerHTML 	= val[0];
					document.getElementById("Mintype").innerHTML	 	= val[1];
		break;
		case 4 : 	document.getElementById("MaxtestMod").innerHTML 	= val[0];
					document.getElementById("Maxtype").innerHTML 		= val[1];
		break;
	}
}
	
function getReponseUpdateType(requeteHttp,id){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseUpdateType(requeteHttp.responseText,id);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function sendRequeteUpdateType(id){
	var Num,Type;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','moteur/updateType.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseUpdateType(requeteHttp,id);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		Num  = document.getElementById('NumtypeA').value;
		Type = document.getElementById('TypeA').value;
		Min  = document.getElementById('MinA').value;
		Max  = document.getElementById('MaxA').value;
		Verif  = document.getElementById('CodeA').value;
		switch(id){
			case 1 : requeteHttp.send('Code='+id+'&Num='+Num+'&Verif='+Verif);  break;
			case 2 : requeteHttp.send('Code='+id+'&Type='+Type); break;
			case 3 : requeteHttp.send('Code='+id+'&Num='+Num+'&Min='+Min); break;
			case 4 : requeteHttp.send('Code='+id+'&Max='+Max); break;
		}
	}
	return;
}

//-----Article insert
function traiterReponseInsertArt(reponse,id){
	var val = reponse.split('&');
	switch (id){
		case 1 : 	document.getElementById("Libtest").innerHTML 	= val[0];
					document.getElementById("getTest"+id).innerHTML = val[1];
		break;
		case 2 : 	document.getElementById("PuHTtest").innerHTML 	= val[0]; 
					document.getElementById("getTest"+id).innerHTML = val[1]; 
		break;
		case 3 : 	document.getElementById("PuTTCtest").innerHTML 	= val[0];
					document.getElementById("getTest"+id).innerHTML = val[1];
		break;
		case 4 : 	document.getElementById("Stocktest").innerHTML 	= val[0];
					document.getElementById("getTest"+id).innerHTML = val[1];
		break;
		case 5 : {
				document.getElementById("Libtest").innerHTML  = val[0]; 
				document.getElementById("PuHTtest").innerHTML = val[0]; 
				document.getElementById("PuTTCtest").innerHTML  = val[0]; 
				document.getElementById("Stocktest").innerHTML  = val[0]; 
				for(var i=1;i<id;i++)
					document.getElementById("getTest"+i).innerHTML  = val[0];
				break;
		}
	}
}
	
function getReponseInsertArt(requeteHttp,id){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseInsertArt(requeteHttp.responseText,id);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function sendRequeteInsertArt(id){
	var Num,Type;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','moteur/insertArticle.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseInsertArt(requeteHttp,id);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		Lib    = document.getElementById('Designpro').value;
		PuHT   = document.getElementById('PuHTpro').value;
		PuTTC  = document.getElementById('PuTTCpro').value;
		Stock  = document.getElementById('Stockpro').value;
		switch(id){
			case 1 : requeteHttp.send('Code='+id+'&Lib='+Lib);  break;
			case 2 : requeteHttp.send('Code='+id+'&PuHT='+PuHT); break;
			case 3 : requeteHttp.send('Code='+id+'&PuTTC='+PuTTC); break;
			case 4 : requeteHttp.send('Code='+id+'&Stock='+Stock); break;
			case 5 : requeteHttp.send('Code='+id); break;
		}
	}
	return;
}


//-----Article insert comptable
function traiterReponseInsertArtCompt(reponse,id){
	var val = reponse.split('&');
	switch (id){
		case 1 : 	document.getElementById("Libtest").innerHTML 	= val[0];
					document.getElementById("getTest"+id).innerHTML = val[1];
		break;
		case 2 : 	document.getElementById("PuHTtest").innerHTML 	= val[0]; 
					document.getElementById("getTest"+id).innerHTML = val[1]; 
		break;
		case 3 : 	document.getElementById("PuTTCtest").innerHTML 	= val[0];
					document.getElementById("getTest"+id).innerHTML = val[1];
		break;
		case 5 : {
				document.getElementById("Libtest").innerHTML  = val[0]; 
				document.getElementById("PuHTtest").innerHTML = val[0]; 
				document.getElementById("PuTTCtest").innerHTML  = val[0];  
				for(var i=1;i<id;i++)
					document.getElementById("getTest"+i).innerHTML  = val[0];
				break;
		}
	}
}
	
function getInsertArt(requeteHttp,id){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseInsertArtCompt(requeteHttp.responseText,id);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function sendInsertArt(id){
	var Num,Type;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','moteur/insertArticle.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getInsertArt(requeteHttp,id);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		Lib    = document.getElementById('Designpro').value;
		PuHT   = document.getElementById('PuHTpro').value;
		PuTTC  = document.getElementById('PuTTCpro').value;
		switch(id){
			case 1 : requeteHttp.send('Code='+id+'&Lib='+Lib);  break;
			case 2 : requeteHttp.send('Code='+id+'&PuHT='+PuHT); break;
			case 3 : requeteHttp.send('Code='+id+'&PuTTC='+PuTTC); break;
			case 5 : requeteHttp.send('Code='+id); break;
		}
	}
	return;
}

//-----Client insert
function traiterReponseInsertClient(reponse,id){
	var Nom, Telephone, Ville, Nif, Stat;
	var val = reponse.split('&');
	Nom  		= document.getElementById('Nom').value;
	Telephone 	= document.getElementById('Telephone').value;
	Ville  		= document.getElementById('Ville').value;
	Nif			= document.getElementById('Nif').value;
	Stat  		= document.getElementById('Stat').value;
	
	switch (id){
		case 1 : 	document.getElementById("Nomtest").innerHTML 	= val[0];
					//if (Ville!='')
						//document.getElementById("Villetest").innerHTML 	= val[0];
					//else document.getElementById("Villetest").innerHTML 	= '';
					document.getElementById("getTest").innerHTML 	= val[1];
		break;
		case 2 : 	if (Telephone!=''||Nif!=''||Stat!=''){
						document.getElementById("Teltest").innerHTML 	= val[0]; 
						document.getElementById("Niftest").innerHTML 	= val[0]; 
						document.getElementById("Statest").innerHTML 	= val[0]; 
					}
					document.getElementById("getTest").innerHTML 	= val[1]; 
		break;
		case 0 : {
				document.getElementById("Nomtest").innerHTML  	= val[0]; 
				document.getElementById("Teltest").innerHTML 	= val[0]; 
				document.getElementById("Villetest").innerHTML  = val[0]; 
				document.getElementById("Niftest").innerHTML  	= val[0]; 
				document.getElementById("Statest").innerHTML  	= val[0]; 
				document.getElementById("getTest").innerHTML  = val[0];
		break;
		}
	}
}
	
function getReponseInsertClient(requeteHttp,id){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseInsertClient(requeteHttp.responseText,id);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function sendRequeteInsertClient(id){
	var Nom, Telephone, Ville, Nif, Stat;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','moteur/insertClient.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseInsertClient(requeteHttp,id);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		Nom  		= document.getElementById('Nom').value;
		Telephone 	= document.getElementById('Telephone').value;
		Ville  		= document.getElementById('Ville').value;
		Nif			= document.getElementById('Nif').value;
		Stat  		= document.getElementById('Stat').value;
		switch(id){
			case 1 : requeteHttp.send('Code='+id+'&Nom='+Nom+'&Ville='+Ville);  break;
			case 2 : requeteHttp.send('Code='+id+'&Telephone='+Telephone+'&Nif='+Nif+'&Stat='+Stat); break;
			case 0 : requeteHttp.send('Code='+id); break;
		}
	}
	return;
}

