<?php

class MessageController extends AppController{
function getmessages(){
          $output = $this->Bcampapi->connectto();
		pr($output);
          $this->set('output',$output);
              
        }
    }
       ?>
