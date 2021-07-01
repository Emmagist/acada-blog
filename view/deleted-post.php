<?php 
  require '../includes/session.php';
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
                    <div class='alert alert-success alert-dismissible showMsgsuccess' style="display: none;">
                      <button type='button' class='close' aria-hidden='true'>&times;</button>
                      <h4><i class='icon fa fa-check'></i> Success!</h4>
                      <span id="successSpan"></span>
                    </div>
                    <div class="row" id="d2">
                      <div class="col-md-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h3>Blog List </h3>
                            <a href="blog-list" class="btn btn-primary">Back</a>
                            <!-- <ul class="text-center " style="display:none; background-color:lightgreen" id="success-message-ul">
                              <li class="text-white p-4" id="success-message" style="list-style: none; color:#fff; padding:5px;"></li>
                            </ul> -->
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
                                    <?php 
                                      $sql = "SELECT * FROM bloglist WHERE deleted='1'";
                                      $result = mysqli_query($db, $sql);
                                      $row = mysqli_num_rows($result);
                                      $fetch = mysqli_fetch_assoc($result);

                                      $cat = $fetch['category'];
                                      $sql2 = "SELECT name FROM blog_category WHERE entity_guid = '$cat'"; //var_dump($sql2);exit;
                                      $result2 = mysqli_query($db, $sql2);
                                      $fetch2 = mysqli_fetch_assoc($result2);
                                      if ($row > 0) {
                                        do {
                                          echo $output =  '<tr>
                                            <td>'.$fetch['title'].'</td>
                                            <td>'.$fetch2['name'].'</td>
                                            <td>'.$fetch['author'].'</td>
                                            <td>'.$fetch['date_created'].'</td>
                                            <td>Deleted</td>
                                            <td><button class="btn btn-success btn-sm data-entity" data-name="'.$fetch['entity_guid'].'">Enable</button></td>
                                          </tr>';
                                        } while ($fetch = mysqli_fetch_assoc($result));
                                      }else {
                                        echo "<p style='color:pink; position:absolute; font-size:20px; font-weight:bold; margin-top:50px'>No Deleted Post!</p>";
                                      }
                                    ?>
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
  $('.data-entity').click(function () {
    var data = $(this).attr('data-name'); //alert(data);

    $.ajax({
      url: '../controller/blog.php?data='+data,
      data: {},
      dataType: 'json',
      type: 'poost',
      success: function (params) {
        $('.showMsgsuccess').fadeIn();
        $('#successSpan').text(params);
        $('.close').click(function () {
          setTimeout(() => {
              $('.showMsgsuccess').fadeOut();
              location.reload();
          }, 500);
        })
        setTimeout(() => {
          $('.showMsgsuccess').fadeOut();
          location.reload();
        }, 2500);
      }
    })
  })

</script>
  <?php include '../includes/footer.php'; ?>


