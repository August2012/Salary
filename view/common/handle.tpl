<div class="contentwrapper padding10">
	<div class="errorwrapper error404">
    	<div class="errorcontent">
            <h1>{$code}</h1>
            <h3>{$msg}</h3>
            
            {if $is_back eq 1}
            <button class="stdbtn btn_black" onclick="history.back()">点击返回</button> &nbsp; 
            {else}
            <button class="stdbtn btn_black" onclick="location.href='{$backAct}'">点击返回</button> &nbsp; 
            {/if}
            {if $gotomsg}
            <button onclick="location.href='{$gotourl}'" class="stdbtn btn_orange">{$gotomsg}</button>
            {/if}
        </div><!--errorcontent-->
    </div><!--errorwrapper-->
</div>   