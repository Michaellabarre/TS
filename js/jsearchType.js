// JavaScript Document

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

//---chercher TypeArticle
function traiterSearchType(reponse){
	document.getElementById("liste").innerHTML = reponse;
}
	
function getSearchType(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterSearchType(requeteHttp.responseText);
		}
		else{
			alert('Recherche inconnue.');
		}
	}
}
	
function sendSearch(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/SearchTypeName.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getSearchType(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('critere');
		idcode = sel.value;
		requeteHttp.send('debut='+idcode);
	}
	return;
}

//---chercher Article
function traiterSearchArt(reponse){
	document.getElementById("liste").innerHTML = reponse;
}
	
function getSearchArt(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterSearchArt(requeteHttp.responseText);
		}
		else{
			alert('Recherche inconnue.');
		}
	}
}
	
function sendSearchArt(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/SearchArticleName.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getSearchArt(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('critere');
		idcode = sel.value;
		requeteHttp.send('debut='+idcode);
	}
	return;
}

//---chercher Stock
function traiterSearchArtStock(reponse){
	var val = reponse.split('@');
	document.getElementById("liste").innerHTML = val[0];
	document.getElementById("print").innerHTML = val[1];
}
	
function getSearchArtStock(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterSearchArtStock(requeteHttp.responseText);
		}
		else{
			alert('Recherche inconnue.');
		}
	}
}
	
function sendSearchArtStock(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/SearchArticleNameStock.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getSearchArtStock(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('critere');
		idcode = sel.value;
		requeteHttp.send('debut='+idcode);
	}
	return;
}

//---chercher Client
function traiterSearchCli(reponse){
	document.getElementById("liste").innerHTML = reponse;
}
	
function getSearchCli(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterSearchCli(requeteHttp.responseText);
		}
		else{
			alert('Recherche inconnue.');
		}
	}
}
	
function sendSearchCli(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/SearchclientName.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getSearchCli(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('critere');
		idcode = sel.value;
		requeteHttp.send('debut='+idcode);
	}
	return;
}

//---chercher Echeance Cli
function traiterSearchEcheanceCli(reponse){
	document.getElementById("liste").innerHTML = reponse;
}
	
function getSearchEcheanceCli(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterSearchEcheanceCli(requeteHttp.responseText);
		}
		else{
			alert('Recherche inconnue.');
		}
	}
}
	
function sendSearchEcheanceCli(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/SearchEcheanceCli.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getSearchEcheanceCli(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('critere');
		idcode = sel.value;
		requeteHttp.send('debut='+idcode);
	}
	return;
}

//---chercher Echeance Frs
function traiterSearchEcheanceFrs(reponse){
	document.getElementById("liste").innerHTML = reponse;
}
	
function getSearchEcheanceFrs(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterSearchEcheanceFrs(requeteHttp.responseText);
		}
		else{
			alert('Recherche inconnue.');
		}
	}
}
	
function sendSearchEcheanceFrs(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/SearchEcheanceFrs.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getSearchEcheanceFrs(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('critere');
		idcode = sel.value;
		requeteHttp.send('debut='+idcode);
	}
	return;
}