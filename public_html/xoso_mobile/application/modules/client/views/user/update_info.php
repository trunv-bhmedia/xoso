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
<h1 style="position: absolute; text-indent: -99999px">Cập nhật thông tin</h1>
<div class="page-title-xs"><strong>Cập nhật thông tin</strong></div>
<div class="login-block" style="padding:10px">
    <?php if ($suc): ?>
        <table>
            <tr>
                <td valign="top">
                    <div class="title-login"><h3>Cập nhật thông tin thành công!</h3></div>
                    <?php echo $msg; ?>
                </td>
            </tr>
        </table>        
    <?php else: ?>
        <table>
            <tr>
                <td width="100%" valign="top">
                    <form name="registerForm" id="registerForm" method="post" action="">
                        <div class="mod-login-content">
                            <div class="rows clearfix">
                                <label class="left">Tên đăng nhập: <strong><?php echo(isset($submit['username']) ? $submit['username'] : ''); ?></strong></label>                                
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
                                <?php echo form_error('mobile', '<div class="error right">', '</div>') ?>
                                <div class="clearfix"></div>
                                <input value="<?php echo(isset($submit['mobile']) ? $submit['mobile'] : ''); ?>" name="mobile" type="text" class="txt-input" />
                            </div>
<!--                            <div class="rows clearfix">
                                <label class="left">Mã bảo mật</label>
                                <img id="i_captcha" src="<?php echo site_url('captcha.jpg'); ?>" width="194" height="39" alt="" /><img onclick="$('#i_captcha').attr('src','<?php echo site_url('captcha.jpg'); ?>'+Math.random());" src="<?php echo img_link('run.gif'); ?>" width="20" height="20" alt="" style="cursor:pointer" />
                            </div>
                            <div class="rows clearfix">
                                <label class="left">Nhập mã bảo mật</label>
                                <?php echo form_error('captcha', '<div class="error right">', '</div>') ?>
                                <div class="clearfix"></div>
                                <input autocomplete="off" name="captcha" type="text" class="txt-input" />
                            </div>-->
                            <div class="rows button-set">
                                <input type="hidden" name="register" value="1" />
                                <button type="submit" id="re_submit" class="button"><span>Cập nhật</span></button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    <?php endif; ?>
</div>