    <div class="wrap">
        <h2><?php _e('Create shortcode for subpage navigator','subpage'); ?></h2>
        
        <form action="" method="POST">
            
             <h3><?php _e('Sub Page Display Options','subpage'); ?></h3>
             <h4><?php _e('Select the subpage dislaying options if subpage exists for that particular parent page.','subpage');?></h4>
          
             <table class="form-table">
             	<tbody>
             		
             		<tr valign="top">
             		<th scope="row"><?php _e('Title','subpage');?></th>
             		<!-- Title Field -->
             		<td>
             		<?php 
				echo "<input id='title' type='text' name='title' value='Pages' onChange='change_attribute(this)' />";?>
             		</td>
             		</tr>
             		
             		<tr valign="top">
             		<th scope="row"><?php _e('Sort Order','subpage');?></th>
             		
             		<!-- Sort Order Field -->
             		<td>
             			
	
			<select id='sort_order' name="sort_order"  tabindex="1" onChange="change_attribute(this)">
			<?php 
		
				$order_options = array(
							'ASC'=>__('Ascending','subpage'), 
							'DESC'=>__('Descending','subpage')
							);
			foreach ($order_options as $option_key=>$option_value ) { ?>
				<option
					value="<?php echo esc_attr($option_key); ?>"><?php echo __($option_value,'subpage'); ?>
				</option>
				<?php }?>
	</select>
             		</td>
             		</tr>
             	
             	</tbody>
             </table>
                          
             <table class="form-table">
             	<tbody>
             		<tr valign="top">
             		<th scope="row"> <?php _e('Sorting Criteria:','subpage');?></th>
             		
             		<!-- Sorting Criteria Field -->
             		<td>
				<select id='sort_by_values' name="sort_by_values" size="7" multiple="multiple" tabindex="1" onChange="change_attribute(this)">
					<?php
						$options = array(
								'ID'=>__('Page ID','subpage'),
								'post_title'=>__('Page Title','subpage'),
								'menu_order'=>__('Menu Order','subpage'),
								'post_date'=>__('Date Created','subpage'),
								'post_modified'=>__('Date Modified','subpage'),
								'post_author'=>__('Page Author','subpage'),
								'post_name'=>__('Post Slug','subpage')
								);

						foreach ( $options as $key=>$value ) {?>
							<option
								value="<?php echo $key; ?>">
								<?php echo __($value,'subpage'); ?>
							</option>
							<?php } ?>
				</select>
             		</td>
             		</tr>
             		<tr valign="top">
             		<th scope="row"><?php _e('Exclude Pages','subpage');?></th>
             		
             		<!-- Exclude Pages Field -->
             		<td>
             			<select id='exclude_page_id' name="exclude_page_id" size="6" multiple="multiple"
						tabindex="1" onChange="change_attribute(this)">
						
							<?php 
							
								$pages = get_pages();
								foreach ( $pages as $page ) { 
							?>
							<option
								value="<?php echo esc_attr($page->ID);?>">
							<?php echo __("$page->post_title"); ?>
							</option>
							<?php } ?>
					</select>
             		</td>
             		
             		<tr valign="top">
             		<th scope="row"><?php _e('Depth Level','subpage'); ?></th>
             		
             		<!-- Depth Level Field -->	
             		<td>
             			<select id='depth' name="depth"  tabindex="1" onChange="change_attribute(this)">
					<?php
						$depth_options = array(
							'1'=>__('1st Level Depth','subpage'),
							'2'=>__('2nd Level Depth','subpage'),
							'3'=>__('3rd Level Depth','subpage'),
							'4'=>__('4th Level Depth','subpage'),
							'0'=>__('Unlimited Depth','subpage')
						);
						foreach($depth_options as $depth_number=>$depth_label) {   ?>
						<option
							value="<?php echo $depth_number; ?>"><?php echo __($depth_label,'subpage'); ?>
						</option>
					<?php }?>
				</select>
             		</td>
             	</tbody>
             </table>
              <h3><?php _e('Dynamic Shortcode','subpage');?></h3>
             <h4> <?php _e('Please Copy This Shortcode and paste where you want to display subpages or parent pages.','subpage');?></h4>
             <table class="form-table">
             	<tbody>
             		<tr valign="top">
             		<th scope="row"><?php _e('Dynamic Shortcode:','subpage');?></th>
             		<td>
             			<?php echo '<div id= "shortcode">[subpages]</div>';?>
             		</td>
             </tr></tbody></table>
        </form>
    </div>