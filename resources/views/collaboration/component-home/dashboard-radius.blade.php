<div class="diem-danh-lop">
    <h5>Biểu đồ sinh viên vắng của môn học</h5>
    <div>
        <div class="card-body">
            <canvas id="myChartRadian" width="500" height=""></canvas>
        </div>
    </div>
</div>

{{-- DATA --}}
<script>
    var dataRadiantClient = JSON.parse({!! json_encode($countClass) !!});
    var ctxRadian = document.getElementById('myChartRadian');
    var myChartRadian = new Chart(ctxRadian, {
	type: 'doughnut',
	data: {
		labels: dataRadiantClient.labels,
		datasets: [
			{
				label: '# of Votes',
				data: dataRadiantClient.data,
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}
		]
	}
	// options: {
	// scales: {
	// 	yAxes: [
	// 		{
	// 			ticks: {
	// 				beginAtZero: true
	// 			}
	// 		}
	// 	]
	// }
	// }
});

</script>