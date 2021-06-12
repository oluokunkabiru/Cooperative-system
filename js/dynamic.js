$(document).ready(function($) {
    $('#userloginbtn').click(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'auth/login.php',
            data: $('#userloginform').serialize(),
            success: function(data) {
                var result = data;
                // $("#loginerror").html(result);
                if (result == "admin") {
                    $(".loginerror").html(
                        '<div class="alert alert-success alert-dismissible">'
                        +'<button type="button" class="close" data-dismiss="alert">&times;</button>'
                        +'<h3><strong>Success!</strong> Login successfully(s)</h3>'
                        +'</div>'
                        
                    );
                    window.location.assign('users/admin/');
                }else if (result == "buyer") {
                    $(".loginerror").html(
                        '<div class="alert alert-success alert-dismissible">'
                        +'<button type="button" class="close" data-dismiss="alert">&times;</button>'
                        +'<h3><strong>Success!</strong> Login successfully(s)</h3>'
                        +'</div>'
                        
                    );
                    window.location.assign('users/buyers/');
                }else if (result == "marketer") {
                    $(".loginerror").html(
                        '<div class="alert alert-success alert-dismissible">'
                        +'<button type="button" class="close" data-dismiss="alert">&times;</button>'
                        +'<h3><strong>Success!</strong> Login successfully(s)</h3>'
                        +'</div>'
                        
                    );
                    window.location.assign('users/marketers/');
                }else{
                    $(".loginerror").html(
                        '<div class="alert alert-danger alert-dismissible">'
                        +'<button type="button" class="close" data-dismiss="alert">&times;</button>'
                        +'<h3><strong>OOPS!</strong> Kindly resolve below error(s)</h3>'
                        +result
                        +'</div>'
                        
                    );
                }
            }
        });
    })
    // end of login


    // register new user
    $('#registerbtn').click(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'auth/signup.php',
            data: $('#registerform').serialize(),
            success: function(data) {
                var result = data;
                var suc = "Registered successfully"
                if(result !=suc){
                $(".registererror").html(
                    '<div class="alert alert-danger alert-dismissible">'
                    +'<button type="button" class="close" data-dismiss="alert">&times;</button>'
                    +'<h3><strong>OOPS!</strong> Kindly resolve below error(s)</h3>'
                    +result
                    +'</div>'
                    
                );
                }else{
                    $(".registererror").html(
                        '<div class="alert alert-success alert-dismissible">'
                        +'<button type="button" class="close" data-dismiss="alert">&times;</button>'
                        +'<h3><strong>OOPS!</strong> Kindly resolve below error(s)</h3>'
                        +result
                        +'</div>'
                        
                    );
                    window.location.assign('users/buyers/');
                }
            }
        })
    })
    // end of register new user



    // update buyer profile
    $('#buyerupdateform').submit(function(e) {
        // alert(xmlh.status);
        e.preventDefault();
        var datas = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'buyerupdateprofile.php',
            data: datas,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var result = data;
                var suc = "Profile update successfully";
                if(result !=suc){
                $(".registererror").html(
                    '<div class="alert alert-danger alert-dismissible">'
                    +'<button type="button" class="close" data-dismiss="alert">&times;</button>'
                    +'<h3><strong>OOPS!</strong> Kindly resolve below error(s)</h3>'
                    +result
                    +'</div>'
                    
                );
                }else{
                    $(".registererror").html(
                        '<div class="alert alert-success alert-dismissible">'
                        +'<button type="button" class="close" data-dismiss="alert">&times;</button>'
                        +'<h3><strong>OOPS!</strong> Kindly resolve below error(s)</h3>'
                        +result
                        +'</div>'
                        
                    );
                    window.location.reload();
                }
            }
        })
    })
    // end of buyer profile update
})