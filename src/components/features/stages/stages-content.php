<section class="section-stages clear-both">
		<header class="header-center entry-header-section text-center">
			<span class="header-span">
			<h2><?php echo esc_html(get_theme_mod('wpg_stages_title',__('Realization Stages', 'wpg_theme'))); ?></h2>
				<span class="border"></span>			
			</span>
			<p><?php echo esc_html(get_theme_mod('wpg_stages_desc','')); ?></p>
		</header>		
		<?php 
		
		$stages_number = absint(get_theme_mod('wpg_stages_number',2));

		for ( $a = 1; $a <= 2; $a++ ) {
				
			echo "<div class='stage-list section-$a'>";
		
			if ($a == '2') {
				$i = ($stages_number/2) + 1;
				$stagess = $stages_number;
			} else {
				$i = 1;
				$stagess = $stages_number/2;
			}
			     
			for ( $i; $i <= $stagess; $i++ ) { ?>
				<div id="stages-<?php echo $i ?>" class="stage">
					<h3><?php echo get_theme_mod("wpg_stages_title_$i",''); ?></h3>
					<p><?php echo get_theme_mod("wpg_stages_desc_$i",''); ?></p>
					<span class="stage-number"><?php echo $i; ?></span>
				</div>
			<?php
			}
			echo '</div>';
		}
	?>		
</section>