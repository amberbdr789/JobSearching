<?php class Template {
    //path to Template
    protected $template;
    protected $vars = array();//defining empty array

    //constructor
    public function __construct($template) {
        $this->template = $template;
        //echo $template;templates/frontpage.php
    }

    public function __get($key) {
        return $this->vars[$key];    
    }

    public function __set($key, $value) {
        $this->vars[$key] = $value;
    }

    //convert to string, we want to use single value instead of key value pairs.
    public function __toString() {
        //extract the variables, and used only single variable
        extract($this->vars);
        //template path
        chdir(dirname($this->template));
        ob_start();
        include basename($this->template);
        return ob_get_clean();
    }
}
?>


