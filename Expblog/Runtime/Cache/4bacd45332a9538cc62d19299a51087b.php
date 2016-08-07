<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0031)index.php -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>蓝天白云| 自由平等的漏洞报告平台</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<META name=author content=80sec>
<META name=copyright content=>
<META name=keywords content=,蓝天白云,应用安全,web安全,系统安全,网络安全,漏洞公布,漏洞报告,安全资讯。>
<META name=description content=蓝天白云是一个位于厂商和安全研究者之间的漏洞报告平台,注重尊重,进步,与意义><LINK 
title="蓝天白云.org 最新提交漏洞" rel=alternate type=application/rss+xml 
href=" feeds/submit"><LINK title="蓝天白云.com 最新确认漏洞" 
rel=alternate type=application/rss+xml 
href=" feeds/confirm"><LINK title="蓝天白云.com 最新公开漏洞" 
rel=alternate type=application/rss+xml 
href=" feeds/public"><LINK rel=stylesheet type=text/css 
href="__PUBLIC__/blog/css/style.css">
<SCRIPT type=text/javascript 
src="__PUBLIC__/blog/js/jquery-1.4.2.min.js"></SCRIPT>
<style>
.footerstyle TD A{color:#AB8D13}
.footerstyle TD A:visited {COLOR: #white; TEXT-DECORATION: none}
.footerstyle TD A:hover {COLOR: #white;}

</style>

<META name=GENERATOR content="MSHTML 8.00.6001.19046"></HEAD>
<BODY>
<DIV class=banner>
<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" 
align=center>
  <TBODY>
      <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" >
        <TBODY>
        <TR>
		<img src="__PUBLIC__/blog/images/logo.png"><h2 >可信网络、安全世界、领航信息安全</h2>
          <TD height=48 colSpan=2 noWrap 
          align=left>&nbsp; <B><A href="__ROOT__/index" 
            target=_self>首页</A> |</B> <B><A 
            href="__ROOT__/Corps" target=_self>厂商列表</A> 
            |</B> <B><A href="__ROOT__/Whitehats" 
            target=_self>白帽子</A> |</B> <B><A 
            href="__ROOT__/bugs" target=_self>漏洞列表</A> 
            |</B> <B><A href="__ROOT__/bugsub" 
            target=_self>提交漏洞</A> |</B>   | 
            <?php if(isset($_SESSION['username'])): ?><B>&nbsp;&nbsp;欢迎<A 
            href="__ROOT__/Member/memberinfo" target=_self><?php echo ($_SESSION['username']); ?></A>白帽 <a href="__ROOT__/Member">控制面板</a>| <a href="__ROOT__/Member/loginout" class="reg">退出</a>  |</B> 
            <?php else: ?>
            <B><A 
            href="__ROOT__/Whitehats/userlogin" target=_self>白帽登陆</A> |</B>
           
            |<B><?php endif; ?>
                       <?php if(isset($_SESSION['corps_id'])): ?><B>&nbsp;&nbsp;欢迎<A 
            href="__ROOT__/Managecorps/corpsinfo" target=_self><?php echo ($_SESSION['exp_corpser']); ?></A>厂商<a href="__ROOT__/Managecorps">控制面板</a>| <a href="__ROOT__/Managecorps/loginout" class="reg">退出</a>  |</B> 
            <?php else: ?>
            <B><A 
            href="__ROOT__/Corps/corpslogin" target=_self>厂商登陆</A> |</B><?php endif; ?>

              </TD></TR></TBODY></TABLE>
<DIV class=bread>
<DIV style="FLOAT: left">当前位置：<A 
href="http://www.蓝天白云.com">蓝天白云</A> &gt;&gt; <A 
href="">首页</A></DIV>
<STYLE>#scroll_box {
	TEXT-ALIGN: right; PADDING-BOTTOM: 0px; MARGIN: 0px 15px 0px 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; FLOAT: right; HEIGHT: 24px; OVERFLOW: hidden; PADDING-TOP: 0px
}
#scroll_box LI {
	LINE-HEIGHT: 24px; LIST-STYLE-TYPE: none; LIST-STYLE-IMAGE: none
}
</STYLE>

<UL id=scroll_box>
  <LI><A 
  href="#">蓝天白云开张喽</A></LI>
</UL>
<SCRIPT language=javascript>
var o=document.getElementById('scroll_box');
setInterval(function(){scrollup(o,24,0)},3000); 
function scrollup(o,d,c){
	if(d==c){
		var t=getFirstChild(o.firstChild).cloneNode(true);
		o.removeChild(getFirstChild(o.firstChild));
		o.appendChild(t);
		t.style.marginTop="0px";
	}else{
		c+=2;
		getFirstChild(o.firstChild).style.marginTop=-c+"px";
		window.setTimeout(function(){scrollup(o,d,c)},20);
	}
}
function getFirstChild(node){
	while(node.nodeType!=1){
		node=node.nextSibling;
	}
	return node;
}
</SCRIPT>
</DIV>
<SCRIPT type=text/javascript>

$(function(){

	
	$(".listTable tbody tr").hover(function(){
		
		$(this).css("background","#EBEBEB");

	},function(){
	
		$(this).css("background","none");

	});

});

</SCRIPT>

<DIV class=content>
<H3><A href="__ROOT__/index/getexpbyid/id/1">最新提交</A><A class=catrss 
href="#"></A></H3>
<TABLE class=listTable>
  <THEAD>
  <TR>
    <TH width=90>提交日期</TH>
    <TD width=800>漏洞名称</TD>
    <TH width=60>作者</TH></TR></THEAD>
  <TBODY>
   <?php if(is_array($res1)): $i = 0; $__LIST__ = $res1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): ++$i;$mod = ($i % 2 )?><TR>
  

    <TH><?php echo ($vo1['exp_post_time']); ?></TH>
    <TD><A href="bugs/getdetailexp/postid/<?php echo ($vo1['id']); ?>"><?php echo ($vo1['exp_post_title']); ?></A> 
    </TD>
    <TH><A href="__ROOT__/Whitehats/viewhitehat/id/<?php echo ($vo1['euid']); ?>"><?php echo ($vo1['exp_username']); ?></A></TH>
    
 </TR><?php endforeach; endif; else: echo "" ;endif; ?>
  </TBODY></TABLE>

