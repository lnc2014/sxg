<?php
/**
 * Description：侧边栏
 * Date: 2016/4/21
 * Time: 21:49
 */

?>

<div id="sidebar" class="sidebar responsive">

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <!-- #section:basics/sidebar.layout.shortcuts -->
            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>

            <!-- /section:basics/sidebar.layout.shortcuts -->
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="<?php if($controller == 'index'){echo 'active';}?>">
            <a href="<?php echo site_url('admin/admin/index')?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text">主页</span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="<?php if($controller == 'order'){echo 'active';}?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">订单中心</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>

                        Layouts
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="">
                            <a href="top-menu.html">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Top Menu
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="mobile-menu-1.html">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Default Mobile Menu
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="mobile-menu-2.html">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Mobile Menu 2
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="mobile-menu-3.html">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Mobile Menu 3
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="typography.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Typography
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="elements.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Elements
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="buttons.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Buttons &amp; Icons
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="treeview.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Treeview
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="jquery-ui.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        jQuery UI
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="nestable-list.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Nestable Lists
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>

                        Three Level Menu
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="">
                            <a href="#">
                                <i class="menu-icon fa fa-leaf"></i>
                                Item #1
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-pencil"></i>

                                4th level
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>

                            <ul class="submenu">
                                <li class="">
                                    <a href="#">
                                        <i class="menu-icon fa fa-plus"></i>
                                        Add Product
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="">
                                    <a href="#">
                                        <i class="menu-icon fa fa-eye"></i>
                                        View Products
                                    </a>

                                    <b class="arrow"></b>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="<?php if($controller == 'user'){echo 'active';}?>">
            <a href="<?php echo site_url('admin/admin/user')?>" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> 用户管理 </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="<?php if($controller == 'user'){echo 'active';}?>">
                    <a href="<?php echo site_url('admin/admin/user')?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        用户管理
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="<?php if($controller == 'repair'){echo 'active';}?>">
                    <a href="<?php echo site_url('admin/admin/repair')?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        维修员管理
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?php if($controller == 'repair_check'){echo 'active';}?>">
                    <a href="jqgrid.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        维修员审核
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?php if($controller == 'user_feedback'){echo 'active';}?>">
                    <a href="jqgrid.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        用户投诉
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text"> 运营方案</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="form-elements.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Form Elements
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="form-wizard.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Wizard &amp; Validation
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="wysiwyg.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Wysiwyg &amp; Markdown
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="dropzone.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Dropzone File Upload
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="widgets.html">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">统计数据</span>
            </a>

            <b class="arrow"></b>
        </li>



        <li class="<?php if($controller == 'account'){echo 'active';}?>">
            <a href="<?php echo site_url('admin/admin/account')?>">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">后台账号</span>
            </a>
            <b class="arrow"></b>
        </li>

    </ul><!-- /.nav-list -->

    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>

