<?php $this->load->view('header'); ?>
<form action="<?=base_url()?>index.php/create" method="post" accept-charset="utf-8">
	<div class="data">
		<label>Name </label><input type="text" name="name" value="" class="info" />
		<label>Title </label><input type="text" name="title" value="" class="info" />
		<label>Private </label><input type="checkbox" name="private" value="1" class="private" />
	</div>
	
	<div><textarea name="code" class="paste_body" rows="auto" cols="95"></textarea></div>
	
	<div>
		<input type="submit" value="Paste!" class="submit" /> 
		
		<select name="lang" class="lang singline">
			<option value="text" selected="selected">Text</option>
			<option value="actionscript">Actionscript</option>
			<option value="ada">ADA</option>
			<option value="apache">Apache Log</option>
			<option value="applescript">AppleScript</option>
			<option value="asm">ASM (Nasm Syntax)</option>
			<option value="asp">ASP</option>
			<option value="autoit">AutoIT</option>
			<option value="bash">Bash</option>
			<option value="bptzbasic">BptzBasic</option>
			<option value="c">C</option>
			<option value="c_mac">C for Macs</option>
			<option value="csharp">C#</option>
			<option value="cpp">C++</option>
			<option value="coldfusion">ColdFusion</option>
			<option value="css">CSS</option>
			<option value="delphi">Delphi</option>
			<option value="eiffel">Eiffel</option>
			<option value="fortran">Fortran</option>
			<option value="freebasic">FreeBasic</option>
			<option value="gml">GML</option>
			<option value="groovy">Groovy</option>
			<option value="html4strict">HTML (4 Strict)</option>
			<option value="inno">Inno</option>
			<option value="java">Java</option>
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
			<option value="perl">Perl</option>
			<option value="php">PHP</option>
			<option value="plsql">PL/SQL</option>
			<option value="python">Python</option>
			<option value="qbasic">Q(uick)BASIC</option>
			<option value="robots">robots.txt</option>
			<option value="ruby">Ruby</option>
			<option value="scheme">Scheme</option>
			<option value="sdlbasic">SDLBasic</option>
			<option value="smalltalk">Smalltalk</option>
			<option value="smarty">Smarty</option>
			<option value="sql">SQL</option>
			<option value="tcl">TCL</option>
			<option value="vbnet">VB.NET</option>
			<option value="vb">Visual BASIC</option>
			<option value="winbatch">Winbatch</option>
			<option value="xhtml">XHTML</option>
			<option value="xml">XML</option>
			<option value="z80">Z80 ASM</option>
		</select>
	</div>
</form>
<?php $this->load->view('footer');?>