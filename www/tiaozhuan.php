<?php
if(empty($_GET['igfw'])&&empty($_GET['t'])&&empty($_GET['d'])){
    echo '<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>恭喜，站点创建成功！</title>
    <style>
        .container {
            width: 60%;
            margin: 10% auto 0;
            background-color: #f0f0f0;
            padding: 2% 5%;
            border-radius: 10px
        }

        ul {
            padding-left: 20px;
        }

            ul li {
                line-height: 2.3
            }

        a {
            color: #20a53a
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>恭喜, 站点创建成功！</h1>
        <h3>这是默认index.html，本页面由系统自动生成</h3>
        <ul>
            <li>本页面在FTP根目录下的index.html</li>
            <li>您可以修改、删除或覆盖本页面</li>
            <li>FTP相关信息，请到“面板系统后台 > FTP” 查看</li>
            <li>更多功能了解，请查看<a href="https://'.$_SERVER['HTTP_HOST'].'/" target="_blank">官网('.$_SERVER['HTTP_HOST'].')</a></li>
        </ul>
    </div>
</body>
</html>';
}
if(!empty($_GET['t'])&&$_GET['t']=='admin'){?>
<form action="" method="get">
    <p><input type="hidden" name="t" value="admin" /></p>
    <p>被墙地址：<input type="text" name="i" value="<?php echo (!empty($_GET['i'])?$_GET['i']:'');?>" /> <em style="color: #EA0000; font-style:normal;">格式：wei.com</em></p>
    <p>新域地址：<input type="text" name="n" value="<?php echo (!empty($_GET['n'])?$_GET['n']:'');?>" /> <em style="color: #EA0000; font-style:normal;">格式：mei.com</em></p>
    <p><input type="submit" value="提交地址" /></p>
</form>
<?php 
    if(!empty($_GET['i'])&&!empty($_GET['n'])){
        preg_match('/^[a-zA-z0-9\.\-\/]{1,}$/', $_GET['i'], $i);
        preg_match('/^[a-zA-z0-9\.\-\/]{1,}$/', $_GET['n'], $n);
        if(empty($i[0])){exit('<em style="color: #EA0000; font-style:normal;">被墙域名</em> 格式不正确');}
        if(empty($n[0])){exit('<em style="color: #EA0000; font-style:normal;">新域地址</em> 格式不正确');}
        $gfw = $i[0];$dwz = shorturl($gfw);$new = $n[0];
        $dirJson = __DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR;
        if(!is_dir($dirJson)) {mkdirs($dirJson);}
        file_put_contents($dirJson.$dwz.'.json', serialize(array(trim($dwz),trim($gfw),trim($new))));
        echo '<p>301新短地址：https://'.$_SERVER['HTTP_HOST'].'/'.trim($dwz).'</p>';
    }
}
if(!empty($_GET['d'])){
    preg_match('/^[a-zA-z0-9\.\-\/]{1,}$/', $_GET['d'], $id);
    $igfw = getTxt(shorturl($id[0]));
    if(!empty($igfw[1])){
        exit('<html><head><meta http-equiv="Content-Language" content="zh-CN"><meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8"><script>window.location.replace(\'https://'.$_SERVER['HTTP_HOST'].'/'.shorturl($id[0]).'\');</script><meta http-equiv="refresh" content="0.1;url=https://'.$_SERVER['HTTP_HOST'].'/'.shorturl($id[0]).'"><title></title></head><body></body></html>');
    }
}
if(!empty($_GET['igfw'])){
    preg_match('/^[a-zA-z0-9\.\-\/]{1,}$/', $_GET['igfw'], $id);
    $igfw = getTxt($id[0]);
    if(!empty($igfw[0])&&$igfw[0]==$_GET['igfw']){
        if(!empty($_POST['pass'])){
            exit('<html><head><meta http-equiv="Content-Language" content="zh-CN"><meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8"><script>window.location.replace(\'http://'.trim($igfw[2]).'/'.(trim($igfw[2])=='www.baidu.com'?'s':'').'?ie=utf-8&wd=site%3A'.(trim($igfw[2])=='www.baidu.com'?$_SERVER['HTTP_HOST']:'https://'.$_SERVER['HTTP_HOST'].'/'.trim($igfw[0])).'\');</script><meta http-equiv="refresh" content="0.1;url=http://'.trim($igfw[2]).'/'.(trim($igfw[2])=='www.baidu.com'?'s':'').'?ie=utf-8&wd=site%3A'.(trim($igfw[2])=='www.baidu.com'?$_SERVER['HTTP_HOST']:'https://'.$_SERVER['HTTP_HOST'].'/'.trim($igfw[0])).'"><title></title></head><body></body></html>');
        }
        echo '<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
  <meta name="robots" content="noindex, nofollow" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Just a moment...</title>
  <style type="text/css">
    html, body {width: 100%; height: 100%; margin: 0; padding: 0;}
    body {background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size: 100%;}
    h1 {font-size: 1.5em; color: #404040; text-align: center;}
    p {font-size: 1em; color: #404040; text-align: center; margin: 10px 0 0 0;}
    #spinner {margin: 0 auto 30px auto; display: block;}
    .attribution {margin-top: 20px;}
    @-webkit-keyframes bubbles { 33%: { -webkit-transform: translateY(10px); transform: translateY(10px); } 66% { -webkit-transform: translateY(-10px); transform: translateY(-10px); } 100% { -webkit-transform: translateY(0); transform: translateY(0); } }
    @keyframes bubbles { 33%: { -webkit-transform: translateY(10px); transform: translateY(10px); } 66% { -webkit-transform: translateY(-10px); transform: translateY(-10px); } 100% { -webkit-transform: translateY(0); transform: translateY(0); } }
    .bubbles { background-color: #404040; width:15px; height: 15px; margin:2px; border-radius:100%; -webkit-animation:bubbles 0.6s 0.07s infinite ease-in-out; animation:bubbles 0.6s 0.07s infinite ease-in-out; -webkit-animation-fill-mode:both; animation-fill-mode:both; display:inline-block; }
  </style>

    <script type="text/javascript">
  //<![CDATA[
  (function(){
    var a = function() {try{return !!window.addEventListener} catch(e) {return !1} },
    b = function(b, c) {a() ? document.addEventListener("DOMContentLoaded", b, c) : document.attachEvent("onreadystatechange", b)};
    b(function(){
      var a = document.getElementById(\'cf-content\');a.style.display = \'block\';
      setTimeout(function(){
        var s,t,o,p,b,r,e,a,k,i,n,g,f, bMgrpWV={"SYk":+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]+!![])+(!+[]+!![])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]))/+((!+[]+!![]+[])+(+[])+(+!![])+(!+[]+!![])+(+!![])+(!+[]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]))};
        g = String.fromCharCode;
        o = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        e = function(s) {
          s += "==".slice(2 - (s.length & 3));
          var bm, r = "", r1, r2, i = 0;
          for (; i < s.length;) {
              bm = o.indexOf(s.charAt(i++)) << 18 | o.indexOf(s.charAt(i++)) << 12
                      | (r1 = o.indexOf(s.charAt(i++))) << 6 | (r2 = o.indexOf(s.charAt(i++)));
              r += r1 === 64 ? g(bm >> 16 & 255)
                      : r2 === 64 ? g(bm >> 16 & 255, bm >> 8 & 255)
                      : g(bm >> 16 & 255, bm >> 8 & 255, bm & 255);
          }
          return r;
        };
        t = document.createElement(\'div\');
        t.innerHTML="<a href=\'/\'>x</a>";
        t = t.firstChild.href;r = t.match(/https?:\/\//)[0];
        t = t.substr(r.length); t = t.substr(0,t.length-1); k = \'cf-dn-KyjzBJWFmuk\';
        a = document.getElementById(\'jschl-answer\');
        f = document.getElementById(\'challenge-form\');
        ;bMgrpWV.SYk+=+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![])+(+[])+(+[])+(!+[]+!![]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]))/+((+!![]+[])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(+!![])+(!+[]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]));bMgrpWV.SYk-=function(p){var p = eval(eval(e("ZG9jdW1l")+(undefined+"")[1]+(true+"")[0]+(+(+!+[]+[+!+[]]+(!![]+[])[!+[]+!+[]+!+[]]+[!+[]+!+[]]+[+[]])+[])[+!+[]]+g(103)+(true+"")[3]+(true+"")[0]+"Element"+g(66)+(NaN+[Infinity])[10]+"Id("+g(107)+")."+e("aW5uZXJIVE1M"))); return +(p)}();bMgrpWV.SYk+=+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]+!![])+(+!![])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![])+(+!![]))/+((!+[]+!![]+!![]+[])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![])+(+!![])+(!+[]+!![])+(!+[]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![]));bMgrpWV.SYk*=+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]+!![])+(!+[]+!![])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]))/+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]));bMgrpWV.SYk-=+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]))/+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]));bMgrpWV.SYk+=+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]+!![])+(!+[]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![]))/+((!+[]+!![]+!![]+!![]+[])+(!+[]+!![]+!![]+!![]+!![]+!![])+(+!![])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![])+(+!![])+(+[])+(!+[]+!![]+!![]+!![]+!![]+!![]));bMgrpWV.SYk*=+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]+!![])+(!+[]+!![])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]))/+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]));bMgrpWV.SYk*=+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]+!![])+(+!![])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]))/+((!+[]+!![]+[])+(!+[]+!![]+!![])+(!+[]+!![])+(!+[]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]));bMgrpWV.SYk+=+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]))/+((!+[]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![])+(+!![])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]));a.value = (+bMgrpWV.SYk).toFixed(10); \'; 121\'
        f.action += location.hash;
        f.submit();
      }, 9000);
    }, false);
  })();
  //]]>
