<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
<?php $satings= $this->db->get('satinge')->row();?>
<h1 align="center">
<?php echo  $satings->satinge_name; ?>
</h1>
<div class="container">
<div class="row">
	<div class="col-md-3">
		<img  src="<?php echo base_url();echo $satings->satinge_logo;?>"/>
	</div>
	<div class="col-md-5">
		<h5><?php echo $satings->satinge_name; ?></h5>
		<h5><?php echo $satings->satinge_slug; ?></h5>
	</div>
	<div class="col-md-4">
		<h5>Name:<?php echo $students[0]->student_name; ?></h5>
		<h5>Student:<?php echo $students[0]->classreg_section_name; ?></h5>
		<h5>Examsession:<?php echo $students[0]->exam_session_name; ?></h5>
	</div>
</div>
<div class="row">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th scope="col">Id</th>
			<th scope="col">Subject</th>
			<th scope="col">Mark</th>
			<th scope="col">GradePOint</th>
			<th scope="col">GPA</th>
		</tr>
		</thead>
		<tbody>
		<?php  $i=1; foreach($students as $student):?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $student->subject_name; ?></td>
			<td><?php echo $student->mark_obtained; ?></td>
			<td><?php echo $student->mark_grade_point; ?></td>
			<td><?php echo $student->mark_gpa; ?></td>

		</tr>
		<?php $i++; endforeach;?>
		<tr>
			<td><?php echo $i;?></td>
			<td>Total</td>
			<td><?php echo $finalmark;?></td>
			<td><?php echo $finalGpa;?></td>
			<td><?php echo $gradePoint;?></td>

		</tr>
		</tbody>
	</table>
</div>
</div>


