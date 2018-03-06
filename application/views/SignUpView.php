<div class="container">
  <!--  <form class="form-horizontal" action="<?php //echo base_url(). 'index.php/CourceController/varify'?>">     -->
	<?php echo form_open(base_url()."index.php/CourceController/varify").'<br>'; ?>
    <h2>Войдите или зарегистрируйтесь</h2>
        <div class="form-group">
            <label class="control-label col-sm-2" for="log">Логин :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="log" placeholder="Введите логин :" name="login">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pass">Пароль :</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pass" placeholder="Введите пароль :" name="password">
            </div>
        </div>
</div>
<?php
if (isset($message)) { 
	echo '<CENTER><h3 style="color:red;">Неверный логин или пароль</h3></CENTER><br>';
} 
if (isset($log)) { 
	echo '<CENTER><h3 style="color:red;">Пользователь с таким логином уже существует.</h3></CENTER><br>';
} 
/*
echo form_label('Введите логин :');
echo form_input(array('id' => 'log', 'name' => 'login')).'<br>';

echo form_label('Введите пароль :');
echo form_password(array('id' => 'pass', 'name' => 'password')).'<br>';
*/
echo form_submit(array('id' => 'submit_s', 'value' => 'Войти')); 
echo form_close().'<br><div id="fugo"></div>';

echo form_open(base_url()."index.php/CourceController/addUser").'<h3>Регистрация нового пользователя</h3><br>';

echo form_label('Введите имя :'); echo form_error('fn').'<br>';
echo form_input(array('id' => 'fn', 'name' => 'f_name')).'<br>';

echo form_label('Введите отчество :'); echo form_error('mn').'<br>';
echo form_input(array('id' => 'mn', 'name' => 'm_name')).'<br>';

echo form_label('Введите фамилию :'); echo form_error('sn').'<br>';
echo form_input(array('id' => 'sn', 'name' => 's_name')).'<br>';

echo form_label('Введите логин :'); echo form_error('log').'<br>';
echo form_input(array('id' => 'log', 'name' => 'login')).'<br>';

echo form_label('Введите пароль :'); echo form_error('pass').'<br>';
echo form_password(array('id' => 'pass', 'name' => 'password')).'<br>';

echo form_label('Введите e-mail :'); echo form_error('mail').'<br>';
echo form_input(array('id' => 'mail', 'name' => 'email')).'<br>';

$options = array(
        'Student' => 'Студент',
        'Teacher' => 'Учитель'
);
echo form_label('Как студент/учитель :');
echo form_dropdown('choose_role', $options, 'Student').'<br>';

echo form_submit(array('id' => 'submit_d', 'value' => 'Зарегистрироваться')); 
echo form_close().'<br><div id="fugo"></div></div>';
include_once("Footer.php");