<?php
$Login = $this->input->cookie('username');
if ($Login){
	$Role = $this->input->cookie('userrole');
include_once("Header.php"); 
if($val){
	echo '<table class="table" border="1" cellpadding="5" cellspacing="5">
		<tr style = "background-color: rgb(159, 49, 79);    color: white;">
			<th>Название курса</th>
			<th>Автор</th>
			<th>Описание</th>
		</tr>';		
			foreach($val as $v)
			{		
			  echo '<tr>
					<td>';
						if((isset($v->idStudent) && ($v->idStudent))||($Role == 'Admin')||($Role == 'Teacher')){
							echo '<a href="'.base_url().'index.php/CourceController/show_lessons?id='.$v->idCourse.'">'.$v->Name.'</a>';
						} else {
							echo $v->Name;
						}	
						echo '</td>
						<td>
							'.$v->Login.'
						</td>
						<td>
							'.$v->Description.'
						</td>';
				if($Role == 'Student')
				{
					if($v->idStudent){
						echo '<td>Вы подписались '.$v->beginning_data.'</a>
						</td>';
					} else {
						echo '<td style = "background-color: rgb(220,0,10);">
							<a style = "color: white;" href="'.base_url().'index.php/CourceController/sign_cource?id='.$v->idCourse.'">Подписаться</a>
						</td>';
					}
				}				
				echo '</tr>';
			}
			echo '</table>';
		} else {
			echo 'У вас нету добавленных курсов';
		}
include_once("Footer.php"); 
} else{
	redirect(base_url().'index.php/CourceController/SignUp');
}?> 