$(document).ready(function() {
	
	// Expand Panel
	$("#open").click(function(){
		$("div#panel").slideDown("slow");
	
	});	
	
	// Collapse Panel
	$("#close").click(function(){
		$("div#panel").slideUp("slow");	
	});		
	
	// Switch buttons from "Ouvrir" to "Fermer" on click
	$("#toggle a").click(function () {
		$("#toggle a").toggle();
	});		
		
});