<div id="pwLost" class="col-2">
    <div class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2>Ai uitat parola?</h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <h3><a id="toLogin" href="{$relative}user/login" title="inapoi la autentificare">Inapoi la autentificare</a>Ai uitat parola?</h3>
                        <div class="trenner"></div>
                        <form name="pwlostForm" id="pwlostForm" method="post" action="{$relative}user/passwordlost">
                            <div>
                                <label for="username">Nume de utilizator: *</label>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    title=""
                                    value=""
                                    maxlength="16"
                                />
                            </div>
                            <div>
                                <label for="email">Email: *</label>                                
                                <input
                                    type="text"
                                    id="email"
                                    name="email"
                                    title=""
                                    value=""
                                    maxlength="64"
                                />
                            </div>
                            <div>
                                    <label for="captcha">Cuvant de siguranta: *<br />
                                    <img src="{$captcha}" alt="."/>
                                    </label>                                
                                    <input
                                        type="text"
                                        id="captcha"
                                        name="captcha"
                                        maxlength="64"
                                        title=""
                                        value=""
                                    />
                                </div>                                
                            <input id="submitBtn" type="submit" name="SubmitPasswordLostForm" value="Trimite" class="btn-big" />
                        </form>
                        <p id="regLegend">* este necesar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>            <!-- right column 