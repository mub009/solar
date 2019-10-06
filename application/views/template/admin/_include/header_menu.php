<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
                data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <!-- END SIDEBAR TOGGLER BUTTON -->
                <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                <li class="heading">
                    <h3 class="uppercase" style="
    color: azure;
"><b>
                            <center>
                                <?=$userinfo['HeaderName']?>
                            </center>
                        </b></h3>
                </li>
                <li id="NavMainManageProduct" class="nav-item ">
                    <a href="<?=base_url('backend/admin/dashboard')?>" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>

                    </a>

                </li>
                <li class="heading">
                    <h3 class="uppercase">Menus</h3>
                </li>


                <li id='NavGeneralCurrency' class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/complaint/complaint/index'?>" class="nav-link ">
                            <i class="icon-home"></i><span class="title">Compliments</span>
                            </a>
                        </li>

                <li id="NavMainUsers" class="nav-item ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">Users</span>
                        <span id="ArrowMainUsers" class="arrow"></span>
                    </a>
                    <ul class="sub-menu">

                        <li id="NavUsersAdmin" class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/user/admin/admin'?>" class="nav-link ">
                                <span class="title">Country Admin</span>
                            </a>
                        </li>


                        <li id="NavUsersCustomer" class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/user/customer'?>" class="nav-link ">
                                <span class="title">Customer</span>
                            </a>
                        </li>


                    </ul>
                </li>


                <li id="NavMainGeneral" class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-diamond"></i>
                        <span class="title">General </span>
                        <span id="ArrowMainGeneral" class="arrow"></span>
                    </a>
                    <ul class="sub-menu">

                        <li id="NavGeneralCountry" class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/general/country/country'?>" class="nav-link ">
                                <span class="title">Country</span>
                            </a>
                        </li>

                        <li id="NavGeneralState" class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/general/state/state'?>" class="nav-link ">
                                <span class="title">State</span>
                            </a>
                        </li>


                        <li id="NavGeneralCity" class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/general/city/city'?>" class="nav-link ">
                                <span class="title">City</span>
                            </a>
                        </li>

                        <li id="NavGeneralArea" class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/general/area/area'?>" class="nav-link ">
                                <span class="title">Area</span>
                            </a>
                        </li>

                        <li id='NavGeneralCurrency' class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/general/currency/currency'?>" class="nav-link ">
                                <span class="title">Currency</span>
                            </a>
                        </li>




                    </ul>

                </li>
 







                <li id="NavMainManageProduct" class="nav-item ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-folder-open-o"></i>
                        <span class="title">Features</span>
                        <span id="ArrowMainManageProduct" class="arrow"></span>
                    </a>
                    <ul class="sub-menu">


                        <li id="NavManageProductProductAdd" class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/features/productadd/productadd/'?>" class="nav-link ">
                                <span class="title">Service</span>
                            </a>
                        </li>

          

                    </ul>
                </li>







                <li id="NavMainManageProduct" class="nav-item ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-folder-open-o"></i>
                        <span class="title">Manage Date</span>
                        <span id="ArrowMainManageProduct" class="arrow"></span>
                    </a>
                    <ul class="sub-menu">


                        <li id="NavManageProductCategory" class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/manage_data/category/category/'?>" class="nav-link ">
                                <span class="title">Category</span>
                            </a>
                        </li>


                        <li id="NavManageProductSubcategory" class="nav-item  ">
                            <a href="<?=base_url() . 'backend/admin/manage_data/subcategory/subcategory/'?>" class="nav-link ">
                                <span class="title">Sub Category</span>
                            </a>
                        </li>

          


                    </ul>
                </li>











                <li class="heading">
                    <h3 class="uppercase">Developer</h3>
                </li>


    <li id="NavMainManageProduct" class="nav-item  open">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-windows"></i>
                        <span class="title">Application Configuration</span>
                        <span id="ArrowMainManageProduct" class="arrow open"></span>
                    </a>
                    <ul class="sub-menu" style="display: block;">

                        <li id="" class="nav-item  ">
                            <a href="<?=base_url(). 'backend/admin/applicationconfiguration/appversioncontroller/index'?>" class="nav-link ">
                                <span class="title">App Version Controller</span>
                            </a>
                        </li>

                        <li id="" class="nav-item  ">
                            <a href="<?=base_url(). 'backend/admin/applicationconfiguration/appapikeys/index'?>" class="nav-link ">
                                <span class="title">App API Keys</span>
                            </a>
                        </li>

                     



                    </ul>
                </li>





                            <li id="NavTax" class="nav-item ">
                                <a href="<?=base_url() . 'backend/admin/profile';?>" class="nav-link">
                                    <i class="fa fa-user"></i>
                                    <span class="title">Profile </span>

                                </a>
                                <ul class="sub-menu">


                                </ul>
                            </li>

            </ul>
            </li>






            </ul>
            <!-- END SIDEBAR MENU -->
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>