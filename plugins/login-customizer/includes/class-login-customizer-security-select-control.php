<?php
class Logincust_Security_Select_Control extends WP_Customize_Control {

	private $options = "";
	private $field = "";

	public function __construct($manager, $id, $args = array(), $options = "", $field) {
		$this->options = $options;
		$this->field = $field;
		parent::__construct( $manager, $id, $args );
	}

	public function render_content() {
	?>
		<label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<p class="description customize-section-description"><?php echo esc_html( $this->description ); ?></p>
		<select <?php $this->link(); ?> disabled="disabled">
		<?php
			$var = get_option( $this->field );

			foreach ($this->options as $option){
				if($this->options == $var){
					echo '<option value="'.$option.'" selected="selected">'.$option.'</option>';
				} else {
					echo '<option value="'.$option.'">'.$option.'</option>';
				}
			}
		?>
		</select>

		</label>
	<?php
	}

}
?>