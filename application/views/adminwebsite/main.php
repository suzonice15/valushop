<?php $this->load->view('adminwebsite/header'); ?>
<?php $this->load->view('adminwebsite/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php if (isset($main)) echo $main; ?>
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
           <!-- <li><a href="#"> <?php if (isset($second)) echo $second; ?></a></li> -->
            <li class="active"><?php if (isset($active)) echo $active; ?></li>
        </ol>
    </section>
<br>


    <!-- Main content -->

    <section class="content" style="height: auto">
		<div class="row">

        <?php //$message = $this->session->userdata('message');
		$message = $this->session->flashdata('message');
        if (isset($message)) {
            ?>
			<div class="row">
		<div class="col-md-offset-1 col-md-7">
            <div id="fadeout" class="alert alert-success alert-dismissable text-left" >
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
				<h4><i class="icon fa fa-check"></i> Success!!!</h4>
                <?php

                echo $message;

                ?>
            </div>
            </div>
            </div>
            <?php
        }
        ?>
        
         <?php //$message = $this->session->userdata('message');
		$message = $this->session->flashdata('error');
        if (isset($message)) {
            ?>
			<div class="row">
		<div class="col-md-offset-1  col-md-7">
            <div id="fadeout" class="alert alert-danger alert-dismissable text-left" >
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Failed!!!</h4>
                <?php

                echo $message;

                ?>
            </div>
            </div>
            </div>
            <?php
        }
        ?>

		<?php //$message = $this->session->userdata('message');
$relationMessage=$this->session->userdata('relationMessage');
		if (isset($relationMessage)) {
			?>
		<div class="row">
			<div class="col-md-offset-1  col-md-7">

			<div id="fadeout" class="alert alert-info alert-dismissable text-left">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
				<h4><i class="icon fa fa-check "></i> Success!!!</h4>
				<?php

				echo $relationMessage;
                                $this->session->unset_userdata('relationMessage');

				?>
			</div>
			</div>
			</div>
			<?php
		}
		?>

        <?php if (isset($pageContent)) {
            echo $pageContent;
        } ?>
		</div>
    </section>

    <!-- /.content -->
</div>
<?php $this->load->view('adminwebsite/footer'); ?>
