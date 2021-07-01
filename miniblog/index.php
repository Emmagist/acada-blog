<?php
include '../controller/Controller.php';
ini_set('display_errors',0);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Mini Blog</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="fonts%2c_icomoon%2c_style.css%2bcss%2c_bootstrap.min.css%2bcss%2c_magnific-popup.css%2bcss%2c_jquery-ui.css%2bcss%2c_owl.carousel.min.css%2bcss%2c_owl.theme.default.min.css%2bcss%2c_bootstrap-datepicker.css" />
    </head>

    <body>
        <div class="site-wrap">
            <div class="site-mobile-menu">
                <div class="site-mobile-menu-header">
                    <div class="site-mobile-menu-close mt-3">
                        <span class="icon-close2 js-menu-toggle"></span>
                    </div>
                </div>
                <div class="site-mobile-menu-body"></div>
            </div>
            <?php require "inc/header.php"; ?>

            <div class="site-section">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-12">
                            <h2> News</h2>
                        </div>
                    </div>
                    <div class="row oga"></div>
                    <div class="row text-center pt-5 border-top">
                        <div class="col-md-12">
                            <div class="custom-pagination paggroups"></div>
                        </div>
                    </div>
                </div>
            </div>


            <?php require "inc/footer.php"; ?>
        </div>

        <!-- subscribe Modal -->
        <!-- <div class="modal fade" id="subscribe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="editSchoolForm">
                    <div class="modal-body">
                    
                        <div class="form-group"><input type="text" class="form-control" placeholder="Edit Category" name="edit_school" title="Edit Category" id="editCategory"></div>
                        <div class="form-group"><input type="hidden" class="form-control" name="current_id" id="editCategoryId"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Close">Close</button>
                        <button type="submit" class="btn btn-primary" name="save_changes" title="Save Changes">Save changes</button>
                    </div>
                </form>
                </div>
            </div>
        </div> -->
        <!-- <div class="modal " id="subscribe">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><b>Subscribe Us</b></h4>
                    </div>
                    <div class="modal-body">
                    <form class="form-horizontal" method="POST">
                        <input type="hidden" name="action" value="1">
                        <div class="form-group">
                            <label for="name" class="col-sm-12 text-white">Email</label>

                            <div class="col-sm-12 form-group">
                            <input type="email" class="form-control" id="name" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Subscribe</button>
                    </form>
                    </div>
                </div>
            </div>
        </div> -->
<!-- Subcsribe Modal End -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/jquery-migrate-3.0.1.min.js%2bjquery-ui.js%2bpopper.min.js.pagespeed.jc.JdvTOhp_a4.js"></script>
        <script>
            eval(mod_pagespeed_3UHT1mdFHo);
        </script>
        <script>
            eval(mod_pagespeed_eVrI9UNvs7);
        </script>
        <script>
            eval(mod_pagespeed_ibR0WM8rmG);
        </script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js%2bjquery.stellar.min.js%2bjquery.countdown.min.js%2bjquery.magnific-popup.min.js.pagespeed.jc.3S4ZYYlTLk.js"></script>
        <script>
            eval(mod_pagespeed_hp4TRGNFGr);
        </script>
        <script>
            eval(mod_pagespeed_xafn9tfifR);
        </script>
        <script>
            eval(mod_pagespeed_r3CDYPgZa6);
        </script>
        <script>
            eval(mod_pagespeed__yexyprBvh);
        </script>
        <script src="js/bootstrap-datepicker.min.js%2baos.js%2bmain.js.pagespeed.jc.z6gPHoOd2B.js"></script>
        <script>
            eval(mod_pagespeed__EwcE7_1mp);
        </script>
        <script>
            eval(mod_pagespeed_XfTLd8v2o_);
        </script>
        <script>
            eval(mod_pagespeed_t_McWJOk6o);
        </script>

        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
        <script src="js/subscribe.js"></script>
        <!--==== Sweet Alert ====-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-23581568-13');
        </script>
        <script>
            $(function() {
                reloadBlogs();

                var $page;
                $(document).on('click', '.paginationn', function() {
                    $page = $(this).attr('id');
                    $pif = '.comp' + $page;
                    reloadBlogs($page);
                    $($pif).addClass('active');
                });

            });

            function reloadBlogs(page) {
                $.ajax({
                    type: 'POST',
                    url: '../controller/Controller.php',
                    data: {
                        page: page,
                        action: '25'
                    },
                    dataType: 'json',
                    //beforeSend: function(){$(".overlay").show();},
                    success: function(response) {
                        $('.oga').html(response.bloglist);
                        $('.paggroups').html(response.result);
                        setInterval(function() {
                            $(".overlay").hide();
                        }, 500);
                    }
                });
            }
        </script>
        <script defer src="../../../static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"65dc79607f07c4fc","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.5.2","si":10}'></script>
    </body>

</html>