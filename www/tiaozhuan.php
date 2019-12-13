<?php if(!empty($_GET['t'])&&$_GET['t']=='admin'){?>
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
        echo '<p>301新短地址：http://'.$_SERVER['HTTP_HOST'].'/'.trim($dwz).'</p>';
    }
}
?>
<?php 
if(!empty($_GET['IGFW'])){
    preg_match('/^[a-zA-z0-9\.\-\/]{1,}$/', $_GET['IGFW'], $id);
    $igfw = getTxt($id[0]);
    if(!empty($igfw[0])&&$igfw[0]==$_GET['IGFW']){
        $baidu = 'https://www.baidu.com/s?ie=utf-8&wd=site:qq.com 原 '.trim($igfw[1]).' 域名被墙，请收藏新域名 ';
        exit('<html><head><meta http-equiv="Content-Language" content="zh-CN"><meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8"><meta http-equiv="refresh" content="0.1;url='.$baidu.trim($igfw[2]).'"><title></title></head><body></body></html>');}
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
    if(empty($_getFile)){return array($file, 'http://www.baidu.com/s?ie=utf-8&wd=qq.com');}
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
?>
