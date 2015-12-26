         <div id="login" class="col-2">
    <div class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2>Logare</h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <h3><a id="topwLost" href="{$relative}user/passwordlostrequest" title="Ai uitat parola?">Ai uitat parola?</a>Logare</h3>
                        <div class="trenner"></div>

                        <form name="loginForm" id="loginForm" action="{$relative}user/login" method="post">
                        {if isset($login_error)}
                            {if isset($blocked_account)}
                                {if isset($active)}
                                    <h3>Contul dumneavoastra nu a fost activat inca.</h3>
                                {else}
                                    <h3>Contul dumneavoastra este blocat.</h3>
                                {/if}
                            {else}
                                <h3>Logarea dumneavoastra a esuat.</h3>
                            {/if}
                        {/if}
                         <div>
                                <label for="username">Nume de utilizator: *</label>
                                <input
                                    type="text"
                                    class="validate[required,custom[noSpecialCharacters]]"
                                    id="username"
                                    name="username"
                                    maxlength="16"
                                    value=""
                                />
                            </div>
                            <div>
                                <label for="password">Parola: *</label>
                                <input
                                    type="password"
                                    class="validate[required,length[4,16]]"
                                    id="password"
                                    name="password"
                                    maxlength="16"
                                    value=""
                                />
                            </div>
                            <div id="checkerror">
                                
                            </div>
                            {if isset($captcha)}
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
                            {/if}                            
                            <input
                                id="submitBtn"
                                class="btn-big"
                                type="submit"
                                name="SubmitLoginForm"
                                value="Trimite"
                            />
                        </form>
                        <p id="regLegend">* este necesar</p>
                        <div class="trenner"></div>
                        <div id="subscribe">
                            <h3>Inca nu ai cont?</h3>
                            <p>Crearea unui jucator (cont) este rapida, usoara si gratis.</p>
                            <a class="btn-big" href="{$relative}user/register" title="Creaza un cont">Creaza un cont</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>            <!-- right column -->