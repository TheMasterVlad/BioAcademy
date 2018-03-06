<!DOCTYPE HTML>
<html>
    <head>	
        <link href="<?php echo base_url().'project_css/bootstrap.min.css' ?>" rel='stylesheet' >
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    </head>
    <body>
        <div class="container-fluid">
            <h1>Добро пожаловать в BioAcademy</h1>
            <?php
                $Login = $this->input->cookie('username');
                $Role = $this->input->cookie('userrole');
            ?>
            
            <nav class="navbar navbar-light bg-faded" style="background-color: #5cb85c;">
				<a class="navbar-brand" href="#">Full width</a>
                <div class="navbar-header">
                    <a class=" active navbar-brand" href="<?php echo base_url() ?>">BioAcademy</a>
                </div>
                <ul class="nav navbar-nav">	
                    <li><a href="<?php echo base_url().'index.php/CourceController/show_marks' ?>" class="btn btn-success btn-lg" >Оценки</a></li>
                    <li><a href="<?php echo base_url().'index.php/CourceController/show_marks' ?>">Оценки</a></li>
                    <li><a href="<?php echo base_url().'index.php/CourceController/show_users?Users=Teachers' ?>">Учителя</a></li>
                    <li><a href="<?php echo base_url().'index.php/CourceController/show_cources' ?>">Курсы</a></li>
                    <?php 
                    if($Role == 'Admin')
                    {
                        echo '<li><a href="' . base_url().'index.php/CourceController/show_users?Users=All">Пользователи</a></li>';
                    }
                    if($Role == 'Admin' || $Role == 'Teacher')
                    {
                        echo '<li><a href="'. base_url().'index.php/CourceController/show_users?Users=Students">Студенты</a></li>';
                    }
                    ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url().'index.php/CourceController/show_users?Users=Profile' ?>"><span class="glyphicon glyphicon-user"></span><?php echo $Login; ?></a></li>
                    <li><a href="<?php echo base_url().'index.php/CourceController/unsign'?>"><span class="glyphicon glyphicon-log-in"></span> Выйти</a></li>
                </ul>
            </nav>            
            <br><br><br>
            <div class ="btn-group">
                <button type="button" class="btn btn-primary btn-lg" href="<?php echo base_url() ?>">Главная</button>			
                <button type="button" class="btn btn-primary btn-lg" href="<?php echo base_url().'index.php/CourceController/show_marks' ?>">Оценки</button>
                <button type="button" class="btn btn-primary btn-lg" href="<?php echo base_url().'index.php/CourceController/show_users?Users=Teachers' ?>">Учителя</button>	
                <button type="button" class="btn btn-primary btn-lg" href="<?php echo base_url().'index.php/CourceController/show_cources' ?>">Курсы</button>		
                <?php 
                    if($Role == 'Admin')
                    {
                        echo '<button type="button" class="btn btn-primary btn-lg" href="' . base_url().'index.php/CourceController/show_users?Users=All">Пользователи</button>';
                    }
                ?>
                <button type="button" class="btn btn-primary btn-lg"  href="<?php echo base_url().'index.php/CourceController/show_users?Users=Profile' ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $Login; ?></button>
                <button type="button" class="btn btn-danger btn-lg" href="<?php echo base_url().'index.php/CourceController/unsign'?>"><span class="glyphicon glyphicon-log-in"></span> Выйти</button>
                <?php 
                    if($Role == 'Admin' || $Role == 'Teacher')
                    {
                        echo '<button type="button" class="btn btn-primary btn-lg" href="'. base_url().'index.php/CourceController/show_users?Users=Students">Студенты</button>';
                    }
                ?>
            </div>
        </div>
    </body>