// 导航栏配置文件
var outlookbar=new outlook();
var t;
t=outlookbar.addtitle('厂商管理','系统设置',1)
outlookbar.additem('添加厂商',t,APP+'/corps')
outlookbar.additem('厂商管理',t,APP+'/corps/managecorps')
outlookbar.additem('厂商邀请码',t,APP+'/Member/showcode')


t=outlookbar.addtitle('漏洞管理','漏洞管理',1)
outlookbar.additem('漏洞管理',t,APP+'/exploit')
outlookbar.additem('漏洞类型',t,APP+'/exploit/showexpcate')


t=outlookbar.addtitle('会员管理','会员管理',1)
outlookbar.additem('会员管理',t,APP+'/Member')
outlookbar.additem('会员邀请码',t,APP+'/Member/showcode')


t=outlookbar.addtitle('退出系统','管理首页',1)
outlookbar.additem('点击退出登录',t,APP+'/Login/loginout')