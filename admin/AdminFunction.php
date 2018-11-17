<?php

function getNewsVariables($newstype, $nindex)
{
	global $JY_NEWS, $FASTNEWS_JY, $JL_NEWS, $FASTNEWS_JL, $WY_NEWS,  $FASTNEWS_WY, $ASSO_NEWS, $FASTNEWS_ASSO;
	$vname = "";
	$ivname = "";
	$iname = "";
	$fname = "";
	$flist = "";
	$l_fname = "";
	$l_flist = "";
	$nb = 1;
	$n = 0;
	if ($newstype == $FASTNEWS_JY) {
		$nb = count($JY_NEWS);
		$ivname = "JY_NEWS";
		$iname = "jy_news";
		$flist = "../public/jynews/jynews_lists.inc";		
		$fname = "../public/jynews/jy_news";
		$l_flist = "../public/lastnews/jiaoyunews/jiaoyulastnews.inc";		
		$l_fname = "../public/lastnews/jiaoyunews/jy_news";

		$f_flist = "../french/lastnews/jiaoyunews/jiaoyulastnews.inc";		
		$f_fname = "../french/lastnews/jiaoyunews/jy_news";
	}
	else if ($newstype == $FASTNEWS_JL) {
		$nb = count($JL_NEWS);
		$ivname = "JL_NEWS";
		$iname = "jl_news";
		$flist = "../public/jlnews/jlnews_lists.inc";			
		$fname = "../public/jlnews/jl_news";
		$l_flist = "../public/lastnews/jiaoliunews/jiaoliulastnews.inc";		
		$l_fname = "../public/lastnews/jiaoliunews/jl_news";

		$f_flist = "../french/lastnews/jiaoliunews/jiaoliulastnews.inc";		
		$f_fname = "../french/lastnews/jiaoliunews/jl_news";
	} else if ($newstype == $FASTNEWS_WY) {
		$nb = count($WY_NEWS);
		$ivname = "WY_NEWS";
		$iname = "wy_news";
		$flist = "../public/wynews/wynews_lists.inc";			
		$fname = "../public/wynews/wy_news";
		$l_flist = "../public/lastnews/wenyunews/wenyulastnews.inc";		
		$l_fname = "../public/lastnews/wenyunews/wy_news";

		$f_flist = "../french/lastnews/wenyunews/wenyulastnews.inc";		
		$f_fname = "../french/lastnews/wenyunews/wy_news";
	} else if ($newstype == $FASTNEWS_ASSO) {
		$nb = count($ASSO_NEWS);
		$ivname = "ASSO_NEWS";
		$iname = "asso_news";
		$flist = "../public/assonews/assonews_lists.inc";			
		$fname = "../public/assonews/asso_news";
		$l_flist = "../public/lastnews/huajianews/huajialastnews.inc";		
		$l_fname = "../public/lastnews/huajianews/asso_news";

		$f_flist = "../french/lastnews/huajianews/huajialastnews.inc";		
		$f_fname = "../french/lastnews/huajianews/asso_news";
	}
	
	if ($nindex < 0) {
		$nb++;
		$n = $nb;
	}
	else {
		$n = $nindex+1;
	}
	$vname = $ivname.$n;
	$fname .= $n.".inc";
	$l_fname .= $n.".inc";
	$f_fname .= $n.".inc";
	return array($flist, $iname, $ivname, $fname, $vname, $nb, $l_flist, $l_fname, $f_flist, $f_fname);

}
	
function getNewsIndex($newstype)
{
	global $JY_NEWS, $FASTNEWS_JY, $JL_NEWS, $FASTNEWS_JL, $WY_NEWS,  $FASTNEWS_WY, $ASSO_NEWS, $FASTNEWS_ASSO;
	$n = -1;
	if ($newstype == $FASTNEWS_JY) {
		$n = count($JY_NEWS);
	}
	else if ($newstype == $FASTNEWS_JL) {
		$n = count($JL_NEWS);
	} else if ($newstype == $FASTNEWS_WY) {
		$n = count($WY_NEWS);
	} else if ($newstype == $FASTNEWS_ASSO) {
		$n = count($ASSO_NEWS);
	}
	return $n;
}

?>