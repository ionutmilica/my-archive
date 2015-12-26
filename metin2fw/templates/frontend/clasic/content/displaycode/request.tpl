          <!-- center column -->
<div class="col-2">
	<div class="content content-last">
		<div class="content-bg">
			<div class="content-bg-bottom">
				<h2>Contul tau</h2>
				<div class="pass-lost-inner-content">
					<div class="input-data-box">
						<h4>Codul pentru stergerea personajelor</h4>
						<p>Din cauza motivelor de securitate poti sterge un caracter numai daca introduci un cod specific.</p>
							<div class="pass-lost-box-small">
								<p>Solicitati un email si urmati instructiunile din acest email pentru a vi se afisa codul.</p>
								<form action="{$relative}user/displaycode" name="sendSocialcodeDisplayLink" method="post">
									<input type="submit" name="sendSocialcodeDisplayLink" class="button btn-login btn-center-input-space" value="Trimite"/>
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