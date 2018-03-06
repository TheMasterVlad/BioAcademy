<?php
$Login = $this->input->cookie('username');
if ($Login){
	$Role = $this->input->cookie('userrole');
include_once("Header.php"); 
if($user_data){
	echo '<table class="table" border="1" cellpadding="5" cellspacing="5">
		<tr style = "background-color: rgb(159, 49, 79);    color: white;">
			<th>Логин</th>
			<th>Имя</th>
			<th>Отчество</th>
			<th>Фамилия</th>
			<th>e-mail</th>
			<th>Дата регистрации</th>
		</tr>';		
			foreach($user_data as $u)
			{		
			$column_tag = '<td>';
			if ($u->Login == $Login)
			{
				echo '<tr style = "background-color: yellow;">';
			} else
			{
			  echo '<tr>';
			}  
			echo '<td>'. 
				$u->Login.'
				</td>
				<td>'.
					$u->First_name.'
				</td>
				<td>'.
					$u->Middle_name.'
				</td>
				<td>'.
					$u->Surname.'
				</td>
				<td>'.
					$u->Email.'
				</td>
				<td>'.
					$u->Registration_data.'
				</td>
				</tr>';
			}
			echo '</table>';
		} else {
			echo 'Пользователей еще нет. ';
		}
include_once("Footer.php"); 
} else{
	redirect(base_url().'index.php/CourceController/SignUp');
}?> 