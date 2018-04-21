<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
    Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
    Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
  -->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="<?=" admin.php?controller=dashboard&action=index&token=$token "?>" class="simple-text">
                FGShop
            </a>
        </div>

        <ul class="nav">
            <li <?php echo $page_name=='Dashboard' ? "class='active'" : "" ?> >
                <a href='<?="admin.php?controller=dashboard&action=index&token=$token"?>'>
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <!-- Table -->
            <!-- <li <?php echo $page_name=='User' ? "class='active'" : "" ?>>
                <a href='<?="admin.php?controller=user&action=index&token=$token"?>'>
                    <i class="ti-view-list-alt"></i>
                    <p>Table List</p>
                </a>
            </li> -->

            <li class="active-pro">
                <a href="admin.php?controller=user&action=logout&token=<?=$token?>">
                    <i class="ti-power-off"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>
