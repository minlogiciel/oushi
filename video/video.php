
<?php
include "../php/allinclude.php";

include "../jiaoyu/jy_include.php";

$vtitle = isset($_GET["vtitle"]) ? $_GET["vtitle"] : (isset($_POST["vtitle"]) ? $_POST["vtitle"] : "歌唱会");
$vname = isset($_GET["vname"]) ? $_GET["vname"] : (isset($_POST["vname"]) ? $_POST["vname"] : "childrensingsing.avi");
$vtype = isset($_GET["vtype"]) ? $_GET["vtype"] : (isset($_POST["vtype"]) ? $_POST["vtype"] : "");

include ("../php/title.php");
?>

<BODY>
<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
	<div class="left_box">
      	<div class='box_txt'> 
      
     	<div class="PROG_TIT1">

<object id="MediaPlayer" width="100%" height="377" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" type="application/x-oleobject">
	<param name="uiMode" value="full" />
    <param name="AutoStart" value="FALSE" />
    <param name="AllowChangeDisplaySize" value="TRUE" />
    <param name="AutoSize" value="TRUE" />
    <param name="Volume" value="100" />
    <param name="URL" value=mms://bstreamlivewm.fplive.net/bstreamlive-live/bstream2 />
    <embed type="application/x-mplayer2" 
    		pluginspage="http://www.microsoft.com/Windows/MediaPlayer/" 
    		name="MediaPlayer" 
    		src=mms://bstreamlivewm.fplive.net/bstreamlive-live/bstream2 
    		width="100%" height="377" 
    		showcontrols="1" 
    		showtracker="1" 
    		autostart="0" 
    		volume="100" />              
</object>                   
</div>

			<object width=600 height =450 id ="Player"
			  type    ="application/x-oleobject"
			  standby ="Loading Windows Media Player components..."
			  classid ="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95"
			  codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">
			  
			<param name='animationatStart' value='true'>
			<param name='transparentatStart' value='true'>
			<param name='autoStart' value='true'>
			<param name='showControls' value='true'>
			<param name='showStatusBar' value='true'>
			<param name='showDisplay' value='false'>
			<PARAM NAME="fullScreen" VALUE="True">
			<param name='loop' value='false'>
			<param name="filename"     value="../video/<?php echo($vname); ?>">
			<embed type="application/x-mplayer2" 
			pluginspage="http://www.microsoft.com/windows/windowsmedia/download/"
			filename="../video/<?php echo($vname); ?>"
			src="../video/<?php echo($vname); ?>"
			Name=MediaPlayer
			ShowControls=1
			ShowDisplay=1
			ShowStatusBar=1
			width=600 height=450></embed>
			 </object>
     	</div>



<a href="javascript:fullScreen();">Fullscreen1</a>
<button onclick="goFullscreen('Player'); return false">Fullscreen</button>


          
 <script type="text/javascript">
  function goFullscreen(id) {
    // Get the element that we want to take into fullscreen mode
    var element = document.getElementById(id);
    
    // These function will not exist in the browsers that don't support fullscreen mode yet, 
    // so we'll have to check to see if they're available before calling them.
    
    if (element.mozRequestFullScreen) {
      // This is how to go into fullscren mode in Firefox
      // Note the "moz" prefix, which is short for Mozilla.
      element.mozRequestFullScreen();
    } else if (element.webkitRequestFullScreen) {
      // This is how to go into fullscreen mode in Chrome and Safari
      // Both of those browsers are based on the Webkit project, hence the same prefix.
      element.webkitRequestFullScreen();
   }
   // Hooray, now we're in fullscreen mode!
  }

  function fullScreen() {
	   var player=document.getElementById("Player");
	   //if (player.DisplaySize==3)  {     // 3 means 'playing'
	     player.fullScreen=true;
	   //}
	}
</script>

<style type="text/css">
  .player:-webkit-full-screen {
    width: 100%;
    height: 100%;
  }
  .player:-moz-full-screen {
    width: 100%;
    height: 100%;
  }
</style>

      </div>
  </div>
</div>

<div class="right">
	<?php include "../home/homeright.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>




</body>
</html>
