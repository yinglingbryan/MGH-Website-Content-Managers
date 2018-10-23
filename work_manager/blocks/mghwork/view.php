<?php
	if( $currentProject ){
		$ih = Core::make('helper/image');
	
		// Logo	
		if( $currentProject["logo"] != "0" ){
			$logo = \File::getByID($currentProject["logo"]);
			$logo = $ih->getThumbnail($logo, 1412, 699, $currentProject["name"]." logo");
			$logo = $logo->src;
		}
	
		// Asset
		if( $currentProject["asset"] != "0" ){
		
			$asset = \File::getByID($currentProject["asset"]);
			$assetPoster = \File::getByID($currentProject["assetPoster"]);
									
			// Asset Poster
			if( $assetPoster ){
				// Check Display Type
				if( $displaySize == "full" ){ 
					// Full
					$assetPoster = $ih->getThumbnail($assetPoster, 1412, 699, $currentProject["name"]." asset", false, true);
					$assetPoster = $assetPoster->src;
				
				} else { 
					// Half
					$assetPoster = $ih->getThumbnail($assetPoster, 700, 699, $currentProject["name"]." asset", false, true);
					$assetPoster = $assetPoster->src;
				}
				
			} else {
				
				// Check File Type - Fallback Image Posters to Asset File
				if( $asset->getType() == "PNG" || $asset->getType() == "JPEG" || $asset->getType() == "GIF" ){

					$assetPoster = $ih->getThumbnail($asset, 1500, 1500, $currentProject["name"]." asset", false, true);
					$assetPoster = $assetPoster->src;
					
				} else {
					$assetPoster = "/application/themes/mgh/css/images/work-fallback.jpg";
				}
				
			}
			
			// Asset
			if( $asset ){
				$asset = $asset->getURL();
			} else {
				$asset = "/application/themes/mgh/css/images/work-fallback.jpg";
			}
						
		}
	
		// URL
		if( $linkType == "link" ){
			// Link
			$assetURL = $url;
			$classes = "link";
		} else {
			// Fancybox
			if( $currentProject["assetType"] == "image" ){
				$assetURL = $asset;
			} else {
				$assetURL = '#project-video-'.$currentProject['bID'];
			}
			
			$classes = "fancybox";
		}
	}
?>

<?php if( $currentProject ){ ?>
<div class="project <?php echo $displaySize . ' dt-' . $displayType ?>">
	<a href="<?php echo $assetURL; ?>" class="display-<?php echo $displaySize.' '.$classes; ?>" rel="group">
		<span class="project-poster" style="background-image:url('<?php echo $assetPoster; ?>');"></span>
		
		<?php if( $displayType == "headlines" ){ ?>
			<?php /*
			<div>
				<h4><?php echo $currentProject["name"]; ?></h4>
				<p><?php echo $currentProject["type"]; ?></p>
			</div>
			*/ ?>
		<?php } elseif( $displayType == "caption" ){ ?>
			<div>
				<h4><?php echo $currentProject["name"]; ?></h4>
				<p><?php echo $currentProject["caption"]; ?></p>
			</div>
		<?php } else { ?>
			<span class="project-logo" style="background-image:url('<?php echo $logo; ?>');"></span>
		<?php } ?>
		
		<span class="project-logo" style="background-image:url('<?php echo $logo; ?>');"></span>
	</a>
	
	<?php if( $currentProject["assetType"] == "video" ){ ?>
	<div id="project-video-<?php echo $currentProject['bID']; ?>" style="display:none; height:100%;">
   		<video poster="<?php echo $assetPoster; ?>" class="project-video" width="100%" height="100%">
      		<source src="<?php echo $asset; ?>"></source>
   		</video>

		<a class="video-btn"></a>
	</div>
	<?php } ?>
	
	<?php if( $currentProject["assetType"] == "audio" ){ ?>
	<div id="project-video-<?php echo $currentProject['bID']; ?>" style="display:none; height:250px; width:250px;">
   		<video poster="<?php echo $assetPoster; ?>" class="project-video" width="100%" height="100%">
      		<source src="<?php echo $asset; ?>"></source>
   		</video>

		<a class="video-btn"></a>
	</div>
	<?php } ?>
</div>
<?php } ?>
