
$(document).ready(function(){
	$.ajax({
		url: "http://localhost:8081/IS/data/data-drug.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var column = [];
			var total = [];
			
			var arrCols = data[0].columns.split(',');
			console.log(arrCols);
			for (var i = 0; i < arrCols.length ; i++){
				var columnLabel = (arrCols[i] != 'dummy')? arrCols[i] + " : " + data[0][arrCols[i]] : ' ';
				column.push(columnLabel);
				total.push(data[0][arrCols[i]]);
				console.log(total);
			}
			
			
			var chartdata = {
				labels: column,
				datasets : [
					{
						label: 'Drug Products',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: total
					}
				]
			};

			var ctx = $("#graph_canvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});