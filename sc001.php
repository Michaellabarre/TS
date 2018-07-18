<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Scripts javascript : Aperçu</title>
</head>
<body bgcolor="#FFFFFF">
<br /><p class="tt" >Texte défilant horizontalement</p><br /><br />
<script language="JavaScript">
//largeur du texte défilant (en pixels)
var marqueewidth=330;
//hauteur du texte défilant (en pixels,Netscape)
var marqueeheight=20;
//vitesse de défilement du texte
var speed=6;
//contenu du texte défilant
var marqueecontents='<font face=Arial>Nous avons besoin de vos clics <strong><big>pour vous faire gagner de l\'argent</big> ---><a href="http://www.outils-web.com">outils-web.com</a>, </strong></font>';

document.write('<marquee scrollAmount='+speed+' style="width:'+marqueewidth+'">'+marqueecontents+'</marquee>');

function regenerate(){
window.location.reload();
}
function regenerate2(){
if (document.layers){
setTimeout("window.onresize=regenerate",450);
intializemarquee();
}
}

function intializemarquee(){
document.cmarquee01.document.cmarquee02.document.write('<nobr>'+marqueecontents+'</nobr>');
document.cmarquee01.document.cmarquee02.document.close();
thelength=document.cmarquee01.document.cmarquee02.document.width;
scrollit();
}

function scrollit(){
if (document.cmarquee01.document.cmarquee02.left>=thelength*(-1)){
document.cmarquee01.document.cmarquee02.left-=speed;
setTimeout("scrollit()",100);
}
else{
document.cmarquee01.document.cmarquee02.left=marqueewidth;
scrollit();
}
}

window.onload=regenerate2;
</script>


<ilayer width=&{marqueewidth}; height=&{marqueeheight}; name="cmarquee01">
<layer name="cmarquee02"></layer>
</ilayer>
</body>
</html>