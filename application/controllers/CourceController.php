<?php 
class CourceController extends CI_Controller{
		
		public function SignUp(){
			$this->load->view('SignUpView');			
		}		
		
		public function Home(){
			$this->load->view('Homepage');			
		}
		
		public function varify(){
			$this->load->model('insert_model');
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			if($this->insert_model->varifyUser($login, $password)){
				$this->load->helper('cookie');
				$cook = array(
					'name'   => 'username',
					'value'  => $login,
					'expire' => '86500'
				);
				$this->input->set_cookie($cook);  	
				$user_role = $this->insert_model->role($login);
				$role = $user_role[0]->Role;
				$coo = array(
					'name'   => 'userrole',
					'value'  => $role,
					'expire' => '86500'
				);
				$this->input->set_cookie($coo);
				redirect("/CourceController/Home");
			}else{
				$data['message'] = 'Data error';
				$this->load->view('SignUpView',$data);
			}
			
		}
		
		public function addUser(){
			$this->load->model('insert_model');

			$this->load->library('form_validation');
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			//Validating Fields
			$this->form_validation->set_rules('f_name', 'First_name', 'required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('m_name', 'Middle_name', 'required|min_length[3]|max_length[75]');
			$this->form_validation->set_rules('s_name', 'Surname', 'required|min_length[2]|max_length[75]');
			$this->form_validation->set_rules('login', 'Login', 'required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[75]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('SignUpView');
			} else 
			{
				$login = $this->input->post('login');
				$password = $this->input->post('password');
				$f_name = $this->input->post('f_name');
				$m_name = $this->input->post('m_name');
				$s_name = $this->input->post('s_name');
				$email = $this->input->post('email');
				$role = $this->input->post('choose_role');
				if(!($this->insert_model->check_UserExist($login)))
				{
					$this->load->helper('date');
					$datestring = '%Y:%m:%d - %H:%i';
					$time = time();
		
					$data = array(
						'First_name' => $f_name,
						'Middle_name' => $m_name,
						'Surname' => $s_name,
						'Login' => $login,
						'Password' => $password,
						'Email' => $email,
						'Registration_data' => mdate($datestring, $time),
						'Role' => $role
					); 
					//Transfering data to Model
					$this->insert_model->user_insert($data);
			
					$this->load->helper('cookie');
					delete_cookie('username');  
					delete_cookie('userrole');  
					$cook = array(
						'name'   => 'username',
						'value'  => $login,
						'expire' => '86500'
					);
					$this->input->set_cookie($cook);
					$coo = array(
						'name'   => 'userrole',
						'value'  => $role,
						'expire' => '86500'
					);
					$this->input->set_cookie($coo);
					redirect("/CourceController/Home");
				}else{
					$data['log'] = 'Пользователь с таким логином уже существует';
					$this->load->view('SignUpView',$data);
				}
			}
		}
		
		public function unsign(){
			$this->load->helper('cookie');
			delete_cookie('username');  
			delete_cookie('userrole');  	
			redirect("/CourceController/SignUp");
		}
		
		public function add_cource() {
			$this->load->model('insert_model');
			//Including validation library
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			//Validating Name Field
			$this->form_validation->set_rules('dname', 'Name', 'required|min_length[5]|max_length[50]');

			//Validating description Field
			$this->form_validation->set_rules('ddesc', 'Description', 'required|min_length[5]|max_length[75]');

			if ($this->form_validation->run() == FALSE) {
			$this->load->view('Homepage');
			} else {
			$Author = $this->input->post('dauthor');
			$AuthId = $this->insert_model->user_id($Author);
			//Setting values for tabel columns
			$data = array(
			'Name' => $this->input->post('dname'),
			'Author' => $AuthId[0]->idUser,
			'Description' => $this->input->post('ddesc')
			);
			//Transfering data to Model
			$this->insert_model->course_insert($data);
			$data['message'] = 'Data Inserted Successfully';
			//Loading View
			$this->load->model('insert_model');
			$courses_data['val'] = $this->insert_model->getData($AuthId[0]->idUser);
			$this->load->view('CourceView', $courses_data);
			}
		} 
		
		public function add_lessons() {
			$this->load->model('insert_model');
			//Including validation library
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			//Validating Name Field
			$this->form_validation->set_rules('dname', 'Name', 'required|min_length[3]|max_length[45]');

			//Validating description Field
			$this->form_validation->set_rules('dtext', 'Lesson_material', 'required|min_length[10]|max_length[4294967295]');

			if ($this->form_validation->run() == FALSE) {
			$this->load->view('insert_lessons_view');
			} else {
			//Setting values for tabel columns
			$id_cource = $this->input->post('dcourse');
			$data = array(
				'Name' => $this->input->post('dname'),
				'Lesson_material' => $this->input->post('dtext'),
				'idCource' => $id_cource
			);
			//Transfering data to Model
			$this->insert_model->lesson_insert($data);
			$data['message'] = 'Data Inserted Successfully';
			//Loading View
			$lesson_data['val'] = $this->insert_model->getLessons($id_cource);
			$this->load->view('LessonsView', $lesson_data);
			}
		} 
		
		public function sign_cource() {
			$this->load->model('insert_model');
			$this->load->helper('date');
			
			//Setting values for tabel columns
			$id_cource = $this->input->get('id');
			$Login = $this->input->cookie('username');
			$i = $this->insert_model->user_id($Login);
			$id_user = $i[0]->idUser;
			$datestring = '%Y:%m:%d - %H:%i';         //дату округляет в меньшую сторону на минутах
			$time = time();
			
			$data = array(
				'idCourse' => $id_cource,
				'idUser' => $id_user,
				'beginning_data' => mdate($datestring, $time)
			);
			//Transfering data to Model
			$this->insert_model->students_insert($data);
			//Loading View
			redirect("/CourceController/show_cources");
		} 
		
		public function add_task() {
			$this->load->model('insert_model');
			//Including validation library
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			//Validating Name Field
			$this->form_validation->set_rules('dtask', 'Task', 'required|min_length[5]|max_length[510]');

			//Validating description Field
			$this->form_validation->set_rules('danswer', 'Text', 'required|min_length[1]|max_length[510]');
			$this->form_validation->set_rules('doptions', 'Text', 'required|min_length[1]|max_length[510]');

			$id_lesson = $this->input->post('dlesson');
			
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('OptionsView',$id_lesson);  //проверить на работоспособность
			} else {
				//Setting values for tabel columns
				$data = array(
					'Task' => $this->input->post('dtask'),
					'idLesson' => $this->input->post('dlesson')
				);
				$options = array(
					'wright' => explode(";",$this->input->post('danswer')),
					'wrong' => explode(";",$this->input->post('doptions'))
					);
				
				//Transfering data to Model
				$this->insert_model->question_insert($data);
				$dataa['message'] = 'Data Inserted Successfully';
				//$cropped_data = mb_substr($data['Task'],0,50);
				$questi = $this->insert_model->get_question_id($data['Task'],$data['idLesson']);
				$question_id = 0;
				foreach($questi as $q){
					$question_id = $q->idQuestion;
				}

				$options_data = array();
				for($i = 0; $i < count($options['wright']); $i++)
				{
					$options_data = array(
					'Text' => $options['wright'][$i],
					'Correct' => true,
					'idQuestion' => $question_id
					);
					$this->insert_model->options_insert($options_data);
				}
					
				for($i = 0; $i < count($options['wrong']); $i++)
				{
					$options_data = array(
					'Text' => $options['wrong'][$i],
					'Correct' => false,
					'idQuestion' => $question_id
					);
					$this->insert_model->options_insert($options_data);
				}
				redirect("/CourceController/show_text?idLess=$id_lesson");
			}
		} 
		
