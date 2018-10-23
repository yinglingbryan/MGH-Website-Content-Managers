<?php
	$ih = Core::make('helper/image');
?>

<ul class="clearfix">
<?php 
	foreach( $people as $person ){
		
		// Photo
		$fv = \File::getByID($person["photo"]);
		$photo = $ih->getThumbnail($fv, 466, 557, $person['title']);
		
		// Alt Text
		$photoAlt = $fv->getAttribute('alt_text');
		
		// Alt Text Fallback
		if( !$photoAlt ){
			$photoAlt = "Headshot";
		}
		
		echo '<li>';
		echo '	<img src="'.$photo->src.'" alt="'.$photoAlt.'" />';
		
		echo '		<div class="who">';
		echo '		<h4>'.$person['name'].'</h4>';
		echo '		<p>'.$person['title'].'</p>';
		echo '		</div>';

		echo '		<div class="what">';
		if( $person['linkedin'] ){
		echo '			<a href="'.$person['linkedin'].'" target="_blank" class="ln"></a>';
		}

		if( $person['twitter'] ){
		echo '			<a href="'.$person['twitter'].'" target="_blank" class="tw"></a>';
		}
		
		echo '			<p>'.$person['caption'].'</p>';
		echo '		</div>';
		echo '</li>';
	}
?>
</ul>