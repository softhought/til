$(document).ready(function () {
	var basepath = $("#basepath").val();

	loadGraph();


	loadRenewalGraph();
	
	// $(document).on("click","#mclick",function(){
	// 	var type = $(this).attr("data-type");
	// 	 if(type=='month_conversion')
	// 	{
	// 		// $("#tt").text("month_conversion");
	// 		var title = "This Month Conversion"
	// 	}else if(type=='payment')
	// 	{
	// 		// $("#tt").text("payment");
	// 		var title = "This Month Payment Recived"
	// 	}
	// 	$("#tt").text(title);
	// 	$('#month_conversion_list').html('');
    //     $("#lodar").show();

    //     $.ajax({
    //         type: "POST",
    //         url: basepath + 'dashboard/getDashboard',
    //         dataType: "html",
    //         data: { type:type,},
    //         success: function(result) {
				
	// 			$("#lodar").css("display","none");
                
    //             $("#month_conversion_list").html(result);

    //         },
    //         error: function(jqXHR, exception) {
    //             var msg = '';
    //             if (jqXHR.status === 0) {
    //                 msg = 'Not connect.\n Verify Network.';
    //             } else if (jqXHR.status == 404) {
    //                 msg = 'Requested page not found. [404]';
    //             } else if (jqXHR.status == 500) {
    //                 msg = 'Internal Server Error [500].';
    //             } else if (exception === 'parsererror') {
    //                 msg = 'Requested JSON parse failed.';
    //             } else if (exception === 'timeout') {
    //                 msg = 'Time out error.';
    //             } else if (exception === 'abort') {
    //                 msg = 'Ajax request aborted.';
    //             } else {
    //                 msg = 'Uncaught Error.\n' + jqXHR.responseText;
    //             }

    //             // alert(msg);  

    //         }

    //     }); /*end ajax call*/

	// });


});

function loadGraph() {

	var basepath = $("#basepath").val();

	am5.ready(function () {

		var root = am5.Root.new("chartdiv");
		root.setThemes([
			am5themes_Animated.new(root)
		]);

		var chart = root.container.children.push(am5xy.XYChart.new(root, {
			panX: false,
			panY: false,
			wheelX: "panX",
			wheelY: "zoomX",
			layout: root.verticalLayout
		}));

		var legend = chart.children.push(
			am5.Legend.new(root, {
				centerX: am5.p50,
				x: am5.p50
			})
		);
		var test = '';
		$.ajax({
			type: 'POST',
			url: basepath + 'dashboard/chartView',
			dataType: "json",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			data: {
				test: test
			},
			success: function (response) {

				console.log(response.details);
				var detailsdata = {};
				var tempdata = [];
				var totalpreg = 0;
				for (var i = 0; i < response.details.length; i++) {
					totalpreg = totalpreg + parseInt(response.details[i]);

					var potential_customer = parseInt(response.details[i].potential_count);
					var converted_investor = parseInt(response.details[i].converted_investor);

					var Parsent_Investsor = 0;
					if (potential_customer > 0 && converted_investor > 0) {
						Parsent_Investsor = ((converted_investor * 100) / potential_customer);
					}

					var investor = parseFloat(Parsent_Investsor).toFixed(2);

					console.log(typeof (+investor) + 5 + investor);

					detailsdata = {
						"investor_parcent": response.details[i].month_name + " " + investor + "%",
						"potential_customer": response.details[i].potential_count,
						"converted_investor": response.details[i].converted_investor,
					}
					tempdata.push(detailsdata);
				}

				data = tempdata;
				/**Label in vartical  */
				var xRenderer = am5xy.AxisRendererX.new(root, {
					minGridDistance: 30
				});
				xRenderer.labels.template.setAll({
					rotation: -90,
					centerY: am5.p50,
					centerX: am5.p100,
				});

				var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
					maxDeviation: 0.3,
					categoryField: "investor_parcent",
					renderer: xRenderer,
					tooltip: am5.Tooltip.new(root, {})
				}));

				xAxis.data.setAll(data);

				var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
					renderer: am5xy.AxisRendererY.new(root, {})
				}));

				function makeSeries(name, fieldName) {
					var series = chart.series.push(am5xy.ColumnSeries.new(root, {
						name: name,
						xAxis: xAxis,
						yAxis: yAxis,
						valueYField: fieldName,
						categoryXField: "investor_parcent"
					}));

					series.columns.template.setAll({
						tooltipText: "{name}, {categoryX}:{valueY}",
						width: am5.percent(90),
						tooltipY: 0
					});

					series.data.setAll(data);

					series.appear();

					series.bullets.push(function () {
						return am5.Bullet.new(root, {
							locationY: 0,
							sprite: am5.Label.new(root, {
								text: "{valueY}",
								fill: root.interfaceColors.get("alternativeText"),
								centerY: 0,
								centerX: am5.p50,
								populateText: true
							})
						});
					});

					legend.data.push(series);
				}

				makeSeries("Potential Customer", "potential_customer");
				makeSeries("Converted Investor Conversion", "converted_investor");

				chart.appear(1000, 100);




			},
			error: function (jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				//  alert(msg);  
			}
		});

	}); // end am5.ready()

}


