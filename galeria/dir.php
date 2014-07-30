 <?php
                        $baseDir = 'uploads/';
                        //si get dir for diferente de nulo o abreDir vai ser igual ao GETDIR senao vai ser a BASEDIR
                        $abreDir = (@$_GET['dir'] != '' ? @$_GET['dir'] : $baseDir);
                        $openDir = dir($abreDir);
                        $strrdir = strrpos(substr($abreDir, 0, -1), '/');
                        $backdir = substr($abreDir, 0, $strrdir + 1);
                        /*
                         * *************************************************
                         * RENOMEAR ARQUIVO OU PASTA
                         * *************************************************
                         */
                        if (isset($_POST['sendup'])) {
                            $arquivo = $_POST['adir']; //nome com o arquivo
                            $newarq = $_POST['ndir']; //somente o nome
                            //tem que ser diretorio e tem que existir
                            if (is_dir($arquivo) && file_exists($arquivo)) {
                                rename($arquivo, $abreDir . $newarq);
                                //si for diferente de arquivo e existir
                            } elseif (!is_dir($arquivo) && file_exists($arquivo)) {
                                $strrfile = strrpos($arquivo, '.');
                                $arqext = substr($arquivo, $strrfile);
                                $arqName = $newarq . $arqext;
                                rename($arquivo, $abreDir . $arqName);
                            }
                        }
                        /*
                         * *************************************************
                         * DELETAR
                         * *************************************************
                         */
                        if (!empty($_GET['del'])) {
                            $del = $_GET['del'];
                            //si for um diretorio e existir
                            if (is_dir($del) && file_exists($del)) {
                                //si nao deletar
                                if (!@rmdir($del)) {
                                    echo 'Erro: pasta deve estar vazia!';
                                } else {
                                    header('Location: dir.php?dir=' . $abreDir);
                                }
                                //se nao for diretorio e existe e um arquivo entao
                            } elseif (!is_dir($del) && file_exists($del)) {
                                //deleta o arquivo
                                if (unlink($del)) {
                                    header('Location: dir.php?dir=' . $abreDir);
                                } else {
                                    echo 'Erro ao excluir arquivo!';
                                }
                            }
                        }
                        /*
                         * *************************************************
                         * CRIAR PASTA
                         * *************************************************
                         */
                        if (isset($_POST['senddir'])):
                            $novapasta = $_POST['pasta'];
                            if (!file_exists($abreDir . $novapasta)) {
                                mkdir($abreDir . $novapasta, 0755); //ou 0777
                            } else {
                                echo 'Pasta j� existe!';
                            }
                        endif;
                        /*
                         * *************************************************
                         * ENVIA ARQUIVO
                         * *************************************************
                         */
                        if (isset($_POST['sendfile'])):
                            $arquivo = $_FILES['newarq'];
                            $strrfile = strrpos($arquivo['name'], '.');
                            $arqext = substr($arquivo['name'], $strrfile);
                            $arqName = md5(time()) . $arqext;
                            move_uploaded_file($arquivo['tmp_name'], $abreDir . '/' . $arqName);
                        endif;
                        /*
                         * *************************************************
                         * CRIAR E RENOMEAR PASTAS
                         * *************************************************
                         */
                        if (empty($_GET['upd'])) {
                            echo '
		<form name="cadastra" action="" method="post" enctype="multipart/form-data">
		
		<fieldset style="width:720px; margin-bottom:10px;">
			<span>Nome da pasta:</span>
			<input type="text" name="pasta">
			<input type="submit" value="Criar pasta" name="senddir">
		</fieldset>
		
		<fieldset style="width:720px;">
			<input type="file" name="newarq">
			<input type="submit" value="Enviar arquivo" name="sendfile">
		</fieldset>
		
		</form>
	';
                        } else {
                            echo '
		<form name="update" action="" method="post">
			<fieldset style="width:720px;">
				<span><strong>Renomear:</strong> ' . $_GET['upd'] . '</span><br><br>
				<input type="hidden" name="adir" value="' . $_GET['upd'] . '" size="80">
				<input type="text" name="ndir" value="" size="60">
				<input type="submit" value="Atualizar" name="sendup">
			</fieldset>
		</form>
	';
                        }

                        $openDir = dir($abreDir);
                        /*
                         * *************************************************
                         * PARTE HTML
                         * *************************************************
                         */
                        echo '<table width="750" border="1" cellspacing="0" cellpadding="5">';
                        while ($arq = $openDir->read()):

                            if ($arq != '.' && $arq != '..'):
                                if (is_dir($abreDir . $arq)) {
                                    echo '<tr>';
                                    echo '<td>' . $arq . '</td>';
                                    echo '<td align="center"><a href="dir.php?dir=' . $abreDir . $arq . '/">abrir</a></td>';
                                    echo '<td align="center"><a href="dir.php?del=' . $abreDir . $arq . '&dir=' . $abreDir . '">excluir</a></td>';
                                    echo '<td align="center"><a href="dir.php?upd=' . $abreDir . $arq . '&dir=' . $abreDir . '">update</a></td>';
                                    echo '</tr>';
                                } else {
                                    echo '<tr>';
                                    echo '<td>' . $arq . '</td>';
                                    echo '<td align="center"><img src="' . $abreDir . $arq . '" width="50"></td>';
                                    echo '<td align="center"><a href="dir.php?del=' . $abreDir . $arq . '&dir=' . $abreDir . '">excluir</a></td>';
                                    echo '<td align="center"><a href="dir.php?upd=' . $abreDir . $arq . '&dir=' . $abreDir . '">update</a></td>';
                                    echo '</tr>';
                                }
                            endif;
                        endwhile;
                        echo '</table>';
                        /*
                         * *************************************************
                         * VOLTAR OS DIRETORIOS
                         * *************************************************
                         */
                        if ($abreDir != $baseDir) {
                            echo '<a href="dir.php?dir=' . $backdir . '">voltar</a>';
                        }
                        $openDir->close();
                        ?>
