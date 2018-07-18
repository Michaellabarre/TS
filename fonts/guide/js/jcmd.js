// JavaScript Document

//format en chiffre
function formatChiffre(val){
	var test_val = 0;
	if (val.indexOf('.')!=-1){
		var extract = val.split('.');
	    if ( extract[1].length==1 ) test_val = 1; 
		  else test_val = 2;
		val = extract[0]; 
	}
	var len = val.length;
	var ind = 0;
	var res = '';
	
	  for(j=(len-1); j>=0; j--){
		ind++;
		if (ind<=3) res = res + val[j];
		  else{
			  ind = 1;
			  res = res + ' ' + val[j];
		  }
	  }
	  val = ''; len = res.length;
	  for(i=0; i<res.length; i++) val = val + res[--len];
    
	switch(test_val){
		case 2: return(val+'.'+extract[1]); break;
		case 1: return (val+'.'+extract[1]); break;
		default: return (val); break;
	}
}

//traitement MontantTTC
function calcMontant(base,MTtva){
	var montant;
	montant = base + MTtva;
	var acompte = parseFloat(window.document.getElementById('acompte').value);
	if(isNaN(acompte)) acompte = 0.00;
	
	window.document.getElementById('montant').value = window.document.getElementById('net_payer').value = montant-acompte;
	montant = window.document.getElementById('montant').value;
	if (montant.length>1){
		if (montant.indexOf('.')==-1) window.document.getElementById('mtt').innerHTML = formatChiffre(montant) + '.00';
		  else {
				var extract = montant.split('.');
				if (extract[1].length>1) window.document.getElementById('mtt').innerHTML = formatChiffre(montant);
				  else window.document.getElementById('mtt').innerHTML = formatChiffre(montant) + '0';
		  }
	}
	  else window.document.getElementById('mtt').innerHTML = '0.00';
	$(function() {
			 $("#mtt").show('slow');
    });
}

//traitement TVA
function calcTVA(){
	var TVA, mtTVA;
	
	TVA = parseFloat(window.document.getElementById('TVA').value);
	if (isNaN(TVA)) TVA = 0.00;
	  
	mtTVA = parseFloat(parseInt(window.document.getElementById('BaseHt').value)*TVA);
	//valeur MTTVA
	window.document.getElementById('MtTVA').value = mtTVA;
	//affichage MTTVA
	var mtva = window.document.getElementById('MtTVA').value;
	if(mtva.length>1){
		if (mtva.indexOf('.')==-1) window.document.getElementById('mtva').innerHTML = formatChiffre(mtva) + '.00';
		  else {
				var extract = mtva.split('.');
				if (extract[1].length>1) window.document.getElementById('mtva').innerHTML = formatChiffre(mtva) + '.00';
				  else window.document.getElementById('mtva').innerHTML = formatChiffre(mtva) + '0';
		  }
	}
	  else window.document.getElementById('mtva').innerHTML = '0.00';
	//valeur montant
	calcMontant(parseFloat(window.document.getElementById('BaseHt').value),mtTVA);
	//affichage en lettre
	conversion(parseFloat(window.document.getElementById('montant').value));
	//affichage net à payer
	var montant = window.document.getElementById('montant').value;
	if(montant.length>1){
		if (montant.indexOf('.')==-1) window.document.getElementById('net').innerHTML = formatChiffre(montant) + '.00';
		  else {
				var extract = montant.split('.');
				if (extract[1].length>1) window.document.getElementById('net').innerHTML = formatChiffre(montant);
				  else window.document.getElementById('net').innerHTML = formatChiffre(montant) + '0';
		  }
	}
	  else window.document.getElementById('net').innerHTML = '0.00';
	
	$(function() {
			   $("#net").show('slow');
			   $("#mtva").show('slow');
	});
}

