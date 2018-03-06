<div class="container-fluid">
    <?php 
    $Login = $this->input->cookie('username');
    if ($Login){
        $Role = $this->input->cookie('userrole');
        include_once("Header.php"); 
        echo '<h1>Здравствуйте, '.$Login.'. Вы вошли как '.$Role.'</h1>';?>	
    <a href="<?php echo base_url().'index.php/CourceController/unsign'?>">Выйти</a><hr>
    <div class="span">
        <ul class="choose-tabs">
            <?php 
                if($Role == 'Student')
                { 
                    echo '<li><a href="'.base_url().'index.php/CourceController/show_cources">Все курсы</a></li>';
                } else
                {
                    echo '<li><a href="'.base_url().'index.php/CourceController/show_added_cources">Добавленные курсы</a></li>
                    <li><a href="'.base_url().'index.php/CourceController/show_cources">Все курсы</a></li>';
                } 
            ?>
	</ul>
    </div>	
    <?php 
	if($Role == 'Admin' || $Role == 'Teacher'){
		echo form_open(base_url()."index.php/CourceController/add_cource").'<h1>Добавить курс</h1><hr/>';
		if (isset($message)) { 
			echo '<CENTER><h3 style="color:green;">Данные были успешно добавлены</h3></CENTER><br>';
		} 

		echo form_label('Введите название курса :'); echo form_error('dname').'<br>';
		echo form_input(array('id' => 'dname', 'name' => 'dname')).'<br>';

		echo form_hidden('dauthor',$Login).'<br>';

		echo form_label('Введите описание курса :'); echo form_error('ddesc').'<br>';
		echo form_input(array('id' => 'ddesc', 'name' => 'ddesc')).'<br>';

		echo form_submit(array('id' => 'submit', 'value' => 'Добавить')); 
		echo form_close().'<br><div id="fugo"></div>';
	}
	include_once("Footer.php"); 
} else{
	redirect(base_url().'index.php/CourceController/SignUp');
}?> 
</div>