	/**
	 * Created by Elvis Konjoh 
	 * email selabielvis@gmail.com
	 *
	**/
var confirmOnLeave = function(msg) {
	 
    window.onbeforeunload = function (e) {
        e = e || window.event;
        msg = msg || '';
 
        // For IE and Firefox
        if (e) {e.returnValue = msg;}
 
        // For Chrome and Safari
        return msg;
    };
 
};
var cancelConfirmOnLeave = function() {
	 
    window.onbeforeunload = true;
 
};


var alertConfig={
			boxBgClass:"",//Background class
			boxBgColor:"",
			boxBtnCloseClass:"",//Button close class
};
/**
 * created by Konjoh Elvis
 * email selabielvis@gmail.com
 *
 */
 
window.alert = function(alertMessage,title)// On  declare la fonction qui va redesigner l'alerte de base en testant s'il s'agit bien d'une fenÃªtre alert()
{	
		if(title==undefined)
		 title="Alert";
		var _body = document.getElementsByTagName('body') [0];
        var _layer = document.createElement('div');
        var _box = document.createElement('div');
        var _box_title = document.createElement('h1');
        var _box_text = document.createElement('p');
        var _title = document.createTextNode(title);
        var _text = document.createTextNode(alertMessage);
        var _btn_text = document.createTextNode('OK');
        var _btn =document.createElement('button');
        var _close_btn = document.createElement('span');
        var _close_icon = document.createTextNode(String.fromCharCode(215));
        
		
        _close_btn.appendChild(_close_icon);
        _box_title.appendChild(_title);
        _box_title.appendChild(_close_btn);
		
		if(typeof(alertMessage)=="string")
         _box_text.innerHTML=HTMLentities(alertMessage);
		else
		   _box_text.innerHTML=alertMessage;
		  
        _btn.appendChild(_btn_text);
        
        _box.appendChild(_box_title);
        _box.appendChild(_box_text);
        _box.appendChild(_btn);
        _body.appendChild(_box);
        _body.appendChild(_layer);
        // Background layer image
        var _bg_layer_img = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAFoEvQfAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NDY2RDlEMDc2NkU3MTFFMkFBQjJEN0JEQ0M0NjM3Q0IiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NDY2RDlEMDg2NkU3MTFFMkFBQjJEN0JEQ0M0NjM3Q0IiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo0NjZEOUQwNTY2RTcxMUUyQUFCMkQ3QkRDQzQ2MzdDQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo0NjZEOUQwNjY2RTcxMUUyQUFCMkQ3QkRDQzQ2MzdDQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PvElfFoAAAANSURBVHjaY2BgYPAFAABSAE5KPdTrAAAAAElFTkSuQmCC';
        // Set layer style
        _layer.setAttribute('style','z-index:9998;position:fixed;height:100%;width:100%;top:0;left:0;background: url(data:image/png;base64,'+_bg_layer_img+') repeat top left');
        
        // Set box class for style
		if( alertConfig.boxBgClass!=undefined && alertConfig.boxBgClass !="" )
			_box.className='alert_box '+alertConfig.boxBgClass;
		else
			_box.className = 'alert_box';
		
		var _boxBgColor="ghostwhite";
		if(alertConfig.boxBgColor!=undefined && alertConfig.boxBgColor !="")
			_boxBgColor=alertConfig.boxBgColor;
        // Set box position
        _box.setAttribute('style', 'background-color:'+_boxBgColor+';position:absolute;z-index:9999;top:'+parseInt((window.innerHeight/2)-_box.offsetHeight)+'px;left:'+parseInt((window.innerWidth/2)-(_box.offsetWidth/2))+'px;');
        
		//set btn class
		if(alertConfig.boxBtnCloseClass!=undefined && alertConfig.boxBtnCloseClass !="" )
			_btn.className=alertConfig.boxBtnCloseClass;
		else
			_btn.className="button";
        // Layer on click event	
        _layer.addEventListener("click", function(){
            _box.className = _box.className+' alert_box_important';
            setTimeout(function(){
					if( alertConfig.boxBgClass!=undefined && alertConfig.boxBgClass !="" )
						_box.className='alert_box '+alertConfig.boxBgClass;
					else
						_box.className = 'alert_box';
            },100);
        }, false);
        
        // Button on click event
        _btn.addEventListener("click", function(){
            _body.removeChild(_box);
            _body.removeChild(_layer);
            if(typeof urlToGo == 'string'){
            	cancelConfirmOnLeave("");
                //window.location.href = urlToGo;
            }
           // alert("btn close");
            cancelConfirmOnLeave("");
            
        }, false);
        
        // Window resize event
        window.onresize = function(event) {
            // Set box position
			_box.setAttribute('style', 'background-color:'+_boxBgColor+';position:absolute;z-index:9999;top:'+parseInt((window.innerHeight/2)-_box.offsetHeight)+'px;left:'+parseInt((window.innerWidth/2)-(_box.offsetWidth/2))+'px;');
        };
        
        // Document keypress event
        document.onkeypress = function(event) {
            if(event.keyCode == 13){
                _body.removeChild(_box);
                _body.removeChild(_layer);
                if(typeof urlToGo == 'string'){
                    //window.location.href = urlToGo;
                    //window.onbeforeunload = true;
                    
                }
                cancelConfirmOnLeave("");
            }
        };
        
        _close_btn.addEventListener("click",function(){
        	
        	
            _body.removeChild(_box);
            _body.removeChild(_layer);
           // window.onbeforeunload = true;
            cancelConfirmOnLeave("");
        });
        
        confirmOnLeave("test");
};

