var lastid = 1;
var menu_lastid = 1;
var menu_mo_lastid = 1;
var tabs_lastid = 1;

function formfocus(id) {
	if (lastid!=0)
	{	
		document.getElementById('commentaire'+lastid).className='formrow';
		document.getElementById('commentaire'+id).className='formrow_ac';
	}
	lastid = id;
}

function formblur(id) {
	document.getElementById('commentaire'+id).className='formrow';
}

