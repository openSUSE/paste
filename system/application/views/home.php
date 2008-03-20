<?php $this->load->view('header'); ?>
<?php if(isset($this->validation->error_string)){ echo $this->validation->error_string; }?>
<form action="<?=base_url()?>" method="post" accept-charset="utf-8" class="form">
	<table class="data">
		<tr>
			<td class="label"><label>Name</label></td>
			<td><input type="text" name="name" value="" class="info textfield" /></td>
		</tr>
		<tr>
			<td class="label"><label>Title</label></td>
			<td><input type="text" name="title" value="" class="info textfield" /></td>
		</tr>
		<tr>
			<td class="label"><label>Language</label></td>
			<td>
				<select name="lang" class="selectfield">
					<option value="c">C</option>
					<option value="css">CSS</option>
					<option value="cpp">C++</option>
					<option value="html4strict">HTML (4 Strict)</option>
					<option value="java">Java</option>
					<option value="perl">Perl</option>
					<option value="php" selected="selected">PHP</option>
					<option value="python">Python</option>			
					<option value="ruby">Ruby</option>
					<option value="text">Text</option>
					<option value="xhtml">XHTML</option>
					<option value="">-------------------</option>
					<option value="actionscript">Actionscript</option>
					<option value="ada">ADA</option>
					<option value="apache">Apache Log</option>
					<option value="applescript">AppleScript</option>
					<option value="asm">ASM (Nasm Syntax)</option>
					<option value="asp">ASP</option>
					<option value="autoit">AutoIT</option>			
					<option value="bash">Bash</option>
					<option value="bptzbasic">BptzBasic</option>
					<option value="c_mac">C for Macs</option>
					<option value="csharp">C#</option>								
					<option value="coldfusion">ColdFusion</option>
					<option value="delphi">Delphi</option>
					<option value="eiffel">Eiffel</option>
					<option value="fortran">Fortran</option>
					<option value="freebasic">FreeBasic</option>							
					<option value="gml">GML</option>
					<option value="groovy">Groovy</option>
					<option value="inno">Inno</option>
					<option value="java5">Java 5</option>							
					<option value="javascript">Javascript</option>
					<option value="latex">LaTeX</option>
					<option value="lua">Lua</option>
					<option value="mpasm">Microprocessor ASM</option>
					<option value="mirc">mIRC</option>
					<option value="mysql">MySQL</option>							
					<option value="nsis">NSIS</option>
					<option value="objc">Objective C</option>
					<option value="ocaml">OCaml</option>
					<option value="oobas">OpenOffice BASIC</option>
					<option value="oracle8">Oracle 8 SQL</option>
					<option value="pascal">Pascal</option>				
					<option value="plsql">PL/SQL</option>
					<option value="qbasic">Q(uick)BASIC</option>
					<option value="robots">robots.txt</option>							
					<option value="scheme">Scheme</option>
					<option value="sdlbasic">SDLBasic</option>
					<option value="smalltalk">Smalltalk</option>
					<option value="smarty">Smarty</option>
					<option value="sql">SQL</option>
					<option value="tcl">TCL</option>
					<option value="vbnet">VB.NET</option>
					<option value="vb">Visual BASIC</option>
					<option value="winbatch">Winbatch</option>
					<option value="xml">XML</option>						
					<option value="z80">Z80 ASM</option>
				</select>
			</td>
			<td class="label spaced"><label>Delete After</label></td>
			<td>
				<select name="expire" class="selectfield">
					<option value="0" selected="selected">Keep Forever</option>
					<option value="30">30 Minutes</option>
					<option value="60">1 hour</option>
					<option value="360">6 Hours</option>
					<option value="720">12 Hours</option>
					<option value="1440">1 Day</option>
					<option value="10080">1 Week</option>
					<option value="40320">4 Weeks</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="label"><label>Auto Copy</label></td>
			<td><input type="checkbox" name="acopy" value="1" class="checkbox" checked="checked" /><small style="margin-left: 10px;">This auto-magically copies the link to your clipboard. (Requires Javascript and Flash or IE).</small> </td>
		</tr>
		<tr class="last">
			<td class="label"><label>Private</label></td>
			<td><input type="checkbox" name="private" value="1" class="checkbox" /><small style="margin-left: 10px;">This prevents your paste from showing up in recent paste listings.</small></td>
		</tr>
	</table>
	
	<div>
		<textarea name="code" class="paste_body" rows="auto" cols="auto"></textarea>
	</div>
	
	<div class="final">
		<button type="submit" name="submit" class="submit">Paste!</button>
	</div>
</form>
<?php $this->load->view('footer');?>