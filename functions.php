// Shortcode per mostrare sottocategorie correnti

function current_category_shortcode() {
    if (is_archive()) {
		
		   $term = get_queried_object();
		$rewrite = $term->rewrite;
			$etichetta = $term->label;
     
		
		if (!isset($term->taxonomy)){
		
			
			 $slugcat = $rewrite['slug'];
			
		 $taxonomies = get_object_taxonomies($slugcat, 'objects');
    	 $taxonomy_names = array();
		
		

    foreach ($taxonomies as $taxonomy) {
        $taxonomy_names[] = $taxonomy->name;
    }

		
		
		//LOOP PER OTTENERE SUBCATEGORIE DI TUTTE LE TAXONOMIES
		
		
		$conteggio = count($taxonomy_names);
		
		for ($x = 0; $x < $conteggio; $x++) {//OTTENGO SUBCATEGORIE
		
		$taxonomy_name = $taxonomy_names[$x];
			
			if (!empty($taxonomy_name)){
		// cambiare questa etichetta con la dicitura voluta per la lista delle taxonomy associate al custom post type
				echo '<h3>Esplora le sottocategorie </h3>';
				
				//se serve usa $etichetta per il nome;
				
		$terms = get_terms($taxonomy_name, array('hide_empty' => false));

foreach ($terms as $term) {
	echo '<a href="/'.$taxonomy_name.'/'.$term->slug.'">'.$term->name.'</a><br>';
}

			}		
		
	}//OTTENGO SUBCATEGORIE
		
	} else {
			
			
// Carica tassonomia corrente da term
$sub_taxonomy = get_taxonomy($term->taxonomy);

// esiste taxonomy
if ($sub_taxonomy) {
    // ottieni ogg associati
    $object_types = $sub_taxonomy->object_type;
	
	//prendi solo il primo e mettilo in un tasto controllando che esista prima
	if (isset ($object_types[0])){
	$label = $object_types[0];

		echo '<button onclick="window.open(';
		echo "'/".$label."','_self')";
		echo '">Torna Indietro</button>';
		
}
} 
			
		}
		
		}
}

add_shortcode('current_category', 'current_category_shortcode');

// Shortcode per mostrare sottocategorie correnti
