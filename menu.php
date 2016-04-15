<?php
   $appetizerItems = $results['app'];
   $lunchItems = $results['lunch'];
   $entreitems = $results['entree'];
   $desertItems = $results['desert'];
   $topItems = $results['top'];
   $modify = $_SESSION['userType'] == 'manager' || $_SESSION['userType'] == 'cheff';
?>

        <div class="carousel slide" data-ride="carousel" id="carousel-example-captions" style="margin-top: 30px;margin-bottom: 30px; height:450px;">
            <ol class="carousel-indicators">
                <?php for($i = 0; $i < $topItems->num_rows; $i++) : ?>
                    <li <?php if($i==0): ?>class="active"<?php endif; ?> data-slide-to="<?php echo $i; ?>" data-target="#carousel-example-captions"></li>
                <?php endfor; ?>
                
            </ol>
            <div class="carousel-inner" role="listbox" style="margin-bottom:20px;height:450px;">
                <?php foreach($topItems as $index => $item) : ?>
                    <div class="item <?php if($index==0) echo 'active'; ?>">
                        <img data-holder-rendered="true" src="<?php echo $item['path']; ?>"
                        style="z-index: -99999;">
                        <div class="carousel-caption" style="top: 310px;">
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
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="thumbnail" style="background-image: url('<?php echo $item['path']; ?>');" ></div>
                                </div>
                                <div class="col-xs-6">
                                    <h3><?php echo $item['title']; ?> - $<?php echo $item['price']; ?></h3>
                                    <p><?php echo $item['desc']; ?></p>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-primary add-item-button" type="button" onclick="addItemToOrder(<?php echo $item['id'] . ",'" . $item['title'] . "'," . $item['price'] . ",'" . $item['path'] . "'"; ?>)">Add to order</button>
                                </div>
                            </div>
                            <?php if($index != count($appetizerItems) - 1) : ?>
                                <hr>
                            <?php endif; ?>
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
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="thumbnail" style="background-image: url('<?php echo $item['path']; ?>');" ></div>
                                </div>
                                <div class="col-xs-6">
                                    <h3><?php echo $item['title']; ?> - $<?php echo $item['price']; ?></h3>
                                    <p><?php echo $item['desc']; ?></p>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-primary add-item-button" type="button" onclick="addItemToOrder(<?php echo $item['id'] . ",'" . $item['title'] . "'," . $item['price'] . ",'" . $item['path'] . "'"; ?>)">Add to order</button>
                                </div>
                            </div>
                            <?php if($index != count($appetizerItems) - 1) : ?>
                                <hr>
                            <?php endif; ?>
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
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="thumbnail" style="background-image: url('<?php echo $item['path']; ?>');" ></div>
                                </div>
                                <div class="col-xs-6">
                                    <h3><?php echo $item['title']; ?> - $<?php echo $item['price']; ?></h3>
                                    <p><?php echo $item['desc']; ?></p>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-primary add-item-button" type="button" onclick="addItemToOrder(<?php echo $item['id'] . ",'" . $item['title'] . "'," . $item['price'] . ",'" . $item['path'] . "'"; ?>)">Add to order</button>
                                </div>
                            </div>
                            <?php if($index != count($appetizerItems) - 1) : ?>
                                <hr>
                            <?php endif; ?>
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
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="thumbnail" style="background-image: url('<?php echo $item['path']; ?>');" ></div>
                                </div>
                                <div class="col-xs-6">
                                    <h3><?php echo $item['title']; ?> - $<?php echo $item['price']; ?></h3>
                                    <p><?php echo $item['desc']; ?></p>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-primary add-item-button" type="button" onclick="addItemToOrder(<?php echo $item['id'] . ",'" . $item['title'] . "'," . $item['price'] . ",'" . $item['path'] . "'"; ?>)">Add to order</button>
                                </div>
                            </div>
                            <?php if($index != count($appetizerItems) - 1) : ?>
                                <hr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->