		public function add_mark() {

			$this->load->model('insert_model');
		
			$id_lesson = $this->input->post('dlesson');

			$q = $this->input->post('count_q');   //количество вопросов

			
			//Setting values for tabel columns
			$data['options'] = $this->insert_model->getOptions($id_lesson);
			$data['questions'] = $this->insert_model->getQuestions($id_lesson);
			$data['lessiontext'] = $this->insert_model->getLessons_text($id_lesson);
			$data['lesson_id'] = $id_lesson;
			$data['checkmark'] = 'check';

			$options_count = 0; 

			for($j = 0; $j < $q; $j++){
				for($i = 0; $i < $this->input->post('count'.$j); $i++){
				
					$val = $this->input->post('question'.$j.'option'.$i);
					if($val){
						$chosen[] = array(
							'idoption'.$options_count => $val
						);
						$options_count++;
					} 
				}
			}
			if (isset($chosen)){
				$data['chosen_options'] = $chosen;
			}
			$data['options_count'] = $options_count;
			$data['q_number'] = $q;
			
			
		$j = 0;
		$mark_count = 0;
		$checknull = 0;
		foreach($data['questions'] as $qu)
		{
			$i = 0; 
			$wrong_count = 0;
			foreach($data['options'] as $o){	
				$checked_opt = 0;
				if($qu->idQuestion == $o->idQuestion)
				{
					if(isset($data['chosen_options']))
					{
						for($k = 0; $k < $options_count; $k++)
						{
							if($data['chosen_options'][$k]['idoption'.$k] == $o->idOption){
								$checknull = 1;
								if ($o->Correct == 0)
								{
									$checked_opt = 1;
									$wrong_count++;
								} else
								{
									$checked_opt = 1;
								}
							}
						}				
						if ($checked_opt == 0 && $o->Correct == 1){
							$wrong_count++;
						}						
					}
				}
			}
			if ($wrong_count == 0 && isset($options_count)){
				$mark_count++;				
			}
			$j++;			
		}
		if($checknull == 0){
			$mark_count = 0;
		}
		$data['test_mark'] = $this->insert_model->CalculateMark($mark_count,$q);
		$data['mark_n'] = $mark_count;
		$Login = $this->input->cookie('username');
		$Student_id = $this->insert_model->get_student_id($Login, $id_lesson);
		$mark_data = array(
			'idStudent' => $Student_id[0]->idStudent,
			'idLesson' => $id_lesson,
			'Mark' => $data['test_mark']
		);
		$this->insert_model->mark_insert($mark_data);
		$this->load->view('OptionsView', $data);
		} 
		
