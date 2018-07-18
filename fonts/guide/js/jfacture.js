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


function traiterReponseInfo(reponse,id){
	document.getElementById("Designpro"+id).innerHTML 	= reponse;

}

function getReponseInfo(requeteHttp,id){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseInfo(requeteHttp.responseText,id);
		}
		else{
			alert('La requête a mal tournée.');
		}
	}
}

//les info
function sendFactDesign(id){
	var design;
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/infoLibelle.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseInfo(requeteHttp,id);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		design = document.getElementById('Designpro'+id);
		requeteHttp.send('debut='+id);
	}
	return;
}
