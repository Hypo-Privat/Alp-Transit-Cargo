<?php
if (!defined("INTERN_CALL")) die("<p><b>DIRECT ACCESS DENIED!</b></p>");
?>
<div class="postbox">
  <table class="tablehidden" cellspacing=0 cellpadding=0>
    <tr>
      <td nowrap>
        <div class="postname"><?=$PostName?></div>
      </td>
      <td width="100%"></td>
      <td nowrap><?php
if ($PostHome != "") {
  echo '<a href="'.$PostHome.'" target="_blank" title="'.GetLngStr("ItemWebsiteVisit", $PostName).'" class="post"><img src="'.$ImagesPath.'/lnk_home.png" style="vertical-align:text-top;" height="16" width="16" border="0" alt="'.GetLngStr("ItemWebsiteAlt").'"></a>';
}
if ($PostMail != "") {
  echo '&nbsp;<a href="'.$PostMail.'" title="'.GetLngStr("ItemEMailSend", $PostName).'" class="post"><img src="'.$ImagesPath.'/lnk_email.png" style="vertical-align:text-top;" height="16" width="16" border="0" alt="'.GetLngStr("ItemEMailAlt").'"></a>';
}
?></td>
    </tr>
  </table>
  <div class="postinfo"><?=GetLngStr("ItemInfo", $PostNo."\t".$PostTime)?></div>
  <div class="posttext"><?=$PostMsg?></div>
</div>
