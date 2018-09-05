<?php
class Project
{
    protected $sCurrentRoom=null;
    protected $tRoom=array();

    public function addRoom($sId_, $sSrc_)
    {
        $this->sCurrentRoom=$sId_;

        $this->tRoom[$this->sCurrentRoom]['img']=$sSrc_;
    }

    public function addRectArea($x_, $y_, $width_, $height_, $oAction_)
    {
        $this->tRoom[$this->sCurrentRoom]['tRectArea'][]=array('x' => $x_, 'y' => $y_, 'width' => $width_, 'height' => $height_, 'oAction' => $oAction_ );
    }

    public function addLeftLinkTo($sRoom_)
    {
        $this->tRoom[$this->sCurrentRoom]['leftLink']=$sRoom_;
    }
    public function addRightLinkTo($sRoom_)
    {
        $this->tRoom[$this->sCurrentRoom]['rightLink']=$sRoom_;
    }

    public function addBackLinkTo($sRoom_)
    {
        $this->tRoom[$this->sCurrentRoom]['backLink']=$sRoom_;
    }

    public function buildSvg($sRoom, $tRoom_)
    {
        $r="\n";

        $sSvg=$r;
        $sSvg.='<svg id="'.$sRoom.'Svg"  width="600" height="400" >'.$r;

        $sSvg.='<style>.clickable { cursor: pointer; }</style>'.$r;

        if (isset($tRoom_['tRectArea'])) {
            foreach ($tRoom_['tRectArea'] as $tArea) {
                $oAction=$tArea['oAction'];
                $sSvg.='<rect class="clickable" onclick="'.$oAction->getAction().'(\''.$oAction->getParam().'\')" x="'.$tArea['x'].'" y="'.$tArea['y'].'" width="'.$tArea['width'].'" height="'.$tArea['height'].'" opacity="0" style="cursor:hand;fill:rgb(0,0,255);stroke-width:10;stroke:rgb(0,0,0)" />'.$r;
            }
        }

        if (isset($tRoom_['leftLink']) and isset($tRoom_['rightLink'])) {
            $sSvg.='
						<g
					     inkscape:label="Layer 1"
					     inkscape:groupmode="layer"
					     id="layer1"
					     transform="translate(0,103)" />
					  <g
					     inkscape:groupmode="layer"
					     id="layer2"
					     inkscape:label="Layer 2"
					     transform="translate(0,370)">
					    <g class="clickable" onclick="loadRoom(\''.$tRoom_['leftLink'].'\')"
					       id="g915"
					       transform="translate(-1.0690781,-4.7947344)">
					      <path
					         sodipodi:nodetypes="czzc"
					         inkscape:connector-curvature="0"
					         id="path820-3"
					         d="m 4.148252,14.557472 c 8.489099,-1.633935 66.650885,-17.0628177 83.005061,-9.9886527 16.354167,7.0741647 16.741967,15.0352687 0,21.9708437 C 70.411341,33.475238 4.148252,14.557472 4.148252,14.557472 Z"
					         style="fill:#254781;fill-opacity:1;fill-rule:evenodd;stroke:#3767bc;stroke-width:4.40155554;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
					      <path
					         sodipodi:nodetypes="czzc"
					         inkscape:connector-curvature="0"
					         id="path820"
					         d="m 45.704603,14.493355 c 3.741772,-1.994838 29.377961,-20.8316654 36.586451,-12.1949527 7.20849,8.6367117 7.37942,18.3562707 0,26.8237827 -7.37942,8.46751 -36.586451,-14.62883 -36.586451,-14.62883 z"
					         style="fill:#9e9e9e;fill-opacity:1;fill-rule:evenodd;stroke:#3767bc;stroke-width:6.16309643;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
					    </g>
					    <g class="clickable" onclick="loadRoom(\''.$tRoom_['rightLink'].'\')"
					       id="g915-6"
					       transform="rotate(180,300.68151,12.60664)">
					      <path
					         sodipodi:nodetypes="czzc"
					         inkscape:connector-curvature="0"
					         id="path820-3-2"
					         d="m 4.148252,14.557472 c 8.489099,-1.633935 66.650885,-17.0628177 83.005061,-9.9886527 16.354167,7.0741647 16.741967,15.0352687 0,21.9708437 C 70.411341,33.475238 4.148252,14.557472 4.148252,14.557472 Z"
					         style="fill:#254781;fill-opacity:1;fill-rule:evenodd;stroke:#3767bc;stroke-width:4.40155554;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
					      <path
					         sodipodi:nodetypes="czzc"
					         inkscape:connector-curvature="0"
					         id="path820-9"
					         d="m 45.704603,14.493355 c 3.741772,-1.994838 29.377961,-20.8316654 36.586451,-12.1949527 7.20849,8.6367117 7.37942,18.3562707 0,26.8237827 -7.37942,8.46751 -36.586451,-14.62883 -36.586451,-14.62883 z"
					         style="fill:#9e9e9e;fill-opacity:1;fill-rule:evenodd;stroke:#3767bc;stroke-width:6.16309643;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
					    </g>
					  </g>
						 ';

            //<rect x="0" y="0" width="113" height="40" opacity="1" onclick="loadRoom(\''.$tRoom_['leftLink'].'\')"  style="fill:rgb(255,0,255);stroke-width:10;stroke:rgb(0,0,0)"></rect>';
        }//end if

                if (isset($tRoom_['backLink'])) {
                    $sSvg.='
					<g
				      transform="translate(0,103)"
				      id="layer1">
				     <g class="clickable" onclick="loadRoom(\''.$tRoom_['backLink'].'\')"
				        transform="translate(304.95264,149.93852)"
				        id="g915">
				       <path
				          style="fill:#254781;fill-opacity:1;fill-rule:evenodd;stroke:#3767bc;stroke-width:5.31580925;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
				          d="M -5.8420796,123.10277 C -10.566021,118.82006 -55.173137,89.477735 -34.72071,81.227136 c 20.452427,-8.250594 43.4691214,-8.446237 63.520865,0 20.051743,8.44624 -34.6422346,41.875634 -34.6422346,41.875634 z"
				          id="path820-3" />
				       <path
				          style="fill:#9e9e9e;fill-opacity:1;fill-rule:evenodd;stroke:#3767bc;stroke-width:7.44324303;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
				          d="M -6.0274516,102.1378 C -11.794815,100.2501 -66.254789,87.316768 -41.284812,83.680121 c 24.969975,-3.636646 53.070616,-3.72288 77.551409,0 24.480787,3.72288 -42.2940486,18.457679 -42.2940486,18.457679 z"
				          id="path820" />
				     </g>
				   </g>
					';
                }

        $sSvg.='</svg>'.$r;

        return $sSvg;
    }

