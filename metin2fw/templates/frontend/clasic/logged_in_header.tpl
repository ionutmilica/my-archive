<div class="header-wrapper">
	<div id="header">
		<a class="logo" href="{$relative}main"><strong> Metin2 </strong></a>
		<div id="userBox">
			<div class="welcome-text welcome-text-left">
				 Bun venit {$user_data.login}
			</div>
			<div class="welcome-text welcome-text-right">
				 Ai {$user_data.coins} Monede Dragon
			</div>
			<br class="clearfloat"/>
			<div class="header-box-nav-container">
				<ul class="header-box-nav-login">
					<li class="stepdown"><a id="payment" href="{$relative}itemshop/payment.php" class="nav-box-btn nav-box-btn-1"> incarca MD </a></li>
					<li class="stepdown"><a href="{$relative}user/administration" class="nav-box-btn nav-box-btn-2"> Datele utilizatorului </a></li>
					<li class="stepdown"><a href="{$relative}user/logout" class="nav-box-btn nav-box-btn-4"> Delogare </a></li>
				</ul>
			</div>
		</div>
	</div>
</div>