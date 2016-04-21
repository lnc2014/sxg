<?php
/**
 * Description：后台账号管理
 * Author: LNC
 * Date: 2016/4/21
 * Time: 23:00
 */

$this->load->view('common/header');
$this->load->view('common/nav');
?>

<div class="main-container" id="main-container">
    <?php

    $this->load->view('common/sidebar',array('controller'=>'account'));
    ?>
    <div class="main-content">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">

            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo site_url('admin/admin/index')?>">主页</a>
                </li>
                <li class="active">子帐号管理</li>
            </ul><!-- /.breadcrumb -->

            <!-- #section:basics/content.searchbox -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="ace-icon fa fa-search nav-search-icon"></i>
							</span>
                </form>
            </div><!-- /.nav-search -->

            <!-- /section:basics/content.searchbox -->
        </div>

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">
            <h4 class="pink">
                <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                <a href="<?php echo site_url('admin/admin/add_account')?>" class="btn btn-success"> 添加子帐号 </a>
            </h4>

            <div class="row">
                <div class="col-xs-12">
                    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="center">
                                ID

                            </th>
                            <th>账号</th>
                            <th>密码</th>
                            <th class="hidden-480">状态</th>
                            <th class="hidden-480">权限</th>

                            <th>操作</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        foreach($admins as $admin){?>
                            <tr>
                                <td class="center">
                                <?php echo $admin['id'] ?>
                                </td>

                                <td><?php echo $admin['username'] ?></td>
                                <td class="hidden-480"><?php echo $admin['psw'] ?></td>

                                <td class="hidden-480">
                                    <span class="label label-sm label-<?php if($admin['flag'] == 1){echo 'success';}elseif($admin['flag']==0){echo 'danger';} ?>">
                                        <?php if($admin['flag'] == 1){echo '正常';}elseif($admin['flag']==0){echo '冻结';} ?>
                                    </span>
                                </td>
                                <td>
                                <?php
                                $this->load->model('admin/sxg_admin');
                                $admin_groups = $this->sxg_admin->findGroupName($admin['group_id']);
                                $groupName = '';
                                foreach($admin_groups as $k=>$group){
                                    $groupName .= $group['group_name'].';';
                                }
                                echo $groupName;
                                ?>
                                </td>

                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                                        <a href="" class="btn btn-xs btn-info">冻结</a>
                                        <a href="" class="btn btn-xs btn-info">解冻</a>
                                        <a href="" class="btn btn-xs btn-danger">删除</a>
                                    </div>


                                </td>
                            </tr>

                        <?php } ?>


                        </tbody>
                    </table>
                </div><!-- /.span -->
            </div>
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->


    <?php

    $this->load->view('common/footer');
    ?>


    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->


<?php

$this->load->view('common/footer_js');
?>


