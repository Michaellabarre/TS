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

//-----search fournisseur
function traiterReponseFrs(reponse){
	var nom = reponse.split('&');
	document.getElementById("liste").innerHTML = nom[0];
	document.getElementById("Num").value       = nom[1];
	document.getElementById("Nom").innerHTML   = nom[2];
	document.getElementById("Adr").innerHTML   = nom[3];
	document.getElementById("Tel").innerHTML   = nom[4];
	display('detail');
}
	
function getReponseFrs(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseFrs(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function sendRequeteSearchFrs(){
	var sel,idcode;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/SearchByFrs.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseFrs(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		sel = document.getElementById('NumFrs');
		idcode = sel.value;
		requeteHttp.send('debut='+idcode);
	}
	return;
}

//-----info suivi client
function traiterReponseSuivi(reponse){
	var nom = reponse.split('&');
	document.getElementById("Codecli").innerHTML   = nom[0];
	document.getElementById("Nomcli").innerHTML    = nom[1];
	document.getElementById("Adrcli").innerHTML    = nom[2];
	document.getElementById("Telcli").innerHTML    = nom[3];
	document.getElementById("Villecli").innerHTML  = nom[4];
	document.getElementById("Cpcli").innerHTML     = nom[5];
	document.getElementById("Nifcli").innerHTML    = nom[6];
	document.getElementById("Statcli").innerHTML   = nom[7];
	display('modify');
}
	
function getReponseSuivi(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseSuivi(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function infoSuivi(code){
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/suivi_client.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseSuivi(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		requeteHttp.send('debut='+code);
	}
	return;
}