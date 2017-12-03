	
$(document).ready(function(){
	$.ajax({
		url: "http://" + window.location.host + "/IS/data/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var column = [];
			var total = [];
			var doughnutCols = [];
			
			for (var i in data){
				var columnLabel = (data[i].course)? data[i].course + " : " + data[i].total : 'Null' + " : " + data[i].total;
				column.push(columnLabel);
				doughnutCols.push((data[i].course)? data[i].course : 'Null');
				total.push(data[i].total);
			}
			var labelTable = 'No of students per course';
			var bgColor = ['rgba(54, 162, 235, 0.5)',
							'rgba(255, 206, 86, 0.5)',
							'rgba(153, 102, 255, 0.5)',
							'rgba(255, 99, 132, 0.5)',
							'rgba(255, 159, 64, 0.5)',
							'rgba(100, 159, 64, 0.5)',
							'rgba(400, 300, 51, 0.5)',
							'rgba(200, 300, 51, 0.5)',
							'rgba(12, 300, 255, 0.5)',
							'rgba(100, 200, 235, 0.5)',
							'rgba(54, 162, 235, 0.5)',
							'rgba(255, 206, 86, 0.5)',
							'rgba(75, 192, 192, 0.5)',
							'rgba(153, 102, 255, 0.5)',
							'rgba(255, 99, 132, 0.5)',
							'rgba(255, 159, 64, 0.5)',
							'rgba(12, 300, 255, 0.5)',
							'rgba(100, 159, 64, 0.5)',
							'rgba(400, 300, 51, 0.5)',
							'rgba(200, 300, 51, 0.5)',
							'rgba(100, 200, 235, 0.5)'
						];
			
			var chartdata = {
				labels: column,
				datasets : [
					{
						label: labelTable,
						backgroundColor: bgColor,
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
						backgroundColor:  bgColor,
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: total
					}
				]
			};

		try{
			var barGraph = new Chart($("#bar_graph"), {
				type: 'bar',
				data: chartdata,
				options: {
				scales: {
					yAxes: [{
						ticks: {
								beginAtZero:true
							}
						}]
					}
				}
			});
			
			var lineGraph = new Chart($("#line_graph"), {
				type: 'line',
				data: chartdata,
				options: {
				scales: {
					yAxes: [{
						ticks: {
								beginAtZero:true
							}
						}]
					}
				}
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
		}catch(e){console.log(e)}
		},
		error: function(data) {
			console.log(data);
		}
	});
});