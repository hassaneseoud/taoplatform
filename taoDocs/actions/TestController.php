<?php
namespace oat\taoDocs\actions;

class TestController extends \tao_actions_CommonModule {
	
	
	 public function sayHello() {
          if($this->hasRequestParameter('name')){
               $name = $this->getRequestParameter('name');
          }
          else{
               $name = 'everybody';
          }
          $this->setData('name', $name);
          $this->setView('hello.tpl');
     }
	
}

?>