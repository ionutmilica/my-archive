<div class="col-2" id="authenticate">
	<div class="content content-last">
		<div class="content-bg">
			<div class="content-bg-bottom">
				<h2>Inregistrarea la joc</h2>
				<div id="progressTracker">
					<div id="progress1" class="passed">
						<div class="step">1</div>
						<p class="progress-text">Inregistrare</p>
					</div>
					<div id="progress2" class="active">
						<div class="step">2</div>
						<p class="progress-text">Activeaza si descarca</p>
					</div>
					<div id="progress3" class="inactive">
						<div class="step">3</div>
						<p class="progress-text">Instaleaza si joaca-te</p>
					</div>
				</div>
				<div class="pass-lost-inner-content">
					<div class="input-data-box">
						<div id="activateAccount" class="inner-form-border">
							<div class="inner-form-box clearfix">
								<h3>Activeaza contul</h3>
								<div class="trenner"></div>
								<div id="activateBox">
									<p>
										Bun venit <b>{$smarty.post.username}</b>
                                        <p>
                                            Inregistrarea ta este completa iar datele introduse au fost salvate.
                                        </p>
                                        <p>In scurt timp, va trebui sa primesti un email pentru <b>confirmarea inregistrarii</b>. Te rugam <b>confirma inregistrarea</b> accesand <b>linkul din email</b>. Vei putea folosi contul tau de joc dupa aceasta confirmare. Tine minte ca linkul de validare expira in scurt timp. Daca deja a expirat, datele tale au fost sterse. In aceasta situatie te rugam sa repeti procesul de inregistrare.
                                        Daca totusi nu primesti acest email in cateva ore, te rugam contacteaza <a href="{$relative}support">Echipa de Suport</a></p>.									</p>
									<p id="resendNormal"><a href="{$relative}user/resendaccount">
										Nu ati primit un e-mail Retrimite mailul de activare.										</a></p>
								</div>
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