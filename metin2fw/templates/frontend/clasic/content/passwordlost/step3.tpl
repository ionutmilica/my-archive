            <!-- center column -->
            <div class="col-2" id="lostPasswordCode">
    <div class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2>Ai uitat parola?</h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <h3><a id="toLogin" href="{$relative}user/login" title="inapoi la autentificare">inapoi la autentificare</a>Ai uitat parola?</h3>
                        <form name="lostPasswordCodeForm" id="lostPasswordCodeForm" method="post" action="{$relative}user/passwordlost/confirmation/{$username}/{$token}">
                        <div class="trenner"></div>
                        <h3>
                            Introdu aici noua ta parola.
                        </h3>
                        <div class="trenner"></div>
                            <div id="pwField">
                            <label for="newPassword">Parola <b>noua</b>: *</label>
                            {if isset($invalid_password)}
                                Parola invalida. Ea trebuie sa contina intre 4 si 16 caractere.
                            {/if}
                                <input
                                    type="password"
                                    id="newPassword"
                                    name="newPassword"
                                    value=""
                                    maxlength="16"
                                />
                            </div>
                            <input id="submitBtn" type="submit" name="SubmitLostPasswordCodeForm" value="Trimite" class="btn-big" />
                        </form>
                        <p id="regLegend">* este necesar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   