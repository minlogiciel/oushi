<?php
require ("../php/allinclude.php");
session_start();
require ("forum_include.php");
$err = '';

$forum = new ForumForm();
$action = getAction();
$mess_id = getMessageID();
$mess = "";
$showmenu = 1;
if (isset($action)) {
	if (($action == "addsubject") || ($action == "addresponse")) {
		$showmenu = 0;
		$mess = $forum->getForumMessage();
		if ($mess->getError()) {
			$err = $mess->getError();
			$mess_id = $mess->getParent();
		}
		else {
			$forum_class = new forum_class();
			$mess_id = $forum_class->addMessage($mess);
			$mess = '';
			//$mess_id = addForumMessage($action);
			$showmenu = 1;
		}
	}
	else if (($action == "newsubject")  ||  ($action == "showmessage")) {
		$showmenu = 0;
	}
}

include ("../php/title.php");
?>
<BODY>
<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
	<div class="left_box">
    	<div class="box_tit1">
        	<h1><?php echo("论坛"); ?> :</h1>
     	</div>
      	<div class="box_txt">
      		<?php $forum->forum_bar($showmenu); ?>
				<?php
				if ($action == "addsubject") {
					if ($err) {
						$forum->addSubject($mess, $err);
					}
					else {
						$forum->showList();
					}
				}
				else if ($action == "newsubject") {
					$forum->addSubject('', '');
				}
				else if ($action == "addresponse") {
					$forum->showSubject($mess_id, $mess, $err);
				}
				else if ($action == "showmessage") {

					$forum->showSubject($mess_id, $mess, $err);
				}
				else {
					$forum->showList();
				}
				?>
     	</div>
	</div>
   	<div class=box_bg>&nbsp; </div>

</div>

<div class="right">
	<?php include "../php/right.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>

