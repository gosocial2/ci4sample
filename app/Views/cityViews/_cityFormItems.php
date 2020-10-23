		<div class="row">
			<div class="col-md-6">

				<div class="form-group row">
					<label for="cityName" class="col-md-4 col-form-label">
						City Name
					</label>
					<div class="col-md-7">
						<input type="text" id="cityName" name="city_name" required maxLentgh="60" class="form-control" value="<?=(!empty(set_value('city_name')) ? set_value('city_name') : $city->city_name) ?>">					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<div class="offset-md-4 col-md-8">
						<div class="form-check">

							<label for="enabled" class="col-md-4 col-form-label">
								<input type="checkbox" id="enabled" name="enabled" value="1"  class="form-check-input"<?=$city->enabled== true ? 'checked' : ''; ?>>
								Active
							</label>
						</div><!--//.form-check -->
					</div>

				</div><!--//.form-group -->
			</div><!--//.col -->
			<div class="col-md-6">

				<div class="form-group row">
					<label for="countryCode" class="col-md-4 col-form-label">
						Country
					</label>
					<div class="col-md-7">
						<select id="countryCode" name="country_code" class="form-control select2bs">

							<option value="" selected="selected">Please select a country...</option>
							<?php foreach($countryList as $item) : ?>
							<option value="<?=$item->iso_code ?>"<?=$item->iso_code==$city->country_code ? ' selected':'' ?>>
								<?=$item->country_name ?>
							</option>
							<?php endforeach; ?>
						</select>
						</div><!--//.col -->
				</div><!--//.form-group -->
			</div><!--//.col -->

		</div><!-- //.row -->