// JavaScript Document
//----------------------
/* FANTASTIC
* La chance souris aux imbéciles !!!
*  FANTASTIC
*/
// Ajax c'est génial--------------------
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

//Commande
function traiterReponseInfoCmd(reponse){
	document.getElementById("Codecmd").innerHTML 	= reponse;
}

function getReponseInfoCmd(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseInfoCmd(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}
//les info_Article
function infoRequeteCmd(id){
	var numtype = id.split('/');
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		if(document.getElementById("existcmd").value!=numtype[1]) {
		display('commande');
		requeteHttp.open('POST','data/infoArticleCmd.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseInfoCmd(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		requeteHttp.send('debut='+numtype[1]);
		}
	}
	return;
}
//Traitements de commande Client---
function commande(){
		var i;
		for(i = 0; i < document.form.check.length; i++)
		if (document.form.check[i].checked==true)
			infoRequeteCmd(document.form.check[i].value);
}

//Si exist commande
function traiterReponseExistCmd(reponse){
	var data = reponse.split('-');
	if(data!='') {
		document.getElementById("command").innerHTML 	= data[2];
		alert('Cet article est en-cours de commande, fait le '+data[1]+' dont le reste est '+data[0]);
		sendCheckedPro(document.getElementById("existcmd").value,1);
	}
	commande();
	//alert(reponse);
}

function getReponseExistCmd(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseExistCmd(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}

function findArticleCmd(id){
	var numtype = id.split('/');
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
	requeteHttp.open('POST','findArtCmd.php',true);//Ajax synchrone
	requeteHttp.onreadystatechange= function(){getReponseExistCmd(requeteHttp);};
	requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	requeteHttp.send('code='+numtype[1]);
	}
	return;
}

function existCmd(){
		var i;
		for(i = 0; i < document.form.check.length; i++)
		if (document.form.check[i].checked==true)
			findArticleCmd(document.form.check[i].value)
}

//Reception
function traiterReponseInfoRecep(reponse){
	document.getElementById("Coderecep").innerHTML 	= reponse;
}

function getReponseInfoRecep(requeteHttp){
	if (requeteHttp.readyState==4){
		if (requeteHttp.status==200){
			traiterReponseInfoRecep(requeteHttp.responseText);
		}
		else{
			alert('La requ&ecirc;te a mal tourn&eacute;e.');
		}
	}
}
//les info_Article
function infoRequeteRecep(id){
	var numtype = id.split('/');
	var requeteHttp = getRequeteHttp();
	if (requeteHttp==null){
		alert("Impossible d'utiliser Ajax ici");
	}
	else {
		requeteHttp.open('POST','data/infoArticleRecep.php',true);//Ajax synchrone
		requeteHttp.onreadystatechange= function(){getReponseInfoRecep(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		requeteHttp.send('debut='+numtype[1]);
	}
	return;
}
//Traitements de commande Client---
function reception(){
		var i;
		for(i = 0; i < document.form.check.length; i++)
		if (document.form.check[i].checked==true)
			infoRequeteRecep(document.form.check[i].value)
}

