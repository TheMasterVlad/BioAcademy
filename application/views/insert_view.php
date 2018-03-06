<html>
<head>
<title>Insert Data Into Database Using CodeIgniter Form</title>
<link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
</head>
<body>

<div id="container"> <?php
echo form_open('CourceController.php').'<h1>Insert Data Into Database Using CodeIgniter</h1><hr/>';
 if (isset($message)) { 
	echo '<CENTER><h3 style="color:green;">Data inserted successfully</h3></CENTER><br>';
 } 
echo form_label('Name :'); echo form_error('dname').'<br>';
echo form_input(array('id' => 'dname', 'name' => 'dname')).'<br>';

echo form_hidden('dauthor', $this->input->cookie('username')).'<br>';

 echo form_label('Description :'); echo form_error('ddesc').'<br>';
echo form_input(array('id' => 'ddesc', 'name' => 'daddress')).'<br>';

echo form_submit(array('id' => 'submit', 'value' => 'Submit'));
echo form_close().'<br>';?>
<div id="fugo">

</div>
</div>
</body>
</html>