<?php 
$Login = $this->input->cookie('username');
if ($Login){
	$Role = $this->input->cookie('userrole'); 
	include_once("Header.php");
	
	if (isset($test_mark)){
		echo '<h1> Вы ответили правильно на '. $mark_n .' вопросов из '. $q_number[0]. '. Ваша оценка: ' . $test_mark.'</h1>';
	}
	$mark_set = 0;
	if (isset($marks_data))
	{
		foreach( $marks_data as $md)
		{
			if( $md->Login == $Login && $md->idLesson == $lesson_id)
			{
				echo '<h1> Вы уже прошли тест. Ваша оценка: ' . $md->Mark .'</h1>';
				$mark_set = 1;
			}
		}
	}
	if (isset($lessiontext)){
		foreach($lessiontext as $v){
		echo '<h1>'.$v->Name.'</h1>'.$v->Lesson_material;
		}
	}
	if(isset($options[0]->Text))
	{
		$j = 0;
		echo '<div id="container">
		<form class="form-horizontal" action="'. base_url().'index.php/CourceController/add_mark'.'" method="post">
		<h2>Вопросы</h2><hr>';
		foreach($questions as $q)
		{
			echo '<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">'.
						form_label($q->Task).'
					</div>
				</div>
				<br>';
			$i = 0; 
			foreach($options as $o){	
				if($q->idQuestion == $o->idQuestion)
				{
					$color = '';
					$checked_opt = 0;
					if(isset($options_count))
					{
						for($k = 0; $k < $options_count; $k++)
						{ 
							if($chosen_options[$k]['idoption'.$k] == $o->idOption){
								if ($o->Correct == 1){
									$color = 'style="color:green;"';
									$checked_opt = 1; 
								}
								else {
									$color = 'style="color:red;"';
									$checked_opt = 1;
								}
							} 
						}						
						$opt = array(
							'name'          => 'question'.$j.'option'.$i++,
							'id'            => 'options',
							'value'         => $o->idOption,
							'checked'       => $checked_opt,
							'style'         => 'margin:10px'
						);
					} 
					else
					{
						$opt = array(
							'name'          => 'question'.$j.'option'.$i++,
							'id'            => 'options',
							'value'         => $o->idOption,
							'checked'       => $o->Correct,
							'style'         => 'margin:10px'
						);
					}
					if($Role == 'Student' && !isset($options_count)){
						$opt['checked'] = false;
					}
					echo '<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">'.
								form_checkbox($opt).' <span '.$color.'>'.$o->Text.'</span><br>
							</div>
						</div>'.
					form_hidden('count'.$j,$i).'<br>'.
					form_hidden('dlesson',$o->idLesson).'<br>';
				}
			}
			$j++;
			if($Role == 'Admin' || $Login == $options[0]->Login){
				echo '<a href="'.base_url().'index.php/CourceController/delete_task?id_less='.$q->idLesson.'&id_q='.$q->idQuestion.'">Удалить вопрос</a><br>';
				echo '<a href="'.base_url().'index.php/CourceController/show_edit_task?id_less='.$q->idLesson.'&id_q='.$q->idQuestion.'">Изменить вопрос</a><br>';
			}
		}
	
		echo form_hidden('count_q', $j).'<br>';
	}
		if($Role == 'Student' && !isset($checkmark) && isset($options[0]->Text) && $mark_set == 0){
				echo '<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success" id = "submit_opt", value = "Проверить">Проверить</button>'.
						//	form_submit(array('id' => 'submit_opt', 'value' => 'Проверить'))
						'</div>
					</div>';
		}
		echo '<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					</form><br>
				</div>
			</div>';
		
	if(isset($lession_author[0]->Login) && ($Role == 'Admin' || $Login == $lession_author[0]->Login)){
	?>
			<div id="container">
			<?php echo form_open(base_url()."index.php/CourceController/add_task"); ?>
			<h1>Добавить вопрос</h1><hr>
			<?php if (isset($message)) { ?>
			<CENTER><h3 style="color:green;">Данные были успешно добавлены</h3></CENTER><br>
			<?php } 

		echo form_label('Введите вопрос :');  echo form_error('dtask').'<br>';
		echo form_input(array('id' => 'dtask', 'name' => 'dtask')).'<br>';

		echo form_label('Введите текст правильного ответа :'); 
		echo form_error('danswer').'<br>';
		echo form_input(array('id' => 'danswer', 'name' => 'danswer')).'<br>';
			
		echo form_label('Введите текст вариантов ответа через ; :');
		echo form_error('doptions').'<br>';
		echo form_input(array('id' => 'doptions', 'name' => 'doptions')).'<br>';
		
		if (isset($lesson_id)){
			echo form_hidden('dlesson', $lesson_id).'<br>';
		}
			//<button type="button" class="btn btn-primary btn-lg btn-block">Блочная кнопка</button>
		echo form_submit(array('id' => 'submit', 'value' => 'Добавить'));
		echo form_close().'<br><div id="fugo">';
	}
		include_once("Footer.php"); 
} else{
	redirect(base_url().'index.php/CourceController/SignUp');
}?> 