<?php
class Logincust_Security_Badge_Control extends WP_Customize_Control {

	private $step = "";

	public function __construct($manager, $id, $args = array(), $step = "") {
		$this->step = $step;
		parent::__construct( $manager, $id, $args );
	}

	public function render_content() {
		echo LOGINCUST_PRO_TEXT;
	}

}
?>