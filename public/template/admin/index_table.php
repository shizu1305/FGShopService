<div class="col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">
        <?=$table_name?>
      </h4>
      <p class="category">
        <?=$table_subtitle?>
      </p>
      <a id="btn_add" href='admin.php?controller=<?=$page_name?>&action=create&token=<?php echo $token?>'>ADD</a>
    </div>
    <div class="content table-responsive table-full-width">
      <?php
                                  if ($list != null) {
                                ?>
        <table class="table table-striped">
          <thead>
            <?php
                                        $arr = (array) $list[0];
                                        $keys = array_keys($arr);
                                        foreach($keys as $row) {
                                          echo "<th>$row</th>";
                                        }
                                      ?>
          </thead>
          <tbody>
            <?php foreach ($list as $row):
                                          array_map('htmlentities', $row);
                                          ?>
            <tr>
              <td>
                <?php echo implode('</td><td>', $row); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php
                                } else {
                                  echo "<h4 id='table_null'>Table is null</h4>";
                                }
                                ?>
    </div>
    <div class="text-center">
      <div class="pagination">
        <?php
                                  $paginations = ceil($num_rows / 10);
                                  $laquo = $pages == 0 ? $pages : $pages - 10;
                                  $raquo = ($pages == (($paginations - 1) * 10)) ? $pages : $pages + 10;
                                  echo "<a href='admin.php?controller=user&action=index&pages=$laquo&token=$token'>&laquo;</a>";
                                  for ($i=0; $i < $paginations; $i++) {
                                    $index = $i + 1;
                                    $pages_index = $i * 10;
                                    if ($i == ceil($pages / 10)) {
                                      echo "<a href='admin.php?controller=user&action=index&pages=$pages_index&token=$token' class='active'>$index</a>";
                                    } else {
                                      echo "<a href='admin.php?controller=user&action=index&pages=$pages_index&token=$token'>$index</a>";
                                    }
                                  }
                                  echo "<a href='admin.php?controller=user&action=index&pages=$raquo&token=$token'>&raquo;</a>";
                                  ?>
      </div>
    </div>
  </div>
</div>
