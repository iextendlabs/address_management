<?php
/** Adminer - Compact database management
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2007 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.6.3
*/error_reporting(6135);$Uc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($Uc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Ai=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Ai)$$X=$Ai;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$g;return$g;}function
adminer(){global$b;return$b;}function
version(){global$ia;return$ia;}function
idf_unescape($u){$ke=substr($u,-1);return
str_replace($ke.$ke,$ke,substr($u,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($kg,$Uc=false){if(get_magic_quotes_gpc()){while(list($y,$X)=each($kg)){foreach($X
as$ae=>$W){unset($kg[$y][$ae]);if(is_array($W)){$kg[$y][stripslashes($ae)]=$W;$kg[]=&$kg[$y][stripslashes($ae)];}else$kg[$y][stripslashes($ae)]=($Uc?$W:stripslashes($W));}}}}function
bracket_escape($u,$Na=false){static$li=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($u,($Na?array_flip($li):$li));}function
min_version($Ri,$ye="",$h=null){global$g;if(!$h)$h=$g;$fh=$h->server_info;if($ye&&preg_match('~([\d.]+)-MariaDB~',$fh,$B)){$fh=$B[1];$Ri=$ye;}return(version_compare($fh,$Ri)>=0);}function
charset($g){return(min_version("5.5.3",0,$g)?"utf8mb4":"utf8");}function
script($ph,$ki="\n"){return"<script".nonce().">$ph</script>$ki";}function
script_src($Fi){return"<script src='".h($Fi)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($Q){return
str_replace("\0","&#0;",htmlspecialchars($Q,ENT_QUOTES,'utf-8'));}function
nl_br($Q){return
str_replace("\n","<br>",$Q);}function
checkbox($C,$Y,$eb,$he="",$mf="",$jb="",$ie=""){$I="<input type='checkbox' name='$C' value='".h($Y)."'".($eb?" checked":"").($ie?" aria-labelledby='$ie'":"").">".($mf?script("qsl('input').onclick = function () { $mf };",""):"");return($he!=""||$jb?"<label".($jb?" class='$jb'":"").">$I".h($he)."</label>":$I);}function
optionlist($sf,$Zg=null,$Ji=false){$I="";foreach($sf
as$ae=>$W){$tf=array($ae=>$W);if(is_array($W)){$I.='<optgroup label="'.h($ae).'">';$tf=$W;}foreach($tf
as$y=>$X)$I.='<option'.($Ji||is_string($y)?' value="'.h($y).'"':'').(($Ji||is_string($y)?(string)$y:$X)===$Zg?' selected':'').'>'.h($X);if(is_array($W))$I.='</optgroup>';}return$I;}function
html_select($C,$sf,$Y="",$lf=true,$ie=""){if($lf)return"<select name='".h($C)."'".($ie?" aria-labelledby='$ie'":"").">".optionlist($sf,$Y)."</select>".(is_string($lf)?script("qsl('select').onchange = function () { $lf };",""):"");$I="";foreach($sf
as$y=>$X)$I.="<label><input type='radio' name='".h($C)."' value='".h($y)."'".($y==$Y?" checked":"").">".h($X)."</label>";return$I;}function
select_input($Ja,$sf,$Y="",$lf="",$Wf=""){$Ph=($sf?"select":"input");return"<$Ph$Ja".($sf?"><option value=''>$Wf".optionlist($sf,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$Wf'>").($lf?script("qsl('$Ph').onchange = $lf;",""):"");}function
confirm($He="",$ah="qsl('input')"){return
script("$ah.onclick = function () { return confirm('".($He?js_escape($He):'Are you sure?')."'); };","");}function
print_fieldset($t,$pe,$Ui=false){echo"<fieldset><legend>","<a href='#fieldset-$t'>$pe</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$t');",""),"</legend>","<div id='fieldset-$t'".($Ui?"":" class='hidden'").">\n";}function
bold($Va,$jb=""){return($Va?" class='active $jb'":($jb?" class='$jb'":""));}function
odd($I=' class="odd"'){static$s=0;if(!$I)$s=-1;return($s++%2?$I:'');}function
js_escape($Q){return
addcslashes($Q,"\r\n'\\/");}function
json_row($y,$X=null){static$Vc=true;if($Vc)echo"{";if($y!=""){echo($Vc?"":",")."\n\t\"".addcslashes($y,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$Vc=false;}else{echo"\n}\n";$Vc=true;}}function
ini_bool($Nd){$X=ini_get($Nd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$I;if($I===null)$I=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$I;}function
set_password($Qi,$N,$V,$F){$_SESSION["pwds"][$Qi][$N][$V]=($_COOKIE["adminer_key"]&&is_string($F)?array(encrypt_string($F,$_COOKIE["adminer_key"])):$F);}function
get_password(){$I=get_session("pwds");if(is_array($I))$I=($_COOKIE["adminer_key"]?decrypt_string($I[0],$_COOKIE["adminer_key"]):false);return$I;}function
q($Q){global$g;return$g->quote($Q);}function
get_vals($G,$e=0){global$g;$I=array();$H=$g->query($G);if(is_object($H)){while($J=$H->fetch_row())$I[]=$J[$e];}return$I;}function
get_key_vals($G,$h=null,$ih=true){global$g;if(!is_object($h))$h=$g;$I=array();$H=$h->query($G);if(is_object($H)){while($J=$H->fetch_row()){if($ih)$I[$J[0]]=$J[1];else$I[]=$J[0];}}return$I;}function
get_rows($G,$h=null,$n="<p class='error'>"){global$g;$wb=(is_object($h)?$h:$g);$I=array();$H=$wb->query($G);if(is_object($H)){while($J=$H->fetch_assoc())$I[]=$J;}elseif(!$H&&!is_object($h)&&$n&&defined("PAGE_HEADER"))echo$n.error()."\n";return$I;}function
unique_array($J,$w){foreach($w
as$v){if(preg_match("~PRIMARY|UNIQUE~",$v["type"])){$I=array();foreach($v["columns"]as$y){if(!isset($J[$y]))continue
2;$I[$y]=$J[$y];}return$I;}}}function
escape_key($y){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$y,$B))return$B[1].idf_escape(idf_unescape($B[2])).$B[3];return
idf_escape($y);}function
where($Z,$p=array()){global$g,$x;$I=array();foreach((array)$Z["where"]as$y=>$X){$y=bracket_escape($y,1);$e=escape_key($y);$I[]=$e.($x=="sql"&&preg_match('~^[0-9]*\.[0-9]*$~',$X)?" LIKE ".q(addcslashes($X,"%_\\")):($x=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($p[$y],q($X))));if($x=="sql"&&preg_match('~char|text~',$p[$y]["type"])&&preg_match("~[^ -@]~",$X))$I[]="$e = ".q($X)." COLLATE ".charset($g)."_bin";}foreach((array)$Z["null"]as$y)$I[]=escape_key($y)." IS NULL";return
implode(" AND ",$I);}function
where_check($X,$p=array()){parse_str($X,$cb);remove_slashes(array(&$cb));return
where($cb,$p);}function
where_link($s,$e,$Y,$of="="){return"&where%5B$s%5D%5Bcol%5D=".urlencode($e)."&where%5B$s%5D%5Bop%5D=".urlencode(($Y!==null?$of:"IS NULL"))."&where%5B$s%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($f,$p,$L=array()){$I="";foreach($f
as$y=>$X){if($L&&!in_array(idf_escape($y),$L))continue;$Ga=convert_field($p[$y]);if($Ga)$I.=", $Ga AS ".idf_escape($y);}return$I;}function
cookie($C,$Y,$se=2592000){global$ba;return
header("Set-Cookie: $C=".urlencode($Y).($se?"; expires=".gmdate("D, d M Y H:i:s",time()+$se)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($ba?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($ad=false){if(!ini_bool("session.use_cookies")||($ad&&@ini_set("session.use_cookies",false)!==false))session_write_close();}function&get_session($y){return$_SESSION[$y][DRIVER][SERVER][$_GET["username"]];}function
set_session($y,$X){$_SESSION[$y][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Qi,$N,$V,$l=null){global$dc;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($dc))."|username|".($l!==null?"db|":"").session_name()),$B);return"$B[1]?".(sid()?SID."&":"").($Qi!="server"||$N!=""?urlencode($Qi)."=".urlencode($N)."&":"")."username=".urlencode($V).($l!=""?"&db=".urlencode($l):"").($B[2]?"&$B[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($A,$He=null){if($He!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($A!==null?$A:$_SERVER["REQUEST_URI"]))][]=$He;}if($A!==null){if($A=="")$A=".";header("Location: $A");exit;}}function
query_redirect($G,$A,$He,$wg=true,$Bc=true,$Mc=false,$Xh=""){global$g,$n,$b;if($Bc){$xh=microtime(true);$Mc=!$g->query($G);$Xh=format_time($xh);}$sh="";if($G)$sh=$b->messageQuery($G,$Xh,$Mc);if($Mc){$n=error().$sh.script("messagesPrint();");return
false;}if($wg)redirect($A,$He.$sh);return
true;}function
queries($G){global$g;static$pg=array();static$xh;if(!$xh)$xh=microtime(true);if($G===null)return
array(implode("\n",$pg),format_time($xh));$pg[]=(preg_match('~;$~',$G)?"DELIMITER ;;\n$G;\nDELIMITER ":$G).";";return$g->query($G);}function
apply_queries($G,$T,$yc='table'){foreach($T
as$R){if(!queries("$G ".$yc($R)))return
false;}return
true;}function
queries_redirect($A,$He,$wg){list($pg,$Xh)=queries(null);return
query_redirect($pg,$A,$He,$wg,false,!$wg,$Xh);}function
format_time($xh){return
sprintf('%.3f s',max(0,microtime(true)-$xh));}function
remove_from_uri($Hf=""){return
substr(preg_replace("~(?<=[?&])($Hf".(SID?"":"|".session_name()).")=[^&]*&~",'',"$_SERVER[REQUEST_URI]&"),0,-1);}function
pagination($E,$Ib){return" ".($E==$Ib?$E+1:'<a href="'.h(remove_from_uri("page").($E?"&page=$E".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($E+1)."</a>");}function
get_file($y,$Qb=false){$Sc=$_FILES[$y];if(!$Sc)return
null;foreach($Sc
as$y=>$X)$Sc[$y]=(array)$X;$I='';foreach($Sc["error"]as$y=>$n){if($n)return$n;$C=$Sc["name"][$y];$fi=$Sc["tmp_name"][$y];$yb=file_get_contents($Qb&&preg_match('~\.gz$~',$C)?"compress.zlib://$fi":$fi);if($Qb){$xh=substr($yb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$xh,$Bg))$yb=iconv("utf-16","utf-8",$yb);elseif($xh=="\xEF\xBB\xBF")$yb=substr($yb,3);$I.=$yb."\n\n";}else$I.=$yb;}return$I;}function
upload_error($n){$Ee=($n==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($n?'Unable to upload a file.'.($Ee?" ".sprintf('Maximum allowed file size is %sB.',$Ee):""):'File does not exist.');}function
repeat_pattern($Uf,$qe){return
str_repeat("$Uf{0,65535}",$qe/65535)."$Uf{0,".($qe%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($Q,$qe=80,$Dh=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$qe).")($)?)u",$Q,$B))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$qe).")($)?)",$Q,$B);return
h($B[1]).$Dh.(isset($B[2])?"":"<i>...</i>");}function
format_number($X){return
strtr(number_format($X,0,".",','),preg_split('~~u','0123456789',-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($kg,$Dd=array()){$I=false;while(list($y,$X)=each($kg)){if(!in_array($y,$Dd)){if(is_array($X)){foreach($X
as$ae=>$W)$kg[$y."[$ae]"]=$W;}else{$I=true;echo'<input type="hidden" name="'.h($y).'" value="'.h($X).'">';}}}return$I;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($R,$Nc=false){$I=table_status($R,$Nc);return($I?$I:array("Name"=>$R));}function
column_foreign_keys($R){global$b;$I=array();foreach($b->foreignKeys($R)as$q){foreach($q["source"]as$X)$I[$X][]=$q;}return$I;}function
enum_input($U,$Ja,$o,$Y,$sc=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$_e);$I=($sc!==null?"<label><input type='$U'$Ja value='$sc'".((is_array($Y)?in_array($sc,$Y):$Y===0)?" checked":"")."><i>".'empty'."</i></label>":"");foreach($_e[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$eb=(is_int($Y)?$Y==$s+1:(is_array($Y)?in_array($s+1,$Y):$Y===$X));$I.=" <label><input type='$U'$Ja value='".($s+1)."'".($eb?' checked':'').'>'.h($b->editVal($X,$o)).'</label>';}return$I;}function
input($o,$Y,$r){global$wi,$b,$x;$C=h(bracket_escape($o["field"]));echo"<td class='function'>";if(is_array($Y)&&!$r){$Ea=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$Ea[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$Ea);$r="json";}$Fg=($x=="mssql"&&$o["auto_increment"]);if($Fg&&!$_POST["save"])$r=null;$jd=(isset($_GET["select"])||$Fg?array("orig"=>'original'):array())+$b->editFunctions($o);$Ja=" name='fields[$C]'";if($o["type"]=="enum")echo
h($jd[""])."<td>".$b->editInput($_GET["edit"],$o,$Ja,$Y);else{$td=(in_array($r,$jd)||isset($jd[$r]));echo(count($jd)>1?"<select name='function[$C]'>".optionlist($jd,$r===null||$td?$r:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($jd))).'<td>';$Pd=$b->editInput($_GET["edit"],$o,$Ja,$Y);if($Pd!="")echo$Pd;elseif(preg_match('~bool~',$o["type"]))echo"<input type='hidden'$Ja value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Ja value='1'>";elseif($o["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$_e);foreach($_e[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$eb=(is_int($Y)?($Y>>$s)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$C][$s]' value='".(1<<$s)."'".($eb?' checked':'').">".h($b->editVal($X,$o)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$C'>";elseif(($Vh=preg_match('~text|lob~',$o["type"]))||preg_match("~\n~",$Y)){if($Vh&&$x!="sqlite")$Ja.=" cols='50' rows='12'";else{$K=min(12,substr_count($Y,"\n")+1);$Ja.=" cols='30' rows='$K'".($K==1?" style='height: 1.2em;'":"");}echo"<textarea$Ja>".h($Y).'</textarea>';}elseif($r=="json"||preg_match('~^jsonb?$~',$o["type"]))echo"<textarea$Ja cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Ge=(!preg_match('~int~',$o["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$o["length"],$B)?((preg_match("~binary~",$o["type"])?2:1)*$B[1]+($B[3]?1:0)+($B[2]&&!$o["unsigned"]?1:0)):($wi[$o["type"]]?$wi[$o["type"]]+($o["unsigned"]?0:1):0));if($x=='sql'&&min_version(5.6)&&preg_match('~time~',$o["type"]))$Ge+=7;echo"<input".((!$td||$r==="")&&preg_match('~(?<!o)int(?!er)~',$o["type"])&&!preg_match('~\[\]~',$o["full_type"])?" type='number'":"")." value='".h($Y)."'".($Ge?" data-maxlength='$Ge'":"").(preg_match('~char|binary~',$o["type"])&&$Ge>20?" size='40'":"")."$Ja>";}echo$b->editHint($_GET["edit"],$o,$Y);$Vc=0;foreach($jd
as$y=>$X){if($y===""||!$X)break;$Vc++;}if($Vc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $Vc), oninput: function () { this.onchange(); }});");}}function
process_input($o){global$b,$m;$u=bracket_escape($o["field"]);$r=$_POST["function"][$u];$Y=$_POST["fields"][$u];if($o["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($o["auto_increment"]&&$Y=="")return
null;if($r=="orig")return($o["on_update"]=="CURRENT_TIMESTAMP"?idf_escape($o["field"]):false);if($r=="NULL")return"NULL";if($o["type"]=="set")return
array_sum((array)$Y);if($r=="json"){$r="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads")){$Sc=get_file("fields-$u");if(!is_string($Sc))return
false;return$m->quoteBinary($Sc);}return$b->processInput($o,$Y,$r);}function
fields_from_edit(){global$m;$I=array();foreach((array)$_POST["field_keys"]as$y=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$y];$_POST["fields"][$X]=$_POST["field_vals"][$y];}}foreach((array)$_POST["fields"]as$y=>$X){$C=bracket_escape($y,1);$I[$C]=array("field"=>$C,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($y==$m->primary),);}return$I;}function
search_tables(){global$b,$g;$_GET["where"][0]["val"]=$_POST["query"];$ch="<ul>\n";foreach(table_status('',true)as$R=>$S){$C=$b->tableName($S);if(isset($S["Engine"])&&$C!=""&&(!$_POST["tables"]||in_array($R,$_POST["tables"]))){$H=$g->query("SELECT".limit("1 FROM ".table($R)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($R),array())),1));if(!$H||$H->fetch_row()){$gg="<a href='".h(ME."select=".urlencode($R)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$C</a>";echo"$ch<li>".($H?$gg:"<p class='error'>$gg: ".error())."\n";$ch="";}}}echo($ch?"<p class='message'>".'No tables.':"</ul>")."\n";}function
dump_headers($Bd,$Qe=false){global$b;$I=$b->dumpHeaders($Bd,$Qe);$Ef=$_POST["output"];if($Ef!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Bd).".$I".($Ef!="file"&&!preg_match('~[^0-9a-z]~',$Ef)?".$Ef":""));session_write_close();ob_flush();flush();return$I;}function
dump_csv($J){foreach($J
as$y=>$X){if(preg_match("~[\"\n,;\t]~",$X)||$X==="")$J[$y]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$J)."\r\n";}function
apply_sql_function($r,$e){return($r?($r=="unixepoch"?"DATETIME($e, '$r')":($r=="count distinct"?"COUNT(DISTINCT ":strtoupper("$r("))."$e)"):$e);}function
get_temp_dir(){$I=ini_get("upload_tmp_dir");if(!$I){if(function_exists('sys_get_temp_dir'))$I=sys_get_temp_dir();else{$Tc=@tempnam("","");if(!$Tc)return
false;$I=dirname($Tc);unlink($Tc);}}return$I;}function
file_open_lock($Tc){$hd=@fopen($Tc,"r+");if(!$hd){$hd=@fopen($Tc,"w");if(!$hd)return;chmod($Tc,0660);}flock($hd,LOCK_EX);return$hd;}function
file_write_unlock($hd,$Kb){rewind($hd);fwrite($hd,$Kb);ftruncate($hd,strlen($Kb));flock($hd,LOCK_UN);fclose($hd);}function
password_file($i){$Tc=get_temp_dir()."/adminer.key";$I=@file_get_contents($Tc);if($I||!$i)return$I;$hd=@fopen($Tc,"w");if($hd){chmod($Tc,0660);$I=rand_string();fwrite($hd,$I);fclose($hd);}return$I;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$_,$o,$Wh){global$b;if(is_array($X)){$I="";foreach($X
as$ae=>$W)$I.="<tr>".($X!=array_values($X)?"<th>".h($ae):"")."<td>".select_value($W,$_,$o,$Wh);return"<table cellspacing='0'>$I</table>";}if(!$_)$_=$b->selectLink($X,$o);if($_===null){if(is_mail($X))$_="mailto:$X";if(is_url($X))$_=$X;}$I=$b->editVal($X,$o);if($I!==null){if(!is_utf8($I))$I="\0";elseif($Wh!=""&&is_shortable($o))$I=shorten_utf8($I,max(0,+$Wh));else$I=h($I);}return$b->selectVal($I,$_,$o,$X);}function
is_mail($pc){$Ha='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$cc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Uf="$Ha+(\\.$Ha+)*@($cc?\\.)+$cc";return
is_string($pc)&&preg_match("(^$Uf(,\\s*$Uf)*\$)i",$pc);}function
is_url($Q){$cc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($cc?\\.)+$cc(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$Q);}function
is_shortable($o){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$o["type"]);}function
count_rows($R,$Z,$Vd,$md){global$x;$G=" FROM ".table($R).($Z?" WHERE ".implode(" AND ",$Z):"");return($Vd&&($x=="sql"||count($md)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$md).")$G":"SELECT COUNT(*)".($Vd?" FROM (SELECT 1$G GROUP BY ".implode(", ",$md).") x":$G));}function
slow_query($G){global$b,$hi,$m;$l=$b->database();$Yh=$b->queryTimeout();$mh=$m->slowQuery($G,$Yh);if(!$mh&&support("kill")&&is_object($h=connect())&&($l==""||$h->select_db($l))){$fe=$h->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$fe,'&token=',$hi,'\');
}, ',1000*$Yh,');
</script>
';}else$h=null;ob_flush();flush();$I=@get_key_vals(($mh?$mh:$G),$h,false);if($h){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$I;}function
get_token(){$sg=rand(1,1e6);return($sg^$_SESSION["token"]).":$sg";}function
verify_token(){list($hi,$sg)=explode(":",$_POST["token"]);return($sg^$_SESSION["token"])==$hi;}function
lzw_decompress($Ra){$Yb=256;$Sa=8;$lb=array();$Hg=0;$Ig=0;for($s=0;$s<strlen($Ra);$s++){$Hg=($Hg<<8)+ord($Ra[$s]);$Ig+=8;if($Ig>=$Sa){$Ig-=$Sa;$lb[]=$Hg>>$Ig;$Hg&=(1<<$Ig)-1;$Yb++;if($Yb>>$Sa)$Sa++;}}$Xb=range("\0","\xFF");$I="";foreach($lb
as$s=>$kb){$oc=$Xb[$kb];if(!isset($oc))$oc=$fj.$fj[0];$I.=$oc;if($s)$Xb[]=$fj.$oc[0];$fj=$oc;}return$I;}function
on_help($rb,$jh=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $rb, $jh) }, onmouseout: helpMouseout});","");}function
edit_form($a,$p,$J,$Di){global$b,$x,$hi,$n;$Ih=$b->tableName(table_status1($a,true));page_header(($Di?'Edit':'Insert'),$n,array("select"=>array($a,$Ih)),$Ih);if($J===false)echo"<p class='error'>".'No rows.'."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$p)echo"<p class='error'>".'You have no privileges to update this table.'."\n";else{echo"<table cellspacing='0'>".script("qsl('table').onkeydown = editingKeydown;");foreach($p
as$C=>$o){echo"<tr><th>".$b->fieldName($o);$Rb=$_GET["set"][bracket_escape($C)];if($Rb===null){$Rb=$o["default"];if($o["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Rb,$Bg))$Rb=$Bg[1];}$Y=($J!==null?($J[$C]!=""&&$x=="sql"&&preg_match("~enum|set~",$o["type"])?(is_array($J[$C])?array_sum($J[$C]):+$J[$C]):$J[$C]):(!$Di&&$o["auto_increment"]?"":(isset($_GET["select"])?false:$Rb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$o);$r=($_POST["save"]?(string)$_POST["function"][$C]:($Di&&$o["on_update"]=="CURRENT_TIMESTAMP"?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(preg_match("~time~",$o["type"])&&$Y=="CURRENT_TIMESTAMP"){$Y="";$r="now";}input($o,$Y,$r);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($p){echo"<input type='submit' value='".'Save'."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Di?'Save and continue edit':'Save and insert next')."' title='Ctrl+Shift+Enter'>\n",($Di?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".'Saving'."...', this); };"):"");}}echo($Di?"<input type='submit' name='delete' value='".'Delete'."'>".confirm()."\n":($_POST||!$p?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$hi,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0�\0\n @\0�C��\"\0`E�Q����?�tvM'�Jd�d\\�b0\0�\"��fӈ��s5����A�XPaJ�0���8�#R�T��z`�#.��c�X��Ȁ?�-\0�Im?�.�M��\0ȯ(̉��/(%�\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1̇�ٌ�l7��B1�4vb0��fs���n2B�ѱ٘�n:�#(�b.\rDc)��a7E����l�ñ��i1̎s���-4��f�	��i7������Fé�vt2���!�r0���t~�U�'3M��W�B�'c�P�:6T\rc�A�zr_�WK�\r-�VNFS%~�c���&�\\^�r����u�ŎÞ�ً4'7k����Q��h�'g\rFB\ryT7SS�P�1=ǤcI��:�d��m>�S8L�J��t.M���	ϋ`'C����889�� �Q����2�#8А����6m����j��h�<�����9/��:�J�)ʂ�\0d>!\0Z��v�n��o(���k�7��s��>��!�R\"*nS�\0@P\"��(�#[���@g�o���zn�9k�8�n���1�I*��=�n������0�c(�;�à��!���*c��>Ύ�E7D�LJ��1����`�8(��3M��\"�39�?E�e=Ҭ�~������Ӹ7;�C����E\rd!)�a*�5ajo\0�#`�38�\0��]�e���2�	mk��e]���AZs�StZ�Z!)BR�G+�#Jv2(���c�4<�#sB�0���6YL\r�=���[�73��<�:��bx��J=	m_ ���f�l��t��I��H�3�x*���6`t6��%�U�L�eق�<�\0�AQ<P<:�#u/�:T\\>��-�xJ�͍QH\nj�L+j�z��7���`����\nk��'�N�vX>�C-T˩�����4*L�%Cj>7ߨ�ި���`���;y���q�r�3#��} :#n�\r�^�=C�Aܸ�Ǝ�s&8��K&��*0��t�S���=�[��:�\\]�E݌�/O�>^]�ø�<����gZ�V��q����� ��x\\������޺��\"J�\\î��##���D��x6��5x�������\rH�l ����b��r�7��6���j|����ۖ*�FAquvyO��WeM����D.F��:R�\$-����T!�DS`�8D�~��A`(�em�����T@O1@��X��\nLp�P�����m�yf��)	���GSEI���xC(s(a�?\$`tE�n��,�� \$a��U>,�В\$Z�kDm,G\0��\\��i��%ʹ� n��������g���b	y`��Ԇ�W� 䗗�_C��T\ni��H%�da��i�7�At�,��J�X4n����0o͹�9g\nzm�M%`�'I���О-���7:p�3p��Q�rED������b2]�PF����>e���3j\n�߰t!�?4f�tK;��\rΞи�!�o�u�?���Ph���0uIC}'~��2�v�Q���8)���7�DI�=��y&��ea�s*hɕjlA�(�\"�\\��m^i��M)��^�	|~�l��#!Y�f81RS����!���62P�C��l&���xd!�|��9�`�_OY�=��G�[E�-eL�CvT� )�@�j-5���pSg�.�G=���ZE��\$\0�цKj�U��\$���G'I�P��~�ځ� ;��hNێG%*�Rj�X[�XPf^��|��T!�*N��І�\rU��^q1V!��Uz,�I|7�7�r,���7���ľB���;�+���ߕ�A�p����^���~ؼW!3P�I8]��v�J��f�q�|,���9W�f`\0�q�Z�p}[Jdhy��N�Y|�Cy,�<s A�{e�Q���hd���Ǉ �B4;ks&�������a�������;˹}�S��J���)�=d��|���Nd��I�*8���dl�ѓ�E6~Ϩ�F����X`�M\rʞ/�%B/V�I�N&;���0�UC cT&.E+��������@�0`;���G�5��ަj'������Ɛ�Y�+��QZ-i���yv��I�5��,O|�P�]Fۏ�����\0���2�49͢���n/χ]س&��I^�=�l��qfI��= �]x1GR�&�e�7��)��'��:B�B�>a�z�-���2.����bz���#�����Uᓍ�L7-�w�t�3ɵ��e���D��\$�#���j�@�G�8� �7p���R�YC��~��:�@��EU�J��;67v]�J'���q1ϳ�El�QІi�����/��{k<��֡M�po�}��r��q�؞�c�ä�_m�w��^�u������������ln���	��_�~�G�n����{kܞ�w���\rj~�K�\0�����-����B�;����b`}�CC,���-��L��8\r,��kl�ǌ�n}-5����3u�gm��Ÿ�*�/������׏�`�`�#x�+B?#�ۏN;OR\r����\$�����k��ϙ\01\0k�\0�8��a��/t���#(&�l&���p��삅���i�M�{�zp*�-g���v��6�k�	���d�؋����A`6�lX)+d ��7 �\r�� �ځcj6��\rp�\r��\r\"oP�7�\r��\0�\0�y��P���\rQ7���Z��4Q���ڍp/�y\r��##D�;����<�g�\0fi2�)f�\\	m�Gh\r�#�n����@[ �G�\"Sqm��\r���#�(Aj��qѣ%���̑3qE��\0r�����0��я����.��Q7шW���u����� �@�H��q'vs�0�\n�+0����SG�p�O`�\r)c�#�����R=\$�ƐR\r�Gы\$R?%2C�[\0؍�~�!�\\��p�#@���O(rg%�?ra\$��)r](��&�?&�#&R�',\rqV3�\"H�m+���l�Q\"\0�4��\$r�,�=����&2;.�H@`���a����\$�_*RIS&��q��_�1�1+1������3)2�V7��2l�ڄ!1g-�2f`���,Q�7��0qg�]!q��m6����_�M7 ���7�o6Q����kp�3�g9��s� 3�6�\r�:S�9ӏ;� �\r9�-\0�Yӧ0Q�<b#<Ӂ�w/�G��>r�\r��=3��^&Q;ѣ?q�0\"�0HЙ�|���ʖS��i��@*�T�2�T#�� �\0�C��07]?��&���E��D�;:/�3�E�5��EQ�e��T\"�m����5�E;��#=4�8��*���LS�5Hr�JE TO\rԅJ��J��J���eG)8B�8�,&�G����	��+M���ɲ��^*���G��14�6�\$.\"拢�I4w!\$L �8b�A2�L�'M?MF�\$�,����Nr��/4�BJ�¨");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:��gCI��\n8��3)��7���81��x:\nOg#)��r7\n\"��`�|2�gSi�H)N�S��\r��\"0��@�)�`(\$s6O!��V/=��' T4�=��iS��6IO��er�x�9�*ź��n3�\rщv�C��`���2G%�Y�����1��f���Ȃl��1�\ny�*pC\r\$�n�T��3=\\�r9O\"�	��l<�\r�\\��I,�s\nA��eh+M�!�q0��f�`(�N{c��+w���Y��p٧3�3��+I��j�����k��n�q���zi#^r�����3���[��o;��(��6�#�Ґ��\":cz>ߣC2v�CX�<�P��c*5\n���/�P97�|F��c0�����!���!���!��\nZ%�ć#CH�!��r8�\$���,�Rܔ2���^0��@�2��(�88P/��݄�\\�\$La\\�;c�H��HX���\nʃt���8A<�sZ�*�;I��3��@�2<���!A8G<�j�-K�({*\r��a1���N4Tc\"\\�!=1^���M9O�:�;j��\r�X��L#H�7�#Tݪ/-���p�;�B \n�2!���t]apΎ��\0R�C�v�M�I,\r���\0Hv��?kT�4����uٱ�;&���+&���\r�X���bu4ݡi88�2B�/⃖4���N8A�A)52������2��s�8�5���p�WC@�:�t�㾴�e��h\"#8_��cp^��I]OH��:zd�3g�(���Ök��\\6����2�ږ��i��7���]\r�xO�n�p�<��p�Q�U�n��|@���#G3��8bA��6�2�67%#�\\8\r��2�c\r�ݟk��.(�	��-�J;��� ��L�� ���W��㧓ѥɤ����n��ҧ���M��9ZНs]�z����y^[��4-�U\0ta��62^��.`���.C�j�[ᄠ% Q\0`d�M8�����\$O0`4���\n\0a\rA�<�@����\r!�:�BA�9�?h>�Ǻ��~̌�6Ȉh�=�-�A7X��և\\�\r��Q<蚧q�'!XΓ2�T �!�D\r��,K�\"�%�H�qR\r�̠��C =�������<c�\n#<�5�M� �E��y�������o\"�cJKL2�&��eR��W�AΐTw�ё;�J���\\`)5��ޜB�qhT3��R	�'\r+\":�8��tV�A�+]��S72��Y�F��Z85�c,���J��/+S�nBpoW�d��\"�Q��a�ZKp�ާy\$�����4�I�@L'@�xC�df�~}Q*�ҺA��Q�\"B�*2\0�.��kF�\"\r��� �o�\\�Ԣ���VijY��M��O�\$��2�ThH����0XH�5~kL���T*:~P��2�t���B\0�Y������j�vD�s.�9�s��̤�P�*x���b�o����P�\$�W/�*��z';��\$�*����d�m�Ã�'b\r�n%��47W�-�������K���@<�g�èbB��[7�\\�|�VdR��6leQ�`(Ԣ,�d��8\r�]S:?�1�`��Y�`�A�ғ%��ZkQ�sM�*���{`�J*�w��ӊ>�վ�D���>�eӾ�\"�t+po������W\$����Q�@��3t`����-k7g��]��l��E��^dW>nv�t�lzPH��FvW�V\n�h;��B�D�س/�:J��\\�+ %�����]��ъ��wa�ݫ���=��X��N�/��w�J�_[�t)5���QR2l�-:�Y9�&l R;�u#S	� ht�k�E!l���>SH��X<,��O�YyЃ%L�]\0�	��^�dw�3�,Sc�Qt�e=�M:4���2]��P�T�s��n:��u>�/�d�� ���a�'%����qҨ&@֐���H�G�@w8p����΁�Z\n��{�[�t2���a��>	�w�J�^+u~�o��µXkզBZk˱�X=��0>�t��lŃ)Wb�ܦ��'�A�,��m�Y�,�A���e��#V��+�n1I����E�+[����[��-R�mK9��~���L�-3O���`_0s���L;�����]�6��|��h�V�T:��ޞerM��a�\$~e�9�>����Д�\r��\\���J1Ú���%�=0{�	����|ޗtڼ�=���Q�|\0?��[g@u?ɝ|��4�*��c-7�4\ri'^���n;�������(���{K�h�nf���Zϝ}l�����]\r��pJ>�,gp{�;�\0��u)��s�N�'����H��C9M5��*��`�k�㬎����AhY��*����jJ�ǅPN+^� D�*��À���D��P���LQ`O&��\0�}�\$���6�Zn>��0� �e��\n��	�trp!�hV�'Py�^�*|r%|\nr\r#���@w����T.Rv�8�j�\nmB���p�� �Y0�Ϣ�m\0�@P\r8�Y\rG��d�	�QG�P%E�/@]\r���{\0�Q����bR M\rF��|��%0SDr�����f/����\":�mo�ރ�%�@�3H�x\0�l\0���	��W����\n�8\r\0}�@�D��`#�t��.�jEoDrǢlb����t�f4�0���%�0���k�z2\r� �W@�%\r\n~1��X����D2!��O�*���{0<E��k*m�0ı���|\r\n�^i��� ��!.�r � ��������f��Ĭ��+:��ŋJ�B5\$L���P���LĂ�� Z@����`^P�L%5%jp�H�W��on��kA#&���8��<K6�/����̏������XWe+&�%���c&rj��'%�x�����nK�2�2ֶ�l��*�.�r��΢���*�\r+jp�Bg�{ ���0�%1(���Z�`Q#�Ԏ�n*h��v�B����\\F\n�W�r f\$�93�G4%d�b�:JZ!�,��_��f%2��6s*F���Һ�EQ�q~��`ts�Ҁ���(�`�\r���#�R����R�r��X��:R�)�A*3�\$l�*ν:\"Xl��tbK�-��O>R�-�d��=��\$S�\$�2��}7Sf��[�}\"@�]�[6S|SE_>�q-�@z`�;�0��ƻ��C�*��[���{D��jC\nf�s�P�6'���ȕ QE���N\\%r�o�7o�G+dW4A*��#TqE�f��%�D�Z�3��2.��Rk��z@��@�E�D�`C�V!C��ŕ\0���I�)38��M3�@�3L��ZB�1F@L�h~G�1M���6��4�Xє�}ƞf�ˢIN��34��X�Btd�8\nbtN��Qb;�ܑD��L�\0��\"\n����V��6��]U�cVf���D`�M�6�O4�4sJ��55�5�\\x	�<5[F�ߵy7m�)@SV��Ğ#�x��8 ոы��`�\\`�-�v2���p���+v���U��L�xY.����\0005(�@��ⰵ[U@#�VJuX4�u_�\"JO(Dt�_	5s�^���������5�^�^V�I��\rg&]��\r\"ZCI�6��#��\r��ܓ��]7���q�0��6}o���`u��ab(�X�D�f�M�N)�V�UUF�о��=jSWi�\"\\B1Ğ�E0� �amP��&<�O_�L���.c�1Z*��R\$�h���mv�[v>ݭ�p����(��0����cP�om\0R��p�&�w+KQ�s6�}5[s�J���2��/���O �V*)�R�.Du33�F\r�;��v4���H�	_!��2��k����+��%�:�_,�eo��F��AJ�O�\"%�\n�k5`z %|�%�Ϋg|��}l�v2n7�~\0�	�YRH��@��r��xN-Jp\0���f#��@ˀmv�x��\r���2WMO/�\nD��7�}2���VW�W��wɀ7����H�k���]�\$�Mz\\�e�.f�RZ�a�B���Qd�KZ��vt���w4�\0�Z@�	��Bc;�b��>�B�	3m�n\n�o��J3��k�(܍���\"�yG\$:\r�ņ�ݎ��G6�ɲJ��y��Q�\\Q��if�����(�m)/r�\$�J�/�H�]*���g�ZOD�Ѭ��]1�g22������f�=HT��]N�&���M\0�[8x�ȮE��8&L�Vm�v����j�ט�F��\\��	���&s�@Q� \\\"�b��	��\rBs�Iw�	�Yɜ�N �7�C/&٫`�\n\n��[k���*A���T�V*UZtz{�.��y�S���#�3�ipzW@yC\nKT��1@|�z#���_CJz(B�,V�(K�_��dO���P�@X��t�Ѕ��c;�WZzW�_٠�\0ފ�CF�xR �	�\n������P�A��&������,�pfV|@N�\"�\$�[�i����������Z�\0Zd\\\"�|�W`��]��tz�o\$�\0[����u�e���ə�bhU-��,�r �Lk8��֫�V&�al����d��2;	�'-��Jyu��a���\0����a��{s�[9V\0��F��R �VB0S;D�>L4�&�ZHO1�\0�wg��S�tK��R�z���i��+�3�w��z�X�]�(G\$����D+�tչ�(#����oc�:	��Y6�\0��&��	@�	���)��!����w���# t�x�ND�����)��C��FZ�p��a��*F�b�	��ͼ����ģ�����Si/S�!��z�UH*�4����0�K�-�/���-k`�n�Li�J�~�w�Jn��\"�`�=��V�3Oį8t�>��vo��E.��Rz`��p�P���E\\��ɧ�3L�l�ѥs]T���oV��\n��	*�\r�@7)��D�m�0W�5Ӏ��ǰ�w��b���|	��JV����\"�ur\r�&N0N�B�d��d�8�D��_ͫ�^T��H#]�d�+�v�~�U,�PR%�����x���fA��C��m����͸����c��yŜD)���uH���p�p�^u\0�����}�{ѡ�\rg�s�QM�Y�2j�\r�|0\0X��@q���I`��5F�6�N��V@ӔsE�p���#\r�P�T��DeW�ؼ񛭁��z!û�:�DMV(��~X���9�\0�@���40N�ܽ~�Q�[T���e�qSv\"�\"h�\0R-�hZ�d����F5�P��`�9�D&xs9W֗5Er@o�wkb�1��PO-O�OxlH�D6/ֿ�m�ޠ��3�7T��K�~54�	�p#�I�>YIN\\5���NӃ����M��pr&�G�xM�sq����.F���8�Cs�� h�e5������*�b�)Sڪ��̭�e�0�-X� {�5|�i�֢a��ȕ6z�޽��/Y���ێM� ƃ� �\nR*8r o� @7�8Bf�z�K�r���A\$˰	p�\0?���d�k�|45}�A����ɶ�W��J�2k Gi\0\"����d���8�\0�>m��� `8�w�7�o4�cGh��Q�(퀨�8@\$<\0p��0���L�eX+�Ja�{�B��h��8�Cy���P2��Ӯ�*�EH�2���DqS�ۘ�p�0�I���k�`��S�\n�:��B�7����{-����`����6�A�W�ܖ\r�p�W#���?���{\0������cD��[<����f�--�pԌ�*B�]�nW��^��R70\r�+N�GN�\$(\0�#+y�@�@iD(8@\r�h��H�He����zz�{1���h��W1F�Who&aɜ�d6���jw�������`h�{v`RE�\nj���`�ܷ����*���ʸ}�Y��	\rY�H�6�#\0�廆��a�� Q�HEl4�d���p��#�������o�br+_)\r`��!�|dQ�>��=Qʡ��ζ�EOB'�>�P��Ӷ� A\rnK�i�� 	�����	�%<	�o;�S�@�!	�x��:���A�+\\1d\$�jO��7�%�	�/����gu�z*�G�H�5\"8��,�]raq���/�h��#����\$ /tn��8y��-�O���H�b���<�Z�!���1��`�.(uo����|`GːS��BaM	ڂ9ƞ�D@���1�B�tD��ʡ@?o�(H��qC��8E�TcncR��6�N%�rHj��2G\0�a��q �r��z9b>(P��x��<��)�x#�8�誹t���h�2v��Wo2U���t��+=�l#���j�D�	0����&R�c�\$�*̑-Z`��\r��;�|A�p�=1�	1����ƈ�bEv(^�X�P2=\0}�W���G�<���G�����R�#P�Hܮr9	��Y��!�LB���4�NC�Z��IC���MLm��,�f@eY�x�BS(�+��<4Y�)-�\r�z?\$���\"\"�� 6�E�\r)z���@ȑ��r����*��J�윋��%\$�e�J���\0A�\$ڰ/5��B0S���x��I�Q)�<��4YS�&�{��b�+IG=>�\r�PY`Z�D�`��U����F1���4d8X(����C%�`�㜭0�I\$�7W�pǁ,��Ac���&Ԍ�p\$�:�>]�.�VY��\$p� ��]��`�;��e�\0�0�\n��K+�@DL�S��r(on�M\0@9��%�\"�WS�\"���� 䥙�ٍ�ػj�_J-��rʜ���5�\\�2�5>Ze\"0��%9y��^�WMax&a)D�L���2Q����t?�=,�/o�f�3I�J�\$\r;���7�}�\r�W�@�Ұ�M|\r�Y���]5���\\*s:��FV!���kن�R���L3L�	��52�M�sb�\$����7�\0l�y���&� 9�|m!��0J��4��TSd���G���nK�V:l�D'/��:Zs��\n��y�%��i����,@ҲL��j1<��3Ĩ�D2/;��'Pݻ����`���qKȰ�f�I�L� Dݬ�4�3 ��OH�J�	q�&�����X��!��r)F�Xx���^QwOP��h��՞-_�>�a����(	��x%��K�b�<�E�j7�������hHt�`�.r�P���x��\"{\0006CVQE�&��>�ޅ�w����e'?B�9x�>:\"�73���xT\0e����j	��[t�Ҝ\"�(\\K�e�z�r����e> ���\0002�hʇ��X�a<�JtU�z`�達?��#�����2-��4hFY|C��\"M�yƔKd ���E�7���+(U�ʖX�� /D���)�\"����بމjoh�Fz4�t���D׌�G��RZ�ć�ȿ\0�FV4Q�6v�b�i=G�;Ϭ�k�d+\n>�E��\0�2f{����!J��Q�J�ؘ9��(2�#\\Z��,��Qܥ�3?8`�	bwR6��\n*�㋀�ƒ�(t��L*�S�d�\0x�)�(�*�wH]7O�N�v(Гdg�q	\nLp��L�N��H@�1����M �		n��z���e4!!	��'槝-t���AQP���L,����7��\\�i����^�\$�,�|�Z��(S9���\n* +��T�D�z?(T�>��L��æ��R����\$�zдi̼W�ͨ�Ds�{)�@�����	v�P��g�qIVҨ����\n )�!�8|\$pZ�*�!7A����N��j�NW����U���Q���)�eF�UA�S�x\0[N���2���X :S�T�~�S*T4	�3��]9�F���]:�KUg;��*Ay�a��1j|8Ϋ����I�MR��Vh7uU���r,�h�%<q�R@N9�ާ�k�	�B|�����8��r������DР@\"�ɋ�z\r������O�_���Q�\0\0���|�]�f�\nz�����UeH�Ą/k+�TF?��*03�!�\0��I���t	f\0(S�U��ZA�F��1\0��k�]��WZN�Q��܂���%��x1���'��!-,�Ƕvzg��#�Gh�;f�PH�9Bj�u�\n�A�VR����1K+�MN!��Sμ��Y��vdZ\\,���g٨�����\"}W��Yɵ�t�P��g�,�����	\0b�-�hB/@�̎�/�M��J���Y\0����)\n��I�?v�	��Ȕ1��\$�(�w\r+�n ��s�s�QfQ�O�P�.D���bV\0-�J<�i;[���=#���n,j?)�\"���lYL.����A::������BxOF7����`���d��}�}=�i)@к��\$ q˷(y%��huzb2�3Ƨ��.�-h�oO����\0`���VZ��&y�t9C���鋭Z��ґ�Z!�X�U����.k��V#8�G�}�Q���u8cΫt�bE>�v��{@{QP]<�ary��j\\��\$j�x�nc6k�;qs�T���K�����jJ���n\\C��{���`g�6�5�Rk�t����s�|@�_0΅5:B�3����rѡ�&�㴸�\0����&�׈�����ԡ��SXʕ�G�m�ʶWr,j�q\0\$޺sW�P�.A\n4�9(u�.���l�V�Ju�Ԍ�+�A�uC�>hl6��2���G�e���N��n�=�'���~��Þ��PҀ�%0z�u��r�\0��9uE�s\"���\\�ט���^���(3ՑS%<+�9��Ծ����\0���~'̞�֓<+�,i�:��@��N���\$�o������� �]������Z�!��]�n,��x��>_�f��W\0006��%�}I�\nh߀w�����ǃ -��H@_�Vi�����{���R��^�۔}5�b,!5���H��p/��k<��<�jh|i��k��hLv݄\n�`�[���WC6��z\n�g��r��u=��!zCţ���e#��nj��\0`^;=E�*@�y�% ��LQe���2�A�1,��C�ix�t����G�]q�O(����\n�V9dr�D'5@x\$�r6��;\"ǣ���7�\0M0ņH_#�c�pn>��<aa�q@g�2��lm-��������8��?8��7p����>��ji���N�\$#E/�0��s\n��B\r�*��z��oyn[Ι�� 6�a����g8�qC��⼜�I�rNF�ȫ�1��70�����/i(�B�0����Z��(��+S�J�,��91/Y+jxӱF���A��k�f�Jee\r�Cͳrz�m���h@9�O�� ؝��GK�Ad���OH���=���<&`��K�PA�!WO;-�X�L��m�Kz�7-e[u��p�q���o/�`�C����KX�f�i��Y7=�M�/�F�R�۔T�d��Y\"=`�1�k�1Տh�\r���f@N��z�(@����	h�\0�����I�}PJKr���pR`x������fo���(A��[��19�(&jo<��I@p	@�����,y�	nIs�^Ўѫ:Y��vc���؏9q.C��8�bW��V?��҅�9�\$u�@5#S(4Y���K���6�!��N6<��|v1��3ʊ:��!����`��M��l����f`�Z��J=��GX�Y)_l�А�T�)P��`�%��:�!Z\"lYS�Uؤ(��Y1Z�니rv)F`�K~=Y>���S���c����!l���D����BrF\$��RA:�\\�P�4�V�R6<�O�S�_BCS+����'V��2T#Lc�F�NBD%�G�W�nR�S����I��\n'k�0���O��Ў����8rݯAS�?��xm��yv���a�b��Ͱ�,��ЅA������]pJ\\\\�Xi���Eu��B)���Z@Ώ \"��gg0{��n��'APR��٨v�~�0R�w쀱\"�������H�J���Ζ�\\�\r}i?�Ғ:��2���g��{I�3)��B��͙Z�s��`.�#2�vt�X�IGU>`)�%���(|�f<Κ_�ޯ���_G�<��_ ˟������[:�6G8��l�#J(��JC���`���wF�w\"b�!,��!�r�@�K(���\n@AsV��S�ֹ�4�_\ns٠eڋj��)&�3�{��k���Q���G�c��X^�L{�C\n�m����A��D��1O?(��(�����2\"UL��+#o��@���X�\0�٭���^n_p�eQ˙X}%��*��e�m�{�GN��Xl�q�]R\\Z�v!�) ���xd΀,�cK��鮇�m���I~����K�{+��Gݥ�=@Q��,1!aEOc��#6<u��rB�\n�Ȳ��dH�t����	�{C�<x3���H��1��K�wB�\0��u����'ӆQ�^���򕥂�i�rRv�Vɷ�lS�.O)����[��xS�t���c)���k�B��+��v���B��w�.�wC���2���2d�.H��p+a\\H��[�\$}nNN7��H�.�S\r�ȒT���w�	*H�g\\��\$�,�:KBOx��>����5����Ӷ����u2��n��`��Yq�D���xwMB�n�2>���G�ڄ����YaK�w(2`����w����1m�-:�&LD8�U��8l��\\<���	��z�a����:,��K'�%7:���M����U[���*;K���j�;/wG���\n���^�eV'��,��;��B6�G�1��OKW����(i�X\np��Cکc6�^��㷀=�^ûcQ��Rp`\$	�D(\0D�>{�ET�c��I\r{���\$o�R	�ZZ�4*��??�+j���n��Q`����X�3�	\$���M�\n׉w�\"d�W���~@�'�I�᭫�0+-��w����y�6�vȽ'�Ԇ:Y)Y0\0�*)?'��Ǟv����fI�\n��z�9�.�b��!�c�E�[��F麙ks�}��Bv�g�5�V���,)J\$��j�Z�J�\$�Y��ח9�\0�\n����.^J��ڋ�b��mI0:g��������˗ATP�I�]~!��;D�����	�z��<P�Q>�m���`��?%Y��T\n\0D\0�\0'���H@0`�<׭�10�(�m�-��ɞ7A\0�~�~ꁡĤ?t�hє.w�%)0	#c����\"�c����jfW��\0\0p��C���kC��8��85+i:��[�8�b��l�[\"����5S�y\0�����*�Q�6V�s�9��7!�;\"��c�)�O�Q,��Ա��\r�7�,*�0�aQ�u?�_C|�������R(o(��<j(��Tv��\r|_\"�3��m��S7D�!׸�h�|���(�&�@:�	\"-ގ��&Mu;�,�bк=p�>A6ɭ���7���- WW9�O,�o'�v2�<�3\0���h��@`� 3TX�Ϛ|�\"FC_��~x����`��'f�Q-4�����/�`'���=A�\$>��`P��_G(���E���&/J�I�v�'�m餧zpޞFo�	�/[��i�؋�G*���y�(�<��7q�Y�.�眪��B���\r�l�r\nUnƧ��T>�������	�Q���_�|����K��8�ډ�e��_��xz�x�L���p14��d����U#4t�K���\$�!����p�w����Zx��_����i5T?}��C�{�����h/Gzj\$.B�Ҩ�=#�Ϗ|��*����I��w/��a�x`*��*���]����>a?'}FJS���ԖA0��'�����ʟ�0:63���л��n'��U/�r�|=slb0�\0W�rB�ʤ���@T��~\$����H�����	��D\\���-���(��ᩖB�M���z+�%�(��i��㹃�I���5/�.y/���\$�{Q}p�ܻdI�\\�Վ�B�\0V0�B�9�{T\$n�8\$Z�e�Pĳ���%9�&���V��b�x}g\"%h���*ٸvOw�˾�/�o�L,���=��V��5Bg� ϶�3��>�~�`\nxi�\"��v@�����nף�ϳyac�G�'%[��4`n��47!5�ހr����ɉ��>z�(Y�t��0���V���P�ZXT`2�~Cl���[o�n�t8jB\0d�\0000��V��g�����@V!�h\0006d<��=[�W�����f�@pb��a��ټ�s;���G<�~a�?�N�L����\"(���?�%�x#�7�|S��O�Ɠ)�B4��+��*�!��)6#�+?'���(X�����JO\0��");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("v0��F����==��FS	��_6MƳ���r:�E�CI��o:�C��Xc��\r�؄J(:=�E���a28�x�?�'�i�SANN���xs�NB��Vl0���S	��Ul�(D|҄��P��>�E�㩶yHch��-3Eb�� �b��pE�p�9.����~\n�?Kb�iw|�`��d.�x8EN��!��2��3���\r���Y���y6GFmY�8o7\n\r�0��\0�Dbc�!�Q7Шd8���~��N)�Eг`�Ns��`�S)�O���/�<�x�9�o�����3n��2�!r�:;�+�9�CȨ���\n<�`��b�\\�?�`�4\r#`�<�Be�B#�N ��\r.D`��j�4���p�ar��㢺�>�8�\$�c��1�c���c����{n7����A�N�RLi\r1���!�(�j´�+��62�X�8+����.\r����!x���h�'��6S�\0R����O�\n��1(W0���7q��:N�E:68n+��մ5_(�s�\r��/m�6P�@�EQ���9\n�V-���\"�.:�J��8we�q�|؇�X�]��Y X�e�zW�� �7��Z1��hQf��u�j�4Z{p\\AU�J<��k��@�ɍ��@�}&���L7U�wuYh��2��@�u� P�7�A�h����3Û��XEͅZ�]�l�@Mplv�)� ��HW���y>�Y�-�Y��/�������hC�[*��F�#~�!�`�\r#0P�C˝�f������\\���^�%B<�\\�f�ޱ�����&/�O��L\\jF��jZ�1�\\:ƴ>�N��XaF�A�������f�h{\"s\n�64������?�8�^p�\"띰�ȸ\\�e(�P�N��q[g��r�&�}Ph���W��*��r_s�P�h���\n���om������#���.�\0@�pdW �\$Һ�Q۽Tl0� ��HdH�)��ۏ��)P���H�g��U����B�e\r�t:��\0)\"�t�,�����[�(D�O\nR8!�Ƭ֚��lA�V��4�h��Sq<��@}���gK�]���]�=90��'����wA<����a�~��W��D|A���2�X�U2��yŊ��=�p)�\0P	�s��n�3�r�f\0�F���v��G��I@�%���+��_I`����\r.��N���KI�[�ʖSJ���aUf�Sz���M��%��\"Q|9��Bc�a�q\0�8�#�<a��:z1Uf��>�Z�l������e5#U@iUG��n�%Ұs���;gxL�pP�?B��Q�\\�b��龒Q�=7�:��ݡQ�\r:�t�:y(� �\n�d)���\n�X;����CaA�\r���P�GH�!���@�9\n\nAl~H���V\ns��ի�Ư�bBr���������3�\r�P�%�ф\r}b/�Α\$�5�P�C�\"w�B_��U�gAt��夅�^Q��U���j����Bvh졄4�)��+�)<�j^�<L��4U*���Bg�����*n�ʖ�-����	9O\$��طzyM�3�\\9���.o�����E(i������7	tߚ�-&�\nj!\r��y�y�D1g���]��yR�7\"������~����)TZ0E9M�YZtXe!�f�@�{Ȭyl	8�;���R{��8�Į�e�+UL�'�F�1���8PE5-	�_!�7��[2�J��;�HR��ǹ�8p痲݇@��0,ծpsK0\r�4��\$sJ���4�DZ��I��'\$cL�R��MpY&����i�z3G�zҚJ%��P�-��[�/x�T�{p��z�C�v���:�V'�\\��KJa��M�&���Ӿ\"�e�o^Q+h^��iT��1�OR�l�,5[ݘ\$��)��jLƁU`�S�`Z^�|��r�=��n登��TU	1Hyk��t+\0v�D�\r	<��ƙ��jG���t�*3%k�YܲT*�|\"C��lhE�(�\r�8r��{��0����D�_��.6и�;����rBj�O'ۜ���>\$��`^6��9�#����4X��mh8:��c��0��;�/ԉ����;�\\'(��t�'+�����̷�^�]��N�v��#�,�v���O�i�ϖ�>��<S�A\\�\\��!�3*tl`�u�\0p'�7�P�9�bs�{�v�{��7�\"{��r�a�(�^��E����g��/���U�9g���/��`�\nL\n�)���(A�a�\" ���	�&�P��@O\n師0�(M&�FJ'�! �0�<�H�������*�|��*�OZ�m*n/b�/�������.��o\0��dn�)����i�:R���P2�m�\0/v�OX���Fʳψ���\"�����0�0�����0b��gj��\$�n�0}�	�@�=MƂ0n�P�/p�ot������.�̽�g\0�)o�\n0���\rF����b�i��o}\n�̯�	NQ�'�x�Fa�J���L������\r��\r����0��'��d	oep��4D��ʐ�q(~�� �\r�E��pr�QVFH�l��Kj���N&�j!�H`�_bh\r1���n!�Ɏ�z�����\\��\r���`V_k��\"\\ׂ'V��\0ʾ`AC������V�`\r%�����\r����k@N����B�횙� �!�\n�\0Z�6�\$d��,%�%la�H�\n�#�S\$!\$@��2���I\$r�{!��J�2H�ZM\\��hb,�'||cj~g�r�`�ļ�\$���+�A1�E���� <�L��\$�Y%-FD��d�L焳��\n@�bVf�;2_(��L�п��<%@ڜ,\"�d��N�er�\0�`��Z��4�'ld9-�#`��Ŗ����j6�ƣ�v���N�͐f��@܆�&�B\$�(�Z&���278I ��P\rk\\���2`�\rdLb@E��2`P( B'�����0�&��{���:��dB�1�^؉*\r\0c<K�|�5sZ�`���O3�5=@�5�C>@�W*	=\0N<g�6s67Sm7u?	{<&L�.3~D��\rŚ�x��),r�in�/��O\0o{0k�]3>m��1\0�I@�9T34+ԙ@e�GFMC�\rE3�Etm!�#1�D @�H(��n ��<g,V`R]@����3Cr7s~�GI�i@\0v��5\rV�'������P��\r�\$<b�%(�Dd��PW����b�fO �x\0�} ��lb�&�vj4�LS��ִԶ5&dsF M�4��\".H�M0�1uL�\"��/J`�{�����xǐYu*\"U.I53Q�3Q��J��g��5�s���&jь��u�٭ЪGQMTmGB�tl-c�*��\r��Z7���*hs/RUV����B�Nˈ�����Ԋ�i�Lk�.���t�龩�rYi���-S��3�\\�T�OM^�G>�ZQj���\"���i��MsS�S\$Ib	f���u����:�SB|i��Y¦��8	v�#�D�4`��.��^�H�M�_ռ�u��U�z`Z�J	e��@Ce��a�\"m�b�6ԯJR���T�?ԣXMZ��І��p����Qv�j�jV�{���C�\r��7�Tʞ� ��5{P��]�\r�?Q�AA������2񾠓V)Ji��-N99f�l Jm��;u�@�<F�Ѡ�e�j��Ħ�I�<+CW@�����Z�l�1�<2�iF�7`KG�~L&+N��YtWH飑w	����l��s'g��q+L�zbiz���Ţ�.Њ�zW�� �zd�W����(�y)v�E4,\0�\"d��\$B�{��!)1U�5bp#�}m=��@�w�	P\0�\r�����`O|���	�ɍ����Y��JՂ�E��Ou�_�\n`F`�}M�.#1��f�*�ա��  �z�uc���� xf�8kZR�s2ʂ-���Z2�+�ʷ�(�sU�cD�ѷ���X!��u�&-vP�ر\0'L�X �L����o	��>�Վ�\r@�P�\rxF��E��ȭ�%����=5N֜��?�7�N�Å�w�`�hX�98 �����q��z��d%6̂t�/������L��l��,�Ka�N~�����,�'�ǀM\rf9�w��!x��x[�ϑ�G�8;�xA��-I�&5\$�D\$���%��xѬ���´���]����&o�-3�9�L��z���y6�;u�zZ ��8�_�ɐx\0D?�X7����y�OY.#3�8��ǀ�e�Q�=؀*��G�wm ���Y�����]YOY�F���)�z#\$e��)�/�z?�z;����^��F�Zg�����������`^�e����#�������?��e��M��3u�偃0�>�\"?��@חXv�\"������*Ԣ\r6v~��OV~�&ר�^g���đٞ�'��f6:-Z~��O6;zx��;&!�+{9M�ٳd� \r,9����W��ݭ:�\r�ٜ��@睂+��]��-�[g��ۇ[s�[i��i�q��y��x�+�|7�{7�|w�}����E��W��Wk�|J؁��xm��q xwyj���#��e��(�������ߞþ��� {��ڏ�y���M���@��ɂ��Y�(g͚-����������J(���@�;�y�#S���Y��p@�%�s��o�9;�������+��	�;����ZNٯº��� k�V��u�[�x��|q��ON?���	�`u��6�|�|X����س|O�x!�:���ϗY]�����c���\r�h�9n�������8'������\rS.1��USȸ��X��+��z]ɵ��?����C�\r��\\����\$�`��)U�|ˤ|Ѩx'՜����<�̙e�|�ͳ����L���M�y�(ۧ�l�к�O]{Ѿ�FD���}�yu��Ē�,XL\\�x��;U��Wt�v��\\OxWJ9Ȓ�R5�WiMi[�K��f(\0�dĚ�迩�\r�M����7�;��������6�KʦI�\r���xv\r�V3���ɱ.��R������|��^2�^0߾\$�Q��[�D��ܣ�>1'^X~t�1\"6L���+��A��e�����I��~����@����pM>�m<��SK��-H���T76�SMfg�=��GPʰ�P�\r��>�����2Sb\$�C[���(�)��%Q#G`u��Gwp\rk�Ke�zhj��zi(��rO�������T=�7���~�4\"ef�~�d���V�Z���U�-�b'V�J�Z7���)T��8.<�RM�\$�����'�by�\n5����_��w����U�`ei޿J�b�g�u�S��?��`���+��� M�g�7`���\0�_�-���_��?�F�\0����X���[��J�8&~D#��{P���4ܗ��\"�\0��������@ғ��\0F ?*��^��w�О:���u��3xK�^�w���߯�y[Ԟ(���#�/zr_�g��?�\0?�1wMR&M���?�St�T]ݴG�:I����)��B�� v����1�<�t��6�:�W{���x:=��ޚ��:�!!\0x�����q&��0}z\"]��o�z���j�w�����6��J�P۞[\\ }��`S�\0�qHM�/7B��P���]FT��8S5�/I�\r�\n ��O�0aQ\n�>�2�j�;=ڬ�dA=�p�VL)X�\n¦`e\$�TƦQJ����lJ����y�I�	�:����B�bP���Z��n����U;>_�\n	�����`��uM򌂂�֍m����Lw�B\0\\b8�M��[z��&�1�\0�	�\r�T������+\\�3�Plb4-)%Wd#\n��r��MX\"ϡ�(Ei11(b`@f����S���j�D��bf�}�r����D�R1���b��A��Iy\"�Wv��gC�I�J8z\"P\\i�\\m~ZR��v�1ZB5I��i@x����-�uM\njK�U�h\$o��JϤ!�L\"#p7\0� P�\0�D�\$	�GK4e��\$�\nG�?�3�EAJF4�Ip\0��F�4��<f@� %q�<k�w��	�LOp\0�x��(	�G>�@�����9\0T����GB7�-�����G:<Q��#���Ǵ�1�&tz��0*J=�'�J>���8q��Х���	�O��X�F��Q�,����\"9��p�*�66A'�,y��IF�R��T���\"��H�R�!�j#kyF���e��z�����G\0�p��aJ`C�i�@�T�|\n�Ix�K\"��*��Tk\$c��ƔaAh��!�\"�E\0O�d�Sx�\0T	�\0���!F�\n�U�|�#S&		IvL\"����\$h���EA�N\$�%%�/\nP�1���{��) <���L���-R1��6���<�@O*\0J@q��Ԫ#�@ǵ0\$t�|�]�`��ĊA]���Pᑀ�C�p\\pҤ\0���7���@9�b�m�r�o�C+�]�Jr�f��\r�)d�����^h�I\\�. g��>���8���'�H�f�rJ�[r�o���.�v���#�#yR�+�y��^����F\0᱁�]!ɕ�ޔ++�_�,�\0<@�M-�2W���R,c���e2�*@\0�P ��c�a0�\\P���O���`I_2Qs\$�w��=:�z\0)�`�h�������\nJ@@ʫ�\0�� 6qT��4J%�N-�m����.ɋ%*cn��N�6\"\r͑�����f�A���p�MۀI7\0�M�>lO�4�S	7�c���\"�ߧ\0�6�ps�����y.��	���RK��PAo1F�tI�b*��<���@�7�˂p,�0N��:��N�m�,�xO%�!��v����gz(�M���I��	��~y���h\0U:��OZyA8�<2����us�~l���E�O�0��0]'�>��ɍ�:���;�/��w�����'~3GΖ~ӭ����c.	���vT\0c�t'�;P�\$�\$����-�s��e|�!�@d�Obw��c��'�@`P\"x����0O�5�/|�U{:b�R\"�0�шk���`BD�\nk�P��c��4�^ p6S`��\$�f;�7�?ls��߆gD�'4Xja	A��E%�	86b�:qr\r�]C8�c�F\n'ьf_9�%(��*�~��iS����@(85�T��[��Jڍ4�I�l=��Q�\$d��h�@D	-��!�_]��H�Ɗ�k6:���\\M-����\r�FJ>\n.��q�eG�5QZ����' ɢ���ہ0��zP��#������r���t����ˎ��<Q��T��3�D\\����pOE�%)77�Wt�[��@����\$F)�5qG0�-�W�v�`�*)Rr��=9qE*K\$g	��A!�PjBT:�K���!��H� R0?�6�yA)B@:Q�8B+J�5U]`�Ҭ��:���*%Ip9�̀�`KcQ�Q.B��Ltb��yJ�E�T��7���Am�䢕Ku:��Sji� 5.q%LiF��Tr��i��K�Ҩz�55T%U��U�IՂ���Y\"\nS�m���x��Ch�NZ�UZ���( B��\$Y�V��u@蔻����|	�\$\0�\0�oZw2Ҁx2���k\$�*I6I�n�����I,��QU4�\n��).�Q���aI�]����L�h\"�f���>�:Z�>L�`n�ض��7�VLZu��e��X����B���B�����Z`;���J�]�����S8��f \nڶ�#\$�jM(��ޡ����a�G���+A�!�xL/\0)	C�\n�W@�4�����۩� ��RZ����=���8�`�8~�h��P ��\r�	���D-FyX�+�f�QSj+X�|��9-��s�x�����+�V�cbp쿔o6H�q�����@.��l�8g�YM��WMP��U��YL�3Pa�H2�9��:�a�`��d\0�&�Y��Y0٘��S�-��%;/�T�BS�P�%f������@�F��(�֍*�q +[�Z:�QY\0޴�JUY֓/���pkzȈ�,�𪇃j�ꀥW�״e�J�F��VBI�\r��pF�Nقֶ�*ը�3k�0�D�{����`q��ҲBq�e�D�c���V�E���n����FG�E�>j�����0g�a|�Sh�7u�݄�\$���;a��7&��R[WX���(q�#���P���ז�c8!�H���VX�Ď�j��Z������Q,DUaQ�X0��ը���Gb��l�B�t9-oZ���L���­�pˇ�x6&��My��sҐ����\"�̀�R�IWU`c���}l<|�~�w\"��vI%r+��R�\n\\����][��6�&���ȭ�a�Ӻ��j�(ړ�Tѓ��C'��� '%de,�\n�FC�эe9C�N�Ѝ�-6�Ueȵ��CX��V������+�R+�����3B��ڌJ�虜��T2�]�\0P�a�t29��(i�#�aƮ1\"S�:�����oF)k�f���Ъ\0�ӿ��,��w�J@��V򄎵�q.e}KmZ����XnZ{G-���ZQ���}��׶�6ɸ���_�؁Չ�\n�@7�` �C\0]_ ��ʵ����}�G�WW: fCYk+��b۶���2S,	ڋ�9�\0﯁+�W�Z!�e��2�������k.Oc��(v̮8�DeG`ۇ�L���,�d�\"C���B-�İ(����p���p�=����!�k������}(���B�kr�_R�ܼ0�8a%ۘL	\0���b������@�\"��r,�0T�rV>����Q��\"�r��P�&3b�P��-�x���uW~�\"�*舞�N�h�%7���K�Y��^A����C����p����\0�..`c��+ϊ�GJ���H���E����l@|I#Ac��D��|+<[c2�+*WS<�r��g���}��>i�݀�!`f8�(c����Q�=f�\n�2�c�h4�+q���8\na�R�B�|�R����m��\\q��gX����ώ0�X�`n�F���O p��H�C��jd�f��EuDV��bJɦ��:��\\�!mɱ?,TIa���aT.L�]�,J��?�?��FMct!a٧R�F�G�!�A���rr�-p�X��\r��C^�7���&�R�\0��f�*�A\n�՛H��y�Y=���l�<��A�_��	+��tA�\0B�<Ay�(fy�1�c�O;p���ᦝ`�4СM��*��f�� 5fvy {?���:y��^c��u�'���8\0��ӱ?��g��� 8B��&p9�O\"z���rs�0��B�!u�3�f{�\0�:�\n@\0����p���6�v.;�����b�ƫ:J>˂��-�B�hkR`-����aw�xEj����r�8�\0\\����\\�Uhm� �(m�H3̴��S����q\0��NVh�Hy�	��5�M͎e\\g�\n�IP:Sj�ۡٶ�<���x�&�L��;nfͶc�q��\$f�&l���i�����0%yΞ�t�/��gU̳�d�\0e:��h�Z	�^�@��1��m#�N��w@��O��zG�\$�m6�6}��ҋ�X'�I�i\\Q�Y���4k-.�:yz���H��]��x�G��3��M\0��@z7���6�-DO34�ދ\0Κ��ΰt\"�\"vC\"Jf�Rʞ��ku3�M��~����5V ��j/3���@gG�}D���B�Nq��=]\$�I��Ӟ�3�x=_j�X٨�fk(C]^j�M��F��ա��ϣCz��V��=]&�\r�A<	������6�Ԯ�״�`jk7:g��4ծ��YZq�ftu�|�h�Z��6��i〰0�?��骭{-7_:��ސtѯ�ck�`Y��&���I�lP`:�� j�{h�=�f	��[by��ʀoЋB�RS���B6��^@'�4��1U�Dq}��N�(X�6j}�c�{@8���,�	�PFC���B�\$mv���P�\"��L��CS�]����E���lU��f�wh{o�(��)�\0@*a1G� (��D4-c��P8��N|R���VM���n8G`e}�!}���p�����@_���nCt�9��\0]�u��s���~�r��#Cn�p;�%�>wu���n�w��ݞ�.���[��hT�{��值	�ˁ��J���ƗiJ�6�O�=������E��ٴ��Im���V'��@�&�{��������;�op;^��6Ŷ@2�l���N��M��r�_ܰ�Í�` �( y�6�7�����ǂ��7/�p�e>|��	�=�]�oc����&�xNm���烻��o�G�N	p����x��ý���y\\3����'�I`r�G�]ľ�7�\\7�49�]�^p�{<Z��q4�u�|��Qۙ��p���i\$�@ox�_<���9pBU\"\0005�� i�ׂ��C�p�\n�i@�[��4�jЁ�6b�P�\0�&F2~������U&�}����ɘ	��Da<��zx�k���=���r3��(l_���FeF���4�1�K	\\ӎld�	�1�H\r���p!�%bG�Xf��'\0���	'6��ps_��\$?0\0�~p(�H\n�1�W:9�͢��`��:h�B��g�B�k��p�Ɓ�t��EBI@<�%����` �y�d\\Y@D�P?�|+!��W��.:�Le�v,�>q�A���:���bY�@8�d>r/)�B�4���(���`|�:t�!����?<�@���/��S��P\0��>\\�� |�3�:V�uw���x�(����4��ZjD^���L�'���C[�'�����jº[�E�� u�{KZ[s���6��S1��z%1�c��B4�B\n3M`0�;����3�.�&?��!YA�I,)��l�W['��ITj���>F���S���BбP�ca�ǌu�N����H�	LS��0��Y`���\"il�\r�B���/����%P���N�G��0J�X\n?a�!�3@M�F&ó����,�\"���lb�:KJ\r�`k_�b��A��į��1�I,�����;B,�:���Y%�J���#v��'�{������	wx:\ni����}c��eN���`!w��\0�BRU#�S�!�<`��&v�<�&�qO�+Σ�sfL9�Q�Bʇ����b��_+�*�Su>%0�����8@l�?�L1po.�C&��ɠB��qh�����z\0�`1�_9�\"���!�\$���~~-�.�*3r?�ò�d�s\0����>z\n�\0�0�1�~���J����|Sޜ��k7g�\0��KԠd��a��Pg�%�w�D��zm�����)����j�����`k���Q�^��1���+��>/wb�GwOk���_�'��-CJ��7&����E�\0L\r>�!�q́���7����o��`9O`�����+!}�P~E�N�c��Q�)��#��#�����������J��z_u{��K%�\0=��O�X�߶C�>\n���|w�?�F�����a�ϩU����b	N�Y��h����/��)�G��2���K|�y/�\0��Z�{��P�YG�;�?Z}T!�0��=mN����f�\"%4�a�\"!�ޟ����\0���}��[��ܾ��bU}�ڕm��2�����/t���%#�.�ؖ��se�B�p&}[˟��7�<a�K���8��P\0��g��?��,�\0�߈r,�>���W����/��[�q��k~�CӋ4��G��:��X��G�r\0������L%VFLUc��䑢��H�ybP��'#��	\0п���`9�9�~���_��0q�5K-�E0�b�ϭ�����t`lm����b��Ƙ; ,=��'S�.b��S���Cc����ʍAR,����X�@�'��8Z0�&�Xnc<<ȣ�3\0(�+*�3��@&\r�+�@h, ��\$O���\0Œ��t+>����b��ʰ�\r�><]#�%�;N�s�Ŏ����*��c�0-@��L� >�Y�p#�-�f0��ʱa�,>��`����P�:9��o���ov�R)e\0ڢ\\����\nr{îX����:A*��.�D��7�����#,�N�\r�E���hQK2�ݩ��z�>P@���	T<��=�:���X�GJ<�GAf�&�A^p�`���{��0`�:���);U !�e\0����c�p\r�����:(��@�%2	S�\$Y��3�hC��:O�#��L��/����k,��K�oo7�BD0{���j��j&X2��{�}�R�x��v���أ�9A����0�;0�����-�5��/�<�� �N�8E����	+�Ѕ�Pd��;���*n��&�8/jX�\r��>	PϐW>K��O��V�/��U\n<��\0�\nI�k@��㦃[��Ϧ²�#�?���%���.\0001\0��k�`1T� ����ɐl�������p���������< .�>��5��\0��	O�>k@Bn��<\"i%�>��z��������3�P�!�\r�\"��\r �>�ad���U?�ǔ3P��j3�䰑>;���>�t6�2�[��޾M\r�>��\0��P���B�Oe*R�n���y;� 8\0���o�0���i���3ʀ2@����?x�[����L�a����w\ns����A��x\r[�a�6�clc=�ʼX0�z/>+����W[�o2���)e�2�HQP�DY�zG4#YD����p)	�H�p���&�4*@�/:�	�T�	���aH5���h.�A>��`;.���Y��a	���t/ =3��BnhD?(\n�!�B�s�\0��D�&D�J��)\0�j�Q�y��hDh(�K�/!�>�h,=�����tJ�+�S��,\"M�Ŀ�N�1�[;�Т��+��#<��I�Zğ�P�)��LJ�D��P1\$����Q�>dO��v�#�/mh8881N:��Z0Z���T �B�C�q3%��@�\0��\"�XD	�3\0�!\\�8#�h�v�ib��T�!d�����V\\2��S��Œ\nA+ͽp�x�iD(�(�<*��+��E��T���B�S�CȿT���� e�A�\"�|�u�v8�T\0002�@8D^oo�����|�N������J8[��3����J�z׳WL\0�\0��Ȇ8�:y,�6&@�� �E�ʯݑh;�!f��.B�;:���[Z3������n���ȑ��A���qP4,��Xc8^��`׃��l.����S�hޔ���O+�%P#Ρ\n?��IB��eˑ�O\\]��6�#��۽؁(!c)�N����?E��B##D �Ddo��P�A�\0�:�n�Ɵ�`  ��Q��>!\r6�\0��V%cb�HF�)�m&\0B�2I�5��#]���D>��3<\n:ML��9C���0��\0���(ᏩH\n����M�\"GR\n@���`[���\ni*\0��)������u�)��Hp\0�N�	�\"��N:9q�.\r!���J��{,�'����4�B���lq���Xc��4��N1ɨ5�Wm��3\n��F��`�'��Ҋx��&>z>N�\$4?����(\n쀨>�	�ϵP�!Cq͌��p�qGLqq�G�y�H.�^��\0z�\$�AT9Fs�Ѕ�D{�a��cc_�G�z�)� �}Q��h��HBָ�<�y!L����!\\�����'�H(��-�\"�in]Ğ���\\�!�`M�H,gȎ��*�Kf�*\0�>6���6��2�hJ�7�{nq�8����H�#c�H�#�\r�:��7�8�܀Z��ZrD��߲`rG\0�l\n�I��i\0<����\0Lg�~���E��\$��P�\$�@�PƼT03�HGH�l�Q%*\"N?�%��	��\n�CrW�C\$��p�%�uR`��%��R\$�<�`�Ifx���\$/\$�����\$���O�(���\0��\0�RY�*�/	�\rܜC9��&hh�=I�'\$�RRI�'\\�a=E����u·'̙wI�'T���������K9%�d����!��������j�����&���v̟�\\=<,�E��`�Y��\\����*b0>�r��,d�pd���0DD ̖`�,T �1�% P���/�\r�b�(���J����T0�``ƾ����J�t���ʟ((d�ʪ�h+ <Ɉ+H%i�����#�`� ���'��B>t��J�Z\\�`<J�+hR���8�hR�,J]g�I��0\n%J�*�Y���JwD��&ʖD�������R�K\"�1Q�� ��AJKC,�mV�������-���KI*�r��\0�L�\"�Kb(����J:qKr�d�ʟ-)��ˆ#Ը�޸[�A�@�.[�Ҩʼ�4���.�1�J�.̮�u#J���g\0��򑧣<�&���K�+�	M?�/d��%'/��2Y��>�\$��l�\0��+����}-t��ͅ*�R�\$ߔ��K�.����JH�ʉ�2\r��B���(P���6\"��nf�\0#Ї ��%\$��[�\n�no�LJ�����e'<����1K��y�Y1��s�0�&zLf#�Ƴ/%y-�ˣ3-��K��L�΁��0����[,��̵,������0���(�.D��@��2�L+.|�����2�(�L�*��S:\0�3����G3l��aːl�@L�3z4�ǽ%̒�L�3����!0�33=L�4|ȗ��+\"���4���7�,\$�SPM�\\��?J�Y�̡��+(�a=K��4���C̤<Ё�=\$�,��UJ]5h�W�&t�I%��5�ҳ\\M38g�́5H�N?W1H��^��Ը�Y͗ؠ�͏.�N3M�4Å�`��i/P�7�dM>�d�/�LR���=K�60>�I\0[��\0��\r2���Z@�1��2��7�9�FG+�Ҝ�\r)�hQtL}8\$�BeC#��r*H�۫�-�H�/���6��\$�RC9�ب!���7�k/P�0Xr5��3D���<T�Ԓq�K���n�H�<�F�:1SL�r�%(��u)�Xr�1��nJ�I��S�\$\$�.·9��IΟ�3 �L�l���Ι9��C�N�#ԡ�\$�/��s��9�@6�t���N�9���N�:����7�Ӭ�:D���M)<#���M}+�2�N��O&��JNy*���ٸ[;���O\"m����M�<c�´���8�K�,���N�=07s�JE=T��O<����J�=D��:�C<���ˉ=���K�ʻ̳�L3�����LTЀ3�S,�.���q-��s�7�>�?�7O;ܠ`�OA9���ϻ\$���O�;��`9�n�I�A�xp��E=O�<��5����2�O�?d�����`N�iO�>��3�P	?���O�m��S�M�ˬ��=�(�d�Aȭ9���\0�#��@��9D����&���?����i9�\n�/��A���ȭA��S�Po?kuN5�~4���6���=򖌓*@(�N\0\\۔dG��p#��>�0��\$2�4z )�`�W���+\0��80�菦������z\"T��0�:\0�\ne \$��rM�=�r\n�N�P�Cmt80�� #��J=�&��3\0*��B�6�\"������#��>�	�(Q\n���8�1C\rt2�EC�\n`(�x?j8N�\0��[��QN>���'\0�x	c���\n�3��Ch�`&\0���8�\0�\n���O`/����A`#��Xc���D �tR\n>���d�B�D�L��������Dt4���j�p�GAoQoG8,-s����K#�);�E5�TQ�G�4Ao\0�>�tM�D8yRG@'P�C�	�<P�C�\"�K\0��x��~\0�ei9���v))ѵGb6���H\r48�@�M�:��F�tQ�!H��{R} �URp���O\0�I�t8������[D4F�D�#��+D�'�M����>RgI���Q�J���U�)Em���TZ�E�'��iE����qFzA��>�)T�Q3H�#TL�qIjNT���&C��h�X\nT���K\0000�5���JH�\0�FE@'љFp�hS5F�\"�oѮ�e%aoS E)� ��DU��Q�Fm�ѣM��Ѳe(tn� �U1ܣ~>�\$��ǂ��(h�ǑG�y`�\0��	��G��3�5Sp(��P�G�\$��#��	���N�\n�V\$��]ԜP�=\"RӨ?Lzt��1L\$\0��G~��,�KN�=���GM����NS�)��O]:ԊS}�81�RGe@C�\0�OP�S�N�1��T!P�@��S����S�G`\n�:��P�j�7R� @3��\n� �������DӠ��L�����	��\0�Q5���CP��SMP�v4��?h	h�T�D0��֏��>&�ITx�O�?�@U��R8@%Ԗ��K���N�K��RyE�E#�� @����%L�Q�Q����?N5\0�R\0�ԁT�F�ԔR�S�!oTE�C(�����ĵ\0�?3i�SS@U�QeM��	K�\n4P�CeS��\0�NC�P��O�!�\"RT�����S�N���U5OU>UiI�PU#UnKP��UYT�*�C��U�/\0+���)��:ReA�\$\0���x��WD�3���`����U5�IHUY��:�P	�e\0�MJi�����Q�>�@�T�C{��u��?�^�v\0WR�]U}C��1-5+U�?�\r�W<�?5�JU-SX��L�� \\t�?�sM�b�ՃV܁t�T�>�MU+�	E�c���9Nm\rRǃC�8�S�X�'R��XjCI#G|�!Q�Gh�t�Q��� )<�Y�*��RmX0����M���OQ�Y�h���du���Z(�Ao#�NlyN�V�Z9I���M��V�ZuOՅT�T�EՇַS�e����\n�X��S�QER����[MF�V�O=/����>�gչT�V�oU�T�Z�N�*T\\*����S-p�S��V�q��M(�Q=\\�-UUUV�C���Z�\nu�V\$?M@U�WJ\r\rU��\\�'U�W]�W��W8�N�'#h=oC���F(��:9�Yu����V-U�9�]�C�:U�\\�\n�qW���(TT?5P�\$ R3�⺟C}`>\0�E]�#R��	��#R�)�W���:`#�G�)4�R��;��ViD%8�)Ǔ^�Q��#�h	�HX	��\$N�x��#i x�ԒXR��'�9`m\\���\nE��Q�`�bu@��N�dT�#YY����GV�]j5#?L�xt/#���#酽O�P��Q��6����^� �������M\\R5t�Ӛp�*��X�V\"W�D�	oRALm\rdG�N	����6�p\$�P废E5����Tx\n�+��C[��V�����8U�Du}ػF\$.��Q-;4Ȁ�NX\n�.X�b͐�\0�b�)�#�N�G4K��ZS�^״M�8��d�\"C��>��dHe\n�Y8���.� ���ҏF�D��W1cZ6��Q�KH�@*\0�^���\\Q�F�4U3Y|�=�Ӥ�E��ۤ�?-�47Y�Pm�hYw_\r�VeױM���ُe(0��F�\r�!�PUI�u�7Q�C�ю?0����gu\rqधY-Q�����=g\0�\0M#�U�S5Zt�֟ae^�\$>�ArV�_\r;t���HW�Z�@H��hzD��\0�S2J� HI�O�'ǁe�g�6�[�R�<�?� /��KM����\n>��H�Z!i����TX6���i�C !ӛg�� �G }Q6��4>�w�!ڙC}�VB�>�UQڑj�8c�U�T���'<�>����HC]�V��7jj3v���`0���23����x�@U�k�\n�:Si5��#Y�-w����M?c��MQ�GQ�уb`��\0�@��ҧ\0M��)ZrKX�֟�Wl������l�TM�D\r4�QsS�40�sQ́�mY�h�d��C`{�V�gE�\n��XkՁ�'��,4���^��6�#<4��NXnM):��OM_6d�������[\"KU�n��?l�x\0&\0�R56�T~>��ո?�Jn��� ��Z/i�6���glͦ�U��F}�.����JL�CTbM�4��cL�TjSD�}Jt���Z����:�L���d:�Ez�ʤ�>��V\$2>����[�p�6��R�9u�W.?�1��RHu���R�?58Ԯ��D��u���p�c�Z�?�r׻ Eaf��}5wY���ϒ���W�wT[Sp7'�_aEk�\"[/i��#�\$;m�fأWO����F�\r%\$�ju-t#<�!�\n:�KEA����]�\nU�Q�KE��#��X��5[�>�`/��D��֭VEp�)��I%�q���n�x):��le���[e�\\�eV[j�����7 -+��G�WEwt�WkE�~u�Q/m�#ԐW�`�yu�ǣD�A�'ױ\r��ՙO�D )ZM^��u-|v8]�g��h���L��W\0���6�X��=Y�d�Q�7ϓ��9����r <�֏�D��B`c�9���`�D�=wx�I%�,ᄬ�����j[њ����O��� ``��|�����������.�	AO���	��@�@ 0h2�\\�ЀM{e�9^>���@7\0��˂W���\$,��Ś�@؀����w^fm�,\0�yD,ם^X�.�ֆ�7����2��f;��6�\n����^�zC�קmz��n�^���&LFF�,��[��e��aXy9h�!:z�9c�Q9b� !���Gw_W�g�9���S+t���p�tɃ\nm+����_�	��\\���k5���]�4�_h�9 ��N����]%|��7�֜�];��|���X��9�|����G���[��\0�}U���MC�I:�qO�Vԃa\0\r�R�6π�\0�@H��P+r�S�W���p7�I~�p/��H�^������E�-%��̻�&.��+�Jђ;:���!���N�	�~����/�W��!�B�L+�\$��q�=��+�`/Ƅe�\\���x�pE�lpS�JS�ݢ��6��_�(ů���b\\O��&�\\�59�\0�9n���D�{�\$���K��v2	d]�v�C�����?�tf|W�:���p&��Ln��賞�{;���G�R9��T.y���I8���\rl� �	T��n�3���T.�9��3����Z�s����G����:	0���z��.�]��ģQ�?�gT�%��x�Ռ.����n<�-�8B˳,B��rgQ�����Ɏ`��2�:{�g��s��g�Z��� ׌<��w{���bU9�	`5`4�\0BxMp�8qnah�@ؼ�-�(�>S|0�����3�8h\0���C�zLQ�@�\n?��`A��>2��,���N�&��x�l8sah1�|�B�ɇD�xB�#V��V�׊`W�a'@���	X_?\n�  �_�. �P�r2�bUar�I�~��S���\0ׅ\"�2����>b;�vPh{[�7a`�\0�˲j�o�~���v��|fv�4[�\$��{�P\rv�BKGbp������O�5ݠ2\0j�لL���)�m��V�ejBB.'R{C��V'`؂ ��%�ǀ�\$�O��\0�`����4 �N�>;4���/�π��*��\\5���!��`X*�%��N�3S�AM���Ɣ,�1����\\��caϧ ��@��˃�B/����0`�v2��`hD�JO\$�@p!9�!�\n1�7pB,>8F4��f�π:��7���3��3����T8�=+~�n���\\�e�<br����Fز� ��C�N�:c�:�l�<\r��\\3�>���6�ONn��!;��@�tw�^F�L�;���,^a��\ra\"��ڮ'�:�v�Je4�א;��_d\r4\r�:����S�����2��[c��X�ʦPl�\$�ޣ�i�w�d#�B��b��������`:���~ <\0�2����R���P�\r�J8D�t@�E��\0\r͜6����7����Y���\"����\r�����3��.�+�z3�;_ʟvL����wJ�94�I�Ja,A����;�s?�N\nR��!��ݐ�Om�s�_��-zۭw���zܭ7���z���M����o����\0��a��ݹ4�8�Pf�Y�?��i��eB�S�1\0�jDTeK��UYS�?66R	�c�6Ry[c���5�]B͔�R�_eA)&�[凕XYRW�6VYaeU�fYe�w��U�b�w�E�ʆ;z�^W�9��ק�ݖ��\0<ޘ�e�9S���da�	�_-��L�8ǅ�Q��TH[!<p\0��Py5�|�#��P�	�9v��2�|Ǹ��fao��,j8�\$A@k����a���b�c��f4!4���cr,;�����b�=��;\0��ź���cd��X�b�x�a�Rx0A�h�+w�xN[��B��p���w�T�8T%��M�l2�������}��s.kY��0\$/�fU�=��s�gK���M� �?���`4c.��!�&�分g��f�/�f1�=��V AE<#̹�f\n�)���Np��`.\"\"�A�����q��X��٬:a�8��f��Vs�G��r�:�V��c�g�Vl��g=��`��W���y�gU��˙�Ẽ�eT=�����x 0� M�@����%κb���w��f��O�筘�*0���|t�%��P��p��gK���?p�@J�<Bٟ#�`1��9�2�g�!3~����nl��f��Vh���.����aC���?���-�1�68>A��a�\r��y�0��i�J�}�������z:\r�)�S���@��h@���Y���mCEg�cyφ��<���h@�@�zh<W��`��:zO���\r��W���V08�f7�(Gy���`St#��f�#����C(9���؀d���8T:���0�� q���79��phAg�6�.��7Fr�b� �j��A5��a1��h�ZCh:�%��gU��D9��Ɉ�׹��0~vTi;�VvS��w��\r΃?��f�����n�ϛiY��a��3�·9�,\n��r��,/,@.:�Y>&��F�)�����}�b���iO�i��:d�A�n��c=�L9O�h{�� 8hY.������������\r��և�����1Q�U	�C�h��e�O���+2o����N�����zp�(�]�h��Z|�O�c�zD���;�T\0j�\0�8#�>Ύ�=bZ8Fj���;�޺T酡w��)���N`���ÅB{��z\r�c���|dTG�i�/��!i��0���'`Z:�CH�(8�`V������\0�ꧩ��W��Ǫ��zgG������-[��	i��N\rq��n���o	ƥfEJ��apb��}6���=o���,t�Y+��EC\r�Px4=����@���.��F��[�zq���X6:FG��#��\$@&�ab��hE:����`�S�1�1g1���2uhY��_:Bߡdc�*���\0�ƗFYF�:���n���=ۨH*Z�Mhk�/�냡�zٹ]��h@����1\0��ZK�������^+�,vf�s��>���O�|���s�\0֜5�X��ѯF��n�A�r]|�Ii4�� ��C� h@ع����cߥ�6smO������gX�V2�6g?~��Y�Ѱ�s�cl \\R�\0��c��A+�1������\n(����^368cz:=z��(�� ;裨�s�F�@`;�,>yT��&��d�Lן��%��-�CHL8\r��b�����Mj]4�Ym9����Z�B��P}<���X���̥�+g�^�M� + B_Fd�X���l�w�~�\r⽋�\":��qA1X������3�ΓE�h�4�ZZ��&����1~!N�f��o���\nMe�଄��XI΄�G@V*X��;�Y5{V�\n���T�z\rF�3}m��p1�[�>�t�e�w����@V�z#��2��	i���{�9��p̝�gh���+[elU���A�ٶӼi1�!��omm�*K���}��!�Ƴ����{me�f`��m��C�z=�n�:}g� T�mLu1F��}=8�Z���O��mFFMf��OO����������/����ޓ���V�oqj���n!+����Z��I�.�9!nG�\\��3a�~�O+��::�K@�\n�@���Hph��\\B��dm�fvC���P�\" ��.nW&��n��HY�+\r���z�i>Mfqۤ��Qc�[�H+��o��*�1'��#āEw�D_X�)>�s��-~\rT=�������- �y�m����{�h��j�M�)�^����'@V�+i�������;F��D[�b!����B	��:MP���ۭoC�vAE?�C�IiY��#�p�P\$k�J�q�.�07���x�l�sC|���bo�2�X�>M�\rl&��:2�~��cQ����o��d�-��U�Ro�Y�nM;�n�#��\0�P�f��Po׿(C�v<���[�o۸����fѿ���;�ẖ�[�Y�.o�Up���pU���.���B!'\0���<T�:1�������<���n��F���I�ǔ��V0�ǁRO8�w��,aF��ɥ�[�Ο��YO����/\0��ox���Q�?��:ً���`h@:�����/M�m�x:۰c1������v�;���^���@��@�����\n{�����;���B���8�� g坒�\\*g�yC)��E�^�O�h	���A�u>���@�D��Y�����`o�<>��p���ķ�q,Y1Q��߸��/qg�\0+\0���D���?�� ����k:�\$����ץ6~I��=@���!��v�zO񁚲�+���9�i����a������g������?��0Gn�q�]{Ҹ,F���O���� <_>f+��,��	���&�����·�y�ǩO�:�U¯�L�\n�úI:2��-;_Ģ�|%�崿!��f�\$���Xr\"Kni����\$8#�g�t-��r@L�圏�@S�<�rN\n�D/rLdQk࣓�����e����Э��\n=4)�B���ך��Z-|Hb����Hk�*	�Q!�'��G ��Ybt!��(n,�P�Ofq�+X�Y����\"b F6��r f�\"�ܳ!N��^��r�B_(�\"�K�_-<��*Q���/,)�H\0����r�\"z2(�tه.F>��#3���268sh٠��ƑI1Sn20���-��4���2A�s(�4�˶��\0��#��r�K'�ͷG'�7&\n>x���J�GO8,�0���8���\0�W9��I�?:3n�\r-w:�����;3ȉ�!�;��ꃘ�Z�RM�+>�����0/=R�'1�4�8����m�%ȥ}χ9�;�=�nQ��=�hhL��G�kW�\r�	%�4Ҝs�ΖJ�3s�4�@�U�%\$���N;�?4���N��2|��Z�3�h\0�3�5�^�xi2d\r|�M�ʣbh|�#v�` \0�ꐮ���\$\r2h#���?���I\n���+o-��?6`ṽ�.\$���KY%�J?�c�R�N#K:�K�EL�>:��@��jP��n_t&slm�'�ЩɸӜ�����;6ۗHU5#�Q7U��WY�U bN��W�_���;TC�[�<ږ>����W�CU��6X#`MI:t�ӵ��	u#`�fu�\$�t���X�`�f<�;b�gh���9�7�S58���#^�-�\0����չR*�'��(���qZ壣�X�Q�FUv�W GW���T��W�~ڭ^�W�����J=_ؗbm��bV\\l��/�M��TmTOXu�=_��ITvvu�a\rL_�qR/]]m�su=H=u�g o\\UՅgM�	XVU��%�h��53U�\\=��Q��M�v���g�m��ue�����h�b�M�GCeO5�ԁ�O5��Y�i=e�	G�TURvOa�*�ivWX�J5<��bu�]������<����\$u3v#�'e�u�R5m��v�D5�.v���W=�U_�(�\\V��_<��S�n)�1M%Qh�Z�T�f5E�'��W��v�UmiՂU��]aW�U�dRv��-YUZu��UV��UiR�V������[��ZMU�\\=�v{�X���wQ�huHv��gqݴw!�oqt�U{TGq�{�#^G_ubQ���i9Qb>�NUd��k��5hP�mu[�\0����_��[�Y-����r���(�CrMe�J�!h?QrX3 x���#��x�<�{u5~���-�u��YyQ\r-��\0�uգuuٿpUڅ�)�P��\r<u�S�0��w��-i���!�֊�B���d]��Ň��E��vlmQݏ6k��J��w��Ğ����ED�U�R�e�v:X�c�NW}`-�t�H#e��b��u���	~B7� ?�	OP�CW���SE͕V>���U�7�����m�ӂ�z�=����1���+��m�I,>�X7��]�.��*	^��N��.��/\"���)�	���s��|��ӟ�l�}�����!�5n�p�j��h�}���m�E�zH�aO0d=A|w�߳������u���v���G�x#��b�cS�o-��tOm`C��^M��@�h�n\$k�`�`HD^�PE�[�]��rR�m�=�.�ه>Ayi� \"���	��o�-,.�\nq+���fXd����*߽�K�؃'�� �%a����9p���KLM��!�,������zX#�V�uH%!��63�J�ryՁ��q_�u	�W����|@3b1��7|~wﱳ��A7���	��9cS&{���%Vx��kZO��w�Ur?����N �|�C�#Ű��կ �/��9�ft�Ew�C��a�^\0�O<�W�{Y�=�e��n���gyf0h@�S�\0:C���^��VgpE9:85�3�ާ���@��j_�[�+��ǩx�^�ꮆ~@чW���㓜�9x�FC���.�����k^I���pU9��S������\$���\r4���\0��O���)L[�p?�.PECS�I1nm{�?�P�WA߲�;���D�;S�a�Kf��%�?�X��+��B>��9���Gj�c�z�A͎�:�a�n0bJ{o��!3��!'��K�����}�\\��3W��5�x���L;�2ζn�a;���׺Xӛ]�o��x�{�5ޙjX���vӚ��q��EE{р4����{���	�\n��>��aﯷ�����L����������'����{�\n��>J�ߌ��ӗ��Y�\rOʽ�t����-O���4��9F�;�����G��I�F��1�o����O���a{w�0����Ư;񔄑l�o��J�Tb\rw�2�J��=D#�n�:�y��S�^�,.�?(�I\$���Ư���3��s�4M�aCR���G̑��I߰n<�zy�XN��?��.��=���DǼ�\r����\n��\ro��\nПCl%��Y���߰��G���}#�VН%�(����3�ɍ�r��};��׿G��n�[�{����_<m4[	I����q��?�0cV�nms��nM���\"Nj1�w?@�\$1��>��^�����\\�{n�\\���7���ٟic1���hoo�?j<G�x�l���S�r}���|\"}��/�?s��tI���&^�1e��t��,�*'F��=�/F�k�,95rV������쑈��o9��/F��_�~*^��{�I����_�����^n���N��~���A���d����U�w�qY���T�2��G�?�&����:y��%��X�J�C�d	W�ߎ~�G!��J}��������B-��;���h�*�R���E��~���.�~���SAqDVx���='��E�(^���~����������o7~�M[��Q��(��y��nP�>[WX{q�aϤ���.&N�3]��HY������[���&�8?�3������݆����#���B�e�6��@��[������G\r�+��}������_��7�|N����4~(z�~����%��?����[��1�S�]x�k��KxO^�A���rZ+����*�W��k�wD(���R:��\0����'����m!O�\n��u���.�[ �P�!��}��m ��1p�u��,T��L 	0}��&P٥\n�=D�=���\rA/�o@��2�t�6�DK��\0���q�7�l���B���(�;[��kr\r�;#���lŔ\r�<}zb+��O�[�WrX�`�Z ţ�Pm'Fn����Sp�-�\0005�`d���P���Ǿ��;��n\0�5f�P���EJ�w�� �.?�;��N�ޥ,;Ʀ�-[7��e��i��-���dَ<[~�6k:&�.7�]�\0������/�59 ��@eT:煘�3�d�sݝ�5䏜5f\0�P��HB������8J�LS\0vI\0���7Dm��a�3e��?B��\$�.E���f���@�n���b�Gb��q3�|��Paˈ�ϯX7Tg>�.�p�5��AHŵ��3S�,��@�#&w��3��m[���I�ѥ�^�̤J1?�gTၽ#�S�=_��_��	���Vq/C۾�݀�|�����D �g>܄��� 6\r�7}q��Ť�JG�B^�\\g������&%��[�2Ixì��6\03]�3�{�@RU��M��v<�1����sz�uP�5��F:�i�|�`�q���V| ��\nk��}�'|�gd�!�8� <,�P7�m��||���I�A��]BB �F�0X���	�D��`W���qm�OL�	�.�(�p��ҁ��\"!����\0��A����V��7k��M�\$�N0\\���\"�f������\0uq��,��5��A6�p���\n�ΐjY�7[pK��4;�l�5n��@�\\f��l	��M���P��3��C�HbЌ��cEpP���4eooe�{\r-��2.�֥��P50u���G}��\0����<\r��!��~�������\n7F��d�����>��a��%�c6Ԟ��M��|��d����O�_�?J��C0�>Ё�&7kM4�`%f�l�ΘB~�wx��ZG�P�2��0�=�*p��@�BeȔ��|2�\r�?q��8�����Њ(�yr���0��>�>�E?w�|r]�%Av�����@�+�X��Ag����s��C��AXmNҝ�4\0\r���8J�J�ǸD�Қ�:=	������S�4��F;	�\\&��P!6%\$i�xi4c�0B�;62=��1��̈PC��m���dpc+�5��\$/rCR�`�MQ�6(\\��2A���\\��lG�l�\0Bq��P�r���B����т�_6Ll�!BQ��IG�����XRbs�]B�Hr���`�X��\$p�8���	nbR,±�L��\"�E%\0�aYB�s���D,�!��ϛpN9RbG�4��M��t����jU�����y\0��%\$.�iL!x��ғ�(�.�)6T(�I��a%�K�]m�t���&��G7�ITM�B�\rza��])va�%���41T�j͹(!�����\\�\\�W��\\t\$�0��%�\0aK\$�T�F(Y�C@��H���H�nD�d��Wp��hZ�'�ZC,/���\$����J�FB�uܬQ:Υ�A��:-a#��=jb��l�Ug;{R��U��EWn�Ua��V��Nj��u�G�*�yֹ%��@��*���Yx�_�z�]�)v\"��R��L�VIv�=`��'��U�) S\r~R���\ni��)5S��D49~�b�;)3�,�9M3�HsJkT�Ü�(����uJ�][\$uf��ob���\n.,�Yܵ9j1'��!�1�\$J��gڤ՟ĆU0��Zuah���cH��,�Yt��Kb�5��5��/dY��AU�҅��[W>�_V�\r��*���j��-T�� z�Y�d�c�m�ҹ��:����[Ut-{���l	�i+a)�.[��_:�5��h��W§�m��%JI��[T�h>�������;�X̺d�S�d�V�;\rƱ!N��K&�A�Ju4B��dg΢.Vp��mb��)�V!U\0G丨��`���\\��q�7Q�b�VL��:�Ղ���Z.�N��*�ԏU]Z�l�z������R D1I��£�r:\0<1~;#�Jb���M�y�+�۔/�\"ϛj<3�#��̌��:P.}�e����D\"q�yJ�G���sop�����X�\r��d��\rxJ%���ƼO:%yy��,��%{�3<�Xø����z�E�z(\0 �D_���.2+�g�b�c�x�pgި��|9CP����48U	Q�/Aq��Q�(4 7e\$D��v:�V�b��N4[��iv���2�\r�X1��AJ(<PlF�\0���\\z�)���W�(�4����� p�����`��\r�da6����O��m�a�}q�`��6P�'h��3�|����f� j��A�z���+�D�UW�D���5��%#�x�3{��L\r-͙]:jd�P	j�f�q:Z�\"sad�)�G�3	��+��r�NK��1Q���x=>�\"��-�:�F���Iك*�@ԟ�y�T�\\U��Y~������3D������f,s�8HV�'�t9v(:��B9�\\Z����(�&�E8���W\$X\0�\n��9�WB��b��66j9� �ʈ��?,��| �a��g1�\nPs�\0@�%#K����\r\0ŧ\0���0�?�š,�\0��h��h�\08\0l\0�-�Z��jb�Ŭ\0p\0�-�f`ql��0\0i-�\\ps��7�e\"-Z�lb�E�,�\0��]P ��E��b\0�/,Z��\r�\0000�[f-@\rӯEڋ�/�Z8��~\"��ڋ��.^��Qw��ϋ�\0�/t_ȼ���E���\0�0d]��b�Ť�|\0��\\ؼ���E�\0af0tZ��n�J�\0l\0�0L^��Qj@��J��^��q#F(�1�/�[�1�����I�.�^8��\0[�q��[Ñl\"�� ��\0�0,d����\r����c��{cE�\0o�0�]�\0\rc%�ۋ���8�w���Z��-�\\��{��֋G�/\\bp��@1�\0a�1�����s�!Ũ�/�/�]8��~c\"�ۋ��2�cΑm�\"�9�q�/\\^fQ~c�_���-\$i�\"�\0003����fX�qx#\09��Z.�i���@F���3tZH� \rcK�b\0j�/Dj��1����I�h�a��v�Ʃ�OZ4�Z��т#YE�\0i�.hH��sX/F<���.�j���b���\0mV/d\\���b�E����3T^(�шcKFR�����]X�q��������6�]h��c6Eċ�66�h����n\0005�sn/dn��`\r\"�F���-D`�Ց��N�2�Y��bx��#\\�닇V3x�1x�Fx��\0�6�b�q����!��8|^���ub�����-�r��q��:��%�0�pp�#����\0�6�f��Ǣ�Ŭ�d�0�qH����\$�@�q�-�^B4��\"�\08�1�/lnxϑ���G�3:0tjh�~@Ƽ���3�vH��b�G(�e��4gغq��2�1��-�nX��\"�F<�Q�1\\j��1���Eǋ��4m����[�n�z7�yh�1�#�ގ/�3\\x�q�KG����6�o��1{��FJ���6�lX�q⣄�u���9�r(�1��Gc\0�f:�rX��#�Ž\0i�<\\}���b�F�\0s�7�y2���#uFe��\">4i��������\n<{�㑍��Ɖ�J;�]��1�#��0��J;4^��D���Ǯ����4i��(H#��E�x�/�n��1��/ǡ��j6,l��1t�/\0005%�0�]x����GG5�!�0��������r�q�2��ޑ��NFP�o\"4�_��1�d�%�e �3�s8���G5�� �6�[H��c�H�jY�;�[辑�b�! �y�@�\\��q�#WHN���;�c�Q��:�-�%�.�kXƑ���G͌��1Df�ߑ�cWFl��!�0����c Eܐ��;l��q�\"�F����7\\\\������O�q�.T|\"?����E��f9TyYѩ�SG1���A\$f9R\n\"��x��>B��H��ߤ\0���:\$e�1���F?�=�3Tu)\nq�b��~���<T��α�c�H.�m~C�wHʱ�#/�I�]~3�^��ф#��>�Y�4�^��Qjc��K�1\"�8�|6��c\"�B��\"b4���%����G\0e\"�/t���1r�1��e!v2�y����<Ǡ���8\\o��ђ#t�ѐ\rz@�}H�b���y �1�\\���deG��Z3�~�r)�1ȿ���Bl~H��:�dF��-�?�k8�q�c(F͋�K�5|my�c1�<�*@�j���1��ž��>I�Z��Qj��2��\$0��h�Q��VFT�	\$�Al~�qڣȱ�\$�>\\p�\rq�\$/�u%�!�Jq \$��tE��GN-Tq)�\"��Hʌ��=�X�2-�H���8\\n��RW\$H��\"�C\\_�\0�d\$�f��\".D�u	'Q�zE��&0to��qj��ƿ��R@d������u�##�LLk�*q�\$*Gđi�@T�i�l��E����5���r\\d�I���\"/�Z�0�j\$T���z5Ld3�����o�.Tq�!1{�����9�Z��Q�b�F�wJ94n�����{�(�-�8�2h�u��;\$�-Dk��rs��H���#���Y7�\"�/E����	\$j�^�-�]�7�[\"N\$����W����/]�\$�+�1Ga�/&IDn�@\$��!��\$�-�k!�Q����)(N/\$t������O�KzP�tX��[\0�G��w(*K\$v��1�c�'��G̞I�xd��\n�A�8\\rX��a��I�iN�I%\$���_���6�f�Q�#��I�5#�F��غ��#�E⒕\"�3\$�I�c�H���vR|�Q��cE���:R�e��h�EΏfK`8�r.#�E��s�0L���R��F���!\nC\$`���\$�H?��nP�e�!�@F'���/�����������%�N,h��rF\$�����3�t��Ҁ���!1<��CQ�%�Ò��J�Z�f.�6ō����C���Ԝ.�[��Bҿx����\0NRn`���Y\n�%+N�IMs:ùYd�ef�B[���nƹY��m��R�ג��Y��C�X���j��U+Vk,�\0P��b@e���x��V��yT�7�u�[J�ȱ\nD��eR��mx&�l�\0)�}�J�,\0�I�ZƵ\$k!���Yb�����Re/Q���k�5.�e��5����W�`��\0)�Yv\"V�\0��\n�%��`Yn�աa��xÆQ!,�`\"�	_.�偩Ɩtm\$�\"��J��֍���v�%�M9j��	斧�*�Kp֔�;\\R ��3(���^��:}���|>µa-'U%w*�#>�@�̬e�J���;Pw/+��5E\rjn���d���^[���cΰ�u�z\\ؐ1mi\"x��p��;����P)����#��ؒ���!A�;��	4�a{`aV{K�U��8㨟0''o�2���yc̸9]K�@�җ^�lB��Or���,du��8�?����%�gB����Yn+�%c�e\0���ऱYr@f�(]ּ�\nbiz��n�SS2��GdBPj���@�(�ȥ�!�-�v��e�*c\0��4J�炒���,�U�	d��e�j'T�H]Ԋ�G!�)u��֯��ү�Z�B5�̓W��0\n���R���W��\\�Q j�^r�%l��3,�Yy��f3&��܎�Q:ϵ2�m�R)�T��(KR��0�ʔ@��Y��Y:��e3\r%���T�%�X����ST�.J\\�0�h�ą�D!�:�u���U\"�Ł�o+7�\"����f'��R\0���J��2S�2�#nm ��I劜�\"X���[�ր��} J��c�9p0���Q�(U\0�xDEW��.L��=<B�0+�)ZS V;�\\�I{�5I�A���,dW�u�5Ew\n\$%ҁ���2i_\$��+��O,����X��ՑJg&J��G��%\\J��b.��^L�T�Fl�薹]k#f@L�G�ĐT�ٗ��H��\"�q1S̰��j�V�(Ι��ZVz�ņ�,����G�.1F��gN�;�1ÊV��5E��5`�\0Ct�=F\nṛα�K����\0�ۊ�%��D]Q\$\r\0�3J\\,͙��<T4*���.�YK�D�Q��L�S%,�g������<��u0���Uĉ�*x(��NYv!��y�	w�4fd��rG��M \$��^;�����)<P�]D�%%�;�j��I0�a�u^Jp�[)�v�3RhR�E��\n�L_�#5|ܾ�m3P�*�\\Y51X��	i�N���\$\"��a���h*KU���V8��u�%&�r�˚��5o���g�;�rMl[ƨ�g������U�q�깚h|�eO2�f MlW2AP�׹�����v~eD�e�3Uӫl�E62i�����Ub���U���������V��iI!\$i�ʭ&Z:��xm!ņ�.�O�fwү!���kݤ̓��6b\"�I�J]]:T��6�Vr��}��ǫ]����U��	ys7f�Mř�3����Y��:T_M�w%3�n��\n��z*��3�h��	�`U��L���,�ۄ�5��vf��Û�42_Q��h���uD�\no��)�ĜիM9�7foۼ��r����WB~iT�eyQT�N\n�d�pr�#��M�;���4�p���t���(;���5	|��ǂ��',AV7ܔ��UA�&��R�P�\"��y�ҷ��)�[�n���-3V��,?�s6�p���3�f��A��9k|�ɮS�f�*@��5�g��ɿ2��}����U�ݙ����H�F�l%�p«Ie�be�M�SO\r�[��i�3�f��LV��r�u�����NA�:�%r��y3Q�_̸�W.���^Sl@&���5�Yl��1���}Vx�gʅ�^Sn���Q!:5�Z�iZCԈ:���3qg�%D��ݪ{U�3�tZ�`��u%w:�ZQ:Q���W f�훿9Jpl�)�3x�v���K7�b#�����X+J�(��h��P*Ӂ���Λ��!ה�ŏSL�h*'���\npB��ڪ�gNʝ�8BuҪ���Ό��8ni�I�s�US�I��;vvڳU�sR�7N�u�8�H|���ӷ�̎��8�q����+'���`�x�9R�	ծ��MaR8�x�)��'!���;�U��Y֓��sNI�g:�KT�y�3�g��Y����k���ܳn'LO(��3�w4�4������l���J����w��9�\\����hf(�_~���}9N���\0���b\"�Y餃Th,ڞ�@��D���\$�I��;�e��U��n����,�O��	X��g�-���+>ti'G����l�%\0�8�VB�U1�ye�\0KT�4���m��V2)\r]I/\rF���X���ߨ�a��G�¹�*�����>ER������Z�-)I\$����:�a�\0�Fyba�g�w��(�_@�v}�i�ʳ�S^�25DԳ�	��URO��JH��\\�is�f��K�N��qi�Sg�O\n�F~|���*@gR�_Q<9sܬ3i+ؗ�.Cw���|���y�6a�O�Y9���ɖ\n�Խ-([���_�}�S�]c�S=��������Y��U->�<���\n<�sO�Q4F�^}\0007u�k(/���/5{L�9�\0����&��[<���s�\0&��#�@h��3�V}��H���*�w+]'D�&�@�ց])��;TGe3��\\��n����d\$:�uN4�ykt�-dR!7����e4(P!��-��9�4�_PMGb��ıw����6O�S�F���)��yh0+����qT|��+u���+��A�?��	�T�3.q��41T��e��\n:P����{T�\n��h?��T�A�S��*���+�u�>�\\�Z����Y췢wEJ��%��s�L��d��y�+\rC�ߡ'A�l,�y�3���͗`�	_*�P� ThKDV���~5	�0�+�,�-?�]���3�֍K�`�^���I42(]�w�.�r����]�\nYƨB����	��}ЋR ��g�}:H��J�WP��\"޵���V\\�<��? >�����ܬ݆�=��:�\n0��\\+�S���f�U���U,�WCֈ�On��΅��.�e9|R�I'�[�/������2���Q��Bn:�I�\n��g�9�\r�,�R6����Q\$X�+�>����`\n�)/_8Qi�����=��v?5v�\0 \n���LG�Dm�w\\�F֌�Ѣ���dꟵ}s�\"��Yv�|�J*�9h���@XEU�*�(oQ]\$�B��,�����KT�v�AptCɃ\n�C,/�<��ڙEW�-V�P��=W�*%K�-Q`9	(��59Ӏ�m)�X��@�2���T@��\nS���bd�Eδa�+�DX��|U�	�	��F� 2�%5\nj�m��W�+�x�K��V�3#��CT�ek���&�,�l�jbd7)ӓ\"\n+�P��b��I�@�3��ܵjU��Es��)D�f뒃������P�Z3AΌ�\nwTh𗲪ۘ�4Z��<�uߩ�dq�ˊu(���bKG����n�Tﮈ]z��f%#�3I�fS��&}�@D�@++��A�h���\n��U�ޥ|B�;��Um��U�E�N�!�x2�1�\0�GmvH~��H�T�)�W��YN�\"�k5��vT#=�ڥ�<\n}�#R3Y�H�R�Iͳܦ;��Rl�1l�uB%TQJ�*���'�E�0i�dw,�z�ͥ:\$��;�?���j��)��)ԏ�\$32J}�&�[�\$��́�;Dn��E״�+0�aZ{���C ���(��:����O@h��D��\0��`PTou����F�\rQv����o�ܡ\$S��+��#7��Izr�pk�DW��Fs�9��Q� ���1�g��#�\0\\L�\$��3�g�X�y�y �-3h����!�nX��]+��	ɝ�c\0�\0�b��\0\r���-{�\0�Q(�Q�\$s�0���m(�[Ru�V����>��+�J[�6����J\0֗�\\���,��K�3�.�]a_\0R�J Ɨ`�^ԶClR�IK��\n�\$�nŏ���Kj��\n����~/��mn�].�`��ij��#K��f:`\0�錀6�7K▨zc��\0����/K���/�d���FE\0aL���dZ`�J�S��ʙ�2��4�@/�(��L��0�`�ĩ��_�L��]4Zh�Щ�SD�M��4:c��SR��M�E4�i��SG�EMj��4zd�թ�SFKL��%4�e��%\$�lKM2��1�ڔ�i����MV��.�ڔ�i����Lz�/���ۣӄ��M�,`�_��imS��gMƜ�jg�����5�9.��9j_��S���.��9�_���S���.�7�r�)��%�[2�m8�uT��S��3M:�]3�q���nӱ�KN�1|^�kt�\"��H�gKj�-;zc�i�Ӛ����\r<�_�-i�Ӹ��\"֞U.���i�RڑkOF��=:\\��\$Zө�MLE�5�x����ӻ_\"֜=<\0�t��S�9OҞ�1�~��i�����O��>�~q�)�F����=6:~���J���P:��=��T�)�ƫ��PJ8�@�w�����*��O�5]>��t���T\n��!\"��6Y	)��H�/P���3�	���/��P~���	�Ӯ�!\"��C����j� �eNJ������*%�4�1Q��CZ�Q�jTB�Q.�\rE)\0004��\$�2�SM+�<j�t�j0�,�9Q��}F\0\$�s��Ta��KΣ]Ecj*�'K�M��MGx��R�T1�#QꡥG��5�:�z�L��4u6z��\"j\"T�KuN֣�G�g\$jFSܨ�Q2��H��\"�MT��%R��Hz��\$�,�w�Re.\$r�z�)��Ԧ�-Q���J���ʪ@԰�=R&/�Iʕ1�*]T���7���Q��D&өqN�_(�q�c[Tw�QR�崜J�\0n��T���.��956c�܌�Sz�H���7�R�}�Sr8�N���\"b�T��Q�5MN���#����ES§-H��7\"�T��_S�}G�̕?*yԩ��S�P*�5#���܍�T:�]Pʟ�C*�ԉ�T:�-K8�5C����R�--MȾ�H��� �'T���H���H���ы�T���R���,���܋GTک-SJ��M*�ԩ�UTکmMH��M���>�gSD�5M�R���H�wU\"��K8��R���ڌ�U*�-U*��n¾T�IR�,t�Z���Y�IUF�51���W)v�k�_KƫpJ�5Zj�ů�R�4r\n�^jI�CK����}Uʓ_��ԛ��O�=N�R*�F-��R��%W���c��\\�aV>�EYj��d���ëUά�WX�5*�Ջ��Uy��Z��1k�ը�7V��R\\H�5h*�U���UƧM[���k�vո�3V�}[(�5W�zո�iB�O��1��T���V�;�[��pR�Gu�;T@0>\0��/I���W`�]��\0���8��P��]��1m*��ǍyUz�mW��|�ݓ[��֯�]J�ш��U������Z*�5\\j����Z��`Z�5~��E�W��4Z��5h�Q�^�cXZ��S��1o�V��U&��T��5}cU^��X��dm*���kUu��SfG=[��j�sտ��X�Kc\n�iR�H�i#��uWt��������X�cĹ��U���rڢ�UZ�Շ�NE���X���4��ud�E�eV^��K��n��V8�sX¥�f��/�hJ�-J]ӂ������zO��<Eh�\$勓���\0K��<bw��>���N�\")]b�	�+z�.cS.�iF�	���QNQ���V*������O[X�nx��P	k��oN��}<aO�Iߓ�h���T;�r񉉤�VD6Q�;z�]j�~'�:�[Iv��7^ʑ����j�w[������ņ�:u �Ds#���\\w�<n|*�h�m�Kv;Y҈��3�]��^#�Z�j�gy�jħY,�%;3������.�W\"��\$�3>gڜ���Ϧ�V�T�Zj�hY�j�kD*!�h&Xz�i���+GV��\"��Z�:Ҥ�+�NoG�Zjj�i�]ʞkO�_�֬ԐmjI����t��#�[�j\rn�����n��Z�_,���g�Ě�:���9����[L2�W=T��0��f�\0P�U6\ns%7isY�?��u�3���nb5�����X|G~l�&�k���M��������y�S��)�]�ܭr��ٸ�������?�}u'n0W-ι��b��Ǫ���k?�vQ�7��}p\n�����ٮZ*�9)��5ޕZW�-ZB���:��㫊W�\0WZfp�Gp���ٮ:�Fp����U��SN/��\\��%s9�S{� �8��Z�as�ۓ�+�N^��9�M�{�P5�� �Q���J���y����;����z����Y�V �3�:�D�I���+����19M;�������V���\rQ{��ծ���+��F�CLĹ�N���Ԉ�\\��)\$i���N'\0���P����]X�^�s1�f�&�\"'<O���̡�L\0�\"�@���%�6��UA�1�i(z��݁�\r�Ղ��bZ��+IQO�3���\r=*ĉ��)�!����`��h��,ЫmGPC��A��ٲ�A��(ZŰ%�t�,h/���i��k���XEJ6�ID�Ȭ\"�\n�aU- ��\nv�y��_���ګ�k	a�B<�V�D�/P���a��)9L�(Z��8�vvù�k	�o�ZXk���|�&�.�東C�����`�1�]7&ę+�H�CBcX�B7xX�|1��0��a�6��ubpJLǅ�(���mbl�8I�*R��@tk0�����xX���;�� al]4s�t��Ū�0�c�'��l�`8M�8����D4w`p?@706g̈~K�\r�� �P���bh�\"&��\n�q�PD����\$�(�0QP<�����Q�!X��x��5���R�`w/2�2#���� `���1�/�܁\r���:²����B7�V7Z��gMY�H3� ��b�	Z��J���G�w�gl�^�-�R-!�l�7̲L��ư<1 �QC/ղh��)�W�6C	�*d��6]VK!m����05G\$�R��4��=Cw&[��YP��dɚ�')VK,�5e�\r���K+�1�X)b�e)��uF2A#E�&g~�e�y�fp5�lYl�Ԝ5�����\n�m}`�(�M �Pl9Y��f����]�Vl-4�é����>`��/��fPE�i�\0k�v�\0�fhS0�&�¦lͼ�#fu���5	i%�:Fd��9��؀G<�	{�}��s[7\0�Ξ3�ft:+.Ȕ�p�>�ձ�@!Pas6q,���1bǬŋ�ZK���-��ar`�?RxX�鑡�V���#Ĥ�z�; �D���H��1��6D`��Y�`�R�P֋>-�!\$�����~π���`>���h�0�1����&\0�h���I�wl�Z�\$�\\\r��8�~,�\n�o_��B2D����a1��ǩ�=�v<�kF�p`�`�kBF�6� ����h��T T֎�	�@?dr�剀J�H@1�G�dn��w���%��JG��0b�Tf]m(�k�qg\\���������ш3vk'�^d��AX��~�W�Vs�*�ʱ�d��M����@?���}�6\\��m9<��i�ݧ��Ԭh�^s}�-�[K�s�q�b��-��OORm8\$�yw��##��@❷\0��ؤ 5F7����X\n��|J�/-S�W!f�� 0�,w��D4١RU�T������ZX�=�`�W\$@�ԥ(�XG��Ҋ��a>�*�Y���\n��\n��!�[mj���0,mu�W@ FX������=��(���b��<!\n\"��83�'��(R��\n>��@�W�r!L�H�k�\r�E\nW��\r��'FH�\$�����m���=�ۥ{LY��&���_\0����#�䔀[�9\0�\"��@8�iK���0�l���p\ng��'qbF��y�c�l@9�(#JU�ݲ�{io���.{�ͳ4�V́�VnF�x���z� Q�ޞ\$kSa~ʨ0s@���%�y@��5H��N�ͦ�@�x�#	ܫ /\\��?<hڂ���I�T��:�3�\n%��");}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0!�����M��*)�o��) q��e���#��L�\0;";break;case"cross.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0#�����#\na�Fo~y�.�_wa��1�J�G�L�6]\0\0;";break;case"up.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0 �����MQN\n�}��a8�y�aŶ�\0��\0;";break;case"down.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0 �����M��*)�[W�\\��L&ٜƶ�\0��\0;";break;case"arrow.gif":echo"GIF89a\0\n\0�\0\0������!�\0\0\0,\0\0\0\0\0\n\0\0�i������Ӳ޻\0\0;";break;}}exit;}if($_GET["script"]=="version"){$hd=file_open_lock(get_temp_dir()."/adminer.version");if($hd)file_write_unlock($hd,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$g,$m,$dc,$lc,$vc,$n,$jd,$pd,$ba,$Od,$x,$ca,$je,$kf,$Vf,$Ah,$ud,$hi,$ni,$wi,$Ci,$ia;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$ba=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$If=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$ba);if(version_compare(PHP_VERSION,'5.2.0')>=0)$If[]=true;call_user_func_array('session_set_cookie_params',$If);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$Uc);if(get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);function
get_lang(){return'en';}function
lang($mi,$bf=null){if(is_array($mi)){$Yf=($bf==1?0:1);$mi=$mi[$Yf];}$mi=str_replace("%d","%s",$mi);$bf=format_number($bf);return
sprintf($mi,$bf);}if(extension_loaded('pdo')){class
Min_PDO
extends
PDO{var$_result,$server_info,$affected_rows,$errno,$error;function
__construct(){global$b;$Yf=array_search("SQL",$b->operators);if($Yf!==false)unset($b->operators[$Yf]);}function
dsn($ic,$V,$F,$sf=array()){try{parent::__construct($ic,$V,$F,$sf);}catch(Exception$_c){auth_error(h($_c->getMessage()));}$this->setAttribute(13,array('Min_PDOStatement'));$this->server_info=@$this->getAttribute(4);}function
query($G,$xi=false){$H=parent::query($G);$this->error="";if(!$H){list(,$this->errno,$this->error)=$this->errorInfo();if(!$this->error)$this->error='Unknown error.';return
false;}$this->store_result($H);return$H;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result($H=null){if(!$H){$H=$this->_result;if(!$H)return
false;}if($H->columnCount()){$H->num_rows=$H->rowCount();return$H;}$this->affected_rows=$H->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($G,$o=0){$H=$this->query($G);if(!$H)return
false;$J=$H->fetch();return$J[$o];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$J=(object)$this->getColumnMeta($this->_offset++);$J->orgtable=$J->table;$J->orgname=$J->name;$J->charsetnr=(in_array("blob",(array)$J->flags)?63:0);return$J;}}}$dc=array();class
Min_SQL{var$_conn;function
__construct($g){$this->_conn=$g;}function
select($R,$L,$Z,$md,$uf=array(),$z=1,$E=0,$gg=false){global$b,$x;$Vd=(count($md)<count($L));$G=$b->selectQueryBuild($L,$Z,$md,$uf,$z,$E);if(!$G)$G="SELECT".limit(($_GET["page"]!="last"&&$z!=""&&$md&&$Vd&&$x=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$L)."\nFROM ".table($R),($Z?"\nWHERE ".implode(" AND ",$Z):"").($md&&$Vd?"\nGROUP BY ".implode(", ",$md):"").($uf?"\nORDER BY ".implode(", ",$uf):""),($z!=""?+$z:null),($E?$z*$E:0),"\n");$xh=microtime(true);$I=$this->_conn->query($G);if($gg)echo$b->selectQuery($G,$xh,!$I);return$I;}function
delete($R,$qg,$z=0){$G="FROM ".table($R);return
queries("DELETE".($z?limit1($R,$G,$qg):" $G$qg"));}function
update($R,$O,$qg,$z=0,$M="\n"){$Oi=array();foreach($O
as$y=>$X)$Oi[]="$y = $X";$G=table($R)." SET$M".implode(",$M",$Oi);return
queries("UPDATE".($z?limit1($R,$G,$qg,$M):" $G$qg"));}function
insert($R,$O){return
queries("INSERT INTO ".table($R).($O?" (".implode(", ",array_keys($O)).")\nVALUES (".implode(", ",$O).")":" DEFAULT VALUES"));}function
insertUpdate($R,$K,$eg){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($G,$Yh){}function
convertSearch($u,$X,$o){return$u;}function
value($X,$o){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$o):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($Sg){return
q($Sg);}function
warnings(){return'';}function
tableHelp($C){}}$dc["sqlite"]="SQLite 3";$dc["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){$bg=array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite");define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($Tc){$this->_link=new
SQLite3($Tc);$Ri=$this->_link->version();$this->server_info=$Ri["versionString"];}function
query($G){$H=@$this->_link->query($G);$this->error="";if(!$H){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($H->numColumns())return
new
Min_Result($H);$this->affected_rows=$this->_link->changes();return
true;}function
quote($Q){return(is_utf8($Q)?"'".$this->_link->escapeString($Q)."'":"x'".reset(unpack('H*',$Q))."'");}function
store_result(){return$this->_result;}function
result($G,$o=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->_result->fetchArray();return$J[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$e=$this->_offset++;$U=$this->_result->columnType($e);return(object)array("name"=>$this->_result->columnName($e),"type"=>$U,"charsetnr"=>($U==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($Tc){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($Tc);}function
query($G,$xi=false){$Ne=($xi?"unbufferedQuery":"query");$H=@$this->_link->$Ne($G,SQLITE_BOTH,$n);$this->error="";if(!$H){$this->error=$n;return
false;}elseif($H===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($H);}function
quote($Q){return"'".sqlite_escape_string($Q)."'";}function
store_result(){return$this->_result;}function
result($G,$o=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->_result->fetch();return$J[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;if(method_exists($H,'numRows'))$this->num_rows=$H->numRows();}function
fetch_assoc(){$J=$this->_result->fetch(SQLITE_ASSOC);if(!$J)return
false;$I=array();foreach($J
as$y=>$X)$I[($y[0]=='"'?idf_unescape($y):$y)]=$X;return$I;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$C=$this->_result->fieldName($this->_offset++);$Uf='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Uf\\.)?$Uf\$~",$C,$B)){$R=($B[3]!=""?$B[3]:idf_unescape($B[2]));$C=($B[5]!=""?$B[5]:idf_unescape($B[4]));}return(object)array("name"=>$C,"orgname"=>$C,"orgtable"=>$R,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($Tc){$this->dsn(DRIVER.":$Tc","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($Tc){if(is_readable($Tc)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$Tc)?$Tc:dirname($_SERVER["SCRIPT_FILENAME"])."/$Tc")." AS a")){parent::__construct($Tc);$this->query("PRAGMA foreign_keys = 1");return
true;}return
false;}function
multi_query($G){return$this->_result=$this->query($G);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$K,$eg){$Oi=array();foreach($K
as$O)$Oi[]="(".implode(", ",$O).")";return
queries("REPLACE INTO ".table($R)." (".implode(", ",array_keys(reset($K))).") VALUES\n".implode(",\n",$Oi));}function
tableHelp($C){if($C=="sqlite_sequence")return"fileformat2.html#seqtab";if($C=="sqlite_master")return"fileformat2.html#$C";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;list(,,$F)=$b->credentials();if($F!="")return'Database does not support password.';return
new
Min_DB;}function
get_databases(){return
array();}function
limit($G,$Z,$z,$D=0,$M=" "){return" $G$Z".($z!==null?$M."LIMIT $z".($D?" OFFSET $D":""):"");}function
limit1($R,$G,$Z,$M="\n"){global$g;return(preg_match('~^INTO~',$G)||$g->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($G,$Z,1,0,$M):" $G WHERE rowid = (SELECT rowid FROM ".table($R).$Z.$M."LIMIT 1)");}function
db_collation($l,$ob){global$g;return$g->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($k){return
array();}function
table_status($C=""){global$g;$I=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$J){$J["Rows"]=$g->result("SELECT COUNT(*) FROM ".idf_escape($J["Name"]));$I[$J["Name"]]=$J;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$J)$I[$J["name"]]["Auto_increment"]=$J["seq"];return($C!=""?$I[$C]:$I);}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){global$g;return!$g->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($R){global$g;$I=array();$eg="";foreach(get_rows("PRAGMA table_info(".table($R).")")as$J){$C=$J["name"];$U=strtolower($J["type"]);$Rb=$J["dflt_value"];$I[$C]=array("field"=>$C,"type"=>(preg_match('~int~i',$U)?"integer":(preg_match('~char|clob|text~i',$U)?"text":(preg_match('~blob~i',$U)?"blob":(preg_match('~real|floa|doub~i',$U)?"real":"numeric")))),"full_type"=>$U,"default"=>(preg_match("~'(.*)'~",$Rb,$B)?str_replace("''","'",$B[1]):($Rb=="NULL"?null:$Rb)),"null"=>!$J["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$J["pk"],);if($J["pk"]){if($eg!="")$I[$eg]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$U))$I[$C]["auto_increment"]=true;$eg=$C;}}$sh=$g->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$sh,$_e,PREG_SET_ORDER);foreach($_e
as$B){$C=str_replace('""','"',preg_replace('~^"|"$~','',$B[1]));if($I[$C])$I[$C]["collation"]=trim($B[3],"'");}return$I;}function
indexes($R,$h=null){global$g;if(!is_object($h))$h=$g;$I=array();$sh=$h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$sh,$B)){$I[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$B[1],$_e,PREG_SET_ORDER);foreach($_e
as$B){$I[""]["columns"][]=idf_unescape($B[2]).$B[4];$I[""]["descs"][]=(preg_match('~DESC~i',$B[5])?'1':null);}}if(!$I){foreach(fields($R)as$C=>$o){if($o["primary"])$I[""]=array("type"=>"PRIMARY","columns"=>array($C),"lengths"=>array(),"descs"=>array(null));}}$vh=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($R),$h);foreach(get_rows("PRAGMA index_list(".table($R).")",$h)as$J){$C=$J["name"];$v=array("type"=>($J["unique"]?"UNIQUE":"INDEX"));$v["lengths"]=array();$v["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($C).")",$h)as$Rg){$v["columns"][]=$Rg["name"];$v["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($C).' ON '.idf_escape($R),'~').' \((.*)\)$~i',$vh[$C],$Bg)){preg_match_all('/("[^"]*+")+( DESC)?/',$Bg[2],$_e);foreach($_e[2]as$y=>$X){if($X)$v["descs"][$y]='1';}}if(!$I[""]||$v["type"]!="UNIQUE"||$v["columns"]!=$I[""]["columns"]||$v["descs"]!=$I[""]["descs"]||!preg_match("~^sqlite_~",$C))$I[$C]=$v;}return$I;}function
foreign_keys($R){$I=array();foreach(get_rows("PRAGMA foreign_key_list(".table($R).")")as$J){$q=&$I[$J["id"]];if(!$q)$q=$J;$q["source"][]=$J["from"];$q["target"][]=$J["to"];}return$I;}function
view($C){global$g;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$g->result("SELECT sql FROM sqlite_master WHERE name = ".q($C))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
check_sqlite_name($C){global$g;$Jc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($Jc)\$~",$C)){$g->error=sprintf('Please use one of the extensions %s.',str_replace("|",", ",$Jc));return
false;}return
true;}function
create_database($l,$d){global$g;if(file_exists($l)){$g->error='File exists.';return
false;}if(!check_sqlite_name($l))return
false;try{$_=new
Min_SQLite($l);}catch(Exception$_c){$g->error=$_c->getMessage();return
false;}$_->query('PRAGMA encoding = "UTF-8"');$_->query('CREATE TABLE adminer (i)');$_->query('DROP TABLE adminer');return
true;}function
drop_databases($k){global$g;$g->__construct(":memory:");foreach($k
as$l){if(!@unlink($l)){$g->error='File exists.';return
false;}}return
true;}function
rename_database($C,$d){global$g;if(!check_sqlite_name($C))return
false;$g->__construct(":memory:");$g->error='File exists.';return@rename(DB,$C);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($R,$C,$p,$bd,$tb,$tc,$d,$La,$Of){$Ii=($R==""||$bd);foreach($p
as$o){if($o[0]!=""||!$o[1]||$o[2]){$Ii=true;break;}}$c=array();$Cf=array();foreach($p
as$o){if($o[1]){$c[]=($Ii?$o[1]:"ADD ".implode($o[1]));if($o[0]!="")$Cf[$o[0]]=$o[1][0];}}if(!$Ii){foreach($c
as$X){if(!queries("ALTER TABLE ".table($R)." $X"))return
false;}if($R!=$C&&!queries("ALTER TABLE ".table($R)." RENAME TO ".table($C)))return
false;}elseif(!recreate_table($R,$C,$c,$Cf,$bd))return
false;if($La)queries("UPDATE sqlite_sequence SET seq = $La WHERE name = ".q($C));return
true;}function
recreate_table($R,$C,$p,$Cf,$bd,$w=array()){if($R!=""){if(!$p){foreach(fields($R)as$y=>$o){if($w)$o["auto_increment"]=0;$p[]=process_field($o,$o);$Cf[$y]=idf_escape($y);}}$fg=false;foreach($p
as$o){if($o[6])$fg=true;}$gc=array();foreach($w
as$y=>$X){if($X[2]=="DROP"){$gc[$X[1]]=true;unset($w[$y]);}}foreach(indexes($R)as$de=>$v){$f=array();foreach($v["columns"]as$y=>$e){if(!$Cf[$e])continue
2;$f[]=$Cf[$e].($v["descs"][$y]?" DESC":"");}if(!$gc[$de]){if($v["type"]!="PRIMARY"||!$fg)$w[]=array($v["type"],$de,$f);}}foreach($w
as$y=>$X){if($X[0]=="PRIMARY"){unset($w[$y]);$bd[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($R)as$de=>$q){foreach($q["source"]as$y=>$e){if(!$Cf[$e])continue
2;$q["source"][$y]=idf_unescape($Cf[$e]);}if(!isset($bd[" $de"]))$bd[]=" ".format_foreign_key($q);}queries("BEGIN");}foreach($p
as$y=>$o)$p[$y]="  ".implode($o);$p=array_merge($p,array_filter($bd));if(!queries("CREATE TABLE ".table($R!=""?"adminer_$C":$C)." (\n".implode(",\n",$p)."\n)"))return
false;if($R!=""){if($Cf&&!queries("INSERT INTO ".table("adminer_$C")." (".implode(", ",$Cf).") SELECT ".implode(", ",array_map('idf_escape',array_keys($Cf)))." FROM ".table($R)))return
false;$ti=array();foreach(triggers($R)as$ri=>$Zh){$qi=trigger($ri);$ti[]="CREATE TRIGGER ".idf_escape($ri)." ".implode(" ",$Zh)." ON ".table($C)."\n$qi[Statement]";}if(!queries("DROP TABLE ".table($R)))return
false;queries("ALTER TABLE ".table("adminer_$C")." RENAME TO ".table($C));if(!alter_indexes($C,$w))return
false;foreach($ti
as$qi){if(!queries($qi))return
false;}queries("COMMIT");}return
true;}function
index_sql($R,$U,$C,$f){return"CREATE $U ".($U!="INDEX"?"INDEX ":"").idf_escape($C!=""?$C:uniqid($R."_"))." ON ".table($R)." $f";}function
alter_indexes($R,$c){foreach($c
as$eg){if($eg[0]=="PRIMARY")return
recreate_table($R,$R,array(),array(),array(),$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($R,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($T){return
apply_queries("DELETE FROM",$T);}function
drop_views($Ti){return
apply_queries("DROP VIEW",$Ti);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
move_tables($T,$Ti,$Qh){return
false;}function
trigger($C){global$g;if($C=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$u='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$si=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$u\\s*(".implode("|",$si["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($u))?\\s+ON\\s*$u\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$g->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($C)),$B);$df=$B[3];return
array("Timing"=>strtoupper($B[1]),"Event"=>strtoupper($B[2]).($df?" OF":""),"Of"=>($df[0]=='`'||$df[0]=='"'?idf_unescape($df):$df),"Trigger"=>$C,"Statement"=>$B[4],);}function
triggers($R){$I=array();$si=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R))as$J){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$si["Timing"]).')\s*(.*)\s+ON\b~iU',$J["sql"],$B);$I[$J["name"]]=array($B[1],$B[2]);}return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ROWID()");}function
explain($g,$G){return$g->query("EXPLAIN QUERY PLAN $G");}function
found_rows($S,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Vg){return
true;}function
create_sql($R,$La,$Bh){global$g;$I=$g->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($R));foreach(indexes($R)as$C=>$v){if($C=='')continue;$I.=";\n\n".index_sql($R,$v['type'],$C,"(".implode(", ",array_map('idf_escape',$v['columns'])).")");}return$I;}function
truncate_sql($R){return"DELETE FROM ".table($R);}function
use_sql($j){}function
trigger_sql($R){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R)));}function
show_variables(){global$g;$I=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$y)$I[$y]=$g->result("PRAGMA $y");return$I;}function
show_status(){$I=array();foreach(get_vals("PRAGMA compile_options")as$rf){list($y,$X)=explode("=",$rf,2);$I[$y]=$X;}return$I;}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
support($Oc){return
preg_match('~^(columns|database|drop_col|dump|indexes|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$Oc);}$x="sqlite";$wi=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);$Ah=array_keys($wi);$Ci=array();$pf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$jd=array("hex","length","lower","round","unixepoch","upper");$pd=array("avg","count","count distinct","group_concat","max","min","sum");$lc=array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",));}$dc["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){$bg=array("PgSQL","PDO_PgSQL");define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($wc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($N,$V,$F){global$b;$l=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($N,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($F,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$l!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Ri=pg_version($this->_link);$this->server_info=$Ri["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($Q){return"'".pg_escape_string($this->_link,$Q)."'";}function
value($X,$o){return($o["type"]=="bytea"?pg_unescape_bytea($X):$X);}function
quoteBinary($Q){return"'".pg_escape_bytea($this->_link,$Q)."'";}function
select_db($j){global$b;if($j==$b->database())return$this->_database;$I=@pg_connect("$this->_string dbname='".addcslashes($j,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($I)$this->_link=$I;return$I;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($G,$xi=false){$H=@pg_query($this->_link,$G);$this->error="";if(!$H){$this->error=pg_last_error($this->_link);$I=false;}elseif(!pg_num_fields($H)){$this->affected_rows=pg_affected_rows($H);$I=true;}else$I=new
Min_Result($H);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$o=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;return
pg_fetch_result($H->_result,0,$o);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;$this->num_rows=pg_num_rows($H);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$e=$this->_offset++;$I=new
stdClass;if(function_exists('pg_field_table'))$I->orgtable=pg_field_table($this->_result,$e);$I->name=pg_field_name($this->_result,$e);$I->orgname=$I->name;$I->type=pg_field_type($this->_result,$e);$I->charsetnr=($I->type=="bytea"?63:0);return$I;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($N,$V,$F){global$b;$l=$b->database();$Q="pgsql:host='".str_replace(":","' port='",addcslashes($N,"'\\"))."' options='-c client_encoding=utf8'";$this->dsn("$Q dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",$V,$F);return
true;}function
select_db($j){global$b;return($b->database()==$j);}function
quoteBinary($Sg){return
q($Sg);}function
query($G,$xi=false){$I=parent::query($G,$xi);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$I;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$K,$eg){global$g;foreach($K
as$O){$Di=array();$Z=array();foreach($O
as$y=>$X){$Di[]="$y = $X";if(isset($eg[idf_unescape($y)]))$Z[]="$y = $X";}if(!(($Z&&queries("UPDATE ".table($R)." SET ".implode(", ",$Di)." WHERE ".implode(" AND ",$Z))&&$g->affected_rows)||queries("INSERT INTO ".table($R)." (".implode(", ",array_keys($O)).") VALUES (".implode(", ",$O).")")))return
false;}return
true;}function
slowQuery($G,$Yh){$this->_conn->query("SET statement_timeout = ".(1000*$Yh));$this->_conn->timeout=1000*$Yh;return$G;}function
convertSearch($u,$X,$o){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$o["type"])?$u:"CAST($u AS text)");}function
quoteBinary($Sg){return$this->_conn->quoteBinary($Sg);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($C){$te=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$_=$te[$_GET["ns"]];if($_)return"$_-".str_replace("_","-",$C).".html";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b,$wi,$Ah;$g=new
Min_DB;$Fb=$b->credentials();if($g->connect($Fb[0],$Fb[1],$Fb[2])){if(min_version(9,0,$g)){$g->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$g)){$Ah['Strings'][]="json";$wi["json"]=4294967295;if(min_version(9.4,0,$g)){$Ah['Strings'][]="jsonb";$wi["jsonb"]=4294967295;}}}return$g;}return$g->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($G,$Z,$z,$D=0,$M=" "){return" $G$Z".($z!==null?$M."LIMIT $z".($D?" OFFSET $D":""):"");}function
limit1($R,$G,$Z,$M="\n"){return(preg_match('~^INTO~',$G)?limit($G,$Z,1,0,$M):" $G".(is_view(table_status1($R))?$Z:" WHERE ctid = (SELECT ctid FROM ".table($R).$Z.$M."LIMIT 1)"));}function
db_collation($l,$ob){global$g;return$g->result("SHOW LC_COLLATE");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT user");}function
tables_list(){$G="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$G.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$G.="
ORDER BY 1";return
get_key_vals($G);}function
count_tables($k){return
array();}function
table_status($C=""){$I=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", CASE WHEN c.relhasoids THEN 'oid' ELSE '' END AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f')
".($C!=""?"AND relname = ".q($C):"ORDER BY relname"))as$J)$I[$J["Name"]]=$J;return($C!=""?$I[$C]:$I);}function
is_view($S){return
in_array($S["Engine"],array("view","materialized view"));}function
fk_support($S){return
true;}function
fields($R){$I=array();$Ca=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, d.adsrc AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($R)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$J){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$J["full_type"],$B);list(,$U,$qe,$J["length"],$wa,$Fa)=$B;$J["length"].=$Fa;$db=$U.$wa;if(isset($Ca[$db])){$J["type"]=$Ca[$db];$J["full_type"]=$J["type"].$qe.$Fa;}else{$J["type"]=$U;$J["full_type"]=$J["type"].$qe.$wa.$Fa;}$J["null"]=!$J["attnotnull"];$J["auto_increment"]=preg_match('~^nextval\(~i',$J["default"]);$J["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^)]+(.*)~',$J["default"],$B))$J["default"]=($B[1]=="NULL"?null:(($B[1][0]=="'"?idf_unescape($B[1]):$B[1]).$B[2]));$I[$J["field"]]=$J;}return$I;}function
indexes($R,$h=null){global$g;if(!is_object($h))$h=$g;$I=array();$Jh=$h->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($R));$f=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Jh AND attnum > 0",$h);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption , (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Jh AND ci.oid = i.indexrelid",$h)as$J){$Cg=$J["relname"];$I[$Cg]["type"]=($J["indispartial"]?"INDEX":($J["indisprimary"]?"PRIMARY":($J["indisunique"]?"UNIQUE":"INDEX")));$I[$Cg]["columns"]=array();foreach(explode(" ",$J["indkey"])as$Kd)$I[$Cg]["columns"][]=$f[$Kd];$I[$Cg]["descs"]=array();foreach(explode(" ",$J["indoption"])as$Ld)$I[$Cg]["descs"][]=($Ld&1?'1':null);$I[$Cg]["lengths"]=array();}return$I;}function
foreign_keys($R){global$kf;$I=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($R)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$J){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$J['definition'],$B)){$J['source']=array_map('trim',explode(',',$B[1]));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$B[2],$ze)){$J['ns']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$ze[2]));$J['table']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$ze[4]));}$J['target']=array_map('trim',explode(',',$B[3]));$J['on_delete']=(preg_match("~ON DELETE ($kf)~",$B[4],$ze)?$ze[1]:'NO ACTION');$J['on_update']=(preg_match("~ON UPDATE ($kf)~",$B[4],$ze)?$ze[1]:'NO ACTION');$I[$J['conname']]=$J;}}return$I;}function
view($C){global$g;return
array("select"=>trim($g->result("SELECT view_definition
FROM information_schema.views
WHERE table_schema = current_schema() AND table_name = ".q($C))));}function
collations(){return
array();}function
information_schema($l){return($l=="information_schema");}function
error(){global$g;$I=h($g->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$I,$B))$I=$B[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($B[3]).'})(.*)~','\1<b>\2</b>',$B[2]).$B[4];return
nl_br($I);}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" ENCODING ".idf_escape($d):""));}function
drop_databases($k){global$g;$g->close();return
apply_queries("DROP DATABASE",$k,'idf_escape');}function
rename_database($C,$d){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($C));}function
auto_increment(){return"";}function
alter_table($R,$C,$p,$bd,$tb,$tc,$d,$La,$Of){$c=array();$pg=array();foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c[]="DROP $e";else{$Ni=$X[5];unset($X[5]);if(isset($X[6])&&$o[0]=="")$X[1]=($X[1]=="bigint"?" big":" ")."serial";if($o[0]=="")$c[]=($R!=""?"ADD ":"  ").implode($X);else{if($e!=$X[0])$pg[]="ALTER TABLE ".table($R)." RENAME $e TO $X[0]";$c[]="ALTER $e TYPE$X[1]";if(!$X[6]){$c[]="ALTER $e ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $e ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($o[0]!=""||$Ni!="")$pg[]="COMMENT ON COLUMN ".table($R).".$X[0] IS ".($Ni!=""?substr($Ni,9):"''");}}$c=array_merge($c,$bd);if($R=="")array_unshift($pg,"CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($pg,"ALTER TABLE ".table($R)."\n".implode(",\n",$c));if($R!=""&&$R!=$C)$pg[]="ALTER TABLE ".table($R)." RENAME TO ".table($C);if($R!=""||$tb!="")$pg[]="COMMENT ON TABLE ".table($C)." IS ".q($tb);if($La!=""){}foreach($pg
as$G){if(!queries($G))return
false;}return
true;}function
alter_indexes($R,$c){$i=array();$ec=array();$pg=array();foreach($c
as$X){if($X[0]!="INDEX")$i[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$ec[]=idf_escape($X[1]);else$pg[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R)." (".implode(", ",$X[2]).")";}if($i)array_unshift($pg,"ALTER TABLE ".table($R).implode(",",$i));if($ec)array_unshift($pg,"DROP INDEX ".implode(", ",$ec));foreach($pg
as$G){if(!queries($G))return
false;}return
true;}function
truncate_tables($T){return
queries("TRUNCATE ".implode(", ",array_map('table',$T)));return
true;}function
drop_views($Ti){return
drop_tables($Ti);}function
drop_tables($T){foreach($T
as$R){$P=table_status($R);if(!queries("DROP ".strtoupper($P["Engine"])." ".table($R)))return
false;}return
true;}function
move_tables($T,$Ti,$Qh){foreach(array_merge($T,$Ti)as$R){$P=table_status($R);if(!queries("ALTER ".strtoupper($P["Engine"])." ".table($R)." SET SCHEMA ".idf_escape($Qh)))return
false;}return
true;}function
trigger($C,$R=null){if($C=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");if($R===null)$R=$_GET['trigger'];$K=get_rows('SELECT t.trigger_name AS "Trigger", t.action_timing AS "Timing", (SELECT STRING_AGG(event_manipulation, \' OR \') FROM information_schema.triggers WHERE event_object_table = t.event_object_table AND trigger_name = t.trigger_name ) AS "Events", t.event_manipulation AS "Event", \'FOR EACH \' || t.action_orientation AS "Type", t.action_statement AS "Statement" FROM information_schema.triggers t WHERE t.event_object_table = '.q($R).' AND t.trigger_name = '.q($C));return
reset($K);}function
triggers($R){$I=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE event_object_table = ".q($R))as$J)$I[$J["trigger_name"]]=array($J["action_timing"],$J["event_manipulation"]);return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($C,$U){$K=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($C));$I=$K[0];$I["returns"]=array("type"=>$I["type_udt_name"]);$I["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($C).'
ORDER BY ordinal_position');return$I;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($C,$J){$I=array();foreach($J["fields"]as$o)$I[]=$o["type"];return
idf_escape($C)."(".implode(", ",$I).")";}function
last_id(){return
0;}function
explain($g,$G){return$g->query("EXPLAIN $G");}function
found_rows($S,$Z){global$g;if(preg_match("~ rows=([0-9]+)~",$g->result("EXPLAIN SELECT * FROM ".idf_escape($S["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Bg))return$Bg[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$g;return$g->result("SELECT current_schema()");}function
set_schema($Ug){global$g,$wi,$Ah;$I=$g->query("SET search_path TO ".idf_escape($Ug));foreach(types()as$U){if(!isset($wi[$U])){$wi[$U]=0;$Ah['User types'][]=$U;}}return$I;}function
create_sql($R,$La,$Bh){global$g;$I='';$Kg=array();$eh=array();$P=table_status($R);$p=fields($R);$w=indexes($R);ksort($w);$Yc=foreign_keys($R);ksort($Yc);if(!$P||empty($p))return
false;$I="CREATE TABLE ".idf_escape($P['nspname']).".".idf_escape($P['Name'])." (\n    ";foreach($p
as$Qc=>$o){$Lf=idf_escape($o['field']).' '.$o['full_type'].default_value($o).($o['attnotnull']?" NOT NULL":"");$Kg[]=$Lf;if(preg_match('~nextval\(\'([^\']+)\'\)~',$o['default'],$_e)){$dh=$_e[1];$rh=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($dh):"SELECT * FROM $dh"));$eh[]=($Bh=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $dh;\n":"")."CREATE SEQUENCE $dh INCREMENT $rh[increment_by] MINVALUE $rh[min_value] MAXVALUE $rh[max_value] START ".($La?$rh['last_value']:1)." CACHE $rh[cache_value];";}}if(!empty($eh))$I=implode("\n\n",$eh)."\n\n$I";foreach($w
as$Fd=>$v){switch($v['type']){case'UNIQUE':$Kg[]="CONSTRAINT ".idf_escape($Fd)." UNIQUE (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;case'PRIMARY':$Kg[]="CONSTRAINT ".idf_escape($Fd)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;}}foreach($Yc
as$Xc=>$Wc)$Kg[]="CONSTRAINT ".idf_escape($Xc)." $Wc[definition] ".($Wc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE');$I.=implode(",\n    ",$Kg)."\n) WITH (oids = ".($P['Oid']?'true':'false').");";foreach($w
as$Fd=>$v){if($v['type']=='INDEX')$I.="\n\nCREATE INDEX ".idf_escape($Fd)." ON ".idf_escape($P['nspname']).".".idf_escape($P['Name'])." USING btree (".implode(', ',array_map('idf_escape',$v['columns'])).");";}if($P['Comment'])$I.="\n\nCOMMENT ON TABLE ".idf_escape($P['nspname']).".".idf_escape($P['Name'])." IS ".q($P['Comment']).";";foreach($p
as$Qc=>$o){if($o['comment'])$I.="\n\nCOMMENT ON COLUMN ".idf_escape($P['nspname']).".".idf_escape($P['Name']).".".idf_escape($Qc)." IS ".q($o['comment']).";";}return
rtrim($I,';');}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
trigger_sql($R){$P=table_status($R);$I="";foreach(triggers($R)as$pi=>$oi){$qi=trigger($pi,$P['Name']);$I.="\nCREATE TRIGGER ".idf_escape($qi['Trigger'])." $qi[Timing] $qi[Events] ON ".idf_escape($P["nspname"]).".".idf_escape($P['Name'])." $qi[Type] $qi[Statement];;\n";}return$I;}function
use_sql($j){return"\connect ".idf_escape($j);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
support($Oc){return
preg_match('~^(database|table|columns|sql|indexes|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$Oc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$g;return$g->result("SHOW max_connections");}$x="pgsql";$wi=array();$Ah=array();foreach(array('Numbers'=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),'Date and time'=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),'Strings'=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),'Binary'=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),'Network'=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),'Geometry'=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$y=>$X){$wi+=$X;$Ah[$y]=array_keys($X);}$Ci=array();$pf=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$jd=array("char_length","lower","round","to_hex","to_timestamp","upper");$pd=array("avg","count","count distinct","max","min","sum");$lc=array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",));}$dc["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){$bg=array("OCI8","PDO_OCI");define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_error($wc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($N,$V,$F){$this->_link=@oci_new_connect($V,$F,$N,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$n=oci_error();$this->error=$n["message"];return
false;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($j){return
true;}function
query($G,$xi=false){$H=oci_parse($this->_link,$G);$this->error="";if(!$H){$n=oci_error($this->_link);$this->errno=$n["code"];$this->error=$n["message"];return
false;}set_error_handler(array($this,'_error'));$I=@oci_execute($H);restore_error_handler();if($I){if(oci_num_fields($H))return
new
Min_Result($H);$this->affected_rows=oci_num_rows($H);}return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$o=1){$H=$this->query($G);if(!is_object($H)||!oci_fetch($H->_result))return
false;return
oci_result($H->_result,$o);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($H){$this->_result=$H;}function
_convert($J){foreach((array)$J
as$y=>$X){if(is_a($X,'OCI-Lob'))$J[$y]=$X->load();}return$J;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$e=$this->_offset++;$I=new
stdClass;$I->name=oci_field_name($this->_result,$e);$I->orgname=$I->name;$I->type=oci_field_type($this->_result,$e);$I->charsetnr=(preg_match("~raw|blob|bfile~",$I->type)?63:0);return$I;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";function
connect($N,$V,$F){$this->dsn("oci:dbname=//$N;charset=AL32UTF8",$V,$F);return
true;}function
select_db($j){return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Fb=$b->credentials();if($g->connect($Fb[0],$Fb[1],$Fb[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces");}function
limit($G,$Z,$z,$D=0,$M=" "){return($D?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $G$Z) t WHERE rownum <= ".($z+$D).") WHERE rnum > $D":($z!==null?" * FROM (SELECT $G$Z) WHERE rownum <= ".($z+$D):" $G$Z"));}function
limit1($R,$G,$Z,$M="\n"){return" $G$Z";}function
db_collation($l,$ob){global$g;return$g->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT USER FROM DUAL");}function
tables_list(){return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."
UNION SELECT view_name, 'view' FROM user_views
ORDER BY 1");}function
count_tables($k){return
array();}function
table_status($C=""){$I=array();$Wg=q($C);foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q(DB).($C!=""?" AND table_name = $Wg":"")."
UNION SELECT view_name, 'view', 0, 0 FROM user_views".($C!=""?" WHERE view_name = $Wg":"")."
ORDER BY 1")as$J){if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){return
true;}function
fields($R){$I=array();foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($R)." ORDER BY column_id")as$J){$U=$J["DATA_TYPE"];$qe="$J[DATA_PRECISION],$J[DATA_SCALE]";if($qe==",")$qe=$J["DATA_LENGTH"];$I[$J["COLUMN_NAME"]]=array("field"=>$J["COLUMN_NAME"],"full_type"=>$U.($qe?"($qe)":""),"type"=>strtolower($U),"length"=>$qe,"default"=>$J["DATA_DEFAULT"],"null"=>($J["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$I;}function
indexes($R,$h=null){$I=array();foreach(get_rows("SELECT uic.*, uc.constraint_type
FROM user_ind_columns uic
LEFT JOIN user_constraints uc ON uic.index_name = uc.constraint_name AND uic.table_name = uc.table_name
WHERE uic.table_name = ".q($R)."
ORDER BY uc.constraint_type, uic.column_position",$h)as$J){$Fd=$J["INDEX_NAME"];$I[$Fd]["type"]=($J["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($J["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$I[$Fd]["columns"][]=$J["COLUMN_NAME"];$I[$Fd]["lengths"][]=($J["CHAR_LENGTH"]&&$J["CHAR_LENGTH"]!=$J["COLUMN_LENGTH"]?$J["CHAR_LENGTH"]:null);$I[$Fd]["descs"][]=($J["DESCEND"]?'1':null);}return$I;}function
view($C){$K=get_rows('SELECT text "select" FROM user_views WHERE view_name = '.q($C));return
reset($K);}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
explain($g,$G){$g->query("EXPLAIN PLAN FOR $G");return$g->query("SELECT * FROM plan_table");}function
found_rows($S,$Z){}function
alter_table($R,$C,$p,$bd,$tb,$tc,$d,$La,$Of){$c=$ec=array();foreach($p
as$o){$X=$o[1];if($X&&$o[0]!=""&&idf_escape($o[0])!=$X[0])queries("ALTER TABLE ".table($R)." RENAME COLUMN ".idf_escape($o[0])." TO $X[0]");if($X)$c[]=($R!=""?($o[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($R!=""?")":"");else$ec[]=idf_escape($o[0]);}if($R=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($R)."\n".implode("\n",$c)))&&(!$ec||queries("ALTER TABLE ".table($R)." DROP (".implode(", ",$ec).")"))&&($R==$C||queries("ALTER TABLE ".table($R)." RENAME TO ".table($C)));}function
foreign_keys($R){$I=array();$G="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($R);foreach(get_rows($G)as$J)$I[$J['NAME']]=array("db"=>$J['DEST_DB'],"table"=>$J['DEST_TABLE'],"source"=>array($J['SRC_COLUMN']),"target"=>array($J['DEST_COLUMN']),"on_delete"=>$J['ON_DELETE'],"on_update"=>null,);return$I;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Ti){return
apply_queries("DROP VIEW",$Ti);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
last_id(){return
0;}function
schemas(){return
get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX'))");}function
get_schema(){global$g;return$g->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($Vg){global$g;return$g->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($Vg));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$K=get_rows('SELECT * FROM v$instance');return
reset($K);}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
support($Oc){return
preg_match('~^(columns|database|drop_col|indexes|processlist|scheme|sql|status|table|variables|view|view_trigger)$~',$Oc);}$x="oracle";$wi=array();$Ah=array();foreach(array('Numbers'=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),'Date and time'=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),'Strings'=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),'Binary'=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$y=>$X){$wi+=$X;$Ah[$y]=array_keys($X);}$Ci=array();$pf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$jd=array("length","lower","round","upper");$pd=array("avg","count","count distinct","max","min","sum");$lc=array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",));}$dc["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){$bg=array("SQLSRV","MSSQL","PDO_DBLIB");define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$n){$this->errno=$n["code"];$this->error.="$n[message]\n";}$this->error=rtrim($this->error);}function
connect($N,$V,$F){$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$N),array("UID"=>$V,"PWD"=>$F,"CharacterSet"=>"UTF-8"));if($this->_link){$Md=sqlsrv_server_info($this->_link);$this->server_info=$Md['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($G,$xi=false){$H=sqlsrv_query($this->_link,$G);$this->error="";if(!$H){$this->_get_error();return
false;}return$this->store_result($H);}function
multi_query($G){$this->_result=sqlsrv_query($this->_link,$G);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($H=null){if(!$H)$H=$this->_result;if(!$H)return
false;if(sqlsrv_field_metadata($H))return
new
Min_Result($H);$this->affected_rows=sqlsrv_rows_affected($H);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($G,$o=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->fetch_row();return$J[$o];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($H){$this->_result=$H;}function
_convert($J){foreach((array)$J
as$y=>$X){if(is_a($X,'DateTime'))$J[$y]=$X->format("Y-m-d H:i:s");}return$J;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$o=$this->_fields[$this->_offset++];$I=new
stdClass;$I->name=$o["Name"];$I->orgname=$o["Name"];$I->type=($o["Type"]==1?254:0);return$I;}function
seek($D){for($s=0;$s<$D;$s++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($N,$V,$F){$this->_link=@mssql_connect($N,$V,$F);if($this->_link){$H=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($H){$J=$H->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$J[0]] $J[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($j){return
mssql_select_db($j);}function
query($G,$xi=false){$H=@mssql_query($G,$this->_link);$this->error="";if(!$H){$this->error=mssql_get_last_message();return
false;}if($H===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($G,$o=0){$H=$this->query($G);if(!is_object($H))return
false;return
mssql_result($H->_result,0,$o);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($H){$this->_result=$H;$this->num_rows=mssql_num_rows($H);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$I=mssql_fetch_field($this->_result);$I->orgtable=$I->table;$I->orgname=$I->name;return$I;}function
seek($D){mssql_data_seek($this->_result,$D);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($N,$V,$F){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$N)),$V,$F);return
true;}function
select_db($j){return$this->query("USE ".idf_escape($j));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$K,$eg){foreach($K
as$O){$Di=array();$Z=array();foreach($O
as$y=>$X){$Di[]="$y = $X";if(isset($eg[idf_unescape($y)]))$Z[]="$y = $X";}if(!queries("MERGE ".table($R)." USING (VALUES(".implode(", ",$O).")) AS source (c".implode(", c",range(1,count($O))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Di)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($O)).") VALUES (".implode(", ",$O).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($u){return"[".str_replace("]","]]",$u)."]";}function
table($u){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Fb=$b->credentials();if($g->connect($Fb[0],$Fb[1],$Fb[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($G,$Z,$z,$D=0,$M=" "){return($z!==null?" TOP (".($z+$D).")":"")." $G$Z";}function
limit1($R,$G,$Z,$M="\n"){return
limit($G,$Z,1,0,$M);}function
db_collation($l,$ob){global$g;return$g->result("SELECT collation_name FROM sys.databases WHERE name = ".q($l));}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($k){global$g;$I=array();foreach($k
as$l){$g->select_db($l);$I[$l]=$g->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$I;}function
table_status($C=""){$I=array();foreach(get_rows("SELECT name AS Name, type_desc AS Engine FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$J){if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($S){return$S["Engine"]=="VIEW";}function
fk_support($S){return
true;}function
fields($R){$I=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($R))as$J){$U=$J["type"];$qe=(preg_match("~char|binary~",$U)?$J["max_length"]:($U=="decimal"?"$J[precision],$J[scale]":""));$I[$J["name"]]=array("field"=>$J["name"],"full_type"=>$U.($qe?"($qe)":""),"type"=>$U,"length"=>$qe,"default"=>$J["default"],"null"=>$J["is_nullable"],"auto_increment"=>$J["is_identity"],"collation"=>$J["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$J["is_identity"],);}return$I;}function
indexes($R,$h=null){$I=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($R),$h)as$J){$C=$J["name"];$I[$C]["type"]=($J["is_primary_key"]?"PRIMARY":($J["is_unique"]?"UNIQUE":"INDEX"));$I[$C]["lengths"]=array();$I[$C]["columns"][$J["key_ordinal"]]=$J["column_name"];$I[$C]["descs"][$J["key_ordinal"]]=($J["is_descending_key"]?'1':null);}return$I;}function
view($C){global$g;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$g->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($C))));}function
collations(){$I=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$d)$I[preg_replace('~_.*~','',$d)][]=$d;return$I;}function
information_schema($l){return
false;}function
error(){global$g;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$g->error)));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).(preg_match('~^[a-z0-9_]+$~i',$d)?" COLLATE $d":""));}function
drop_databases($k){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$k)));}function
rename_database($C,$d){if(preg_match('~^[a-z0-9_]+$~i',$d))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $d");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($C));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($R,$C,$p,$bd,$tb,$tc,$d,$La,$Of){$c=array();foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c["DROP"][]=" COLUMN $e";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);if($o[0]=="")$c["ADD"][]="\n  ".implode("",$X).($R==""?substr($bd[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($e!=$X[0])queries("EXEC sp_rename ".q(table($R).".$e").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($R=="")return
queries("CREATE TABLE ".table($C)." (".implode(",",(array)$c["ADD"])."\n)");if($R!=$C)queries("EXEC sp_rename ".q(table($R)).", ".q($C));if($bd)$c[""]=$bd;foreach($c
as$y=>$X){if(!queries("ALTER TABLE ".idf_escape($C)." $y".implode(",",$X)))return
false;}return
true;}function
alter_indexes($R,$c){$v=array();$ec=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$ec[]=idf_escape($X[1]);else$v[]=idf_escape($X[1])." ON ".table($R);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R):"ALTER TABLE ".table($R)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$v||queries("DROP INDEX ".implode(", ",$v)))&&(!$ec||queries("ALTER TABLE ".table($R)." DROP ".implode(", ",$ec)));}function
last_id(){global$g;return$g->result("SELECT SCOPE_IDENTITY()");}function
explain($g,$G){$g->query("SET SHOWPLAN_ALL ON");$I=$g->query($G);$g->query("SET SHOWPLAN_ALL OFF");return$I;}function
found_rows($S,$Z){}function
foreign_keys($R){$I=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($R))as$J){$q=&$I[$J["FK_NAME"]];$q["table"]=$J["PKTABLE_NAME"];$q["source"][]=$J["FKCOLUMN_NAME"];$q["target"][]=$J["PKCOLUMN_NAME"];}return$I;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Ti){return
queries("DROP VIEW ".implode(", ",array_map('table',$Ti)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('table',$T)));}function
move_tables($T,$Ti,$Qh){return
apply_queries("ALTER SCHEMA ".idf_escape($Qh)." TRANSFER",array_merge($T,$Ti));}function
trigger($C){if($C=="")return
array();$K=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($C));$I=reset($K);if($I)$I["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$I["text"]);return$I;}function
triggers($R){$I=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($R))as$J)$I[$J["name"]]=array($J["Timing"],$J["Event"]);return$I;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$g;if($_GET["ns"]!="")return$_GET["ns"];return$g->result("SELECT SCHEMA_NAME()");}function
set_schema($Ug){return
true;}function
use_sql($j){return"USE ".idf_escape($j);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
support($Oc){return
preg_match('~^(columns|database|drop_col|indexes|scheme|sql|table|trigger|view|view_trigger)$~',$Oc);}$x="mssql";$wi=array();$Ah=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),'Date and time'=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),'Strings'=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),'Binary'=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$y=>$X){$wi+=$X;$Ah[$y]=array_keys($X);}$Ci=array();$pf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$jd=array("len","lower","round","upper");$pd=array("avg","count","count distinct","max","min","sum");$lc=array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",));}$dc['firebird']='Firebird (alpha)';if(isset($_GET["firebird"])){$bg=array("interbase");define("DRIVER","firebird");if(extension_loaded("interbase")){class
Min_DB{var$extension="Firebird",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($N,$V,$F){$this->_link=ibase_connect($N,$V,$F);if($this->_link){$Gi=explode(':',$N);$this->service_link=ibase_service_attach($Gi[0],$V,$F);$this->server_info=ibase_server_info($this->service_link,IBASE_SVC_SERVER_VERSION);}else{$this->errno=ibase_errcode();$this->error=ibase_errmsg();}return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($j){return($j=="domain");}function
query($G,$xi=false){$H=ibase_query($G,$this->_link);if(!$H){$this->errno=ibase_errcode();$this->error=ibase_errmsg();return
false;}$this->error="";if($H===true){$this->affected_rows=ibase_affected_rows($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$o=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;$J=$H->fetch_row();return$J[$o];}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($H){$this->_result=$H;}function
fetch_assoc(){return
ibase_fetch_assoc($this->_result);}function
fetch_row(){return
ibase_fetch_row($this->_result);}function
fetch_field(){$o=ibase_field_info($this->_result,$this->_offset++);return(object)array('name'=>$o['name'],'orgname'=>$o['name'],'type'=>$o['type'],'charsetnr'=>$o['length'],);}function
__destruct(){ibase_free_result($this->_result);}}}class
Min_Driver
extends
Min_SQL{}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Fb=$b->credentials();if($g->connect($Fb[0],$Fb[1],$Fb[2]))return$g;return$g->error;}function
get_databases($Zc){return
array("domain");}function
limit($G,$Z,$z,$D=0,$M=" "){$I='';$I.=($z!==null?$M."FIRST $z".($D?" SKIP $D":""):"");$I.=" $G$Z";return$I;}function
limit1($R,$G,$Z,$M="\n"){return
limit($G,$Z,1,0,$M);}function
db_collation($l,$ob){}function
engines(){return
array();}function
logged_user(){global$b;$Fb=$b->credentials();return$Fb[1];}function
tables_list(){global$g;$G='SELECT RDB$RELATION_NAME FROM rdb$relations WHERE rdb$system_flag = 0';$H=ibase_query($g->_link,$G);$I=array();while($J=ibase_fetch_assoc($H))$I[$J['RDB$RELATION_NAME']]='table';ksort($I);return$I;}function
count_tables($k){return
array();}function
table_status($C="",$Nc=false){global$g;$I=array();$Kb=tables_list();foreach($Kb
as$v=>$X){$v=trim($v);$I[$v]=array('Name'=>$v,'Engine'=>'standard',);if($C==$v)return$I[$v];}return$I;}function
is_view($S){return
false;}function
fk_support($S){return
preg_match('~InnoDB|IBMDB2I~i',$S["Engine"]);}function
fields($R){global$g;$I=array();$G='SELECT r.RDB$FIELD_NAME AS field_name,
r.RDB$DESCRIPTION AS field_description,
r.RDB$DEFAULT_VALUE AS field_default_value,
r.RDB$NULL_FLAG AS field_not_null_constraint,
f.RDB$FIELD_LENGTH AS field_length,
f.RDB$FIELD_PRECISION AS field_precision,
f.RDB$FIELD_SCALE AS field_scale,
CASE f.RDB$FIELD_TYPE
WHEN 261 THEN \'BLOB\'
WHEN 14 THEN \'CHAR\'
WHEN 40 THEN \'CSTRING\'
WHEN 11 THEN \'D_FLOAT\'
WHEN 27 THEN \'DOUBLE\'
WHEN 10 THEN \'FLOAT\'
WHEN 16 THEN \'INT64\'
WHEN 8 THEN \'INTEGER\'
WHEN 9 THEN \'QUAD\'
WHEN 7 THEN \'SMALLINT\'
WHEN 12 THEN \'DATE\'
WHEN 13 THEN \'TIME\'
WHEN 35 THEN \'TIMESTAMP\'
WHEN 37 THEN \'VARCHAR\'
ELSE \'UNKNOWN\'
END AS field_type,
f.RDB$FIELD_SUB_TYPE AS field_subtype,
coll.RDB$COLLATION_NAME AS field_collation,
cset.RDB$CHARACTER_SET_NAME AS field_charset
FROM RDB$RELATION_FIELDS r
LEFT JOIN RDB$FIELDS f ON r.RDB$FIELD_SOURCE = f.RDB$FIELD_NAME
LEFT JOIN RDB$COLLATIONS coll ON f.RDB$COLLATION_ID = coll.RDB$COLLATION_ID
LEFT JOIN RDB$CHARACTER_SETS cset ON f.RDB$CHARACTER_SET_ID = cset.RDB$CHARACTER_SET_ID
WHERE r.RDB$RELATION_NAME = '.q($R).'
ORDER BY r.RDB$FIELD_POSITION';$H=ibase_query($g->_link,$G);while($J=ibase_fetch_assoc($H))$I[trim($J['FIELD_NAME'])]=array("field"=>trim($J["FIELD_NAME"]),"full_type"=>trim($J["FIELD_TYPE"]),"type"=>trim($J["FIELD_SUB_TYPE"]),"default"=>trim($J['FIELD_DEFAULT_VALUE']),"null"=>(trim($J["FIELD_NOT_NULL_CONSTRAINT"])=="YES"),"auto_increment"=>'0',"collation"=>trim($J["FIELD_COLLATION"]),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"comment"=>trim($J["FIELD_DESCRIPTION"]),);return$I;}function
indexes($R,$h=null){$I=array();return$I;}function
foreign_keys($R){return
array();}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Ug){return
true;}function
support($Oc){return
preg_match("~^(columns|sql|status|table)$~",$Oc);}$x="firebird";$pf=array("=");$jd=array();$pd=array();$lc=array();}$dc["simpledb"]="SimpleDB";if(isset($_GET["simpledb"])){$bg=array("SimpleXML + allow_url_fopen");define("DRIVER","simpledb");if(class_exists('SimpleXMLElement')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="SimpleXML",$server_info='2009-04-15',$error,$timeout,$next,$affected_rows,$_result;function
select_db($j){return($j=="domain");}function
query($G,$xi=false){$If=array('SelectExpression'=>$G,'ConsistentRead'=>'true');if($this->next)$If['NextToken']=$this->next;$H=sdb_request_all('Select','Item',$If,$this->timeout);$this->timeout=0;if($H===false)return$H;if(preg_match('~^\s*SELECT\s+COUNT\(~i',$G)){$Eh=0;foreach($H
as$Yd)$Eh+=$Yd->Attribute->Value;$H=array((object)array('Attribute'=>array((object)array('Name'=>'Count','Value'=>$Eh,))));}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0;function
__construct($H){foreach($H
as$Yd){$J=array();if($Yd->Name!='')$J['itemName()']=(string)$Yd->Name;foreach($Yd->Attribute
as$Ia){$C=$this->_processValue($Ia->Name);$Y=$this->_processValue($Ia->Value);if(isset($J[$C])){$J[$C]=(array)$J[$C];$J[$C][]=$Y;}else$J[$C]=$Y;}$this->_rows[]=$J;foreach($J
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=count($this->_rows);}function
_processValue($oc){return(is_object($oc)&&$oc['encoding']=='base64'?base64_decode($oc):(string)$oc);}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$y=>$X)$I[$y]=$J[$y];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$ee=array_keys($this->_rows[0]);return(object)array('name'=>$ee[$this->_offset++]);}}}class
Min_Driver
extends
Min_SQL{public$eg="itemName()";function
_chunkRequest($Cd,$va,$If,$Dc=array()){global$g;foreach(array_chunk($Cd,25)as$hb){$Jf=$If;foreach($hb
as$s=>$t){$Jf["Item.$s.ItemName"]=$t;foreach($Dc
as$y=>$X)$Jf["Item.$s.$y"]=$X;}if(!sdb_request($va,$Jf))return
false;}$g->affected_rows=count($Cd);return
true;}function
_extractIds($R,$qg,$z){$I=array();if(preg_match_all("~itemName\(\) = (('[^']*+')+)~",$qg,$_e))$I=array_map('idf_unescape',$_e[1]);else{foreach(sdb_request_all('Select','Item',array('SelectExpression'=>'SELECT itemName() FROM '.table($R).$qg.($z?" LIMIT 1":"")))as$Yd)$I[]=$Yd->Name;}return$I;}function
select($R,$L,$Z,$md,$uf=array(),$z=1,$E=0,$gg=false){global$g;$g->next=$_GET["next"];$I=parent::select($R,$L,$Z,$md,$uf,$z,$E,$gg);$g->next=0;return$I;}function
delete($R,$qg,$z=0){return$this->_chunkRequest($this->_extractIds($R,$qg,$z),'BatchDeleteAttributes',array('DomainName'=>$R));}function
update($R,$O,$qg,$z=0,$M="\n"){$Tb=array();$Qd=array();$s=0;$Cd=$this->_extractIds($R,$qg,$z);$t=idf_unescape($O["`itemName()`"]);unset($O["`itemName()`"]);foreach($O
as$y=>$X){$y=idf_unescape($y);if($X=="NULL"||($t!=""&&array($t)!=$Cd))$Tb["Attribute.".count($Tb).".Name"]=$y;if($X!="NULL"){foreach((array)$X
as$ae=>$W){$Qd["Attribute.$s.Name"]=$y;$Qd["Attribute.$s.Value"]=(is_array($X)?$W:idf_unescape($W));if(!$ae)$Qd["Attribute.$s.Replace"]="true";$s++;}}}$If=array('DomainName'=>$R);return(!$Qd||$this->_chunkRequest(($t!=""?array($t):$Cd),'BatchPutAttributes',$If,$Qd))&&(!$Tb||$this->_chunkRequest($Cd,'BatchDeleteAttributes',$If,$Tb));}function
insert($R,$O){$If=array("DomainName"=>$R);$s=0;foreach($O
as$C=>$Y){if($Y!="NULL"){$C=idf_unescape($C);if($C=="itemName()")$If["ItemName"]=idf_unescape($Y);else{foreach((array)$Y
as$X){$If["Attribute.$s.Name"]=$C;$If["Attribute.$s.Value"]=(is_array($Y)?$X:idf_unescape($Y));$s++;}}}}return
sdb_request('PutAttributes',$If);}function
insertUpdate($R,$K,$eg){foreach($K
as$O){if(!$this->update($R,$O,"WHERE `itemName()` = ".q($O["`itemName()`"])))return
false;}return
true;}function
begin(){return
false;}function
commit(){return
false;}function
rollback(){return
false;}function
slowQuery($G,$Yh){$this->_conn->timeout=$Yh;return$G;}}function
connect(){global$b;list(,,$F)=$b->credentials();if($F!="")return'Database does not support password.';return
new
Min_DB;}function
support($Oc){return
preg_match('~sql~',$Oc);}function
logged_user(){global$b;$Fb=$b->credentials();return$Fb[1];}function
get_databases(){return
array("domain");}function
collations(){return
array();}function
db_collation($l,$ob){}function
tables_list(){global$g;$I=array();foreach(sdb_request_all('ListDomains','DomainName')as$R)$I[(string)$R]='table';if($g->error&&defined("PAGE_HEADER"))echo"<p class='error'>".error()."\n";return$I;}function
table_status($C="",$Nc=false){$I=array();foreach(($C!=""?array($C=>true):tables_list())as$R=>$U){$J=array("Name"=>$R,"Auto_increment"=>"");if(!$Nc){$Me=sdb_request('DomainMetadata',array('DomainName'=>$R));if($Me){foreach(array("Rows"=>"ItemCount","Data_length"=>"ItemNamesSizeBytes","Index_length"=>"AttributeValuesSizeBytes","Data_free"=>"AttributeNamesSizeBytes",)as$y=>$X)$J[$y]=(string)$Me->$X;}}if($C!="")return$J;$I[$R]=$J;}return$I;}function
explain($g,$G){}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($S){}function
indexes($R,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("itemName()")),);}function
fields($R){return
fields_from_edit();}function
foreign_keys($R){return
array();}function
table($u){return
idf_escape($u);}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
limit($G,$Z,$z,$D=0,$M=" "){return" $G$Z".($z!==null?$M."LIMIT $z":"");}function
unconvert_field($o,$I){return$I;}function
fk_support($S){}function
engines(){return
array();}function
alter_table($R,$C,$p,$bd,$tb,$tc,$d,$La,$Of){return($R==""&&sdb_request('CreateDomain',array('DomainName'=>$C)));}function
drop_tables($T){foreach($T
as$R){if(!sdb_request('DeleteDomain',array('DomainName'=>$R)))return
false;}return
true;}function
count_tables($k){foreach($k
as$l)return
array($l=>count(tables_list()));}function
found_rows($S,$Z){return($Z?null:$S["Rows"]);}function
last_id(){}function
hmac($Ba,$Kb,$y,$ug=false){$Ua=64;if(strlen($y)>$Ua)$y=pack("H*",$Ba($y));$y=str_pad($y,$Ua,"\0");$be=$y^str_repeat("\x36",$Ua);$ce=$y^str_repeat("\x5C",$Ua);$I=$Ba($ce.pack("H*",$Ba($be.$Kb)));if($ug)$I=pack("H*",$I);return$I;}function
sdb_request($va,$If=array()){global$b,$g;list($_d,$If['AWSAccessKeyId'],$Xg)=$b->credentials();$If['Action']=$va;$If['Timestamp']=gmdate('Y-m-d\TH:i:s+00:00');$If['Version']='2009-04-15';$If['SignatureVersion']=2;$If['SignatureMethod']='HmacSHA1';ksort($If);$G='';foreach($If
as$y=>$X)$G.='&'.rawurlencode($y).'='.rawurlencode($X);$G=str_replace('%7E','~',substr($G,1));$G.="&Signature=".urlencode(base64_encode(hmac('sha1',"POST\n".preg_replace('~^https?://~','',$_d)."\n/\n$G",$Xg,true)));@ini_set('track_errors',1);$Sc=@file_get_contents((preg_match('~^https?://~',$_d)?$_d:"http://$_d"),false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$G,'ignore_errors'=>1,))));if(!$Sc){$g->error=$php_errormsg;return
false;}libxml_use_internal_errors(true);$gj=simplexml_load_string($Sc);if(!$gj){$n=libxml_get_last_error();$g->error=$n->message;return
false;}if($gj->Errors){$n=$gj->Errors->Error;$g->error="$n->Message ($n->Code)";return
false;}$g->error='';$Ph=$va."Result";return($gj->$Ph?$gj->$Ph:true);}function
sdb_request_all($va,$Ph,$If=array(),$Yh=0){$I=array();$xh=($Yh?microtime(true):0);$z=(preg_match('~LIMIT\s+(\d+)\s*$~i',$If['SelectExpression'],$B)?$B[1]:0);do{$gj=sdb_request($va,$If);if(!$gj)break;foreach($gj->$Ph
as$oc)$I[]=$oc;if($z&&count($I)>=$z){$_GET["next"]=$gj->NextToken;break;}if($Yh&&microtime(true)-$xh>$Yh)return
false;$If['NextToken']=$gj->NextToken;if($z)$If['SelectExpression']=preg_replace('~\d+\s*$~',$z-count($I),$If['SelectExpression']);}while($gj->NextToken);return$I;}$x="simpledb";$pf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","IS NOT NULL");$jd=array();$pd=array("count");$lc=array(array("json"));}$dc["mongo"]="MongoDB";if(isset($_GET["mongo"])){$bg=array("mongo","mongodb");define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Ei,$sf){return@new
MongoClient($Ei,$sf);}function
query($G){return
false;}function
select_db($j){try{$this->_db=$this->_link->selectDB($j);return
true;}catch(Exception$_c){$this->error=$_c->getMessage();return
false;}}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($H){foreach($H
as$Yd){$J=array();foreach($Yd
as$y=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$y]=63;$J[$y]=(is_a($X,'MongoId')?'ObjectId("'.strval($X).'")':(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?strval($X):(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$J;foreach($J
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$y=>$X)$I[$y]=$J[$y];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$ee=array_keys($this->_rows[0]);$C=$ee[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$eg="_id";function
select($R,$L,$Z,$md,$uf=array(),$z=1,$E=0,$gg=false){$L=($L==array("*")?array():array_fill_keys($L,true));$oh=array();foreach($uf
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Cb);$oh[$X]=($Cb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($R)->find(array(),$L)->sort($oh)->limit($z!=""?+$z:0)->skip($E*$z));}function
insert($R,$O){try{$I=$this->_conn->_db->selectCollection($R)->insert($O);$this->_conn->errno=$I['code'];$this->_conn->error=$I['err'];$this->_conn->last_id=$O['_id'];return!$I['err'];}catch(Exception$_c){$this->_conn->error=$_c->getMessage();return
false;}}}function
get_databases($Zc){global$g;$I=array();$Pb=$g->_link->listDBs();foreach($Pb['databases']as$l)$I[]=$l['name'];return$I;}function
count_tables($k){global$g;$I=array();foreach($k
as$l)$I[$l]=count($g->_link->selectDB($l)->getCollectionNames(true));return$I;}function
tables_list(){global$g;return
array_fill_keys($g->_db->getCollectionNames(true),'table');}function
drop_databases($k){global$g;foreach($k
as$l){$Gg=$g->_link->selectDB($l)->drop();if(!$Gg['ok'])return
false;}return
true;}function
indexes($R,$h=null){global$g;$I=array();foreach($g->_db->selectCollection($R)->getIndexInfo()as$v){$Wb=array();foreach($v["key"]as$e=>$U)$Wb[]=($U==-1?'1':null);$I[$v["name"]]=array("type"=>($v["name"]=="_id_"?"PRIMARY":($v["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($v["key"]),"lengths"=>array(),"descs"=>$Wb,);}return$I;}function
fields($R){return
fields_from_edit();}function
found_rows($S,$Z){global$g;return$g->_db->selectCollection($_GET["select"])->count($Z);}$pf=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Ei,$sf){$jb='MongoDB\Driver\Manager';return
new$jb($Ei,$sf);}function
query($G){return
false;}function
select_db($j){$this->_db_name=$j;return
true;}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($H){foreach($H
as$Yd){$J=array();foreach($Yd
as$y=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$y]=63;$J[$y]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'.strval($X).'")':(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->bin:(is_a($X,'MongoDB\BSON\Regex')?strval($X):(is_object($X)?json_encode($X,256):$X)))));}$this->_rows[]=$J;foreach($J
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=$H->count;}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$y=>$X)$I[$y]=$J[$y];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$ee=array_keys($this->_rows[0]);$C=$ee[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$eg="_id";function
select($R,$L,$Z,$md,$uf=array(),$z=1,$E=0,$gg=false){global$g;$L=($L==array("*")?array():array_fill_keys($L,1));if(count($L)&&!isset($L['_id']))$L['_id']=0;$Z=where_to_query($Z);$oh=array();foreach($uf
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Cb);$oh[$X]=($Cb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$z=$_GET['limit'];$z=min(200,max(1,(int)$z));$lh=$E*$z;$jb='MongoDB\Driver\Query';$G=new$jb($Z,array('projection'=>$L,'limit'=>$z,'skip'=>$lh,'sort'=>$oh));$Jg=$g->_link->executeQuery("$g->_db_name.$R",$G);return
new
Min_Result($Jg);}function
update($R,$O,$qg,$z=0,$M="\n"){global$g;$l=$g->_db_name;$Z=sql_query_where_parser($qg);$jb='MongoDB\Driver\BulkWrite';$Ya=new$jb(array());if(isset($O['_id']))unset($O['_id']);$Dg=array();foreach($O
as$y=>$Y){if($Y=='NULL'){$Dg[$y]=1;unset($O[$y]);}}$Di=array('$set'=>$O);if(count($Dg))$Di['$unset']=$Dg;$Ya->update($Z,$Di,array('upsert'=>false));$Jg=$g->_link->executeBulkWrite("$l.$R",$Ya);$g->affected_rows=$Jg->getModifiedCount();return
true;}function
delete($R,$qg,$z=0){global$g;$l=$g->_db_name;$Z=sql_query_where_parser($qg);$jb='MongoDB\Driver\BulkWrite';$Ya=new$jb(array());$Ya->delete($Z,array('limit'=>$z));$Jg=$g->_link->executeBulkWrite("$l.$R",$Ya);$g->affected_rows=$Jg->getDeletedCount();return
true;}function
insert($R,$O){global$g;$l=$g->_db_name;$jb='MongoDB\Driver\BulkWrite';$Ya=new$jb(array());if(isset($O['_id'])&&empty($O['_id']))unset($O['_id']);$Ya->insert($O);$Jg=$g->_link->executeBulkWrite("$l.$R",$Ya);$g->affected_rows=$Jg->getInsertedCount();return
true;}}function
get_databases($Zc){global$g;$I=array();$jb='MongoDB\Driver\Command';$rb=new$jb(array('listDatabases'=>1));$Jg=$g->_link->executeCommand('admin',$rb);foreach($Jg
as$Pb){foreach($Pb->databases
as$l)$I[]=$l->name;}return$I;}function
count_tables($k){$I=array();return$I;}function
tables_list(){global$g;$jb='MongoDB\Driver\Command';$rb=new$jb(array('listCollections'=>1));$Jg=$g->_link->executeCommand($g->_db_name,$rb);$pb=array();foreach($Jg
as$H)$pb[$H->name]='table';return$pb;}function
drop_databases($k){return
false;}function
indexes($R,$h=null){global$g;$I=array();$jb='MongoDB\Driver\Command';$rb=new$jb(array('listIndexes'=>$R));$Jg=$g->_link->executeCommand($g->_db_name,$rb);foreach($Jg
as$v){$Wb=array();$f=array();foreach(get_object_vars($v->key)as$e=>$U){$Wb[]=($U==-1?'1':null);$f[]=$e;}$I[$v->name]=array("type"=>($v->name=="_id_"?"PRIMARY":(isset($v->unique)?"UNIQUE":"INDEX")),"columns"=>$f,"lengths"=>array(),"descs"=>$Wb,);}return$I;}function
fields($R){$p=fields_from_edit();if(!count($p)){global$m;$H=$m->select($R,array("*"),null,null,array(),10);while($J=$H->fetch_assoc()){foreach($J
as$y=>$X){$J[$y]=null;$p[$y]=array("field"=>$y,"type"=>"string","null"=>($y!=$m->primary),"auto_increment"=>($y==$m->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}return$p;}function
found_rows($S,$Z){global$g;$Z=where_to_query($Z);$jb='MongoDB\Driver\Command';$rb=new$jb(array('count'=>$S['Name'],'query'=>$Z));$Jg=$g->_link->executeCommand($g->_db_name,$rb);$gi=$Jg->toArray();return$gi[0]->n;}function
sql_query_where_parser($qg){$qg=trim(preg_replace('/WHERE[\s]?[(]?\(?/','',$qg));$qg=preg_replace('/\)\)\)$/',')',$qg);$dj=explode(' AND ',$qg);$ej=explode(') OR (',$qg);$Z=array();foreach($dj
as$bj)$Z[]=trim($bj);if(count($ej)==1)$ej=array();elseif(count($ej)>1)$Z=array();return
where_to_query($Z,$ej);}function
where_to_query($Zi=array(),$aj=array()){global$b;$Kb=array();foreach(array('and'=>$Zi,'or'=>$aj)as$U=>$Z){if(is_array($Z)){foreach($Z
as$Gc){list($mb,$nf,$X)=explode(" ",$Gc,3);if($mb=="_id"){$X=str_replace('MongoDB\BSON\ObjectID("',"",$X);$X=str_replace('")',"",$X);$jb='MongoDB\BSON\ObjectID';$X=new$jb($X);}if(!in_array($nf,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$nf,$B)){$X=(float)$X;$nf=$B[1];}elseif(preg_match('~^\(date\)(.+)~',$nf,$B)){$Mb=new
DateTime($X);$jb='MongoDB\BSON\UTCDatetime';$X=new$jb($Mb->getTimestamp()*1000);$nf=$B[1];}switch($nf){case'=':$nf='$eq';break;case'!=':$nf='$ne';break;case'>':$nf='$gt';break;case'<':$nf='$lt';break;case'>=':$nf='$gte';break;case'<=':$nf='$lte';break;case'regex':$nf='$regex';break;default:continue;}if($U=='and')$Kb['$and'][]=array($mb=>array($nf=>$X));elseif($U=='or')$Kb['$or'][]=array($mb=>array($nf=>$X));}}}return$Kb;}$pf=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($u){return$u;}function
idf_escape($u){return$u;}function
table_status($C="",$Nc=false){$I=array();foreach(tables_list()as$R=>$U){$I[$R]=array("Name"=>$R);if($C==$R)return$I[$R];}return$I;}function
create_database($l,$d){return
true;}function
last_id(){global$g;return$g->last_id;}function
error(){global$g;return
h($g->error);}function
collations(){return
array();}function
logged_user(){global$b;$Fb=$b->credentials();return$Fb[1];}function
connect(){global$b;$g=new
Min_DB;list($N,$V,$F)=$b->credentials();$sf=array();if($V.$F!=""){$sf["username"]=$V;$sf["password"]=$F;}$l=$b->database();if($l!="")$sf["db"]=$l;try{$g->_link=$g->connect("mongodb://$N",$sf);if($F!=""){$sf["password"]="";try{$g->connect("mongodb://$N",$sf);return'Database does not support password.';}catch(Exception$_c){}}return$g;}catch(Exception$_c){return$_c->getMessage();}}function
alter_indexes($R,$c){global$g;foreach($c
as$X){list($U,$C,$O)=$X;if($O=="DROP")$I=$g->_db->command(array("deleteIndexes"=>$R,"index"=>$C));else{$f=array();foreach($O
as$e){$e=preg_replace('~ DESC$~','',$e,1,$Cb);$f[$e]=($Cb?-1:1);}$I=$g->_db->selectCollection($R)->ensureIndex($f,array("unique"=>($U=="UNIQUE"),"name"=>$C,));}if($I['errmsg']){$g->error=$I['errmsg'];return
false;}}return
true;}function
support($Oc){return
preg_match("~database|indexes~",$Oc);}function
db_collation($l,$ob){}function
information_schema(){}function
is_view($S){}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
foreign_keys($R){return
array();}function
fk_support($S){}function
engines(){return
array();}function
alter_table($R,$C,$p,$bd,$tb,$tc,$d,$La,$Of){global$g;if($R==""){$g->_db->createCollection($C);return
true;}}function
drop_tables($T){global$g;foreach($T
as$R){$Gg=$g->_db->selectCollection($R)->drop();if(!$Gg['ok'])return
false;}return
true;}function
truncate_tables($T){global$g;foreach($T
as$R){$Gg=$g->_db->selectCollection($R)->remove();if(!$Gg['ok'])return
false;}return
true;}$x="mongo";$jd=array();$pd=array();$lc=array(array("json"));}$dc["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){$bg=array("json + allow_url_fopen");define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url;function
rootQuery($Sf,$yb=array(),$Ne='GET'){@ini_set('track_errors',1);$Sc=@file_get_contents("$this->_url/".ltrim($Sf,'/'),false,stream_context_create(array('http'=>array('method'=>$Ne,'content'=>$yb===null?$yb:json_encode($yb),'header'=>'Content-Type: application/json','ignore_errors'=>1,))));if(!$Sc){$this->error=$php_errormsg;return$Sc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error=$Sc;return
false;}$I=json_decode($Sc,true);if($I===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$xb=get_defined_constants(true);foreach($xb['json']as$C=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$C)){$this->error=$C;break;}}}}return$I;}function
query($Sf,$yb=array(),$Ne='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($Sf,'/'),$yb,$Ne);}function
connect($N,$V,$F){preg_match('~^(https?://)?(.*)~',$N,$B);$this->_url=($B[1]?$B[1]:"http://")."$V:$F@$B[2]";$I=$this->query('');if($I)$this->server_info=$I['version']['number'];return(bool)$I;}function
select_db($j){$this->_db=$j;return
true;}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows;function
__construct($K){$this->num_rows=count($this->_rows);$this->_rows=$K;reset($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);next($this->_rows);return$I;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($R,$L,$Z,$md,$uf=array(),$z=1,$E=0,$gg=false){global$b;$Kb=array();$G="$R/_search";if($L!=array("*"))$Kb["fields"]=$L;if($uf){$oh=array();foreach($uf
as$mb){$mb=preg_replace('~ DESC$~','',$mb,1,$Cb);$oh[]=($Cb?array($mb=>"desc"):$mb);}$Kb["sort"]=$oh;}if($z){$Kb["size"]=+$z;if($E)$Kb["from"]=($E*$z);}foreach($Z
as$X){list($mb,$nf,$X)=explode(" ",$X,3);if($mb=="_id")$Kb["query"]["ids"]["values"][]=$X;elseif($mb.$X!=""){$Th=array("term"=>array(($mb!=""?$mb:"_all")=>$X));if($nf=="=")$Kb["query"]["filtered"]["filter"]["and"][]=$Th;else$Kb["query"]["filtered"]["query"]["bool"]["must"][]=$Th;}}if($Kb["query"]&&!$Kb["query"]["filtered"]["query"]&&!$Kb["query"]["ids"])$Kb["query"]["filtered"]["query"]=array("match_all"=>array());$xh=microtime(true);$Wg=$this->_conn->query($G,$Kb);if($gg)echo$b->selectQuery("$G: ".print_r($Kb,true),$xh,!$Wg);if(!$Wg)return
false;$I=array();foreach($Wg['hits']['hits']as$zd){$J=array();if($L==array("*"))$J["_id"]=$zd["_id"];$p=$zd['_source'];if($L!=array("*")){$p=array();foreach($L
as$y)$p[$y]=$zd['fields'][$y];}foreach($p
as$y=>$X){if($Kb["fields"])$X=$X[0];$J[$y]=(is_array($X)?json_encode($X):$X);}$I[]=$J;}return
new
Min_Result($I);}function
update($U,$vg,$qg,$z=0,$M="\n"){$Qf=preg_split('~ *= *~',$qg);if(count($Qf)==2){$t=trim($Qf[1]);$G="$U/$t";return$this->_conn->query($G,$vg,'POST');}return
false;}function
insert($U,$vg){$t="";$G="$U/$t";$Gg=$this->_conn->query($G,$vg,'POST');$this->_conn->last_id=$Gg['_id'];return$Gg['created'];}function
delete($U,$qg,$z=0){$Cd=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Cd[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$cb){$Qf=preg_split('~ *= *~',$cb);if(count($Qf)==2)$Cd[]=trim($Qf[1]);}}$this->_conn->affected_rows=0;foreach($Cd
as$t){$G="{$U}/{$t}";$Gg=$this->_conn->query($G,'{}','DELETE');if(is_array($Gg)&&$Gg['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$g=new
Min_DB;list($N,$V,$F)=$b->credentials();if($F!=""&&$g->connect($N,$V,""))return'Database does not support password.';if($g->connect($N,$V,$F))return$g;return$g->error;}function
support($Oc){return
preg_match("~database|table|columns~",$Oc);}function
logged_user(){global$b;$Fb=$b->credentials();return$Fb[1];}function
get_databases(){global$g;$I=$g->rootQuery('_aliases');if($I){$I=array_keys($I);sort($I,SORT_STRING);}return$I;}function
collations(){return
array();}function
db_collation($l,$ob){}function
engines(){return
array();}function
count_tables($k){global$g;$I=array();$H=$g->query('_stats');if($H&&$H['indices']){$Jd=$H['indices'];foreach($Jd
as$Id=>$yh){$Hd=$yh['total']['indexing'];$I[$Id]=$Hd['index_total'];}}return$I;}function
tables_list(){global$g;$I=$g->query('_mapping');if($I)$I=array_fill_keys(array_keys($I[$g->_db]["mappings"]),'table');return$I;}function
table_status($C="",$Nc=false){global$g;$Wg=$g->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$I=array();if($Wg){$T=$Wg["aggregations"]["count_by_type"]["buckets"];foreach($T
as$R){$I[$R["key"]]=array("Name"=>$R["key"],"Engine"=>"table","Rows"=>$R["doc_count"],);if($C!=""&&$C==$R["key"])return$I[$C];}}return$I;}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($S){}function
indexes($R,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($R){global$g;$H=$g->query("$R/_mapping");$I=array();if($H){$we=$H[$R]['properties'];if(!$we)$we=$H[$g->_db]['mappings'][$R]['properties'];if($we){foreach($we
as$C=>$o){$I[$C]=array("field"=>$C,"full_type"=>$o["type"],"type"=>$o["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($o["properties"]){unset($I[$C]["privileges"]["insert"]);unset($I[$C]["privileges"]["update"]);}}}}return$I;}function
foreign_keys($R){return
array();}function
table($u){return$u;}function
idf_escape($u){return$u;}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
fk_support($S){}function
found_rows($S,$Z){return
null;}function
create_database($l){global$g;return$g->rootQuery(urlencode($l),null,'PUT');}function
drop_databases($k){global$g;return$g->rootQuery(urlencode(implode(',',$k)),array(),'DELETE');}function
alter_table($R,$C,$p,$bd,$tb,$tc,$d,$La,$Of){global$g;$mg=array();foreach($p
as$Lc){$Qc=trim($Lc[1][0]);$Rc=trim($Lc[1][1]?$Lc[1][1]:"text");$mg[$Qc]=array('type'=>$Rc);}if(!empty($mg))$mg=array('properties'=>$mg);return$g->query("_mapping/{$C}",$mg,'PUT');}function
drop_tables($T){global$g;$I=true;foreach($T
as$R)$I=$I&&$g->query(urlencode($R),array(),'DELETE');return$I;}function
last_id(){global$g;return$g->last_id;}$x="elastic";$pf=array("=","query");$jd=array();$pd=array();$lc=array(array("json"));$wi=array();$Ah=array();foreach(array('Numbers'=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),'Date and time'=>array("date"=>10),'Strings'=>array("string"=>65535,"text"=>65535),'Binary'=>array("binary"=>255),)as$y=>$X){$wi+=$X;$Ah[$y]=array_keys($X);}}$dc=array("server"=>"MySQL")+$dc;if(!defined("DRIVER")){$bg=array("MySQLi","MySQL","PDO_MySQL");define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($N="",$V="",$F="",$j=null,$Xf=null,$nh=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($_d,$Xf)=explode(":",$N,2);$wh=$b->connectSsl();if($wh)$this->ssl_set($wh['key'],$wh['cert'],$wh['ca'],'','');$I=@$this->real_connect(($N!=""?$_d:ini_get("mysqli.default_host")),($N.$V!=""?$V:ini_get("mysqli.default_user")),($N.$V.$F!=""?$F:ini_get("mysqli.default_pw")),$j,(is_numeric($Xf)?$Xf:ini_get("mysqli.default_port")),(!is_numeric($Xf)?$Xf:$nh),($wh?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$I;}function
set_charset($bb){if(parent::set_charset($bb))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $bb");}function
result($G,$o=0){$H=$this->query($G);if(!$H)return
false;$J=$H->fetch_array();return$J[$o];}function
quote($Q){return"'".$this->escape_string($Q)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($N,$V,$F){if(ini_bool("mysql.allow_local_infile")){$this->error=sprintf('Disable %s or enable %s or %s extensions.',"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($N!=""?$N:ini_get("mysql.default_host")),("$N$V"!=""?$V:ini_get("mysql.default_user")),("$N$V$F"!=""?$F:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($bb){if(function_exists('mysql_set_charset')){if(mysql_set_charset($bb,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $bb");}function
quote($Q){return"'".mysql_real_escape_string($Q,$this->_link)."'";}function
select_db($j){return
mysql_select_db($j,$this->_link);}function
query($G,$xi=false){$H=@($xi?mysql_unbuffered_query($G,$this->_link):mysql_query($G,$this->_link));$this->error="";if(!$H){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($H===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$o=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;return
mysql_result($H->_result,0,$o);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($H){$this->_result=$H;$this->num_rows=mysql_num_rows($H);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$I=mysql_fetch_field($this->_result,$this->_offset++);$I->orgtable=$I->table;$I->orgname=$I->name;$I->charsetnr=($I->blob?63:0);return$I;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($N,$V,$F){global$b;$sf=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$wh=$b->connectSsl();if($wh)$sf+=array(PDO::MYSQL_ATTR_SSL_KEY=>$wh['key'],PDO::MYSQL_ATTR_SSL_CERT=>$wh['cert'],PDO::MYSQL_ATTR_SSL_CA=>$wh['ca'],);$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$N)),$V,$F,$sf);return
true;}function
set_charset($bb){$this->query("SET NAMES $bb");}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($G,$xi=false){$this->setAttribute(1000,!$xi);return
parent::query($G,$xi);}}}class
Min_Driver
extends
Min_SQL{function
insert($R,$O){return($O?parent::insert($R,$O):queries("INSERT INTO ".table($R)." ()\nVALUES ()"));}function
insertUpdate($R,$K,$eg){$f=array_keys(reset($K));$cg="INSERT INTO ".table($R)." (".implode(", ",$f).") VALUES\n";$Oi=array();foreach($f
as$y)$Oi[$y]="$y = VALUES($y)";$Dh="\nON DUPLICATE KEY UPDATE ".implode(", ",$Oi);$Oi=array();$qe=0;foreach($K
as$O){$Y="(".implode(", ",$O).")";if($Oi&&(strlen($cg)+$qe+strlen($Y)+strlen($Dh)>1e6)){if(!queries($cg.implode(",\n",$Oi).$Dh))return
false;$Oi=array();$qe=0;}$Oi[]=$Y;$qe+=strlen($Y)+2;}return
queries($cg.implode(",\n",$Oi).$Dh);}function
slowQuery($G,$Yh){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$Yh FOR $G";elseif(preg_match('~^(SELECT\b)(.+)~is',$G,$B))return"$B[1] /*+ MAX_EXECUTION_TIME(".($Yh*1000).") */ $B[2]";}}function
convertSearch($u,$X,$o){return(preg_match('~char|text|enum|set~',$o["type"])&&!preg_match("~^utf8~",$o["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($u USING ".charset($this->_conn).")":$u);}function
warnings(){$H=$this->_conn->query("SHOW WARNINGS");if($H&&$H->num_rows){ob_start();select($H);return
ob_get_clean();}}function
tableHelp($C){$xe=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($xe?"information-schema-$C-table/":str_replace("_","-",$C)."-table.html"));if(DB=="mysql")return($xe?"mysql$C-table/":"system-database.html");}}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
table($u){return
idf_escape($u);}function
connect(){global$b,$wi,$Ah;$g=new
Min_DB;$Fb=$b->credentials();if($g->connect($Fb[0],$Fb[1],$Fb[2])){$g->set_charset(charset($g));$g->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$g)){$Ah['Strings'][]="json";$wi["json"]=4294967295;}return$g;}$I=$g->error;if(function_exists('iconv')&&!is_utf8($I)&&strlen($Sg=iconv("windows-1250","utf-8",$I))>strlen($I))$I=$Sg;return$I;}function
get_databases($Zc){$I=get_session("dbs");if($I===null){$G=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$I=($Zc?slow_query($G):get_vals($G));restart_session();set_session("dbs",$I);stop_session();}return$I;}function
limit($G,$Z,$z,$D=0,$M=" "){return" $G$Z".($z!==null?$M."LIMIT $z".($D?" OFFSET $D":""):"");}function
limit1($R,$G,$Z,$M="\n"){return
limit($G,$Z,1,0,$M);}function
db_collation($l,$ob){global$g;$I=null;$i=$g->result("SHOW CREATE DATABASE ".idf_escape($l),1);if(preg_match('~ COLLATE ([^ ]+)~',$i,$B))$I=$B[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$i,$B))$I=$ob[$B[1]][-1];return$I;}function
engines(){$I=array();foreach(get_rows("SHOW ENGINES")as$J){if(preg_match("~YES|DEFAULT~",$J["Support"]))$I[]=$J["Engine"];}return$I;}function
logged_user(){global$g;return$g->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($k){$I=array();foreach($k
as$l)$I[$l]=count(get_vals("SHOW TABLES IN ".idf_escape($l)));return$I;}function
table_status($C="",$Nc=false){$I=array();foreach(get_rows($Nc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($C!=""?"AND TABLE_NAME = ".q($C):"ORDER BY Name"):"SHOW TABLE STATUS".($C!=""?" LIKE ".q(addcslashes($C,"%_\\")):""))as$J){if($J["Engine"]=="InnoDB")$J["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$J["Comment"]);if(!isset($J["Engine"]))$J["Comment"]="";if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($S){return$S["Engine"]===null;}function
fk_support($S){return
preg_match('~InnoDB|IBMDB2I~i',$S["Engine"])||(preg_match('~NDB~i',$S["Engine"])&&min_version(5.6));}function
fields($R){$I=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($R))as$J){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$J["Type"],$B);$I[$J["Field"]]=array("field"=>$J["Field"],"full_type"=>$J["Type"],"type"=>$B[1],"length"=>$B[2],"unsigned"=>ltrim($B[3].$B[4]),"default"=>($J["Default"]!=""||preg_match("~char|set~",$B[1])?$J["Default"]:null),"null"=>($J["Null"]=="YES"),"auto_increment"=>($J["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$J["Extra"],$B)?$B[1]:""),"collation"=>$J["Collation"],"privileges"=>array_flip(preg_split('~, *~',$J["Privileges"])),"comment"=>$J["Comment"],"primary"=>($J["Key"]=="PRI"),);}return$I;}function
indexes($R,$h=null){$I=array();foreach(get_rows("SHOW INDEX FROM ".table($R),$h)as$J){$C=$J["Key_name"];$I[$C]["type"]=($C=="PRIMARY"?"PRIMARY":($J["Index_type"]=="FULLTEXT"?"FULLTEXT":($J["Non_unique"]?($J["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$I[$C]["columns"][]=$J["Column_name"];$I[$C]["lengths"][]=($J["Index_type"]=="SPATIAL"?null:$J["Sub_part"]);$I[$C]["descs"][]=null;}return$I;}function
foreign_keys($R){global$g,$kf;static$Uf='`(?:[^`]|``)+`';$I=array();$Db=$g->result("SHOW CREATE TABLE ".table($R),1);if($Db){preg_match_all("~CONSTRAINT ($Uf) FOREIGN KEY ?\\(((?:$Uf,? ?)+)\\) REFERENCES ($Uf)(?:\\.($Uf))? \\(((?:$Uf,? ?)+)\\)(?: ON DELETE ($kf))?(?: ON UPDATE ($kf))?~",$Db,$_e,PREG_SET_ORDER);foreach($_e
as$B){preg_match_all("~$Uf~",$B[2],$ph);preg_match_all("~$Uf~",$B[5],$Qh);$I[idf_unescape($B[1])]=array("db"=>idf_unescape($B[4]!=""?$B[3]:$B[4]),"table"=>idf_unescape($B[4]!=""?$B[4]:$B[3]),"source"=>array_map('idf_unescape',$ph[0]),"target"=>array_map('idf_unescape',$Qh[0]),"on_delete"=>($B[6]?$B[6]:"RESTRICT"),"on_update"=>($B[7]?$B[7]:"RESTRICT"),);}}return$I;}function
view($C){global$g;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$g->result("SHOW CREATE VIEW ".table($C),1)));}function
collations(){$I=array();foreach(get_rows("SHOW COLLATION")as$J){if($J["Default"])$I[$J["Charset"]][-1]=$J["Collation"];else$I[$J["Charset"]][]=$J["Collation"];}ksort($I);foreach($I
as$y=>$X)asort($I[$y]);return$I;}function
information_schema($l){return(min_version(5)&&$l=="information_schema")||(min_version(5.5)&&$l=="performance_schema");}function
error(){global$g;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$g->error));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" COLLATE ".q($d):""));}function
drop_databases($k){$I=apply_queries("DROP DATABASE",$k,'idf_escape');restart_session();set_session("dbs",null);return$I;}function
rename_database($C,$d){$I=false;if(create_database($C,$d)){$Eg=array();foreach(tables_list()as$R=>$U)$Eg[]=table($R)." TO ".idf_escape($C).".".table($R);$I=(!$Eg||queries("RENAME TABLE ".implode(", ",$Eg)));if($I)queries("DROP DATABASE ".idf_escape(DB));restart_session();set_session("dbs",null);}return$I;}function
auto_increment(){$Ma=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$v){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$v["columns"],true)){$Ma="";break;}if($v["type"]=="PRIMARY")$Ma=" UNIQUE";}}return" AUTO_INCREMENT$Ma";}function
alter_table($R,$C,$p,$bd,$tb,$tc,$d,$La,$Of){$c=array();foreach($p
as$o)$c[]=($o[1]?($R!=""?($o[0]!=""?"CHANGE ".idf_escape($o[0]):"ADD"):" ")." ".implode($o[1]).($R!=""?$o[2]:""):"DROP ".idf_escape($o[0]));$c=array_merge($c,$bd);$P=($tb!==null?" COMMENT=".q($tb):"").($tc?" ENGINE=".q($tc):"").($d?" COLLATE ".q($d):"").($La!=""?" AUTO_INCREMENT=$La":"");if($R=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)$P$Of");if($R!=$C)$c[]="RENAME TO ".table($C);if($P)$c[]=ltrim($P);return($c||$Of?queries("ALTER TABLE ".table($R)."\n".implode(",\n",$c).$Of):true);}function
alter_indexes($R,$c){foreach($c
as$y=>$X)$c[$y]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($R).implode(",",$c));}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Ti){return
queries("DROP VIEW ".implode(", ",array_map('table',$Ti)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('table',$T)));}function
move_tables($T,$Ti,$Qh){$Eg=array();foreach(array_merge($T,$Ti)as$R)$Eg[]=table($R)." TO ".idf_escape($Qh).".".table($R);return
queries("RENAME TABLE ".implode(", ",$Eg));}function
copy_tables($T,$Ti,$Qh){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($T
as$R){$C=($Qh==DB?table("copy_$R"):idf_escape($Qh).".".table($R));if(!queries("\nDROP TABLE IF EXISTS $C")||!queries("CREATE TABLE $C LIKE ".table($R))||!queries("INSERT INTO $C SELECT * FROM ".table($R)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$J){$qi=$J["Trigger"];if(!queries("CREATE TRIGGER ".($Qh==DB?idf_escape("copy_$qi"):idf_escape($Qh).".".idf_escape($qi))." $J[Timing] $J[Event] ON $C FOR EACH ROW\n$J[Statement];"))return
false;}}foreach($Ti
as$R){$C=($Qh==DB?table("copy_$R"):idf_escape($Qh).".".table($R));$Si=view($R);if(!queries("DROP VIEW IF EXISTS $C")||!queries("CREATE VIEW $C AS $Si[select]"))return
false;}return
true;}function
trigger($C){if($C=="")return
array();$K=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($C));return
reset($K);}function
triggers($R){$I=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$J)$I[$J["Trigger"]]=array($J["Timing"],$J["Event"]);return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($C,$U){global$g,$vc,$Od,$wi;$Ca=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$qh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$vi="((".implode("|",array_merge(array_keys($wi),$Ca)).")\\b(?:\\s*\\(((?:[^'\")]|$vc)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Uf="$qh*(".($U=="FUNCTION"?"":$Od).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$vi";$i=$g->result("SHOW CREATE $U ".idf_escape($C),2);preg_match("~\\(((?:$Uf\\s*,?)*)\\)\\s*".($U=="FUNCTION"?"RETURNS\\s+$vi\\s+":"")."(.*)~is",$i,$B);$p=array();preg_match_all("~$Uf\\s*,?~is",$B[1],$_e,PREG_SET_ORDER);foreach($_e
as$Hf){$C=str_replace("``","`",$Hf[2]).$Hf[3];$p[]=array("field"=>$C,"type"=>strtolower($Hf[5]),"length"=>preg_replace_callback("~$vc~s",'normalize_enum',$Hf[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Hf[8] $Hf[7]"))),"null"=>1,"full_type"=>$Hf[4],"inout"=>strtoupper($Hf[1]),"collation"=>strtolower($Hf[9]),);}if($U!="FUNCTION")return
array("fields"=>$p,"definition"=>$B[11]);return
array("fields"=>$p,"returns"=>array("type"=>$B[12],"length"=>$B[13],"unsigned"=>$B[15],"collation"=>$B[16]),"definition"=>$B[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($C,$J){return
idf_escape($C);}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ID()");}function
explain($g,$G){return$g->query("EXPLAIN ".(min_version(5.1)?"PARTITIONS ":"").$G);}function
found_rows($S,$Z){return($Z||$S["Engine"]!="InnoDB"?null:$S["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Ug){return
true;}function
create_sql($R,$La,$Bh){global$g;$I=$g->result("SHOW CREATE TABLE ".table($R),1);if(!$La)$I=preg_replace('~ AUTO_INCREMENT=\d+~','',$I);return$I;}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
use_sql($j){return"USE ".idf_escape($j);}function
trigger_sql($R){$I="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")),null,"-- ")as$J)$I.="\nCREATE TRIGGER ".idf_escape($J["Trigger"])." $J[Timing] $J[Event] ON ".table($J["Table"])." FOR EACH ROW\n$J[Statement];;\n";return$I;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($o){if(preg_match("~binary~",$o["type"]))return"HEX(".idf_escape($o["field"]).")";if($o["type"]=="bit")return"BIN(".idf_escape($o["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($o["field"]).")";}function
unconvert_field($o,$I){if(preg_match("~binary~",$o["type"]))$I="UNHEX($I)";if($o["type"]=="bit")$I="CONV($I, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))$I=(min_version(8)?"ST_":"")."GeomFromText($I)";return$I;}function
support($Oc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view"))."~",$Oc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$g;return$g->result("SELECT @@max_connections");}$x="sql";$wi=array();$Ah=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),'Date and time'=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),'Strings'=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),'Lists'=>array("enum"=>65535,"set"=>64),'Binary'=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),'Geometry'=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$y=>$X){$wi+=$X;$Ah[$y]=array_keys($X);}$Ci=array("unsigned","zerofill","unsigned zerofill");$pf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$jd=array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper");$pd=array("avg","count","count distinct","group_concat","max","min","sum");$lc=array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",));}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~^[^?]*/([^?]*).*~','\1',$_SERVER["REQUEST_URI"]).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ia="4.6.3";class
Adminer{var$operators;function
name(){return"<a href='https://www.adminer.org/'".target_blank()." id='h1'>Adminer</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($i=false){return
password_file($i);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($N){return
h($N);}function
database(){return
DB;}function
databases($Zc=true){return
get_databases($Zc);}function
schemas(){return
schemas();}function
queryTimeout(){return
2;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$I=array();$Tc="adminer.css";if(file_exists($Tc))$I[]=$Tc;return$I;}function
loginForm(){global$dc;echo"<table cellspacing='0'>\n",$this->loginFormField('driver','<tr><th>'.'System'.'<td>',html_select("auth[driver]",$dc,DRIVER)."\n"),$this->loginFormField('server','<tr><th>'.'Server'.'<td>','<input name="auth[server]" value="'.h(SERVER).'" title="hostname[:port]" placeholder="localhost" autocapitalize="off">'."\n"),$this->loginFormField('username','<tr><th>'.'Username'.'<td>','<input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocapitalize="off">'.script("focus(qs('#username'));")),$this->loginFormField('password','<tr><th>'.'Password'.'<td>','<input type="password" name="auth[password]">'."\n"),$this->loginFormField('db','<tr><th>'.'Database'.'<td>','<input name="auth[db]" value="'.h($_GET["db"]).'" autocapitalize="off">'."\n"),"</table>\n","<p><input type='submit' value='".'Login'."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],'Permanent login')."\n";}function
loginFormField($C,$wd,$Y){return$wd.$Y;}function
login($ue,$F){if($F=="")return
sprintf('Adminer does not support accessing a database without a password, <a href="https://www.adminer.org/en/password/"%s>more information</a>.',target_blank());return
true;}function
tableName($Hh){return
h($Hh["Name"]);}function
fieldName($o,$uf=0){return'<span title="'.h($o["full_type"]).'">'.h($o["field"]).'</span>';}function
selectLinks($Hh,$O=""){global$x,$m;echo'<p class="links">';$te=array("select"=>'Select data');if(support("table")||support("indexes"))$te["table"]='Show structure';if(support("table")){if(is_view($Hh))$te["view"]='Alter view';else$te["create"]='Alter table';}if($O!==null)$te["edit"]='New item';$C=$Hh["Name"];foreach($te
as$y=>$X)echo" <a href='".h(ME)."$y=".urlencode($C).($y=="edit"?$O:"")."'".bold(isset($_GET[$y])).">$X</a>";echo
doc_link(array($x=>$m->tableHelp($C)),"?"),"\n";}function
foreignKeys($R){return
foreign_keys($R);}function
backwardKeys($R,$Gh){return
array();}function
backwardKeysPrint($Oa,$J){}function
selectQuery($G,$xh,$Mc=false){global$x,$m;$I="</p>\n";if(!$Mc&&($Wi=$m->warnings())){$t="warnings";$I=", <a href='#$t'>".'Warnings'."</a>".script("qsl('a').onclick = partial(toggle, '$t');","")."$I<div id='$t' class='hidden'>\n$Wi</div>\n";}return"<p><code class='jush-$x'>".h(str_replace("\n"," ",$G))."</code> <span class='time'>(".format_time($xh).")</span>".(support("sql")?" <a href='".h(ME)."sql=".urlencode($G)."'>".'Edit'."</a>":"").$I;}function
sqlCommandQuery($G){return
shorten_utf8(trim($G),1000);}function
rowDescription($R){return"";}function
rowDescriptions($K,$cd){return$K;}function
selectLink($X,$o){}function
selectVal($X,$_,$o,$Bf){$I=($X===null?"<i>NULL</i>":(preg_match("~char|binary|boolean~",$o["type"])&&!preg_match("~var~",$o["type"])?"<code>$X</code>":$X));if(preg_match('~blob|bytea|raw|file~',$o["type"])&&!is_utf8($X))$I="<i>".lang(array('%d byte','%d bytes'),strlen($Bf))."</i>";if(preg_match('~json~',$o["type"]))$I="<code class='jush-js'>$I</code>";return($_?"<a href='".h($_)."'".(is_url($_)?target_blank():"").">$I</a>":$I);}function
editVal($X,$o){return$X;}function
tableStructurePrint($p){echo"<table cellspacing='0' class='nowrap'>\n","<thead><tr><th>".'Column'."<td>".'Type'.(support("comment")?"<td>".'Comment':"")."</thead>\n";foreach($p
as$o){echo"<tr".odd()."><th>".h($o["field"]),"<td><span title='".h($o["collation"])."'>".h($o["full_type"])."</span>",($o["null"]?" <i>NULL</i>":""),($o["auto_increment"]?" <i>".'Auto Increment'."</i>":""),(isset($o["default"])?" <span title='".'Default value'."'>[<b>".h($o["default"])."</b>]</span>":""),(support("comment")?"<td>".h($o["comment"]):""),"\n";}echo"</table>\n";}function
tableIndexesPrint($w){echo"<table cellspacing='0'>\n";foreach($w
as$C=>$v){ksort($v["columns"]);$gg=array();foreach($v["columns"]as$y=>$X)$gg[]="<i>".h($X)."</i>".($v["lengths"][$y]?"(".$v["lengths"][$y].")":"").($v["descs"][$y]?" DESC":"");echo"<tr title='".h($C)."'><th>$v[type]<td>".implode(", ",$gg)."\n";}echo"</table>\n";}function
selectColumnsPrint($L,$f){global$jd,$pd;print_fieldset("select",'Select',$L);$s=0;$L[""]=array();foreach($L
as$y=>$X){$X=$_GET["columns"][$y];$e=select_input(" name='columns[$s][col]'",$f,$X["col"],($y!==""?"selectFieldChange":"selectAddRow"));echo"<div>".($jd||$pd?"<select name='columns[$s][fun]'>".optionlist(array(-1=>"")+array_filter(array('Functions'=>$jd,'Aggregation'=>$pd)),$X["fun"])."</select>".on_help("getTarget(event).value && getTarget(event).value.replace(/ |\$/, '(') + ')'",1).script("qsl('select').onchange = function () { helpClose();".($y!==""?"":" qsl('select, input', this.parentNode).onchange();")." };","")."($e)":$e)."</div>\n";$s++;}echo"</div></fieldset>\n";}function
selectSearchPrint($Z,$f,$w){print_fieldset("search",'Search',$Z);foreach($w
as$s=>$v){if($v["type"]=="FULLTEXT"){echo"<div>(<i>".implode("</i>, <i>",array_map('h',$v["columns"]))."</i>) AGAINST"," <input type='search' name='fulltext[$s]' value='".h($_GET["fulltext"][$s])."'>",script("qsl('input').oninput = selectFieldChange;",""),checkbox("boolean[$s]",1,isset($_GET["boolean"][$s]),"BOOL"),"</div>\n";}}$ab="this.parentNode.firstChild.onchange();";foreach(array_merge((array)$_GET["where"],array(array()))as$s=>$X){if(!$X||("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators))){echo"<div>".select_input(" name='where[$s][col]'",$f,$X["col"],($X?"selectFieldChange":"selectAddRow"),"(".'anywhere'.")"),html_select("where[$s][op]",$this->operators,$X["op"],$ab),"<input type='search' name='where[$s][val]' value='".h($X["val"])."'>",script("mixin(qsl('input'), {oninput: function () { $ab }, onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});",""),"</div>\n";}}echo"</div></fieldset>\n";}function
selectOrderPrint($uf,$f,$w){print_fieldset("sort",'Sort',$uf);$s=0;foreach((array)$_GET["order"]as$y=>$X){if($X!=""){echo"<div>".select_input(" name='order[$s]'",$f,$X,"selectFieldChange"),checkbox("desc[$s]",1,isset($_GET["desc"][$y]),'descending')."</div>\n";$s++;}}echo"<div>".select_input(" name='order[$s]'",$f,"","selectAddRow"),checkbox("desc[$s]",1,false,'descending')."</div>\n","</div></fieldset>\n";}function
selectLimitPrint($z){echo"<fieldset><legend>".'Limit'."</legend><div>";echo"<input type='number' name='limit' class='size' value='".h($z)."'>",script("qsl('input').oninput = selectFieldChange;",""),"</div></fieldset>\n";}function
selectLengthPrint($Wh){if($Wh!==null){echo"<fieldset><legend>".'Text length'."</legend><div>","<input type='number' name='text_length' class='size' value='".h($Wh)."'>","</div></fieldset>\n";}}function
selectActionPrint($w){echo"<fieldset><legend>".'Action'."</legend><div>","<input type='submit' value='".'Select'."'>"," <span id='noindex' title='".'Full table scan'."'></span>","<script".nonce().">\n","var indexColumns = ";$f=array();foreach($w
as$v){$Jb=reset($v["columns"]);if($v["type"]!="FULLTEXT"&&$Jb)$f[$Jb]=1;}$f[""]=1;foreach($f
as$y=>$X)json_row($y);echo";\n","selectFieldChange.call(qs('#form')['select']);\n","</script>\n","</div></fieldset>\n";}function
selectCommandPrint(){return!information_schema(DB);}function
selectImportPrint(){return!information_schema(DB);}function
selectEmailPrint($qc,$f){}function
selectColumnsProcess($f,$w){global$jd,$pd;$L=array();$md=array();foreach((array)$_GET["columns"]as$y=>$X){if($X["fun"]=="count"||($X["col"]!=""&&(!$X["fun"]||in_array($X["fun"],$jd)||in_array($X["fun"],$pd)))){$L[$y]=apply_sql_function($X["fun"],($X["col"]!=""?idf_escape($X["col"]):"*"));if(!in_array($X["fun"],$pd))$md[]=$L[$y];}}return
array($L,$md);}function
selectSearchProcess($p,$w){global$g,$m;$I=array();foreach($w
as$s=>$v){if($v["type"]=="FULLTEXT"&&$_GET["fulltext"][$s]!="")$I[]="MATCH (".implode(", ",array_map('idf_escape',$v["columns"])).") AGAINST (".q($_GET["fulltext"][$s]).(isset($_GET["boolean"][$s])?" IN BOOLEAN MODE":"").")";}foreach((array)$_GET["where"]as$y=>$X){if("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators)){$cg="";$vb=" $X[op]";if(preg_match('~IN$~',$X["op"])){$Ed=process_length($X["val"]);$vb.=" ".($Ed!=""?$Ed:"(NULL)");}elseif($X["op"]=="SQL")$vb=" $X[val]";elseif($X["op"]=="LIKE %%")$vb=" LIKE ".$this->processInput($p[$X["col"]],"%$X[val]%");elseif($X["op"]=="ILIKE %%")$vb=" ILIKE ".$this->processInput($p[$X["col"]],"%$X[val]%");elseif($X["op"]=="FIND_IN_SET"){$cg="$X[op](".q($X["val"]).", ";$vb=")";}elseif(!preg_match('~NULL$~',$X["op"]))$vb.=" ".$this->processInput($p[$X["col"]],$X["val"]);if($X["col"]!="")$I[]=$cg.$m->convertSearch(idf_escape($X["col"]),$X,$p[$X["col"]]).$vb;else{$qb=array();foreach($p
as$C=>$o){if((preg_match('~^[-\d.'.(preg_match('~IN$~',$X["op"])?',':'').']+$~',$X["val"])||!preg_match('~'.number_type().'|bit~',$o["type"]))&&(!preg_match("~[\x80-\xFF]~",$X["val"])||preg_match('~char|text|enum|set~',$o["type"])))$qb[]=$cg.$m->convertSearch(idf_escape($C),$X,$o).$vb;}$I[]=($qb?"(".implode(" OR ",$qb).")":"1 = 0");}}}return$I;}function
selectOrderProcess($p,$w){$I=array();foreach((array)$_GET["order"]as$y=>$X){if($X!="")$I[]=(preg_match('~^((COUNT\(DISTINCT |[A-Z0-9_]+\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\)|COUNT\(\*\))$~',$X)?$X:idf_escape($X)).(isset($_GET["desc"][$y])?" DESC":"");}return$I;}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return(isset($_GET["text_length"])?$_GET["text_length"]:"100");}function
selectEmailProcess($Z,$cd){return
false;}function
selectQueryBuild($L,$Z,$md,$uf,$z,$E){return"";}function
messageQuery($G,$Xh,$Mc=false){global$x,$m;restart_session();$xd=&get_session("queries");if(!$xd[$_GET["db"]])$xd[$_GET["db"]]=array();if(strlen($G)>1e6)$G=preg_replace('~[\x80-\xFF]+$~','',substr($G,0,1e6))."\n...";$xd[$_GET["db"]][]=array($G,time(),$Xh);$uh="sql-".count($xd[$_GET["db"]]);$I="<a href='#$uh' class='toggle'>".'SQL command'."</a>\n";if(!$Mc&&($Wi=$m->warnings())){$t="warnings-".count($xd[$_GET["db"]]);$I="<a href='#$t' class='toggle'>".'Warnings'."</a>, $I<div id='$t' class='hidden'>\n$Wi</div>\n";}return" <span class='time'>".@date("H:i:s")."</span>"." $I<div id='$uh' class='hidden'><pre><code class='jush-$x'>".shorten_utf8($G,1000)."</code></pre>".($Xh?" <span class='time'>($Xh)</span>":'').(support("sql")?'<p><a href="'.h(str_replace("db=".urlencode(DB),"db=".urlencode($_GET["db"]),ME).'sql=&history='.(count($xd[$_GET["db"]])-1)).'">'.'Edit'.'</a>':'').'</div>';}function
editFunctions($o){global$lc;$I=($o["null"]?"NULL/":"");foreach($lc
as$y=>$jd){if(!$y||(!isset($_GET["call"])&&(isset($_GET["select"])||where($_GET)))){foreach($jd
as$Uf=>$X){if(!$Uf||preg_match("~$Uf~",$o["type"]))$I.="/$X";}if($y&&!preg_match('~set|blob|bytea|raw|file~',$o["type"]))$I.="/SQL";}}if($o["auto_increment"]&&!isset($_GET["select"])&&!where($_GET))$I='Auto Increment';return
explode("/",$I);}function
editInput($R,$o,$Ja,$Y){if($o["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Ja value='-1' checked><i>".'original'."</i></label> ":"").($o["null"]?"<label><input type='radio'$Ja value=''".($Y!==null||isset($_GET["select"])?"":" checked")."><i>NULL</i></label> ":"").enum_input("radio",$Ja,$o,$Y,0);return"";}function
editHint($R,$o,$Y){return"";}function
processInput($o,$Y,$r=""){if($r=="SQL")return$Y;$C=$o["field"];$I=q($Y);if(preg_match('~^(now|getdate|uuid)$~',$r))$I="$r()";elseif(preg_match('~^current_(date|timestamp)$~',$r))$I=$r;elseif(preg_match('~^([+-]|\|\|)$~',$r))$I=idf_escape($C)." $r $I";elseif(preg_match('~^[+-] interval$~',$r))$I=idf_escape($C)." $r ".(preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+\$~i",$Y)?$Y:$I);elseif(preg_match('~^(addtime|subtime|concat)$~',$r))$I="$r(".idf_escape($C).", $I)";elseif(preg_match('~^(md5|sha1|password|encrypt)$~',$r))$I="$r($I)";return
unconvert_field($o,$I);}function
dumpOutput(){$I=array('text'=>'open','file'=>'save');if(function_exists('gzencode'))$I['gz']='gzip';return$I;}function
dumpFormat(){return
array('sql'=>'SQL','csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($l){}function
dumpTable($R,$Bh,$Xd=0){if($_POST["format"]!="sql"){echo"\xef\xbb\xbf";if($Bh)dump_csv(array_keys(fields($R)));}else{if($Xd==2){$p=array();foreach(fields($R)as$C=>$o)$p[]=idf_escape($C)." $o[full_type]";$i="CREATE TABLE ".table($R)." (".implode(", ",$p).")";}else$i=create_sql($R,$_POST["auto_increment"],$Bh);set_utf8mb4($i);if($Bh&&$i){if($Bh=="DROP+CREATE"||$Xd==1)echo"DROP ".($Xd==2?"VIEW":"TABLE")." IF EXISTS ".table($R).";\n";if($Xd==1)$i=remove_definer($i);echo"$i;\n\n";}}}function
dumpData($R,$Bh,$G){global$g,$x;$Be=($x=="sqlite"?0:1048576);if($Bh){if($_POST["format"]=="sql"){if($Bh=="TRUNCATE+INSERT")echo
truncate_sql($R).";\n";$p=fields($R);}$H=$g->query($G,1);if($H){$Qd="";$Xa="";$ee=array();$Dh="";$Pc=($R!=''?'fetch_assoc':'fetch_row');while($J=$H->$Pc()){if(!$ee){$Oi=array();foreach($J
as$X){$o=$H->fetch_field();$ee[]=$o->name;$y=idf_escape($o->name);$Oi[]="$y = VALUES($y)";}$Dh=($Bh=="INSERT+UPDATE"?"\nON DUPLICATE KEY UPDATE ".implode(", ",$Oi):"").";\n";}if($_POST["format"]!="sql"){if($Bh=="table"){dump_csv($ee);$Bh="INSERT";}dump_csv($J);}else{if(!$Qd)$Qd="INSERT INTO ".table($R)." (".implode(", ",array_map('idf_escape',$ee)).") VALUES";foreach($J
as$y=>$X){$o=$p[$y];$J[$y]=($X!==null?unconvert_field($o,preg_match(number_type(),$o["type"])&&$X!=''?$X:q(($X===false?0:$X))):"NULL");}$Sg=($Be?"\n":" ")."(".implode(",\t",$J).")";if(!$Xa)$Xa=$Qd.$Sg;elseif(strlen($Xa)+4+strlen($Sg)+strlen($Dh)<$Be)$Xa.=",$Sg";else{echo$Xa.$Dh;$Xa=$Qd.$Sg;}}}if($Xa)echo$Xa.$Dh;}elseif($_POST["format"]=="sql")echo"-- ".str_replace("\n"," ",$g->error)."\n";}}function
dumpFilename($Bd){return
friendly_url($Bd!=""?$Bd:(SERVER!=""?SERVER:"localhost"));}function
dumpHeaders($Bd,$Qe=false){$Ef=$_POST["output"];$Hc=(preg_match('~sql~',$_POST["format"])?"sql":($Qe?"tar":"csv"));header("Content-Type: ".($Ef=="gz"?"application/x-gzip":($Hc=="tar"?"application/x-tar":($Hc=="sql"||$Ef!="file"?"text/plain":"text/csv")."; charset=utf-8")));if($Ef=="gz")ob_start('ob_gzencode',1e6);return$Hc;}function
importServerPath(){return"adminer.sql";}function
homepage(){echo'<p class="links">'.($_GET["ns"]==""&&support("database")?'<a href="'.h(ME).'database=">'.'Alter database'."</a>\n":""),(support("scheme")?"<a href='".h(ME)."scheme='>".($_GET["ns"]!=""?'Alter schema':'Create schema')."</a>\n":""),($_GET["ns"]!==""?'<a href="'.h(ME).'schema=">'.'Database schema'."</a>\n":""),(support("privileges")?"<a href='".h(ME)."privileges='>".'Privileges'."</a>\n":"");return
true;}function
navigation($Pe){global$ia,$x,$dc,$g;echo'<h1>
',$this->name(),' <span class="version">',$ia,'</span>
<a href="https://www.adminer.org/#download"',target_blank(),' id="version">',(version_compare($ia,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Pe=="auth"){$Vc=true;foreach((array)$_SESSION["pwds"]as$Qi=>$gh){foreach($gh
as$N=>$Li){foreach($Li
as$V=>$F){if($F!==null){if($Vc){echo"<p id='logins'>".script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$Vc=false;}$Pb=$_SESSION["db"][$Qi][$N][$V];foreach(($Pb?array_keys($Pb):array(""))as$l)echo"<a href='".h(auth_url($Qi,$N,$V,$l))."'>($dc[$Qi]) ".h($V.($N!=""?"@".$this->serverName($N):"").($l!=""?" - $l":""))."</a><br>\n";}}}}}else{if($_GET["ns"]!==""&&!$Pe&&DB!=""){$g->select_db(DB);$T=table_status('',true);}echo
script_src(preg_replace("~\\?.*~","",ME)."?file=jush.js&version=4.6.3");if(support("sql")){echo'<script',nonce(),'>
';if($T){$te=array();foreach($T
as$R=>$U)$te[]=preg_quote($R,'/');echo"var jushLinks = { $x: [ '".js_escape(ME).(support("table")?"table=":"select=")."\$&', /\\b(".implode("|",$te).")\\b/g ] };\n";foreach(array("bac","bra","sqlite_quo","mssql_bra")as$X)echo"jushLinks.$X = jushLinks.$x;\n";}$fh=$g->server_info;echo'bodyLoad(\'',(is_object($g)?preg_replace('~^(\d\.?\d).*~s','\1',$fh):""),'\'',(preg_match('~MariaDB~',$fh)?", true":""),');
</script>
';}$this->databasesPrint($Pe);if(DB==""||!$Pe){echo"<p class='links'>".(support("sql")?"<a href='".h(ME)."sql='".bold(isset($_GET["sql"])&&!isset($_GET["import"])).">".'SQL command'."</a>\n<a href='".h(ME)."import='".bold(isset($_GET["import"])).">".'Import'."</a>\n":"")."";if(support("dump"))echo"<a href='".h(ME)."dump=".urlencode(isset($_GET["table"])?$_GET["table"]:$_GET["select"])."' id='dump'".bold(isset($_GET["dump"])).">".'Export'."</a>\n";}if($_GET["ns"]!==""&&!$Pe&&DB!=""){echo'<a href="'.h(ME).'create="'.bold($_GET["create"]==="").">".'Create table'."</a>\n";if(!$T)echo"<p class='message'>".'No tables.'."\n";else$this->tablesPrint($T);}}}function
databasesPrint($Pe){global$b,$g;$k=$this->databases();if($k&&!in_array(DB,$k))array_unshift($k,DB);echo'<form action="">
<p id="dbs">
';hidden_fields_get();$Nb=script("mixin(qsl('select'), {onmousedown: dbMouseDown, onchange: dbChange});");echo"<span title='".'database'."'>".'DB'."</span>: ".($k?"<select name='db'>".optionlist(array(""=>"")+$k,DB)."</select>$Nb":"<input name='db' value='".h(DB)."' autocapitalize='off'>\n"),"<input type='submit' value='".'Use'."'".($k?" class='hidden'":"").">\n";if($Pe!="db"&&DB!=""&&$g->select_db(DB)){if(support("scheme")){echo"<br>".'Schema'.": <select name='ns'>".optionlist(array(""=>"")+$b->schemas(),$_GET["ns"])."</select>$Nb";if($_GET["ns"]!="")set_schema($_GET["ns"]);}}foreach(array("import","sql","schema","dump","privileges")as$X){if(isset($_GET[$X])){echo"<input type='hidden' name='$X' value=''>";break;}}echo"</p></form>\n";}function
tablesPrint($T){echo"<ul id='tables'>".script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($T
as$R=>$P){$C=$this->tableName($P);if($C!=""){echo'<li><a href="'.h(ME).'select='.urlencode($R).'"'.bold($_GET["select"]==$R||$_GET["edit"]==$R,"select").">".'select'."</a> ",(support("table")||support("indexes")?'<a href="'.h(ME).'table='.urlencode($R).'"'.bold(in_array($R,array($_GET["table"],$_GET["create"],$_GET["indexes"],$_GET["foreign"],$_GET["trigger"])),(is_view($P)?"view":"structure"))." title='".'Show structure'."'>$C</a>":"<span>$C</span>")."\n";}}echo"</ul>\n";}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);if($b->operators===null)$b->operators=$pf;function
page_header($ai,$n="",$Wa=array(),$bi=""){global$ca,$ia,$b,$dc,$x;page_headers();if(is_ajax()&&$n){page_messages($n);exit;}$ci=$ai.($bi!=""?": $bi":"");$di=strip_tags($ci.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$di,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.6.3"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.6.3");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.6.3"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.6.3"),'">
';foreach($b->css()as$Hb){echo'<link rel="stylesheet" type="text/css" href="',h($Hb),'">
';}}echo'
<body class="ltr nojs">
';$Tc=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($Tc)&&filemtime($Tc)+86400>time()){$Ri=unserialize(file_get_contents($Tc));$ng="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Ri["version"],base64_decode($Ri["signature"]),$ng)==1)$_COOKIE["adminer_version"]=$Ri["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ia', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape('You are offline.'),'\';
var thousandsSeparator = \'',js_escape(','),'\';
</script>

<div id="help" class="jush-',$x,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Wa!==null){$_=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($_?$_:".").'">'.$dc[DRIVER].'</a> &raquo; ';$_=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$N=$b->serverName(SERVER);$N=($N!=""?$N:'Server');if($Wa===false)echo"$N\n";else{echo"<a href='".($_?h($_):".")."' accesskey='1' title='Alt+Shift+1'>$N</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Wa)))echo'<a href="'.h($_."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Wa)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Wa
as$y=>$X){$Vb=(is_array($X)?$X[1]:h($X));if($Vb!="")echo"<a href='".h(ME."$y=").urlencode(is_array($X)?$X[0]:$X)."'>$Vb</a> &raquo; ";}}echo"$ai\n";}}echo"<h2>$ci</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($n);$k=&get_session("dbs");if(DB!=""&&$k&&!in_array(DB,$k,true))$k=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$Gb){$vd=array();foreach($Gb
as$y=>$X)$vd[]="$y $X";header("Content-Security-Policy: ".implode("; ",$vd));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$Ze;if(!$Ze)$Ze=base64_encode(rand_string());return$Ze;}function
page_messages($n){$Ei=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Le=$_SESSION["messages"][$Ei];if($Le){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Le)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Ei]);}if($n)echo"<div class='error'>$n</div>\n";}function
page_footer($Pe=""){global$b,$hi;echo'</div>

';if($Pe!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="Logout" id="logout">
<input type="hidden" name="token" value="',$hi,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Pe);echo'</div>
',script("setupSubmitHighlight(document);");}function
int32($Se){while($Se>=2147483648)$Se-=4294967296;while($Se<=-2147483649)$Se+=4294967296;return(int)$Se;}function
long2str($W,$Vi){$Sg='';foreach($W
as$X)$Sg.=pack('V',$X);if($Vi)return
substr($Sg,0,end($W));return$Sg;}function
str2long($Sg,$Vi){$W=array_values(unpack('V*',str_pad($Sg,4*ceil(strlen($Sg)/4),"\0")));if($Vi)$W[]=strlen($Sg);return$W;}function
xxtea_mx($ij,$hj,$Eh,$ae){return
int32((($ij>>5&0x7FFFFFF)^$hj<<2)+(($hj>>3&0x1FFFFFFF)^$ij<<4))^int32(($Eh^$hj)+($ae^$ij));}function
encrypt_string($_h,$y){if($_h=="")return"";$y=array_values(unpack("V*",pack("H*",md5($y))));$W=str2long($_h,true);$Se=count($W)-1;$ij=$W[$Se];$hj=$W[0];$og=floor(6+52/($Se+1));$Eh=0;while($og-->0){$Eh=int32($Eh+0x9E3779B9);$kc=$Eh>>2&3;for($Ff=0;$Ff<$Se;$Ff++){$hj=$W[$Ff+1];$Re=xxtea_mx($ij,$hj,$Eh,$y[$Ff&3^$kc]);$ij=int32($W[$Ff]+$Re);$W[$Ff]=$ij;}$hj=$W[0];$Re=xxtea_mx($ij,$hj,$Eh,$y[$Ff&3^$kc]);$ij=int32($W[$Se]+$Re);$W[$Se]=$ij;}return
long2str($W,false);}function
decrypt_string($_h,$y){if($_h=="")return"";if(!$y)return
false;$y=array_values(unpack("V*",pack("H*",md5($y))));$W=str2long($_h,false);$Se=count($W)-1;$ij=$W[$Se];$hj=$W[0];$og=floor(6+52/($Se+1));$Eh=int32($og*0x9E3779B9);while($Eh){$kc=$Eh>>2&3;for($Ff=$Se;$Ff>0;$Ff--){$ij=$W[$Ff-1];$Re=xxtea_mx($ij,$hj,$Eh,$y[$Ff&3^$kc]);$hj=int32($W[$Ff]-$Re);$W[$Ff]=$hj;}$ij=$W[$Se];$Re=xxtea_mx($ij,$hj,$Eh,$y[$Ff&3^$kc]);$hj=int32($W[0]-$Re);$W[0]=$hj;$Eh=int32($Eh-0x9E3779B9);}return
long2str($W,true);}$g='';$ud=$_SESSION["token"];if(!$ud)$_SESSION["token"]=rand(1,1e6);$hi=get_token();$Vf=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($y)=explode(":",$X);$Vf[$y]=$X;}}function
add_invalid_login(){global$b;$hd=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$hd)return;$Td=unserialize(stream_get_contents($hd));$Xh=time();if($Td){foreach($Td
as$Ud=>$X){if($X[0]<$Xh)unset($Td[$Ud]);}}$Sd=&$Td[$b->bruteForceKey()];if(!$Sd)$Sd=array($Xh+30*60,0);$Sd[1]++;file_write_unlock($hd,serialize($Td));}function
check_invalid_login(){global$b;$Td=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$Sd=$Td[$b->bruteForceKey()];$Ye=($Sd[1]>29?$Sd[0]-time():0);if($Ye>0)auth_error(lang(array('Too many unsuccessful logins, try again in %d minute.','Too many unsuccessful logins, try again in %d minutes.'),ceil($Ye/60)));}$Ka=$_POST["auth"];if($Ka){session_regenerate_id();$Qi=$Ka["driver"];$N=$Ka["server"];$V=$Ka["username"];$F=(string)$Ka["password"];$l=$Ka["db"];set_password($Qi,$N,$V,$F);$_SESSION["db"][$Qi][$N][$V][$l]=true;if($Ka["permanent"]){$y=base64_encode($Qi)."-".base64_encode($N)."-".base64_encode($V)."-".base64_encode($l);$hg=$b->permanentLogin(true);$Vf[$y]="$y:".base64_encode($hg?encrypt_string($F,$hg):"");cookie("adminer_permanent",implode(" ",$Vf));}if(count($_POST)==1||DRIVER!=$Qi||SERVER!=$N||$_GET["username"]!==$V||DB!=$l)redirect(auth_url($Qi,$N,$V,$l));}elseif($_POST["logout"]){if($ud&&!verify_token()){page_header('Logout','Invalid CSRF token. Send the form again.');page_footer("db");exit;}else{foreach(array("pwds","db","dbs","queries")as$y)set_session($y,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),'Logout successful.'.' '.sprintf('Thanks for using Adminer, consider <a href="%s">donating</a>.','https://sourceforge.net/donate/index.php?group_id=264133'));}}elseif($Vf&&!$_SESSION["pwds"]){session_regenerate_id();$hg=$b->permanentLogin();foreach($Vf
as$y=>$X){list(,$ib)=explode(":",$X);list($Qi,$N,$V,$l)=array_map('base64_decode',explode("-",$y));set_password($Qi,$N,$V,decrypt_string(base64_decode($ib),$hg));$_SESSION["db"][$Qi][$N][$V][$l]=true;}}function
unset_permanent(){global$Vf;foreach($Vf
as$y=>$X){list($Qi,$N,$V,$l)=array_map('base64_decode',explode("-",$y));if($Qi==DRIVER&&$N==SERVER&&$V==$_GET["username"]&&$l==DB)unset($Vf[$y]);}cookie("adminer_permanent",implode(" ",$Vf));}function
auth_error($n){global$b,$ud;$hh=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$hh]||$_GET[$hh])&&!$ud)$n='Session expired, please login again.';else{restart_session();add_invalid_login();$F=get_password();if($F!==null){if($F===false)$n.='<br>'.sprintf('Master password expired. <a href="https://www.adminer.org/en/extension/"%s>Implement</a> %s method to make it permanent.',target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$hh]&&$_GET[$hh]&&ini_bool("session.use_only_cookies"))$n='Session support must be enabled.';$If=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$If["lifetime"]);page_header('Login',$n,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".'The action will be performed after successful login with the same credentials.'."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header('No extension',sprintf('None of the supported PHP extensions (%s) are available.',implode(", ",$bg)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])){list($_d,$Xf)=explode(":",SERVER,2);if(is_numeric($Xf)&&$Xf<1024)auth_error('Connecting to privileged ports is not allowed.');check_invalid_login();$g=connect();$m=new
Min_Driver($g);}$ue=null;if(!is_object($g)||($ue=$b->login($_GET["username"],get_password()))!==true)auth_error((is_string($g)?h($g):(is_string($ue)?$ue:'Invalid credentials.')));if($Ka&&$_POST["token"])$_POST["token"]=$hi;$n='';if($_POST){if(!verify_token()){$Nd="max_input_vars";$Fe=ini_get($Nd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$y){$X=ini_get($y);if($X&&(!$Fe||$X<$Fe)){$Nd=$y;$Fe=$X;}}}$n=(!$_POST["token"]&&$Fe?sprintf('Maximum number of allowed fields exceeded. Please increase %s.',"'$Nd'"):'Invalid CSRF token. Send the form again.'.' '.'If you did not send this request from Adminer then close this page.');}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$n=sprintf('Too big POST data. Reduce the data or increase the %s configuration directive.',"'post_max_size'");if(isset($_GET["sql"]))$n.=' '.'You can upload a big SQL file via FTP and import it from server.';}function
select($H,$h=null,$xf=array(),$z=0){global$x;$te=array();$w=array();$f=array();$Ta=array();$wi=array();$I=array();odd('');for($s=0;(!$z||$s<$z)&&($J=$H->fetch_row());$s++){if(!$s){echo"<table cellspacing='0' class='nowrap'>\n","<thead><tr>";for($Zd=0;$Zd<count($J);$Zd++){$o=$H->fetch_field();$C=$o->name;$wf=$o->orgtable;$vf=$o->orgname;$I[$o->table]=$wf;if($xf&&$x=="sql")$te[$Zd]=($C=="table"?"table=":($C=="possible_keys"?"indexes=":null));elseif($wf!=""){if(!isset($w[$wf])){$w[$wf]=array();foreach(indexes($wf,$h)as$v){if($v["type"]=="PRIMARY"){$w[$wf]=array_flip($v["columns"]);break;}}$f[$wf]=$w[$wf];}if(isset($f[$wf][$vf])){unset($f[$wf][$vf]);$w[$wf][$vf]=$Zd;$te[$Zd]=$wf;}}if($o->charsetnr==63)$Ta[$Zd]=true;$wi[$Zd]=$o->type;echo"<th".($wf!=""||$o->name!=$vf?" title='".h(($wf!=""?"$wf.":"").$vf)."'":"").">".h($C).($xf?doc_link(array('sql'=>"explain-output.html#explain_".strtolower($C),'mariadb'=>"explain/#the-columns-in-explain-select",)):"");}echo"</thead>\n";}echo"<tr".odd().">";foreach($J
as$y=>$X){if($X===null)$X="<i>NULL</i>";elseif($Ta[$y]&&!is_utf8($X))$X="<i>".lang(array('%d byte','%d bytes'),strlen($X))."</i>";else{$X=h($X);if($wi[$y]==254)$X="<code>$X</code>";}if(isset($te[$y])&&!$f[$te[$y]]){if($xf&&$x=="sql"){$R=$J[array_search("table=",$te)];$_=$te[$y].urlencode($xf[$R]!=""?$xf[$R]:$R);}else{$_="edit=".urlencode($te[$y]);foreach($w[$te[$y]]as$mb=>$Zd)$_.="&where".urlencode("[".bracket_escape($mb)."]")."=".urlencode($J[$Zd]);}$X="<a href='".h(ME.$_)."'>$X</a>";}echo"<td>$X";}}echo($s?"</table>":"<p class='message'>".'No rows.')."\n";return$I;}function
referencable_primary($bh){$I=array();foreach(table_status('',true)as$Ih=>$R){if($Ih!=$bh&&fk_support($R)){foreach(fields($Ih)as$o){if($o["primary"]){if($I[$Ih]){unset($I[$Ih]);break;}$I[$Ih]=$o;}}}}return$I;}function
textarea($C,$Y,$K=10,$qb=80){global$x;echo"<textarea name='$C' rows='$K' cols='$qb' class='sqlarea jush-$x' spellcheck='false' wrap='off'>";if(is_array($Y)){foreach($Y
as$X)echo
h($X[0])."\n\n\n";}else
echo
h($Y);echo"</textarea>";}function
edit_type($y,$o,$ob,$dd=array(),$Kc=array()){global$Ah,$wi,$Ci,$kf;$U=$o["type"];echo'<td><select name="',h($y),'[type]" class="type" aria-labelledby="label-type">';if($U&&!isset($wi[$U])&&!isset($dd[$U])&&!in_array($U,$Kc))$Kc[]=$U;if($dd)$Ah['Foreign keys']=$dd;echo
optionlist(array_merge($Kc,$Ah),$U),'</select>
',on_help("getTarget(event).value",1),script("mixin(qsl('select'), {onfocus: function () { lastType = selectValue(this); }, onchange: editingTypeChange});",""),'<td><input name="',h($y),'[length]" value="',h($o["length"]),'" size="3"',(!$o["length"]&&preg_match('~var(char|binary)$~',$U)?" class='required'":"");echo' aria-labelledby="label-length">',script("mixin(qsl('input'), {onfocus: editingLengthFocus, oninput: editingLengthChange});",""),'<td class="options">',"<select name='".h($y)."[collation]'".(preg_match('~(char|text|enum|set)$~',$U)?"":" class='hidden'").'><option value="">('.'collation'.')'.optionlist($ob,$o["collation"]).'</select>',($Ci?"<select name='".h($y)."[unsigned]'".(!$U||preg_match(number_type(),$U)?"":" class='hidden'").'><option>'.optionlist($Ci,$o["unsigned"]).'</select>':''),(isset($o['on_update'])?"<select name='".h($y)."[on_update]'".(preg_match('~timestamp|datetime~',$U)?"":" class='hidden'").'>'.optionlist(array(""=>"(".'ON UPDATE'.")","CURRENT_TIMESTAMP"),$o["on_update"]).'</select>':''),($dd?"<select name='".h($y)."[on_delete]'".(preg_match("~`~",$U)?"":" class='hidden'")."><option value=''>(".'ON DELETE'.")".optionlist(explode("|",$kf),$o["on_delete"])."</select> ":" ");}function
process_length($qe){global$vc;return(preg_match("~^\\s*\\(?\\s*$vc(?:\\s*,\\s*$vc)*+\\s*\\)?\\s*\$~",$qe)&&preg_match_all("~$vc~",$qe,$_e)?"(".implode(",",$_e[0]).")":preg_replace('~^[0-9].*~','(\0)',preg_replace('~[^-0-9,+()[\]]~','',$qe)));}function
process_type($o,$nb="COLLATE"){global$Ci;return" $o[type]".process_length($o["length"]).(preg_match(number_type(),$o["type"])&&in_array($o["unsigned"],$Ci)?" $o[unsigned]":"").(preg_match('~char|text|enum|set~',$o["type"])&&$o["collation"]?" $nb ".q($o["collation"]):"");}function
process_field($o,$ui){return
array(idf_escape(trim($o["field"])),process_type($ui),($o["null"]?" NULL":" NOT NULL"),default_value($o),(preg_match('~timestamp|datetime~',$o["type"])&&$o["on_update"]?" ON UPDATE $o[on_update]":""),(support("comment")&&$o["comment"]!=""?" COMMENT ".q($o["comment"]):""),($o["auto_increment"]?auto_increment():null),);}function
default_value($o){$Rb=$o["default"];return($Rb===null?"":" DEFAULT ".(preg_match('~char|binary|text|enum|set~',$o["type"])||preg_match('~^(?![a-z])~i',$Rb)?q($Rb):$Rb));}function
type_class($U){foreach(array('char'=>'text','date'=>'time|year','binary'=>'blob','enum'=>'set',)as$y=>$X){if(preg_match("~$y|$X~",$U))return" class='$y'";}}function
edit_fields($p,$ob,$U="TABLE",$dd=array(),$ub=false){global$Od;$p=array_values($p);echo'<thead><tr>
';if($U=="PROCEDURE"){echo'<td>';}echo'<th id="label-name">',($U=="TABLE"?'Column name':'Parameter name'),'<td id="label-type">Type<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;"></textarea>',script("qs('#enum-edit').onblur = editingLengthBlur;"),'<td id="label-length">Length
<td>','Options';if($U=="TABLE"){echo'<td id="label-null">NULL
<td><input type="radio" name="auto_increment_col" value=""><acronym id="label-ai" title="Auto Increment">AI</acronym>',doc_link(array('sql'=>"example-auto-increment.html",'mariadb'=>"auto_increment/",'sqlite'=>"autoinc.html",'pgsql'=>"datatype.html#DATATYPE-SERIAL",'mssql'=>"ms186775.aspx",)),'<td id="label-default">Default value
',(support("comment")?"<td id='label-comment'".($ub?"":" class='hidden'").">".'Comment':"");}echo'<td>',"<input type='image' class='icon' name='add[".(support("move_col")?0:count($p))."]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.6.3")."' alt='+' title='".'Add next'."'>".script("row_count = ".count($p).";"),'</thead>
<tbody>
',script("mixin(qsl('tbody'), {onclick: editingClick, onkeydown: editingKeydown, oninput: editingInput});");foreach($p
as$s=>$o){$s++;$yf=$o[($_POST?"orig":"field")];$Zb=(isset($_POST["add"][$s-1])||(isset($o["field"])&&!$_POST["drop_col"][$s]))&&(support("drop_col")||$yf=="");echo'<tr',($Zb?"":" style='display: none;'"),'>
',($U=="PROCEDURE"?"<td>".html_select("fields[$s][inout]",explode("|",$Od),$o["inout"]):""),'<th>';if($Zb){echo'<input name="fields[',$s,'][field]" value="',h($o["field"]),'" maxlength="64" autocapitalize="off" aria-labelledby="label-name">',script("qsl('input').oninput = function () { editingNameChange.call(this);".($o["field"]!=""||count($p)>1?"":" editingAddRow.call(this);")." };","");}echo'<input type="hidden" name="fields[',$s,'][orig]" value="',h($yf),'">
';edit_type("fields[$s]",$o,$ob,$dd);if($U=="TABLE"){echo'<td>',checkbox("fields[$s][null]",1,$o["null"],"","","block","label-null"),'<td><label class="block"><input type="radio" name="auto_increment_col" value="',$s,'"';if($o["auto_increment"]){echo' checked';}echo' aria-labelledby="label-ai"></label><td>',checkbox("fields[$s][has_default]",1,$o["has_default"],"","","","label-default"),'<input name="fields[',$s,'][default]" value="',h($o["default"]),'" aria-labelledby="label-default">',(support("comment")?"<td".($ub?"":" class='hidden'")."><input name='fields[$s][comment]' value='".h($o["comment"])."' maxlength='".(min_version(5.5)?1024:255)."' aria-labelledby='label-comment'>":"");}echo"<td>",(support("move_col")?"<input type='image' class='icon' name='add[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.6.3")."' alt='+' title='".'Add next'."'> "."<input type='image' class='icon' name='up[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=up.gif&version=4.6.3")."' alt='↑' title='".'Move up'."'> "."<input type='image' class='icon' name='down[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=down.gif&version=4.6.3")."' alt='↓' title='".'Move down'."'> ":""),($yf==""||support("drop_col")?"<input type='image' class='icon' name='drop_col[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.6.3")."' alt='x' title='".'Remove'."'>":"");}}function
process_fields(&$p){$D=0;if($_POST["up"]){$ke=0;foreach($p
as$y=>$o){if(key($_POST["up"])==$y){unset($p[$y]);array_splice($p,$ke,0,array($o));break;}if(isset($o["field"]))$ke=$D;$D++;}}elseif($_POST["down"]){$fd=false;foreach($p
as$y=>$o){if(isset($o["field"])&&$fd){unset($p[key($_POST["down"])]);array_splice($p,$D,0,array($fd));break;}if(key($_POST["down"])==$y)$fd=$o;$D++;}}elseif($_POST["add"]){$p=array_values($p);array_splice($p,key($_POST["add"]),0,array(array()));}elseif(!$_POST["drop_col"])return
false;return
true;}function
normalize_enum($B){return"'".str_replace("'","''",addcslashes(stripcslashes(str_replace($B[0][0].$B[0][0],$B[0][0],substr($B[0],1,-1))),'\\'))."'";}function
grant($kd,$jg,$f,$jf){if(!$jg)return
true;if($jg==array("ALL PRIVILEGES","GRANT OPTION"))return($kd=="GRANT"?queries("$kd ALL PRIVILEGES$jf WITH GRANT OPTION"):queries("$kd ALL PRIVILEGES$jf")&&queries("$kd GRANT OPTION$jf"));return
queries("$kd ".preg_replace('~(GRANT OPTION)\([^)]*\)~','\1',implode("$f, ",$jg).$f).$jf);}function
drop_create($ec,$i,$fc,$Uh,$hc,$A,$Ke,$Ie,$Je,$gf,$Ve){if($_POST["drop"])query_redirect($ec,$A,$Ke);elseif($gf=="")query_redirect($i,$A,$Je);elseif($gf!=$Ve){$Eb=queries($i);queries_redirect($A,$Ie,$Eb&&queries($ec));if($Eb)queries($fc);}else
queries_redirect($A,$Ie,queries($Uh)&&queries($hc)&&queries($ec)&&queries($i));}function
create_trigger($jf,$J){global$x;$Zh=" $J[Timing] $J[Event]".($J["Event"]=="UPDATE OF"?" ".idf_escape($J["Of"]):"");return"CREATE TRIGGER ".idf_escape($J["Trigger"]).($x=="mssql"?$jf.$Zh:$Zh.$jf).rtrim(" $J[Type]\n$J[Statement]",";").";";}function
create_routine($Og,$J){global$Od,$x;$O=array();$p=(array)$J["fields"];ksort($p);foreach($p
as$o){if($o["field"]!="")$O[]=(preg_match("~^($Od)\$~",$o["inout"])?"$o[inout] ":"").idf_escape($o["field"]).process_type($o,"CHARACTER SET");}$Sb=rtrim("\n$J[definition]",";");return"CREATE $Og ".idf_escape(trim($J["name"]))." (".implode(", ",$O).")".(isset($_GET["function"])?" RETURNS".process_type($J["returns"],"CHARACTER SET"):"").($J["language"]?" LANGUAGE $J[language]":"").($x=="pgsql"?" AS ".q($Sb):"$Sb;");}function
remove_definer($G){return
preg_replace('~^([A-Z =]+) DEFINER=`'.preg_replace('~@(.*)~','`@`(%|\1)',logged_user()).'`~','\1',$G);}function
format_foreign_key($q){global$kf;return" FOREIGN KEY (".implode(", ",array_map('idf_escape',$q["source"])).") REFERENCES ".table($q["table"])." (".implode(", ",array_map('idf_escape',$q["target"])).")".(preg_match("~^($kf)\$~",$q["on_delete"])?" ON DELETE $q[on_delete]":"").(preg_match("~^($kf)\$~",$q["on_update"])?" ON UPDATE $q[on_update]":"");}function
tar_file($Tc,$ei){$I=pack("a100a8a8a8a12a12",$Tc,644,0,0,decoct($ei->size),decoct(time()));$gb=8*32;for($s=0;$s<strlen($I);$s++)$gb+=ord($I[$s]);$I.=sprintf("%06o",$gb)."\0 ";echo$I,str_repeat("\0",512-strlen($I));$ei->send();echo
str_repeat("\0",511-($ei->size+511)%512);}function
ini_bytes($Nd){$X=ini_get($Nd);switch(strtolower(substr($X,-1))){case'g':$X*=1024;case'm':$X*=1024;case'k':$X*=1024;}return$X;}function
doc_link($Tf,$Vh="<sup>?</sup>"){global$x,$g;$fh=$g->server_info;$Ri=preg_replace('~^(\d\.?\d).*~s','\1',$fh);$Hi=array('sql'=>"https://dev.mysql.com/doc/refman/$Ri/en/",'sqlite'=>"https://www.sqlite.org/",'pgsql'=>"https://www.postgresql.org/docs/$Ri/static/",'mssql'=>"https://msdn.microsoft.com/library/",'oracle'=>"https://download.oracle.com/docs/cd/B19306_01/server.102/b14200/",);if(preg_match('~MariaDB~',$fh)){$Hi['sql']="https://mariadb.com/kb/en/library/";$Tf['sql']=(isset($Tf['mariadb'])?$Tf['mariadb']:str_replace(".html","/",$Tf['sql']));}return($Tf[$x]?"<a href='$Hi[$x]$Tf[$x]'".target_blank().">$Vh</a>":"");}function
ob_gzencode($Q){return
gzencode($Q);}function
db_size($l){global$g;if(!$g->select_db($l))return"?";$I=0;foreach(table_status()as$S)$I+=$S["Data_length"]+$S["Index_length"];return
format_number($I);}function
set_utf8mb4($i){global$g;static$O=false;if(!$O&&preg_match('~\butf8mb4~i',$i)){$O=true;echo"SET NAMES ".charset($g).";\n\n";}}function
connect_error(){global$b,$g,$hi,$n,$dc;if(DB!=""){header("HTTP/1.1 404 Not Found");page_header('Database'.": ".h(DB),'Invalid database.',true);}else{if($_POST["db"]&&!$n)queries_redirect(substr(ME,0,-1),'Databases have been dropped.',drop_databases($_POST["db"]));page_header('Select database',$n,false);echo"<p class='links'>\n";foreach(array('database'=>'Create database','privileges'=>'Privileges','processlist'=>'Process list','variables'=>'Variables','status'=>'Status',)as$y=>$X){if(support($y))echo"<a href='".h(ME)."$y='>$X</a>\n";}echo"<p>".sprintf('%s version: %s through PHP extension %s',$dc[DRIVER],"<b>".h($g->server_info)."</b>","<b>$g->extension</b>")."\n","<p>".sprintf('Logged as: %s',"<b>".h(logged_user())."</b>")."\n";$k=$b->databases();if($k){$Vg=support("scheme");$ob=collations();echo"<form action='' method='post'>\n","<table cellspacing='0' class='checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),"<thead><tr>".(support("database")?"<td>":"")."<th>".'Database'." - <a href='".h(ME)."refresh=1'>".'Refresh'."</a>"."<td>".'Collation'."<td>".'Tables'."<td>".'Size'." - <a href='".h(ME)."dbsize=1'>".'Compute'."</a>".script("qsl('a').onclick = partial(ajaxSetHtml, '".js_escape(ME)."script=connect');","")."</thead>\n";$k=($_GET["dbsize"]?count_tables($k):array_flip($k));foreach($k
as$l=>$T){$Ng=h(ME)."db=".urlencode($l);$t=h("Db-".$l);echo"<tr".odd().">".(support("database")?"<td>".checkbox("db[]",$l,in_array($l,(array)$_POST["db"]),"","","",$t):""),"<th><a href='$Ng' id='$t'>".h($l)."</a>";$d=h(db_collation($l,$ob));echo"<td>".(support("database")?"<a href='$Ng".($Vg?"&amp;ns=":"")."&amp;database=' title='".'Alter database'."'>$d</a>":$d),"<td align='right'><a href='$Ng&amp;schema=' id='tables-".h($l)."' title='".'Database schema'."'>".($_GET["dbsize"]?$T:"?")."</a>","<td align='right' id='size-".h($l)."'>".($_GET["dbsize"]?db_size($l):"?"),"\n";}echo"</table>\n",(support("database")?"<div class='footer'><div>\n"."<fieldset><legend>".'Selected'." <span id='selected'></span></legend><div>\n"."<input type='hidden' name='all' value=''>".script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^db/)); };")."<input type='submit' name='drop' value='".'Drop'."'>".confirm()."\n"."</div></fieldset>\n"."</div></div>\n":""),"<input type='hidden' name='token' value='$hi'>\n","</form>\n",script("tableCheck();");}}page_footer("db");}if(isset($_GET["status"]))$_GET["variables"]=$_GET["status"];if(isset($_GET["import"]))$_GET["sql"]=$_GET["import"];if(!(DB!=""?$g->select_db(DB):isset($_GET["sql"])||isset($_GET["dump"])||isset($_GET["database"])||isset($_GET["processlist"])||isset($_GET["privileges"])||isset($_GET["user"])||isset($_GET["variables"])||$_GET["script"]=="connect"||$_GET["script"]=="kill")){if(DB!=""||$_GET["refresh"]){restart_session();set_session("dbs",null);}connect_error();exit;}if(support("scheme")&&DB!=""&&$_GET["ns"]!==""){if(!isset($_GET["ns"]))redirect(preg_replace('~ns=[^&]*&~','',ME)."ns=".get_schema());if(!set_schema($_GET["ns"])){header("HTTP/1.1 404 Not Found");page_header('Schema'.": ".h($_GET["ns"]),'Invalid schema.',true);page_footer("ns");exit;}}$kf="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";class
TmpFile{var$handler;var$size;function
__construct(){$this->handler=tmpfile();}function
write($zb){$this->size+=strlen($zb);fwrite($this->handler,$zb);}function
send(){fseek($this->handler,0);fpassthru($this->handler);fclose($this->handler);}}$vc="'(?:''|[^'\\\\]|\\\\.)*'";$Od="IN|OUT|INOUT";if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["callf"]))$_GET["call"]=$_GET["callf"];if(isset($_GET["function"]))$_GET["procedure"]=$_GET["function"];if(isset($_GET["download"])){$a=$_GET["download"];$p=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$L=array(idf_escape($_GET["field"]));$H=$m->select($a,$L,array(where($_GET,$p)),$L);$J=($H?$H->fetch_row():array());echo$m->value($J[0],$p[$_GET["field"]]);exit;}elseif(isset($_GET["table"])){$a=$_GET["table"];$p=fields($a);if(!$p)$n=error();$S=table_status1($a,true);$C=$b->tableName($S);page_header(($p&&is_view($S)?$S['Engine']=='materialized view'?'Materialized view':'View':'Table').": ".($C!=""?$C:h($a)),$n);$b->selectLinks($S);$tb=$S["Comment"];if($tb!="")echo"<p class='nowrap'>".'Comment'.": ".h($tb)."\n";if($p)$b->tableStructurePrint($p);if(!is_view($S)){if(support("indexes")){echo"<h3 id='indexes'>".'Indexes'."</h3>\n";$w=indexes($a);if($w)$b->tableIndexesPrint($w);echo'<p class="links"><a href="'.h(ME).'indexes='.urlencode($a).'">'.'Alter indexes'."</a>\n";}if(fk_support($S)){echo"<h3 id='foreign-keys'>".'Foreign keys'."</h3>\n";$dd=foreign_keys($a);if($dd){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Source'."<td>".'Target'."<td>".'ON DELETE'."<td>".'ON UPDATE'."<td></thead>\n";foreach($dd
as$C=>$q){echo"<tr title='".h($C)."'>","<th><i>".implode("</i>, <i>",array_map('h',$q["source"]))."</i>","<td><a href='".h($q["db"]!=""?preg_replace('~db=[^&]*~',"db=".urlencode($q["db"]),ME):($q["ns"]!=""?preg_replace('~ns=[^&]*~',"ns=".urlencode($q["ns"]),ME):ME))."table=".urlencode($q["table"])."'>".($q["db"]!=""?"<b>".h($q["db"])."</b>.":"").($q["ns"]!=""?"<b>".h($q["ns"])."</b>.":"").h($q["table"])."</a>","(<i>".implode("</i>, <i>",array_map('h',$q["target"]))."</i>)","<td>".h($q["on_delete"])."\n","<td>".h($q["on_update"])."\n",'<td><a href="'.h(ME.'foreign='.urlencode($a).'&name='.urlencode($C)).'">'.'Alter'.'</a>';}echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'foreign='.urlencode($a).'">'.'Add foreign key'."</a>\n";}}if(support(is_view($S)?"view_trigger":"trigger")){echo"<h3 id='triggers'>".'Triggers'."</h3>\n";$ti=triggers($a);if($ti){echo"<table cellspacing='0'>\n";foreach($ti
as$y=>$X)echo"<tr valign='top'><td>".h($X[0])."<td>".h($X[1])."<th>".h($y)."<td><a href='".h(ME.'trigger='.urlencode($a).'&name='.urlencode($y))."'>".'Alter'."</a>\n";echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'trigger='.urlencode($a).'">'.'Add trigger'."</a>\n";}}elseif(isset($_GET["schema"])){page_header('Database schema',"",array(),h(DB.($_GET["ns"]?".$_GET[ns]":"")));$Kh=array();$Lh=array();$ea=($_GET["schema"]?$_GET["schema"]:$_COOKIE["adminer_schema-".str_replace(".","_",DB)]);preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~',$ea,$_e,PREG_SET_ORDER);foreach($_e
as$s=>$B){$Kh[$B[1]]=array($B[2],$B[3]);$Lh[]="\n\t'".js_escape($B[1])."': [ $B[2], $B[3] ]";}$ii=0;$Qa=-1;$Ug=array();$_g=array();$oe=array();foreach(table_status('',true)as$R=>$S){if(is_view($S))continue;$Yf=0;$Ug[$R]["fields"]=array();foreach(fields($R)as$C=>$o){$Yf+=1.25;$o["pos"]=$Yf;$Ug[$R]["fields"][$C]=$o;}$Ug[$R]["pos"]=($Kh[$R]?$Kh[$R]:array($ii,0));foreach($b->foreignKeys($R)as$X){if(!$X["db"]){$me=$Qa;if($Kh[$R][1]||$Kh[$X["table"]][1])$me=min(floatval($Kh[$R][1]),floatval($Kh[$X["table"]][1]))-1;else$Qa-=.1;while($oe[(string)$me])$me-=.0001;$Ug[$R]["references"][$X["table"]][(string)$me]=array($X["source"],$X["target"]);$_g[$X["table"]][$R][(string)$me]=$X["target"];$oe[(string)$me]=true;}}$ii=max($ii,$Ug[$R]["pos"][0]+2.5+$Yf);}echo'<div id="schema" style="height: ',$ii,'em;">
<script',nonce(),'>
qs(\'#schema\').onselectstart = function () { return false; };
var tablePos = {',implode(",",$Lh)."\n",'};
var em = qs(\'#schema\').offsetHeight / ',$ii,';
document.onmousemove = schemaMousemove;
document.onmouseup = partialArg(schemaMouseup, \'',js_escape(DB),'\');
</script>
';foreach($Ug
as$C=>$R){echo"<div class='table' style='top: ".$R["pos"][0]."em; left: ".$R["pos"][1]."em;'>",'<a href="'.h(ME).'table='.urlencode($C).'"><b>'.h($C)."</b></a>",script("qsl('div').onmousedown = schemaMousedown;");foreach($R["fields"]as$o){$X='<span'.type_class($o["type"]).' title="'.h($o["full_type"].($o["null"]?" NULL":'')).'">'.h($o["field"]).'</span>';echo"<br>".($o["primary"]?"<i>$X</i>":$X);}foreach((array)$R["references"]as$Rh=>$Ag){foreach($Ag
as$me=>$xg){$ne=$me-$Kh[$C][1];$s=0;foreach($xg[0]as$ph)echo"\n<div class='references' title='".h($Rh)."' id='refs$me-".($s++)."' style='left: $ne"."em; top: ".$R["fields"][$ph]["pos"]."em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: ".(-$ne)."em;'></div></div>";}}foreach((array)$_g[$C]as$Rh=>$Ag){foreach($Ag
as$me=>$f){$ne=$me-$Kh[$C][1];$s=0;foreach($f
as$Qh)echo"\n<div class='references' title='".h($Rh)."' id='refd$me-".($s++)."' style='left: $ne"."em; top: ".$R["fields"][$Qh]["pos"]."em; height: 1.25em; background: url(".h(preg_replace("~\\?.*~","",ME)."?file=arrow.gif) no-repeat right center;&version=4.6.3")."'><div style='height: .5em; border-bottom: 1px solid Gray; width: ".(-$ne)."em;'></div></div>";}}echo"\n</div>\n";}foreach($Ug
as$C=>$R){foreach((array)$R["references"]as$Rh=>$Ag){foreach($Ag
as$me=>$xg){$Oe=$ii;$De=-10;foreach($xg[0]as$y=>$ph){$Zf=$R["pos"][0]+$R["fields"][$ph]["pos"];$ag=$Ug[$Rh]["pos"][0]+$Ug[$Rh]["fields"][$xg[1][$y]]["pos"];$Oe=min($Oe,$Zf,$ag);$De=max($De,$Zf,$ag);}echo"<div class='references' id='refl$me' style='left: $me"."em; top: $Oe"."em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: ".($De-$Oe)."em;'></div></div>\n";}}}echo'</div>
<p class="links"><a href="',h(ME."schema=".urlencode($ea)),'" id="schema-link">Permanent link</a>
';}elseif(isset($_GET["dump"])){$a=$_GET["dump"];if($_POST&&!$n){$Bb="";foreach(array("output","format","db_style","routines","events","table_style","auto_increment","triggers","data_style")as$y)$Bb.="&$y=".urlencode($_POST[$y]);cookie("adminer_export",substr($Bb,1));$T=array_flip((array)$_POST["tables"])+array_flip((array)$_POST["data"]);$Hc=dump_headers((count($T)==1?key($T):DB),(DB==""||count($T)>1));$Wd=preg_match('~sql~',$_POST["format"]);if($Wd){echo"-- Adminer $ia ".$dc[DRIVER]." dump\n\n";if($x=="sql"){echo"SET NAMES utf8;
SET time_zone = '+00:00';
".($_POST["data_style"]?"SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
":"")."
";$g->query("SET time_zone = '+00:00';");}}$Bh=$_POST["db_style"];$k=array(DB);if(DB==""){$k=$_POST["databases"];if(is_string($k))$k=explode("\n",rtrim(str_replace("\r","",$k),"\n"));}foreach((array)$k
as$l){$b->dumpDatabase($l);if($g->select_db($l)){if($Wd&&preg_match('~CREATE~',$Bh)&&($i=$g->result("SHOW CREATE DATABASE ".idf_escape($l),1))){set_utf8mb4($i);if($Bh=="DROP+CREATE")echo"DROP DATABASE IF EXISTS ".idf_escape($l).";\n";echo"$i;\n";}if($Wd){if($Bh)echo
use_sql($l).";\n\n";$Df="";if($_POST["routines"]){foreach(array("FUNCTION","PROCEDURE")as$Og){foreach(get_rows("SHOW $Og STATUS WHERE Db = ".q($l),null,"-- ")as$J){$i=remove_definer($g->result("SHOW CREATE $Og ".idf_escape($J["Name"]),2));set_utf8mb4($i);$Df.=($Bh!='DROP+CREATE'?"DROP $Og IF EXISTS ".idf_escape($J["Name"]).";;\n":"")."$i;;\n\n";}}}if($_POST["events"]){foreach(get_rows("SHOW EVENTS",null,"-- ")as$J){$i=remove_definer($g->result("SHOW CREATE EVENT ".idf_escape($J["Name"]),3));set_utf8mb4($i);$Df.=($Bh!='DROP+CREATE'?"DROP EVENT IF EXISTS ".idf_escape($J["Name"]).";;\n":"")."$i;;\n\n";}}if($Df)echo"DELIMITER ;;\n\n$Df"."DELIMITER ;\n\n";}if($_POST["table_style"]||$_POST["data_style"]){$Ti=array();foreach(table_status('',true)as$C=>$S){$R=(DB==""||in_array($C,(array)$_POST["tables"]));$Kb=(DB==""||in_array($C,(array)$_POST["data"]));if($R||$Kb){if($Hc=="tar"){$ei=new
TmpFile;ob_start(array($ei,'write'),1e5);}$b->dumpTable($C,($R?$_POST["table_style"]:""),(is_view($S)?2:0));if(is_view($S))$Ti[]=$C;elseif($Kb){$p=fields($C);$b->dumpData($C,$_POST["data_style"],"SELECT *".convert_fields($p,$p)." FROM ".table($C));}if($Wd&&$_POST["triggers"]&&$R&&($ti=trigger_sql($C)))echo"\nDELIMITER ;;\n$ti\nDELIMITER ;\n";if($Hc=="tar"){ob_end_flush();tar_file((DB!=""?"":"$l/")."$C.csv",$ei);}elseif($Wd)echo"\n";}}foreach($Ti
as$Si)$b->dumpTable($Si,$_POST["table_style"],1);if($Hc=="tar")echo
pack("x512");}}}if($Wd)echo"-- ".$g->result("SELECT NOW()")."\n";exit;}page_header('Export',$n,($_GET["export"]!=""?array("table"=>$_GET["export"]):array()),h(DB));echo'
<form action="" method="post">
<table cellspacing="0">
';$Ob=array('','USE','DROP+CREATE','CREATE');$Mh=array('','DROP+CREATE','CREATE');$Lb=array('','TRUNCATE+INSERT','INSERT');if($x=="sql")$Lb[]='INSERT+UPDATE';parse_str($_COOKIE["adminer_export"],$J);if(!$J)$J=array("output"=>"text","format"=>"sql","db_style"=>(DB!=""?"":"CREATE"),"table_style"=>"DROP+CREATE","data_style"=>"INSERT");if(!isset($J["events"])){$J["routines"]=$J["events"]=($_GET["dump"]=="");$J["triggers"]=$J["table_style"];}echo"<tr><th>".'Output'."<td>".html_select("output",$b->dumpOutput(),$J["output"],0)."\n";echo"<tr><th>".'Format'."<td>".html_select("format",$b->dumpFormat(),$J["format"],0)."\n";echo($x=="sqlite"?"":"<tr><th>".'Database'."<td>".html_select('db_style',$Ob,$J["db_style"]).(support("routine")?checkbox("routines",1,$J["routines"],'Routines'):"").(support("event")?checkbox("events",1,$J["events"],'Events'):"")),"<tr><th>".'Tables'."<td>".html_select('table_style',$Mh,$J["table_style"]).checkbox("auto_increment",1,$J["auto_increment"],'Auto Increment').(support("trigger")?checkbox("triggers",1,$J["triggers"],'Triggers'):""),"<tr><th>".'Data'."<td>".html_select('data_style',$Lb,$J["data_style"]),'</table>
<p><input type="submit" value="Export">
<input type="hidden" name="token" value="',$hi,'">

<table cellspacing="0">
',script("qsl('table').onclick = dumpClick;");$dg=array();if(DB!=""){$eb=($a!=""?"":" checked");echo"<thead><tr>","<th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'$eb>".'Tables'."</label>".script("qs('#check-tables').onclick = partial(formCheck, /^tables\\[/);",""),"<th style='text-align: right;'><label class='block'>".'Data'."<input type='checkbox' id='check-data'$eb></label>".script("qs('#check-data').onclick = partial(formCheck, /^data\\[/);",""),"</thead>\n";$Ti="";$Nh=tables_list();foreach($Nh
as$C=>$U){$cg=preg_replace('~_.*~','',$C);$eb=($a==""||$a==(substr($a,-1)=="%"?"$cg%":$C));$gg="<tr><td>".checkbox("tables[]",$C,$eb,$C,"","block");if($U!==null&&!preg_match('~table~i',$U))$Ti.="$gg\n";else
echo"$gg<td align='right'><label class='block'><span id='Rows-".h($C)."'></span>".checkbox("data[]",$C,$eb)."</label>\n";$dg[$cg]++;}echo$Ti;if($Nh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}else{echo"<thead><tr><th style='text-align: left;'>","<label class='block'><input type='checkbox' id='check-databases'".($a==""?" checked":"").">".'Database'."</label>",script("qs('#check-databases').onclick = partial(formCheck, /^databases\\[/);",""),"</thead>\n";$k=$b->databases();if($k){foreach($k
as$l){if(!information_schema($l)){$cg=preg_replace('~_.*~','',$l);echo"<tr><td>".checkbox("databases[]",$l,$a==""||$a=="$cg%",$l,"","block")."\n";$dg[$cg]++;}}}else
echo"<tr><td><textarea name='databases' rows='10' cols='20'></textarea>";}echo'</table>
</form>
';$Vc=true;foreach($dg
as$y=>$X){if($y!=""&&$X>1){echo($Vc?"<p>":" ")."<a href='".h(ME)."dump=".urlencode("$y%")."'>".h($y)."</a>";$Vc=false;}}}elseif(isset($_GET["privileges"])){page_header('Privileges');echo'<p class="links"><a href="'.h(ME).'user=">'.'Create user'."</a>";$H=$g->query("SELECT User, Host FROM mysql.".(DB==""?"user":"db WHERE ".q(DB)." LIKE Db")." ORDER BY Host, User");$kd=$H;if(!$H)$H=$g->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");echo"<form action=''><p>\n";hidden_fields_get();echo"<input type='hidden' name='db' value='".h(DB)."'>\n",($kd?"":"<input type='hidden' name='grant' value=''>\n"),"<table cellspacing='0'>\n","<thead><tr><th>".'Username'."<th>".'Server'."<th></thead>\n";while($J=$H->fetch_assoc())echo'<tr'.odd().'><td>'.h($J["User"])."<td>".h($J["Host"]).'<td><a href="'.h(ME.'user='.urlencode($J["User"]).'&host='.urlencode($J["Host"])).'">'.'Edit'."</a>\n";if(!$kd||DB!="")echo"<tr".odd()."><td><input name='user' autocapitalize='off'><td><input name='host' value='localhost' autocapitalize='off'><td><input type='submit' value='".'Edit'."'>\n";echo"</table>\n","</form>\n";}elseif(isset($_GET["sql"])){if(!$n&&$_POST["export"]){dump_headers("sql");$b->dumpTable("","");$b->dumpData("","table",$_POST["query"]);exit;}restart_session();$yd=&get_session("queries");$xd=&$yd[DB];if(!$n&&$_POST["clear"]){$xd=array();redirect(remove_from_uri("history"));}page_header((isset($_GET["import"])?'Import':'SQL command'),$n);if(!$n&&$_POST){$hd=false;if(!isset($_GET["import"]))$G=$_POST["query"];elseif($_POST["webfile"]){$th=$b->importServerPath();$hd=@fopen((file_exists($th)?$th:"compress.zlib://$th.gz"),"rb");$G=($hd?fread($hd,1e6):false);}else$G=get_file("sql_file",true);if(is_string($G)){if(function_exists('memory_get_usage'))@ini_set("memory_limit",max(ini_bytes("memory_limit"),2*strlen($G)+memory_get_usage()+8e6));if($G!=""&&strlen($G)<1e6){$og=$G.(preg_match("~;[ \t\r\n]*\$~",$G)?"":";");if(!$xd||reset(end($xd))!=$og){restart_session();$xd[]=array($og,time());set_session("queries",$yd);stop_session();}}$qh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$Ub=";";$D=0;$sc=true;$h=connect();if(is_object($h)&&DB!="")$h->select_db(DB);$sb=0;$xc=array();$Kf='[\'"'.($x=="sql"?'`#':($x=="sqlite"?'`[':($x=="mssql"?'[':''))).']|/\*|-- |$'.($x=="pgsql"?'|\$[^$]*\$':'');$ji=microtime(true);parse_str($_COOKIE["adminer_export"],$xa);$jc=$b->dumpFormat();unset($jc["sql"]);while($G!=""){if(!$D&&preg_match("~^$qh*+DELIMITER\\s+(\\S+)~i",$G,$B)){$Ub=$B[1];$G=substr($G,strlen($B[0]));}else{preg_match('('.preg_quote($Ub)."\\s*|$Kf)",$G,$B,PREG_OFFSET_CAPTURE,$D);list($fd,$Yf)=$B[0];if(!$fd&&$hd&&!feof($hd))$G.=fread($hd,1e5);else{if(!$fd&&rtrim($G)=="")break;$D=$Yf+strlen($fd);if($fd&&rtrim($fd)!=$Ub){while(preg_match('('.($fd=='/*'?'\*/':($fd=='['?']':(preg_match('~^-- |^#~',$fd)?"\n":preg_quote($fd)."|\\\\."))).'|$)s',$G,$B,PREG_OFFSET_CAPTURE,$D)){$Sg=$B[0][0];if(!$Sg&&$hd&&!feof($hd))$G.=fread($hd,1e5);else{$D=$B[0][1]+strlen($Sg);if($Sg[0]!="\\")break;}}}else{$sc=false;$og=substr($G,0,$Yf);$sb++;$gg="<pre id='sql-$sb'><code class='jush-$x'>".$b->sqlCommandQuery($og)."</code></pre>\n";if($x=="sqlite"&&preg_match("~^$qh*+ATTACH\\b~i",$og,$B)){echo$gg,"<p class='error'>".'ATTACH queries are not supported.'."\n";$xc[]=" <a href='#sql-$sb'>$sb</a>";if($_POST["error_stops"])break;}else{if(!$_POST["only_errors"]){echo$gg;ob_flush();flush();}$xh=microtime(true);if($g->multi_query($og)&&is_object($h)&&preg_match("~^$qh*+USE\\b~i",$og))$h->query($og);do{$H=$g->store_result();if($g->error){echo($_POST["only_errors"]?$gg:""),"<p class='error'>".'Error in query'.($g->errno?" ($g->errno)":"").": ".error()."\n";$xc[]=" <a href='#sql-$sb'>$sb</a>";if($_POST["error_stops"])break
2;}else{$Xh=" <span class='time'>(".format_time($xh).")</span>".(strlen($og)<1000?" <a href='".h(ME)."sql=".urlencode(trim($og))."'>".'Edit'."</a>":"");$za=$g->affected_rows;$Wi=($_POST["only_errors"]?"":$m->warnings());$Xi="warnings-$sb";if($Wi)$Xh.=", <a href='#$Xi'>".'Warnings'."</a>".script("qsl('a').onclick = partial(toggle, '$Xi');","");$Ec=null;$Fc="explain-$sb";if(is_object($H)){$z=$_POST["limit"];$xf=select($H,$h,array(),$z);if(!$_POST["only_errors"]){echo"<form action='' method='post'>\n";$af=$H->num_rows;echo"<p>".($af?($z&&$af>$z?sprintf('%d / ',$z):"").lang(array('%d row','%d rows'),$af):""),$Xh;if($h&&preg_match("~^($qh|\\()*+SELECT\\b~i",$og)&&($Ec=explain($h,$og)))echo", <a href='#$Fc'>Explain</a>".script("qsl('a').onclick = partial(toggle, '$Fc');","");$t="export-$sb";echo", <a href='#$t'>".'Export'."</a>".script("qsl('a').onclick = partial(toggle, '$t');","")."<span id='$t' class='hidden'>: ".html_select("output",$b->dumpOutput(),$xa["output"])." ".html_select("format",$jc,$xa["format"])."<input type='hidden' name='query' value='".h($og)."'>"." <input type='submit' name='export' value='".'Export'."'><input type='hidden' name='token' value='$hi'></span>\n"."</form>\n";}}else{if(preg_match("~^$qh*+(CREATE|DROP|ALTER)$qh++(DATABASE|SCHEMA)\\b~i",$og)){restart_session();set_session("dbs",null);stop_session();}if(!$_POST["only_errors"])echo"<p class='message' title='".h($g->info)."'>".lang(array('Query executed OK, %d row affected.','Query executed OK, %d rows affected.'),$za)."$Xh\n";}echo($Wi?"<div id='$Xi' class='hidden'>\n$Wi</div>\n":"");if($Ec){echo"<div id='$Fc' class='hidden'>\n";select($Ec,$h,$xf);echo"</div>\n";}}$xh=microtime(true);}while($g->next_result());}$G=substr($G,$D);$D=0;}}}}if($sc)echo"<p class='message'>".'No commands to execute.'."\n";elseif($_POST["only_errors"]){echo"<p class='message'>".lang(array('%d query executed OK.','%d queries executed OK.'),$sb-count($xc))," <span class='time'>(".format_time($ji).")</span>\n";}elseif($xc&&$sb>1)echo"<p class='error'>".'Error in query'.": ".implode("",$xc)."\n";}else
echo"<p class='error'>".upload_error($G)."\n";}echo'
<form action="" method="post" enctype="multipart/form-data" id="form">
';$Bc="<input type='submit' value='".'Execute'."' title='Ctrl+Enter'>";if(!isset($_GET["import"])){$og=$_GET["sql"];if($_POST)$og=$_POST["query"];elseif($_GET["history"]=="all")$og=$xd;elseif($_GET["history"]!="")$og=$xd[$_GET["history"]][0];echo"<p>";textarea("query",$og,20);echo($_POST?"":script("qs('textarea').focus();")),"<p>$Bc\n",'Limit rows'.": <input type='number' name='limit' class='size' value='".h($_POST?$_POST["limit"]:$_GET["limit"])."'>\n";}else{echo"<fieldset><legend>".'File upload'."</legend><div>";$qd=(extension_loaded("zlib")?"[.gz]":"");echo(ini_bool("file_uploads")?"SQL$qd (&lt; ".ini_get("upload_max_filesize")."B): <input type='file' name='sql_file[]' multiple>\n$Bc":'File uploads are disabled.'),"</div></fieldset>\n","<fieldset><legend>".'From server'."</legend><div>",sprintf('Webserver file %s',"<code>".h($b->importServerPath())."$qd</code>"),' <input type="submit" name="webfile" value="'.'Run file'.'">',"</div></fieldset>\n","<p>";}echo
checkbox("error_stops",1,($_POST?$_POST["error_stops"]:isset($_GET["import"])),'Stop on error')."\n",checkbox("only_errors",1,($_POST?$_POST["only_errors"]:isset($_GET["import"])),'Show only errors')."\n","<input type='hidden' name='token' value='$hi'>\n";if(!isset($_GET["import"])&&$xd){print_fieldset("history",'History',$_GET["history"]!="");for($X=end($xd);$X;$X=prev($xd)){$y=key($xd);list($og,$Xh,$nc)=$X;echo'<a href="'.h(ME."sql=&history=$y").'">'.'Edit'."</a>"." <span class='time' title='".@date('Y-m-d',$Xh)."'>".@date("H:i:s",$Xh)."</span>"." <code class='jush-$x'>".shorten_utf8(ltrim(str_replace("\n"," ",str_replace("\r","",preg_replace('~^(#|-- ).*~m','',$og)))),80,"</code>").($nc?" <span class='time'>($nc)</span>":"")."<br>\n";}echo"<input type='submit' name='clear' value='".'Clear'."'>\n","<a href='".h(ME."sql=&history=all")."'>".'Edit all'."</a>\n","</div></fieldset>\n";}echo'</form>
';}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$p=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$p):""):where($_GET,$p));$Di=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($p
as$C=>$o){if(!isset($o["privileges"][$Di?"update":"insert"])||$b->fieldName($o)=="")unset($p[$C]);}if($_POST&&!$n&&!isset($_GET["select"])){$A=$_POST["referer"];if($_POST["insert"])$A=($Di?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$A))$A=ME."select=".urlencode($a);$w=indexes($a);$zi=unique_array($_GET["where"],$w);$rg="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($A,'Item has been deleted.',$m->delete($a,$rg,!$zi));else{$O=array();foreach($p
as$C=>$o){$X=process_input($o);if($X!==false&&$X!==null)$O[idf_escape($C)]=$X;}if($Di){if(!$O)redirect($A);queries_redirect($A,'Item has been updated.',$m->update($a,$O,$rg,!$zi));if(is_ajax()){page_headers();page_messages($n);exit;}}else{$H=$m->insert($a,$O);$le=($H?last_id():0);queries_redirect($A,sprintf('Item%s has been inserted.',($le?" $le":"")),$H);}}}$J=null;if($_POST["save"])$J=(array)$_POST["fields"];elseif($Z){$L=array();foreach($p
as$C=>$o){if(isset($o["privileges"]["select"])){$Ga=convert_field($o);if($_POST["clone"]&&$o["auto_increment"])$Ga="''";if($x=="sql"&&preg_match("~enum|set~",$o["type"]))$Ga="1*".idf_escape($C);$L[]=($Ga?"$Ga AS ":"").idf_escape($C);}}$J=array();if(!support("table"))$L=array("*");if($L){$H=$m->select($a,$L,array($Z),$L,array(),(isset($_GET["select"])?2:1));if(!$H)$n=error();else{$J=$H->fetch_assoc();if(!$J)$J=false;}if(isset($_GET["select"])&&(!$J||$H->fetch_assoc()))$J=null;}}if(!support("table")&&!$p){if(!$Z){$H=$m->select($a,array("*"),$Z,array("*"));$J=($H?$H->fetch_assoc():false);if(!$J)$J=array($m->primary=>"");}if($J){foreach($J
as$y=>$X){if(!$Z)$J[$y]=null;$p[$y]=array("field"=>$y,"null"=>($y!=$m->primary),"auto_increment"=>($y==$m->primary));}}}edit_form($a,$p,$J,$Di);}elseif(isset($_GET["create"])){$a=$_GET["create"];$Mf=array();foreach(array('HASH','LINEAR HASH','KEY','LINEAR KEY','RANGE','LIST')as$y)$Mf[$y]=$y;$zg=referencable_primary($a);$dd=array();foreach($zg
as$Ih=>$o)$dd[str_replace("`","``",$Ih)."`".str_replace("`","``",$o["field"])]=$Ih;$_f=array();$S=array();if($a!=""){$_f=fields($a);$S=table_status($a);if(!$S)$n='No tables.';}$J=$_POST;$J["fields"]=(array)$J["fields"];if($J["auto_increment_col"])$J["fields"][$J["auto_increment_col"]]["auto_increment"]=true;if($_POST&&!process_fields($J["fields"])&&!$n){if($_POST["drop"])queries_redirect(substr(ME,0,-1),'Table has been dropped.',drop_tables(array($a)));else{$p=array();$Da=array();$Ii=false;$bd=array();$zf=reset($_f);$Aa=" FIRST";foreach($J["fields"]as$y=>$o){$q=$dd[$o["type"]];$ui=($q!==null?$zg[$q]:$o);if($o["field"]!=""){if(!$o["has_default"])$o["default"]=null;if($y==$J["auto_increment_col"])$o["auto_increment"]=true;$lg=process_field($o,$ui);$Da[]=array($o["orig"],$lg,$Aa);if($lg!=process_field($zf,$zf)){$p[]=array($o["orig"],$lg,$Aa);if($o["orig"]!=""||$Aa)$Ii=true;}if($q!==null)$bd[idf_escape($o["field"])]=($a!=""&&$x!="sqlite"?"ADD":" ").format_foreign_key(array('table'=>$dd[$o["type"]],'source'=>array($o["field"]),'target'=>array($ui["field"]),'on_delete'=>$o["on_delete"],));$Aa=" AFTER ".idf_escape($o["field"]);}elseif($o["orig"]!=""){$Ii=true;$p[]=array($o["orig"]);}if($o["orig"]!=""){$zf=next($_f);if(!$zf)$Aa="";}}$Of="";if($Mf[$J["partition_by"]]){$Pf=array();if($J["partition_by"]=='RANGE'||$J["partition_by"]=='LIST'){foreach(array_filter($J["partition_names"])as$y=>$X){$Y=$J["partition_values"][$y];$Pf[]="\n  PARTITION ".idf_escape($X)." VALUES ".($J["partition_by"]=='RANGE'?"LESS THAN":"IN").($Y!=""?" ($Y)":" MAXVALUE");}}$Of.="\nPARTITION BY $J[partition_by]($J[partition])".($Pf?" (".implode(",",$Pf)."\n)":($J["partitions"]?" PARTITIONS ".(+$J["partitions"]):""));}elseif(support("partitioning")&&preg_match("~partitioned~",$S["Create_options"]))$Of.="\nREMOVE PARTITIONING";$He='Table has been altered.';if($a==""){cookie("adminer_engine",$J["Engine"]);$He='Table has been created.';}$C=trim($J["name"]);queries_redirect(ME.(support("table")?"table=":"select=").urlencode($C),$He,alter_table($a,$C,($x=="sqlite"&&($Ii||$bd)?$Da:$p),$bd,($J["Comment"]!=$S["Comment"]?$J["Comment"]:null),($J["Engine"]&&$J["Engine"]!=$S["Engine"]?$J["Engine"]:""),($J["Collation"]&&$J["Collation"]!=$S["Collation"]?$J["Collation"]:""),($J["Auto_increment"]!=""?number($J["Auto_increment"]):""),$Of));}}page_header(($a!=""?'Alter table':'Create table'),$n,array("table"=>$a),h($a));if(!$_POST){$J=array("Engine"=>$_COOKIE["adminer_engine"],"fields"=>array(array("field"=>"","type"=>(isset($wi["int"])?"int":(isset($wi["integer"])?"integer":"")),"on_update"=>"")),"partition_names"=>array(""),);if($a!=""){$J=$S;$J["name"]=$a;$J["fields"]=array();if(!$_GET["auto_increment"])$J["Auto_increment"]="";foreach($_f
as$o){$o["has_default"]=isset($o["default"]);$J["fields"][]=$o;}if(support("partitioning")){$id="FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = ".q(DB)." AND TABLE_NAME = ".q($a);$H=$g->query("SELECT PARTITION_METHOD, PARTITION_ORDINAL_POSITION, PARTITION_EXPRESSION $id ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");list($J["partition_by"],$J["partitions"],$J["partition"])=$H->fetch_row();$Pf=get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $id AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");$Pf[""]="";$J["partition_names"]=array_keys($Pf);$J["partition_values"]=array_values($Pf);}}}$ob=collations();$uc=engines();foreach($uc
as$tc){if(!strcasecmp($tc,$J["Engine"])){$J["Engine"]=$tc;break;}}echo'
<form action="" method="post" id="form">
<p>
';if(support("columns")||$a==""){echo'Table name: <input name="name" maxlength="64" value="',h($J["name"]),'" autocapitalize="off">
';if($a==""&&!$_POST)echo
script("focus(qs('#form')['name']);");echo($uc?"<select name='Engine'>".optionlist(array(""=>"(".'engine'.")")+$uc,$J["Engine"])."</select>".on_help("getTarget(event).value",1).script("qsl('select').onchange = helpClose;"):""),' ',($ob&&!preg_match("~sqlite|mssql~",$x)?html_select("Collation",array(""=>"(".'collation'.")")+$ob,$J["Collation"]):""),' <input type="submit" value="Save">
';}echo'
';if(support("columns")){echo'<table cellspacing="0" id="edit-fields" class="nowrap">
';$ub=($_POST?$_POST["comments"]:$J["Comment"]!="");if(!$_POST&&!$ub){foreach($J["fields"]as$o){if($o["comment"]!=""){$ub=true;break;}}}edit_fields($J["fields"],$ob,"TABLE",$dd,$ub);echo'</table>
<p>
Auto Increment: <input type="number" name="Auto_increment" size="6" value="',h($J["Auto_increment"]),'">
',checkbox("defaults",1,!$_POST||$_POST["defaults"],'Default values',"columnShow(this.checked, 5)","jsonly"),($_POST?"":script("editingHideDefaults();")),(support("comment")?"<label><input type='checkbox' name='comments' value='1' class='jsonly'".($ub?" checked":"").">".'Comment'."</label>".script("qsl('input').onclick = partial(editingCommentsClick, true);").' <input name="Comment" value="'.h($J["Comment"]).'" maxlength="'.(min_version(5.5)?2048:60).'"'.($ub?'':' class="hidden"').'>':''),'<p>
<input type="submit" value="Save">
';}echo'
';if($a!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$a));}if(support("partitioning")){$Nf=preg_match('~RANGE|LIST~',$J["partition_by"]);print_fieldset("partition",'Partition by',$J["partition_by"]);echo'<p>
',"<select name='partition_by'>".optionlist(array(""=>"")+$Mf,$J["partition_by"])."</select>".on_help("getTarget(event).value.replace(/./, 'PARTITION BY \$&')",1).script("qsl('select').onchange = partitionByChange;"),'(<input name="partition" value="',h($J["partition"]),'">)
Partitions: <input type="number" name="partitions" class="size',($Nf||!$J["partition_by"]?" hidden":""),'" value="',h($J["partitions"]),'">
<table cellspacing="0" id="partition-table"',($Nf?"":" class='hidden'"),'>
<thead><tr><th>Partition name<th>Values</thead>
';foreach($J["partition_names"]as$y=>$X){echo'<tr>','<td><input name="partition_names[]" value="'.h($X).'" autocapitalize="off">',($y==count($J["partition_names"])-1?script("qsl('input').oninput = partitionNameChange;"):''),'<td><input name="partition_values[]" value="'.h($J["partition_values"][$y]).'">';}echo'</table>
</div></fieldset>
';}echo'<input type="hidden" name="token" value="',$hi,'">
</form>
',script("qs('#form')['defaults'].onclick();".(support("comment")?" editingCommentsClick.call(qs('#form')['comments']);":""));}elseif(isset($_GET["indexes"])){$a=$_GET["indexes"];$Gd=array("PRIMARY","UNIQUE","INDEX");$S=table_status($a,true);if(preg_match('~MyISAM|M?aria'.(min_version(5.6,'10.0.5')?'|InnoDB':'').'~i',$S["Engine"]))$Gd[]="FULLTEXT";if(preg_match('~MyISAM|M?aria'.(min_version(5.7,'10.2.2')?'|InnoDB':'').'~i',$S["Engine"]))$Gd[]="SPATIAL";$w=indexes($a);$eg=array();if($x=="mongo"){$eg=$w["_id_"];unset($Gd[0]);unset($w["_id_"]);}$J=$_POST;if($_POST&&!$n&&!$_POST["add"]&&!$_POST["drop_col"]){$c=array();foreach($J["indexes"]as$v){$C=$v["name"];if(in_array($v["type"],$Gd)){$f=array();$re=array();$Wb=array();$O=array();ksort($v["columns"]);foreach($v["columns"]as$y=>$e){if($e!=""){$qe=$v["lengths"][$y];$Vb=$v["descs"][$y];$O[]=idf_escape($e).($qe?"(".(+$qe).")":"").($Vb?" DESC":"");$f[]=$e;$re[]=($qe?$qe:null);$Wb[]=$Vb;}}if($f){$Cc=$w[$C];if($Cc){ksort($Cc["columns"]);ksort($Cc["lengths"]);ksort($Cc["descs"]);if($v["type"]==$Cc["type"]&&array_values($Cc["columns"])===$f&&(!$Cc["lengths"]||array_values($Cc["lengths"])===$re)&&array_values($Cc["descs"])===$Wb){unset($w[$C]);continue;}}$c[]=array($v["type"],$C,$O);}}}foreach($w
as$C=>$Cc)$c[]=array($Cc["type"],$C,"DROP");if(!$c)redirect(ME."table=".urlencode($a));queries_redirect(ME."table=".urlencode($a),'Indexes have been altered.',alter_indexes($a,$c));}page_header('Indexes',$n,array("table"=>$a),h($a));$p=array_keys(fields($a));if($_POST["add"]){foreach($J["indexes"]as$y=>$v){if($v["columns"][count($v["columns"])]!="")$J["indexes"][$y]["columns"][]="";}$v=end($J["indexes"]);if($v["type"]||array_filter($v["columns"],'strlen'))$J["indexes"][]=array("columns"=>array(1=>""));}if(!$J){foreach($w
as$y=>$v){$w[$y]["name"]=$y;$w[$y]["columns"][]="";}$w[]=array("columns"=>array(1=>""));$J["indexes"]=$w;}echo'
<form action="" method="post">
<table cellspacing="0" class="nowrap">
<thead><tr>
<th id="label-type">Index Type
<th><input type="submit" class="wayoff">Column (length)
<th id="label-name">Name
<th><noscript>',"<input type='image' class='icon' name='add[0]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.6.3")."' alt='+' title='".'Add next'."'>",'</noscript>
</thead>
';if($eg){echo"<tr><td>PRIMARY<td>";foreach($eg["columns"]as$y=>$e){echo
select_input(" disabled",$p,$e),"<label><input disabled type='checkbox'>".'descending'."</label> ";}echo"<td><td>\n";}$Zd=1;foreach($J["indexes"]as$v){if(!$_POST["drop_col"]||$Zd!=key($_POST["drop_col"])){echo"<tr><td>".html_select("indexes[$Zd][type]",array(-1=>"")+$Gd,$v["type"],($Zd==count($J["indexes"])?"indexesAddRow.call(this);":1),"label-type"),"<td>";ksort($v["columns"]);$s=1;foreach($v["columns"]as$y=>$e){echo"<span>".select_input(" name='indexes[$Zd][columns][$s]' title='".'Column'."'",($p?array_combine($p,$p):$p),$e,"partial(".($s==count($v["columns"])?"indexesAddColumn":"indexesChangeColumn").", '".js_escape($x=="sql"?"":$_GET["indexes"]."_")."')"),($x=="sql"||$x=="mssql"?"<input type='number' name='indexes[$Zd][lengths][$s]' class='size' value='".h($v["lengths"][$y])."' title='".'Length'."'>":""),($x!="sql"?checkbox("indexes[$Zd][descs][$s]",1,$v["descs"][$y],'descending'):"")," </span>";$s++;}echo"<td><input name='indexes[$Zd][name]' value='".h($v["name"])."' autocapitalize='off' aria-labelledby='label-name'>\n","<td><input type='image' class='icon' name='drop_col[$Zd]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.6.3")."' alt='x' title='".'Remove'."'>".script("qsl('input').onclick = partial(editingRemoveRow, 'indexes\$1[type]');");}$Zd++;}echo'</table>
<p>
<input type="submit" value="Save">
<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["database"])){$J=$_POST;if($_POST&&!$n&&!isset($_POST["add_x"])){$C=trim($J["name"]);if($_POST["drop"]){$_GET["db"]="";queries_redirect(remove_from_uri("db|database"),'Database has been dropped.',drop_databases(array(DB)));}elseif(DB!==$C){if(DB!=""){$_GET["db"]=$C;queries_redirect(preg_replace('~\bdb=[^&]*&~','',ME)."db=".urlencode($C),'Database has been renamed.',rename_database($C,$J["collation"]));}else{$k=explode("\n",str_replace("\r","",$C));$Ch=true;$ke="";foreach($k
as$l){if(count($k)==1||$l!=""){if(!create_database($l,$J["collation"]))$Ch=false;$ke=$l;}}restart_session();set_session("dbs",null);queries_redirect(ME."db=".urlencode($ke),'Database has been created.',$Ch);}}else{if(!$J["collation"])redirect(substr(ME,0,-1));query_redirect("ALTER DATABASE ".idf_escape($C).(preg_match('~^[a-z0-9_]+$~i',$J["collation"])?" COLLATE $J[collation]":""),substr(ME,0,-1),'Database has been altered.');}}page_header(DB!=""?'Alter database':'Create database',$n,array(),h(DB));$ob=collations();$C=DB;if($_POST)$C=$J["name"];elseif(DB!="")$J["collation"]=db_collation(DB,$ob);elseif($x=="sql"){foreach(get_vals("SHOW GRANTS")as$kd){if(preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\.\*)?~',$kd,$B)&&$B[1]){$C=stripcslashes(idf_unescape("`$B[2]`"));break;}}}echo'
<form action="" method="post">
<p>
',($_POST["add_x"]||strpos($C,"\n")?'<textarea id="name" name="name" rows="10" cols="40">'.h($C).'</textarea><br>':'<input name="name" id="name" value="'.h($C).'" maxlength="64" autocapitalize="off">')."\n".($ob?html_select("collation",array(""=>"(".'collation'.")")+$ob,$J["collation"]).doc_link(array('sql'=>"charset-charsets.html",'mariadb'=>"supported-character-sets-and-collations/",'mssql'=>"ms187963.aspx",)):""),script("focus(qs('#name'));"),'<input type="submit" value="Save">
';if(DB!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',DB))."\n";elseif(!$_POST["add_x"]&&$_GET["db"]=="")echo"<input type='image' class='icon' name='add' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.6.3")."' alt='+' title='".'Add next'."'>\n";echo'<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["scheme"])){$J=$_POST;if($_POST&&!$n){$_=preg_replace('~ns=[^&]*&~','',ME)."ns=";if($_POST["drop"])query_redirect("DROP SCHEMA ".idf_escape($_GET["ns"]),$_,'Schema has been dropped.');else{$C=trim($J["name"]);$_.=urlencode($C);if($_GET["ns"]=="")query_redirect("CREATE SCHEMA ".idf_escape($C),$_,'Schema has been created.');elseif($_GET["ns"]!=$C)query_redirect("ALTER SCHEMA ".idf_escape($_GET["ns"])." RENAME TO ".idf_escape($C),$_,'Schema has been altered.');else
redirect($_);}}page_header($_GET["ns"]!=""?'Alter schema':'Create schema',$n);if(!$J)$J["name"]=$_GET["ns"];echo'
<form action="" method="post">
<p><input name="name" id="name" value="',h($J["name"]),'" autocapitalize="off">
',script("focus(qs('#name'));"),'<input type="submit" value="Save">
';if($_GET["ns"]!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$_GET["ns"]))."\n";echo'<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["call"])){$da=($_GET["name"]?$_GET["name"]:$_GET["call"]);page_header('Call'.": ".h($da),$n);$Og=routine($_GET["call"],(isset($_GET["callf"])?"FUNCTION":"PROCEDURE"));$Ed=array();$Df=array();foreach($Og["fields"]as$s=>$o){if(substr($o["inout"],-3)=="OUT")$Df[$s]="@".idf_escape($o["field"])." AS ".idf_escape($o["field"]);if(!$o["inout"]||substr($o["inout"],0,2)=="IN")$Ed[]=$s;}if(!$n&&$_POST){$Za=array();foreach($Og["fields"]as$y=>$o){if(in_array($y,$Ed)){$X=process_input($o);if($X===false)$X="''";if(isset($Df[$y]))$g->query("SET @".idf_escape($o["field"])." = $X");}$Za[]=(isset($Df[$y])?"@".idf_escape($o["field"]):$X);}$G=(isset($_GET["callf"])?"SELECT":"CALL")." ".table($da)."(".implode(", ",$Za).")";$xh=microtime(true);$H=$g->multi_query($G);$za=$g->affected_rows;echo$b->selectQuery($G,$xh,!$H);if(!$H)echo"<p class='error'>".error()."\n";else{$h=connect();if(is_object($h))$h->select_db(DB);do{$H=$g->store_result();if(is_object($H))select($H,$h);else
echo"<p class='message'>".lang(array('Routine has been called, %d row affected.','Routine has been called, %d rows affected.'),$za)."\n";}while($g->next_result());if($Df)select($g->query("SELECT ".implode(", ",$Df)));}}echo'
<form action="" method="post">
';if($Ed){echo"<table cellspacing='0'>\n";foreach($Ed
as$y){$o=$Og["fields"][$y];$C=$o["field"];echo"<tr><th>".$b->fieldName($o);$Y=$_POST["fields"][$C];if($Y!=""){if($o["type"]=="enum")$Y=+$Y;if($o["type"]=="set")$Y=array_sum($Y);}input($o,$Y,(string)$_POST["function"][$C]);echo"\n";}echo"</table>\n";}echo'<p>
<input type="submit" value="Call">
<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["foreign"])){$a=$_GET["foreign"];$C=$_GET["name"];$J=$_POST;if($_POST&&!$n&&!$_POST["add"]&&!$_POST["change"]&&!$_POST["change-js"]){$He=($_POST["drop"]?'Foreign key has been dropped.':($C!=""?'Foreign key has been altered.':'Foreign key has been created.'));$A=ME."table=".urlencode($a);if(!$_POST["drop"]){$J["source"]=array_filter($J["source"],'strlen');ksort($J["source"]);$Qh=array();foreach($J["source"]as$y=>$X)$Qh[$y]=$J["target"][$y];$J["target"]=$Qh;}if($x=="sqlite")queries_redirect($A,$He,recreate_table($a,$a,array(),array(),array(" $C"=>($_POST["drop"]?"":" ".format_foreign_key($J)))));else{$c="ALTER TABLE ".table($a);$ec="\nDROP ".($x=="sql"?"FOREIGN KEY ":"CONSTRAINT ").idf_escape($C);if($_POST["drop"])query_redirect($c.$ec,$A,$He);else{query_redirect($c.($C!=""?"$ec,":"")."\nADD".format_foreign_key($J),$A,$He);$n='Source and target columns must have the same data type, there must be an index on the target columns and referenced data must exist.'."<br>$n";}}}page_header('Foreign key',$n,array("table"=>$a),h($a));if($_POST){ksort($J["source"]);if($_POST["add"])$J["source"][]="";elseif($_POST["change"]||$_POST["change-js"])$J["target"]=array();}elseif($C!=""){$dd=foreign_keys($a);$J=$dd[$C];$J["source"][]="";}else{$J["table"]=$a;$J["source"]=array("");}$ph=array_keys(fields($a));$Qh=($a===$J["table"]?$ph:array_keys(fields($J["table"])));$yg=array_keys(array_filter(table_status('',true),'fk_support'));echo'
<form action="" method="post">
<p>
';if($J["db"]==""&&$J["ns"]==""){echo'Target table:
',html_select("table",$yg,$J["table"],"this.form['change-js'].value = '1'; this.form.submit();"),'<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="Change"></noscript>
<table cellspacing="0">
<thead><tr><th id="label-source">Source<th id="label-target">Target</thead>
';$Zd=0;foreach($J["source"]as$y=>$X){echo"<tr>","<td>".html_select("source[".(+$y)."]",array(-1=>"")+$ph,$X,($Zd==count($J["source"])-1?"foreignAddRow.call(this);":1),"label-source"),"<td>".html_select("target[".(+$y)."]",$Qh,$J["target"][$y],1,"label-target");$Zd++;}echo'</table>
<p>
ON DELETE: ',html_select("on_delete",array(-1=>"")+explode("|",$kf),$J["on_delete"]),' ON UPDATE: ',html_select("on_update",array(-1=>"")+explode("|",$kf),$J["on_update"]),doc_link(array('sql'=>"innodb-foreign-key-constraints.html",'mariadb'=>"foreign-keys/",'pgsql'=>"sql-createtable.html#SQL-CREATETABLE-REFERENCES",'mssql'=>"ms174979.aspx",'oracle'=>"clauses002.htm#sthref2903",)),'<p>
<input type="submit" value="Save">
<noscript><p><input type="submit" name="add" value="Add column"></noscript>
';}if($C!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$C));}echo'<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["view"])){$a=$_GET["view"];$J=$_POST;$Af="VIEW";if($x=="pgsql"&&$a!=""){$P=table_status($a);$Af=strtoupper($P["Engine"]);}if($_POST&&!$n){$C=trim($J["name"]);$Ga=" AS\n$J[select]";$A=ME."table=".urlencode($C);$He='View has been altered.';$U=($_POST["materialized"]?"MATERIALIZED VIEW":"VIEW");if(!$_POST["drop"]&&$a==$C&&$x!="sqlite"&&$U=="VIEW"&&$Af=="VIEW")query_redirect(($x=="mssql"?"ALTER":"CREATE OR REPLACE")." VIEW ".table($C).$Ga,$A,$He);else{$Sh=$C."_adminer_".uniqid();drop_create("DROP $Af ".table($a),"CREATE $U ".table($C).$Ga,"DROP $U ".table($C),"CREATE $U ".table($Sh).$Ga,"DROP $U ".table($Sh),($_POST["drop"]?substr(ME,0,-1):$A),'View has been dropped.',$He,'View has been created.',$a,$C);}}if(!$_POST&&$a!=""){$J=view($a);$J["name"]=$a;$J["materialized"]=($Af!="VIEW");if(!$n)$n=error();}page_header(($a!=""?'Alter view':'Create view'),$n,array("table"=>$a),h($a));echo'
<form action="" method="post">
<p>Name: <input name="name" value="',h($J["name"]),'" maxlength="64" autocapitalize="off">
',(support("materializedview")?" ".checkbox("materialized",1,$J["materialized"],'Materialized view'):""),'<p>';textarea("select",$J["select"]);echo'<p>
<input type="submit" value="Save">
';if($a!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$a));}echo'<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["event"])){$aa=$_GET["event"];$Rd=array("YEAR","QUARTER","MONTH","DAY","HOUR","MINUTE","WEEK","SECOND","YEAR_MONTH","DAY_HOUR","DAY_MINUTE","DAY_SECOND","HOUR_MINUTE","HOUR_SECOND","MINUTE_SECOND");$zh=array("ENABLED"=>"ENABLE","DISABLED"=>"DISABLE","SLAVESIDE_DISABLED"=>"DISABLE ON SLAVE");$J=$_POST;if($_POST&&!$n){if($_POST["drop"])query_redirect("DROP EVENT ".idf_escape($aa),substr(ME,0,-1),'Event has been dropped.');elseif(in_array($J["INTERVAL_FIELD"],$Rd)&&isset($zh[$J["STATUS"]])){$Tg="\nON SCHEDULE ".($J["INTERVAL_VALUE"]?"EVERY ".q($J["INTERVAL_VALUE"])." $J[INTERVAL_FIELD]".($J["STARTS"]?" STARTS ".q($J["STARTS"]):"").($J["ENDS"]?" ENDS ".q($J["ENDS"]):""):"AT ".q($J["STARTS"]))." ON COMPLETION".($J["ON_COMPLETION"]?"":" NOT")." PRESERVE";queries_redirect(substr(ME,0,-1),($aa!=""?'Event has been altered.':'Event has been created.'),queries(($aa!=""?"ALTER EVENT ".idf_escape($aa).$Tg.($aa!=$J["EVENT_NAME"]?"\nRENAME TO ".idf_escape($J["EVENT_NAME"]):""):"CREATE EVENT ".idf_escape($J["EVENT_NAME"]).$Tg)."\n".$zh[$J["STATUS"]]." COMMENT ".q($J["EVENT_COMMENT"]).rtrim(" DO\n$J[EVENT_DEFINITION]",";").";"));}}page_header(($aa!=""?'Alter event'.": ".h($aa):'Create event'),$n);if(!$J&&$aa!=""){$K=get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = ".q(DB)." AND EVENT_NAME = ".q($aa));$J=reset($K);}echo'
<form action="" method="post">
<table cellspacing="0">
<tr><th>Name<td><input name="EVENT_NAME" value="',h($J["EVENT_NAME"]),'" maxlength="64" autocapitalize="off">
<tr><th title="datetime">Start<td><input name="STARTS" value="',h("$J[EXECUTE_AT]$J[STARTS]"),'">
<tr><th title="datetime">End<td><input name="ENDS" value="',h($J["ENDS"]),'">
<tr><th>Every<td><input type="number" name="INTERVAL_VALUE" value="',h($J["INTERVAL_VALUE"]),'" class="size"> ',html_select("INTERVAL_FIELD",$Rd,$J["INTERVAL_FIELD"]),'<tr><th>Status<td>',html_select("STATUS",$zh,$J["STATUS"]),'<tr><th>Comment<td><input name="EVENT_COMMENT" value="',h($J["EVENT_COMMENT"]),'" maxlength="64">
<tr><th><td>',checkbox("ON_COMPLETION","PRESERVE",$J["ON_COMPLETION"]=="PRESERVE",'On completion preserve'),'</table>
<p>';textarea("EVENT_DEFINITION",$J["EVENT_DEFINITION"]);echo'<p>
<input type="submit" value="Save">
';if($aa!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$aa));}echo'<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["procedure"])){$da=($_GET["name"]?$_GET["name"]:$_GET["procedure"]);$Og=(isset($_GET["function"])?"FUNCTION":"PROCEDURE");$J=$_POST;$J["fields"]=(array)$J["fields"];if($_POST&&!process_fields($J["fields"])&&!$n){$yf=routine($_GET["procedure"],$Og);$Sh="$J[name]_adminer_".uniqid();drop_create("DROP $Og ".routine_id($da,$yf),create_routine($Og,$J),"DROP $Og ".routine_id($J["name"],$J),create_routine($Og,array("name"=>$Sh)+$J),"DROP $Og ".routine_id($Sh,$J),substr(ME,0,-1),'Routine has been dropped.','Routine has been altered.','Routine has been created.',$da,$J["name"]);}page_header(($da!=""?(isset($_GET["function"])?'Alter function':'Alter procedure').": ".h($da):(isset($_GET["function"])?'Create function':'Create procedure')),$n);if(!$_POST&&$da!=""){$J=routine($_GET["procedure"],$Og);$J["name"]=$da;}$ob=get_vals("SHOW CHARACTER SET");sort($ob);$Pg=routine_languages();echo'
<form action="" method="post" id="form">
<p>Name: <input name="name" value="',h($J["name"]),'" maxlength="64" autocapitalize="off">
',($Pg?'Language'.": ".html_select("language",$Pg,$J["language"])."\n":""),'<input type="submit" value="Save">
<table cellspacing="0" class="nowrap">
';edit_fields($J["fields"],$ob,$Og);if(isset($_GET["function"])){echo"<tr><td>".'Return type';edit_type("returns",$J["returns"],$ob,array(),($x=="pgsql"?array("void","trigger"):array()));}echo'</table>
<p>';textarea("definition",$J["definition"]);echo'<p>
<input type="submit" value="Save">
';if($da!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$da));}echo'<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["sequence"])){$fa=$_GET["sequence"];$J=$_POST;if($_POST&&!$n){$_=substr(ME,0,-1);$C=trim($J["name"]);if($_POST["drop"])query_redirect("DROP SEQUENCE ".idf_escape($fa),$_,'Sequence has been dropped.');elseif($fa=="")query_redirect("CREATE SEQUENCE ".idf_escape($C),$_,'Sequence has been created.');elseif($fa!=$C)query_redirect("ALTER SEQUENCE ".idf_escape($fa)." RENAME TO ".idf_escape($C),$_,'Sequence has been altered.');else
redirect($_);}page_header($fa!=""?'Alter sequence'.": ".h($fa):'Create sequence',$n);if(!$J)$J["name"]=$fa;echo'
<form action="" method="post">
<p><input name="name" value="',h($J["name"]),'" autocapitalize="off">
<input type="submit" value="Save">
';if($fa!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$fa))."\n";echo'<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["type"])){$ga=$_GET["type"];$J=$_POST;if($_POST&&!$n){$_=substr(ME,0,-1);if($_POST["drop"])query_redirect("DROP TYPE ".idf_escape($ga),$_,'Type has been dropped.');else
query_redirect("CREATE TYPE ".idf_escape(trim($J["name"]))." $J[as]",$_,'Type has been created.');}page_header($ga!=""?'Alter type'.": ".h($ga):'Create type',$n);if(!$J)$J["as"]="AS ";echo'
<form action="" method="post">
<p>
';if($ga!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$ga))."\n";else{echo"<input name='name' value='".h($J['name'])."' autocapitalize='off'>\n";textarea("as",$J["as"]);echo"<p><input type='submit' value='".'Save'."'>\n";}echo'<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["trigger"])){$a=$_GET["trigger"];$C=$_GET["name"];$si=trigger_options();$J=(array)trigger($C)+array("Trigger"=>$a."_bi");if($_POST){if(!$n&&in_array($_POST["Timing"],$si["Timing"])&&in_array($_POST["Event"],$si["Event"])&&in_array($_POST["Type"],$si["Type"])){$jf=" ON ".table($a);$ec="DROP TRIGGER ".idf_escape($C).($x=="pgsql"?$jf:"");$A=ME."table=".urlencode($a);if($_POST["drop"])query_redirect($ec,$A,'Trigger has been dropped.');else{if($C!="")queries($ec);queries_redirect($A,($C!=""?'Trigger has been altered.':'Trigger has been created.'),queries(create_trigger($jf,$_POST)));if($C!="")queries(create_trigger($jf,$J+array("Type"=>reset($si["Type"]))));}}$J=$_POST;}page_header(($C!=""?'Alter trigger'.": ".h($C):'Create trigger'),$n,array("table"=>$a));echo'
<form action="" method="post" id="form">
<table cellspacing="0">
<tr><th>Time<td>',html_select("Timing",$si["Timing"],$J["Timing"],"triggerChange(/^".preg_quote($a,"/")."_[ba][iud]$/, '".js_escape($a)."', this.form);"),'<tr><th>Event<td>',html_select("Event",$si["Event"],$J["Event"],"this.form['Timing'].onchange();"),(in_array("UPDATE OF",$si["Event"])?" <input name='Of' value='".h($J["Of"])."' class='hidden'>":""),'<tr><th>Type<td>',html_select("Type",$si["Type"],$J["Type"]),'</table>
<p>Name: <input name="Trigger" value="',h($J["Trigger"]),'" maxlength="64" autocapitalize="off">
',script("qs('#form')['Timing'].onchange();"),'<p>';textarea("Statement",$J["Statement"]);echo'<p>
<input type="submit" value="Save">
';if($C!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$C));}echo'<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["user"])){$ha=$_GET["user"];$jg=array(""=>array("All privileges"=>""));foreach(get_rows("SHOW PRIVILEGES")as$J){foreach(explode(",",($J["Privilege"]=="Grant option"?"":$J["Context"]))as$_b)$jg[$_b][$J["Privilege"]]=$J["Comment"];}$jg["Server Admin"]+=$jg["File access on server"];$jg["Databases"]["Create routine"]=$jg["Procedures"]["Create routine"];unset($jg["Procedures"]["Create routine"]);$jg["Columns"]=array();foreach(array("Select","Insert","Update","References")as$X)$jg["Columns"][$X]=$jg["Tables"][$X];unset($jg["Server Admin"]["Usage"]);foreach($jg["Tables"]as$y=>$X)unset($jg["Databases"][$y]);$Ue=array();if($_POST){foreach($_POST["objects"]as$y=>$X)$Ue[$X]=(array)$Ue[$X]+(array)$_POST["grants"][$y];}$ld=array();$hf="";if(isset($_GET["host"])&&($H=$g->query("SHOW GRANTS FOR ".q($ha)."@".q($_GET["host"])))){while($J=$H->fetch_row()){if(preg_match('~GRANT (.*) ON (.*) TO ~',$J[0],$B)&&preg_match_all('~ *([^(,]*[^ ,(])( *\([^)]+\))?~',$B[1],$_e,PREG_SET_ORDER)){foreach($_e
as$X){if($X[1]!="USAGE")$ld["$B[2]$X[2]"][$X[1]]=true;if(preg_match('~ WITH GRANT OPTION~',$J[0]))$ld["$B[2]$X[2]"]["GRANT OPTION"]=true;}}if(preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~",$J[0],$B))$hf=$B[1];}}if($_POST&&!$n){$if=(isset($_GET["host"])?q($ha)."@".q($_GET["host"]):"''");if($_POST["drop"])query_redirect("DROP USER $if",ME."privileges=",'User has been dropped.');else{$We=q($_POST["user"])."@".q($_POST["host"]);$Rf=$_POST["pass"];if($Rf!=''&&!$_POST["hashed"]){$Rf=$g->result("SELECT PASSWORD(".q($Rf).")");$n=!$Rf;}$Eb=false;if(!$n){if($if!=$We){$Eb=queries((min_version(5)?"CREATE USER":"GRANT USAGE ON *.* TO")." $We IDENTIFIED BY PASSWORD ".q($Rf));$n=!$Eb;}elseif($Rf!=$hf)queries("SET PASSWORD FOR $We = ".q($Rf));}if(!$n){$Lg=array();foreach($Ue
as$cf=>$kd){if(isset($_GET["grant"]))$kd=array_filter($kd);$kd=array_keys($kd);if(isset($_GET["grant"]))$Lg=array_diff(array_keys(array_filter($Ue[$cf],'strlen')),$kd);elseif($if==$We){$ff=array_keys((array)$ld[$cf]);$Lg=array_diff($ff,$kd);$kd=array_diff($kd,$ff);unset($ld[$cf]);}if(preg_match('~^(.+)\s*(\(.*\))?$~U',$cf,$B)&&(!grant("REVOKE",$Lg,$B[2]," ON $B[1] FROM $We")||!grant("GRANT",$kd,$B[2]," ON $B[1] TO $We"))){$n=true;break;}}}if(!$n&&isset($_GET["host"])){if($if!=$We)queries("DROP USER $if");elseif(!isset($_GET["grant"])){foreach($ld
as$cf=>$Lg){if(preg_match('~^(.+)(\(.*\))?$~U',$cf,$B))grant("REVOKE",array_keys($Lg),$B[2]," ON $B[1] FROM $We");}}}queries_redirect(ME."privileges=",(isset($_GET["host"])?'User has been altered.':'User has been created.'),!$n);if($Eb)$g->query("DROP USER $We");}}page_header((isset($_GET["host"])?'Username'.": ".h("$ha@$_GET[host]"):'Create user'),$n,array("privileges"=>array('','Privileges')));if($_POST){$J=$_POST;$ld=$Ue;}else{$J=$_GET+array("host"=>$g->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)"));$J["pass"]=$hf;if($hf!="")$J["hashed"]=true;$ld[(DB==""||$ld?"":idf_escape(addcslashes(DB,"%_\\"))).".*"]=array();}echo'<form action="" method="post">
<table cellspacing="0">
<tr><th>Server<td><input name="host" maxlength="60" value="',h($J["host"]),'" autocapitalize="off">
<tr><th>Username<td><input name="user" maxlength="16" value="',h($J["user"]),'" autocapitalize="off">
<tr><th>Password<td><input name="pass" id="pass" value="',h($J["pass"]),'" autocomplete="new-password">
';if(!$J["hashed"])echo
script("typePassword(qs('#pass'));");echo
checkbox("hashed",1,$J["hashed"],'Hashed',"typePassword(this.form['pass'], this.checked);"),'</table>

';echo"<table cellspacing='0'>\n","<thead><tr><th colspan='2'>".'Privileges'.doc_link(array('sql'=>"grant.html#priv_level"));$s=0;foreach($ld
as$cf=>$kd){echo'<th>'.($cf!="*.*"?"<input name='objects[$s]' value='".h($cf)."' size='10' autocapitalize='off'>":"<input type='hidden' name='objects[$s]' value='*.*' size='10'>*.*");$s++;}echo"</thead>\n";foreach(array(""=>"","Server Admin"=>'Server',"Databases"=>'Database',"Tables"=>'Table',"Columns"=>'Column',"Procedures"=>'Routine',)as$_b=>$Vb){foreach((array)$jg[$_b]as$ig=>$tb){echo"<tr".odd()."><td".($Vb?">$Vb<td":" colspan='2'").' lang="en" title="'.h($tb).'">'.h($ig);$s=0;foreach($ld
as$cf=>$kd){$C="'grants[$s][".h(strtoupper($ig))."]'";$Y=$kd[strtoupper($ig)];if($_b=="Server Admin"&&$cf!=(isset($ld["*.*"])?"*.*":".*"))echo"<td>";elseif(isset($_GET["grant"]))echo"<td><select name=$C><option><option value='1'".($Y?" selected":"").">".'Grant'."<option value='0'".($Y=="0"?" selected":"").">".'Revoke'."</select>";else{echo"<td align='center'><label class='block'>","<input type='checkbox' name=$C value='1'".($Y?" checked":"").($ig=="All privileges"?" id='grants-$s-all'>":">".($ig=="Grant option"?"":script("qsl('input').onclick = function () { if (this.checked) formUncheck('grants-$s-all'); };"))),"</label>";}$s++;}}}echo"</table>\n",'<p>
<input type="submit" value="Save">
';if(isset($_GET["host"])){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',"$ha@$_GET[host]"));}echo'<input type="hidden" name="token" value="',$hi,'">
</form>
';}elseif(isset($_GET["processlist"])){if(support("kill")&&$_POST&&!$n){$ge=0;foreach((array)$_POST["kill"]as$X){if(kill_process($X))$ge++;}queries_redirect(ME."processlist=",lang(array('%d process has been killed.','%d processes have been killed.'),$ge),$ge||!$_POST["kill"]);}page_header('Process list',$n);echo'
<form action="" method="post">
<table cellspacing="0" class="nowrap checkable">
',script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});");$s=-1;foreach(process_list()as$s=>$J){if(!$s){echo"<thead><tr lang='en'>".(support("kill")?"<th>":"");foreach($J
as$y=>$X)echo"<th>$y".doc_link(array('sql'=>"show-processlist.html#processlist_".strtolower($y),'pgsql'=>"monitoring-stats.html#PG-STAT-ACTIVITY-VIEW",'oracle'=>"../b14237/dynviews_2088.htm",));echo"</thead>\n";}echo"<tr".odd().">".(support("kill")?"<td>".checkbox("kill[]",$J[$x=="sql"?"Id":"pid"],0):"");foreach($J
as$y=>$X)echo"<td>".(($x=="sql"&&$y=="Info"&&preg_match("~Query|Killed~",$J["Command"])&&$X!="")||($x=="pgsql"&&$y=="current_query"&&$X!="<IDLE>")||($x=="oracle"&&$y=="sql_text"&&$X!="")?"<code class='jush-$x'>".shorten_utf8($X,100,"</code>").' <a href="'.h(ME.($J["db"]!=""?"db=".urlencode($J["db"])."&":"")."sql=".urlencode($X)).'">'.'Clone'.'</a>':h($X));echo"\n";}echo'</table>
<p>
';if(support("kill")){echo($s+1)."/".sprintf('%d in total',max_connections()),"<p><input type='submit' value='".'Kill'."'>\n";}echo'<input type="hidden" name="token" value="',$hi,'">
</form>
',script("tableCheck();");}elseif(isset($_GET["select"])){$a=$_GET["select"];$S=table_status1($a);$w=indexes($a);$p=fields($a);$dd=column_foreign_keys($a);$ef=$S["Oid"];parse_str($_COOKIE["adminer_import"],$ya);$Mg=array();$f=array();$Wh=null;foreach($p
as$y=>$o){$C=$b->fieldName($o);if(isset($o["privileges"]["select"])&&$C!=""){$f[$y]=html_entity_decode(strip_tags($C),ENT_QUOTES);if(is_shortable($o))$Wh=$b->selectLengthProcess();}$Mg+=$o["privileges"];}list($L,$md)=$b->selectColumnsProcess($f,$w);$Vd=count($md)<count($L);$Z=$b->selectSearchProcess($p,$w);$uf=$b->selectOrderProcess($p,$w);$z=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$_i=>$J){$Ga=convert_field($p[key($J)]);$L=array($Ga?$Ga:idf_escape(key($J)));$Z[]=where_check($_i,$p);$I=$m->select($a,$L,$Z,$L);if($I)echo
reset($I->fetch_row());}exit;}$eg=$Bi=null;foreach($w
as$v){if($v["type"]=="PRIMARY"){$eg=array_flip($v["columns"]);$Bi=($L?$eg:array());foreach($Bi
as$y=>$X){if(in_array(idf_escape($y),$L))unset($Bi[$y]);}break;}}if($ef&&!$eg){$eg=$Bi=array($ef=>0);$w[]=array("type"=>"PRIMARY","columns"=>array($ef));}if($_POST&&!$n){$cj=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$fb=array();foreach($_POST["check"]as$cb)$fb[]=where_check($cb,$p);$cj[]="((".implode(") OR (",$fb)."))";}$cj=($cj?"\nWHERE ".implode(" AND ",$cj):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$id=($L?implode(", ",$L):"*").convert_fields($f,$p,$L)."\nFROM ".table($a);$od=($md&&$Vd?"\nGROUP BY ".implode(", ",$md):"").($uf?"\nORDER BY ".implode(", ",$uf):"");if(!is_array($_POST["check"])||$eg)$G="SELECT $id$cj$od";else{$yi=array();foreach($_POST["check"]as$X)$yi[]="(SELECT".limit($id,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p).$od,1).")";$G=implode(" UNION ALL ",$yi);}$b->dumpData($a,"table",$G);exit;}if(!$b->selectEmailProcess($Z,$dd)){if($_POST["save"]||$_POST["delete"]){$H=true;$za=0;$O=array();if(!$_POST["delete"]){foreach($f
as$C=>$X){$X=process_input($p[$C]);if($X!==null&&($_POST["clone"]||$X!==false))$O[idf_escape($C)]=($X!==false?$X:idf_escape($C));}}if($_POST["delete"]||$O){if($_POST["clone"])$G="INTO ".table($a)." (".implode(", ",array_keys($O)).")\nSELECT ".implode(", ",$O)."\nFROM ".table($a);if($_POST["all"]||($eg&&is_array($_POST["check"]))||$Vd){$H=($_POST["delete"]?$m->delete($a,$cj):($_POST["clone"]?queries("INSERT $G$cj"):$m->update($a,$O,$cj)));$za=$g->affected_rows;}else{foreach((array)$_POST["check"]as$X){$Yi="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p);$H=($_POST["delete"]?$m->delete($a,$Yi,1):($_POST["clone"]?queries("INSERT".limit1($a,$G,$Yi)):$m->update($a,$O,$Yi,1)));if(!$H)break;$za+=$g->affected_rows;}}}$He=lang(array('%d item has been affected.','%d items have been affected.'),$za);if($_POST["clone"]&&$H&&$za==1){$le=last_id();if($le)$He=sprintf('Item%s has been inserted.'," $le");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$He,$H);if(!$_POST["delete"]){edit_form($a,$p,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$n='Ctrl+click on a value to modify it.';else{$H=true;$za=0;foreach($_POST["val"]as$_i=>$J){$O=array();foreach($J
as$y=>$X){$y=bracket_escape($y,1);$O[idf_escape($y)]=(preg_match('~char|text~',$p[$y]["type"])||$X!=""?$b->processInput($p[$y],$X):"NULL");}$H=$m->update($a,$O," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($_i,$p),!$Vd&&!$eg," ");if(!$H)break;$za+=$g->affected_rows;}queries_redirect(remove_from_uri(),lang(array('%d item has been affected.','%d items have been affected.'),$za),$H);}}elseif(!is_string($Sc=get_file("csv_file",true)))$n=upload_error($Sc);elseif(!preg_match('~~u',$Sc))$n='File must be in UTF-8 encoding.';else{cookie("adminer_import","output=".urlencode($ya["output"])."&format=".urlencode($_POST["separator"]));$H=true;$qb=array_keys($p);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$Sc,$_e);$za=count($_e[0]);$m->begin();$M=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$K=array();foreach($_e[0]as$y=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$M]*)$M~",$X.$M,$Ae);if(!$y&&!array_diff($Ae[1],$qb)){$qb=$Ae[1];$za--;}else{$O=array();foreach($Ae[1]as$s=>$mb)$O[idf_escape($qb[$s])]=($mb==""&&$p[$qb[$s]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$mb))));$K[]=$O;}}$H=(!$K||$m->insertUpdate($a,$K,$eg));if($H)$H=$m->commit();queries_redirect(remove_from_uri("page"),lang(array('%d row has been imported.','%d rows have been imported.'),$za),$H);$m->rollback();}}}$Ih=$b->tableName($S);if(is_ajax()){page_headers();ob_start();}else
page_header('Select'.": $Ih",$n);$O=null;if(isset($Mg["insert"])||!support("table")){$O="";foreach((array)$_GET["where"]as$X){if($dd[$X["col"]]&&count($dd[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$O.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($S,$O);if(!$f&&support("table"))echo"<p class='error'>".'Unable to select the table'.($p?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($L,$f);$b->selectSearchPrint($Z,$f,$w);$b->selectOrderPrint($uf,$f,$w);$b->selectLimitPrint($z);$b->selectLengthPrint($Wh);$b->selectActionPrint($w);echo"</form>\n";$E=$_GET["page"];if($E=="last"){$gd=$g->result(count_rows($a,$Z,$Vd,$md));$E=floor(max(0,$gd-1)/$z);}$Yg=$L;$nd=$md;if(!$Yg){$Yg[]="*";$Ab=convert_fields($f,$p,$L);if($Ab)$Yg[]=substr($Ab,2);}foreach($L
as$y=>$X){$o=$p[idf_unescape($X)];if($o&&($Ga=convert_field($o)))$Yg[$y]="$Ga AS $X";}if(!$Vd&&$Bi){foreach($Bi
as$y=>$X){$Yg[]=idf_escape($y);if($nd)$nd[]=idf_escape($y);}}$H=$m->select($a,$Yg,$Z,$nd,$uf,$z,$E,true);if(!$H)echo"<p class='error'>".error()."\n";else{if($x=="mssql"&&$E)$H->seek($z*$E);$rc=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$K=array();while($J=$H->fetch_assoc()){if($E&&$x=="oracle")unset($J["RNUM"]);$K[]=$J;}if($_GET["page"]!="last"&&$z!=""&&$md&&$Vd&&$x=="sql")$gd=$g->result(" SELECT FOUND_ROWS()");if(!$K)echo"<p class='message'>".'No rows.'."\n";else{$Pa=$b->backwardKeys($a,$Ih);echo"<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$md&&$L?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".'Modify'."</a>");$Te=array();$jd=array();reset($L);$tg=1;foreach($K[0]as$y=>$X){if(!isset($Bi[$y])){$X=$_GET["columns"][key($L)];$o=$p[$L?($X?$X["col"]:current($L)):$y];$C=($o?$b->fieldName($o,$tg):($X["fun"]?"*":$y));if($C!=""){$tg++;$Te[$y]=$C;$e=idf_escape($y);$Ad=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($y);$Vb="&desc%5B0%5D=1";echo"<th>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Ad.($uf[0]==$e||$uf[0]==$y||(!$uf&&$Vd&&$md[0]==$e)?$Vb:'')).'">';echo
apply_sql_function($X["fun"],$C)."</a>";echo"<span class='column hidden'>","<a href='".h($Ad.$Vb)."' title='".'descending'."' class='text'> ↓</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.'Search'.'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($y)."');");}echo"</span>";}$jd[$y]=$X["fun"];next($L);}}$re=array();if($_GET["modify"]){foreach($K
as$J){foreach($J
as$y=>$X)$re[$y]=max($re[$y],min(40,strlen(utf8_decode($X))));}}echo($Pa?"<th>".'Relations':"")."</thead>\n";if(is_ajax()){if($z%2==1&&$E%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($K,$dd)as$Se=>$J){$zi=unique_array($K[$Se],$w);if(!$zi){$zi=array();foreach($K[$Se]as$y=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$y))$zi[$y]=$X;}}$_i="";foreach($zi
as$y=>$X){if(($x=="sql"||$x=="pgsql")&&preg_match('~char|text|enum|set~',$p[$y]["type"])&&strlen($X)>64){$y=(strpos($y,'(')?$y:idf_escape($y));$y="MD5(".($x!='sql'||preg_match("~^utf8~",$p[$y]["collation"])?$y:"CONVERT($y USING ".charset($g).")").")";$X=md5($X);}$_i.="&".($X!==null?urlencode("where[".bracket_escape($y)."]")."=".urlencode($X):"null%5B%5D=".urlencode($y));}echo"<tr".odd().">".(!$md&&$L?"":"<td>".checkbox("check[]",substr($_i,1),in_array(substr($_i,1),(array)$_POST["check"])).($Vd||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$_i)."' class='edit'>".'edit'."</a>"));foreach($J
as$y=>$X){if(isset($Te[$y])){$o=$p[$y];$X=$m->value($X,$o);if($X!=""&&(!isset($rc[$y])||$rc[$y]!=""))$rc[$y]=(is_mail($X)?$Te[$y]:"");$_="";if(preg_match('~blob|bytea|raw|file~',$o["type"])&&$X!="")$_=ME.'download='.urlencode($a).'&field='.urlencode($y).$_i;if(!$_&&$X!==null){foreach((array)$dd[$y]as$q){if(count($dd[$y])==1||end($q["source"])==$y){$_="";foreach($q["source"]as$s=>$ph)$_.=where_link($s,$q["target"][$s],$K[$Se][$ph]);$_=($q["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($q["db"]),ME):ME).'select='.urlencode($q["table"]).$_;if($q["ns"])$_=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($q["ns"]),$_);if(count($q["source"])==1)break;}}}if($y=="COUNT(*)"){$_=ME."select=".urlencode($a);$s=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$zi))$_.=where_link($s++,$W["col"],$W["val"],$W["op"]);}foreach($zi
as$ae=>$W)$_.=where_link($s++,$ae,$W);}$X=select_value($X,$_,$o,$Wh);$t=h("val[$_i][".bracket_escape($y)."]");$Y=$_POST["val"][$_i][bracket_escape($y)];$mc=!is_array($J[$y])&&is_utf8($X)&&$K[$Se][$y]==$J[$y]&&!$jd[$y];$Vh=preg_match('~text|lob~',$o["type"]);if(($_GET["modify"]&&$mc)||$Y!==null){$rd=h($Y!==null?$Y:$J[$y]);echo"<td>".($Vh?"<textarea name='$t' cols='30' rows='".(substr_count($J[$y],"\n")+1)."'>$rd</textarea>":"<input name='$t' value='$rd' size='$re[$y]'>");}else{$ve=strpos($X,"<i>...</i>");echo"<td id='$t' data-text='".($ve?2:($Vh?1:0))."'".($mc?"":" data-warning='".h('Use edit link to modify this value.')."'").">$X</td>";}}}if($Pa)echo"<td>";$b->backwardKeysPrint($Pa,$K[$Se]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n";}if(!is_ajax()){if($K||$E){$Ac=true;if($_GET["page"]!="last"){if($z==""||(count($K)<$z&&($K||!$E)))$gd=($E?$E*$z:0)+count($K);elseif($x!="sql"||!$Vd){$gd=($Vd?false:found_rows($S,$Z));if($gd<max(1e4,2*($E+1)*$z))$gd=reset(slow_query(count_rows($a,$Z,$Vd,$md)));else$Ac=false;}}$Gf=($z!=""&&($gd===false||$gd>$z||$E));if($Gf){echo(($gd===false?count($K)+1:$gd-$E*$z)>$z?'<p><a href="'.h(remove_from_uri("page")."&page=".($E+1)).'" class="loadmore">'.'Load more data'.'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$z).", '".'Loading'."...');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($K||$E){if($Gf){$Ce=($gd===false?$E+(count($K)>=$z?2:1):floor(($gd-1)/$z));echo"<fieldset>";if($x!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".'Page'."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".'Page'."', '".($E+1)."')); return false; };"),pagination(0,$E).($E>5?" ...":"");for($s=max(1,$E-4);$s<min($Ce,$E+5);$s++)echo
pagination($s,$E);if($Ce>0){echo($E+5<$Ce?" ...":""),($Ac&&$gd!==false?pagination($Ce,$E):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Ce'>".'last'."</a>");}}else{echo"<legend>".'Page'."</legend>",pagination(0,$E).($E>1?" ...":""),($E?pagination($E,$E):""),($Ce>$E?pagination($E+1,$E).($Ce>$E+1?" ...":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".'Whole result'."</legend>";$ac=($Ac?"":"~ ").$gd;echo
checkbox("all",1,0,($gd!==false?($Ac?"":"~ ").lang(array('%d row','%d rows'),$gd):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$ac' : checked); selectCount('selected2', this.checked || !checked ? '$ac' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>Modify</legend><div>
<input type="submit" value="Save"',($_GET["modify"]?'':' title="'.'Ctrl+click on a value to modify it.'.'"'),'>
</div></fieldset>
<fieldset><legend>Selected <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="Edit">
<input type="submit" name="clone" value="Clone">
<input type="submit" name="delete" value="Delete">',confirm(),'</div></fieldset>
';}$ed=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($ed['sql']);break;}}if($ed){print_fieldset("export",'Export'." <span id='selected2'></span>");$Ef=$b->dumpOutput();echo($Ef?html_select("output",$Ef,$ya["output"])." ":""),html_select("format",$ed,$ya["format"])," <input type='submit' name='export' value='".'Export'."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($rc,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".'Import'."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ya["format"],1);echo" <input type='submit' name='import' value='".'Import'."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$hi'>\n","</form>\n",(!$md&&$L?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["variables"])){$P=isset($_GET["status"]);page_header($P?'Status':'Variables');$Pi=($P?show_status():show_variables());if(!$Pi)echo"<p class='message'>".'No rows.'."\n";else{echo"<table cellspacing='0'>\n";foreach($Pi
as$y=>$X){echo"<tr>","<th><code class='jush-".$x.($P?"status":"set")."'>".h($y)."</code>","<td>".h($X);}echo"</table>\n";}}elseif(isset($_GET["script"])){header("Content-Type: text/javascript; charset=utf-8");if($_GET["script"]=="db"){$Fh=array("Data_length"=>0,"Index_length"=>0,"Data_free"=>0);foreach(table_status()as$C=>$S){json_row("Comment-$C",h($S["Comment"]));if(!is_view($S)){foreach(array("Engine","Collation")as$y)json_row("$y-$C",h($S[$y]));foreach($Fh+array("Auto_increment"=>0,"Rows"=>0)as$y=>$X){if($S[$y]!=""){$X=format_number($S[$y]);json_row("$y-$C",($y=="Rows"&&$X&&$S["Engine"]==($sh=="pgsql"?"table":"InnoDB")?"~ $X":$X));if(isset($Fh[$y]))$Fh[$y]+=($S["Engine"]!="InnoDB"||$y!="Data_free"?$S[$y]:0);}elseif(array_key_exists($y,$S))json_row("$y-$C");}}}foreach($Fh
as$y=>$X)json_row("sum-$y",format_number($X));json_row("");}elseif($_GET["script"]=="kill")$g->query("KILL ".number($_POST["kill"]));else{foreach(count_tables($b->databases())as$l=>$X){json_row("tables-$l",$X);json_row("size-$l",db_size($l));}json_row("");}exit;}else{$Oh=array_merge((array)$_POST["tables"],(array)$_POST["views"]);if($Oh&&!$n&&!$_POST["search"]){$H=true;$He="";if($x=="sql"&&$_POST["tables"]&&count($_POST["tables"])>1&&($_POST["drop"]||$_POST["truncate"]||$_POST["copy"]))queries("SET foreign_key_checks = 0");if($_POST["truncate"]){if($_POST["tables"])$H=truncate_tables($_POST["tables"]);$He='Tables have been truncated.';}elseif($_POST["move"]){$H=move_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$He='Tables have been moved.';}elseif($_POST["copy"]){$H=copy_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$He='Tables have been copied.';}elseif($_POST["drop"]){if($_POST["views"])$H=drop_views($_POST["views"]);if($H&&$_POST["tables"])$H=drop_tables($_POST["tables"]);$He='Tables have been dropped.';}elseif($x!="sql"){$H=($x=="sqlite"?queries("VACUUM"):apply_queries("VACUUM".($_POST["optimize"]?"":" ANALYZE"),$_POST["tables"]));$He='Tables have been optimized.';}elseif(!$_POST["tables"])$He='No tables.';elseif($H=queries(($_POST["optimize"]?"OPTIMIZE":($_POST["check"]?"CHECK":($_POST["repair"]?"REPAIR":"ANALYZE")))." TABLE ".implode(", ",array_map('idf_escape',$_POST["tables"])))){while($J=$H->fetch_assoc())$He.="<b>".h($J["Table"])."</b>: ".h($J["Msg_text"])."<br>";}queries_redirect(substr(ME,0,-1),$He,$H);}page_header(($_GET["ns"]==""?'Database'.": ".h(DB):'Schema'.": ".h($_GET["ns"])),$n,true);if($b->homepage()){if($_GET["ns"]!==""){echo"<h3 id='tables-views'>".'Tables and views'."</h3>\n";$Nh=tables_list();if(!$Nh)echo"<p class='message'>".'No tables.'."\n";else{echo"<form action='' method='post'>\n";if(support("table")){echo"<fieldset><legend>".'Search data in tables'." <span id='selected2'></span></legend><div>","<input type='search' name='query' value='".h($_POST["query"])."'>",script("qsl('input').onkeydown = partialArg(bodyKeydown, 'search');","")," <input type='submit' name='search' value='".'Search'."'>\n","</div></fieldset>\n";if($_POST["search"]&&$_POST["query"]!=""){$_GET["where"][0]["op"]="LIKE %%";search_tables();}}$bc=doc_link(array('sql'=>'show-table-status.html'));echo"<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^(tables|views)\[/);",""),'<th>'.'Table','<td>'.'Engine'.doc_link(array('sql'=>'storage-engines.html')),'<td>'.'Collation'.doc_link(array('sql'=>'charset-charsets.html','mariadb'=>'supported-character-sets-and-collations/')),'<td>'.'Data Length'.$bc,'<td>'.'Index Length'.$bc,'<td>'.'Data Free'.$bc,'<td>'.'Auto Increment'.doc_link(array('sql'=>'example-auto-increment.html','mariadb'=>'auto_increment/')),'<td>'.'Rows'.$bc,(support("comment")?'<td>'.'Comment'.$bc:''),"</thead>\n";$T=0;foreach($Nh
as$C=>$U){$Si=($U!==null&&!preg_match('~table~i',$U));$t=h("Table-".$C);echo'<tr'.odd().'><td>'.checkbox(($Si?"views[]":"tables[]"),$C,in_array($C,$Oh,true),"","","",$t),'<th>'.(support("table")||support("indexes")?"<a href='".h(ME)."table=".urlencode($C)."' title='".'Show structure'."' id='$t'>".h($C).'</a>':h($C));if($Si){echo'<td colspan="6"><a href="'.h(ME)."view=".urlencode($C).'" title="'.'Alter view'.'">'.(preg_match('~materialized~i',$U)?'Materialized view':'View').'</a>','<td align="right"><a href="'.h(ME)."select=".urlencode($C).'" title="'.'Select data'.'">?</a>';}else{foreach(array("Engine"=>array(),"Collation"=>array(),"Data_length"=>array("create",'Alter table'),"Index_length"=>array("indexes",'Alter indexes'),"Data_free"=>array("edit",'New item'),"Auto_increment"=>array("auto_increment=1&create",'Alter table'),"Rows"=>array("select",'Select data'),)as$y=>$_){$t=" id='$y-".h($C)."'";echo($_?"<td align='right'>".(support("table")||$y=="Rows"||(support("indexes")&&$y!="Data_length")?"<a href='".h(ME."$_[0]=").urlencode($C)."'$t title='$_[1]'>?</a>":"<span$t>?</span>"):"<td id='$y-".h($C)."'>");}$T++;}echo(support("comment")?"<td id='Comment-".h($C)."'>":"");}echo"<tr><td><th>".sprintf('%d in total',count($Nh)),"<td>".h($x=="sql"?$g->result("SELECT @@storage_engine"):""),"<td>".h(db_collation(DB,collations()));foreach(array("Data_length","Index_length","Data_free")as$y)echo"<td align='right' id='sum-$y'>";echo"</table>\n";if(!information_schema(DB)){echo"<div class='footer'><div>\n";$Mi="<input type='submit' value='".'Vacuum'."'> ".on_help("'VACUUM'");$qf="<input type='submit' name='optimize' value='".'Optimize'."'> ".on_help($x=="sql"?"'OPTIMIZE TABLE'":"'VACUUM OPTIMIZE'");echo"<fieldset><legend>".'Selected'." <span id='selected'></span></legend><div>".($x=="sqlite"?$Mi:($x=="pgsql"?$Mi.$qf:($x=="sql"?"<input type='submit' value='".'Analyze'."'> ".on_help("'ANALYZE TABLE'").$qf."<input type='submit' name='check' value='".'Check'."'> ".on_help("'CHECK TABLE'")."<input type='submit' name='repair' value='".'Repair'."'> ".on_help("'REPAIR TABLE'"):"")))."<input type='submit' name='truncate' value='".'Truncate'."'> ".on_help($x=="sqlite"?"'DELETE'":"'TRUNCATE".($x=="pgsql"?"'":" TABLE'")).confirm()."<input type='submit' name='drop' value='".'Drop'."'>".on_help("'DROP TABLE'").confirm()."\n";$k=(support("scheme")?$b->schemas():$b->databases());if(count($k)!=1&&$x!="sqlite"){$l=(isset($_POST["target"])?$_POST["target"]:(support("scheme")?$_GET["ns"]:DB));echo"<p>".'Move to other database'.": ",($k?html_select("target",$k,$l):'<input name="target" value="'.h($l).'" autocapitalize="off">')," <input type='submit' name='move' value='".'Move'."'>",(support("copy")?" <input type='submit' name='copy' value='".'Copy'."'>":""),"\n";}echo"<input type='hidden' name='all' value=''>";echo
script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^(tables|views)\[/));".(support("table")?" selectCount('selected2', formChecked(this, /^tables\[/) || $T);":"")." }"),"<input type='hidden' name='token' value='$hi'>\n","</div></fieldset>\n","</div></div>\n";}echo"</form>\n",script("tableCheck();");}echo'<p class="links"><a href="'.h(ME).'create=">'.'Create table'."</a>\n",(support("view")?'<a href="'.h(ME).'view=">'.'Create view'."</a>\n":"");if(support("routine")){echo"<h3 id='routines'>".'Routines'."</h3>\n";$Qg=routines();if($Qg){echo"<table cellspacing='0'>\n",'<thead><tr><th>'.'Name'.'<td>'.'Type'.'<td>'.'Return type'."<td></thead>\n";odd('');foreach($Qg
as$J){$C=($J["SPECIFIC_NAME"]==$J["ROUTINE_NAME"]?"":"&name=".urlencode($J["ROUTINE_NAME"]));echo'<tr'.odd().'>','<th><a href="'.h(ME.($J["ROUTINE_TYPE"]!="PROCEDURE"?'callf=':'call=').urlencode($J["SPECIFIC_NAME"]).$C).'">'.h($J["ROUTINE_NAME"]).'</a>','<td>'.h($J["ROUTINE_TYPE"]),'<td>'.h($J["DTD_IDENTIFIER"]),'<td><a href="'.h(ME.($J["ROUTINE_TYPE"]!="PROCEDURE"?'function=':'procedure=').urlencode($J["SPECIFIC_NAME"]).$C).'">'.'Alter'."</a>";}echo"</table>\n";}echo'<p class="links">'.(support("procedure")?'<a href="'.h(ME).'procedure=">'.'Create procedure'.'</a>':'').'<a href="'.h(ME).'function=">'.'Create function'."</a>\n";}if(support("sequence")){echo"<h3 id='sequences'>".'Sequences'."</h3>\n";$eh=get_vals("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = current_schema() ORDER BY sequence_name");if($eh){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."</thead>\n";odd('');foreach($eh
as$X)echo"<tr".odd()."><th><a href='".h(ME)."sequence=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."sequence='>".'Create sequence'."</a>\n";}if(support("type")){echo"<h3 id='user-types'>".'User types'."</h3>\n";$Ki=types();if($Ki){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."</thead>\n";odd('');foreach($Ki
as$X)echo"<tr".odd()."><th><a href='".h(ME)."type=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."type='>".'Create type'."</a>\n";}if(support("event")){echo"<h3 id='events'>".'Events'."</h3>\n";$K=get_rows("SHOW EVENTS");if($K){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."<td>".'Schedule'."<td>".'Start'."<td>".'End'."<td></thead>\n";foreach($K
as$J){echo"<tr>","<th>".h($J["Name"]),"<td>".($J["Execute at"]?'At given time'."<td>".$J["Execute at"]:'Every'." ".$J["Interval value"]." ".$J["Interval field"]."<td>$J[Starts]"),"<td>$J[Ends]",'<td><a href="'.h(ME).'event='.urlencode($J["Name"]).'">'.'Alter'.'</a>';}echo"</table>\n";$zc=$g->result("SELECT @@event_scheduler");if($zc&&$zc!="ON")echo"<p class='error'><code class='jush-sqlset'>event_scheduler</code>: ".h($zc)."\n";}echo'<p class="links"><a href="'.h(ME).'event=">'.'Create event'."</a>\n";}if($Nh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}}}page_footer();
