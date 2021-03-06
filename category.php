<?php 
    require_once("includes/session.php");
    confirm_logged_in(); 
    $xID=$_SESSION["teacherlog"]; 
    
    require_once 'models'.DIRECTORY_SEPARATOR.'loader.php';
    $aLoader = new Loader($db);
    
	include("header.php");

    // if(!empty($_GET["refno"])){
    //     $classid = mysqli_real_escape_string($db, $_GET["refno"]);
    //     $_SESSION["t_class_id"] = $classid;
    // }
    // if(!empty($_GET["s"])){
    //     $subid = mysqli_real_escape_string($db, $_GET["s"]);
    //     $_SESSION["t_subject_id"] = $subid;
    // }

    if (isset($_SESSION["user"])) {
        $_SESSION["user"];
    }

    if (isset($_GET['sub_cat'])) {
        $sub_cat = $_GET['sub_cat'];
    }

    if (isset($_GET['sch'])) {
        $school = $_GET['sch'];
    }

    $select_content3= sprintf("select * from schools where sub_category_id = '$school'");
    $content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
    $content3 = mysqli_fetch_assoc($content_result3); //var_dump($content3);exit;
    $num_chk3 = mysqli_num_rows ($content_result3);

    if (isset($_GET['cls'])) {
        $class = $_GET['cls'];
    }

    $select_content4= sprintf("select * from classes where schoolid = '$class'");
    $content_result4= mysqli_query($db, $select_content4) or die(mysqli_error($db));
    $content4 = mysqli_fetch_assoc($content_result4); //var_dump($content3);exit;
    $num_chk4 = mysqli_num_rows ($content_result4);
