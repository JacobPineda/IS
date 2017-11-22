
$(document).ready(function(){
	$.ajax({
		url: "http://" + window.location.host + "/IS/data/data-drug.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var column = [];
			var total = [];
			var doughnutCols = [];
			
			var arrCols = data[0].columns.split(',');
			console.log("arr" + arrCols);
			for (var i = 0; i < arrCols.length ; i++){
				var columnLabel = ((arrCols[i] != 'dummy')? arrCols[i] + " : " + data[0][arrCols[i]] : ' ');
				column.push(columnLabel);
				doughnutCols.push((arrCols[i] != 'dummy')? arrCols[i]: ' ' );
				total.push(data[0][arrCols[i]]);
				console.log(total);
			}
			
			
			var chartdata = {
				labels: column,
				datasets : [
					{
						label: 'Drug Products',
						backgroundColor:  [
							'rgba(54, 162, 235, 0.5)',
							'rgba(255, 206, 86, 0.5)',
							'rgba(75, 192, 192, 0.5)',
							'rgba(153, 102, 255, 0.5)',
							'rgba(255, 99, 132, 0.5)',
							'rgba(255, 159, 64, 0.5)'
						],
						borderColor: 'rgba(200, 200, 200, 1)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: total
					}
				]
			};
			
			var doughnutData = {
				labels: doughnutCols,
				datasets : [
					{
						label: 'Drug Products',
						backgroundColor:  [
							'rgba(54, 162, 235, 0.5)',
							'rgba(255, 206, 86, 0.5)',
							'rgba(75, 192, 192, 0.5)',
							'rgba(153, 102, 255, 0.5)',
							'rgba(255, 99, 132, 0.5)',
							'rgba(255, 159, 64, 0.5)'
						],
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: total
					}
				]
			};


			var barGraph = new Chart($("#bar_graph"), {
				type: 'bar',
				data: chartdata
			});
			
			var lineGraph = new Chart($("#line_graph"), {
				type: 'line',
				data: chartdata
			});
			var doughnutGraph = new Chart($("#doughnut_graph"), {
				type: 'doughnut',
				data: doughnutData
			});				
			var radarGraph = new Chart($("#radar_graph"), {
				type: 'radar',
				data: chartdata
			});	
			var polarAreaGraph = new Chart($("#polarArea_graph"), {
				type: 'polarArea',
				data: doughnutData
			});	
		},
		error: function(data) {
			console.log(data);
		}
	});
});