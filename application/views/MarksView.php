<?php
$Login = $this->input->cookie('username');
if ($Login){
	$Role = $this->input->cookie('userrole');
include_once("Header.php"); 
if($val){
	echo '<table class="table" border="1" cellpadding="5" cellspacing="5">
		<tr style = "background-color: rgb(159, 49, 79);    color: white;">
			<th>Студент</th>
			<th>Название урока</th>
			<th>Название курса</th>
			<th>Оценка</th>
		</tr>';		
			foreach($val as $v)
			{		
			if ($v->Login == $Login)
			{
				echo '<tr style = "background-color: yellow;">';
			} else
			{
			  echo '<tr>';
			}  
			echo '<td>'.
					$v->Login.'
				</td>
				<td>
					<a href="'.base_url().'index.php/CourceController/show_text?idLess='.$v->idLesson.'">'.$v->Lesson_name.'</a>
				</td>
				<td>
					<a href="'.base_url().'index.php/CourceController/show_lessons?id='.$v->idCourse.'">'.$v->Course_name.'</a>
				</td>
				<td>'.
					$v->Mark.'
				</td>';
				echo '</tr>';
			}
			echo '</table>';
		} else {
			echo 'Оценок еще нет. ';
		}
include_once("Footer.php"); 
} else{
	redirect(base_url().'index.php/CourceController/SignUp');
}?> 