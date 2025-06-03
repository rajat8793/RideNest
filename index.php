<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RideNest - Rent Vehicles & Hire Drivers</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <div class="logo">
      <img src="logo.png" alt="RideNest Logo" />
      <h1>RideNest</h1>
    </div>
    <nav>
      <input type="checkbox" id="nav-toggle" class="nav-toggle" />
      <label for="nav-toggle" class="nav-toggle-label">
        <span></span>
      </label>
      <div class="nav-links">
        <a href="#services">Services</a>
        <a href="#booking">Book Now</a>
        <a href="#about">About Us</a>
        <a href="#contact">Contact</a>
        <?php if (isset($_SESSION['user_id'])): ?>
          <div class="user-menu">
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
            <div class="dropdown">
              <button class="dropbtn">▼</button>
              <div class="dropdown-content">
                <a href="logout.php">Logout</a>
              </div>
            </div>
          </div>
        <?php else: ?>
          <a href="login.html">Login</a>
          <a href="signup.html">Signup</a>
        <?php endif; ?>
        <select id="languageSelect">
          <option>EN</option>
          <option>HI</option>
        </select>
      </div>
    </nav>
  </header>

  <main class="card-section">
    <div class="card">
      <img src="car.png" alt="Car" />
      <h3>Honda City</h3>
      <p><strong>Price:</strong> ₹2000/day</p>
      <p><strong>Location:</strong> Kanpur</p>
      <button onclick="bookNow('Honda City')">Check Availability</button>
    </div>
    <div class="card">
      <img src="bike.png" alt="Bike" />
      <h3>Royal Enfield</h3>
      <p><strong>Price:</strong> ₹900/day</p>
      <p><strong>Location:</strong> Lucknow</p>
      <button onclick="bookNow('Royal Enfield')">Check Availability</button>
    </div>
    <div class="card">
      <img src="driver.png" alt="Driver" />
      <h3>Driver Ramesh</h3>
      <p><strong>Experience:</strong> 5+ years</p>
      <p><strong>Location:</strong> Kanpur</p>
      <button onclick="bookNow('Driver Name')">Check Availability</button>
    </div>
  </main>

    <section id="booking">
      <h2>Book Your Ride</h2>
      <form id="bookingForm" novalidate>
        <input type="text" id="name" name="name" placeholder="Your Name" required />
        <select id="vehicleType" name="vehicleType" required>
          <option disabled selected value="">Select Vehicle Type</option>
          <option>Car</option>
          <option>Bike</option>
          <option>Driver</option>
        </select>
        <input type="text" id="vehicleInput" name="vehicleModel" placeholder="Type Vehicle Model" autocomplete="off" required />
        <div id="suggestions" class="suggestions"></div>
        <input type="date" id="date" name="date" required />
        <input type="text" id="pickupLocation" name="pickupLocation" placeholder="Pickup Location" required />
        <button type="submit">Proceed to Pay</button>
      </form>
    </section>

    <script>
      const vehicleInput = document.getElementById('vehicleInput');
      const suggestions = document.getElementById('suggestions');

      vehicleInput.addEventListener('input', function() {
        const query = this.value.trim();
        if (query.length === 0) {
          suggestions.innerHTML = '';
          return;
        }

        fetch(`../backend/vehicle_search.php?q=${encodeURIComponent(query)}`)
          .then(response => response.json())
          .then(data => {
            suggestions.innerHTML = '';
            if (data.length === 0) {
              suggestions.innerHTML = '<div class="no-suggestion">No matches found</div>';
              return;
            }
            data.forEach(vehicle => {
              const div = document.createElement('div');
              div.classList.add('suggestion-item');
              div.textContent = vehicle;
              div.addEventListener('click', () => {
                vehicleInput.value = vehicle;
                suggestions.innerHTML = '';
              });
              suggestions.appendChild(div);
            });
          })
          .catch(() => {
            suggestions.innerHTML = '<div class="no-suggestion">Error fetching data</div>';
          });
      });

      document.addEventListener('click', function(e) {
        if (!vehicleInput.contains(e.target) && !suggestions.contains(e.target)) {
          suggestions.innerHTML = '';
        }
      });
    </script>

  <section id="services">
    <h2>Our Services</h2>
    <p>Please <a href="login.html">Login</a> or <a href="signup.html">Signup</a> to continue.</p>

    <div class="services-container">
      <div class="service-card">
        <img src="car.png" alt="Car Rental" class="service-icon" />
        <h3>Car Rental</h3>
        <p>Wide range of cars available for rent at affordable prices.</p>
      </div>
      <div class="service-card">
        <img src="bike.png" alt="Bike Rental" class="service-icon" />
        <h3>Bike Rental</h3>
        <p>Rent bikes for city rides or long tours with ease.</p>
      </div>
      <div class="service-card">
        <img src="driver.png" alt="Driver on Demand" class="service-icon" />
        <h3>Driver on Demand</h3>
        <p>Professional drivers available to drive you safely anywhere.</p>
      </div>
      <div class="service-card">
        <img src="car4.png" alt="City Tours" class="service-icon" />
        <h3>City Tours</h3>
        <p>Explore the city with guided tours and comfortable rides.</p>
      </div>
      <div class="service-card">
        <img src="car5.png" alt="Airport Pickups" class="service-icon" />
        <h3>Airport Pickups</h3>
        <p>Reliable airport pickup and drop services for your convenience.</p>
      </div>
    </div>
  </section>

  <section id="about" class="about-section">
    <div class="about-container">
      <div class="about-text">
        <h2>About Us</h2>
        <p>
          RideNest is a trusted rental platform offering vehicles and drivers across India. We focus on user experience, reliability, safety, and convenience...
        </p>
      </div>
      <div class="about-image">
        <img src="about-car.png" alt="About RideNest" />
      </div>
    </div>
  </section>

  <section id="contact">
    <h2>Contact Us</h2>
    <p>📞 Mobile: +91-9876543210</p>
    <p>📧 Email: support@ridenest.com</p>
  </section>

  <section id="map">
    <h2>Find Us</h2>
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.1234567890123!2d80.3318733150487!3d26.449923983345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfd3a1a2b3c4d%3A0x123456789abcdef!2sKanpur%2C%20Uttar%20Pradesh%2C%20India!5e0!3m2!1sen!2sus!4v1680000000000!5m2!1sen!2sus"
      width="100%"
      height="300"
      style="border:0;"
      allowfullscreen=""
      loading="lazy"
    ></iframe>
  </section>

  <section id="feedback">
    <h2>Feedback</h2>
    <textarea id="feedbackText" placeholder="Share your experience with us..." rows="5"></textarea>
    <button id="submitFeedback">Submit Feedback</button>
    <p id="feedbackMessage" class="feedback-message"></p>
  </section>

  <footer>
    <p>&copy; 2025 RideNest. All rights reserved.</p>
    <p>
      <a href="login.html">Login</a> | <a href="signup.html">Signup</a>
    </p>
  </footer>

  <script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('nav a').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);
        if (targetSection) {
          targetSection.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });

    // Booking form validation and submission
    const bookingForm = document.getElementById('bookingForm');
    bookingForm.addEventListener('submit', function(e) {
      e.preventDefault();
      if (!bookingForm.checkValidity()) {
        alert('Please fill out all required fields correctly.');
        return;
      }
      alert('Booking submitted successfully!');
      bookingForm.reset();
      document.getElementById('suggestions').innerHTML = '';
    });

    // Feedback submission handling
    const feedbackBtn = document.getElementById('submitFeedback');
    const feedbackText = document.getElementById('feedbackText');
    const feedbackMessage = document.getElementById('feedbackMessage');

    feedbackBtn.addEventListener('click', () => {
      const feedback = feedbackText.value.trim();
      if (feedback.length === 0) {
        feedbackMessage.textContent = 'Please enter your feedback before submitting.';
        feedbackMessage.style.color = 'red';
        return;
      }
      feedbackMessage.textContent = 'Thank you for your feedback!';
      feedbackMessage.style.color = 'green';
      feedbackText.value = '';
    });

    function bookNow(vehicle) {
      alert("Checking availability for: " + vehicle);
    }
  </script>
</body>
</html>
