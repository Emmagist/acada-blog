// $(document).ready(function () {
    // $('#subscribeMainButton').click(function () {
    //     $('#mediaHandle').removeClass('col-md-6');
    //     $('#mediaHandle').addClass('col-md-2');
    //     $('#subscribeDiv').fadeIn();
    // })
// })
        
$('#subscribeForm').submit(function (e) {
    e.preventDefault();
    // var url = '../controller/blog.php?formdata=400';
    var data = new FormData(this); //alert(data)
    // var data = $('#emailId').val(); //alert(r);
    // e.preventDefault();
    alert(data)
    $.ajax({
        url: '../controller/blog.php?formdata=400',
        method: 'post',
        dataType: 'json',
        data: data,
        beforeSend: function () {
            $('#subTargetButton').text('Subscribing...');
        },
        success: function (params) {
            alert("sub...");
            if(params){
                alert("sub...");
                $('#subTargetButton').text('Subscribed...');
                swal({
                    title: "Good job!",
                    text: params,
                    icon: "success",
                });
                // $('#subscribeDiv').fadeOut();
                setTimeout(() => {
                    $('#subscribeDiv').fadeOut();
                    // location.reload();
                }, 1000);
            }else{
                swal({
                    title: "Error!",
                    text: "Error sending!",
                    icon: "error",
                });

                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        }
    })
    return false;
})
