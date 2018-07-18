// JavaScript Document
$('document').ready(function(){
	updatestatus();
	scrollalertcli ();
	scrollalertart ();
});  

function updatestatus(){ // Afficher le nombre d'objets chargés</span>  
		var totalItems=$('#contenta td').length;
		$('status').text('Loaded '+totalItems+' Items');
}
//client
function scrollalertcli(){
		var scrolltop=$('#scrollbox').attr('scrollTop');
		var scrollheight=$('#scrollbox').attr('scrollHeight');
		var windowheight=$('#scrollbox').attr('clientHeight');
		var scrolloffset=2;
		
		if(scrolltop>=(scrollheight-(windowheight+scrolloffset))){ // On va chercher de nouveaux éléments</span>  
			$('status').text('Loading more items...');
			$.get('selectCli.php', '', function(newitems){
					$('#contenta').append(newitems);
					updatestatus();
			});
		}
		setTimeout('scrollalertcli();', 1500);
}
//article
function scrollalertart(){
		var scrolltop=$('#scrollbox').attr('scrollTop');
		var scrollheight=$('#scrollbox').attr('scrollHeight');
		var windowheight=$('#scrollbox').attr('clientHeight');
		var scrolloffset=2;
		
		if(scrolltop>=(scrollheight-(windowheight+scrolloffset))){ // On va chercher de nouveaux éléments</span>  
			$('status').text('Loading more items...');
			$.get('../data/select.php', '', function(newitems){
					$('#contenta').append(newitems);
					updatestatus();
			});
		}
		setTimeout('scrollalertart();', 1500);
}