function HTMLentities(texte) {
	texte = texte.replace(/Ëœ/g,'&tilde;'); // 152 98
	texte = texte.replace(/â„¢/g,'&trade;'); // 153 99
	texte = texte.replace(/Å¡/g,'&scaron;'); // 154 9A
	texte = texte.replace(/â€º/g,'&rsaquo;'); // 155 9B
	texte = texte.replace(/Å“/g,'&oelig;'); // 156 9C
	texte = texte.replace(/Å¾/g,'&#382;'); // 158 9E
	texte = texte.replace(/Å¸/g,'&Yuml;'); // 159 9F
	texte = texte.replace(/Â¡/g,'&iexcl;'); // 161 A1
	texte = texte.replace(/Â¢/g,'&cent;'); // 162 A2
	texte = texte.replace(/Â£/g,'&pound;'); // 163 A3
	texte = texte.replace(/Â¥/g,'&yen;'); // 165 A5
	texte = texte.replace(/Â¦/g,'&brvbar;'); // 166 A6
	texte = texte.replace(/Â§/g,'&sect;'); // 167 A7
	texte = texte.replace(/Â¨/g,'&uml;'); // 168 A8
	texte = texte.replace(/Â©/g,'&copy;'); // 169 A9
	texte = texte.replace(/Âª/g,'&ordf;'); // 170 AA
	texte = texte.replace(/Â«/g,'&laquo;'); // 171 AB
	texte = texte.replace(/Â¬/g,'&not;'); // 172 AC
	texte = texte.replace(/Â­/g,'&shy;'); // 173 AD
	texte = texte.replace(/Â®/g,'&reg;'); // 174 AE
	texte = texte.replace(/Â¯/g,'&macr;'); // 175 AF
	texte = texte.replace(/Â°/g,'&deg;'); // 176 B0
	texte = texte.replace(/Â±/g,'&plusmn;'); // 177 B1
	texte = texte.replace(/Â²/g,'&sup2;'); // 178 B2
	texte = texte.replace(/Â³/g,'&sup3;'); // 179 B3
	texte = texte.replace(/Â´/g,'&acute;'); // 180 B4
	texte = texte.replace(/Âµ/g,'&micro;'); // 181 B5
	texte = texte.replace(/Â¶/g,'&para'); // 182 B6
	texte = texte.replace(/Â·/g,'&middot;'); // 183 B7
	texte = texte.replace(/Â¸/g,'&cedil;'); // 184 B8
	texte = texte.replace(/Â¹/g,'&sup1;'); // 185 B9
	texte = texte.replace(/Âº/g,'&ordm;'); // 186 BA
	texte = texte.replace(/Â»/g,'&raquo;'); // 187 BB
	texte = texte.replace(/Â¼/g,'&frac14;'); // 188 BC
	texte = texte.replace(/Â½/g,'&frac12;'); // 189 BD
	texte = texte.replace(/Â¾/g,'&frac34;'); // 190 BE
	texte = texte.replace(/Â¿/g,'&iquest;'); // 191 BF
	texte = texte.replace(/Ã€/g,'&Agrave;'); // 192 C0
	texte = texte.replace(/Ã�/g,'&Aacute;'); // 193 C1
	texte = texte.replace(/Ã‚/g,'&Acirc;'); // 194 C2
	texte = texte.replace(/Ãƒ/g,'&Atilde;'); // 195 C3
	texte = texte.replace(/Ã„/g,'&Auml;'); // 196 C4
	texte = texte.replace(/Ã…/g,'&Aring;'); // 197 C5
	texte = texte.replace(/Ã†/g,'&AElig;'); // 198 C6
	texte = texte.replace(/Ã‡/g,'&Ccedil;'); // 199 C7
	texte = texte.replace(/Ãˆ/g,'&Egrave;'); // 200 C8
	texte = texte.replace(/Ã‰/g,'&Eacute;'); // 201 C9
	texte = texte.replace(/ÃŠ/g,'&Ecirc;'); // 202 CA
	texte = texte.replace(/Ã‹/g,'&Euml;'); // 203 CB
	texte = texte.replace(/ÃŒ/g,'&Igrave;'); // 204 CC
	texte = texte.replace(/Ã�/g,'&Iacute;'); // 205 CD
	texte = texte.replace(/ÃŽ/g,'&Icirc;'); // 206 CE
	texte = texte.replace(/Ã�/g,'&Iuml;'); // 207 CF
	texte = texte.replace(/Ã�/g,'&ETH;'); // 208 D0
	texte = texte.replace(/Ã‘/g,'&Ntilde;'); // 209 D1
	texte = texte.replace(/Ã’/g,'&Ograve;'); // 210 D2
	texte = texte.replace(/Ã“/g,'&Oacute;'); // 211 D3
	texte = texte.replace(/Ã”/g,'&Ocirc;'); // 212 D4
	texte = texte.replace(/Ã•/g,'&Otilde;'); // 213 D5
	texte = texte.replace(/Ã–/g,'&Ouml;'); // 214 D6
	texte = texte.replace(/Ã—/g,'&times;'); // 215 D7
	texte = texte.replace(/Ã˜/g,'&Oslash;'); // 216 D8
	texte = texte.replace(/Ã™/g,'&Ugrave;'); // 217 D9
	texte = texte.replace(/Ãš/g,'&Uacute;'); // 218 DA
	texte = texte.replace(/Ã›/g,'&Ucirc;'); // 219 DB
	texte = texte.replace(/Ãœ/g,'&Uuml;'); // 220 DC
	texte = texte.replace(/Ã�/g,'&Yacute;'); // 221 DD
	texte = texte.replace(/Ãž/g,'&THORN;'); // 222 DE
	texte = texte.replace(/ÃŸ/g,'&szlig;'); // 223 DF
	texte = texte.replace(/Ã /g,'&agrave;'); // 224 E0
	texte = texte.replace(/Ã¡/g,'&aacute;'); // 225 E1
	texte = texte.replace(/Ã¢/g,'&acirc;'); // 226 E2
	texte = texte.replace(/Ã£/g,'&atilde;'); // 227 E3
	texte = texte.replace(/Ã¤/g,'&auml;'); // 228 E4
	texte = texte.replace(/Ã¥/g,'&aring;'); // 229 E5
	texte = texte.replace(/Ã¦/g,'&aelig;'); // 230 E6
	texte = texte.replace(/Ã§/g,'&ccedil;'); // 231 E7
	texte = texte.replace(/Ã¨/g,'&egrave;'); // 232 E8
	texte = texte.replace(/Ã©/g,'&eacute;'); // 233 E9
	texte = texte.replace(/Ãª/g,'&ecirc;'); // 234 EA
	texte = texte.replace(/Ã«/g,'&euml;'); // 235 EB
	texte = texte.replace(/Ã¬/g,'&igrave;'); // 236 EC
	texte = texte.replace(/Ã­/g,'&iacute;'); // 237 ED
	texte = texte.replace(/Ã®/g,'&icirc;'); // 238 EE
	texte = texte.replace(/Ã¯/g,'&iuml;'); // 239 EF
	texte = texte.replace(/Ã°/g,'&eth;'); // 240 F0
	texte = texte.replace(/Ã±/g,'&ntilde;'); // 241 F1
	texte = texte.replace(/Ã²/g,'&ograve;'); // 242 F2
	texte = texte.replace(/Ã³/g,'&oacute;'); // 243 F3
	texte = texte.replace(/Ã´/g,'&ocirc;'); // 244 F4
	texte = texte.replace(/Ãµ/g,'&otilde;'); // 245 F5
	texte = texte.replace(/Ã¶/g,'&ouml;'); // 246 F6
	texte = texte.replace(/Ã·/g,'&divide;'); // 247 F7
	texte = texte.replace(/Ã¸/g,'&oslash;'); // 248 F8
	texte = texte.replace(/Ã¹/g,'&ugrave;'); // 249 F9
	texte = texte.replace(/Ãº/g,'&uacute;'); // 250 FA
	texte = texte.replace(/Ã»/g,'&ucirc;'); // 251 FB
	texte = texte.replace(/Ã¼/g,'&uuml;'); // 252 FC
	texte = texte.replace(/Ã½/g,'&yacute;'); // 253 FD
	texte = texte.replace(/Ã¾/g,'&thorn;'); // 254 FE
	texte = texte.replace(/Ã¿/g,'&yuml;'); // 255 FF
	return texte;
	}
