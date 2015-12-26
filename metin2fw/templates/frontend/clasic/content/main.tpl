		<div class="col-2">
        <div class="two-boxes">
        <div class="two-boxes-top">
            <div class="two-boxes-bottom">
                <div class="box">
                    <h2>Metin2</h2>
                    <div class="body">
                        <p>Bine ai venit la Metin2!</p>
                        <p>Paseste intr-o lume fantastica cu orase pitoresti si peisaje impresionante.</p>
                        <p>Te asteapta lupte primejdioase!</p>
                        <p>Devino maestru in artele martiale si protejeaza-ti tara de Forta neagra a Pietrelor Metin.</p>
                    </div>
                </div>
                <div class="box box-right">
                    <h2>Trailer</h2>
                    <div class="video">
                    <object type="application/x-shockwave-flash" style="width:221px; height:131px;" data="{$relative_tpl}trailer.swf">                        
                            <param name="wmode" value="opaque" />
                            <param name="movie" value="{$relative_tpl}trailer.swf" />
                            <param name="allowFullScreen" value="true" />
                            <embed src="{$relative_tpl}trailer.swf" type="application/x-shockwave-flash" allowfullscreen="true" width="221" height="131" wmode="opaque" />
                    </object>                                                 
                    </div>
                </div>
            </div>
        </div>
    </div>
	
 <div class="shadow"> </div>
            <div class="content banner">
            <div class="content-bg">
                <div class="content-bg-bottom">
                    <div class="coda-slider-wrapper">
                        <div class="coda-slider preload" id="coda-slider-1">
                            {foreach $banners AS $banner}
                                <div class="panel">
                                    {if ($banner.url != '')}<a href="{$banner.url}">{/if}
                                        <img src="{$relative}{$banner.img}"  width="480px" height="150px" alt="" />                                                                            
                                    {if ($banner.url != '')}</a>{/if}
                                </div>                            
                            {/foreach}
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
            
    
	<div class="shadow"> </div>
	<div class="content">
		<div class="content-bg">
			<div class="content-bg-bottom">
				<h2>Metin2 - Imagini</h2>
				<div id="screenshots">
                  <a class="first" title="Captura 1" href="{$relative_tpl}img/screenshots/mmorpg-fantasy-metin2-screenshot01.jpg">
                    <img title="Metin2" src="{$relative_tpl}img/screenshots/thumbs/mmorpg-fantasy-metin2-thumb01.jpg" width="100" height="75" alt="."/>
                  </a>
					<a title="Captura 2" href="{$relative_tpl}img/screenshots/mmorpg-fantasy-metin2-screenshot02.jpg"><img title="Test" src="{$relative_tpl}img/screenshots/thumbs/mmorpg-fantasy-metin2-thumb02.jpg" width="100" height="75" alt="."/></a>
					<a title="Captura 3" href="{$relative_tpl}img/screenshots/mmorpg-fantasy-metin2-screenshot03.jpg"><img title="Test" src="{$relative_tpl}img/screenshots/thumbs/mmorpg-fantasy-metin2-thumb03.jpg" width="100" height="75" alt="."/></a>
					<a title="Captura 4" href="{$relative_tpl}img/screenshots/mmorpg-fantasy-metin2-screenshot04.jpg"><img title="Test" src="{$relative_tpl}img/screenshots/thumbs/mmorpg-fantasy-metin2-thumb04.jpg" width="100" height="75" alt="."/></a><br/>
				</div>			
				<br class="clearfloat" />
			</div>
		</div>
	</div>
	<div class="shadow"> </div>
    	<div class="content content-last">
		<div class="content-bg">
			<div class="content-bg-bottom">
	 			<h2>Metin2 - Ac&#355;iunea Oriental&#259; MMORPG</h2>
				<div class="inner-content">
					<br/><p>&nbsp;&nbsp;&nbsp;&nbsp;&#206;n vremuri str&#259;vechi r&#259;suflarea Zeului Dragon veghea asupra regatelor Shinsoo, Chunjo &#351;i  Jinno. Dar aceast&#259; <strong>lume fascinant&#259; a magiei</strong> se afl&#259; &#238;n fa&#355;a unui pericol imens: Impactul <strong>Pietrelor Metin</strong> care au cauzat haos &#351;i distrugere pe continent &#351;i &#238;ntre locuitori. Au izbucnit r&#259;zboaie &#238;ntre continente, animalele s&#259;lbatice s-au transformat &#238;n bestii terifiante. Lupta &#238;mpotriva <strong>influen&#355;ei negative a Pietrelor Metin</strong> &#238;n postura unui <strong>aliat al Zeului Dragon</strong>. <strong>Adun&#259;-&#355;i toate puterile &#351;i armele</strong> pentru a salva regatul.</p>
					<h3>Caracteristici</h3><br/>
					<ul>
						<li>Un continent, p&#259;truns de violen&#355;&#259;, unde r&#259;zboinici cu totul &#351;i cu totul deosebi&#355;i, trebuie s&#259;-&#351;i dovedeasc&#259; curajul &#238;n nenum&#259;rate aventuri.</li>
						<li>Trei regate care se du&#351;m&#259;nesc &#238;ntre ele, &#351;i c&#259;rora, le po&#355;i pune la dispozi&#355;ie for&#355;a ta &#351;i curajul t&#259;u.</li>
						<li>Poart&#259;-&#355;i luptele pe jos sau c&#259;lare, &#351;i nu numai pentru a ob&#355;ine putere &#351;i propriet&#259;&#355;i, ci &#351;i din onoare!</li>
						<li>Devino st&#259;p&#226;nul unei cet&#259;&#355;i, &#351;i &#238;mpreun&#259; cu ob&#351;tea ta, construie&#351;te propria fort&#259;rea&#355;&#259;!</li>
						<li>&#206;nva&#355;&#259; numeroasele stiluri de lupt&#259; &#351;i &#238;nsu&#351;e&#351;te-&#355;i, prin antrenament special, tot felul de abili&#355;&#259;ti, pentru a-&#355;i &#238;nfr&#226;nge inamicul!</li>
				    </ul>
				</div>
			</div>
		</div>
	</div>
	<div class="shadow"> </div>
</div>

<script type="text/javascript">
/*
$(document).ready(function(){
    $("#screenshots a").overlay({
        target: '#gallery',
        expose: '#000'
    }).gallery({
        next:    '.forward',
        prev:     '.back',
        speed: 800
    }); 
}); */
</script>