<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Heart Disease Prediction</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url("https://i.pinimg.com/736x/d4/05/55/d405555eb81ce6c883ca7eee76b487a5.jpg");
        background-size: cover;
        color: #333;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .title-bar {
        background: rgba(255, 255, 255, 0.8);
        width: 100%;
        text-align: center;
        padding: 20px 0;
        font-size: 2.5em;
        font-weight: bold;
        position: relative;
      }
      .beating-heart {
        width: 100px; /* Adjust size as needed */
        margin: 20px 0;
      }
      .description {
        background: rgba(255, 255, 255, 0.9); /* Translucent background */
        padding: 30px 50px;
        width: 100%; /* Full width */
        max-width: 100%; /* Limit maximum width */
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        margin-top: 0px; /* Space below heart */
        position: relative; /* Keep in flow of the document */
      }
      form {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        max-width: 600px; /* Smaller form */
        margin: 20px auto; /* Space above and below */
      }
      .form-row {
        display: flex; /* Use flex to arrange labels and inputs */
        justify-content: space-between; /* Space between labels and inputs */
        margin-bottom: 15px; /* Space between form groups */
      }
      .form-group {
        flex: 1; /* Allow equal spacing */
        margin-right: 10px; /* Space between the two groups */
      }
      .form-group:last-child {
        margin-right: 0; /* Remove margin from the last group */
      }
      label {
        display: block; /* Block display for labels */
        font-weight: bold;
        margin-bottom: 5px; /* Space below the label */
        text-align: left; /* Align labels to the left */
      }
      input[type="number"] {
        width: 100%; /* Full-width inputs */
        padding: 12px;
        border: 2px solid #ccc;
        border-radius: 5px;
        transition: border 0.3s;
        box-sizing: border-box; /* Include padding and border in width */
      }
      input[type="number"]:focus {
        border: 2px solid #28a745;
        outline: none;
      }
      .form-group input,
    .form-group select {
      padding: 8px 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      width: 100%;
      box-sizing: border-box;
    }
      input[type="submit"] {
        background: #28a745;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.1em;
        transition: background 0.3s;
        width: 100%; /* Full-width submit button */
      }
      input[type="submit"]:hover {
        background: #218838;
      }
      .footer {
        margin-top: 40px; /* More space between content and footer */
        padding: 10px 0; /* Padding for footer */
        background-color: rgba(0, 0, 0, 0.6); /* Dark background for contrast */
        color: white;
        font-size: 1em;
        text-align: center;
      }

      /* New Container for form and solution box */
      .form-solution-container {
        display: flex;
        justify-content: space-between;
        width: 80%; /* Adjust the width of the container as needed */
        max-width: 1200px;
        margin-top: 40px;
        padding: 20px;
        gap: 20px;
        margin-left: auto;
        margin-right: auto;
      }

      .side-box {
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        width: 60%;
        margin-left: 20px;
        position: sticky;
        top: 100px;
        border-radius: 10px;
      }

      .side-box h2 {
        font-size: 1.5em;
        margin-bottom: 20px;
      }

      .slideshow-container {
        position: relative;
        width: 100%;
        height: auto;
        margin-bottom: 20px;
        overflow: hidden;
        border-radius: 8px;
      }

      .mySlides {
        display: none;
        width: 100%;
        height: 100%;
        object-fit: contain;
      }

      .side-box button {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 1em;
      }

      .side-box button:hover {
        background-color: #218838;
      }

      .slideshow-container img {
        width: 100%;
        height: auto;
        object-fit: block;
      }
    </style>
  </head>
  <body>
    <div class="title-bar">Cardio Check</div>
    <div
      class="tenor-gif-embed"
      data-postid="19987573"
      data-share-method="host"
      data-aspect-ratio="1"
      data-width="10%"
    >
      <a href="https://tenor.com/view/heart-heartbeat-gif-19987573"
        >Heart Heartbeat GIF</a
      >from <a href="https://tenor.com/search/heart-gifs">Heart GIFs</a>
    </div>

    <script
      type="text/javascript"
      async
      src="https://tenor.com/embed.js"
    ></script>

    <div class="description">
      <p>
        Now days, Heart disease is the most common disease. But, unfortunately
        the treatment of heart disease is somewhat costly that is not affordable
        by common man. Hence, we can reduce this problem in some amount just by
        predicting heart disease before it becomes dangerous using Heart Disease
        Prediction System Using Machine Learning and Data mining. If we can find
        out heart disease problem in early stages then it becomes very helpful
        for treatment. Machine Learning and Data Mining techniques are used for
        the construction of Heart Disease Prediction System. In healthcare
        biomedical field, there is large use of heath care data in the form of
        text, images, etc but, that data is hardly visited and is not mined. So,
        we can avoid this problem by introducing Heart Disease Prediction
        System. This system will help us reduce the costs and to enhance the
        quality treatment of heart patients. This system can able to identify
        complex problems and can able to take intelligent medical decisions. The
        system can predict likelihood of patients of getting heart problems by
        their profiles such as blood pressure, age, sex, cholesterol and blood
        sugar. Also, the performance will be compared by calculation of
        confusion matrix. This can help to calculate accuracy, precision, and
        recall. The overall system provides high performance and better
        accuracy.
      </p>
    </div>

    <!-- Updated Container with Dropdown Options -->
    <div class="form-solution-container">
      <form action="submit.php" method="post">
        <div class="form-row">
          <div class="form-group">
            <label for="age"><i class="fas fa-calendar-alt icon"></i> Age:</label>
            <input type="number" name="age" min="0" placeholder="Your age.." required />
          </div>
          <div class="form-group">
            <label for="sex"><i class="fas fa-venus-mars icon"></i> Sex:</label>
            <select id="sex" name="sex" required>
              <option value="" selected>----select option----</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="cp"><i class="fas fa-heartbeat icon"></i> Chest Pain Type:</label>
            <select id="cp" name="cp" required>
              <option value="" selected>----select option----</option>
              <option value="0">Typical Angina</option>
              <option value="1">Atypical Angina</option>
              <option value="2">Non-anginal Pain</option>
              <option value="3">Asymptomatic</option>
            </select>
          </div>
          <div class="form-group">
            <label for="trestbps"><i class="fas fa-stethoscope icon"></i> Resting Blood Pressure:</label>
            <input type="number" name="trestbps" placeholder="A number in range [94-200] mmHg" required />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="chol"><i class="fas fa-pills icon"></i> Cholesterol:</label>
            <input type="number" name="chol" placeholder="A number in range [126-564] mg/dl" required />
          </div>
          <div class="form-group">
            <label for="fbs"><i class="fas fa-blood icon"></i> Fasting Blood Sugar:</label>
            <select id="fbs" name="fbs" required>
              <option value="" selected>----select option----</option>
              <option value="1">Greater than 120 mg/dl</option>
              <option value="0">Less than 120 mg/dl</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="restecg"><i class="fas fa-heartbeat icon"></i> Resting ECG Results:</label>
            <select id="restecg" name="restecg" required>
              <option value="" selected>----select option----</option>
              <option value="0">Normal</option>
              <option value="1">Having ST-T wave abnormality</option>
              <option value="2">Probable or definite left ventricular hypertrophy</option>
            </select>
          </div>
          <div class="form-group">
            <label for="thalach"><i class="fas fa-heart icon"></i> Maximum Heart Rate:</label>
            <input type="number" name="thalach" placeholder="A number in range [71-202] bpm" required />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="exang"><i class="fas fa-running icon"></i> Exercise-induced Angina:</label>
            <select id="exang" name="exang" required>
              <option value="" selected>----select option----</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>
          <div class="form-group">
            <label for="oldpeak"><i class="fas fa-angle-double-down icon"></i> Oldpeak:</label>
            <input type="number" step="0.1" name="oldpeak" placeholder="ST depression, typically in [0-6.2]" required />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="slope"><i class="fas fa-angle-up icon"></i> Slope of the ST Segment:</label>
            <select id="slope" name="slope" required>
              <option value="" selected>----select option----</option>
              <option value="0">Upsloping</option>
              <option value="1">Flat</option>
              <option value="2">Downsloping</option>
            </select>
          </div>
          <div class="form-group">
            <label for="ca"><i class="fas fa-vial icon"></i> Number of Major Vessels:</label>
            <input type="number" name="ca" placeholder="Typically in [0-4]" required />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="thal"><i class="fas fa-dna icon"></i> Thalassemia:</label>
            <select id="thal" name="thal" required>
              <option value="" selected>----select option----</option>
              <option value="0">Normal</option>
              <option value="1">Fixed Defect</option>
              <option value="2">Reversible Defect</option>
            </select>
          </div>
        </div>
        <input type="submit" value="Submit" />
      </form>
    


      <!-- Side Box Section -->
      <div class="side-box">
        <h2>Heart Disease Solution</h2>

        <!-- Slideshow -->
        <div class="slideshow-container">
          <img class="mySlides" src="img/Walk.jpg" alt="Walking" />
          <img class="mySlides" src="img/cycle.jpg" alt="Cycling" />
          <img class="mySlides" src="img/yoga.webp" alt="Yoga" />
          <img class="mySlides" src="img/swim.jpg" alt="Swimming" />
        </div>

        <button onclick="window.location.href='solution.php'">
          Go to Solution
        </button>
      </div>
    </div>

    <div class="footer">
      &copy; 2024 Heart Disease Prediction. All rights reserved.
    </div>

    <!-- Slideshow Script -->
    <script>
      let slideIndex = 0;

      function showSlides() {
        let slides = document.getElementsByClassName("mySlides");
        for (let i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
          slideIndex = 1;
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 2000); // Change image every 2 seconds
      }

      showSlides(); // Initialize the slideshow
    </script>
  </body>
</html>
