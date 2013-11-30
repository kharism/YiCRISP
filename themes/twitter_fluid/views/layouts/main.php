<?php
Yii::app()->clientscript
        ->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap.css')
        ->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css')
        ->registerCoreScript('jquery')
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/Chart.js', CClientScript::POS_BEGIN);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Risshikan OGO | Student Information System</title>
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le styles -->
        <style type="text/css">
            body {
                padding-bottom: 0px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }

            @media (max-width: 980px) {
                body{
                    padding-top: 0px;
                }
            }
        </style>

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>

    <body>
        <div class="navbar navbar-static-top">
            <div class="navbar-inner visible-desktop">
                <div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
                    <a class="brand" href="#"><img src="images/Company-Logo.png" alt="<?php echo Yii::app()->name ?>"></a>
                    <div class="nav-collapse colapse">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'htmlOptions' => array('class' => 'nav nav-tabs'),
                            'activeCssClass' => 'active',
                            'items' => array(
                                array('label' => 'Home', 'url' => array('/site/index')),
                                array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'Profile (' . Yii::app()->user->name . ')', 'url' => '#', 'visible' => !Yii::app()->user->isGuest, 'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu', 'aria-labelledby' => 'dropdownMenu'), 'linkOptions' => array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'), 'items' => array(
                                        array('label' => 'Profile', 'url' => array('user/profile')),
                                        array('label' => 'Logout', 'url' => array('site/logout'), 'visible' => !Yii::app()->user->isGuest),
                                    )),
                                array('label' => 'School', 'url' => '#', 'visible' => Yii::app()->user->Admin, 'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu', 'aria-labelledby' => 'dropdownMenu'), 'linkOptions' => array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'), 'items' => array(
                                        array(
                                            'label' => 'School', 'url' => array('school/admin/'), 'visible' => Yii::app()->user->Admin
                                        ),
                                        array('label' => 'Category', 'url' => array('/schoolCategory/admin'), 'visible' => Yii::app()->user->Admin),
                                        array('label' => 'Level', 'url' => array('/schoolLevel/admin'), 'visible' => Yii::app()->user->Admin),
                                        array('label' => 'Class', 'url' => array('/classm/admin'), 'visible' => Yii::app()->user->Admin),
                                        array('label' => 'State', 'url' => array('/state/admin'), 'visible' => Yii::app()->user->Admin),
                                        array('label' => 'City', 'url' => array('/city/admin'), 'visible' => Yii::app()->user->Admin),
                                        array('label'=>'Terms','url'=>array('terms/admin')),
                                    ),
                                ),
                                array('label' => 'Student', 'url' => array('student/admin/'), 'visible' => Yii::app()->user->Admin),
                                array('label' => 'Test', 'url' => '#', 'visible' => Yii::app()->user->Admin, 'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu'), 'linkOptions' => array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'), 'items' => array(
                                        array('label' => 'Test', 'url' => array('test/admin')),
                                        array('label' => 'Test Result', 'url' => array('testResult/index/')),
                                        array('label' => 'Test Category 1', 'url' => array('categoryTestOne/admin/')),                                        
                                    )),
                                array('label' => 'My Children', 'url' => array('student/MyChild'), 'visible' => Yii::app()->user->isGroup('parent')),
                                array('label' => 'Payment', 'url' => '#', 'visible' => Yii::app()->user->Admin, 'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu'), 'linkOptions' => array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'), 'items' => array(
                                        array('label' => 'Payment', 'url' => array('payment/admin2')),
                                        array('label' => 'Payment Method', 'url' => array('paymentMethod/admin')),
                                        array('label' => 'Refund', 'url' => array('refund/admin')),
                                        array('label' => 'Promotion', 'url' => array('promotion/admin')),
                                        array('label' => 'Config', 'url' => array('config/admin')),
                                    )),
                                array('label' => 'Invoice', 'url' => '#', 'visible' => Yii::app()->user->isGroup('accounting'), 'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu'), 'linkOptions' => array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'), 'items' => array(
                                        array('label' => 'Search Invoice', 'url' => array('invoice/search')),
                                        array('label' => 'Report Income', 'url' => array('invoice/reportIncome', 'd' => date('Ym'))),
                                        array('label' => 'Report Refund', 'url' => array('invoice/reportRefund', 'd' => date('Ym'))),
                                    )),
                                array('label' => 'Attendance', 'url' => array('attendance/index'), 'visible' => Yii::app()->user->isGroup('accounting')),
                                array('label' => 'Account', 'url' => array('user/admin/'), 'visible' => Yii::app()->user->Admin),
                            ),
                        ));
                        ?>

                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="visible-phone nav">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array('class' => 'nav nav-tabs'),
                'activeCssClass' => 'active',
                'items' => array(
                    array('label' => 'Home', 'url' => array('/site/index')),
                    array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                    array('label' => 'Profile (' . Yii::app()->user->name . ')', 'url' => '#', 'visible' => !Yii::app()->user->isGuest, 'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu', 'aria-labelledby' => 'dropdownMenu'), 'linkOptions' => array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'), 'items' => array(
                            array('label' => 'Profile', 'url' => array('user/profile')),
                            array('label' => 'Logout', 'url' => array('site/logout'), 'visible' => !Yii::app()->user->isGuest),
                        )),
                    array('label' => 'School', 'url' => '#', 'visible' => Yii::app()->user->Admin, 'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu', 'aria-labelledby' => 'dropdownMenu'), 'linkOptions' => array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'), 'items' => array(
                            array(
                                'label' => 'School', 'url' => array('school/admin/'), 'visible' => Yii::app()->user->Admin
                            ),
                            array('label' => 'Category', 'url' => array('/schoolCategory/admin'), 'visible' => Yii::app()->user->Admin),
                            array('label' => 'Level', 'url' => array('/schoolLevel/admin'), 'visible' => Yii::app()->user->Admin),
                            array('label' => 'Class', 'url' => array('/classm/admin'), 'visible' => Yii::app()->user->Admin),
                            array('label' => 'State', 'url' => array('/state/admin'), 'visible' => Yii::app()->user->Admin),
                            array('label' => 'City', 'url' => array('/city/admin'), 'visible' => Yii::app()->user->Admin)),
                    ),
                    array('label' => 'Student', 'url' => array('student/admin/'), 'visible' => Yii::app()->user->Admin),
                    array('label' => 'Test', 'url' => '#', 'visible' => Yii::app()->user->Admin, 'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu'), 'linkOptions' => array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'), 'items' => array(
                            array('label' => 'Test', 'url' => array('test/admin')),
                            array('label' => 'Test Result', 'url' => array('testResult/index/')),
                            array('label' => 'Test Category 1', 'url' => array('categoryTestOne/admin/')),
                            array('label' => 'Test Category 2', 'url' => array('categoryTestTwo/admin/')),
                        )),
                    array('label' => 'My Children', 'url' => array('student/MyChild'), 'visible' => Yii::app()->user->isGroup('parent')),
                    array('label' => 'Payment', 'url' => '#', 'visible' => Yii::app()->user->Admin, 'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu'), 'linkOptions' => array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'), 'items' => array(
                            array('label' => 'Payment', 'url' => array('payment/admin2')),
                            array('label' => 'Payment Method', 'url' => array('paymentMethod/admin')),
                            array('label' => 'Refund', 'url' => array('refund/admin')),
                        )),
                    array('label' => 'Invoice', 'url' => '#', 'visible' => Yii::app()->user->isGroup('accounting'), 'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown-menu', 'role' => 'menu'), 'linkOptions' => array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'), 'items' => array(
                            array('label' => 'Search Invoice', 'url' => array('invoice/search')),
                            array('label' => 'Report Income', 'url' => array('invoice/reportIncome', 'd' => date('Ym'))),
                            array('label' => 'Report Refund', 'url' => array('invoice/reportRefund', 'd' => date('Ym'))),
                        )),
                    array('label' => 'Attendance', 'url' => array('attendance/index'), 'visible' => Yii::app()->user->isGroup('accounting')),
                    array('label' => 'Account', 'url' => array('user/admin/'), 'visible' => Yii::app()->user->Admin),
                ),
            ));
            ?>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
				
                <div class="span2">
                    <div class="well sidebar-nav">
                        <ul class="nav nav-list">
                            <li class="nav-header">Module Menu</li>
                            <?php foreach ($this->menu as $menu): ?>
                                <li><?php echo CHtml::link($menu['label'], $menu['url']) ?></li>
                            <?php endforeach; ?>
                            <!--li class="nav-header">Sidebar</li>
                            <li class="active"><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li-->
                        </ul>
                    </div><!--/.well -->
                </div><!--/span-->
                <div class="span10">
                    <div class="hero-unit">
                        <?php if(isset($this->breadcrumbs)):?>
                            <div class="row-fluid">
                                <div class="span12">
                                <?php
                                $this->widget('zii.widgets.CBreadcrumbs', array(
                                    'links'=>$this->breadcrumbs,
                                ));
                                ?>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php echo $content ?>
                    </div>
                    <!--/row-->
                    <!--div class="row-fluid">
                      <div class="span4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn" href="#">View details &raquo;</a></p>
                      </div>
                      <div class="span4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn" href="#">View details &raquo;</a></p>
                      </div>
                      <div class="span4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn" href="#">View details &raquo;</a></p>
                      </div--><!--/span-->
                </div><!--/row-->
            </div><!--/span-->
        </div><!--/row-->

        <hr>

        <footer>
            <!--<p style="background-color:rgb(0, 21, 166); color:#aaaaaa; text-align:right; padding-right:10px">&copy; Company 2012</p>-->
            <div class="navbar navbar-fixed-bottom">&copy; Kharisma 2012</div>
        </footer>

    </div><!--/.fluid-container-->

</body>
</html>
