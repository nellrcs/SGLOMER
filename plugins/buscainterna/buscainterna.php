
<?php 
	function busca_interna()
	{
	?>
		<FORM method=GET action="http://www.google.com.br/search">
		<TABLE bgcolor="#FFFFFF"><tr><td>
		<A HREF="http://www.google.com.br/">
		</td>
		<td>
		<INPUT TYPE=text name=q size=31 maxlength=255 value="">
		<INPUT type=submit name=btnG VALUE="Pesquisar">
		<font size=-1>
		<input type=hidden name=domains value="<?php echo URL_SISTEMA; ?>"><br>
		</font>
		</td></tr></TABLE>
		</FORM>
	<?php
	}
?>