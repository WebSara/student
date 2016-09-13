<?php
class View{
        public $data = array();
        public function render($tplname, $data = null)
    {

        // get the path to file

        $path = 'views/' . $tplname . '.php';
        // get data variables if supplied
               if($data != null)
        {
            extract($data);
        }
      
            ob_start();
            include $path;
             $content = ob_get_contents();
            
            ob_end_clean();

        return $content;
    }
    
    
}