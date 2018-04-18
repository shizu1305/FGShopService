<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">
                <?=$action_name?>
            </h4>
        </div>
        <div class="content">
            <form action="admin.php?controller=<?=$page_name?>&action=update&id=<?=$object->id?>&token=<?=$token?>" method="post">

                  <div class="row">
                      <div class="col-md-2">
                          <div class="form-group">
                              <label>#ID</label>
                              <input name="id" type="text" class="form-control border-input" disabled placeholder="ID" value="<?=$object->id?>">
                          </div>
                      </div>



                      <div class="col-md-5">
                          <div class="form-group">
                              <label>Big Image</label>
                              <input name="big_img" type="text" class="form-control border-input" placeholder="Big Image" value="<?=$object->big_img?>">
                          </div>
                      </div>

                       <div class="col-md-5">
                          <div class="form-group">
                              <label>Small Image</label>
                              <input name="small_img" type="text" class="form-control border-input" placeholder="Small Image" value="<?=$object->small_img?>">
                          </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Details Image</label>
                              <textarea rows="10" cols="50" name="details_img" type="textarea" class="form-control border-input" placeholder="Details Image" ><?=$object->details_img?>
                              </textarea>
                          </div>
                      </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-fill btn-wd" onclick="update()">Update <?=$page_name?></button>
                    </div>

                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
