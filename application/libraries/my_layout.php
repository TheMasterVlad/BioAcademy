<?php 
class my_layout extends CI_Controller {

    // пути к файлам вида
    public $header = 'header.php';
    public $footer = 'footer.php';

    // метод получает на вход два параметра: название вида и данные для него
    public function content($views = '', $data = '')
    {
        // загружаем header
        if ($this->header)
        {
            $this->load->view($this->header, $data);
        }

        // загружаем основной контент, который может иметь больше одного вида
        if (is_array($views))
        {
            foreach ($views as $view)
            {
                $this->load->view($view, $data);
            }
        }
        else
        {
            $this->load->view($views, $data);
        }

        // загружаем footer
        if ($this->footer)
        {
            $this->load->view($this->footer);
        }
    }
}
?>