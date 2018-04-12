  <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?=$table_name?></h4>
                                <p class="category"><?=$table_subtitle?></p>
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
                                          array_map('htmlentities', $row); ?>
                                       <tr>
                                       <td><?php echo implode('</td><td>', $row); ?></td>
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
                                  <a href="#">&laquo;</a>
                                  <a href="admin.php?controller=utils&action=dashboard&token=<?=$token?>&page=20">1</a> <!--  class="active" -->
                                  <a href="admin.php?controller=utils&action=dashboard&token=<?=$token?>&page=20">2</a>
                                  <a href="admin.php?controller=utils&action=dashboard&token=<?=$token?>&page=30">3</a>
                                  <a href="admin.php?controller=utils&action=dashboard&token=<?=$token?>&page=40">4</a>
                                  <a href="admin.php?controller=utils&action=dashboard&token=<?=$token?>&page=50">5</a>
                                  <a href="admin.php?controller=utils&action=dashboard&token=<?=$token?>&page=60">6</a>
                                  <a href="#">&raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>
