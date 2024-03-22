<aside class="p-localnav">
	<section class="p-localnav__section -category">
		<h3 class="p-localnav__heading">Category</h3>
		<ul class="p-localnav__category">
			<li>
				<a class="p-localnav__category__inner" href="<?= $root; ?>news/">
					<span class="c-anchor-lineIn">全て</span>
				</a>
			</li>
			<?php
				$args = array(
					'orderby'    => 'name',
					'hide_empty' => 0,
					'pad_counts' => 0,
					'parent'     => 0,
				);
				$parent_terms = get_terms( 'category' , $args );

				foreach ( $parent_terms as $parent_term ) :
					$parent_link = get_term_link($parent_term);
					$parent_id   = $parent_term->term_id;
					$parent_name = $parent_term->name;

					$args_child = array(
						'orderby'    => 'name',
						'hide_empty' => 0,
						'pad_counts' => 0,
						'parent'     => $parent_id,
					);
					$child_terms = get_terms( 'category' , $args_child );
			?>
				<?php if( isset( $child_terms[0] ) ): ?>
				<li class="p-localnav__category__en js-accordion is-open">
					<button class="p-localnav__category__inner js-accordion__button -arrow">
						<span class="c-anchor-lineIn">
							<?= $parent_name; ?>
						</span>
					</button>
					<div class="js-accordion__body">
						<div class="js-accordion__body__inner">
							<ul class="p-localnav__category2">
								<?php
									foreach ( $child_terms as $child_term ) :
										$child_link = get_term_link($child_term);
										$child_id   = $child_term->term_id;
										$child_name = $child_term->name;
								 ?>
								<li>
									<a class="p-localnav__category2__inner" href="<?= $child_link; ?>">
										<span class="c-anchor-lineIn">
											<?= $child_name; ?>
										</span>
									</a>
								</li>
								<?php endforeach; ?>
								<?php wp_reset_postdata(); ?>
							</ul>
						</div>
					</div>
				</li>
				<?php else: ?>
				<li class="p-localnav__category__en">
					<a class="p-localnav__category__inner" href="<?= $parent_link; ?>">
						<span class="c-anchor-lineIn">
							<?= $parent_name; ?>
						</span>
					</a>
				</li>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
	</section>
	<section class="p-localnav__section -archive">
		<h3 class="p-localnav__heading">Archive</h3>
		<ul class="p-localnav__archive">
			<?php
				$year_prev = null;
				$months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,
				YEAR( post_date ) AS year,
				COUNT( id ) as post_count FROM $wpdb->posts
				WHERE post_status = 'publish' and post_date <= now( )
				and post_type = 'post'
				GROUP BY month , year
				ORDER BY post_date DESC");

				$index = 0;

				foreach($months as $month) :
					$year_current = $month->year;

					if ($year_current != $year_prev) :
						if ($year_prev != null):
			?>
						</ul>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php
				if( $index == 4 ){
					$li_class = '-nest';
				} else{
					$li_class = '';
				}
			 ?>
			<li class="p-localnav__archive__item js-accordion <?= $li_class ?>">
				<button class="js-accordion__button" type="button">
					<span class="c-anchor-lineIn">
						<?= $year_current; ?>
					</span>
				</button>
				<div class="js-accordion__body">
					<div class="js-accordion__body__inner">
						<ul class="p-localnav__archive2">
						<?php endif; ?>
							<?php
								$data_m = date('m', mktime(0, 0, 0, $month->month, 1, $month->year));
							 ?>
							<li>
								<a href="<?= home_url() . '/news/date/'. $year_current . '/' . $data_m; ?>">
									<span class="c-anchor-lineIn">
										<?= $year_current; ?> <?= $data_m; ?> 月
									</span>
								</a>
							</li>
							<?php $year_prev = $year_current; ?>
							<?php $index++; ?>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</li>

		</ul>
	</section>
</aside>
