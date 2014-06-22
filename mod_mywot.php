<?php
defined('_JEXEC') or die;
$wot_api_key=$params->get( 'keywot', '' );
$sitename=$_SERVER['HTTP_HOST'];
echo JText::_('MOD_MYWOT_TEXT_DOMAIN').": ";
$url="http://api.mywot.com/0.4/public_link_json2?hosts=mysite/".$sitename."/&callback=process&key=".$wot_api_key;
$json=preg_replace('/.+?({.+}).+/','$1',file_get_contents($url));
$array= json_decode($json, true);
if(isset($array[$sitename]['0']['0'])){
$i=$array[$sitename]['0']['0'];
if ($i>= 0&&$i<20) {
    $img="very poor.png";
} elseif ($i>= 20&&$i<40)  {
    $img="poor.png";
} elseif ($i>= 40&&$i<60) {
    $img="unsatisfactory.png";
}
elseif ($i>= 60&&$i<80) {
    $img="good.png";
}
elseif ($i>= 80) {
    $img="excellent.png";
}

echo "<a href='http://".$sitename."'>".$sitename."</a>, ".JText::_('MOD_MYWOT_TEXT_RANKS')." <a href='https://www.mywot.com/ru/scorecard/".$sitename."' rel='nofollow'>WOT <img src='/joomla/modules/mod_mywot/img/".$img."'></a>";
}
else {echo ", не имеет рейтинга <a href='https://www.mywot.com/ru/scorecard/".$sitename."' rel='nofollow'>MyWot</a>";}
?>