// JavaScript Document

function ecr2(k){
    var res = ' ';
    switch (parseInt(k)){
        case 1: res = res+'UN'; break;
        case 2: res = res+'DEUX'; break;
        case 3: res = res+'TROIS'; break;
        case 4: res = res+'QUATRE'; break;
        case 5: res = res+'CINQ'; break;
        case 6: res = res+'SIX'; break;
        case 7: res = res+'SEPT'; break;
        case 8: res = res+'HUIT'; break;
        case 9: res = res+'NEUF'; break;
        case 10: res = res+'DIX'; break;
        case 11: res = res+'ONZE'; break;
        case 12: res = res+'DOUZE'; break;
        case 13: res = res+'TREIZE'; break;
        case 14: res = res+'QUATORZE'; break;
        case 15: res = res+'QUINZE'; break;
        case 16: res = res+'SEIZE'; break;
        case 17: res = res+'DIX SEPT'; break;
        case 18: res = res+'DIX HUIT'; break;
        case 19: res = res+'DIX NEUF'; break;
	}
	return(res);
}

function ecr1(k){
    var l;
	var res = '';

    if (k>=100) {
      l = (k / 100); 
	  k = (k % 100);
      if (parseInt(l)>1)  res = ecr2(l);
	  res = res + ' CENT';
      if ((parseInt(l)>1) && (k==0)) res = res + 'S';
	}
    if (k>=80) {
        k = k-80; 
		res = res + ' QUATRE VINGT';
        if (k==0) res = res + 'S'; 
		  else res = res + ecr2(k);
	} 
	else
      if (k>=60) {
        k = k-60; 
		res = res + ' SOIXANTE';
        if ((k==1) || (k==11))  res = res + ' ET '; 
		res = res + ecr2(k);
	  } 
	  else
        if (k>=20) {
          l = (k / 10); 
		  k = (k % 10);
		  //alert('(10) l= '+l+' , k= '+k);
          switch(parseInt(l)){
            case 2: res = res + ' VINGT'; break;
            case 3: res = res + ' TRENTE'; break;
            case 4: res = res + ' QUARANTE'; break;
            case 5: res = res + ' CINQUANTE'; break;
		  }
          if (k==1) res = res + ' ET '; 
		  res = res + ecr2(k);
		} else
          if (k>0) res = res + ecr2(k);
  
  return(res);
}

function conversion(k){
var milliard = 1000000000;
var million  = 1000000; 
var mille    = 1000;
var res      = '';
var l;
   
  if (k==0) res = ' ZERO';
    else {
      if (k<0){
		  res = 'MOINS'; 
		  k = k-l; 
	  }
      if (k>=milliard){
		  l = (k / milliard);
		  k = (k % milliard);
		  alert('(milliard) l= '+l+' , k= '+k);
          res = res + ecr1(l); 
		  res = res + ' MILLIARD';
          if (parseInt(l)>1) res = res + 'S';
	  }
      if (k>= million){
		  l = (k / million);
          k = (k % million);
		  //alert('(million) l= '+l+' , k= '+k);
          res = res + ecr1(l);
		  res = res + ' MILLION';
          if (parseInt(l)>1) res = res + 'S';
	  }
      if (k>= mille){
		  l = (k / mille);
		  k = (k % mille);
		  if (parseInt(l)>1) res = res + ecr1(l);
		  res = res + ' MILLE';
	  }
      if (k>0) res = res + ecr1(k);
	}
  res = res + ' ARIARY';
  window.document.getElementById('letira').value     = res;
  window.document.getElementById('lettre').innerHTML = res;
  $(function() {
			 $("#lettre").show('slow');
  });
}