</script>


</head>
<body>
  <table width="100%" height="100%" cellpadding="20">
    <tr>
      <td align="center" valign="middle">
          <div class="cf-browser-verification cf-im-under-attack">
  <noscript><h1 data-translate="turn_on_js" style="color:#bd2426;">Please turn JavaScript on and reload the page.</h1></noscript>
  <div id="cf-content" style="display:none">
    
    <div>
      <div class="bubbles"></div>
      <div class="bubbles"></div>
      <div class="bubbles"></div>
    </div>
    <h1><span data-translate="checking_browser">Checking your browser before accessing</span> '.$_SERVER['HTTP_HOST'].'.</h1>
    
    <p data-translate="process_is_automatic">This process is automatic. Your browser will redirect to your requested content shortly.</p>
    <p data-translate="allow_5_secs">Please allow up to 9 seconds&hellip;</p>
  </div>
   
  <form id="challenge-form" action="/'.trim($igfw[0]).'?__cf_chl_jschI_tk__=85da001eaef117b11622e99ed0d20fa623b56bbe-'.time().'-0-ASVXAw1WKS67TFxvT5MOqrkU8Yt39ebPPRUw889NmdIfJJThtsAOdculOHU62zpWQd87sjrNj-_4_mzQMuuvC4ZHYqNV6h0v3s6x6juMvaHbvETxxB4gAjLKUNdqiUEviJf4YV0frjZ-SIr5E27XyxHsACUItIHFcOdxoKgdd0bq_M7y1LRtV0pg6JM8xpRSQIaK8pBmctEO42m_a3Qt-vcv5qsaQxlPu-Lx6QuHYXRojYAYE1Z37fME3u4p6UKRhNaHdWX18NzAmnYQPVnQu_I" method="POST" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="r" value="3d10cceb9c596dce45e9fdda1bfcd4d0606144d6-1576297454-0-ATFFVI7q7PhNcrdYo+j2DpeflymCuqfOuf5S7uNN1aQljIdJ0To9ysFZPz2HWiomE/436WqwAXtQ01l4zv2QOZitVtNAE2wEW79xrZhmKvnCe9H146ATDaqM6IJGnqwPyLyuRLApTZ/l/AXsje6tiLtdoHIuu5h8O52PnB+d+3Ko6yhjmiUXXpd1KBh520FSQhgfJ2xjard8W53wE7xXo13gW4t3aKYzhcthSj29ePzJsWoTldfRWzVIFxMK5a2A7rEoVOQit0di4S8cas/cVi8mbFZAVemedkEv7+rrq5St4tsmDILZLXasxtx8Lv4nnhlZSCaXv4iEkcXtDNLFaDgH5hwIqwhFoXHjZc9Grg8U7FYm6Vo2YbJmWNyws8xBdLVaZtDaJk8Bp03G8IHXkjvzrkUUmqZmHQzavGuQsjjCCqVBGpS8cpbzl/8nmBrTcPE8xbwG7DWvtiA/F3AcF/z+XYnBMk5uqYdXYawOSP8LRuseML5mi2vdwDin6XocogZPFgaTxy6hqYgCW5v0eCbTMlmJ3PB4uAE1e1j7JQ5nt+2j93JDUuw5F56lnOIwLgbBVdzo/YJc1dJCg0rrbj6ePFf5W1DhMd7L7jn+xQzEmWHFLnVbC/wKVg5uuGuUTt+e3Ls8O2KVpRpZ2BuOVcB+MQDX7vm23/tDZbu4rt5H0CVOnJj4LxQ0y2t0Oizp/Ka25RymSwFD1FPZaBdLFInFU6ODGfg9Jhocq5bp/W05ZthVWTRXH4GplfbquCHsmrT96TWzRN4YHKLNTcTMNFHT1mC9C5UcVLYGKzkJWUrmn2ssQsQkg4mPN4ljo3pbD5L5ZSod/9NEdtTQQRNgV2B0BMmwo62iwqXIb//13qYWbnda5gIsjC33PZMBl+CXyfgb8UXX+8TBMNNEC0g20spL31lyopAiaEClMeVbX1TmWCXw5TSFG/Wsv/fkEFnWw4Mq+64C3oQO477wULk78PQXYnhpRpBD9ZM+JT4fjsY5twCW2Cyhw7tY9FG28RINsRGwlSNMPKO6LEjXBHPmXW1K9JyYB+19Brmm+VXk7v1QPXUCUow8jRuO5kT63YRgJgY05hI0rXB153oGwp9qDfOmpvlh1etCCMwGkkr3ie1LgIbPM4m1FgGrI5Mby8HzkTMOWwP7HsSnYFXq2GQzuJE="></input>
    <input type="hidden" name="jschl_vc" value="22effb17230752f15dcf299dbf45a523"/>
    <input type="hidden" name="pass" value="'.time().'.798-t2ssYaK6tR"/>
    <input type="hidden" id="jschl-answer" name="jschl_answer"/>
  </form>
  
  <div style="display:none;visibility:hidden;" id="cf-dn-KyjzBJWFmuk">+((!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]+!![])+(!+[]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![]))/+((!+[]+!![]+!![]+!![]+!![]+[])+(+[])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![])+(!+[]+!![]+!![]+!![]+!![])+(+[])+(!+[]+!![]+!![]+!![]+!![])+(!+[]+!![]))</div>
  
