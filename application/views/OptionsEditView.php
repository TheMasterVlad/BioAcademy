<?php include_once("Header.php");
?>
	<div id="container">
	<?php echo form_open(base_url()."index.php/CourceController/edit_task");
	echo '<h1>Редактирование</h1><hr>';
	
	foreach($questions as $q){
		echo 'Изменить вопрос: <input id="dtask" type="text" name="dtask" maxlength="255" value="'.$q->Task.'" /><br>';
		echo form_hidden('id_quest', $q->idQuestion);
		echo form_hidden('id_less', $q->idLesson);

		for($i= 0; $i < count($options); $i++){	
			if($options[$i]->idQuestion == $options[$i]->idQuestion){

				echo form_checkbox('check_option'.$i, $i, $options[$i]->Correct).'<input id="doption" type="text" name="doption'.$i.'" maxlength="255" value="'.$options[$i]->Text.'" /><br>';	
				echo form_hidden('id_opt'.$i, $options[$i]->idOption);
				echo form_hidden('id_count', $i);
			}			
		}
	}

	echo form_submit(array('id' => 'submit_edit', 'value' => 'Изменить'));
	echo form_close().'<br/>';
		
	include_once("Footer.php"); ?> 