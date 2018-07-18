function bez(pContainer, pX0, pY0, pX1, pY1, pX2, pY2, pX3, pY3, pPas) {
	var vCx = 3 * (pX1 - pX0);
	var vBx = 3 * (pX2 - pX1) - vCx;
	var vAx = pX3 - pX0 - vCx - vBx;
	var vCy = 3 * (pY1 - pY0);
	var vBy = 3 * (pY2 - pY1) - vCy;
	var vAy = pY3 - pY0 - vCy - vBy;
	
	var vPas2 = pPas * pPas;
	var vPas2M = Math.pow(pPas+2,2);
	var t = 0.1;
	var tMax = -1;
	var tMin = -1;
	var tP = 0;
	var vXP = pX0;
	var vYP = pY0;
	//var vCount = 0;
	//var vCountP = 0;
	while (t < 1) {
		//vCount++;
		var t2 = t*t;
		var t3 = t*t2;
		var vX = vAx * t3 + vBx * t2 + vCx * t + pX0;
		var vY = vAy * t3 + vBy * t2 + vCy * t + pY0;
		var vDist2 = Math.pow(vX-vXP,2) + Math.pow(vY-vYP,2);
		if(vDist2 > vPas2M) {
			tMax = t;
			t -= (tMin < 0) ? (t - tP) / 3 : (t - tMin) / 2;
		} else if(vDist2 < vPas2) {
			tMin = t;
			t += (tMax < 0) ? (t - tP) / 3 : (tMax - t) / 2;
		} else {
			drawPt(pContainer, vX, vY);
			tMin = t;
			t += (t - tP);
			tP = tMin;
			vXP = vX;
			vYP = vY;
			tMin = -1;
			tMax = -1;
			//vCountP++;
		}
	}
	//alert(vCount+ "-"+ vCountP);
}

function drawPt(pContainer, pX, pY){
	var vImg = document.createElement("img");
	vImg.height = 4;
	vImg.width = 4;
	vImg.src="../images/point.gif";
	with(vImg.style) {
		position = "absolute";
  	left =  String(pX - 2)+"px";
		top =  String(pY - 2)+"px";
	}
	pContainer.appendChild(vImg);
}

function placeVertical(pContainer) {
	var vContainerW = pContainer.offsetWidth;
	var vSommeHeight = 0;
	var vNbBlocs = 0;
	var vDiv = pContainer.firstChild;
	while(vDiv != null) {
		if(vDiv.nodeType==1) {
			var vMarge = vContainerW - vDiv.offsetWidth;
			if(vMarge>2) {
    		vDiv.style.left = String(vMarge/2) + "px";
			}
			vSommeHeight += vDiv.offsetHeight;
			vNbBlocs++;
		}
		vDiv = vDiv.nextSibling;
	}
	var vY = (pContainer.offsetHeight - vSommeHeight) / (vNbBlocs+1);
	vSommeHeight = 0;
	vDiv = pContainer.firstChild;
	while(vDiv != null) {
		if(vDiv.nodeType==1) {
			vSommeHeight += vY;
			vDiv.style.top = String(vSommeHeight) + "px";
			vSommeHeight += vDiv.offsetHeight;
		}
		vDiv = vDiv.nextSibling;
	}
}