</div>

          <!-- <a href="https://derchris.net/fungoidintensity.php?tag=47">table</a> -->
          <div class="attribution">
            <a href="https://www.cloudflare.com/5xx-error-landing?utm_source=iuam" target="_blank" style="font-size: 12px;">DDoS protection by Cloudflare</a>
            <br>
            Ray ID: '.substr(md5(trim($igfw[2]).time()), 1, 16).'
          </div>
      </td>
     
    </tr>
  </table>
</body>
</html>';
    }
}
function code62($x) {
    $show = '';
    while($x > 0) {
        $s = $x % 62;
        if ($s > 35) {
            $s = chr($s+61);
        } elseif ($s > 9 && $s <=35) {
            $s = chr($s + 55);
        }
        $show .= $s;
        $x = floor($x/62);
    }
    return $show;
}
function shorturl($url) {
    $url = crc32($url);
    $result = sprintf("%u", $url);
    return code62($result);
}
function getTxt($file) {
    $_getFile = @file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.$file.'.json');
    if(empty($_getFile)){return array($file, 'www.baidu.com', 'www.baidu.com');}
    return unserialize($_getFile);
}
function mkdirs($path) {
    if(!is_dir($path)) {
        mkdirs(dirname($path));
        if(!mkdir($path, 0755)) {
            return false;
        }
    }
    return true;
}

/**
 * cloudflare.com
 * 
 * rpm -Uvh http://nginx.org/packages/centos/7/noarch/RPMS/nginx-release-centos-7-0.el7.ngx.noarch.rpm
 * 
 * yum install -y nginx
 * 
 * systemctl start nginx.service
 * 
 * systemctl enable nginx.service
 * 
 * robots.txt
 * User-Agent:  *
 * Disallow:  /
 * 
 * .htaccess
 * RewriteEngine On
 * RewriteBase / 
 * RewriteRule ^([a-zA-z0-9]{1,})$ index.php?igfw=$1
 * 
 * nginx.conf
 * location / {
 *   rewrite "^/([a-zA-z0-9]{1,})$" /index.php?igfw=$1;
 * }
 * 
 * rewrite ^/(.*)$ https://domain.com/?d=$host&f=$1 permanent;
 * 
 */
 
?>
