<?php 
class Insert_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
	}
	
	public function course_insert($data){
		// Inserting in Table(Courses) of Database(BioAcademy)
		$this->db->insert('Courses', $data);
	}
	
	public function lesson_insert($data){
		// Inserting in Table(Lessons) of Database(BioAcademy)
		$this->db->insert('Lessons', $data);
	}		
	
	public function question_insert($data){
		// Inserting in Table(Questions) of Database(BioAcademy)
		$this->db->insert('Questions', $data);
	}	
	public function get_question_id($Task,$idLesson){
		$sql = "SELECT `idQuestion` FROM `Questions` WHERE `Task` = '".$Task."' AND `idLesson` = '".$idLesson."'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function options_insert($options_data){
		// Inserting in Table(Options) of Database(BioAcademy)
		$this->db->insert('Options', $options_data);
	}		
	public function user_insert($data){
		// Inserting in Table(Users) of Database(BioAcademy)
		$this->db->insert('Users', $data);
	}	
	
	public function students_insert($s_data){
		// Inserting in Table(Students) of Database(BioAcademy)
		$this->db->insert('Students', $s_data);
	}
	
	public function mark_insert($mark_data){
		// Inserting in Table(Marks) of Database(BioAcademy)
		$this->db->insert('Marks', $mark_data);
	}

	public function getData($idUser)
	{	
		$query = $this->db->query("SELECT `Courses`.`idCourse`, `Name`, `Description`, `Login`, `idStudent`, `beginning_data` FROM `Courses` LEFT JOIN `Students` ON `Courses`.`idCourse` = `Students`.`idCourse` AND `Students`.`idUser` = '".$idUser."' LEFT JOIN `Users` ON `Users`.`idUser` = `Courses`.`Author` GROUP BY `Name`");
		return $query->result();
	}	
	
	public function getAddedCour($idUser)
	{	
		$query = $this->db->query("SELECT `Courses`.`idCourse`, `Name`, `Login`, `Description` FROM `Courses` LEFT JOIN `Users` ON `Courses`.`Author` = `Users`.`IdUser` WHERE `idUser` = '".$idUser."'");
		return $query->result();	
	}
	
	public function getCourceAuthor($idCource)
	{	
		$query = $this->db->query("SELECT `Users`.`Login` FROM `Courses` LEFT JOIN `Users` ON `Courses`.`Author` = `Users`.`IdUser` WHERE `idCourse` = '".$idCource."'");
		return $query->result();
	}	
	
	public function CalculateMark($mark_count,$j){
		$mark = 1;
		switch($j){
			case 1:
				if ($mark_count == 1){
					$mark = 5;
				}
				break;
			case 2:
				switch($mark_count){
					case 1:
						$mark = 3;
						break;
					case 2:
						$mark = 5;
						break;
				}
				break;
			case 3:
				switch($mark_count){
					case 1:
						$mark = 2;
						break;
					case 2:
						$mark = 4;
						break;
					case 3:
						$mark = 5;
						break;
				}
				break;
			case 4:
				switch($mark_count){
					case 1:
						$mark = 2;
						break;
					case 2:
						$mark = 3;
						break;
					case 3:
						$mark = 4;
						break;
					case 4:
						$mark = 5;
						break;
				}
				break;
		}
		return $mark;
	}
	
	public function getLessonAuthor($idLesson)
	{	
		$query = $this->db->query("SELECT `Users`.`Login` FROM `Courses` LEFT JOIN `Users` ON `Courses`.`Author` = `Users`.`IdUser` LEFT JOIN `Lessons` ON `Courses`.`idCourse` = `Lessons`.`idCource` WHERE `idLesson` = '".$idLesson."'");
		return $query->result();
	}	
	
	public function getLessons($id)
	{			
        $query = $this->db->query("SELECT `Lessons`.`idCource`, `Lessons`.`Name`, `Lessons`.`idLesson`, `Courses`.`Name` as Cource FROM `Lessons` LEFT JOIN `Courses` ON `Courses`.`idCourse` = `Lessons`.`idCource` WHERE `idCource` = '".$id."'");
		return $query->result();
	}	
	public function getLessons_text($id)
	{			
        $query = $this->db->query("SELECT * FROM Lessons WHERE idLesson = '".$id."'");
		return $query->result();
	}		
	/*public function getAllOptions()
	{			
        $query = $this->db->query("SELECT `Users`.`Login`,`Questions`.`idQuestion`,`Questions`.`Task`,`Options`.`Text`, `Options`.`idOption`, `Options`.`Correct` FROM `Questions` LEFT JOIN `Options` ON `Questions`.`idQuestion` = `Options`.`idQuestion`");
		return $query->result();
	}	*/
	
	public function getOptions($id)
	{			
        $query = $this->db->query("SELECT `Users`.`Login`, `Questions`.`idQuestion`,`Questions`.`Task`,`Options`.`Text`, `Options`.`idOption`, `Options`.`Correct`, `Questions`.`idLesson` FROM `Users` LEFT JOIN `Courses` ON `Courses`.`Author` = `Users`.`IdUser` LEFT JOIN `Lessons` ON `Courses`.`idCourse` = `Lessons`.`IdCource` LEFT JOIN `Questions` ON `Lessons`.`IdLesson` = `Questions`.`IdLesson` LEFT JOIN `Options` ON `Questions`.`idQuestion` = `Options`.`idQuestion` WHERE `Questions`.`idLesson` = '".$id."'");
		return $query->result();
	}	
	public function getOptions_edit($id_less, $id_quest)
	{			
        $query = $this->db->query("SELECT `Questions`.`idQuestion`,`Questions`.`Task`,`Options`.`Text`, `Options`.`idOption`, `Options`.`Correct` FROM `Questions` LEFT JOIN `Options` ON `Questions`.`idQuestion` = `Options`.`idQuestion` WHERE `Questions`.`idLesson` = '".$id_less."' AND `Options`.`idQuestion` = '".$id_quest."'");
		return $query->result();
	}	
	public function Options_update($text, $cor, $idquest, $idopt)
	{			
		$data = array(
			'Text' => $text,
			'Correct' => $cor,
			'idQuestion' =>  $idquest
		);
		$this->db->where('idOption', $idopt);
		$this->db->update('Options', $data);
	}	
	public function Questions_update($idquest, $text, $idless)
	{			
		$data = array(
			'Task' => $text,
			'idLesson' =>  $idless
		);
		$this->db->where('idQuestion', $idquest);
		$this->db->update('Questions', $data);
	}	
	public function getTasks()
	{			
		$query = $this->db->get('Questions');
		return $query->result();
	}		
	public function getQuestions($id_lesson)
	{			
		//$query = $this->db->query("SELECT * FROM `Options` WHERE `idQuestion` = '".$id_question."' ORDER BY RAND(`idOption`)");
		$query = $this->db->query("SELECT * FROM `Questions` WHERE `idLesson` = '".$id_lesson."' ");
		return $query->result();
	}		
	public function getQuestions_edit($id_lesson, $id_question)
	{	
		$query = $this->db->query("SELECT * FROM `Questions` WHERE `idLesson` = '".$id_lesson."' AND `idQuestion` = '".$id_question."' ");
		return $query->result();
	}		
	public function DeleteQuestions($id_question)
	{			
		$tables = array('Options','Questions');
		$this->db->where('idQuestion',$id_question);
		$this->db->delete($tables);
	}		
	
	public function varifyUser($login, $pass)
		{			
			$this->db->select('Login','Password');
			$this->db->from('Users');
			$this->db->where('Login', $login);
			$this->db->where('Password', $pass);
			
			$query= $this->db->get();
			if($query->num_rows() == 1){
				return true;
			} else
				return false;
		}	
		
	public function check_UserExist($login)
		{			
			$this->db->select('Login');
			$this->db->from('Users');
			$this->db->where('Login', $login);
			
			$query= $this->db->get();
			if($query->num_rows() == 1){
				return true;
			} else
				return false;
		}		
				
		public function role($login)
		{			
			$this->db->select('Role');
			$this->db->from('Users');
			$this->db->where('Login', $login);
			$query= $this->db->get();
			return $query->result();

		}			
		public function user_id($login)
		{			
			$this->db->select('idUser');
			$this->db->from('Users');
			$this->db->where('Login', $login);
			$query= $this->db->get();
			return $query->result();

		}			
		
		public function get_student_id($login, $lesson_id)
		{			
			$query = $this->db->query("SELECT `idStudent` FROM  `Users` LEFT JOIN `Students` ON `Users`.`IdUser` = `Students`.`IdUser` LEFT JOIN `Courses` ON `Students`.`IdCourse` = `Courses`.`idCourse` LEFT JOIN `Lessons` ON `Courses`.`idCourse` = `Lessons`.`IdCource` WHERE `Users`.`Login` = '".$login."' AND `Lessons`.`idLesson` = '".$lesson_id."'");
		return $query->result();
		}		
		
		/*
		SELECT `Marks`.`idMark` , `Marks`.`idLesson`, `Courses`.`idCourse`, `Marks`.`Mark`, `Courses`.`Name` AS Course_name, `Lessons`.`Name` AS Lesson_name, `Users`.`Login`
			FROM `Users` LEFT JOIN `Students` ON `Users`.`idUser` = `Students`.`idUser`
			LEFT JOIN `Courses` ON `Students`.`idCourse` = `Courses`.`idCourse`
            LEFT JOIN `Lessons` ON `Students`.`idCourse` = `Lessons`.`idCource`
			LEFT JOIN `Marks` ON `Lessons`.`IdLesson` = `Marks`.`IdLesson`
			GROUP BY `Marks`.`idMark`
		*/
		public function get_marks_data()
		{			//исправить логины, неверный порядок
			$query = $this->db->query("SELECT `Marks`.`idMark` , `Marks`.`idLesson`, `Courses`.`idCourse`, `Marks`.`Mark`, `Courses`.`Name` AS Course_name, `Lessons`.`Name` AS Lesson_name, `Users`.`Login` FROM `Marks` LEFT JOIN `Students` ON `Marks`.`idStudent` = `Students`.`idStudent` LEFT JOIN `Courses` ON `Students`.`idCourse` = `Courses`.`idCourse` LEFT JOIN `Lessons` ON `Lessons`.`idCource` = `Courses`.`idCourse` LEFT JOIN `Users` ON `Users`.`idUser` = `Students`.`idUser` GROUP BY `Marks`.`idMark`");
			return $query->result();
		}				
		
		public function getUserInfo($Login)
		{			
			$query = $this->db->query("SELECT `idUser`, `Login`, `First_name`, `Middle_name`, `Surname`, `Email`, `Registration_data` FROM `Users` WHERE `Login` = '".$Login."'");
			return $query->result();
		}	
		
		public function getUsers()
		{			
			$query = $this->db->query("SELECT `idUser`, `Login`, `First_name`, `Middle_name`, `Surname`, `Email`, `Registration_data` FROM `Users`");
			return $query->result();
		}		
		public function getStudents()
		{			
			$query = $this->db->query("SELECT `idUser`,`Login`, `First_name`, `Middle_name`, `Surname`, `Email`, `Registration_data` FROM `Users` WHERE `Role` = 'Student'");
			return $query->result();
		}	
		public function getTeachers()
		{			
			$query = $this->db->query("SELECT `idUser`, `Login`, `First_name`, `Middle_name`, `Surname`, `Email`, `Registration_data` FROM `Users` WHERE `Role` = 'Teacher'");
			return $query->result();
		}			
}
?>