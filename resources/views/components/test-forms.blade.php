<section class="mb-5 pt-5" id="forms">
			<div class="bg-light py-4 mb-5">
				<div class="container">
					<div class="d-flex justify-content-between">
							<h2>
								<span class="fa fa-pencil mr-1"></span>
								Forms
							</h2>
							<h2>
								
									<a href="https://getbootstrap.com/docs/4.1/components/forms/" target="_blank"
									data-toggle="tooltip" data-placement="bottom" title="Form docs"><span class="fa fa-book fw"></span></a>
								
									<a href="https://getbootstrap.com/docs/4.1/components/input-group/" target="_blank"
									data-toggle="tooltip" data-placement="bottom" title="Input group docs"><span class="fa fa-book fw"></span></a>
								
								<a href="#top" class="ml-3"><span class="fa fa-chevron-up fw"></span></a>
							</h2>
					</div>

				</div>
			</div>
			<div class="container">
				<form>
	<div class="row px-5">
		<div class="col-md-6">
			<h3 class="mt-5">Text fields</h3>
			<div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" placeholder="Readonly input" readonly>
			</div>
			<div class="form-group">
				<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Readonly input as plain text">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Disabled input" disabled>
			</div>
			<div class="form-group">
				<label for="validText">Valid input</label>
				<input type="text" class="form-control is-valid" id="validText" value="Valid input">
			</div>
			<div class="form-group">
				<label for="invalidText">Invalid input</label>
				<input type="text" class="form-control is-invalid" id="invalidText" value="Invalid input">
				<div class="invalid-feedback">Please provide a valid value.</div>
			</div>
			<div class="form-group">
				<input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" placeholder="Default input">
			</div>
			<div class="form-group">
				<input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
			</div>
			<div class="form-group">
				<div class="input-group input-group-lg">
					<div class="input-group-prepend">
						<span class="input-group-text">$</span>
					</div>
					<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
					<div class="input-group-append">
						<span class="input-group-text">.00</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">$</span>
					</div>
					<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
					<div class="input-group-append">
						<span class="input-group-text">.00</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<button class="btn btn-secondary" type="button">Hate it</button>
					</div>
					<input type="text" class="form-control" placeholder="Product name" aria-label="Product name">
					<div class="input-group-append">
						<button class="btn btn-secondary" type="button">Love it</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<input type="text" class="form-control" aria-label="Text input with dropdown button">
					<div class="input-group-append">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
							<div role="separator" class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Separated link</a>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1">Example textarea</label>
				<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
			</div>

			<h3 class="mt-5">Layouts</h3>
			<div class="form-group">
				<div class="row">
					<div class="col">
						<input type="text" class="form-control" placeholder="Row / input 1">
					</div>
					<div class="col">
						<input type="text" class="form-control" placeholder="Row / input 2">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="form-row">
					<div class="col">
						<input type="text" class="form-control" placeholder="Form row / input 1">
					</div>
					<div class="col">
						<input type="text" class="form-control" placeholder="Form row / input 2">
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-4 col-form-label">Horizontal</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="inputEmail3" placeholder="form layout">
				</div>
			</div>
			<div class="form-group">
				<div class="form-inline">
					<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Inline input 1">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend">
							<span class="input-group-text">@</span>
						</div>
						<input type="text" class="form-control" placeholder="Inline input 2">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="form-inline">
					<div class="form-group">
						<label for="inputPassword6">Password</label>
						<input type="password" id="inputPassword6" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
						<small id="passwordHelpInline" class="text-muted">Must be 8-20 characters long.</small>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<h3 class="mt-5">Selects</h3>
			<div class="form-group">
				<label for="exampleFormControlSelect1">Example select</label>
				<select class="form-control" id="exampleFormControlSelect1">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleFormControlSelect2">Example multiple select</label>
				<select multiple class="form-control" id="exampleFormControlSelect2">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
			<div class="form-group">
				<select class="form-control form-control-lg">
					<option>Large select</option>
				</select>
			</div>
			<div class="form-group">
				<select class="form-control">
					<option>Default select</option>
				</select>
			</div>
			<div class="form-group">
				<select class="form-control form-control-sm">
					<option>Small select</option>
				</select>
			</div>
			<div class="form-group">
				<select class="custom-select">
					<option selected>Custom select</option>
					<option value="1">One</option>
					<option value="2">Two</option>
					<option value="3">Three</option>
				</select>
			</div>

			<h3 class="mt-5">Checkboxes</h3>
			<div class="form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" value="">
					Option one is this and that&mdash;be sure to include why it's great
				</label>
			</div>
			<div class="form-check disabled">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" value="" disabled>
					Option two is disabled
				</label>
			</div>
			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="customCheck1">
				<label class="custom-control-label" for="customCheck1">Custom checkbox</label>
			</div>
			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="customCheck2">
				<label class="custom-control-label" for="customCheck2">Custom checkbox</label>
			</div>
			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="customCheck3" disabled>
				<label class="custom-control-label" for="customCheck3">Disabled custom checkbox</label>
			</div>
			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input is-valid" id="customCheck4">
				<label class="custom-control-label" for="customCheck4">Valid custom checkbox</label>
			</div>
			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input is-invalid" id="customCheck5">
				<label class="custom-control-label" for="customCheck5">Invalid custom checkbox</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> 1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> 2
				</label>
			</div>
			<div class="form-check form-check-inline disabled">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled> 3
				</label>
			</div>

			<h3 class="mt-5">Radio buttons</h3>
			<div class="form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
					Option one is this and that&mdash;be sure to include why it's great
				</label>
			</div>
			<div class="form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
					Option two can be something else and selecting it will deselect option one
				</label>
			</div>
			<div class="form-check disabled">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
					Option three is disabled
				</label>
			</div>
			<div class="custom-control custom-radio">
				<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
				<label class="custom-control-label" for="customRadio1">Custom radio</label>
			</div>
			<div class="custom-control custom-radio">
				<input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
				<label class="custom-control-label" for="customRadio2">Custom radio</label>
			</div>
			<div class="custom-control custom-radio">
				<input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" disabled>
				<label class="custom-control-label" for="customRadio3">Disabled custom radio</label>
			</div>
			<div class="custom-control custom-radio">
				<input type="radio" id="customRadio4" name="customRadio" class="custom-control-input is-valid">
				<label class="custom-control-label" for="customRadio4">Valid radio</label>
			</div>
			<div class="custom-control custom-radio">
				<input type="radio" id="customRadio5" name="customRadio" class="custom-control-input is-invalid">
				<label class="custom-control-label" for="customRadio5">Invalid radio</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
				</label>
			</div>
			<div class="form-check form-check-inline disabled">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled> 3
				</label>
			</div>
		</div>
	</div>
</form>

			</div>
		</section>