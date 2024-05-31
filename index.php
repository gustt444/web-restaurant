

<?php

    include "connect.php";
    include 'Includes/functions/functions.php';
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";




    $stmt_web_settings = $con->prepare("SELECT * FROM website_settings");
    $stmt_web_settings->execute();
    $web_settings = $stmt_web_settings->fetchAll();

    $restaurant_name = "";
    $restaurant_email = "";
    $restaurant_address = "";
    $restaurant_phonenumber = "";

    foreach ($web_settings as $option)
    {
        if($option['option_name'] == 'restaurant_name')
        {
            $restaurant_name = $option['option_value'];
        }

        elseif($option['option_name'] == 'restaurant_email')
        {
            $restaurant_email = $option['option_value'];
        }

        elseif($option['option_name'] == 'restaurant_phonenumber')
        {
            $restaurant_phonenumber = $option['option_value'];
        }
        elseif($option['option_name'] == 'restaurant_address')
        {
            $restaurant_address = $option['option_value'];
        }
    }

?>


	<section class="home-section" id="home">
		<div class="container">
			<div class="row" style="flex-wrap: nowrap;">
				<div class="col-md-6 home-left-section">
					<div style="padding: 100px 0px; color: white;">
						<h1>
							EMIRADOS
						</h1>
						<h2>
							COMIDA ÀRABE DE QUALIDADE
						</h2>
						<hr>
						<div style="display: flex;">
							<a href="order_food.php" target="_blank" class="bttn_style_1" style="margin-right: 10px; display: flex;justify-content: center;align-items: center;">
								Fazer Pedido
								<i class="fas fa-angle-right"></i>
							</a>
							<a href="#menus" class="bttn_style_2" style="display: flex;justify-content: center;align-items: center;">
								Cardápio
								<i class="fas fa-angle-right"></i>
							</a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>

	<section class="our_qualities" style="padding:100px 0px;">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/images/quality_food_img.png" >
	                    <div class="caption">
	                        <h3>
	                            Comida de qualidade
	                        </h3>
	                        <p>
	                        ingredientes selecionados 										
	                        </p>
	                    </div>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/images/fast_delivery_img.png" >
	                    <div class="caption">
	                        <h3>
	                            Delivery 
	                        </h3>
	                        <p>
	                        	rapidez e comodidade 
	                        </p>
	                    </div>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/images/original_taste_img.png" >
	                    <div class="caption">
	                        <h3>
	                            Culinária árabe
	                        </h3>
	                        <p>
	                         a especialidade da casa
	                        </p>
	                    </div>
	                </div>
				</div>

			</div>
		</div>
	</section>

	<section class="our_menus" id="menus">
		<div class="container">
			<h2 style="text-align: center;margin-bottom: 30px">CARDÀPIO</h2>
			<div class="menus_tabs">
				<div class="menus_tabs_picker">
					<ul style="text-align: center;margin-bottom: 70px">
			<p> Comida Tradicional</p>
					</ul>
				</div>

				<div class="menus_tab">
					<?php
                
                        $stmt = $con->prepare("Select * from menu_categories");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        $count = $stmt->rowCount();

                        $i = 0;

                        foreach($rows as $row) 
                        {

                            if($i == 0)
                            {

                                echo '<div class="menu_item  tab_category_content" id="'.str_replace(' ', '', $row['category_name']).'" style=display:block>';

                                    $stmt_menus = $con->prepare("Select * from menus where category_id = ?");
                                    $stmt_menus->execute(array($row['category_id']));
                                    $rows_menus = $stmt_menus->fetchAll();

                                    if($stmt_menus->rowCount() == 0)
                                    {
                                        echo "<div style='margin:auto'>No Available Menus for this category!</div>";
                                    }

                                    echo "<div class='row'>";
	                                    foreach($rows_menus as $menu)
	                                    {
	                                        ?>

	                                            <div class="col-md-6 col-lg-4 menu-column">
	                                                <div class="thumbnail" style="cursor:pointer">
	                                                    <?php $source = "admin/Uploads/images/".$menu['menu_image']; ?>

	                                                    <div class="menu-image">
													        <div class="image-preview">
													            <div style="background-image: url('<?php echo $source; ?>');"></div>
													        </div>
													    </div>
														                                                    
	                                                    <div class="caption">
	                                                        <h5>
	                                                            <?php echo $menu['menu_name'];?>
	                                                        </h5>
	                                                        <p>
	                                                            <?php echo $menu['menu_description']; ?>
	                                                        </p>
	                                                        <span class="menu_price">
	                                                        	<?php echo "$".$menu['menu_price']; ?>
	                                                        </span>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                        <?php
	                                    }
	                                echo "</div>";

                                echo '</div>';

                            }

                            else
                            {

                                echo '<div class="menus_categories  tab_category_content" id="'.str_replace(' ', '', $row['category_name']).'">';

                                    $stmt_menus = $con->prepare("Select * from menus where category_id = ?");
                                    $stmt_menus->execute(array($row['category_id']));
                                    $rows_menus = $stmt_menus->fetchAll();

                                    if($stmt_menus->rowCount() == 0)
                                    {
                                        echo "<div class = 'no_menus_div'>No Available Menus for this category!</div>";
                                    }

                                    echo "<div class='row'>";
	                                    foreach($rows_menus as $menu)
	                                    {
	                                        ?>

	                                            <div class="col-md-4 col-lg-3 menu-column">
	                                                <div class="thumbnail" style="cursor:pointer">
	                                                	<?php $source = "admin/Uploads/images/".$menu['menu_image']; ?>
	                                                    <div class="menu-image">
													        <div class="image-preview">
													            <div style="background-image: url('<?php echo $source; ?>');"></div>
													        </div>
													    </div>
	                                                    <div class="caption">
	                                                        <h5>
	                                                            <?php echo $menu['menu_name'];?>
	                                                        </h5>
	                                                        <p>
	                                                            <?php echo $menu['menu_description']; ?>
	                                                        </p>
	                                                        <span class="menu_price">
	                                                        	<?php echo "$".$menu['menu_price']; ?>
	                                                        </span>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                        <?php
	                                    }
	                               	echo "</div>";

                                echo '</div>';

                            }

                            $i++;
                            
                        }
                    
                        echo "</div>";
                
                    ?>
				</div>
			</div>
		</div>
	</section>



	<section class="image-gallery" id="gallery">
		<div class="container">
			<h2 style="text-align: center;margin-bottom: 30px">IMAGENS</h2>
			<?php
				$stmt_image_gallery = $con->prepare("Select * from image_gallery");
                $stmt_image_gallery->execute();
                $rows_image_gallery = $stmt_image_gallery->fetchAll();

                echo "<div class = 'row'>";

	                foreach($rows_image_gallery as $row_image_gallery)
	                {
	                	echo "<div class = 'col-md-4 col-lg-3' style = 'padding: 15px;'>";
	                		$source = "admin/Uploads/images/".$row_image_gallery['image'];
	                		?>

	                		<div style = "background-image: url('<?php echo $source; ?>') !important;background-repeat: no-repeat;background-position: 50% 50%;background-size: cover;background-clip: border-box;box-sizing: border-box;overflow: hidden;height: 230px;">
	                		</div>

	                		<?php
	                	echo "</div>";
	                }

	            echo "</div>";
			?>
		</div>
	</section>

	