<H3><A href="__ROOT__/index/getexpbyid/id/2">最新公开</A><A class=catrss 
href="#"></A></H3>
<TABLE class=listTable>
  <THEAD>
  <TR>
    <TH width=90>提交日期</TH>
    <TD width=800>漏洞名称</TD>
    <TH width=60>作者</TH></TR></THEAD>
  <TBODY>
  <?php if(is_array($res2)): $i = 0; $__LIST__ = $res2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): ++$i;$mod = ($i % 2 )?><TR>
  

    <TH><?php echo ($vo2['exp_post_time']); ?></TH>
    <TD><A href="bugs/getdetailexp/postid/<?php echo ($vo2['id']); ?>"><?php echo ($vo2['exp_post_title']); ?></A> 
    </TD>
    <TH><A href="__ROOT__/Whitehats/viewhitehat/id/<?php echo ($vo2['euid']); ?>"><?php echo ($vo2['exp_username']); ?></A></TH>
    
 </TR><?php endforeach; endif; else: echo "" ;endif; ?></TBODY></TABLE>
<H3><A href="__ROOT__/index/getexpbyid/id/3">最新确认</A><A class=catrss 
href="#"></A></H3>
<TABLE class=listTable>
  <THEAD>
  <TR>
    <TH width=90>提交日期</TH>
    <TD width=800>漏洞名称</TD>
    <TH width=60>作者</TH></TR></THEAD>
  <TBODY>
 <?php if(is_array($res3)): $i = 0; $__LIST__ = $res3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): ++$i;$mod = ($i % 2 )?><TR>
  

    <TH><?php echo ($vo3['exp_post_time']); ?></TH>
    <TD><A href="bugs/getdetailexp/postid/<?php echo ($vo3['id']); ?>"><?php echo ($vo3['exp_post_title']); ?></A> 
    </TD>
    <TH><A href="__ROOT__/Whitehats/viewhitehat/id/<?php echo ($vo3['euid']); ?>"><?php echo ($vo3['exp_username']); ?></A></TH>
    
 </TR><?php endforeach; endif; else: echo "" ;endif; ?></TBODY></TABLE>
<H3><A href="__ROOT__/index/getexpbyid/id/4">等待认领</A><A class=catrss 
href="#"></A></H3>
<TABLE class=listTable>
  <THEAD>
  <TR>
    <TH width=90>提交日期</TH>
    <TD width=800>漏洞名称</TD>
    <TH width=60>作者</TH></TR></THEAD>
  <TBODY>
    <?php if(is_array($res4)): $i = 0; $__LIST__ = $res4;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo4): ++$i;$mod = ($i % 2 )?><TR>
  

    <TH><?php echo ($vo4['exp_post_time']); ?></TH>
    <TD><A href="bugs/getdetailexp/postid/<?php echo ($vo4['id']); ?>"><?php echo ($vo4['exp_post_title']); ?></A> 
    </TD>
    <TH><A href="__ROOT__/Whitehats/viewhitehat/id/<?php echo ($vo4['euid']); ?>"><?php echo ($vo4['exp_username']); ?></A></TH>
    
 </TR><?php endforeach; endif; else: echo "" ;endif; ?></TBODY></TABLE></DIV>

	<br/>
     <TABLE border=0 cellSpacing=0 cellPadding=0  width="100%" 
      background=__PUBLIC__/blog/images/bg4.jpg class="footerstyle">
        </TABLE>
</BODY></HTML>