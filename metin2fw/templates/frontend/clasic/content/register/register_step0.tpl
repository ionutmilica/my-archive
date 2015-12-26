   <!-- center column -->
            <div id="register" class="col-2">
    <div class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2>Inregistrarea esuata</h2>

                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <h3>A intervenit o problema.</h3>
                        <div class="trenner"></div><br />
                            <span style="font-size: 14px;">
                                In momentul de fata inregistrarile pe acest server sunt inchise.<br />                              
                                {if $register_closed_message != ""}
                                    Mesaj din partea echipei:<br /><br />
                                    <b>&Tab;{$register_closed_message}</b>
                                {/if}
                            </span> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>            <!-- right column -->