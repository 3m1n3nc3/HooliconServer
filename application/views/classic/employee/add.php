<div class="container account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<?= form_open('employee/add', ['method' => 'post'])?> 
			<h1>Add Employee</h1>		
			
			<div class="add-fields">

				<div class="field">
					<label for="employee_username">Username:</label>
					<input type="text" id="username" name="username" required value="<?php echo set_value('username') ?>" placeholder="Username"/>
					<?php echo form_error('username'); ?> 
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="text" id="password" name="password" required value="<?php echo set_value('password') ?>" placeholder="Password"/>
					<?php echo form_error('password'); ?> 
				</div> <!-- /password -->

				<div class="field">
					<label for="employee_firstname">First name:</label>
					<input type="text" id="firstname" name="firstname" required value="<?php echo set_value('firstname') ?>" placeholder="Firstname"/>
					<?php echo form_error('firstname'); ?> 
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_lastname">Last name:</label>
					<input type="text" id="lastname" name="lastname" required value="<?php echo set_value('lastname') ?>" placeholder="Lastname"/>
					<?php echo form_error('lastname'); ?> 
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_telephone">Telephone:</label>
					<input type="text" id="telephone" name="telephone" value="<?php echo set_value('telephone') ?>" placeholder="Telephone"/>
					<?php echo form_error('telephone'); ?> 
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_email">Email:</label>
					<input type="text" id="email" name="email" required value="<?php echo set_value('email') ?>" placeholder="Email"/>
					<?php echo form_error('email'); ?> 
				</div> <!-- /field -->

				<div class="field">
					<label for="department_id">Department:</label>
					<select id="department_id" name="department_id">
					<?php foreach ($departments as $dept): ?>
						<option value="<?=$dept->department_id?>"<?php echo set_select('department_id', $dept->department_id) ?>><?=$dept->department_name?></option>
					<?php endforeach; ?>
					</select> 
					<?php echo form_error('department_id'); ?> 
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_type">Employee Type:</label>
					<input type="text" id="type" name="type" required value="<?php echo set_value('type') ?>" placeholder="Employee Type"/>
					<?php echo form_error('type'); ?> 
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_salary">Employee Salary:</label>
					<input type="text" id="salary" name="salary" required value="<?php echo set_value('salary') ?>" placeholder="Employee Salary"/>
					<?php echo form_error('salary'); ?> 
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_hiring_date">Employee Hiring Date:</label>
					<input type="date" id="hiring_date" name="hiring_date" required value="<?php echo set_value('hiring_date') ?>" placeholder="Employee Hiring Date"/>
					<?php echo form_error('hiring_date'); ?> 
				</div> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Add</button>
				
			</div> <!-- .actions -->
		<?= form_close()?>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>