?>

    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                    <div class="row">
                        <div class="alert alert-info">
                            <a href="index"><b>Home</b></a> >>
                            <strong>
                            <?php if($sub_cat): echo "<a href='category'>Category</a> "; if( $num_chk2 > 1): echo" >> Sub-categorys"; else: echo " >> Sub-category"; endif; elseif($school): echo "<a href='category'>Category</a> >> <a href='category?sub_cat=". $content3['sub_category_id']."'>". $aLoader->getSubCatById($content3['sub_category_id']) ."</a>"; if( $num_chk3 > 1): echo" >> Schools"; else: echo " >> School"; endif; elseif($class): echo "<a href='category'>Category</a> >> <a href='category?sub_cat=". $content4['category_id']."'>". $aLoader->getSubCatById($content4['sub_category_id'])."</a> >> <a href='category?sch=".$content4['sub_category_id']."'>".$aLoader->getSchoolById($content4['schoolid']) ."</a>"; if( $num_chk4 > 1): echo" >> Classess"; else: echo " >> Class"; endif;  else : echo "Category"; endif;?>  </strong> 
                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".cart-example-modal-sm"><i class="fa fa-plus"></i> Category</button>
                        </div>
                        <?php if($sub_cat) : 
                            $select_content2= sprintf("select * from sub_category where category_id = '$sub_cat'");
                            $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                            $content2 = mysqli_fetch_assoc($content_result2);//var_dump($content2);exit;
                            $num_chk2 = mysqli_num_rows ($content_result2);
                            if ($num_chk2 > 0){ do { ?>
                                <div class="col-md-55 justify-content-center mr-4" style="cursor: pointer;">
                                    <a href="category?sch=<?=$content2['id'] ?>" class="" style="color: black;">
                                        <img src="icons/subject.jpg" / class="" style="width: 50px; margin-left:35px"> <br /> <?=ucwords($content2["sub_category"]) ?>
                                    </a>
                                </div>
                            <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); 
                            }else{echo "No sub-category has been added";} 
                        elseif($school) : 
                            if ($num_chk3 > 0){ do { ?>
                                <div class="col-md-55 justify-content-center mr-4" style="cursor: pointer;">
                                    <a href="category?cls=<?=$content3['schoolid'] ?>" class="" style="color: black;">
                                        <img src="icons/subject.jpg" / class="" style="width: 50px; margin-left:35px"> <br /> <?=ucwords($content3["school"]) ?>
                                    </a>
                                </div>
                            <?php } while ($content3 = mysqli_fetch_assoc($content_result3)); 
                            }else{echo "No school has been added";};
                        elseif($class) : 
                            if ($num_chk4 > 0){ do { ?>
                                <div class="col-md-55 justify-content-center mr-4" style="cursor: pointer;">
                                    <a href="contents?refno=<?=$content4['schoolid'] ?>&s=<?=$content4['id'] ?>" class="" style="color: black;">
                                        <img src="icons/subject.jpg" / class="" style="width: 50px; margin-left:35px"> <br /> <?=ucwords($content4["class"]) ?>
                                    </a>
                                </div>
                            <?php } while ($content4 = mysqli_fetch_assoc($content_result4)); 
                            }else{echo "No school has been added";}?>
                        <?php else :
                            $select_content= sprintf("select * from category");
                            $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                            $content = mysqli_fetch_assoc($content_result);
                            $num_chk = mysqli_num_rows ($content_result);
                            if ($num_chk > 0){ do { ?>

                                <div class="col-md-55">
                                    <a href="category?sub_cat=<?=$content['id']?>">
                                        <div class="thumbnail">
                                            <div class="image view view-first" id="subject-content">
                                                <img src="icons/subject.jpg" alt="image" id="myImage" style="width: 80px; align-items:center;">
                                            </div>
                                            <div class="caption subject-topic">
                                                <p>
                                                    <strong><?=ucwords($content["category"]) ?></strong>
                                                    
                                                </p>
                                                <div class="" style="display: flex;">
                                                    <p><a href="#" class="pull-right faEdit btn btn-warning btn-sm" title="Edit <?=$content['category']?>" data-name="<?=$content['category']?>" data-id="<?=$content['id']?>" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i></a>
                                                    </p>
                                                    <p><a href="#" class="faTrash btn btn-danger btn-sm" data-id="<?=$content['id']?>"><i class="fa fa-trash" ></i></a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php } while ($content = mysqli_fetch_assoc($content_result)); 
                            }
                            else{echo "No category has been added";} ?>
                       <?php endif; ?>
                    </div>
                    
                </div>
            </div>
          
        </div>
    </div>

    <!-- Small modal -->
    

    <div class="modal fade cart-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="categoryAdd">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form  id="catform" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">New Category</h4>
                    </div>
                    <div class="modal-body">
                        <h4>Create New Category</h4>
                        <p><input type="text" class="form-control" name="Category" id="catInput"></p>
                        <input type="hidden" name="token" value="<?=$_SESSION["user"];?>" />
                    </div>
                    <div class="modal-footer">
                        <!-- <input type="text" name="formaction" value="create-new" /> -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input  type="submit" class="btn btn-primary" value="  Create Category  " />
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Edit Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="editCategoryForm">
        <div class="modal-body">
        
            <div class="form-group"><input type="text" class="form-control" placeholder="" name="edit_category" title="Edit Category" value="" id="editCategory"></div>
            <div class="form-group"><input type="hidden" class="form-control" name="current_id" id="editCategoryId"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Close">Close</button>
            <button type="submit" class="btn btn-primary" name="save_changes" title="Save Changes">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

    <!-- Large modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">??</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Select an activity or resource</h4>
                </div>
                <div class="modal-body">
                    <div class="bs-glyphicons contentd">
                        <input type="hidden" name="" id="topic_id">
                        <ul class="bs-glyphicons-list ">
                            <li>
                                <a href="#" data-page="page" class="directPage" style="text-decoration:none; color:#000"> 
                                    <img src="../icons/page.png" /> <br />
                                    Page
                                </a>
                            </li>

                            <li>
                                <a href="#" data-page="quiz" class="directPage" style="text-decoration:none; color:#000"> 
                                    <img src="../icons/quiz.png" /> <br />
                                Quiz
                                </a>
                            </li>
                            

                            <li>
                                <a href="#" data-page="document" class="directPage" style="text-decoration:none; color:#000"> 
                                    <img src="../icons/document.png" /> <br />
                                    Document
                                </a>
                            </li>

                            <li>
                                <a href="#" data-page="webex-class" class="directPage" style="text-decoration:none; color:#000"> 
                                    <img src="../icons/webexmeetings.png" /> <br />
                                Live Class (Webex)
                                </a>
                            </li>

                            <li>
                                <a href="#" data-page="zoom-meeting" class="directPage" style="text-decoration:none; color:#000"> 
                                    <img src="../icons/zoom-meeting.png" /> <br />
                                Live Class (Zoom)
                                </a>
                            </li>
                            <li>
                                <a href="#" data-page="google-meet" class="directPage" style="text-decoration:none; color:#000"> 
                                    <img src="../icons/google-meet.png" /> <br />
                                    Live Class (Google Meet)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modals -->

    

    <!-- footer content -->
    <?php include("includes/footer.php")?>
    <script>
        var admin = "<?php echo SITEURL; ?>";
        var pageDetails = {
            "addcat": admin+"/subject_topics/controller.php?pg=add_category",
            "editcat": admin+"/subject_topics/controller.php?pg=edit_category",
            "deletecat": admin+"/subject_topics/controller.php?pg=delete_category",
            "siteUrl":"<?php echo SITEURL;?>",
        };

        $(".active_btn").click(function(){
            $("#topic_id").val($(this).attr("data-id"))
            $(".bs-example-modal-lg").modal()
        })

        $(".directPage").click(function(){
            location.href = $(this).attr("data-page")+ "?action=new&refno="+ $("#topic_id").val();
        })

        //$( document).ready(function() {
            // alert("jjj")
        // input Cat to Modal
            $('.faEdit').click(function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id'); //alert(id);
                var cat = $(this).attr('data-name'); //alert(cat);

                $('#editCategoryId').val(id);
                $('#editCategory').val(cat);
            })

       // })

       $('.faTrash').click(function (e) {
           e.preventDefault();
           var id = $(this).attr('data-id'); //alert(id);
           pageUrl = pageDetails.deletecat+'&deletecat='+id;
        //    var confirm = confirm("Are you sure?");
        //    if (confirm) {
                $.ajax({
                    url: pageUrl,
                    type : "post",
                    dataType: "json",
                    data:id,
                    // cache:false,
                    contentType: false,
                    processData: false,
                    success : function(respond){
                        // alert(respond);
                        if (respond) {
                            // alert(respond);
                            swal({
                                title: "Successful...",
                                text: respond,
                                icon: "success", 
                            });
                            location.reload();
                        }else{
                            swal({
                                title: "Error...",
                                text: "Error encantered",
                                icon: "error", 
                            });
                        }
                    }
                });
                return false;
        //    }
       })
        
        // Edit Modal Ajax
        $('#editCategoryForm').submit(function name(e) {
            e.preventDefault;
            var formData = new FormData(this);
            // alert(formData);
            pageUrl = pageDetails.editcat;
            $.ajax({
                url: pageUrl,
                type : "post",
                dataType: "json",
                data:formData,
                // cache:false,
                contentType: false,
                processData: false,
                success : function(respond){
                    // alert(respond);
                    if (respond) {
                        // alert(respond);
                        $('#exampleModal').modal('hide');
                        swal({
                            title: "Successful...",
                            text: respond.message,
                            icon: "success", 
                        });
                        location.reload();
                    }else{
                        swal({
                            title: "Error...",
                            text: respond.message,
                            icon: "error", 
                        });
                    }
                }
            });
            return false;
        });
    </script>

    