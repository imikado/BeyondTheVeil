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

    public function buildSvg($tRoom_)
    {
        $sSvg=null;
        $sSvg.='<svg id="roomSvg"  width="600" height="400" >';

        if (isset($tRoom_['tRectArea'])) {
            foreach ($tRoom_['tRectArea'] as $tArea) {
                $sSvg.='<rect x="'.$tArea['x'].'" y="'.$tArea['y'].'" width="'.$tArea['width'].'" height="'.$tArea['height'].'" onclick="AAA" opacity="0" style="fill:rgb(0,0,255);stroke-width:10;stroke:rgb(0,0,0)" />';
            }
        }

        $sSvg.='</svg>';

        return $sSvg;
    }

    public function buildScript($sRoom, $tRoom_)
    {
        $sScript=null;
        if (isset($tRoom_['img'])) {
            $sScript.="tRoom['$sRoom']='".$tRoom_['img']."';\n";
        }
        return $sScript;
    }

    public function build()
    {
        $sGameHtml=null;

        $sGameScript=null;

        foreach ($this->tRoom as $sRoom => $tRoomDetail) {
            $sGameHtml.=$this->buildSvg($tRoomDetail);

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
						'.$sGameScript.'

						function loadRoom(id_){
							console.log(\'loadRoom : \'+id_);
							var a=getById(\'game\');
							if(a){
								console.log(\'backgoud:\'+tRoom[id_]);
								a.style.background="url(\'"+tRoom[id_]+"\')";
							}
						}

						function getById(id_){
							return document.getElementById(id_);
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
