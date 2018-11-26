<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="#"><?php $this->load->view('partials/img-logo'); ?></a>
            <strong>CI</strong>
        </div>
        <div style="margin-top: 1em;" class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                    <?php foreach ($menu as $item): ?>
                        <?php if(in_array($this->session->type, $item['type'])): ?>
                            <li>
                                <a class="has-arrow" href="#">
        						   <i class="<?php echo $item['icon']; ?>"></i>
        						   <span class="mini-click-non"><?php echo $item['title']; ?></span>
        						</a>
                                <ul class="submenu-angle" aria-expanded="<?php echo $item['aria-expanded']; ?>">
                                    <?php foreach ($item['content'] as $item_menu): ?>
                                    <li class="nav-item">
                                        <a title="<?php echo $item_menu['title']; ?>" href="<?php echo $item_menu['url']; ?>">
                                            <i class="<?php echo $item_menu['class']; ?>" aria-hidden="true"></i>
                                            <span class="mini-sub-pro"><?= $item_menu['title'] ?></span>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endif ?>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </nav>
</div>