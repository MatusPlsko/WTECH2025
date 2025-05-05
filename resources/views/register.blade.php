@extends()'app')
@section('content')

<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Wrapper div for both image and form -->
                <div class="border p-4 rounded">
                    <!-- Title -->
                    <h2 class="text-center mb-4">Registration</h2>

                    <div class="row d-flex align-items-stretch">
                        <div class="col-md-6 col-lg-6 mb-4 d-flex align-items-center">
                            <!-- Left Image Section -->
                            <img src="../images/registration.jpg" class="img-fluid h-100 w-100 object-fit-cover rounded" alt="Registration Image">
                        </div>
                        <div class="col-md-6 col-lg-6 d-flex align-items-center">
                            <!-- Registration Form -->
                            <form class="w-100">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Enter first name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Enter last name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Enter address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" placeholder="Enter password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
