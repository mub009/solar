<h1 class="page-title"> Dashboard
	<!--<small>statistics, charts, recent events and reports</small>-->
</h1>





<div class="row">
    <?php
	if($AdminPrivilege)
	{
	?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="1349"><?=$this->data['Country_Admin_count']?></span>
                                        </div>
                                        <div class="desc">Total Admin </div>
                                    </div>
                                </a>
                            </div>
                            <?php
	}
	else
	{
	?>
	    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="1349"><?=$this->data['country_admin_Dealer_count']?></span>
                                        </div>
                                        <div class="desc">Total Dealer </div>
                                    </div>
                                </a>
                            </div>
                            	<?php
}

?>
	
	
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="12,5"><?=$this->data['product_count']?></span></div>
                                        <div class="desc">Total Product </div>
                                    </div>
                                </a>
                            </div>
                            
                             <?php
	if($AdminPrivilege)
	{
	?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549"><?=$this->data['admin_customer_count']?></span>
                                        </div>
                                        <div class="desc">Total Customer</div>
                                    </div>
                                </a>
                            </div>
                            <?php
	}
	else
	{
	?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549"><?=$this->data['country_admin_customer_count']?></span>
                                        </div>
                                        <div class="desc">Total Customer</div>
                                    </div>
                                </a>
                            </div>  
                    	<?php
}

?>        
                            
          
                       <?php
	if($AdminPrivilege)
	{
	?>                  
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                    <div class="visual">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number"> +
                                            <span data-counter="counterup" data-value="89"><?=$this->data['admin_vendor_count']?></div>
                                        <div class="desc">Total Vendor</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                         <?php
	}
	else
	{
	?>
	    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                    <div class="visual">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number"> +
                                            <span data-counter="counterup" data-value="89"><?=$this->data['country_admin_vendor_count']?></div>
                                        <div class="desc">Total Vendor</div>
                                    </div>
                                </a>
                            </div>
                        </div>
		<?php
}

?>        
	


<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>


var chartData;

$(document).ready(function () {

$.ajax({
    type: "GET",
    url: "<?=base_url('backend/admin/dashboard/country_via_customer_list')?>",
    dataType: "json",
    success: function (Response) {


am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
chart.data =  Response['list'];
       
        

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.minGridDistance = 40;
categoryAxis.fontSize = 11;

 var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
 valueAxis.min = 0;
 valueAxis.max=Number(Response['max'].max);

valueAxis.strictMinMax = true;
valueAxis.renderer.minGridDistance = 30;
// axis break
var axisBreak = valueAxis.axisBreaks.create();

axisBreak.startValue = 2100;
axisBreak.endValue = 22900;
axisBreak.breakSize = 0.005;

// make break expand on hover
var hoverState = axisBreak.states.create("hover");
hoverState.properties.breakSize = 1;
hoverState.properties.opacity = 0.1;
hoverState.transitionDuration = 1500;

axisBreak.defaultState.transitionDuration = 1000;


// this is exactly the same, but with events
axisBreak.events.on("over", function() {
  axisBreak.animate(
    [{ property: "breakSize", to: 1 }, { property: "opacity", to: 0.1 }],
    1500,
    am4core.ease.sinOut
  );
});
axisBreak.events.on("out", function() {
  axisBreak.animate(
    [{ property: "breakSize", to: 0.005 }, { property: "opacity", to: 1 }],
    1000,
    am4core.ease.quadOut
  );
});

var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryX = "country";
series.dataFields.valueY = "visits";
series.columns.template.tooltipText = "{valueY.value}";
series.columns.template.tooltipY = 0;
series.columns.template.strokeOpacity = 0;

// as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

}); // end am4core.ready()


    }
}); 


});

</script>


<div class="row">
                                    <div class="col-md-12">
                                        <!-- BEGIN CHART PORTLET-->
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-bar-chart font-green-haze"></i>
                                                    <span class="caption-subject bold uppercase font-green-haze">Customer Count</span>
                                                    <span class="caption-helper">column and line mix</span>
                                                </div>
                                                <div class="tools">

                                                    <a href="javascript:;" class="reload" data-original-title="" title=""> </a>

                                                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">

                                            <div id="chartdiv"></div>
                                            
                                            </div>
                                        </div>
                                        <!-- END CHART PORTLET-->
                                    </div>
                                </div>


                        
<!--<div class="row">-->
<!--	<div class="col-lg-6 col-xs-12 col-sm-12">-->
<!--		<div class="portlet light ">-->
<!--			<div class="portlet-title">-->
<!--				<div class="caption">-->
<!--					<span class="caption-subject bold uppercase font-dark">Revenue</span>-->
<!--					<span class="caption-helper">distance stats...</span>-->
<!--				</div>-->
<!--				<div class="actions">-->
<!--					<a class="btn btn-circle btn-icon-only btn-default" href="#">-->
<!--						<i class="icon-cloud-upload"></i>-->
<!--					</a>-->
<!--					<a class="btn btn-circle btn-icon-only btn-default" href="#">-->
<!--						<i class="icon-wrench"></i>-->
<!--					</a>-->
<!--					<a class="btn btn-circle btn-icon-only btn-default" href="#">-->
<!--						<i class="icon-trash"></i>-->
<!--					</a>-->
<!--					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="portlet-body">-->
<!--				<div id="dashboard_amchart_1" class="CSSAnimationChart" style="overflow: hidden; text-align: left;">-->
<!--					<div class=