function lieFilsParGauche(pPere, pX0, pY0, pContainer) {
	//alert("placeVertOK");
	var vX0=pX0;
	var vY0=pY0;
	if(pContainer.offsetLeft-pX0 >= 80) {
		//Courbe à 2 segments
		//Calcul du milieu du container
		var vY4 = pContainer.offsetTop+pContainer.offsetHeight/2;
		//Calcul du décalage
		var vDec = vY4-pY0;
		if(vDec>100) {
			vY4 = pY0+50;
		} else if(vDec<-100){
			vY4 = pY0-50;
		} else if(vDec>10 || vDec<-10) {
			vY4 = pY0+vDec/2;
		} else {
			vY4 = pY0;
		}
		var vX4 = pX0+(pContainer.offsetLeft-pX0)*0.6;
		var vX2 = pX0+(vX4-pX0)/2;
		bez(pPere, pX0,pY0,vX2,pY0,vX2,vY4,vX4,vY4, 7);
		vX0 = vX4;
		vY0 = vY4;
	} else {
		//Courbes uniques
		vX0 += 5;
	}
	var vXC = pContainer.offsetLeft;
	var vYC = pContainer.offsetTop;
	var vDiv = pContainer.firstChild;
	while(vDiv != null) {
		if(vDiv.nodeType==1) {
			var vX4 = vXC + vDiv.offsetLeft - 4;
			var vY4 = vYC + vDiv.offsetTop+vDiv.offsetHeight/2;
			bez(pPere, vX0,vY0,vX0,vY0,vXC,vY4,vX4,vY4, 9);
		}
		vDiv = vDiv.nextSibling;
	}	
}

function clicBloc (pPere) {
	var vId = pPere.id;
	var vIdLength = vId.length;
	//Masque les cadres
	var vDiv = document.getElementById("plan").firstChild;
	while(vDiv != null) {
		if(vDiv.nodeType==1 && vDiv.id.length > vIdLength) {
			vDiv.style.display="none";
		}
		vDiv = vDiv.nextSibling;
	}
	//Masque les traits et élimine la mémorisation des éléments pères affichés pour chaque niveau
	var vTraits = document.getElementById("t3");
	if(vTraits!=null) {
		vTraits.innerHTML="";
	}
	/*ih.fPlanNiv3 = "";*/
	if(vIdLength <= 2) {
		vTraits = document.getElementById("t2");
		if(vTraits!=null) {
			vTraits.innerHTML="";
		}
		/*ih.fPlanNiv2 = "";*/
	}
	if(vIdLength == 1) {
		vTraits = document.getElementById("t1");
		if(vTraits!=null) {
			vTraits.innerHTML="";
		}
		/*ih.fPlanNiv1 = "";*/
	}
	//On mémorise le pere du cadre affiché
	/*ih['fPlanNiv'+vIdLength] = vId;*/
	//On affiche le cadre avec les traits
	vTraits = document.getElementById("t"+vIdLength);
	if(vTraits==null) {
		vTraits = document.createElement("div");
		vTraits.id="t"+vIdLength;
		with(vTraits.style) {
			position="absolute";
			top = "0";
			left = "0";
		}
		document.getElementById("plan").appendChild(vTraits);
	}
	var vCadre = document.getElementById(vId+"c");
	if(vCadre!=null) {
	  if (vCadre.parentNode != plan) {
	    vCadre.parentNode.removeChild(vCadre);
	    plan.appendChild(vCadre);
	  }
		vTraits.style.display="block";
		vCadre.style.display="block";
		placeVertical(vCadre);
		/*refreshFlagVu(vCadre);*/
    if (vCadre.className!='mapBlock3') {
      lieFilsParGauche(vTraits, pPere.offsetParent.offsetLeft+pPere.offsetLeft+pPere.offsetWidth, pPere.offsetParent.offsetTop+pPere.offsetTop+pPere.offsetHeight/2, vCadre);
    }

	}
}

function refreshFlagVu(pContainer) {
	var vList = pContainer.getElementsByTagName("img");
	for (var i = 0; i < vList.length; i++) {
		var vIdExport = vList[i].getAttribute("sc:fAgentIdExport");
		if(vIdExport != null) {
			if(un.getVal("sc.statut.zz"+vIdExport)=='vu') {
				vList[i].src="../images/pointr.gif";
			}
		}
	}
}

var plan;

function initPlan() {
  plan = document.getElementById('plan'); 
  placeVertical(document.getElementById('c'));
  clicBloc(document.getElementById('b'));
  window.onresize = function(e) { setTimeout("location.reload()",1); }
}


