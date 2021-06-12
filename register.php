<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" > -->
    <?php include('style.php') ?>

    <style >
        /* #show{
            text-decoration:none;
        }
        #cont{  background-color:black;
            background-repeat: no-repeat;
            background-size: 2000px; ;
        } */
    </style>
    <title>Registration</title>
</head>
<body >
    <div id="cont" class='thumbnail img-responsive'>
    <?php include('header.php') ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php 
                            session_start();
                            if(isset($_SESSION['errs'])):?>
                                <div class="row">
                                    <div class="alert alert-danger">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       <?php
                                       foreach ($_SESSION['errs'] as $key) :
                                        echo '<h6>'.$key.'</h6>';
                                    endforeach;?>
                                </div>
                            </div> 
                            <?php
                            session_destroy();
                        endif;

                        ?>
                        <form action="registerp.php" method="post">
                            <div class="form-group form-group-sm">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="bvn" name="bvn" placeholder="Enter yr bvn">
                            </div>
                            <div class="form-group"><div  class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">

                                <a href="#" id="show"
                                class="input-group-addon">show</a>
                            </div>
                        </div>
                        <div class="form-group">

                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Renter password">

                        </div>
                        <div class="form-group">
                            <div  class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">

                            </div></div>
                            <div class="form-group">
                                <div  class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-earphone"></span></span>
                                        <input type="number" class="form-control" id="number" placeholder="07053451715" name="phoneno">
                                    </div>
                                </div>
                                <h3 class="text-center"
                                >Guarantor info</h3>
                                <div class="form-group form-group-sm">
                                    <input type="text" class="form-control" id="NameofG" name="NameofG" placeholder="Enter fullname">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="BvnofG" name="BvnofG" placeholder="Enter bvn">
                                </div>
                                <div class="form-group">
                                    <div  class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" class="form-control" id="EmailofG" placeholder="Enter email" name="EmailofG">

                                    </div></div>
                                    <div class="form-group">
                                        <div  class="input-group">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-earphone"></span></span>
                                                <input type="number" class="form-control" id="PhonenoOfG" placeholder="07004851714" name="PhonenoOfG">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" class="btn btn-primary"style="width:100%" value="Register" name="submit" >
                                        </div>

                                    </form>
                                </div>
                                <div class="col-sm-4">

                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                <br><br><br>
                <?php
   include('footer.php');
    include('script.php');
     ?>
         </body>
         </html>
         <!-- <script src="js/registration.js"> -->
         </script>