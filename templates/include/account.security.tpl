<fieldset>
	<legend>Change Username</legend>
	<div class="form-group">
		<label for="username" class="col-sm-2 control-label">Username</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ account.username }}" disabled>
			<p class="help-block">You cannot change your username at the moment.</p>
		</div>
	</div>
</fieldset>

<fieldset>
	<legend>Change Email Address</legend>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ account.email }}">
		</div>
	</div>

	<div class="form-group">
		<label for="confirmEmail" class="col-sm-2 control-label">Confirm Email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="confirmEmail" name="confirmEmail" placeholder="Email" value="{{ account.email }}">
		</div>
	</div>
</fieldset>

<fieldset>
	<legend>Change Password</legend>
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">New Password</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
		</div>
	</div>
	<div class="form-group">
		<label for="confirmPassword" class="col-sm-2 control-label">Confirm New Password</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Password">
		</div>
	</div>
</fieldset>