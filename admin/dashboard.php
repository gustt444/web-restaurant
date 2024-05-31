<?php
	

    session_start();

 
    $pageTitle = 'Painel';
    include 'connect.php';
    include 'Includes/functions/functions.php'; 
    include 'Includes/templates/header.php';


    if(isset($_SESSION['username_restaurant_qRewacvAqzA']) && isset($_SESSION['password_restaurant_qRewacvAqzA']))
    {
    	include 'Includes/templates/navbar.php';

    	?>

            <script type="text/javascript">

                var vertical_menu = document.getElementById("vertical-menu");


                var current = vertical_menu.getElementsByClassName("active_link");

                if(current.length > 0)
                {
                    current[0].classList.remove("active_link");   
                }
                
                vertical_menu.getElementsByClassName('dashboard_link')[0].className += " active_link";

            </script>


            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="panel panel-green ">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-3">
                                    <i class="fa fa-users fa-4x"></i>
                                </div>
                                <div class="col-sm-9 text-right">
                                    <div class="huge"><span><?php echo countItems("client_id","clients")?></span></div>
                                    <div>Total de clientes</div>
                                </div>
                            </div>
                        </div>
                        <a href="clients.php">
                            <div class="panel-footer">
                                <span class="pull-left">ver detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-3">
                                    <i class="fas fa-utensils fa-4x"></i>
                                </div>
                                <div class="col-sm-9 text-right">
                                    <div class="huge"><span><?php echo countItems("menu_id","menus")?></span></div>
                                    <div>total de cardápios</div>
                                </div>
                            </div>
                        </div>
                        <a href="menus.php">
                            <div class="panel-footer">
                                <span class="pull-left">ver detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class=" col-sm-6 col-lg-3">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-3">
                                    <i class="far fa-calendar-alt fa-4x"></i>
                                </div>
                                <div class="col-sm-9 text-right">
                                    <div class="huge"><span>32</span></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">ver detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class=" col-sm-6 col-lg-3">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-3">
                                    <i class="fas fa-pizza-slice fa-4x"></i>
                                </div>
                                <div class="col-sm-9 text-right">
                                    <div class="huge"><span><?php echo countItems("order_id","placed_orders")?></span></div>
                                    <div>pedidos</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">ver detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>



        <?php

    	include 'Includes/templates/footer.php';

    }
    else
    {
    	header("Location: index.php");
    	exit();
    }

?>

<!-- JS SCRIPTS -->

<script type="text/javascript">
    
    // WHEN DELIVER ORDER BUTTON IS CLICKED

    $('.deliver_order_button').click(function()
    {

        var order_id = $(this).data('id');
        var do_ = 'Deliver_Order';

        $.ajax({
            url: "ajax_files/dashboard_ajax.php",
            type: "POST",
            data:{do_:do_,order_id:order_id,},
            success: function (data) 
            {
                $('#deliver_order'+order_id).modal('hide');
                swal("Order Delivered","The order has been marked as delivered", "success").then((value) => 
                {
                    window.location.replace("dashboard.php");
                });
                
            },
            error: function(xhr, status, error) 
            {
                alert('AN ERROR HAS BEEN OCCURRED WHILE TRYING TO PROCESS YOUR REQUEST!');
            }
          });
    });

    // WHEN CANCEL ORDER BUTTON IS CLICKED

    $('.cancel_order_button').click(function()
    {

        var order_id = $(this).data('id');
        var cancellation_reason_order = $('#cancellation_reason_order_'+order_id).val();

        var do_ = 'Cancel_Order';


        $.ajax(
        {
            url: "ajax_files/dashboard_ajax.php",
            type: "POST",
            data:{order_id:order_id, cancellation_reason_order:cancellation_reason_order, do_:do_},
            success: function (data) 
            {
                $('#cancel_order'+order_id).modal('hide');
                swal("Order Canceled","The order has been canceled successfully", "success").then((value) => 
                {
                    window.location.replace("dashboard.php");
                });
            },
            error: function(xhr, status, error) 
            {
                alert('AN ERROR HAS BEEN OCCURRED WHILE TRYING TO PROCESS YOUR REQUEST!');
            }
        });
    });

</script>