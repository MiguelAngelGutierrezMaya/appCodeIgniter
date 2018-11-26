<div class="header-top-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="header-top-wraper">
                    <div class="row">
                        <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                            <div class="menu-switcher-pro">
                                <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
										<i class="fa fa-bars"></i>
									</button>
                            </div>
                        </div>
                        <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-right-info">
                                <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                    <li class="nav-item">
                                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
											<i class="fa fa-user adminpro-user-rounded header-riht-inf" aria-hidden="true"></i>
											<span class="admin-name"><?php echo $this->session->first_name; ?></span>
											<i class="fa fa-angle-down adminpro-icon adminpro-down-arrow"></i>
										</a>
                                        <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                            <li>
                                                <a href="#">
                                                    <span class="fa fa-pencil author-log-ic"></span>Registro
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="fa fa-user author-log-ic"></span>Perfil
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('users/logout'); ?>">
                                                    <span class="fa fa-sign-in author-log-ic"></span>Salir
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>