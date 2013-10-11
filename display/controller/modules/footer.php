<?php
	class ControllerModulesFooter extends Controller {
		public function render(){
			$this->data['copyright'] = "Copyright Senecio 2013";
			if($this->getTemplate())
                            $this->output ($this->getTemplate()->getTemplate($this->getId()),$this->data);
				/*include( $this->getTemplate()->getTemplate($this->getId()) );*/
			//$this->getTemplate()->getTemplate();
		}
	}
?>