<?php
class Logincust_Security_Text_Control_Disabled extends WP_Customize_Control {

	private $step = "";

	public function __construct($manager, $id, $args = array(), $step = "") {
		$this->step = $step;
		parent::__construct( $manager, $id, $args );
	}

	public function render_content() {
	?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<p class="description customize-section-description"><?php echo esc_html( $this->description ); ?></p>
			<input type="text" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" placeholder="<?php echo intval( $this->value() ); ?>" disabled="disabled"/>
		</label>
	<?php
	}

}
?>