@extends('app')
@section('content')
<main >
  <div class="container py-5 about-page">
    <div class="row justify-content-center text-center">
      <div class="col-12">
        <h2>About Us</h2>
      </div>
    </div>

    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="../images/about.jpg" alt="About Us Image" class="img-fluid rounded">
      </div>

      <div class="col-md-6">
        <div class="row">
          <div class="col-12 mb-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-lightbulb-fill me-3" style="font-size: 30px;"></i>
              <div>
                <h4>Passion for fitness</h4>
                <p>We started with a simple goal: helping people achieve their fitness dreams by offering the best supplements. Every product is designed to push your performance and support your goals.</p>
              </div>
            </div>
          </div>

          <div class="col-12 mb-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-person-fill me-3" style="font-size: 30px;"></i>
              <div>
                <h4>Nutrition for your growth</h4>
                <p>Our products are crafted using top-notch ingredients to ensure effective results. We focus on quality, because we believe the right nutrition is key to your fitness journey.</p>
              </div>
            </div>
          </div>

          <div class="col-12 mb-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-gear-fill me-3" style="font-size: 30px;"></i>
              <div>
                <h4>Us and our planet</h4>
                <p>Sustainability is at our core. We care about both your health and the planet, using eco-friendly practices to ensure we protect what matters most.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
