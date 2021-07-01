<?php
include '../controller/Controller.php';
$searchstring=$_POST['search-string'];
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
            <header class="site-navbar" role="banner">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 search-form-wrap js-search-form">
                            <form action="#">
                                <input type="text" id="s" class="form-control" placeholder="Search...">
                                <button class="search-btn" type="submit"><span class="icon-search"></span></button>
                            </form>
                        </div>
                        <div class="col-4 site-logo">
                            <a href="index.php" class="text-black h2 mb-0">Mini Blog</a>
                        </div>
                        <div class="col-8 text-right">
                            <nav class="site-navigation" role="navigation">
                                <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0">
                                    <!-- <li><a href="category.php">Home</a></li> -->
                                    <li class="d-none d-lg-inline-block"><a href="search.php" class="js-search-toggle"><span class="icon-search"></span></a></li>
                                </ul>
                            </nav>
                            <a href="#" class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"><span class="icon-menu h3"></span></a></div>
                    </div>
                </div>
            </header>

            <div class="site-section">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-12">
                            <h2> Posts</h2>
                        </div>
                    </div>
                    <div class="row oga">

                        <div class="col-lg-4 mb-4">
                            <div class="entry2">
                                <a href="single.html"><img src="images/img_1.jpg" alt="Image" class="img-fluid rounded"></a>
                                <div class="excerpt">
                                    <span class="post-category text-white bg-secondary mb-3">Politics</span>
                                    <h2><a href="single.html">The AI magically removes moving objects from videos.</a></h2>
                                    <div class="post-meta align-items-center text-left clearfix">
                                        <figure class="author-figure mb-0 mr-3 float-left"><img src="images/person_1.jpg" alt="Image" class="img-fluid"></figure>
                                        <span class="d-inline-block mt-1">By <a href="#">Carrol Atkinson</a></span>
                                        <span>&nbsp;-&nbsp; July 19, 2019</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo sunt tempora dolor laudantium sed optio, explicabo ad deleniti impedit facilis fugit recusandae! Illo, aliquid, dicta beatae quia porro id est.</p>
                                    <p><a href="#">Read More</a></p>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row text-center pt-5 border-top">
                        <div class="col-md-12">
                            <div class="custom-pagination paggroups">
                                <span>1</span>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="site-footer">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-4">
                            <h3 class="footer-heading mb-4">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat reprehenderit magnam deleniti quasi saepe, consequatur atque sequi delectus dolore veritatis obcaecati quae, repellat eveniet omnis, voluptatem in. Soluta, eligendi,
                                architecto.</p>
                        </div>
                        <div class="col-md-3 ml-auto">

                            <ul class="list-unstyled float-left mr-5">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Advertise</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Subscribes</a></li>
                            </ul>
                            <ul class="list-unstyled float-left">
                                <li><a href="#">Travel</a></li>
                                <li><a href="#">Lifestyle</a></li>
                                <li><a href="#">Sports</a></li>
                                <li><a href="#">Nature</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <h3 class="footer-heading mb-4">Connect With Us</h3>
                                <p>
                                    <a href="#"><span class="icon-facebook pt-2 pr-2 pb-2 pl-0"></span></a>
                                    <a href="#"><span class="icon-twitter p-2"></span></a>
                                    <a href="#"><span class="icon-instagram p-2"></span></a>
                                    <a href="#"><span class="icon-rss p-2"></span></a>
                                    <a href="#"><span class="icon-envelope p-2"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <p>

                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            	var searchstring=`<?php echo $searchstring; ?>`;
                $.ajax({
                    type: 'POST',
                    url: '../controller/Controller.php',
                    data: {
                        page: page,
                        searchstring: searchstring,
                        action: '257'
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