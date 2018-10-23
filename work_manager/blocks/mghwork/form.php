<?php
	$nh = Loader::helper('navigation');
	$list = new \Concrete\Core\Page\PageList();
	$pages = $list->getResults();
?>

<style type="text/css">
	.body-container { padding: 0 0 20px 27px; }
	.ccm-ui h2 { font-size: 17px; line-height: 29px; }
	.ccm-ui h2 small { font-size: 12px; display: block; line-height: 17px; margin-bottom: 5px; }
	.ccm-ui h2 small a {}

	.formField { margin: 10px 10px 30px; }
	.project-group { display:none; }
</style>

<script type="text/javascript">
	// Toggle Categories
	$("#ccm_category").change(function(){
		$(".project-group").find("select").removeAttr("name");
		$(".project-group.project-"+$(this).val()).find("select").attr("name","project");
		
		$(".project-group").slideUp();
		$(".project-group.project-"+$(this).val()).slideDown();
	});
	
	if( $("#ccm_category").val() != null ){
		$(".project-group select").removeAttr("name");
		$(".project-group.project-"+$("#ccm_category").val()).find("select").attr("name","project");
		
		$(".project-group.project-"+$("#ccm_category").val()).slideDown();
	}
</script>

<div class="formField ccm-ui if5">
	<p><?php echo t('Using the interface below, you can select the project to display and customize the way it appears.'); ?></p>
	
	<h2><?php echo t('Project Categories'); ?> <small><?php echo t('Please select a category to reveal projects.'); ?></small></h2>

	<select id="ccm_category" class="select form-control" name="activeCategory" style="width:50%;">
		<option value="none" selected="selected" disabled="disabled">-- <?php echo t('Please Choose'); ?> --</option>
		<?php
			foreach( $categories as $category ){
				if( $activeCategory == $category['bID'] ){
					echo '<option value="'.$category['bID'].'" selected="selected">'.$category['name'].'</option>';
				} else {
					echo '<option value="'.$category['bID'].'">'.$category['name'].'</option>';
				}
			}
		?>
	</select>
	
	<?php foreach( $categories as $category ){ ?>
	<div class="project-group project-<?php echo $category['bID']; ?>">
		<h2><?php echo t('Project ('.$category['name'].')'); ?> <small><?php echo t('This feature allows you to choose from list of projects.'); ?></small></h2>

		<select id="ccm_project_<?php echo $category['bID']; ?>" class="select form-control" name="project" style="width:50%;">
			<option value="" selected="selected" disabled="disabled">-- <?php echo t('Please Choose'); ?> --</option>
			<?php
				foreach( $projects as $projectItem ){
				
					$projectItem['category'] = explode(",", $projectItem['category']);
				
					if( in_array($category['bID'], $projectItem['category']) ){
						if( $project == $projectItem['bID'] ){
							echo '<option value="'.$projectItem['bID'].'" selected="selected">'.$projectItem['name'].'</option>';
						} else {
							echo '<option value="'.$projectItem['bID'].'">'.$projectItem['name'].'</option>';
						}
					}
				
				}
			?>
		</select>
	</div>
	<?php } ?>
	
	<h2><?php echo t('Display Size'); ?> <small><?php echo t('This feature allows you to choose to render this project full or half width.'); ?></small></h2>
	<select id="ccm_displaySize" class="select form-control" name="displaySize" style="width:50%;">
		<option value="full" selected="selected" disabled="disabled">-- <?php echo t('Please Choose'); ?> --</option>
		<option <?php if($displaySize == 'full') echo "selected='selected'"; ?> value="full"><?php echo t('Full'); ?></option>
	    <option <?php if($displaySize == 'half') echo "selected='selected'"; ?> value="half"><?php echo t('Half'); ?></option>
	</select>
	
	<h2><?php echo t('Display Type'); ?> <small><?php echo t('This feature allows you to choose the hover behavior.'); ?></small></h2>
	<select id="ccm_displayType" class="select form-control" name="displayType" style="width:50%;">
		<option value="logo" selected="selected" disabled="disabled">-- <?php echo t('Please Choose'); ?> --</option>
		<option <?php if($displayType == 'logo') echo "selected='selected'"; ?> value="logo"><?php echo t('Display Logo'); ?></option>
	    <option <?php if($displayType == 'headlines') echo "selected='selected'"; ?> value="headlines"><?php echo t('Display Headlines (short)'); ?></option>
		<option <?php if($displayType == 'caption') echo "selected='selected'"; ?> value="caption"><?php echo t('Display Headline & Caption'); ?></option>
	</select>
	
	<h2><?php echo t('Link Type'); ?> <small><?php echo t('This feature allows you to choose the link behavior.'); ?></small></h2>
	<select id="ccm_linkType" class="select form-control" name="linkType" style="width:50%;">
		<option value="fancybox" selected="selected" disabled="disabled">-- <?php echo t('Please Choose'); ?> --</option>
		<option <?php if($linkType == 'fancybox') echo "selected='selected'"; ?> value="fancybox"><?php echo t('Fancybox'); ?></option>
	    <option <?php if($linkType == 'link') echo "selected='selected'"; ?> value="link"><?php echo t('Link'); ?></option>
	</select>
	
	<h2><?php echo t('URL'); ?> <small><?php echo t('This feature allows you to specify a destination url for the project (required only for the link display type).'); ?></a> </small></h2> 
	<select id="ccm_url" class="select form-control" name="url" style="width:50%;">
		<option value="/" selected="selected" disabled="disabled">-- <?php echo t('Please Choose'); ?> --</option>
		<?php
			foreach($pages as $page){
				if( $nh->getCollectionURL($page) == $url ){
					echo '<option value="'.$nh->getCollectionURL($page).'" selected="selected">'.$page->getCollectionName().'</option>';
				} else {
					echo '<option value="'.$nh->getCollectionURL($page).'">'.$page->getCollectionName().'</option>';
				}
			}
		?>
	</select>
</div>
