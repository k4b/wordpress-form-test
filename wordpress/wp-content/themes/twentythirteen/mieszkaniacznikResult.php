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
	$text_builder = '';
        $is_text = false;

	if ($_POST) { 
            /*

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
        */
            
        //<input value="Stary-Tapczan=1">
        
            foreach ($_POST as  $param_name => $param_val) {
                if($param_name == 'EndOfForm'){
                    break;
		} else if($param_name == 'StartOfText') {
                    $is_text = true;
                } else if($param_name == 'EndOfText') {
                    $is_text = fase;
                }    
                
                if(is_array($param_val)){
                    $text_builder .= $param_name . ': ';
                    foreach($param_val as $param_val_array_element => $param_val_array_element_val){
                            $labels = explode("=", $param_val_array_element_val); // parsuje "="
                            $labels[0] = str_replace("-", " ", $labels[0]); // zamienia "-" na " "
                            $labels[1] = str_replace("-", " ", $labels[1]); // zamienia "-" na " "
                            $text_builder .= $labels[1] . ', ';
                            if(is_int($labels[2])) {
                                $form_score += $labels[2];
                                $form_divider += 1;
                            }
                    }
                } else {
                    $param_val_data = explode("=", $param_val); // parsuje "="
                    $param_val_data[0] = str_replace("-", " ", $param_val_data[0]); // zamienia "-" na " "
                    $param_val_data[1] = str_replace("-", " ", $param_val_data[1]); // zamienia "-" na " "

                    if($is_text == true) {
                        if($param_name <> 'StartOfText' && $param_name <> 'EndOfText') {
                        $text_builder .= $param_name . ': ' . $param_val;
                        }
                    } else {
                        $text_builder .= $param_val_data[0] . ': ' . $param_val_data[1];	
                    }
                    
                    if(is_int($param_val)) {
                            $form_score += $param_val_data[2];
                            $form_divider += 1;
                    }
                }
                $text_builder .= '<br />';
            }
            echo $text_builder;

	} else {
		echo("<p> Nic nie odebrano!</p>");
	} ?>

		<p>Wynik punktowy to <?php echo $form_score; ?>. </p>


<?php get_footer(); ?>

