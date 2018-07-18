// JavaScript Document
var current="";
function display(calque) {
	var mylayer=calque;
	if (document.all) {
		if (current!="") {document.all[current].style.visibility="hidden";}
		current=mylayer;
		if (mylayer!="") {document.all[current].style.visibility="visible";}
	}
	else{
	    if(document.layers) {
	  	if (current!="") {document.layers[current].visibility="hide";}
		current=mylayer;
		if (mylayer!="") {document.layers[current].visibility="show";}
	    }
		else{
		if (current!="") {document.getElementById(current).style.visibility="hidden";}
		current=mylayer;
		if (mylayer!="") {document.getElementById(current).style.visibility="visible";}
	    }
	}
}

function afficher(index) {
var monlayer=index;
if (document.all){document.all['image'].style.visibility="hidden";
				  document.all[monlayer].style.visibility="visible";
				  }
				  else{
				  	   if (document.layers){document.layers['image'].visibility="hide";
					   document.layers[monlayer].visibility="show";}
					   else{document.getElementById('image').style.visibility="hidden";
					   document.getElementById(monlayer).style.visibility="visible";}
					   }
} 

function effacer(index) {
var monlayer=index;
if (document.all){document.all[monlayer].style.visibility="hidden";
				  document.all['image'].style.visibility="visible";
				  }
				  else{
				  	   if (document.layers){document.layers[monlayer].visibility="hide";
					   document.layers['image'].visibility="show";}
					   else{document.getElementById(monlayer).style.visibility="hidden";
					   //document.getElementById('image').style.visibility="visible";
					   }
					   }
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
//fin menu !!