    public function buildScript($sRoom, $tRoom_)
    {
        $sScript=null;
        if (isset($tRoom_['img'])) {
            $sScript.="tRoom['$sRoom']='".$tRoom_['img']."';\n";

            $sScript.="tSvg.push('".$sRoom."Svg');\n";
        }
        return $sScript;
    }

    public function build()
    {
        $sGameHtml=null;

        $sGameScript=null;

        foreach ($this->tRoom as $sRoom => $tRoomDetail) {
            $sGameHtml.=$this->buildSvg($sRoom, $tRoomDetail);

            $sGameScript.=$this->buildScript($sRoom, $tRoomDetail);
        }

        $sHtml='
				<html>
				  <head>
				    <title></title>
				    <meta content="">
				    <style>

							.footer{
							color:#fff;
							text-align:center;
							}
							.footer a{
							color:#fff;

							}

							*{
							font-family:verdana,arial;
							}

							body{
							background:#000;
							}


							#game{

							z-index:10;
							margin:auto;

							margin-top:40px;

							width:600px;
							height:400px;

							background:#fff;

							border:10px solid gray;
							}

							#bar{

							display:block;
							width:600px;
							height:40px;

							background:url(\'img/bar.svg.png\') no-repeat;
							}

							#popup{
							z-index:20;
							display:none;
							width:100%;
							height:100%;
							top:0px;
							left:0px;
							position:absolute;

							}

							.exit{
							text-align:center;
							}

							.exit a{
							color:#fff;
							}

							svg{
							display:none;
							}

				    </style>

				    <script>

						var tRoom=Array();
						var tSvg=Array();

						'.$sGameScript.'

						function loadRoom(id_){
							console.log(\'loadRoom : \'+id_);
							var a=getById(\'game\');
							if(a){
								console.log(\'backgoud:\'+tRoom[id_]);
								a.style.background="url(\'"+tRoom[id_]+"\')";

								resetAllSvg();

								showObject(id_+\'Svg\');
							}
						}

						function getById(id_){
							return document.getElementById(id_);
						}

						function hideObject(sId){
							var b=getById(sId);
							if(b){
								b.style.display=\'none\';
							}
				    }

				    function showObject(sId){
							var b=getById(sId);
							if(b){
								b.style.display=\'block\';
							}
				    }

						function resetAllSvg(){
						 for(var i=0;i<tSvg.length;i++){
							 hideObject(tSvg[i]);
						 }
						 }

						</script>

					</head>
					<body>

						<div id="popup" onclick="closePopup()">
						</div>

						<div id="game">

						'.$sGameHtml.'

						</div>

						<script>
							loadRoom("front");
						</script>




					</body>
				</html>';

        return $sHtml;
    }
}
