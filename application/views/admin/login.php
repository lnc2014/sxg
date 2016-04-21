<?php
/**
 * Author:LNC
 * Description: 登录页面
 * Date: 2016/4/21 0021
 * Time: 上午 11:11
 */
$base_css_url = $this->config->item('css_url');
$base_js_url = $this->config->item('js_url');
$base_img_url = $this->config->item('img_url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>闪修哥后台管理系统</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo $base_css_url?>/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $base_css_url?>/font-awesome.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace-fonts.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace-part2.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace-ie.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace.onpage-help.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="<?php echo $base_js_url?>/html5shiv.js"></script>
    <script src="<?php echo $base_js_url?>/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-layout">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <i class="ace-icon fa fa-leaf green"></i>
                            <span class="red">闪修哥</span>
                            <span class="white" id="id-text2">后台管理系统</span>
                        </h1>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-coffee green"></i>
                                        Please Enter Your Information
                                    </h4>

                                    <div class="space-6"></div>

                                    <form>
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" id="admin"/>
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" id="psw"/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
                                            </label>

                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <label class="inline">
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"> Remember Me</span>
                                                </label>

                                                <button type="button" class="width-35 pull-right btn btn-sm btn-primary" id="login">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">Login</span>
                                                </button>
                                            </div>

                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>


                                </div><!-- /.widget-main -->


                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->



                    <div class="navbar-fixed-top align-right">
                        <br />
                        &nbsp;
                        <a id="btn-login-dark" href="#">Dark</a>
                        &nbsp;
                        <span class="blue">/</span>
                        &nbsp;
                        <a id="btn-login-blur" href="#">Blur</a>
                        &nbsp;
                        <span class="blue">/</span>
                        &nbsp;
                        <a id="btn-login-light" href="#">Light</a>
                        &nbsp; &nbsp; &nbsp;
                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo $base_js_url?>/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo $base_js_url?>/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $base_js_url?>/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        $(document).on('click', '.toolbar a[data-target]', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
        });
    });



    //you don't need this, just used for changing background
    jQuery(function($) {
        $('#btn-login-dark').on('click', function(e) {
            $('body').attr('class', 'login-layout');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-light').on('click', function(e) {
            $('body').attr('class', 'login-layout light-login');
            $('#id-text2').attr('class', 'grey');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-blur').on('click', function(e) {
            $('body').attr('class', 'login-layout blur-login');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'light-blue');

            e.preventDefault();
        });
        $('#login').click(function () {
            var admin_name = $('#admin').val();
            var admin_psw = $('#psw').val();
            if(!admin_name){
                alert('登录用户名不能为空！');
                return;
            }
            if(!admin_psw){
                alert('登录密码不能为空');
                return;
            }

            $.ajax({
                type:"POST",
                //提交的网址
                url:'<?php echo site_url('admin/login/login_check')?>',
                //提交的数据
                data:{
                    admin_name : admin_name,
                    admin_psw : admin_psw,
                    time : '<?php echo time();?>'
                },
                //返回数据的格式
                dataType: "json",
                success:function(data){

                    if(data.code == 0003){

                        window.location.href = '<?php echo site_url('admin/admin/index')?>';

                    }else{
                        alert(data.msg);
                        window.location.href = window.location.href;
                    }

                }   ,
                //调用执行后调用的函数
                complete: function(XMLHttpRequest, textStatus){

                },
                //调用出错执行的函数
                error: function(){
                    //请求出错处理
                    alert('程序出错！');
                }
            });


        });

    });
</script>
</body>
</html>

