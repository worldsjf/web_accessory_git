<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							
                        <?php
                                        foreach($category as $key => $cate){
                                        ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="<?php echo base_url('danh-muc/' .$cate->id.'/'.$cate->slug) ?>"><?php echo $cate->title ?></a></h4>
								</div>
							</div>

                            <?php
                                        }
                            ?>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
                                <?php
                                        foreach($brand as $key => $bra){
                                        ?>
									<li><a href="<?php echo base_url('thuong-hieu/' .$bra->id.'/'.$bra->slug) ?>"><?php echo $bra->title ?></a></li>
									<?php
                                        }
                                    ?>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<!-- <div class="price-range">
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div> -->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>