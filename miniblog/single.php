<?php
ini_set('display_errors',0);
include '../controller/Controller.php';
$_GET['blog']=$execute->treat($_GET['blog']);
$blogg=$_GET['blog'];
$execute->getBloginfo($_GET['blog']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Mini Blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="A.fonts%2c%2c_icomoon%2c%2c_style.css%2bcss%2c%2c_bootstrap.min.css%2bcss%2c%2c_magnific-popup.css%2bcss%2c%2c_jquery-ui.css%2bcss%2c%2c_owl.carousel.min.css%2bcss%2c%2c_owl.theme.default.min.css%2bcss%2c%2c_bootstrap-date" />
</head>
<body>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0" nonce="UWCyzfAu"></script>
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

  <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image:url(<?php echo $execute->image; ?>)">
    <div class="container">
      <div class="row same-height justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="post-entry text-center">
            <span class="post-category text-white bg-success mb-3"><?php echo $execute->category; ?>;</span>
            <h1 class="mb-4"><a href="#"><?php echo $execute->title; ?>.</a></h1>
            <div class="post-meta align-items-center text-center">
              <figure class="author-figure mb-0 mr-3 d-inline-block"><img src="images/xperson_1.jpg.pagespeed.ic.yYek0ClmEN.jpg" alt="Image" class="img-fluid"></figure>
              <span class="d-inline-block mt-1">By <?php echo $execute->author; ?></span>
              <span>&nbsp;-&nbsp; <?php echo date('M d, Y', strtotime($execute->ddate)); ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <section class="site-section py-lg">
      <div class="container">
        <div class="row blog-entries element-animate">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="post-content-body">
              <div class="row mb-5">
                <div class="col-md-10 col-lg-10 col-sm-6"><?php echo htmlspecialchars_decode($execute->content); ?></div>
              </div>
              <div class="row">
                
                <!-- <div class="col-md-4">ffjfjfjfjffjfjfjf</div> -->
              </div>
            </div>

            <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small">
              <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a>
            </div>

            <div class="pt-5">
              <h3 class="mb-5"><?php echo $execute->getCommentNum($_GET['blog']); ?> Comments</h3>
              <ul class="comment-list">

                <?php $execute->loop_Comments($_GET['blog']); ?>

              </ul>

              <div class="comment-form-wrap pt-5" id="comment-div">
                <h3 class="mb-5">Leave a comment</h3>

                <form id="post_comment" class="p-5 bg-light">
                  <input type="hidden" name="action" value="200">
                  <input type="hidden" name="blog" value="<?php echo $_GET['blog']; ?>">
                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" id="name" name="name" required="">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" required="">
                  </div>

                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control" required=""></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary nlbtn">
                    <input type="submit" value="Post Comment ..." class="btn btn-primary lbtn" disabled="" style="display: none;">
                  </div>
                </form>

              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-4 sidebar">
            <div class="sidebar-box search-form-wrap">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>

            <div class="sidebar-box">
            <h3 class="heading">Related Posts</h3>
            <div class="post-entry-sidebar">
              <ul>

                <?php $execute->loop_relatedPosts($_GET['blog']); ?>

              </ul>
            </div>
          </div>


          <div class="sidebar-box">
            <h3 class="heading">Tags</h3>
            <ul class="tags">
              <?php 
                $alltags=explode(',', $execute->tags);
                foreach ($alltags as $tag) {
                  echo '<li><a href="#">'.$tag.'</a></li>';
                }
              ?>
            </ul>
          </div>

        </div>

      </div>
      </div>
    </section>


    <?php require "inc/footer.php"; ?>
  </div>
  </div>
  </div>


  <div id="reply" tabindex="-1" role="dialog" class="modal bg-light">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="exampleModalLabel" class="modal-title">Reply</h4>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <form id="post_reply">
          <div class="modal-body">
            <input type="hidden" name="action" value="201">
            <input type="hidden" class="idd" name="comment">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" id="password" name="email" required>
            </div>
            <div class="form-group">
              <label>Message</label>
              <textarea class="form-control" rows="3" name="message" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-reply"></i> Reply</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js%2bjquery-ui.js%2bpopper.min.js.pagespeed.jc.JdvTOhp_a4.js"></script><script>eval(mod_pagespeed_3UHT1mdFHo);</script>
  <script>eval(mod_pagespeed_eVrI9UNvs7);</script>
  <script>eval(mod_pagespeed_ibR0WM8rmG);</script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js%2bjquery.stellar.min.js%2bjquery.countdown.min.js%2bjquery.magnific-popup.min.js.pagespeed.jc.3S4ZYYlTLk.js"></script><script>eval(mod_pagespeed_hp4TRGNFGr);</script>
  <script>eval(mod_pagespeed_xafn9tfifR);</script>
  <script>eval(mod_pagespeed_r3CDYPgZa6);</script>
  <script>eval(mod_pagespeed__yexyprBvh);</script>
  <script src="js/bootstrap-datepicker.min.js%2baos.js%2bmain.js.pagespeed.jc.z6gPHoOd2B.js"></script><script>eval(mod_pagespeed__EwcE7_1mp);</script>
  <script>eval(mod_pagespeed_XfTLd8v2o_);</script>
  <script>eval(mod_pagespeed_t_McWJOk6o);</script>

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
  </script>
  <script defer src="../../../static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"65dc79787bf0c4fc","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.5.2","si":10}'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/subscribe.js"></script>
  <!--==== Sweet Alert ====-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
  $(function() {

    $('#post_comment').submit(function(e){
      e.preventDefault();
      // var user = $(this).serialize();
      $.ajax({
        type: 'POST',
        url: '../controller/Controller.php',
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType:'json',
        beforeSend: function(){$(".lbtn").show(); $(".nlbtn").hide();},
        success: function(response){
          if(response.error){
            swal({
              title: "Error!",
              text: response.message,
              icon: "error",
            });

          }else{
            swal({
              title: "Successful!",
              text: response.message,
              icon: "success",
              buttons: false,
              timer: 3000,
            });
            window.location='single.php?blog=<?php echo $blogg; ?>';
          }
          setInterval(function() {$(".nlbtn").show(); $(".lbtn").hide(); },1500);
          
        }
      });
    });


  });

  function repli(id){
    $('#comment-div').hide();
    $('.okeke').hide();
    var aid=$('#'+id).attr('id');
    //alert(id);
    var cont=`
    <div class="comment-form-wrap pt-5 okeke">
    <h3 class="mb-5">Reply</h3>

    <form id="post_reply" class="p-5 bg-light">
    <input type="hidden" name="action" value="201">
    <input type="hidden" name="comment" class="idd">
    <div class="form-group">
    <label for="name">Name *</label>
    <input type="text" class="form-control" name="name" required="">
    </div>
    <div class="form-group">
    <label for="email">Email *</label>
    <input type="email" class="form-control" name="email" required="">
    </div>

    <div class="form-group">
    <label for="message">Message</label>
    <textarea name="message" cols="30" rows="10" class="form-control" required=""></textarea>
    </div>
    <div class="form-group">
    <input type="submit" value="Reply" class="btn btn-primary">
    </div>
    </form>

    </div>`;
    $('#'+id).parent().append(cont);
    $('.idd').val(id);


    $('#post_reply').submit(function(e){
      e.preventDefault();
      // var user = $(this).serialize();
      $.ajax({
        type: 'POST',
        url: '../controller/Controller.php',
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType:'json',
        //beforeSend: function(){$(".lbtn").show(); $(".nlbtn").hide();},
        success: function(response){
          if(response.error){
            swal({
              title: "Error!",
              text: response.error,
              icon: "error",
            });

          }else{
            swal({
              title: "Successful!",
              text: response.message,
              icon: "success",
              buttons: false,
              timer: 3000,
            });
            window.location='single.php?blog=<?php echo $blogg; ?>';
            $('#comment-div').show();
          }
          //setInterval(function() {$(".nlbtn").show(); $(".lbtn").hide(); },1500);
        }
      });
    });
  }
  </script>
</body>

</html>