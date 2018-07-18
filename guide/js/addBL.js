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

//traitement remise
function calcRemise(){
	var rem;
	var total = parseFloat(window.document.getElementById('totaly').value);
	//remise
	rem = parseFloat(window.document.getElementById('remise').value);
	if (isNaN(rem)) rem = 1;
	  else rem = 1-(parseFloat(window.document.getElementById('remise').value));
	  
	window.document.getElementById('net_payer').value = total*rem;
	
	var net = window.document.getElementById('net_payer').value;
	if(net.length>1){
		if (net.indexOf('.')==-1) window.document.getElementById('net').innerHTML = formatChiffre(net) + '.00';
		  else {
				var extract = net.split('.');
				if (extract[1].length>1) window.document.getElementById('net').innerHTML = formatChiffre(net);
				  else window.document.getElementById('net').innerHTML = formatChiffre(net) + '0';
		  }
	}
	  else window.document.getElementById('net').innerHTML = '0.00';
	
	$(function() {
			   $("#net").show('slow');
	});
}

//traitement montant
function total(id){
	var qte  = parseInt(window.document.getElementById('Qtepro'+id).value); 
	var puHt = parseFloat(window.document.getElementById('PuHtpro'+id).value);
	var rem, MtHtpro, montant;
	var nbr  = window.document.getElementById("nbrArticle").value;
		
	/*--debut qte--*/
	if (qte<=parseInt(window.document.getElementById('Qte'+id).value)){  //par rapport à la qté stockée
	    window.document.getElementById('MtHtpro'+id).value = qte*puHt;
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
	else if(!isNaN(qte)){
		window.document.getElementById('Qtepro'+id).value   = 0;
		window.document.getElementById('MtHtpro'+id).value  = 0;
		window.document.getElementById('MtHt'+id).innerHTML = '0.00';
		alert('La valeur depasse la quantite!');
	}
	if(isNaN(qte)) {
		window.document.getElementById('MtHtpro'+id).value = 0;
		window.document.getElementById('MtHt'+id).innerHTML = '0.00';
	}
	/*--fin qte--*/
	//valeur baseHT
	MtHtpro = 0;
	for(i=0; i<nbr; i++)
		if (!isNaN(parseFloat(window.document.getElementById('MtHtpro'+i).value))) MtHtpro = MtHtpro+parseFloat(window.document.getElementById('MtHtpro'+i).value);
	window.document.getElementById('totaly').value = window.document.getElementById('net_payer').value = MtHtpro;

	//affichage net à payer
	var tot = window.document.getElementById('totaly').value;
	if(tot.length>1){
		if (tot.indexOf('.')==-1) window.document.getElementById('net').innerHTML = window.document.getElementById('tot').innerHTML = formatChiffre(tot) + '.00';
		  else {
				var extract = tot.split('.');
				if (extract[1].length>1) window.document.getElementById('net').innerHTML = window.document.getElementById('tot').innerHTML = formatChiffre(tot);
				  else window.document.getElementById('net').innerHTML = window.document.getElementById('tot').innerHTML = formatChiffre(tot) + '0';
		  }
	}
	  else window.document.getElementById('net').innerHTML = window.document.getElementById('tot').innerHTML = '0.00';
	
	$(function() {
			   $("#net").show('slow');
			   $("#tot").show('slow');
			   $("#MtHt"+id).show('slow');
	});
}

function traiteChiffre(slct,id){
		var result = "";
		lettr      = window.document.getElementById(slct).value;
		selection  = ".0123456789"
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
			window.document.getElementById(slct).value = result;
			if (!isNaN(id)) window.document.getElementById('MtHtpro'+id).value = '';
		}
}