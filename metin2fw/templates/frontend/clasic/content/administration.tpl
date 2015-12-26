<div class="col-2">
    <div class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2>Contul tau</h2>
                <div class="administration-inner-content">
                    <div class="input-data-box">
                    <h4>Datele utilizatorului</h4>
                        <ul>
                            <li>Nume de utilizator: {$user_data.login}</li>
                            <li>Email:<br /><span id="yourEmail">{hide($user_data.email)}</span></li>
                            <li>Monede Dragon: {$user_data.coins} <a id="payment_middle" href="{$relative}user/payment" class="load-link">(top up)</a></li>
                            <li>Semnele Dragonului: {$user_data.jd}</li>
                        </ul>
                         {if ($user_data.email_token) != ''}   
                             <div id="warning">
                                <strong>O singura adresa de e-mail ramane sa fie confirmata sau respinsa.</strong>                            
                             </div><br />
                         {/if}
                        <div class="administration-box"><a id="payment_down" href="{$relative}itemshop/payment.php" class="btn">incarca MD</a><p>Imbunatateste-ti contul folosind Monede Dragon</p></div>
                        <div class="administration-box"><a href="{$relative}user/character" class="btn">Caracter</a><p>Lista caracterelor</p></div>                    
                        <div class="administration-box"><a href="{$relative}user/emailchange" class="btn">Email</a><p>Schimba adresa de email.</p></div>
                        <div class="administration-box"><a href="{$relative}user/passwordchange" class="btn">Parola</a><p>Schimba parola</p></div>
                        <div class="administration-box"><a href="{$relative}user/storagepassword" class="btn">Parola Depozit</a><p>Cere parola de la Depozit</p></div>
                        <div class="administration-box"><a href="{$relative}user/displaycode" class="btn">Afisa codul</a><p>Codul pentru stergerea personajelor</p></div>
                    </div>
                  <div class="box-foot"></div>
                </div>
            </div>
        </div>
    </div>
<div class="shadow">&nbsp;</div>
</div>