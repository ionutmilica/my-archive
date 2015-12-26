<div class="col-2" id="resendActiv">
	<div class="content content-last">
		<div class="content-bg">
			<div class="content-bg-bottom">
				<h2>Contul tau</h2>
				<div class="inner-form-border">
					<div class="inner-form-box">
						<h3><a id="toAdmin" href="{$relative}user/login" title="inapoi la autentificare">inapoi la autentificare</a>Retrimiterea emailului de inregistrare</h3>						
						<form name="resendactivForm" id="resendactivForm" method="post" action="{$relative}user/resendaccount">
						<div class="trenner"></div>
						{if ($status == 'ok')}							
                            <p id="result">Linkul de activare a fost trimis din nou!</p>
                            <div class="trenner"></div>
						{elseif ($status == 'error')}							 
                            <p id="result">Acest cont este activat deja!</p>
                            <div class="trenner"></div>						
						{/if}
							<div>
								<label for="username">Nume de utilizator: *</label>
								<input 
									type="text" 
									id="username" 
									name="username" 
									title=""
									maxlength="16"
									value=""
								/>
							</div>
							<div>
								<label for="email">Email: *</label>
								<input 
									type="text" 
									id="email" 
									name="email" 
									title=""
									maxlength="64"
									value=""
								/>
							</div>
							<input id="submitBtn" type="submit" name="SubmitResendActivationEmailForm" value="Trimite" class="btn-big" />
						</form>
						<p id="regLegend">* este necesar</p>
					</div>
				</div>
			</div>
		</div>
	</div>
 <div class="shadow">&nbsp;</div>
</div> 