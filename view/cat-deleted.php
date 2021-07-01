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
                  <div class='alert alert-success alert-dismissible showMsgsuccess' style="display: none;">
                        <button type='button' class='close' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                        <span id="successSpan"></span>
                  </div>
                  <div class="x_content">
                      <!-- Buuton goes here -->
                      <a href="blog-category" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-arrow"></i> Back</a>
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Name </th>
                            <th class="column-title">Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $execute->loopCategoryDelete();?>
                        </tbody>
                      </table>
                    </div>
              
            
                  </div>
                </div>
              </div>
            </div>

  <script>
    $('.deletedEntity').click(function () {
        var data = $(this).attr('data-id'); //alert(data);
        $.ajax({
            url: '../controller/blog.php?cat_data='+data,
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
//   $(function(){
//     $('.edit').click(function(e){
//       e.preventDefault();
//       var id = $(this).data('id');
//       getRow(id);
//       $('#edit').modal('show');
//     });

//     $('.delete').click(function(e){
//       e.preventDefault();
//       $('#delete').modal('show');
//       var id = $(this).data('id');
//       getRow(id);
//     });
//   });

//   function getRow(id){
//     $.ajax({
//       type: 'POST',
//       url: '../controller/blog_category.php',
//       data: {
//         id:id,
//         action: '4'
//       },
//       dataType: 'json',
//       success: function(response){
//         $('.id').val(response.entity_guid);
//         $('#name_edit').val(response.name);
//       }
//     });
//   }
</script>
  <?php include '../includes/footer.php'; ?>