		public function delete_task() {
			$this->load->model('insert_model');
			
			$id_question = $_GET['id_q'];
			$id_lesson = $_GET['id_less'];
			
			$this->insert_model->DeleteQuestions($id_question);
				
			redirect("/CourceController/show_text?idLess=$id_lesson");
		} 
		
		public function show_edit_task() {
			$this->load->model('insert_model');
			
			$id_question = $_GET['id_q'];
			$id_lesson = $_GET['id_less'];
			
			$data['questions'] = $this->insert_model->getQuestions_edit($id_lesson, $id_question);
			$data['options'] = $this->insert_model->getOptions_edit($id_lesson, $id_question);
			
			$this->load->view('OptionsEditView', $data);
		} 
		public function edit_task() {
			$this->load->model('insert_model');
			
			$task = $this->input->post('dtask');
			$idcount = $this->input->post('id_count');			
			$idquest = $this->input->post('id_quest');	
			$id_lesson = $this->input->post('id_less');	
			
			$this->insert_model->Questions_update($idquest, $task, $id_lesson);
			for ($i = 0; $i <= $idcount; $i++){
				$option = $this->input->post('doption'.$i);
			    $idopt = $this->input->post('id_opt'.$i);
			    $check = $this->input->post('check_option'.$i);
				
				if(isset($check)){
					$check = 1;
				}else{
					$check =0;
				}
				$this->insert_model->Options_update($option, $check, $idquest, $idopt);
			}
				redirect("/CourceController/show_text?idLess=$id_lesson");
				
		} 
		
		public function show_cources() {
			$this->load->model('insert_model');
			$Login = $this->input->cookie('username');
			$i = $this->insert_model->user_id($Login);
			$id_user = $i[0]->idUser;
			$courses_data['val'] = $this->insert_model->getData($id_user);
			$this->load->view('CourceView', $courses_data);
		}	
		
		public function show_added_cources() {
			$this->load->model('insert_model');
			$Login = $this->input->cookie('username');
			$i = $this->insert_model->user_id($Login);
			$id_user = $i[0]->idUser;
			$courses_data['val'] = $this->insert_model->getAddedCour($id_user);
			$this->load->view('CourceView', $courses_data);
		}

		public function show_lessons() {
			$this->load->helper('cookie');
			$this->load->model('insert_model');
			$id_cource = $_GET['id'];
			$lessons_data['val'] = $this->insert_model->getLessons($id_cource);
			$lessons_data['id_cource'] = $id_cource;
			$lessons_data['author'] = $this->insert_model->getCourceAuthor($id_cource);
			$this->load->view('LessonsView', $lessons_data);
		}

		public function show_marks() {
			$this->load->model('insert_model');
			$lessons_data['val'] = $this->insert_model->get_marks_data();
			$this->load->view('MarksView', $lessons_data);
		}
		
		public function show_users() {
			$this->load->model('insert_model');
			switch($_GET['Users']){
				case('Teachers'):
					$data['user_data'] = $this->insert_model->getTeachers();
					break;
				case('Students'):
					$data['user_data'] = $this->insert_model->getStudents();
					break;
				case('Profile'):
					$this->load->helper('cookie');
					$data['user_data'] = $this->insert_model->getUserInfo($this->input->cookie('username'));
					break;
				default:
					$data['user_data'] = $this->insert_model->getUsers();
			}
			$this->load->view('UsersView', $data);
		}
			public function show_profile() {
			$this->load->model('insert_model');
			$lessons_data['val'] = $this->insert_model->get_marks_data();
			$this->load->view('MarksView', $lessons_data);
		}
		
		public function show_text() {
			
			$this->load->helper('array');
			
			$this->load->model('insert_model');
			$id_lesson = $_GET['idLess'];
			$data['marks_data'] = $this->insert_model->get_marks_data();
		
			$data['options'] = $this->insert_model->getOptions($id_lesson);
			$data['questions'] = $this->insert_model->getQuestions($id_lesson);
			$data['lessiontext'] = $this->insert_model->getLessons_text($id_lesson);
			$data['lession_author'] = $this->insert_model->getLessonAuthor($id_lesson);
			$data['lesson_id'] = $id_lesson;
		$this->load->view('OptionsView', $data);
		}
}
?>