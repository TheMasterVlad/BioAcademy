<?php
$Login = $this->input->cookie('username');
if ($Login){
	$Role = $this->input->cookie('userrole'); 
	include_once("Header.php");
	$html = '';
	foreach($val as $v)
		{	
			$html .= 'Название: '.$v->Name.'</a> ';
		}
		if(empty($html)){
			echo "Уроки не добавлены";
		}
		else {
			echo '<table class="table" border="1" cellpadding="5" cellspacing="5">
			<tr>
				<th>Название урока</th>
				<th>Курс</th>
			</tr>';
			foreach($val as $v)
			{		
				echo '<tr>
						<td>
							<a href="'.base_url().'index.php/CourceController/show_text?idLess='.$v->idLesson.'">'.$v->Name.'</a>
						</td>
						<td>
							'.$v->Cource.'
						</td>
					</tr>';
			
			}
				echo '</table>';
		}

		if($Role == 'Admin' || $Login == $author[0]->Login){
				echo '<div id="container">';
				echo form_open(base_url()."index.php/CourceController/add_lessons").'<h1>Добавить урок</h1><hr>';
				if (isset($message)) { 
					echo '<CENTER><h3 style="color:green;">Данные были успешно добавлены</h3></CENTER><br>';
				}
			echo form_label('Введите название урока :'); 
			echo form_error('dname').'<br>';
			echo form_input(array('id' => 'dname', 'name' => 'dname')).'<br>';

			echo form_label('Введите текст урока :');
			echo form_error('dtext').'<br>';
			echo form_textarea(array('id' => 'dtext', 'name' => 'dtext')).'<br>';
			if(isset($id_cource))
			{
				echo form_hidden('dcourse', $id_cource);
			}
			echo form_submit(array('id' => 'submit', 'value' => 'Добавить'));
			echo form_close().'<br><div id="fugo">';
		}
		
	 include_once("Footer.php"); 
} else{
	redirect(base_url().'index.php/CourceController/SignUp');
}?>