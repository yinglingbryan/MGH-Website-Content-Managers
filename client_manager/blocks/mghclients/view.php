<?php
	$ih = Core::make('helper/image');
	
	foreach( $clients as $client ){
		
		// Photo
		$fv = \File::getByID($client["photo"]);
		$curPhoto = $ih->getThumbnail($fv, 200, 200, $client['title']);
		
		// Alt Text
		$curPhotoAlt = $fv->getAttribute('alt_text');
		
		// Alt Text Fallback
		if( !$curPhotoAlt ){
			$curPhotoAlt = "Client Logo";
		}
		
		echo '<img src="'.$curPhoto->src.'" alt="'.$curPhotoAlt.'">';
	}
?>