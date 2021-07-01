<?php 
  include '../controller/blog_category.php';
  include '../header.php';
?>

            <!-- /top navigation -->
            <!-- page content -->
          <div class="right_col" role="main">

            <br />
            <div class="">
              <div class="clearfix"></div>

              <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Blog Category</h2>
                    <div class="clearfix"></div>
                  </div>
                  <?php $execute->checkError(); ?>
                  <div class="x_content">
                    <!-- Buuton goes here -->
                    <button type="button" data-toggle="modal" data-target="#addnew" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> New Category</button>
                    <?php $execute->deletedCatButton() ?>
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Name </th>
                            <th class="column-title">Actions </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $execute->loop_blog_category(); ?>
                        </tbody>
                      </table>
                    </div>
              
            
                  </div>
                </div>
              </div>
            </div>

    <?php require "modal/blog_category.php"; ?>

  <script>
  $(function(){
    $('.edit').click(function(e){
      e.preventDefault();
      var id = $(this).data('id');
      getRow(id);
      $('#edit').modal('show');
    });

    $('.delete').click(function(e){
      e.preventDefault();
      $('#delete').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });
  });

  function getRow(id){
    $.ajax({
      type: 'POST',
      url: '../controller/blog_category.php',
      data: {
        id:id,
        action: '4'
      },
      dataType: 'json',
      success: function(response){
        $('.id').val(response.entity_guid);
        $('#name_edit').val(response.name);
      }
    });
  }
</script>
  <?php include '../includes/footer.php'; ?>


