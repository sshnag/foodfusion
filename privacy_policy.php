<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FoodFusion | Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/design.css"> 
  <link rel="icon" type="image/png" href="images/food.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Noto+Serif:wght@600&display=swap" rel="stylesheet">
</head>
<body>
   <?php include'elements/navigation.php' ?>
    <div class="container policy-container">
        <h1 class="text-center mb-5">Privacy Policy</h1>
        
        <div class="policy-section">
            <h2>Information We Collect</h2>
            <p>We collect information that you provide directly to us, including:</p>
            <ul>
                <li>Name and contact information when you create an account</li>
                <li>Profile information and preferences</li>
                <li>Recipe submissions and comments</li>
                <li>Communications with us</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>How We Use Your Information</h2>
            <p>We use the information we collect to:</p>
            <ul>
                <li>Provide and maintain our services</li>
                <li>Process your recipe submissions</li>
                <li>Send you updates and notifications</li>
                <li>Improve our website and services</li>
                <li>Respond to your comments and questions</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>Information Sharing</h2>
            <p>We do not sell or rent your personal information to third parties. We may share your information:</p>
            <ul>
                <li>With your consent</li>
                <li>To comply with legal obligations</li>
                <li>To protect our rights and safety</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>Data Security</h2>
            <p>We implement appropriate security measures to protect your personal information. However, no method of transmission over the Internet is 100% secure.</p>
        </div>

        <div class="policy-section">
            <h2>Your Rights</h2>
            <p>You have the right to:</p>
            <ul>
                <li>Access your personal information</li>
                <li>Correct inaccurate information</li>
                <li>Request deletion of your information</li>
                <li>Opt-out of marketing communications</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>Updates to This Policy</h2>
            <p>We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page.</p>
        </div>

        <div class="policy-section">
            <h2>Contact Us</h2>
            <p>If you have any questions about this privacy policy, please contact us at <a href="<privacy@foodfusion.com href="mailto:example@email.com?subject=Subject%20of%20Email&body=Body%20of%20Email">privacy@foodfusion.com</a></p>
        </div>
    </div>

    <?php include 'elements/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>