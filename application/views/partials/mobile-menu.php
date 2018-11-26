<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <?php foreach ($menu as $item): ?>
                                <?php if(in_array($this->session->type, $item['type'])): ?>
                                    <li><a data-toggle="collapse"><?php echo $item['title']; ?><span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                        <ul class="collapse dropdown-header-top">
                                            <?php foreach ($item['content'] as $item_menu): ?>
                                            <li><a href="<?php echo $item_menu['url']; ?>"><?php echo $item_menu['title']; ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>