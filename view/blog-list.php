<?php 
  include '../controller/blog.php';
  include '../header.php'; 
?>

            <!-- /top navigation -->
            <!-- page content -->
          <div class="right_col" role="main">
            <br />
            <div class="">
              <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <div class="row" id="d2">
                      <div class="col-md-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h3>Blog List </h3>
                            <a href="add_blog" class="btn btn-round btn-primary">Add New</a>
                            <?php
                              $sql = "SELECT * FROM bloglist WHERE deleted = 1";
                              $result = mysqli_query($db, $sql);
                              $rows = mysqli_num_rows($result);
                              if ($rows == 1) :
                            ?>
                            <a href="deleted-post" class="btn btn-round btn-danger">Deleted Post</a>
                            <?php elseif ($rows > 1) : ?>
                              <a href="deleted-post" class="btn btn-round btn-danger">Deleted Posts</a>
                            <?php elseif ($rows < 1) : ''; endif; ?>
                            <div class="pull-right">
                              <div class="btn-toolbar">
                                <div class="btn-group paggroups">

                                </div>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <div class="table-responsive">
                              <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                  <tr class="headings">
                                    <th class="column-title text-center">Title</th>
                                    <th class="column-title text-center">Category</th>
                                    <th class="column-title text-center">Author</th>
                                    <th class="column-title text-center">Date Created</th>
                                    <th class="column-title text-center">Status</th>
                                    <th class="column-title text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody id="bloglist">

                                </tbody>
                              </table>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
<?php include 'modal/bloglist.php'; ?>
<script type="text/javascript">
$(function() {
  reloadGoal();

  var $page;
  $(document).on('click', '.paginationn', function(){
    $page = $(this).attr('id');
    $pif='.comp'+$page;
    reloadGoal($page);
    $($pif).addClass('active');
  });

  $('#delT').submit(function(e){
    e.preventDefault();
    var newT = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: '../controller/blog.php',
      data: newT,
      dataType: 'json',
      beforeSend: function(){$(".overlay").show();},
      success: function(response){
        if(response.error){
          $('.showMsgerr span').html(response.message);
          $('.showMsgsuccess').hide();
          $('.showMsgerr').show();
          
        }
        else{
          $('#delete').modal('hide');
          $('.showMsgsuccess span').html(response.message);
          reloadGoal($page);
          $('.showMsgerr').hide();
          $('.showMsgsuccess').show();
          $(".showMsgsuccess").fadeOut(3000);
        }
        setInterval(function() {$(".overlay").hide(); },500);
        location.reload();
      }
    });
  });

});

function reloadGoal(page){
  $.ajax({
    type: 'POST',
    url: '../controller/blog.php',
    data: {
      page: page,
      action: '25'
    },
    dataType: 'json',
    beforeSend: function(){$(".overlay").show();},
    success: function(response){
      $('#bloglist').html(response.bloglist);
      $('.paggroups').html(response.result);
      setInterval(function() {$(".overlay").hide();},500);
    }
  });  
}


function delet(id){
  //alert(id);
  $('.id').val(id);
  $('#delete').modal('show');
}
</script>
  <?php include '../includes/footer.php'; ?>


