<div class="col-3">
    
    <div class="modul-box">
        <div class="modul-box-bg">
            <div class="modul-box-bg-bottom">
      		    <h3>Logare</h3>
            	<form action="{$relative}user/login" method="post">
                    <div class="form-login">
               		   <label>Nume de utilizator</label>
                        <div class="input">
              			   <input type="text" name="username"/><br/>
                        </div>
                  		<label>Parol&#259;</label>
                        <div class="input">
              			   <input type="password" name="password"/><br/>
                        </div>
                        <div>
                  		    <input type="submit" class="button btn-login" name="login" value="Logare"/>
                      		<p class="agbok">
             			        Aten&#355;ie: Intr&#226;nd aici, accept <a href="{$relative}terms"><strong>Termenii &#351;i condi&#355;iile</strong></a> .	
                 			    <a href="{$relative}user/passwordlost" class="password">Ai uitat parola?</a>
                                <a href="{$relative}user/resendaccount" class="password">Retrimiterea emailului de inregistrare</a>
                  		    </p>
                        </div>
                    </div>
                </form>                   
            </div>
        </div>
    </div>


    <div class="boxes-middle">&nbsp;</div>
    <div class="modul-box modul-box-2">
        <div class="modul-box-bg">
            <div class="modul-box-bg-bottom">
                <h3>Desc&#259;rcare</h3>
                <a href="{$relative}main/download" class="btn download-btn"></a> 
            </div>
        </div>
    </div>

{include file="highscore.tpl"}

<!-- End bresle -->
    <div class="boxes-bottom"> </div>
    </div>