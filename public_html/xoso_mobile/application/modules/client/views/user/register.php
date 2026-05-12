<style type="text/css">
    .mod-login-content input.txt-input{background:#fafafa;border:1px solid #d1d1d1;-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;width:304px;height:38px;line-height:38px;padding:0 10px}
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
<h1 style="position: absolute; text-indent: -99999px">Đăng ký thành viên</h1>
<div class="page-title-xs"><strong>Đăng ký thành viên</strong></div>
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
                    <form name="registerForm" id="registerForm" method="post" action="">
                        <div class="mod-login-content">
                            <div class="rows clearfix">
                                <label class="left">Tên đăng nhập <span class="red">*</span></label>
                                <?php echo form_error('r_username', '<div class="error right">', '</div>') ?>
                                <div class="clearfix"></div>
                                <input value="<?php echo(isset($submit['r_username']) ? $submit['r_username'] : ''); ?>" autocomplete="off" name="r_username" type="text" class="txt-input" />
                            </div>
                            <div class="rows clearfix">
                                <label class="left">Mật khẩu <span class="red">*</span></label>
                                <?php echo form_error('r_password', '<div class="error right">', '</div>') ?>
                                <div class="clearfix"></div>
                                <input autocomplete="off" name="r_password" type="password" class="txt-input" />
                            </div>
                            <div class="rows clearfix">
                                <label class="left">Xác nhận mật khẩu <span class="red">*</span></label>
                                <?php echo form_error('re_password', '<div class="error right">', '</div>') ?>
                                <div class="clearfix"></div>
                                <input autocomplete="off" name="re_password"  type="password" class="txt-input" /> 
                            </div>
                            <div class="rows clearfix">
                                <label class="left">Tên đầy đủ</label>
                                <div class="clearfix"></div>
                                <input value="<?php echo(isset($submit['fullname']) ? $submit['fullname'] : ''); ?>" name="fullname" type="text" class="txt-input" />
                            </div>
                            <div class="rows clearfix">
                                <label class="left">Email <span class="red">*</span></label>
                                <?php echo form_error('email', '<div class="error right">', '</div>') ?>
                                <div class="clearfix"></div>
                                <input value="<?php echo(isset($submit['email']) ? $submit['email'] : ''); ?>" name="email" type="text" class="txt-input" />
                            </div>
                            <div class="rows clearfix">
                                <label class="left">Số điện thoại</label>
                                <div class="clearfix"></div>
                                <input value="<?php echo(isset($submit['mobile']) ? $submit['mobile'] : ''); ?>" name="mobile" type="text" class="txt-input" />
                            </div>
                            <div class="rows clearfix">
                                <label class="left">Mã bảo mật</label>
                                <img id="i_captcha" src="<?php echo site_url('captcha.jpg?'.time()); ?>" width="180" height="36" alt="" /><img onclick="$('#i_captcha').attr('src','<?php echo site_url('captcha.jpg'); ?>'+Math.random());" src="<?php echo img_link('run.gif'); ?>" width="20" height="20" alt="" style="cursor:pointer" />
                            </div>
                            <div class="rows clearfix">
                                <label class="left">Nhập mã bảo mật</label>
                                <?php echo form_error('captcha', '<div class="error right">', '</div>') ?>
                                <div class="clearfix"></div>
                                <input autocomplete="off" name="captcha" type="text" class="txt-input" />
                            </div>
                            <div class="rows button-set">
                                <input type="hidden" name="register" value="1" />
                                <button type="submit" id="re_submit" class="button"><span>Đăng ký</span></button>
                            </div>
                            <div class="clearfix">
                                <div><strong>Đăng ký nhanh!!!</strong></div>
                                <div>Soạn tin: <strong class="red">DV</strong> gửi <strong class="red">8017</strong> để nhận tài khoản và mật khẩu để đăng nhập.</div>
    <!--                                <div>Soạn tin: <strong class="red">DV</strong> gửi <strong class="red">8717</strong> để đăng ký tài khoản <strong class="red">VIP</strong></div>-->
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