<?php

	require_once('dbconfig.php');
	global $con;
	$id = $_POST['id'];

	if(empty($id))
	{
		?><div class="text-center">no records found under this selection <a href="#" onclick="$('#link-add').hide();$('#show-add').show(700);">Hide this</a></div>
		<?php
		die();
	}

	$query = "SELECT * FROM students where id='$id'";
	if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	while($row = mysqli_fetch_assoc($result))
	{
		?>
		<div class="form-inline" id="edit-data">
			<div class="form-group col-md-3">
				<input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" placeholder="Name" class="form-control" required />
			</div>
			<div class="form-group col-md-3">
				<input type="text" name="age" id="age" placeholder="age" class="form-control" value="<?php echo $row['age']; ?>" required/>
			</div>
			<div class="form-group col-md-3">
				<input type="text" id="address" name="address" placeholder="address" class="form-control" value="<?php echo $row['address']; ?>" required />
			</div>


			<div class="form-group col-md-3">
				<input type="text" id="nic" name="nic" placeholder="nic" class="form-control" value="<?php echo $row['nic']; ?>" required />
			</div>



			<div class="form-group col-md-3">
			<button type="button" class="btn btn-primary update" id="<?php echo $row['id']; ?>" name="update">Update Record</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" name="add" onclick="$('#link-add').slideUp(400);$('#show-add').show(700);">Cancel</button>
		</div>
	<?php
	}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        var name = $('#name').val();
        var age = $('#age').val();
        var address = $('#address').val();
        var nic = $('#nic').val();

        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id, name: name, age: age, address: address, nic: nic},
            success: function(data, status, xhr) {
                $('#name').val('');
                $('#age').val('');
                $('#address').val('');
                $('#nic').val('');
                $('#records_content').fadeOut(1100).html(data);
                $.get("view.php", function(html) {
                    $("#table_content").html(html);
                });
                $('#records_content').fadeOut(1100).html(data);
            },
            complete: function() {
                $('#link-add').hide();
                $('#show-add').show(700);
            }
        });
    }); // update close
</script>