function loadRenewalGraph() {

	var basepath = $("#basepath").val();

	am5.ready(function () {

		var root = am5.Root.new("renewalchart");
		root.setThemes([
			am5themes_Animated.new(root)
		]);

		var chart = root.container.children.push(am5xy.XYChart.new(root, {
			panX: true,
			panY: true,
			wheelX: "panX",
			wheelY: "zoomX",
			pinchZoomX: true,
			layout: root.verticalLayout,
		}));

		var scrollbarX = am5.Scrollbar.new(root, {
			orientation: "horizontal"
		});

		scrollbarX.startGrip.setAll({
			visible: true
		});

		scrollbarX.endGrip.setAll({
			visible: true
		});

		chart.set("scrollbarX", scrollbarX);
		chart.topAxesContainer.children.push(scrollbarX);

		// chart.zoomOutButton.set("forceHidden", true);

		var legend = chart.children.push(
			am5.Legend.new(root, {
				centerX: am5.p50,
				x: am5.p50
			})
		);


		var test = '';
		$.ajax({
			type: 'POST',
			url: basepath + 'dashboard/renewalChartView',
			dataType: "json",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			data: {
				test: test
			},
			success: function (response) {

				console.log(response.details);
				var detailsdata = {};
				var tempdata = [];
				var totalpreg = 0;
				for (var i = 0; i < response.details.length; i++) {
					totalpreg = totalpreg + parseInt(response.details[i]);

					var total_renewal = parseInt(response.details[i].total_renewal);
					var renewal_sucess = parseInt(response.details[i].renewal_sucess);
					var wing_back = parseInt(response.details[i].wing_back);

					var Parsent_renewal = 0;
					if (total_renewal > 0 && renewal_sucess > 0) {
						Parsent_renewal = ((renewal_sucess * 100) / total_renewal);
					}

					var renewal_investor = parseFloat(Parsent_renewal).toFixed(2);

					// console.log(typeof(+investor)+5+investor);
					var investor_parcent = 0;
					if (wing_back > 0) {
						investor_parcent ="(" + renewal_investor + "%" +"+" + wing_back +")";
					} else {
						investor_parcent = renewal_investor + "%";
					}
						// alert(parcent_wing);

					detailsdata = {
						"month":response.details[i].month_name,
						"investor_parcent": response.details[i].investor_parcent,
						"total_renewal": response.details[i].total_renewal,
						"renewal_sucess":response.details[i].renewal_sucess,
					}
					tempdata.push(detailsdata);
				}

				data = tempdata;
				/**Label in vartical  */
				var xRenderer = am5xy.AxisRendererX.new(root, {
					minGridDistance: 30
				});
				xRenderer.labels.template.setAll({
					rotation: -90,
					centerY: am5.p50,
					centerX: am5.p100,
					cellStartLocation: 0.1,
					cellEndLocation: 0.9
				});

				var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
					maxDeviation: 0.3,
					categoryField: "month",
					renderer: xRenderer,
					tooltip: am5.Tooltip.new(root, {})
				}));
				/**************************end */
				xAxis.data.setAll(data);

				var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
					renderer: am5xy.AxisRendererY.new(root, {})

				}));

				/******************************************************************************************* */
				function makeSeries1(name, fieldName) {
					var series = chart.series.push(am5xy.ColumnSeries.new(root, {
						name: name,
						xAxis: xAxis,
						yAxis: yAxis,
						valueYField: fieldName,
						categoryXField: "month"
					}));

					series.columns.template.setAll({
						//tooltipText: "{name}, {categoryX}:{valueY}",
						tooltipText: "{categoryX} , {valueY}",
						width: am5.percent(80),
						tooltipY: 0
					});


					series.data.setAll(data);
					/**************************************************************************/
					series.columns.template.set("fillGradient", am5.LinearGradient.new(root, {
						stops: [{
							color: am5.color(0xa367dc)
						}, {
							color: am5.color(0xa367dc)
						}],
						rotation: 90
					}));

					series.columns.template.setAll({
						strokeOpacity: 0
					});

					series.appear();

					series.bullets.push(function () {
						return am5.Bullet.new(root, {
							locationY: 0,
							sprite: am5.Label.new(root, {
								text: "{valueY}",
								fill: root.interfaceColors.get("alternativeBackground"),
								centerY: 0,
								centerX: am5.p50,
								populateText: true
							})
						});
					});

					legend.data.push(series);
				}


				/******************************************************************************************* */
				function makeSeries2(name, fieldName) {
					var series = chart.series.push(am5xy.ColumnSeries.new(root, {
						name: name,
						xAxis: xAxis,
						yAxis: yAxis,
						valueYField: fieldName,
						categoryXField: "month",
						
					}));

					series.columns.template.setAll({
						//tooltipText: "{name}, {categoryX}:{valueY}",
						tooltipText: "{substring(categoryX,0,2)}, {valueY}",
						width: am5.percent(80),
						tooltipY: 0
					});


					series.data.setAll(data);

					series.columns.template.set("fillGradient", am5.LinearGradient.new(root, {
						stops: [{
							color: am5.color(0x4A00E0)
						}, {
							color: am5.color(0x4A00E0)
						}],
						rotation: 90
					}));

					series.columns.template.setAll({
						strokeOpacity: 0
					});

					series.appear();
					/**************************************************************************** */
					series.bullets.push(function () {
						return am5.Bullet.new(root, {
							locationY: 0,
							sprite: am5.Label.new(root, {
								text: "{valueY}",
								fill: root.interfaceColors.get("alternativeBackground"),
								centerY: 0,
								centerX: am5.p50,
								populateText: true
							})
						});
					});

					legend.data.push(series);
				}

				makeSeries1("Renewal List", "total_renewal");
				makeSeries2("Renewal Sucess","renewal_sucess");

				chart.appear(1000, 100);




			},
			error: function (jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				//  alert(msg);  
			}
		});

	}); // end am5.ready()



}
