{include file='{$header}'}
<form id="zmeregister" name="zmeregister" action="" method="post" enctype="application/x-www-form-urlencoded">
                <input type="hidden" name="ignore_capcha" id="ignore_capcha" value="0">
                <input type="hidden" name="captcha_token" id="captcha_token" value="0877ab04232d03e8b360fad28135786a_1349232108.4725">
                <div class="regis">
                    <div class="regis_title">
                        <p class="regis_tit">Ä�Äƒng kÃ½</p>
                        <p class="regis_txt">
                            
                        </p>
                    </div>
                    <div class="box-cor">
                        <div style="display:none;" class="netother">
                            <p>Báº¡n cÃ³ thá»ƒ Ä‘Äƒng kÃ½ nhanh báº±ng tÃ i khoáº£n khÃ¡c:</p>
                            <p class="nettypes">
                                <a href="#" class="net_yahoo">Yahoo</a>
                                <a href="#" class="net_google">Google</a>
                                <a href="#" class="net_facebook">Facebook</a>
                            </p>
                            <div class="clr"></div>
                        </div>
                        <div class="regis-form">
                            <div class="row">
                                <span class="col-l"><span class="abbr">*</span>Há»� tÃªn:</span>
                                <span class="col-r">
                                    <input type="text" tabindex="1" value="" maxlength="40" minlength="3" name="fullname" class="input" id="fullname"></span>
                                
                                
                            </div>
