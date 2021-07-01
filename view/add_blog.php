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
                  <div class="x_title">
                    <h4>Blog</h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="padding-left: 30px;">
                    <h4><small>Add Blog</small> <span class="pull-right"><small>* Required fields</small></span></h4><br>
                    <form id="blogAdd" enctype="multipart/form-data">
                      <input type="hidden" name="action" class="action" value="20">
                      <input type="hidden" name="id" class="id">
                      <div class="row">
                        <div class="col-md-8">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="col-sm-12 control-label">Title<span class="required">*</span></label>

                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="title" id="title" placeholder="Blog Title">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="col-sm-12 control-label">Author</label>

                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="author" id="author" placeholder="Author">
                                </div>
                              </div>
                            </div>
                            <br><br><br>

                            <div class="col-md-6">
                              <label class="control-label col-md-12 col-sm-3 col-xs-12">Date Created<span class="">*</span></label>
                              <div class="form-group">
                                  <div class='input-group date datepicker_add'>
                                      <input type='date' name="ddate" class="form-control" id="ddate_edit" value="" />
                                      <span class="input-group-addon">
                                         <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="" class="col-sm-12 control-label">Attach file</label>

                                  <div class="col-sm-12">
                                    <input type="file" class="form-control" id="file" name="file">
                                  </div>
                                  <small style="color: maroon;">Dimension: Near 800X549 px</small>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Content*
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <textarea class="form-control" rows="3" id="content_edit" name="content"></textarea>
                                  <script type="text/javascript">
                                    CKEDITOR.replace( 'content_edit' );
                                  </script>
                                </div>
                              </div>

                            </div>


                          </div>

                        </div>

                        <div class="col-md-4">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="col-sm-12 control-label">Blog Category</label>

                                <div class="col-md-12">
                                  <select class="form-control" name="category" id="category_edit">
                                    <option value="">- Select -</option>
                                    <?php
                                      $bloglist->getFromblogcategory();
                                    ?>
                                  </select>
                                </div>

                              </div>
                            </div>
                            <br> <br><br>
                            <div class="col-md-12" style="margin-top: 20px;">
                              <div class="control-group form-group">
                                <label class="control-label col-md-12 col-sm-12 ">Tags</label>
                                <div class="col-md-12 col-sm-12">
                                  <input id="tags_1" type="text" class="tags form-control" name="tags" value="social, adverts, sales" />
                                  <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label">Status</label>
                              <div class="col-md-12">
                                <select class="form-control" name="status" id="status_edit">
                                  <option value="0">Enable</option>
                                  <option value="1">Disable</option>
                                </select>
                              </div>

                            </div>
                            <br> <br>
                          </div>
                        </div>
                      </div>
                      <br><br>
                      <div class="container">
                        <div class="form-group pull-left">
                          <div class="row">
                            <div class="col-md-12">
                              <a href="blog-list" class="btn btn-primary">Back</a>
                              <button type="submit" id="actionBtn" class="btn btn-warning" id="">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>

<?php include 'alerts.html';  ?>

<?php if (isset($_GET['blog'])) { ?>
<script>

function getRow(id){
  $('.action').val('21');
  $('.id').val(id);
  $('#actionBtn').html('Update');
  $.ajax({
    type: 'POST',
    url: '../controller/blog.php',
    data: {
      id:id,
      action: '23'
    },
    dataType: 'json',
    success: function(response){
      $('.id').val(response.tid);
      $('#ddate_edit').val(response.ddate);
      $('#title').val(response.title);
      $('#author').val(response.author);
      $('#category_edit').val(response.category);
      $('#tags_1').val(response.tags);
      $('#content_edit').val(response.content);
      $('#status_edit').val(response.status);

    }
  });
}

var id="<?php echo $_GET['blog']; ?>";
  getRow(id);
</script>
<?php } ?>
<script type="text/javascript">

$(function() {

  $('#blogAdd').submit(function(e){
    e.preventDefault();
    CKEDITOR.instances['content_edit'].updateElement();
    $.ajax({
      type: 'POST',
      url: '../controller/blog.php',
      data: new FormData(this),
      processData: false,
      contentType: false,
      dataType: 'json',
      beforeSend: function(){$(".overlay").show();},
      success: function(response){
        if(response.error){
          $('.showMsgerr span').html(response.message);
          $('.showMsgsuccess').hide();
          $('.showMsgerr').show();
          
        }
        else{
          $('.showMsgsuccess span').html(response.message);
          $('.showMsgerr').hide();
          $('.action').val('21');
          $('.id').val(response.currid);
          $('#actionBtn').html('Update');
          $('.showMsgsuccess').show();
          $(".showMsgsuccess").fadeOut(3000);
        }
        setInterval(function() {$(".overlay").hide(); },500);
      }
    });
  });
    
});

</script>
  <?php include '../includes/footer.php'; ?>