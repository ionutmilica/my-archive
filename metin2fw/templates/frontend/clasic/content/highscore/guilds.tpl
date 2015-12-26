<div class="col-2" id="guildHighscore">
    <div class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2>Metin2 - Listarea rangurilor</h2>
                <div class="ranks-inner-content"><br />
                    <div class="ranks-dropdowns-box">
                        <form action="{$relative}user/guildhighscore" name="highscoreform" method="post">
                            <div class="ranks-select-box">
                                <label>Server:</label>
                                <select name="serverchoice">
                                    <option value="1" selected="selected">Server 1</option>
                                </select>
                            </div>
                            
                            <div class="ranks-select-box">
                            <label>Arata imperiu:</label>
                            <select name="empirechoice">
                                <option value="-1"  selected="selected">[toate imperiile]</option>
                                <option value="1" >Imperiul Shinsoo</option>
                                <option value="2" >Imperiul Chunjo</option>
                                <option value="3" >Imperiul Jinno</option>
                            </select>
                            </div>
                            <div class="ranks-select-box">
                            <label>Cauta breasla:</label>
                                <div class="ranks-input">
                                    <input type="text" value="" name="guildchoice"/>
                                </div>
                            </div>
                            <div class="ranks-select-box-btn">
                            <a class="small-btn" href="#" onclick="document.forms['highscoreform'].submit();return false;">Cauta</a>
                            </div>
                            <div class="clearfloat"></div>
                        </form>
                    </div>
                    {if ($page > 1)}
                        <div class="ranks-nav prev prev-top"><a href="{$relative}main/guildhighscore/page-{$page-1}/empire-{$empire}/name-{$name}">&lt;&lt; anterioarele 10 ranguri</a></div>
                    {else}
                        <div class="ranks-nav prev prev-top">&nbsp;</div>
                    {/if}
                    {if $page < $pages}
                        <div class="ranks-nav next next-top"><a href="{$relative}main/guildhighscore/page-{$page+1}/empire-{$empire}/name-{$name}">urmatoarele 10 ranguri &gt;&gt;</a></div>                                                                                                        
                    {else}
                        <div class="ranks-nav next next-top">&nbsp;</div>
                    {/if}  
                    <br class="clearfloat"/>
                    <table>
                      <thead>
                          <tr>
                              <th class="guildrank-th-1">Rang</th>
                              <th class="guildrank-th-2">Breasla</th>
                              <th class="guildrank-th-3">Lider Breasla</th>
                              <th class="guildrank-th-4">Regat</th>
                              <th class="guildrank-th-5">Nivel</th>
                              <th class="guildrank-th-6">Puncte</th>
                          </tr>
                      </thead>
                      <tbody >
                      {section name="i" loop="$guilds"}
                         <tr{if ($smarty.section.i.index + 1 == 1)} class="rankfirst"{/if}>
                            <td class="rank-td-1-1">{$guilds[i].rang}</td>
                            <td class="rank-td-1-2">{$guilds[i].name}</td>
                            <td class="rank-td-1-3">{$guilds[i].master}</td>
                            <td class="rank-td-1-4"><img src="{$relative_tpl}img/kingdom/{$guilds[i].empire}.png"  width="34px" alt="regat" title="regat" /></td>
                            <td class="rank-td-1-5">{$guilds[i].level}</td>
                            <td class="rank-td-1-6">{$guilds[i].ladder_point}</td>
                         </tr>                          
                      {/section}

                                                                                                          
                      </tbody>
                    </table>
                    {if ($page > 1)}
                        <div class="ranks-nav prev"><a href="{$relative}main/guildhighscore/page-{$page-1}/empire-{$empire}/name-{$name}">&lt;&lt; anterioarele 10 ranguri</a></div>
                    {else}
                        <div class="ranks-nav prev">&nbsp;</div>
                    {/if}
                    {if $page < $pages}
                        <div class="ranks-nav next"><a href="{$relative}main/guildhighscore/page-{$page+1}/empire-{$empire}/name-{$name}">urmatoarele 10 ranguri &gt;&gt;</a></div>                                                                                                        
                    {else}
                        <div class="ranks-nav next">&nbsp;</div>
                    {/if}  
                     <div class="clearfloat"></div>
                     <div class="ranks-update-time">&nbsp;</div>
                     <div class="box-foot"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="shadow">&nbsp;</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#guildHighscore table tr:odd').addClass('zebra');
});
</script>            <!-- right column -->