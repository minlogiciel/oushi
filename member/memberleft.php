
<!--多语言--开始-->
<SCRIPT type=text/javascript>
var a=function(id) {
   return document.getElementById(id);
}
function show_menuC(numC) {
	for(j=0;j<100;j++) {
		if(j!=numC) {                        
			if(a('wtp0'+j)) {              
				a('wtp0'+j).style.display='none'; 
			}
		}
	}
	if(a('wtp0'+numC)){                              
		if(a('wtp0'+numC).style.display=='block'){ 
			a('wtp0'+numC).style.display='none';
		} else {
			a('wtp0'+numC).style.display='block'; 
		}
	}
} 
$(document).ready(function(){
	var thisContent = document.getElementById('l1').innerHTML;
	if(thisContent=='孔院快讯'){
			$("#img1").html('孔院快讯');
			$("#g2").addClass("on");
	}else if(thisContent=='热点话题'){
			$("#img1").html('热点话题');
			$("#g3").addClass("on");
	}else if(thisContent=='文化信息'){
			$("#img1").html('文化信息');
			$("#g4").addClass("on");
	}else if(thisContent=='新闻汉语'){
			$("#img1").html('新闻汉语');			
	}else if(thisContent=='视频新闻'){
			$("#img1").html('视频新闻');
	}else if(thisContent=='图片新闻'){
			$("#img1").html('图片新闻');					
	}else if(thisContent=='名家讲堂'){
			$("#img1").html('名家讲堂');	
	}else if(thisContent=='名家讲堂2'){
			$("#img1").html('名家讲堂');	
	}else if(thisContent=='全球孔院'){
			$("#img1").html('全球孔院');	
			$("#g115").addClass("on");
	}		
			
});
</SCRIPT>

<SCRIPT language=javascript>
    $(document).ready(function(){                      
        $("a").bind("focus",function(){
            if(this.blur){
                this.blur(); 
             }
        });
    });
</SCRIPT>

<SCRIPT language=JavaScript>  
function ResumeError() { 
return true; 
} 
window.onerror = ResumeError; 
</SCRIPT>
<!--多语言--结束-->

<DIV style="DISPLAY: none" id=l1>孔院快讯</DIV>
<DIV class=wrap>
<SCRIPT type=text/javascript src="javascript/kongyuan_quan.js"></SCRIPT>







<TABLE cellSpacing=0 cellPadding=0 width=100% align=center>
	<TR>
		<TD valign=top height=10>
<DIV class=playList>
<UL>
	<LI class=player>
    	<DIV id=g111 class=title>
    		<H3><A href="http://www.chinese.cn/college/newsexpress/">孔院快讯</A></H3>
    	</DIV>
    </LI>
    <LI class=player>
    	<DIV id=g112 class=title> 
        	<H3><A href="http://www.chinese.cn/college/ciworldwide">全球孔院</A></H3>
        </DIV>
        <DIV id=g115 class=playerBox>
        	<DIV id=g1 class=playerBox_tit>
        		<A href="http://www.chinese.cn/college/article/2009-08/28/content_46128.htm">亚洲</A>
        	</DIV>
         	<DIV id=g35 class=playerBox_tit>
         		<A href="http://www.chinese.cn/college/article/2009-09/09/content_52260.htm">美洲</A>
         	</DIV>
         	<DIV id=g51 class=playerBox_tit>
         		<A href="http://www.chinese.cn/college/article/2009-08/28/content_49323.htm">欧洲</A>
         	</DIV>
          	<DIV id=g114 class=playerBox_tit>
          		<A  href="http://www.chinese.cn/college/article/2009-08/28/content_49324.htm">非洲</A>
          	</DIV>
         	<DIV id=g107 class=playerBox_tit>
         		<A href="http://www.chinese.cn/college/article/2009-08/28/content_49325.htm">大洋洲</A>
         	</DIV>
       </DIV>
	</LI>
	<LI class=player>
        <DIV id=g113 class=title>
        	<H3><A href="http://www.chinese.cn/college/mastersforum">名家讲堂</A></H3>
        </DIV>
	</LI>
</UL>
</DIV>
		
		
		</TD>
	</TR>
	<TR>
		<TD valign=top height=10></TD>
	</TR>
	<TR>
		<TD valign=top>
			<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
				<TR>
					<TH vAlign=top>欧洲时报中文学校</TH>
				</TR>
				<tr>
					<td valign=top class=list1 height=20>
						<div align=left>
							&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
							<a href="../member/member.php?action=<?php echo($ALLSTUDENTS);?>">所有学生</a>
						</div>
					</td>
				</tr>
				<tr>
					<td valign=top class=list1 height=20>
						<div align=left>
							&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
							<a href="../member/member.php?action=<?php echo($OLDSTUDENTS);?>">过去学生</a>
						</div>
					</td>
				</tr>
				<TR>
					<TD>
						<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% align=center>
							<?php 
							$nb_cls =  count($CLASS_NAME);
							for ($i = 0; $i < $nb_cls; $i+=2 ) {
								$clsname = $CLASS_NAME[$i];
								?>
							<tr>
								<TH vAlign=top><?php echo($clsname); ?></TH>
							</tr>
							<tr>
								<td valign=top class=list1>
									<div align=left>
										&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
										<a href="../member/member.php?classes=<?php echo($i); ?>&action=<?php echo($CLASSMEMBER);?>">班级成员</a>
									</div>
								</td>
							</tr>
							<tr>
								<td valign=top class=list1>
									<div align=left>
										&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
										<a href="../member/member.php?classes=<?php echo($i); ?>&action=<?php echo($INPUTSCORES);?>">输入成绩</a>
									</div>
								</td>
							</tr>
							<tr>
								<td valign=top class=list1>
									<div align=left>
										&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
										<a href="../member/member.php?classes=<?php echo($i); ?>&action=<?php echo($SHOWSCORES);?>">显示成绩</a>
									</div>
								</td>
							</tr>
							<tr>
								<TD height=15 class=list1></TD>
							</tr>
							<?php } ?>

						</TABLE>
					</TD>
				</TR>
			</TABLE>
		</TD>
	</TR>

</table>
