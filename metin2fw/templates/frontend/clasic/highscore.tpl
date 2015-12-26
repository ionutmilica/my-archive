<div class="boxes-middle">&nbsp;</div>
<div class="modul-box modul-box-2">
<div class="modul-box-bg">
<div class="modul-box-bg-bottom">
    <h3>Clasament</h3>
    
    <div class="form-score">
        <div class="select-replacement">
            <select>
                <option value="1" selected="selected">Server 1</option>
            </select>         
        </div>
    </div>    						    
    
    <!-- START JUCATORI -->
    <h3 style="margin-top:0">Juc&#259;tori</h3>
    <div class="form-score">
    	<div id="highscore-player">
    		<ul>
                {section name="i" loop="$players_rank"}                
        			{cycle values="<li>,<li class=\"light\">"}
            			<div class="empire{$players_rank[i].empire}">
       				     <strong class="offset">{$smarty.section.i.index + 1}</strong>
                         &minus;
                         <a href="{$relative}main/highscore" {if ($smarty.section.i.index+1 == 1)}class="first"{/if}>{$players_rank[i].name}</a>
            			</div>
        			</li>
                {/section}
    		</ul>
    	</div>
    	<a href="{$relative}main/highscore" class="btn" rel="nofollow">Top 100</a>
    </div>
    
    <!-- END JUCATORI -->
    <!-- START BRESLE -->
    
    <h3 style="margin-top:0">Bresle</h3>
    <div class="form-score">
    	<div id="highscore-guild">
    		<ul>
                {section name="i" loop="$guilds_rank"}                
        			{cycle values="<li>,<li class=\"light\">"}
            			<div class="empire{$guilds_rank[i].empire}">
       				     <strong class="offset">{$smarty.section.i.index + 1}</strong>
                         &minus;
                         <a href="{$relative}main/highscore" {if ($smarty.section.i.index+1 == 1)}class="first"{/if}>{$guilds_rank[i].name}</a>
            			</div>
        			</li>
                {/section}
    		</ul>
    	</div>
    	<a href="{$relative}main/guildhighscore" class="btn" rel="nofollow">Top 100</a>
    </div>
</div>
<!-- END modul-box-bg-bottom -->

</div>
</div>