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

function process(tData_){

	for(sId in tData_){

		var detailRoom=tData_[sId];
		tRoom[detailRoom.id]=detailRoom.src;
		tSvg.push(detailRoom.id+'Svg');

		tORoom[detailRoom.id]=detailRoom;

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
			}

			sHtml+='<rect class="clickable" onclick="'+sAction+'" x="'+oReactArea.x+'" y="'+oReactArea.y+'" width="'+oReactArea.width+'" height="'+oReactArea.height+'" opacity="0" style="cursor:hand;fill:rgb(0,0,255);stroke-width:10;stroke:rgb(0,0,0)" />';
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

	console.log('key:'+key);

		if(key=='VAL'){
			console.log('VAL');

			if(digicodeValue==digicodePassword){


				loadRoom(digicodeRoomToGo);


			}else{

				digicodeValue='';

			}



		}else if(key=='DEL'){
			console.log('DEL');
			digicodeValue=digicodeValue.substring(0, (digicodeValue.length-1) );
		}else{
			console.log('ELSE');
			digicodeValue=digicodeValue+''+key;

			console.log(digicodeValue);
		}

		var a=getById('myCodeTxt');
		if(a){
		console.log('inner');
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
	
	showObject('game');
}

window.onload=function(){
	loadRoom("front");
}
