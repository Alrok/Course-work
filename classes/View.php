<?php

class View
{
    private $content       = array();
    private $template_file = 'views/main_template.php';
    private $data;
    private $param         = array();
    private $test;


    function setTemplate($template_view, $param = array())
    {
        $this->template_file = $template_view;
        if (!empty($param)) {
            $this->param = $param;
        }

    }

    function generateContent($paths = array(), $data = null)
    {

        $this->content = $paths;
        $this->data = $data;

    }

    function display()
    {
        if (!empty($this->param)) {
            $param = $this->param;
        }
        $data = $this->data;
        include $this->template_file;
    }


}

?>