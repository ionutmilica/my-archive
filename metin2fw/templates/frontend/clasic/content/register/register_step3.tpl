<div class="col-2" id="authenticated">
	<div class="content content-last">
		<div class="content-bg">
			<div class="content-bg-bottom">
				<h2>Contul tau</h2>
				<div id="progressTracker">
					<div id="progress1" class="passed">
						<div class="step">1</div>
						<p class="progress-text">Inregistrare</p>
					</div>
					<div id="progress2" class="passed">
						<div class="step">2</div>
						<p class="progress-text">Activeaza si descarca</p>
					</div>
					<div id="progress3" class="active">
						<div class="step">3</div>
						<p class="progress-text">Instaleaza si joaca-te</p>
					</div>
				</div>
				<div class="pass-lost-inner-content">
					<div class="input-data-box">	
						<div id="activateAccount" class="inner-form-border">
							<div class="inner-form-box clearfix">
                                {if ( ! isset($confirmation_error))}                                
    								<h3>Inregistrare dumneavoastra a reusit!</h3>
    								<div class="trenner"></div>
    								<div id="activateBox">
    								    <p>Inregistrare reusita!</p>
    								</div>
                                {else}
                                    <h3>Inregistrarea dumneavoastra a esuat!</h3>
								    <div class="trenner"></div>
								    <div id="activateBox">
							        <div class="error-mini error-mini-margin error-mini-maxwidth">
							             Link-ul de activare a fost deja accesat sau nu este corect.
                                    </div>
					                <p id="resendNormal">
							             <a href="{$relative}user/resendaccount">Nu ati primit un e-mail? Retrimite mailul de activare</a>
					                </p>   
                                    </div>                             
                                {/if}
    								<h3>Descarcati jocul</h3>
    								<div class="trenner"></div>
    								<a href="{$relative}main/download" id="bigDownload" >
    								Catre<br />descarcare</a>                                
							</div>
						</div>
					</div>
				<div class="box-foot"></div>
				</div>
			</div>
		</div>
        	</div>
	<div class="shadow">&nbsp;</div>
</div>            <!-- right column -->