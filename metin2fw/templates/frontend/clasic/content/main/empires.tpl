          <div class="col-2">
    <div class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2>Metin2 - Imperii</h2>
                <div class="empires-content">
                    <ul class="tabs-nav tabs3">
                        <li id="tab1"><a href="{$relative}main/thegame">Jocul</a></li>
                        <li id="tab2"><a href="{$relative}main/characterclasses">Categoriile Caracterelor</a></li>
                        <li id="tab3" class="selected"><a href="{$relative}main/empires">Imperii</a></li>
                    </ul>
					<div class="empires-map">
						<div id="empire-img" class="empire-1"></div>
						<img src="{$relative_tpl}img/empires_map.png" width="481" height="341" alt="map" usemap="#empiresMap" />
						<map name="empiresMap" id="empiresMap">
                            <area shape="poly" coords="70,207,102,207,120,217,138,219,149,214,169,216,180,219,193,210,204,211,219,216,226,206,240,200,252,201,259,209,257,215,260,222,258,232,260,250,268,245,290,255,298,256,315,262,332,264,339,270,339,281,334,287,334,293,329,297,318,304,310,306,305,311,293,317,285,314,282,317,274,314,267,318,244,317,229,308,214,308,192,315,185,316,178,313,169,314,160,315,144,313,125,300,123,294,115,290,113,283,115,280,106,276,87,272,73,266,64,263,64,254,50,241,48,232,47,224,60,219,67,215" href="javascript:void(0)" alt="Imperiul Shinsoo" title="Imperiul Shinsoo" onmouseover="showEmpire(1)"/>
                            <area shape="poly" coords="65,26,79,21,93,19,117,18,133,25,147,26,159,38,180,42,193,42,197,50,189,59,193,64,190,71,197,83,194,89,192,96,180,104,175,116,174,127,169,131,164,132,159,142,158,149,139,149,135,152,125,153,107,153,96,159,79,155,60,158,51,140,37,133,28,119,18,113,20,97,17,89,22,84,17,71,26,60,27,51,37,38,48,31" href="javascript:void(0)" alt="Imperiul Chunjo" title="Imperiul Chunjo" onmouseover="showEmpire(2)" />
                            <area shape="poly" coords="302,49,311,39,323,40,327,47,373,55,380,60,393,53,413,56,436,62,434,68,453,70,456,77,451,85,456,91,457,97,463,102,460,111,463,121,455,128,452,134,444,135,445,147,431,163,441,167,444,179,445,186,455,198,452,205,451,211,441,217,417,219,385,211,374,205,353,211,347,192,352,183,343,170,329,167,320,164,312,153,315,148,302,138,304,122,311,115,322,114,335,106,329,96,314,83,315,76,309,74,303,67" href="javascript:void(0)" alt="Imperiul Jinno" title="Imperiul Jinno" onmouseover="showEmpire(3)"/>
						</map>
					</div>
					<br class="clearfloat" />
                    <div class="empirebox empirebox-1">
						<div class="empire-crest"></div>
                        <h4>Imperiul Shinsoo</h4>
                        <p>Imperiul Shinshoo se afla in partea de <strong>Sud</strong> a continentului. Principala activitate a populatiei este <strong>comertul</strong>.<br /><br />
Creat de Yoon_Yoing, dupa dezintegrarea vechiului imperiu, comertul in zona estica s-a transformat intr-o afacere profitabila. Conflictele avute de Shinsoo cu Imperiul occidental au pus in pericol calea comertului. Cand au descoperit pericolul provocat de Pietrele Metin, mercenarii s-au inarmat.
Scopul lor este sa se apere de <strong>atacurile occidentale</strong>, sa redeschida calea comertului si sa reuneasca vechile imperii intr-un singur Imperiu, al lor.</p>
                    </div>
                    <div class="empirebox empirebox-2">
						<div class="empire-crest"></div>
                        <h4>Imperiul Chunjo</h4>
                        <p>Imperiul Chunjo se afla in partea de <strong>Vest</strong> a continentului. Este un <strong>imperiu teocratic</strong> si este condus de liderii spirituali.<br /><br />

Intemeiat de Yoon-Young, unul din verii fostului imparat. Vastele puteri magice ale sotiei sale l-au ajutat sa descopere la timp pericolul Pietrelor Metin. In nenumarate randuri a recomandat initierea masurilor de siguranta impotriva Pietrelor Metin dar nu a fost luat in seama. Astfel, el si-a condus armata intr-o rebeliune impotriva vechiului imperiu. Dupa dezintegrarea vechiului imperiu, Chunjo inca este implicat intr-o batalie <strong>deschisa</strong> cu Imperiile din Est si Sud.<br /><br />

Scopul lor este sa aiba controlul intregului continent si sa invinga cresterea puterii a Pietrelor Metin.</p>
                    </div>
                    <div class="empirebox empirebox-3">
						<div class="empire-crest"></div>
                        <h4>Imperiul Jinno</h4>
                        <p>Imperiul Jinno este situat in partea de <strong>Est</strong> a continentului. Acest imperiu a fost intemeiat pe baza unei puteri militare iar populatia este <strong>agresiva si combatanta</strong>.<br /><br />

Liderul Imperiului Jinno este Ee-Ryoong, fiul fostului imparat. El crede ca poate reuni vechile imperii folosindu-se de armata sa.<br /><br /> Temerile despre implicarile sau efectele adverse ale Pietrelor Metin au fost ignorate oficial dar Ee-Ryoong incearca in secret sa gaseasca o cale pentru a folosi puterea mortala a Pietrelor Metin in scopuri militare.</p>
                    </div>
                    <div class="box-foot"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="shadow">&nbsp;</div>
</div>
{literal}
<script type="text/javascript">
    function showEmpire(target) 
    {
    	$('#empire-img').removeClass();
    	$('#empire-img').addClass('empire-'+target);
    	$('.empirebox').css({display: 'none'});
    	$('.empirebox-'+target).css({display: 'block'});
    }
</script>
{/literal}