<!--                            <p style="display: none" id="error_fullname" class="textErr"></p>-->
                            <p class="textErr" id="error_lastname" style="display: none">Vui lÃ²ng nháº­p Há»� cá»§a báº¡n</p>
                            <p class="textErr" id="error_mixname" style="display: none"></p>
                            <p class="textErr" id="error_firstname" style="display: none">Vui lÃ²ng nháº­p TÃªn cá»§a báº¡n</p>
                            
                            <div class="row">
                                <span class="col-l"><span class="abbr">*</span>Email:</span>
                                <span class="col-r">
                                    <input type="text" tabindex="1" value="" maxlength="40" minlength="3" name="email" class="input" id="email"></span>
                                
                                
                            </div>
                            
                            <div class="row">
                                <span class="col-l"><span class="abbr">*</span>TÃ i khoáº£n:</span>
                                <span class="col-r">
                                    <input type="text" tabindex="3" name="username" id="username" class="input" maxlength="24">
                                </span>
                                <span class="checkok" id="chk_account_ok" style="display: none"><img width="1" height="1" src="http://img.me.zdn.vn/images/space.gif"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="rownote">
                                <span class="colnote">Chiá»�u dÃ i tá»« 6-24 kÃ½ tá»±</span>
                            </div>
                            <p class="textErr" id="error_account" style="display: none"></p>

                            <div class="row">
                                <span class="col-l"><span class="abbr">*</span>Máº­t kháº©u:</span>
                                <span class="col-r">
                                    <input type="password" tabindex="4" name="password" id="password" minlength="6" class="input" maxlength="32" value="">
                                </span>
                                <span class="checkok" id="chk_password_ok" style="display: none"><img width="1" height="1" src="http://img.me.zdn.vn/images/space.gif"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="rownote">
                                <span class="colnote">Chiá»�u dÃ i tá»« 6-32 kÃ½ tá»±</span>
                            </div>
                            <p class="textErr" id="error_password" style="display: none"></p>

                            <div class="row">
                                <span class="col-l"><span class="abbr">*</span>Nháº­p láº¡i máº­t kháº©u:</span>
                                <span class="col-r"><input type="password" tabindex="5" name="comfirmPassword" id="comfirmPassword" value="" maxlength="32" minlength="8" class="input"></span>
                                <span class="checkok" id="chk_cpassword_ok" style="display: none"><img width="1" height="1" src="http://img.me.zdn.vn/images/space.gif"></span>
                                <div class="clr"></div>
                            </div>
                            <div class="rownote">
                                <span class="colnote">Báº¡n hÃ£y nháº­p láº¡i máº­t kháº©u phÃ­a trÃªn vá»«a nháº­p</span>
                                
                            </div>
                            <p class="textErr" id="error_cpassword" style="display: none"></p>

                            <div class="row">
                                <span class="col-l"><span class="abbr">*</span>Giá»›i tÃ­nh:</span>
                                <span class="col-r">
                                    <label>
                                        <input type="radio" tabindex="6" name="cbGender" id="cbGenderMan" value="0" class="gender checkBR"> Nam </label><label>
                                        <input type="radio" tabindex="7" name="cbGender" id="cbGenderWoman" value="1" class="gender marl5 checkBR"> Ná»¯</label>
                                </span>
                                <span class="checkok" id="chk_gender_ok" style="display: none"><img width="1" height="1" src="http://img.me.zdn.vn/images/space.gif"></span>
                                <div class="clr"></div>
                            </div>
                            <p class="textErr" id="gender" style="display: none"></p>

                            <div class="row">
                                <span class="col-l"><span class="abbr">*</span>NgÃ y sinh:</span>
                                <span class="col-r">
                                    <select tabindex="8" name="cbDay" id="cbDay" class="select" style="width: 70px;">
                                        <option value="0">NgÃ y</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                    <select tabindex="9" name="cbMonth" id="cbMonth" class="select" style="width: 80px;">
                                        <option value="0">ThÃ¡ng</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select tabindex="10" name="cbYear" id="cbYear" class="select" style="width: 70px;">
                                        <option value="0">NÄƒm</option>
                                        <option value="2005">2005</option>
                                        <option value="2004">2004</option>
                                        <option value="2003">2003</option>
                                        <option value="2002">2002</option>
                                        <option value="2001">2001</option>
                                        <option value="2000">2000</option>
                                        <option value="0">------</option>
                                        <option value="1999">1999</option>
                                        <option value="1998">1998</option>
                                        <option value="1997">1997</option>
                                        <option value="1996">1996</option>
                                        <option value="1995">1995</option>
                                        <option value="1994">1994</option>
                                        <option value="1993">1993</option>
                                        <option value="1992">1992</option>
                                        <option value="1991">1991</option>
                                        <option value="1990">1990</option>
                                        <option value="0">------</option>
                                        <option value="1989">1989</option>
                                        <option value="1988">1988</option>
                                        <option value="1987">1987</option>
                                        <option value="1986">1986</option>
                                        <option value="1985">1985</option>
                                        <option value="1984">1984</option>
                                        <option value="1983">1983</option>
                                        <option value="1982">1982</option>
                                        <option value="1981">1981</option>
                                        <option value="1980">1980</option>
                                        <option value="0">------</option>
                                        <option value="1979">1979</option>
                                        <option value="1978">1978</option>
                                        <option value="1977">1977</option>
                                        <option value="1976">1976</option>
                                        <option value="1975">1975</option>
                                        <option value="1974">1974</option>
                                        <option value="1973">1973</option>
                                        <option value="1972">1972</option>
                                        <option value="1971">1971</option>
                                        <option value="1970">1970</option>
                                        <option value="0">------</option>
                                        <option value="1969">1969</option>
                                        <option value="1968">1968</option>
                                        <option value="1967">1967</option>
                                        <option value="1966">1966</option>
                                        <option value="1965">1965</option>
                                        <option value="1964">1964</option>
                                        <option value="1963">1963</option>
                                        <option value="1962">1962</option>
                                        <option value="1961">1961</option>
                                        <option value="1960">1960</option>
                                        <option value="0">------</option>
                                        <option value="1959">1959</option>
                                        <option value="1958">1958</option>
                                        <option value="1957">1957</option>
                                        <option value="1956">1956</option>
                                        <option value="1955">1955</option>
                                        <option value="1954">1954</option>
                                        <option value="1953">1953</option>
                                        <option value="1952">1952</option>
                                        <option value="1951">1951</option>
                                    </select>
                                </span>
                                <span class="checkok" id="chk_dob_ok" style="display: none"><img width="1" height="1" src="http://img.me.zdn.vn/images/space.gif"></span>
                                <div class="clr"></div>
                            </div>
                            <p class="textErr" id="error_dob" style="display: none"></p>
                            <div class="row">
                                <span class="col-l">MÃ£ xÃ¡c nháº­n:</span>
                                <span class="col-r"><img width="164px" height="32px" alt="Táº£i láº¡i mÃ£ xÃ¡c nháº­n " title="táº£i láº¡i mÃ£ xÃ¡c nháº­n" id="img_captcha" src="<?php echo base_url();?>captcha.php"></span>
                                <a href="javascript: void(0);" id="newcaptcha"><span class="capcha"><img width="1" height="1" src="http://img.me.zdn.vn/images/space.gif"></span></a>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                            <div class="row">
                                <span class="col-l"><span class="abbr">*</span>Nháº­p mÃ£ xÃ¡c nháº­n:</span>
                                <span class="col-r"><input type="text" tabindex="11" value="" maxlength="6" minlength="6" name="verifycode" id="verifycode" class="input"></span>
                                <span class="checkok" id="chk_captcha_ok" style="display: none"><img width="1" height="1" src="http://img.me.zdn.vn/images/space.gif"></span>
                                <div class="clr"></div>
                            </div>                            
                            <div style="float:left" class="rownote"><span class="colnote">Báº¡n cÃ³ thá»ƒ nháº­p mÃ£ xÃ¡c nháº­n báº±ng cáº£ <b>chá»¯ hoa</b> vÃ  <b>chá»¯ thÆ°á»�ng</b></span></div>
                            <p class="textErr" id="error_captcha" style="display: none"></p>                            
                            <div class="row">
                                <span class="col-l">&nbsp;</span>
                                <span class="col-r"><input type="checkbox" tabindex="12" name="chkAgree" id="chkAgree" checked="" value="1" class="checkbox checkBR"> Ä�á»“ng Ã½ vá»›i <a href="http://me.zing.vn/hlp?content=license" target="_blank"> thá»�a thuáº­n sá»­ dá»¥ng</a></span>
                                <span class="checkok" id="chk_agree_ok" style="display: none"><img width="1" height="1" src="http://img.me.zdn.vn/images/space.gif"></span>
                                <div class="clr"></div>
                            </div>
                            <p class="textErr" id="error_agree" style="display: none"></p>
                            <div id="processLine" class="rownote" style="display: none;">
                                <span id="process" class="colnote">&nbsp;</span>
                            </div>
                            <p id="btnBlock" class="regrow_btn">
                                <span class="col-r btn_regis">
                                    <input type="submit" tabindex="13" id="btn_register" value="Ä�Äƒng kÃ½" name="">
                                </span>
                                <span onclick="zmRegister.resetFormRegister();" class="col-r btn_reset">
                                    <input type="reset" tabindex="13" value="LÃ m láº¡i" name="">
                                    <input name="hurl" type="hidden" value=""/>
                                </span>
                                <br class="clr">
                            </p>
                            <div class="clr"></div>
                        </div>
                        <div class="clr"></div>

                    </div>
                    <div class="regis_photo"></div>
                    <div class="clr"></div>
                </div>
                </form>