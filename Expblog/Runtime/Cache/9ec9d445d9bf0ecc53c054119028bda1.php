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
	<div class="bread">
		<div style="float:left">当前位置：<a href="__ROOT__/">蓝天白云</a> >> <a href="">厂商列表</a></div>
			</div>	
	<div class="content">

		<h2>厂商列表</h2>

		<p class="caption">蓝天白云关注所有有力量影响互联网，改变人们生活的企业各种层面上的安全问题，你可以在蓝天白云注册为厂商来关注和修复自己企业的安全问题</p>
	
		<table class="listTable">
			<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
					<td width="130"><?php echo ($vo['exp_addtime']); ?></td>
					<td width="370"><a href="__ROOT__/Corps/company/id/<?php echo ($vo['corps_id']); ?>"><?php echo ($vo['exp_corpser']); ?></a></td>
					<td width="370"><a rel="nofollow" href="<?php echo ($vo['exp_homepage']); ?>" target="_blank"><?php echo ($vo['exp_homepage']); ?></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>

				
			</tbody>
		</table>

<p class="page">
			<?php echo ($page); ?>
				</p>


	</div>

	<br/>
     <TABLE border=0 cellSpacing=0 cellPadding=0  width="100%" 
      background=__PUBLIC__/blog/images/bg4.jpg class="footerstyle">
        </TABLE>
</BODY></HTML>