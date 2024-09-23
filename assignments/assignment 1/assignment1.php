<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Project</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
  <h1 class="mt-5 mb-4">Form Project ~~ Assignment 1 ~~</h1>
  
  <!-- Bootstrap Form -->
  <form class="row g-3" method="post" action="#">
    
    <!-- First and Last Name -->
    <div class="col-md-4">
      <label for="firstName" class="form-label">First name</label>
      <input type="text" class="form-control" id="firstName" required>
    </div>
    <div class="col-md-4">
      <label for="lastName" class="form-label">Last name</label>
      <input type="text" class="form-control" id="lastName" required>
    </div>

    <!-- Address -->
    <div class="col-md-12">
      <label for="address" class="form-label">Address</label>
      <input type="text" class="form-control" id="address" required>
    </div>

    <!-- City, State, and ZIP -->
    <div class="col-md-6">
      <label for="city" class="form-label">City</label>
      <input type="text" class="form-control" id="city" required>
    </div>
    <div class="col-md-3">
      <label for="state" class="form-label">State</label>
      <select class="form-select" id="state" required>
        <option value="OH">Ohio</option>
        <option value="CA">California</option>
        <option value="MI" selected>Michigan</option> <!-- Michigan as default -->
        <option value="TX">Texas</option>
        <option value="FL">Florida</option>
      </select>
    </div>
    <div class="col-md-3">
      <label for="zip" class="form-label">Zip</label>
      <input type="text" class="form-control" id="zip" required>
    </div>

    <!-- Options (Radio buttons) -->
    <div class="col-md-12">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="terms" id="option1" value="option1" required>
        <label class="form-check-label" for="option1">Option 1</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="terms" id="option2" value="option2" required>
        <label class="form-check-label" for="option2">Option 2</label>
      </div>
      <div class="invalid-feedback">
        You must select one option before Registering.
      </div>
    </div>

    <!-- Register Button -->
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Register</button>
    </div>
  </form>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
