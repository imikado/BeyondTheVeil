var tRoom=Array();
var tSvg=Array();
var tORoom=Array();

var digicodeValue='';
var digicodePassword='';
var digicodeRoomToGo='';
var digicodeLinkBack='';

var requestURL='./data/project.json';

var request = new XMLHttpRequest();
request.open('GET', requestURL,true);
request.responseType = 'json';
request.send();

request.onload = function() {
	var tData = request.response;
	process(tData);
}

function modalMessage(text_){
 showObject('myModal');
 getById('myModalTxt').innerHTML=text_;
}

function process(tData_){

	console.log('process');

	for(sId in tData_){

		if(tData_[sId].type=='intro'){
			var detailIntro=tData_[sId];

			var oIntro=getById('intro');
			oIntro.innerHTML=detailIntro.text.join('');

			oIntro.style.background=detailIntro.background;

			oIntro.style.width=detailIntro.width;
			oIntro.style.height=detailIntro.height;


			console.log('intro');
		}else{
			var detailRoom=tData_[sId];
			tRoom[detailRoom.id]=detailRoom.src;
			tSvg.push(detailRoom.id+'Svg');

			tORoom[detailRoom.id]=detailRoom;
		}



	}
}
function getHtmlItem(oRoom_){
	var sHtml='';
	if(oRoom_.tRectArea){
		for(var iReactArea in oRoom_.tRectArea){
			var oReactArea=oRoom_.tRectArea[iReactArea];

			var sAction='';
			if(oReactArea.action.funct=='loadRoom'){
				sAction="loadRoom('"+oReactArea.action.room+"')";
			}else if(oReactArea.action.funct=='digicode'){
				sAction="digicode('"+oReactArea.action.code+"','"+oReactArea.action.linkBack+"','"+oReactArea.action.roomIfSuccess+"')";
			}else if(oReactArea.action.funct=='modalMessage'){
				sAction="modalMessage('"+oReactArea.action.message+"')";
			}

			sHtml+='<rect class="clickable" ';
       if(bDebug){
               sHtml+='opacity="0.5" ';
       }else{
               sHtml+='opacity="0" ';
       }
       sHtml+=' onclick="'+sAction+'" x="'+oReactArea.x+'" y="'+oReactArea.y+'" width="'+oReactArea.width+'" height="'+oReactArea.height+'" opacity="0" style="cursor:hand;fill:rgb(0,0,255);stroke-width:10;stroke:rgb(0,0,0)" />';
		}
	}
	if(oRoom_.leftLinkTo && oRoom_.rightLinkTo){
		sHtml+=getById('myArrows').innerHTML.replace('MYLINKLEFT',oRoom_.leftLinkTo).replace('MYLINKRIGHT',oRoom_.rightLinkTo);
	}

	if(oRoom_.backLinkTo ){
		sHtml+=getById('myArrowBack').innerHTML.replace('MYLINKBACK',oRoom_.backLinkTo);
	}

	return sHtml;
}
function getHtmlSvg(id_,content_){
	return '<svg id="'+id_+'"  width="600" height="400" ><style>.clickable { cursor: pointer; }</style>'+content_+'</svg>';
}


function digicode(code,linkBack,roomToGo){
	var oGame=getById('game');

	digicodeValue='';
	digicodePassword=code;
	digicodeRoomToGo=roomToGo;
	digicodeLinkBack=linkBack;

	oGame.style.background="#444";

	var sHtml=getById('myDigiCode').innerHTML;

	oGame.innerHTML=sHtml;
	showObject('svgDigicode');

}

function digicodePress(key){

		if(key=='VAL'){
			if(digicodeValue==digicodePassword){
				loadRoom(digicodeRoomToGo);
			}else{
				digicodeValue='';
			}

		}else if(key=='DEL'){
			digicodeValue=digicodeValue.substring(0, (digicodeValue.length-1) );
		}else{
			digicodeValue=digicodeValue+''+key;
		}

		var a=getById('myCodeTxt');
		if(a){
			a.innerHTML=digicodeValue;
		}

}


function loadRoom(id_){
	var a=getById('game');
	if(a){

		detailRoom=tORoom[id_];
		a.innerHTML=getHtmlSvg(detailRoom.id+'Svg',getHtmlItem(detailRoom));

		a.style.background="url('"+tRoom[id_]+"')";

		showObject(id_+'Svg');
	}
}

function getById(id_){
	return document.getElementById(id_);
}

function hideObject(sId){
	var b=getById(sId);
	if(b){
		b.style.display='none';
	}
}

function showObject(sId){
		var b=getById(sId);
		if(b){
			b.style.display='block';
		}
}


function startGame(){
	hideObject('intro');

	loadRoom("front");
	showObject('game');
}

function startPage(){

}

window.onload=function(){
	startPage();
}
