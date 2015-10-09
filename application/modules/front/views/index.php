    <?php if(config_item('admin_template')=='default') { ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action</a>
                                </li>
                                <li><a href="#">Another action</a>
                                </li>
                                <li><a href="#">Something else here</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Bar Chart Example
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action</a>
                                </li>
                                <li><a href="#">Another action</a>
                                </li>
                                <li><a href="#">Something else here</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>3326</td>
                                            <td>10/21/2013</td>
                                            <td>3:29 PM</td>
                                            <td>$321.33</td>
                                        </tr>
                                        <tr>
                                            <td>3325</td>
                                            <td>10/21/2013</td>
                                            <td>3:20 PM</td>
                                            <td>$234.34</td>
                                        </tr>
                                        <tr>
                                            <td>3324</td>
                                            <td>10/21/2013</td>
                                            <td>3:03 PM</td>
                                            <td>$724.17</td>
                                        </tr>
                                        <tr>
                                            <td>3323</td>
                                            <td>10/21/2013</td>
                                            <td>3:00 PM</td>
                                            <td>$23.71</td>
                                        </tr>
                                        <tr>
                                            <td>3322</td>
                                            <td>10/21/2013</td>
                                            <td>2:49 PM</td>
                                            <td>$8345.23</td>
                                        </tr>
                                        <tr>
                                            <td>3321</td>
                                            <td>10/21/2013</td>
                                            <td>2:23 PM</td>
                                            <td>$245.12</td>
                                        </tr>
                                        <tr>
                                            <td>3320</td>
                                            <td>10/21/2013</td>
                                            <td>2:15 PM</td>
                                            <td>$5663.54</td>
                                        </tr>
                                        <tr>
                                            <td>3319</td>
                                            <td>10/21/2013</td>
                                            <td>2:13 PM</td>
                                            <td>$943.45</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.col-lg-4 (nested) -->
                        <div class="col-lg-8">
                            <div id="morris-bar-chart"></div>
                        </div>
                        <!-- /.col-lg-8 (nested) -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-clock-o fa-fw"></i> Timeline
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-badge"><i class="fa fa-check"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Timeline Event</h4>
                                    <p>
                                        <small class="text-muted"><i class="fa fa-time"></i> 11 hours ago via Twitter</small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Timeline Event</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge danger"><i class="fa fa-credit-card"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Timeline Event</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Timeline Event</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge info"><i class="fa fa-save"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Timeline Event</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
                                    <hr>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-cog"></i> 
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Action</a>
                                            </li>
                                            <li><a href="#">Another action</a>
                                            </li>
                                            <li><a href="#">Something else here</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Timeline Event</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge success"><i class="fa fa-thumbs-up"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Timeline Event</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Notifications Panel
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i> New Comment
                            <span class="pull-right text-muted small"><em>4 minutes ago</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small"><em>12 minutes ago</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small"><em>27 minutes ago</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small"><em>43 minutes ago</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small"><em>11:32 AM</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                            <span class="pull-right text-muted small"><em>11:13 AM</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-warning fa-fw"></i> Server Not Responding
                            <span class="pull-right text-muted small"><em>10:57 AM</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                            <span class="pull-right text-muted small"><em>9:49 AM</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-money fa-fw"></i> Payment Received
                            <span class="pull-right text-muted small"><em>Yesterday</em>
                            </span>
                        </a>
                    </div>
                    <!-- /.list-group -->
                    <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
                </div>
                <div class="panel-body">
                    <div id="morris-donut-chart"></div>
                    <a href="#" class="btn btn-default btn-block">View Details</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="chat-panel panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-comments fa-fw"></i>
                    Chat
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li>
                                <a href="#">
                                    <i class="fa fa-refresh fa-fw"></i> Refresh
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check-circle fa-fw"></i> Available
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-times fa-fw"></i> Busy
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-clock-o fa-fw"></i> Away
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> 
                                    <small class="pull-right text-muted">
                                        <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                    </small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix">
                            <span class="chat-img pull-right">
                                <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted">
                                        <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong> 
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                                <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.panel-body -->
                            <div class="panel-footer">
                                <div class="input-group">
                                    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                    <span class="input-group-btn">
                                        <button class="btn btn-warning btn-sm" id="btn-chat">
                                            Send
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <!-- /.panel-footer -->
                        </div>
                        <!-- /.panel .chat-panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        <?php } ?>




        <?php if(config_item('admin_template')=='charisma-master') { ?>
        <!-- template charisma  starts-->


        <div class="sortable row-fluid">
            <a data-rel="tooltip" title="6 new members." class="well span3 top-block" href="#">
                <span class="icon32 icon-red icon-user"></span>
                <div>Total Members</div>
                <div>507</div>
                <span class="notification">6</span>
            </a>

            <a data-rel="tooltip" title="4 new pro members." class="well span3 top-block" href="#">
                <span class="icon32 icon-color icon-star-on"></span>
                <div>Pro Members</div>
                <div>228</div>
                <span class="notification green">4</span>
            </a>

            <a data-rel="tooltip" title="$34 new sales." class="well span3 top-block" href="#">
                <span class="icon32 icon-color icon-cart"></span>
                <div>Sales</div>
                <div>$13320</div>
                <span class="notification yellow">$34</span>
            </a>

            <a data-rel="tooltip" title="12 new messages." class="well span3 top-block" href="#">
                <span class="icon32 icon-color icon-envelope-closed"></span>
                <div>Messages</div>
                <div>25</div>
                <span class="notification red">12</span>
            </a>
        </div>

        <div class="row-fluid">
            <div class="box span12">
                <div class="box-header well">
                    <h2><i class="icon-info-sign"></i> Introduction</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <h1>Charisma <small>free, premium quality, responsive, multiple skin admin template.</small></h1>
                    <p>Its a live demo of the template. I have created Charisma to ease the repeat work I have to do on my projects. Now I re-use Charisma as a base for my admin panel work and I am sharing it with you :)</p>
                    <p><b>All pages in the menu are functional, take a look at all, please share this with your followers.</b></p>

                    <p class="center">
                        <a href="http://usman.it/free-responsive-admin-template" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Back to article</a> 
                        <a href="http://usman.it/free-responsive-admin-template" class="btn btn-large"><i class="icon-download-alt"></i> Download Page</a>
                    </p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row-fluid sortable">
            <div class="box span4">
                <div class="box-header well">
                    <h2><i class="icon-th"></i> Tabs</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#info">Info</a></li>
                        <li><a href="#custom">Custom</a></li>
                        <li><a href="#messages">Messages</a></li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active" id="info">
                            <h3>Charisma <small>a fully featued template</small></h3>
                            <p>Its a fully featured, responsive template for your admin panel. Its optimized for tablet and mobile phones. Scan the QR code below to view it in your mobile device.</p> <img alt="QR Code" class="charisma_qr center" src="img/qrcode136.png" />
                        </div>
                        <div class="tab-pane" id="custom">
                            <h3>Custom <small>small text</small></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at. Nulla tellus elit, varius non commodo eget, mattis vel eros. In sed ornare nulla. Donec consectetur, velit a pharetra ultricies, diam lorem lacinia risus, ac commodo orci erat eu massa. Sed sit amet nulla ipsum. Donec felis mauris, vulputate sed tempor at, aliquam a ligula. Pellentesque non pulvinar nisi.</p>
                        </div>
                        <div class="tab-pane" id="messages">
                            <h3>Messages <small>small text</small></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at. Nulla tellus elit, varius non commodo eget, mattis vel eros. In sed ornare nulla. Donec consectetur, velit a pharetra ultricies, diam lorem lacinia risus, ac commodo orci erat eu massa. Sed sit amet nulla ipsum. Donec felis mauris, vulputate sed tempor at, aliquam a ligula. Pellentesque non pulvinar nisi.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor.</p>
                        </div>
                    </div>
                </div>
            </div><!--/span-->

            <div class="box span4">
                <div class="box-header well" data-original-title>
                    <h2><i class="icon-user"></i> Member Activity</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="box-content">
                        <ul class="dashboard-list">
                            <li>
                                <a href="#">
                                    <img class="dashboard-avatar" alt="Usman" src="http://www.gravatar.com/avatar/f0ea51fa1e4fae92608d8affee12f67b.png?s=50"></a>
                                    <strong>Name:</strong> <a href="#">Usman
                                </a><br>
                                <strong>Since:</strong> 17/05/2012<br>
                                <strong>Status:</strong> <span class="label label-success">Approved</span>                                  
                            </li>
                            <li>
                                <a href="#">
                                    <img class="dashboard-avatar" alt="Sheikh Heera" src="http://www.gravatar.com/avatar/3232415a0380253cfffe19163d04acab.png?s=50"></a>
                                    <strong>Name:</strong> <a href="#">Sheikh Heera
                                </a><br>
                                <strong>Since:</strong> 17/05/2012<br>
                                <strong>Status:</strong> <span class="label label-warning">Pending</span>                                 
                            </li>
                            <li>
                                <a href="#">
                                    <img class="dashboard-avatar" alt="Abdullah" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
                                    <strong>Name:</strong> <a href="#">Abdullah
                                </a><br>
                                <strong>Since:</strong> 25/05/2012<br>
                                <strong>Status:</strong> <span class="label label-important">Banned</span>                                  
                            </li>
                            <li>
                                <a href="#">
                                    <img class="dashboard-avatar" alt="Saruar Ahmed" src="http://www.gravatar.com/avatar/564e1bb274c074dc4f6823af229d9dbb.png?s=50"></a>
                                    <strong>Name:</strong> <a href="#">Saruar Ahmed
                                </a><br>
                                <strong>Since:</strong> 17/05/2012<br>
                                <strong>Status:</strong> <span class="label label-info">Updates</span>                                  
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!--/span-->

            <div class="box span4">
                <div class="box-header well" data-original-title>
                    <h2><i class="icon-list-alt"></i> Realtime Traffic</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div id="realtimechart" style="height:190px;"></div>
                    <p class="clearfix">You can update a chart periodically to get a real-time effect by using a timer to insert the new data in the plot and redraw it.</p>
                    <p>Time between updates: <input id="updateInterval" type="text" value="" style="text-align: right; width:5em"> milliseconds</p>
                </div>
            </div><!--/span-->
        </div><!--/row-->

        <div class="row-fluid sortable">
            <div class="box span4">
                <div class="box-header well" data-original-title>
                    <h2><i class="icon-list"></i> Buttons</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content buttons">
                    <p class="btn-group">
                      <button class="btn">Left</button>
                      <button class="btn">Middle</button>
                      <button class="btn">Right</button>
                  </p>
                  <p>
                    <button class="btn btn-small"><i class="icon-star"></i> Icon button</button>
                    <button class="btn btn-small btn-primary">Small button</button>
                    <button class="btn btn-small btn-danger">Small button</button>
                </p>
                <p>
                    <button class="btn btn-small btn-warning">Small button</button>
                    <button class="btn btn-small btn-success">Small button</button>
                    <button class="btn btn-small btn-info">Small button</button>
                </p>
                <p>
                    <button class="btn btn-small btn-inverse">Small button</button>
                    <button class="btn btn-large btn-primary btn-round">Round button</button>
                    <button class="btn btn-large btn-round"><i class="icon-ok"></i></button>
                    <button class="btn btn-primary"><i class="icon-edit icon-white"></i></button>
                </p>
                <p>
                    <button class="btn btn-mini">Mini button</button>
                    <button class="btn btn-mini btn-primary">Mini button</button>
                    <button class="btn btn-mini btn-danger">Mini button</button>
                    <button class="btn btn-mini btn-warning">Mini button</button>
                </p>
                <p>
                    <button class="btn btn-mini btn-info">Mini button</button>
                    <button class="btn btn-mini btn-success">Mini button</button>
                    <button class="btn btn-mini btn-inverse">Mini button</button>
                </p>
            </div>
        </div><!--/span-->

        <div class="box span4">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-list"></i> Buttons</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content  buttons">
                <p>
                    <button class="btn btn-large">Large button</button>
                    <button class="btn btn-large btn-primary">Large button</button>
                </p>
                <p>
                    <button class="btn btn-large btn-danger">Large button</button>
                    <button class="btn btn-large btn-warning">Large button</button>
                </p>
                <p>
                    <button class="btn btn-large btn-success">Large button</button>
                    <button class="btn btn-large btn-info">Large button</button>
                </p>
                <p>
                    <button class="btn btn-large btn-inverse">Large button</button>
                </p>
                <div class="btn-group">
                    <button class="btn btn-large">Large Dropdown</button>
                    <button class="btn btn-large dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-star"></i> Action</a></li>
                        <li><a href="#"><i class="icon-tag"></i> Another action</a></li>
                        <li><a href="#"><i class="icon-download-alt"></i> Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-tint"></i> Separated link</a></li>
                    </ul>
                </div>

            </div>
        </div><!--/span-->

        <div class="box span4">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-list"></i> Weekly Stat</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list">
                    <li>
                        <a href="#">
                            <i class="icon-arrow-up"></i>                               
                            <span class="green">92</span>
                            New Comments                                    
                        </a>
                    </li>
                    <li>
                        <a href="#">
                          <i class="icon-arrow-down"></i>
                          <span class="red">15</span>
                          New Registrations
                      </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="icon-minus"></i>
                      <span class="blue">36</span>
                      New Articles                                    
                  </a>
              </li>
              <li>
                <a href="#">
                  <i class="icon-comment"></i>
                  <span class="yellow">45</span>
                  User reviews                                    
              </a>
          </li>
          <li>
            <a href="#">
              <i class="icon-arrow-up"></i>                               
              <span class="green">112</span>
              New Comments                                    
          </a>
      </li>
      <li>
        <a href="#">
          <i class="icon-arrow-down"></i>
          <span class="red">31</span>
          New Registrations
      </a>
  </li>
  <li>
    <a href="#">
      <i class="icon-minus"></i>
      <span class="blue">93</span>
      New Articles                                    
  </a>
