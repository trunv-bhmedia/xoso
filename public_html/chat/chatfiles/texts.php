<?php
// Texts added in site (English)
$en_site = array(
  'chat'=>'Chat',
  'name'=>'Nickname',
  'code'=>'Mã bảo mật',
  'addnmcd'=>'Nhập Nickname và mã bảo mật',
  'chatlogged'=>'<h4 id="chlogged">To can add texts in chat, you must be logged in.</h4>',
  'online'=>'Online',
  'no1online'=>'- No-one online',
  'loadroom'=>'<h3>Loadding Chat-Room</h3>',
  'notchat'=>'',
  'addurl'=>'Add URL without http://',
  'logoutchat'=>'Thoát',
  'enterchat'=>'Hi <b>%s</b> Enter the Chat',
  'emptyroom'=>'Select a Chat-Room to empty',
  'cadmpass'=>'Admin Password:',
  'sbmemptyroom'=>'Empty Chat-Room',
  'emptedroom'=>'The chat room: <b>%s</b> is empty',
  'err_emptedroom'=>'Cannot empty the chat room: ',
  'err_savechat'=>'Unable to save data in: %s , or the file cannot be created',
  'err_name'=>'Nickname có độ dài từ 2 đến 12 ký tự.\n- Có thể có khoảng trắng và không chứa ký tự đặc biệt.',
  'err_nameused'=>' - Nickname đã tồn tại. \n Chọn nickname khác',
  'err_vcode'=>'Sai mã bảo mật',
  'err_textchat'=>'Nội dung phải chứa từ 2 đến 200 ký tự',
  'err_addurl'=>'Incorrect URL format',
  'err_adminpass'=>'<h3 style="margin:2em auto 2em 40%; color:#fe0100;">Incorrect Password</h3>'
);


// Sets an json object for JavaScript with text messages according to language set
function jsTexts($lsite) {
  // define the JavaScript json object
$texts = 'var texts = {
 "online":"'.$lsite['online'].'",
 "no1online":"'.$lsite['no1online'].'",
 "notchat":"'.$lsite['notchat'].'",
 "err_name":"'.$lsite['err_name'].'",
 "err_nameused":"'.$lsite['err_nameused'].'",
 "err_vcode":"'.$lsite['err_vcode'].'",
 "err_textchat":"'.$lsite['err_textchat'].'",
 "err_addurl":"'.$lsite['err_addurl'].'",
 "loadroom":"'.$lsite['loadroom'].'",
 "addurl":"'.$lsite['addurl'].'"
};';

  return '<script type="text/javascript"><!--'.PHP_EOL.
  $texts.PHP_EOL.
  '//-->
  </script>';
}