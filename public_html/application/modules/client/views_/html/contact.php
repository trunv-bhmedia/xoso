<div class="box-contact">
    <div class="box-contactin">
        <form method="post" action="">
            <h1 class="o-title">Liên hệ với Ban quan trị</h1>
            <div class="frm-contact">
                <div style="color:red;padding-bottom:10px"><?php echo $this->message->display();?></div>
                <div class="rows clearfix">
                    <label>Họ tên:<em>*</em></label>
                    <div class="input-box"><input type="text" name="fullname" value="<?php echo (isset($submit["fullname"]) ? $submit["fullname"] : "");?>" /></div>
                </div>
                <div class="rows clearfix">
                    <label>Điện thoại:</label>
                    <div class="input-box"><input type="text" name="mobile" value="<?php echo (isset($submit["mobile"]) ? $submit["mobile"] : "");?>" /></div>
                </div>
                <div class="rows clearfix">
                    <label>Địa chỉ:</label>
                    <div class="input-box"><input type="text" name="address" value="<?php echo (isset($submit["address"]) ? $submit["address"] : "");?>" /></div>
                </div>
                <div class="rows clearfix">
                    <label>Email:<em>*</em></label>
                    <div class="input-box"><input type="text" name="email" value="<?php echo (isset($submit["email"]) ? $submit["email"] : "");?>" /></div>
                </div>
                <div class="rows clearfix">
                    <label>Nội dung:<em>*</em></label>
                    <div class="input-box">
                        <textarea name="content" style="margin:0 0 10px"><?php echo (isset($submit["content"]) ? $submit["content"] : "");?></textarea>
                    </div>
                </div>
                <div class="rows clearfix">
                    <label>Mã xác nhận:<em>*</em></label>
                    <div class="input-box">
                        <input name="captcha" type="text" class="left" style="width:auto" />
                        <div class="img-text"><img src="<?php echo site_url('captcha.jpg') ?>" width="99" alt="" height="20" /></div>
                    </div>
                </div>
                <div class="rows clearfix">
                    <label>&nbsp;</label>
                    <div class="input-box">
                        <p>(<em>*</em>) Dữ liệu phải nhập.</p>
                    </div>
                </div>
                <div class="rows clearfix">
                    <label>&nbsp;</label>
                    <div class="input-box">
                        <button type="submit" class="button"><span><span>Gửi đi</span></span></button>
                        <button type="reset" class="button"><span><span>Hủy bỏ</span></span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