</li>
<li>
    <a href="#">
      <i class="icon-comment"></i>
      <span class="yellow">254</span>
      User reviews                                    
  </a>
</li>
</ul>
</div>
</div><!--/span-->
</div><!--/row-->




<!-- content ends -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->

<hr>

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>




<!-- template charisma  ends-->
<?php }?>

<?php if(config_item('admin_template')=='metis') { ?>
<div class="text-center">
    <ul class="stats_box">
      <li>
        <div class="sparkline bar_week"></div>
        <div class="stat_text">
          <strong>2.345</strong> Weekly Visit
          <span class="percent down"> <i class="fa fa-caret-down"></i> -16%</span> 
      </div>
  </li>
  <li>
    <div class="sparkline line_day"></div>
    <div class="stat_text">
      <strong>165</strong> Daily Visit
      <span class="percent up"> <i class="fa fa-caret-up"></i> +23%</span> 
  </div>
</li>
<li>
    <div class="sparkline pie_week"></div>
    <div class="stat_text">
      <strong>$2 345.00</strong> Weekly Sale
      <span class="percent"> 0%</span> 
  </div>
</li>
<li>
    <div class="sparkline stacked_month"></div>
    <div class="stat_text">
      <strong>$678.00</strong> Monthly Sale
      <span class="percent down"> <i class="fa fa-caret-down"></i> -10%</span> 
  </div>
</li>
</ul>
</div>
<hr>
<div class="text-center">
    <a class="quick-btn" href="#">
      <i class="fa fa-bolt fa-2x"></i>
      <span>default</span> 
      <span class="label label-default">2</span> 
  </a> 
  <a class="quick-btn" href="#">
      <i class="fa fa-check fa-2x"></i>
      <span>danger</span> 
      <span class="label label-danger">2</span> 
  </a> 
  <a class="quick-btn" href="#">
      <i class="fa fa-building-o fa-2x"></i>
      <span>No Label</span> 
  </a> 
  <a class="quick-btn" href="#">
      <i class="fa fa-envelope fa-2x"></i>
      <span>success</span> 
      <span class="label label-success">-456</span> 
  </a> 
  <a class="quick-btn" href="#">
      <i class="fa fa-signal fa-2x"></i>
      <span>warning</span> 
      <span class="label label-warning">+25</span> 
  </a> 
  <a class="quick-btn" href="#">
      <i class="fa fa-external-link fa-2x"></i>
      <span>π</span> 
      <span class="label btn-metis-2">3.14159265</span> 
  </a> 
  <a class="quick-btn" href="#">
      <i class="fa fa-lemon-o fa-2x"></i>
      <span>é</span> 
      <span class="label btn-metis-4">2.71828</span> 
  </a> 
  <a class="quick-btn" href="#">
      <i class="fa fa-glass fa-2x"></i>
      <span>φ</span> 
      <span class="label btn-metis-3">1.618</span> 
  </a> 
</div>
<hr>
<div class="row">
    <div class="col-lg-8">
      <div class="box">
        <header>
          <h5>Line Chart</h5>
      </header>
      <div class="body" id="trigo" style="height: 250px;"></div>
  </div>
</div>
<div class="col-lg-4">
  <div class="box">
    <div class="body">
      <table class="table table-condensed table-hovered sortableTable">
        <thead>
          <tr>
            <th>Country
              <i class="fa fa-sort"></i>
              <i class="fa fa-sort-asc"></i>
              <i class="fa fa-sort-desc"></i>
          </th>
          <th>Visit
              <i class="fa fa-sort"></i>
              <i class="fa fa-sort-asc"></i>
              <i class="fa fa-sort-desc"></i>
          </th>
          <th>Time
              <i class="fa fa-sort"></i>
              <i class="fa fa-sort-asc"></i>
              <i class="fa fa-sort-desc"></i>
          </th>
      </tr>
  </thead>
  <tbody>
      <tr class="active">
        <td>Andorra</td>
        <td>1126</td>
        <td>00:00:15</td>
    </tr>
    <tr>
        <td>Belarus</td>
        <td>350</td>
        <td>00:01:20</td>
    </tr>
    <tr class="danger">
        <td>Paraguay</td>
        <td>43</td>
        <td>00:00:30</td>
    </tr>
    <tr class="warning">
        <td>Malta</td>
        <td>547</td>
        <td>00:10:20</td>
    </tr>
    <tr>
        <td>Australia</td>
        <td>560</td>
        <td>00:00:10</td>
    </tr>
    <tr>
        <td>Kenya</td>
        <td>97</td>
        <td>00:20:00</td>
    </tr>
    <tr class="success">
        <td>Italy</td>
        <td>2450</td>
        <td>00:10:00</td>
    </tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
      <div class="box">
        <header>
          <h5>Calendar</h5>
      </header>
      <div id="calendar_content" class="body">
          <div id='calendar'></div>
      </div>
  </div>
</div>
</div>
<?php } ?>
