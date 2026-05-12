<style type="text/css">
    .mod-login-content input.txt-input{background:#fafafa;border:1px solid #d1d1d1;-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;width:268px;height:38px;line-height:38px;padding:0 10px}
    #registerForm .mod-login-content input.txt-input{height:28px;line-height:28px;padding:0 5px;width:280px}
    .mod-login-content .rows{padding:0 0 10px;width:292px}
    .mod-login-content label{display:block;padding:0 0 5px}
    .login-block .border-left{border-left:1px solid #ededed}.login-block .button-set{text-align:center;padding:10px 0 25px}
    .login-block button.button span{border:1px solid #980804;-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;height:38px;line-height:38px;width:150px;padding:0 !important;background-color:#b8100d;background-image:linear-gradient(to bottom, #b8100d, #960501)}
    .login-block .lightbox{background:#fff5cb;border:1px solid #f1e5b1;-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;padding:8px 15px;margin:10px 0 0}
    .login-block .error{color:#df0400;font-size:10px}
    .login-block span.success{display:block;font-size:18px;padding:18px;text-align:center}
    button span{background:url(<?php echo $uri_root ?>public/client/images/sprites11.png) no-repeat left -251px;display:block;height:25px;padding:0px 0px 0px 10px !important;font:14px/25px Tahoma, Geneva, sans-serif;color:#fff;white-space:nowrap}
    button.button{-webkit-border-fit:lines}
    button.button{overflow:visible;width:auto;border:0;padding:0;margin:0;background:transparent;cursor:pointer}
</style>
<h1 style="position: absolute; text-indent: -99999px">Đăng nhập</h1>
<div class="page-title-xs"><strong>Đăng nhập</strong></div>
<div class="login-block" style="padding:10px">
    <?php if ($suc): ?>
        <table>
            <tr>
                <td valign="top">
                    <div class="title-login"><h3>Đăng ký thành công!</h3></div>
                    <?php echo $msg; ?>
                </td>
            </tr>
        </table>        
    <?php else: ?>
        <table>
            <tr>
                <td valign="top">
                    <form name="loginForm" method="post" action="">
                        <div class="mod-login-content border-left">
                            <div class="rows clearfix">
                                <label class="left">Tên đăng nhập</label>
                                <?php echo form_error('username', '<div class="error right">', '</div>') ?>
                                <div class="clearfix"></div>
                                <input id="login_username" autocomplete="off" name="username" type="text" value="Nhập user hoặc email" class="txt-input" />
                            </div>
                            <div class="rows clearfix">
                                <label class="left">Mật khẩu</label>
                                <?php echo form_error('password', '<div class="error right">', '</div>') ?>
                                <div class="clearfix"></div>
                                <input id="login_password" name="password" autocomplete="off" type="password" value="" class="txt-input" />
                                <input id="login_plain_password" autocomplete="off" name="plain_password" type="text" value="Nhập mật khẩu" class="txt-input" />
                            </div>
                            <div class="rows clearfix">
                                <label><input name="re_pass" value="1" type="checkbox" /> Nhớ mật khẩu</label>
                            </div>
                            <div class="rows button-set">
                                <input type="hidden" name="register" value="0" />
                                <input name="url" type="hidden" value="<?php echo (isset($_SESSION["redirect_url"]) ? $_SESSION["redirect_url"] : site_url()); ?>"/>
                                <button type="submit" class="button"><span>Đăng nhập</span></button>
                            </div>
                            <style type="text/css">
                                .btn-sharelike {
                                    margin: 0 auto;
                                    padding: 10px 0;
                                    width: 175px;
                                }
                                .btn-sharelike a {
                                    float: left;
                                    line-height: 25px;
                                    margin: 0 20px;
                                    padding: 0;
                                    text-align: center;
                                }
                                .btn-sharelike a.suport-yahoo {
                                    margin-right:0;
                                }
                            </style>
<!--                            <div style="width:327px;text-align:center">
                                <div style="font-weight:bold;font-size:11px">Hoặc đăng nhập bằng tài khoản bên dưới</div>
                                <div class="btn-sharelike clearfix">
                                    <div class="sharein">
                                        <a dir="facebook" class="openid o-facebook" rel="nofollow" style="cursor: pointer">
                                            <img src="<?php echo img_link('facebook.gif'); ?>" alt="Đăng nhập với tài khoản facebook" title="Đăng nhập với tài khoản facebook" />
                                            <br />
                                            <span style="font-weight: bold;font-size: 11px;">Facebook</span>
                                        </a>
                                        <a dir="google" class="openid o-google" rel="nofollow" style="cursor: pointer">
                                            <img src="<?php echo img_link('google.gif'); ?>" alt="Đăng nhập với tài khoản Gmail" title="Đăng nhập với tài khoản Gmail" />
                                            <br />
                                            <span style="font-weight: bold;font-size: 11px;">Gmail</span>
                                        </a>
                                        <a dir="twitter" class="openid o-twitter" rel="nofollow" style="cursor: pointer">
                                            <img src="<?php //echo img_link('twitter.gif'); ?>" alt="Đăng nhập với tài khoản Twitter" title="Đăng nhập với tài khoản Twitter" />
                                            <br />
                                            <span style="font-weight: bold;font-size: 11px;">Twitter</span>
                                        </a>
                                        <a dir="yahoo" class="suport-yahoo openid" rel="nofollow" style="cursor: pointer">
                                            <img src="<?php //echo img_link('yahoo.gif'); ?>" alt="Đăng nhập với tài khoản Yahoo" title="Đăng nhập với tài khoản Yahoo" />
                                            <br />
                                            <span style="font-weight: bold;font-size: 11px;">Yahoo</span>
                                        </a>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    jQuery('a.openid').click(function(){
                                        var _width = 700;
                                        var Xpos = ((screen.availWidth - _width)/2);
                                        var _height = 500;
                                        var Ypos =((screen.availHeight - _height)/2);                
                                        vWin = window.open('<?php echo $uri_root ?>openid/' + jQuery(this).attr('dir'),"CM_OpenID","width=" + _width + ",height=" + _height + ",resizable,scrollbars=yes,status=1");        
                                        tWin();
                                    });                   
                                </script>
                            </div>-->
                            <div class="clearfix">
                                <div><strong>Quên mật khẩu?</strong></div>
                                <div>Soạn tin: <strong class="red">DV &lt;User&gt;</strong> gửi <strong class="red">8017</strong> để nhận ngay mật khẩu mới.</div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#login_plain_password").show();
                $("#login_password").hide();
                $("#login_username").blur(function(){
                    if(this.value=='' || this.value==' '){this.value='Nhập user hoặc email';}
                });
                $("#login_username").click(function(){
                    if(this.value=='Nhập user hoặc email'){
                        this.value='';
                    }
                    $("#login_password").val('');
                    $("#login_password").hide();
                    $("#login_plain_password").show();
                });
                $("#login_plain_password").focus(function() {
                    $(this).hide();  
                    $("#login_password").show();
                    $("#login_password").focus();  
                });
                $("#login_password").blur(function(){
                    if(this.value=='' || this.value==' '){this.value='Nhập mật khẩu';}
                    if($(this).val().length == 0){
                        $(this).hide();  
                        $("#login_plain_password").show();
                    }   
                });
            });
        </script>
    <?php endif; ?>
</div>