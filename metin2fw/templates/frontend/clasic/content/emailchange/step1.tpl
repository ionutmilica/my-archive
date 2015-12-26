        <!-- center column -->
<div id="emailChange" class="col-2">
	<div class="content content-last">
		<div class="content-bg">
			<div class="content-bg-bottom">
				<h2>Contul tau</h2>
				<div class="inner-form-border">
					<div class="inner-form-box">
						<h3><a id="toAdmin" href="{$relative}user/administration" title="Datele utilizatorului">Datele utilizatorului</a>Schimba adresa de email.</h3>
						<div class="trenner"></div>
						<form name="emailChangeForm" id="emailChangeForm" method="post" action="{$relative}user/emailchange/">
                        {if isset($error)}<h3>{$error}</h3><br />{/if}
							<div>
								<label for="oldEmail">adresa <b>veche</b> de e-mail: *</label>
								<input 
									type="text" 
									id="oldEmail" 
									name="oldEmail" 
									title=""
									value=""
									maxlength="64"
								/>
							</div>
							<div>
								<label for="newEmail">Adresa de email <b>noua</b>: *</label>
								<input 
									type="text" 
									id="newEmail" 
									name="newEmail" 
									title=""
									value=""
									maxlength="64"
								/>                    
							</div>				
							<input id="submitBtn" type="submit" name="SubmitEmailChangeForm" value="Trimite" class="btn-big" />
						</form>
						<p id="regLegend">* este necesar</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>            <!-- right column -->