<?php
   $appetizerItems = $results['app'];
   $lunchItems = $results['lunch'];
   $entreitems = $results['entree'];
   $desertItems = $results['desert'];
   $drinkItems = $results['drinks'];
   $topItems = $results['top'];
   $modify = $_SESSION['userType'] == 'manager' || $_SESSION['userType'] == 'chef';
?>
    <div id="menu">
        <div class="carousel slide" data-ride="carousel" id="carousel-example-captions" style="margin-bottom:20px;margin-top: 30px;">
            <ol class="carousel-indicators">
                <?php for($i = 0; $i < $topItems->num_rows; $i++) : ?>
                    <li <?php if($i==0): ?>class="active"<?php endif; ?> data-slide-to="<?php echo $i; ?>" data-target="#carousel-example-captions"></li>
                <?php endfor; ?>
                
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php foreach($topItems as $index => $item) : ?>
                    <div class="item <?php if($index==0) echo 'active'; ?>">
                        <div class="thumbnail-slider" style="background-image: url('<?php echo $item['path']; ?>');" ></div>
                        <div class="carousel-caption">
                            <h3 style="color: white;"><?php echo $item['title']; ?></h3>
                            <p><?php echo $item['desc']; ?></p>
                    </div>
                </div>    
                <?php endforeach; ?>
            </div>
        </div>
        <div aria-multiselectable="false" class="panel-group" id="accordion" role="tablist">
            <div class="panel panel-default">
                <div class="panel-heading" id="headingOne" role="tab">
                    <h4 class="panel-title"><a aria-controls="collapseOne"aria-expanded="true" class="" data-toggle="collapse" href="#collapseOne" role="button">Appetizers</a></h4>
                </div>
                <div aria-expanded="true" aria-labelledby="headingOne" class="panel-collapse collapse in" id="collapseOne" role="tabpanel">
                    <div class="panel-body">
                        <?php foreach($appetizerItems as $index => $item) : ?>
                            <div class="row menuItemRow<?php echo $item['id']; ?>">
                                <div class="col-md-2">
                                    <div class="thumbnail" style="background-image: url('<?php echo $item['path']; ?>');" ></div>
                                </div>
                                <div class="col-md-6">
                                    <h3><a onclick="showDetail(<?php echo $item['id']; ?>)"><?php echo $item['title']; ?> - $<?php echo $item['price']; ?></a></h3>
                                    <p><?php echo $item['desc']; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary add-item-button" type="button" onclick="addItemToOrder(<?php echo $item['id'] . ",'" . $item['title'] . "'," . $item['price'] . ",'" . $item['path'] . "'"; ?>)">Add to order</button>
                                </div>
                            </div>
                            <hr class="menuItemRow<?php echo $item['id']; ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" id="headingTwo" role="tab">
                    <h4 class="panel-title">
                        <a aria-controls="collapseTwo" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseTwo"role="button">Lunch</a>
                    </h4>
                </div>
                <div aria-expanded="false" aria-labelledby="headingTwo"class="panel-collapse collapse" id="collapseTwo" role="tabpanel" style="height: 0px;">
                    <div class="panel-body">
                        <?php foreach($lunchItems as $index => $item) : ?>
                            <div class="row menuItemRow<?php echo $item['id']; ?>">
                                <div class="col-md-2">
                                    <div class="thumbnail" style="background-image: url('<?php echo $item['path']; ?>');" ></div>
                                </div>
                                <div class="col-md-6">
                                    <h3><a onclick="showDetail(<?php echo $item['id']; ?>)"><?php echo $item['title']; ?> - $<?php echo $item['price']; ?></a></h3>
                                    <p><?php echo $item['desc']; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary add-item-button" type="button" onclick="addItemToOrder(<?php echo $item['id'] . ",'" . $item['title'] . "'," . $item['price'] . ",'" . $item['path'] . "'"; ?>)">Add to order</button>
                                </div>
                            </div>
                            <hr class="menuItemRow<?php echo $item['id']; ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" id="headingThree" role="tab">
                    <h4 class="panel-title"><a aria-controls="collapseThree" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseThree" role="button">Dinner</a></h4>
                </div>
                <div aria-expanded="false" aria-labelledby="headingThree" class="panel-collapse collapse" id="collapseThree" role="tabpanel" style="height: 0px;">
                    <div class="panel-body">
                        <?php foreach($entreitems as $index => $item) : ?>
                            <div class="row menuItemRow<?php echo $item['id']; ?>">
                                <div class="col-md-2">
                                    <div class="thumbnail" style="background-image: url('<?php echo $item['path']; ?>');" ></div>
                                </div>
                                <div class="col-md-6">
                                    <h3><a onclick="showDetail(<?php echo $item['id']; ?>)"><?php echo $item['title']; ?> - $<?php echo $item['price']; ?></a></h3>
                                    <p><?php echo $item['desc']; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary add-item-button" type="button" onclick="addItemToOrder(<?php echo $item['id'] . ",'" . $item['title'] . "'," . $item['price'] . ",'" . $item['path'] . "'"; ?>)">Add to order</button>
                                </div>
                            </div>
                            <hr class="menuItemRow<?php echo $item['id']; ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" id="headingFour" role="tab">
                    <h4 class="panel-title"><a aria-controls="collapseFour" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseFour" role="button">Dessert</a></h4>
                </div>
                <div aria-expanded="false" aria-labelledby="headingFour"class="panel-collapse collapse" id="collapseFour" role="tabpanel">
                    <div class="panel-body">
                        <?php foreach($desertItems as $index => $item) : ?>
                            <div class="row menuItemRow<?php echo $item['id']; ?>">
                                <div class="col-md-2">
                                    <div class="thumbnail" style="background-image: url('<?php echo $item['path']; ?>');" ></div>
                                </div>
                                <div class="col-md-6">
                                    <h3><a onclick="showDetail(<?php echo $item['id']; ?>)"><?php echo $item['title']; ?> - $<?php echo $item['price']; ?></a></h3>
                                    <p><?php echo $item['desc']; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary add-item-button" type="button" onclick="addItemToOrder(<?php echo $item['id'] . ",'" . $item['title'] . "'," . $item['price'] . ",'" . $item['path'] . "'"; ?>)">Add to order</button>
                                </div>
                            </div>
                            <hr class="menuItemRow<?php echo $item['id']; ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" id="headingFour" role="tab">
                    <h4 class="panel-title"><a aria-controls="collapseFive" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseFive" role="button">Drinks</a></h4>
                </div>
                <div aria-expanded="false" aria-labelledby="headingFive"class="panel-collapse collapse" id="collapseFive" role="tabpanel">
                    <div class="panel-body">
                        <?php foreach($drinkItems as $index => $item) : ?>
                            <div class="row menuItemRow<?php echo $item['id']; ?>">
                                <div class="col-md-2">
                                    <div class="thumbnail" style="background-image: url('<?php echo $item['path']; ?>');" ></div>
                                </div>
                                <div class="col-md-6">
                                    <h3><a onclick="showDetail(<?php echo $item['id']; ?>)"><?php echo $item['title']; ?> - $<?php echo $item['price']; ?></a></h3>
                                    <p><?php echo $item['desc']; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary add-item-button" type="button" onclick="addItemToOrder(<?php echo $item['id'] . ",'" . $item['title'] . "'," . $item['price'] . ",'" . $item['path'] . "'"; ?>)">Add to order</button>
                                </div>
                            </div>
                            <hr class="menuItemRow<?php echo $item['id']; ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div><!-- /.accordion -->
        <!-- Modal -->
        <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="commentModalLabel">Comments for dish: Blah</h4>
              </div>
              <div class="modal-body">
                <textarea id="commentBox" class="form-control" placeholder="If you have any special requests please type them here..." maxlength="250" rows="3"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveCommentObject()">Save comments</button>
              </div>
            </div>
          </div>
        </div>
    </div>