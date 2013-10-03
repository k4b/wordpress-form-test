<?php 
/*
Template Name: MieszkanicznikResult
*/
?>

<?php get_header(); ?>
	<h2  class="catheader">Formularz określania standardu mieszkania</h2>
	<?php 
	
	$form_score = 0;
	$form_divider = 0;
	
	$generate_html_counter = 0;	

	$generate_html = '';
	
	$generate_html = '<style type="text/css">' .
	'<!--' .
	'table, td, tr {border: none; padding: 0px; margin: 0px;}' .
	'table { border: 1px solid green; }' .
	'td { border: 1px solid green; width: 100px; vertical-align: top;}' .
	'-->' .
	'</style>';

	$generate_html .= '<table>';

	if ($_POST) { 

		foreach ($_POST as $param_name => $param_val) {
			if($param_name == 'EndOfForm'){
				break;
			}
			
			if($generate_html_counter % 2 == 0){
				$generate_html .= '<tr>';
			}
					
			$generate_html .= '<td>';

			if(is_array($param_val)){
				foreach($param_val as $param_val_array_element => $param_val_array_element_val){
					$generate_html .= $param_val_array_element_val . '<br \>';
					if(is_int($param_val)) {
						$form_score += $param_val;
						$form_divider += 1;
					}
				}
			} else {
				$generate_html .= $param_val;	
				if(is_int($param_val)) {
					$form_score += $param_val;
					$form_divider += 1;
				}
			}

			$generate_html .= '</td>';

			if($generate_html_counter % 2 <> 0){
				$generate_html .= '</tr>';
			}
			

		    //echo "Param: $param_name; Value: $param_val<br />\n";

			$generate_html_counter++;
		}
	
	$generate_html .= '</table>';

	echo  $generate_html;

	echo 'Wynik punktowy: ' . $form_score . '<br />';
	echo 'Liczba kategorii: ' . $form_divider . '<br />';
	echo 'Średnia: ' . round($form_score/$form_divider) . '<br />';


	} else {
		echo("<p> Nic nie odebrano!</p>");
	} ?>

		<p>Wynik punktowy to <?php echo $form_score; ?>. </p>


<?php get_footer(); ?>

