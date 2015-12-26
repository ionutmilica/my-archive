   <!-- center column -->
            <div id="register" class="col-2">
    <div class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2>Inregistrarea</h2>
                <div id="progressTracker">
                    <div id="progress1" class="active">
                        <div class="step">1</div>
                        <p class="progress-text">Inregistrare</p>
                    </div>
                    <div id="progress2" class="inactive">
                        <div class="step">2</div>
                        <p class="progress-text">Activeaza si descarca</p>
                    </div>
                    <div id="progress3" class="inactive">
                        <div class="step">3</div>
                        <p class="progress-text">Instaleaza si joaca-te</p>
                    </div>
                </div>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <h3><a id="toLogin" href="{$relative}user/login" title="sau la autentificare">sau la autentificare</a>Creaza un cont</h3>
                        <div class="trenner"></div>
                    <form name="registerForm" id="registerForm" method="post" action="{$relative}user/register">
                        <div>
                                <label for="username">Nume de utilizator: *</label>
                                {if isset($register_errors.username_exists)}
                                    <span>Acest nume de utilizator exista deja.</span>
                                {/if}
                                {if isset($register_errors.invalid_username)}
                                    <span>Numele de utilizator trebuie sa contina intre 4 si 16 caractere alfa-numerice.</span>
                                {/if}
                                <input
                                    type="text"
                                    class="validate[required,custom[noSpecialCharacters],length[4,16]]"
                                    id="username"
                                    name="username"
                                    title=""
                                    value=""
                                    maxlength="16"
                                />
                            </div>
                            <div>
                                <label for="email">Email valid: *</label>
                                {if isset($register_errors.invalid_email)}
                                    <span>Aceasta adresa de email este invalida.</span>
                                {/if}                                
                                <input
                                    type="text"
                                    class="validate[required,custom[email]]"
                                    id="email"
                                    name="email"
                                    maxlength="64"
                                    title=""
                                    value=""
                                />
                            </div>
                            <div id="pwField">
                                <label for="password">Parola: *</label>
                                {if isset($register_errors.invalid_password)}
                                    <span>Parola trebuie sa contina intre 4 si 16 caractere alfa-numerice.</span>
                                {/if}                                 
                                <input
                                    type="password"
                                    class="validate[required,custom[onlyValidPasswordCharacters],length[4,16]]"
                                    id="password"
                                    name="password"
                                    maxlength="16"
                                    value=""
                                />
                            </div>
                            {if isset($captcha)}
                                <div>
                                    <label for="captcha">Cuvant de siguranta: *<br />
                                    <img src="{$captcha_path}" alt="."/>
                                    </label>
                                    {if isset($register_errors.invalid_captcha)}
                                        <span>Codul de securitate introdus este invalid.</span>
                                    {/if}                                
                                    <input
                                        type="text"
                                        id="captcha"
                                        name="captcha"
                                        maxlength="64"
                                        title=""
                                        value=""
                                    />
                                </div>                            
                            {/if}
                            <input id="submitBtn" type="submit" name="SubmitRegisterForm" value="Inregistrare" class="btn-big" />
                        </form>
                        <p id="regLegend">* este necesar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>            <!-- right column -->