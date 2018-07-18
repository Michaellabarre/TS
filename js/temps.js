// JavaScript Document
function t()
                 {
             var compteur=document.getElementById('compteur');
             s=duree;
             m=0;h=0;
             if(s<0)
                         {
                                 compteur.innerHTML="<font style='color: red'>Attention vous êtes déconnecté (toute modification non enregistrée seront perdue)</font>"
             }
                         else
                         {
                                 if(s>59)
                                 {
                                         m=Math.floor(s/60);
                                         s=s-m*60
                 }
                                 if(m>59)
                                 {
                                         h=Math.floor(m/60);
                     m=m-h*60
                                 }
                 if(s<10)
                                 {
                                         s="0"+s
                 }
                 if(m<10)
                                 {
                     m="0"+m
                 }
                   compteur.innerHTML="<font style='color: red'>Attention vous allez être déconnecté dans "+h+":"+m+":"+s+"<br />Passé ce délai toute modification non enregistrée sera perdue</font>"
             }
             duree=duree-1;
             window.setTimeout("t();",999);
 duree="1800";
         }
		 
		                        