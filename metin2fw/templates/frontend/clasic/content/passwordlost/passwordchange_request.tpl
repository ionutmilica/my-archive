<div class="col-2">
    <div class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2>Contul tau</h2>
                <div class="pass-lost-inner-content">
                    <div class="input-data-box">
                        <h4>Schimba parola</h4>
                        <div class="pass-lost-box-small">
                        <p>Ati primit un email cu un link de schimbare al parolei, accesati-l si urmati instructiunile pentru a crea o noua parola.</p>
                                <form action="{$relative}user/passwordchange" name="passwordchangerequestForm" method="post">
                                    <input type="submit" name="passwordchangerequest" class="button btn-login btn-center-input-space" value="Trimite"/>
                                </form>
                            </div>
                    </div>
                    <br class="clearfloat" />
                    <a class="btn back-btn" href="{$relative}user/administration">inapoi</a>
                </div>
            </div>
        </div>
    </div>
    <div class="shadow">&nbsp;</div>
</div>