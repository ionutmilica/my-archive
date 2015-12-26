<div class="col-2">
	<div class="content content-last">
		<div class="content-bg">
			<div class="content-bg-bottom">
				<!-- character list -->
		        <div class="char-list-content">
                <h2>Lista caracterelor</h2>
				    <div class="pagerWrapper">						
					</div>
                    {section name="i" loop=$users}
    				    <div class="charList">
    					   <div class="charimg">
    					       <img src="{$relative_tpl}/img/character/{$users[i].class.img}" width="44" height="40" alt="."/>
    					   </div>
    					   <div class="charuser">
    					       <div class="charname">{$users[i].name}</div>
    	                       <div class="charrank">
                                    <!-- <a href="{$relative}user/unblockchar/{$users[i].id}"><span class="chardata">Deblocheaza caracter</span></a> -->
    					       </div>
    					   </div>
    					   <div class="charrow">
    					       <div class="charclass"><span class="charlabel">Clasa</span> <span class="chardata">{$users[i].class.name}</span></div>
    					       <div class="chartime"><span class="charlabel">Timp de joc</span> <span class="chardata">{$users[i].time}</span></div>
    					   </div>
    					   <div class="charrow">
    					       <div class="charlevel"><span class="charlabel">Nivel</span><span class="chardata">{$users[i].level}</span></div>					       
    					   </div>
    					   <div class="charrow charend">
    					       <div class="charposition"><span class="charlabel">Pozitie</span> <span class="chardata">Tinutul Joan</span></div>
    					   </div>
                        </div>
                    {/section}
					</div>
				<!-- -->
			</div>
		</div>
	</div>
 </div>
            <!-- right column -->