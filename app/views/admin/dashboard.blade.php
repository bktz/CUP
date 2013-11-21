@extends('admin.layouts.default')

<script type="text/javascript">
	window.onload = function () {
		var chart = new CanvasJS.Chart("chartContainer",
			{
				title:{
					text: "Project States"
				},
				data: [
					{
						type: "doughnut",
						showInLegend: false,
						dataPoints: [
							{  y: {{ $states['Application'] }}, indexLabel: "Application" },
							{  y: {{ $states['Available'] }}, indexLabel: "Available" },
							{  y: {{ $states['InProgress'] }}, indexLabel: "In Progress" },
							{  y: {{ $states['Complete'] }}, indexLabel: "Complete"},
							{  y: {{ $states['Canceled'] }}, indexLabel: "Canceled" },
							{  y: {{ $states['NA'] }}, indexLabel: "N/A"}
						]
					}
				]
			});

		chart.render();
	}
</script>

<div class="container">
	<h1>Admin Dashboard</h1>
	<div id="chartContainer"></div>
</div>