//traitement montant
function total(id){
	var qte  = parseInt(window.document.getElementById('Qtepro'+id).value); 
	var puHt = parseFloat(window.document.getElementById('PuHtpro'+id).value);
	var rem, base, montant;
	var nbr  = window.document.getElementById("nbrArticle").value;
	
	//remise
	rem = parseFloat(window.document.getElementById('Rempro'+id).value);
	if (isNaN(rem)) rem = 1;
	  else rem = 1-(parseFloat(window.document.getElementById('Rempro'+id).value));
	
	/*--debut qte--*/
	if(!isNaN(qte)){  //si qté non vide
	    window.document.getElementById('MtHtpro'+id).value = qte*puHt*rem;
		var mtHt = window.document.getElementById('MtHtpro'+id).value;
		if (mtHt.length>1){
			if (mtHt.indexOf('.')==-1) window.document.getElementById('MtHt'+id).innerHTML = formatChiffre(mtHt) + '.00';
			   else {
				var extract = mtHt.split('.');
				if (extract[1].length>1) window.document.getElementById('MtHt'+id).innerHTML = formatChiffre(mtHt);
				  else window.document.getElementById('MtHt'+id).innerHTML = formatChiffre(mtHt) + '0';
			   }
		}
		  else window.document.getElementById('MtHt'+id).innerHTML = '0.00';
	}
	else {
		window.document.getElementById('MtHtpro'+id).value = 0;
		window.document.getElementById('MtHt'+id).innerHTML = '0.00';
	}
	/*--fin qte--*/
	//valeur baseHT
	base = 0;
	for(i=0; i<nbr; i++)
		if (!isNaN(parseFloat(window.document.getElementById('MtHtpro'+i).value))) base = base+parseFloat(window.document.getElementById('MtHtpro'+i).value);
	window.document.getElementById('BaseHt').value = base;
	
	var acompte = parseFloat(window.document.getElementById('acompte').value);
	if ( (!isNaN(acompte)||(acompte!=0))&&(acompte<montant) ){
		net = montant-acompte;
		window.document.getElementById('montant').value = window.document.getElementById('net_payer').value = net;
		var montant = window.document.getElementById('montant').value;
	    if(montant.length>1){
			if (montant.indexOf('.')==-1) window.document.getElementById('mtt').innerHTML = window.document.getElementById('net').innerHTML = formatChiffre(montant) + '.00';
			  else {
				var extract = montant.split('.');
				if (extract[1].length>1) window.document.getElementById('mtt').innerHTML = window.document.getElementById('net').innerHTML = formatChiffre(montant);
				  else window.document.getElementById('mtt').innerHTML = window.document.getElementById('net').innerHTML = formatChiffre(montant) + '0';
			  }
		}
	}
	
	//TVA
	calcTVA();
	//Montant
	calcMontant(base,parseFloat(window.document.getElementById('MtTVA').value));
	//affichage en lettre
	conversion(parseFloat(window.document.getElementById('montant').value));
	//affichage base Ht
	base = window.document.getElementById('BaseHt').value;
	if(base.length>1){
		if (base.indexOf('.')==-1) window.document.getElementById('bht').innerHTML = formatChiffre(base) + '.00';
		  else {
				var extract = base.split('.');
				if (extract[1].length>1) window.document.getElementById('bht').innerHTML = formatChiffre(base);
				  else window.document.getElementById('bht').innerHTML = formatChiffre(base) + '0';
		  }
	}
	  else window.document.getElementById('bht').innerHTML = '0.00';
	//affichage net à payer
	var montant = window.document.getElementById('montant').value;
	if(montant.length>1){
		if (montant.indexOf('.')==-1) window.document.getElementById('net').innerHTML = formatChiffre(montant) + '.00';
		  else {
				var extract = montant.split('.');
				if (extract[1].length>1) window.document.getElementById('net').innerHTML = formatChiffre(montant);
				  else window.document.getElementById('net').innerHTML = formatChiffre(montant) + '0';
		  }
	}
	  else window.document.getElementById('net').innerHTML = '0.00';
	
	$(function() {
			   $("#net").show('slow');
			   $("#bht").show('slow');
			   $("#MtHt"+id).show('slow');
	});
}

function traiteChiffre(slct,id){
		var result  = "";
		lettr   = window.document.getElementById(slct).value;
		selection = ".0123456789"
		lg = lettr.length;	
		for(i = 0;i<lg;i++){
			pass = "";
			x    = lettr[i];
			for(j = 0;j<=10;j++){
				if(x==selection[j]){
					pass = x;
					result+= pass;
				}
				else pass = "";
			   result = result;
			}
		}
		window.document.getElementById(slct).value = result;
		if (isNaN(lettr)){
			window.document.getElementById(slct).value=result;
			if (!isNaN(id)) window.document.getElementById('MtHtpro'+id).value='';
		}
}