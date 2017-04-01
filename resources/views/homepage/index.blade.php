<!DOCTYPE html>
<html class="no-js">
<H1>COMING SOON!</H1>
<?php exit; ?>
<head>
    <link rel="shortcut icon" href="images/fvico.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>App plus</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- Fonts -->




    <!-- CSS -->
    <link rel="stylesheet" href="{{URL::asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{URL::asset("css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{URL::asset("css/main.css")}}">
    <link rel="stylesheet" href="{{URL::asset("css/animate.css")}}">
    <link rel="stylesheet" href="{{URL::asset("css/responsive.css")}}">


    <!-- Js -->
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
    <script>
        new WOW(
        ).init();
    </script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-57708809-1', 'auto');
        ga('send', 'pageview');

    </script>

</head>
<body>


<header>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-5 col-sm-3">
                <a href="#" class="logo">
                    <img src="{{URL::asset("assets/img/LOGO.png")}}" alt="">
                </a>
            </div>

            <div class="col-md-3 col-xs-12 -md-offset-0 col-sm-3">
                <ul class="social-info">

                    <a href="https://facebook.com" target="_blank"><button type="button" class="btn" style="background-color: #267DE4;color: white">Follow us on facebook</button></a>
                </ul>
            </div>
        </div>
    </div>
</header>




<section id="banner" class="wow fadeInUp">
    <div class="container">
        <div class="row">

            <div class="col-md-7 col-sm-8">
                <div class="block">
                    <img class="app-img img-responsive"src="{{URL::asset("assets/img/app.png")}}" width = "700" heigh = "700"alt="">
                </div>

            </div>
            <div class="col-md-4 col-md-offset-1 col-sm-6">
                <div class="block">
                    <h2>
                        TIẾT KIỆM THỜI GIAN ĐỌC TIN TỨC VỚI SHORT-NEWS.
                    </h2>
                    <p>
                        - <strong>Tin Tức </strong> : Các tin chính trong ngày được chúng tôi tóm tắt trong <b style="color: red">100 từ</b>
                        đến từ tất cả các báo lớn ở Việt Nam, giúp bạn nhanh chóng nắm bắt thông tin quan trọng,tiết kiệm thời gian,
                        loại bỏ tình trạng giật tít câu view trên các báo hiện nay
                        <br>
                        - <strong>Mạng Xã Hội</strong> : Cập nhật những thông tin nóng và các xu hướng trên tất cả các mạng xã hội trong ngày

                    </p>

                    <ul class="download-btn">

                        <a href="#"><img src="{{URL::asset("assets/img/ios_VI.png")}}" width="160" height="47"/></a>
                        <a href="#"><img src="{{URL::asset("assets/img/android_VI.png")}}" width="160" height="47"/></a>

                    </ul>


                </div>
            </div>
        </div>
    </div>
</section>


<footer class="wow fadeInUp" data-wow-delay=".8s">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <!--<a class="footer-logo"href="#">-->
                <!--<img class="img-responsive" src="images/footer-logo.png" alt="">-->
                <!--</a>-->
                <p>Copyright © 2017 shortNews Co.</p>

            </div>
        </div>
    </div>
</footer>

</body>
</html>
