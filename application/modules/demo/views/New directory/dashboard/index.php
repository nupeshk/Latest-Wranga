<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-md-8 col-sm-6 col-xs-7">
                <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-5">
                <!--<a href="employees-add.html" class="btn btn-info">Add Employee</a>-->
            </div>
        </div>
        <!--/.row -->
        <div class="row">
            <div class="col-lg-4 col-sm-4 col-xs-12">
                <a href="<?php echo base_url(); ?>admin/users" class="analytics-info">
                    <div class="pull-left">
                        <div class="img-circle iconbox"><span><i class="fa fa-users"></i></span></div>
                    </div>
                    <div class="pull-left">
                        <p>Users</p>
                        <h2><?php echo $total_users; ?></h2>
                        <!--<span class="text-megna">Total Active </span>-->
                    </div>
                </a>
            </div>
            <?php /*?><div class="col-lg-4 col-sm-4 col-xs-12">
                <a href="hosts.html" class="analytics-info">
                    <div class="pull-left">
                        <div class="img-circle iconbox"><span><i class="fa fa-calendar"></i></span></div>
                    </div>
                    <div class="pull-left">
                        <p>Purchases</p>
                        <h2>500</h2>
                        <!--<span class="text-megna">200 Remittances Recorded</span>-->
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-4 col-xs-12">
                <a href="bartenders.html" class="analytics-info">
                    <div class="pull-left">
                        <div class="img-circle iconbox"><span><i class="fa fa-money"></i></span></div>
                    </div>
                    <div class="pull-left">
                        <p>Revenue</p>
                        <h2>240900</h2>
                        <!--<span class="text-megna">Total Active</span>-->
                    </div>
                </a>
            </div><?php */ ?>
        </div>
        <div class="row" >
			<div class="white-box">
				<div class="clearfix">
					<p class="box-title pull-left"><b><?php echo $orderGraphTitle;?></b></p>
					<form class="form-inline pull-right" action="" method="GET">
						<div class="form-group">
							<select class="form-control" id="days" name="days" onchange="getGraph()"> 
								<?php
								$limitArr = array("1" => "15", "2" => "30");
								foreach ($limitArr as $k => $lim) {
									?>
									<option value="<?php echo $lim; ?>" <?php echo (!empty($_GET['d']) && ($_GET['d'] == $lim)) ? "selected" : "" ?>><?php echo $lim; ?></option>
								<?php } ?>      
							</select>
						</div>
					</form>
				</div>
				<div id="orderChart"></div>
			</div>

		</div>
        
    </div>
    <!-- /.container-fluid -->
</div>

<script>
	$(function () {
		Highcharts.chart('orderChart', {
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: ['<?php echo implode("','", $xAxis) ?>']
            },
            yAxis: {
                title: {
                    text: 'Values'
                }
            },
            legend: {
                layout: 'horizontal',
                align: 'right',
                verticalAlign: 'top'
            },
            credits: {
              enabled: false
          }, 
          series: [{
            name: 'Transactions',
            data: [<?php echo implode(',', $orderAxis) ?>],
            color: '#006157',
            type: 'area'
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
    });
    function getGraph() {
        var days = $('#days').val();
        var query = "d=" + days;
        //alert(query);return false;
        window.location.href = "<?php echo base_url()?>admin/dashboard?" + query;
    }
</script>

