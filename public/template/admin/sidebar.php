 <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
    Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
    Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
  -->

      <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    FGShop
                </a>
            </div>

            <ul class="nav">
                <li <?php echo $title == 'dashboard' ? "class='active'" : "" ?> >
                    <a href='<?="admin.php?controller=user&action=index&pages=0&token=$token"?>'>
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li <?php echo $title == 'user' ? "class='active'" : "" ?>>
                    <a href="admin.php?controller=utils&action=user&token=<?=$token?>">
                        <i class="ti-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li <?php echo $title == 'table' ? "class='active'" : "" ?>>
                    <a href="admin.php?controller=utils&action=table&token=<?=$token?>">
                        <i class="ti-view-list-alt"></i>
                        <p>Table List</p>
                    </a>
                </li>
                <li> <?php echo $title == 'notifications' ? "class='active'" : "" ?>
                    <a href="admin.php?controller=utils&action=notifications&token=<?=$token?>">
                        <i class="ti-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
            </ul>
      </div>
    </div>
