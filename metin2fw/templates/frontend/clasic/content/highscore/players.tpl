<div class="col-2" id="highscore">
    <div class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2>Metin2 - Listarea rangurilor</h2>
                <div class="ranks-inner-content"><br />
                    <div class="ranks-dropdowns-box">
                    <form action="{$relative}main/highscore" name="highscoreform" method="post">
                            <div class="ranks-select-box">
                                <label>Server:</label>
                                <select name="serverchoice">
                                    <option value="1" selected="selected">Server 1</option>
                                </select>
                            </div>
                            <div class="ranks-select-box">
                            <label>Arata categoriile:</label>
                            <select name="classchoice">
                                <option value="-1"  selected="selected">[toate]</option>
                                <option value="0" >Razboinic</option>
                                <option value="1" >Ninja</option>
                                <option value="2" >Sura</option>
                                <option value="3" >Saman</option>
                            </select>
                            </div>
                            <div class="ranks-select-box">
                            <label>Alege caracterul:</label>
                                <div class="ranks-input">
                                    <input type="text" value="" name="characterchoice"/>
                                </div>
                            </div>
                            <div class="ranks-select-box-btn">
                            <a class="small-btn" href="#" onclick="document.forms['highscoreform'].submit();return false;">Cauta</a>
                            </div>
                            <div class="clearfloat"></div>
                        </form>
                    </div>                    
                    {if ($page > 1)}
                        <div class="ranks-nav prev prev-top"><a href="{$relative}main/highscore/page-{$page-1}/class-{$class}/name-{$name}">&lt;&lt; anterioarele 10 ranguri</a></div>
                    {else}
                        <div class="ranks-nav prev prev-top">&nbsp;</div>
                    {/if}
                    {if $page < $pages}
                        <div class="ranks-nav next next-top"><a href="{$relative}main/highscore/page-{$page+1}/class-{$class}/name-{$name}">urmatoarele 10 ranguri &gt;&gt;</a></div>                                                                                                        
                    {else}
                        <div class="ranks-nav next next-top">&nbsp;</div>
                    {/if}                    
                    <br class="clearfloat"/>
                    <table border="0" style="table-layout:fixed">
                      <thead>
                        <tr>
                        <th class="rank-th-1">Rang</th>
                        <th class="rank-th-2">Numele Caracterului</th>
                        <th class="rank-th-3">Regat</th>
                        <th class="rank-th-4">Nivel</th>
                        <th class="rank-th-5">EXP</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      {section name="i" loop="$users"}
                         <tr{if ($smarty.section.i.index + 1 == 1)} class="rankfirst"{/if}>
                            <td class="rank-td-1-1">{$users[i].rang}</td>
                            <td class="rank-td-1-2">{$users[i].name}</td>
                            <td class="rank-td-1-3"><img src="{$relative_tpl}img/kingdom/{$users[i].empire}.png"  width="34px" alt="regat" title="regat" /></td>
                            <td class="rank-td-1-4">{$users[i].level}</td>
                            <td class="rank-td-1-5">{$users[i].exp}</td>
                         </tr>  
                      {/section}
                    </tbody>
                    </table>
                    {if ($page > 1)}
                        <div class="ranks-nav prev"><a href="{$relative}main/highscore/page-{$page-1}/class-{$class}/name-{$name}">&lt;&lt; anterioarele 10 ranguri</a></div>
                    {else}
                        <div class="ranks-nav prev">&nbsp;</div>
                    {/if}
                    {if $page < $pages}
                        <div class="ranks-nav next"><a href="{$relative}main/highscore/page-{$page+1}/class-{$class}/name-{$name}">urmatoarele 10 ranguri &gt;&gt;</a></div>                                                                                                        
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
    $('#highscore table tr:odd').addClass('zebra');
});
</script>