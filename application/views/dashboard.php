<div class="col-md-offset-0 col-md-12">
<div class="box  box-success ">
	<div class="box-header with-border">
	</div>
		<div class="row">
			<div class="col-md-3">
				<div class="info-box  bg-green">
					<span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Teachers</span>
						<span class="info-box-number">
							<?php if(isset($teachers)){
								echo count($teachers);

							}?>
							</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-md-3 ">
				<div class="info-box bg-green">
					<span class="info-box-icon bg-yellow"><i class="fa fa-flag-o"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Students</span>

						<span class="info-box-number">

							<?php if(isset($students[0])){
								echo $students[0]->student;

							}?>
						</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>

			<div class="col-md-3 ">
				<div class="info-box bg-green">
					<span class="info-box-icon bg-warning"><i class="fa fa-files-o"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Today absent</span>
						<span class="info-box-number">
							<?php if(isset($absence[0])){
								echo $absence[0]->absence;
							}
							?>

						</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<div class="col-md-3 ">
				<div class="info-box bg-green">
					<span class="info-box-icon bg-danger"><i class="fa fa-files-o"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Today present</span>
						<span class="info-box-number">
								<?php if(isset($pasent[0])){
									echo $pasent[0]->pasent;

								}
								?>
						</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
</div>
	<div class="container">

		<h1>Holiday calender</h1>

		<div class="row">



				<div id="calendar"></div>


		</div>

	</div>
		</div>
</div>


<script type="text/javascript">

$(function () {
	var events = <?php echo json_encode($event) ?>;



	var date = new Date()

	var d    = date.getDate(),

		m    = date.getMonth(),

		y    = date.getFullYear()



	$("#calendar").fullCalendar({

		header    : {

			left  : 'prev,next today',

			center: 'title',

			right : 'month,agendaWeek,agendaDay'

		},

		buttonText: {

			today: 'today',

			month: 'month',

			week : 'week',

			day  : 'day'

		},

		events    : events

	})
});



</script>



