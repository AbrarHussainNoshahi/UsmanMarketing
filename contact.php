<?php
// Start session if needed
session_start();

// Define variables and error placeholders
$firstName = $lastName = $email = $phone = $message = "";
$firstNameErr = $lastNameErr = $emailErr = $phoneErr = $messageErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    function sanitize($data) {
        return htmlspecialchars(trim($data));
    }

    $firstName = sanitize($_POST["FirstName"] ?? '');
    $lastName = sanitize($_POST["LastName"] ?? '');
    $email = trim($_POST["Email"] ?? '');
    $phone = sanitize($_POST["PhoneNumber"] ?? '');
    $message = sanitize($_POST["Message"] ?? '');

    $isValid = true;

    // Validate each field and store error messages
    if (empty($firstName)) {
        $firstNameErr = "First Name is required.";
        $isValid = false;
    }

    if (empty($lastName)) {
        $lastNameErr = "Last Name is required.";
        $isValid = false;
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "A Valid Email is required.";
        $isValid = false;
    }

    if (empty($phone)) {
        $phoneErr = "Phone Number is required.";
        $isValid = false;
    }

    if (empty($message)) {
        $messageErr = "Please enter your message.";
        $isValid = false;
    }

    if ($isValid) {
        $to = "support@usmandigitalstore.com";
        $subject = "New Contact Message";
        $body = "From: $firstName $lastName\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            echo "<script>alert('Thank you! Your message has been sent successfully.'); window.location.href='contact.php';</script>";
            exit();
            // $successMsg = "Thank you! Your message has been sent successfully.";
            // Clear form after success
            $firstName = $lastName = $email = $phone = $message = "";
        } else {
            $messageErr = "Message failed to send. Try again later.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots"
        content="index, follow, Usman Digital Store, &#99;&#97;&#110;&#118;&#97; pro free, &#99;&#97;&#110;&#118;&#97; premium tool, &#99;&#97;&#110;&#118;&#97; pro free trial">
    <link rel="shortcut icon" href="imgs/ChatGPT_Image_Jun_13__2025__07_00_35_PM-removebg-preview.png"
        type="image/x-icon">
    <link rel="stylesheet" href="./styles/navbar.css">
    <link rel="stylesheet" href="styles/simple_style_page.css">
    <link rel="stylesheet" href="styles/header.css">

    <link rel="stylesheet" href="css/contact_style.css">
    <link rel="stylesheet" href="css/contact_style_responsive.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/countdown.css">
    <link rel="stylesheet" href="styles/responsiveness.css">
    <title>Usman Digital Store - Contact Us</title>

</head>
<style>
    .footer-col .feature-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .footer-col .feature-item {
        display: flex;
        align-items: center;
        white-space: nowrap;
        background: var(--bg-card);
        border-radius: 8px;
        font-size: 10px;
        padding: 15px 8px;
        border: 1px solid var(--border-light);
        transition: all 0.3s ease;
    }

    .footer-col .feature-item:hover {
        background: var(--bg-card-hover);
        transform: translateY(-2px);
    }

    .footer-col .feature-icon {
        font-size: 10px;
        margin: 0;
        color: var(--canva-purple);
    }

    .footer-col .feature-icon::after {
        content: none !important;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .eyebrow {
            font-size: 12px;
            letter-spacing: 1px;
        }

        .policy-section {
            padding: 1.5rem 0;
        }

        .feature-list {
            grid-template-columns: repeat(3);
        }
    }
</style>

<body id="content">
    <div class="sticky-bar" id="stickyBar">
        <div class="bar-section bs-1">
            <div class="icon-circle"><img width="40px"
                    src="imgs/ChatGPT%20Image%20Jun%2013%2c%202025%2c%2007_00_35%20PM.png">
            </div>
            <div class="title-text">Usman Digital Store<br></div>
        </div>

        <div class="bar-section">
            <div class="icon-circle"><img src="imgs/whatsapp-logo.png" width="40px"></div>
            <div>
                <div style="font-size: 14px; color: #aaa;">WhatsApp Number:</div>
                <div class="timer" id="countdown"><a href="https://wa.me/+923284385228">+923284385228</a></div>
            </div>
        </div>

        <div class="button-row">

            <button class="btn header-button">
                <div class="particles"></div>
                <span><a href="https://wa.me/+923284385228">BUY NOW</a></span>
            </button>

        </div>
    </div>

    <!-- Background Effects -->
    <div class="bg-effects">
        <div class="gradient-overlay"></div>
        <div class="noise-overlay"></div>
    </div>

    <div class="content">
        <div class="hamburger-navbar" style="margin-top: 0;">

            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a href="/" class="logo">
                <img src="imgs/ChatGPT_Image_Jun_13__2025__07_00_35_PM-removebg-preview.png">
            </a>
        </div>
        <div class="nav-links-mobile" id="navLinksMobile">
            <button class="close-btn" id="closeBtn">&times;</button>
            <a href="https://usmandigitalstore.com/">Canva Pro</a>
            <a href="./surfshark.html">Surfshark</a>
            <a href="./vidIQ.html">VidIQ</a>
            <a href="./skillshare.html">SkillShare</a>
            <a href="./capcut.html">CapCut Pro</a>
            <a href="./chatgpt.html">ChatGPT Plus</a>
            <a href="./contact.php">Contact Us</a>
        </div>
        <header>
            <a href="https://usmandigitalstore.com/" class="logo"
                style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">
                <img width="70px" src="imgs/ChatGPT_Image_Jun_13__2025__07_00_35_PM-removebg-preview.png">
            </a>
            <div class="navbar-container">

                <nav class="navbar" id="navbar">
                    <ul class="nav-links">
                        <!-- <li><a href="https://usmandigitalstore.com/">Canva Pro</a></li> -->
                        <li><a href="./surfshark.html">Surfshark</a></li>
                        <li><a href="./vidIQ.html">VidIQ</a></li>
                        <li><a href="./skillshare.html">SkillShare</a></li>
                        <li><a href="./capcut.html">CapCut Pro</a></li>
                        <li><a href="./chatgpt.html">ChatGPT Plus</a></li>
                    </ul>
                </nav>
            </div>
            <!-- <div class="button-row">
                <div class="button-container">
                    <button onclick="location.href='#pricing'" class="btn header-button">
                        <div class="particles"></div>
                        <span><a href="#pricing">BUY NOW</a></span>
                    </button>
                </div>
            </div> -->

        </header>

        <div class="landing_page">
            <div class="responsive-container-block big-container">
                <div class="responsive-container-block container">
                    <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12 left-one">
                        <div class="content-box">
                            <p class="text-blk section-head">
                                Usman Digital Store
                            </p>
                            <p class="text-blk section-subhead" style="margin-bottom: 20px;">
                                <strong>Number:</strong> +92 3284385228
                            </p>
                            <p class="text-blk section-subhead">
                                <strong>Address:</strong> Basti Barat Shah, Kasur, Punjab, Pakistan
                            </p>
                            <div class="footer-social">
                                <a href="https://web.facebook.com/usmandigitalstore/" class="social-icon"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/usmandigitalstore1/" style="margin: 0px 20px;"
                                    class="social-icon"><i class="fab fa-instagram"></i></a>
                                <a href="https://x.com/usmandigitlstor" class="social-icon">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="responsive-cell-block wk-ipadp-6 wk-tab-12 wk-mobile-12 wk-desk-6 right-one" id="i1zj">
                        <form class="form-box" method="post" id="contactForm" action="./contact.php">
                            <div class="container-block form-wrapper">
                                <p class="text-blk contactus-head">
                                    <a class="link" href="">
                                    </a>
                                    Get a quote
                                </p>
                                <p class="text-blk contactus-subhead">
                                    We will get back to you in 24 hours
                                </p>
                                <div class="responsive-container-block">

                                        <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                            id="i10mt-7">
                                            <input class="input" id="ijowk-7" name="FirstName" placeholder="First Name">
                                             <div style="color: red; font-size: 12px;"><?= $firstNameErr ?></div>
                                        </div>
                                        <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                            id="i1ro7">
                                            <input class="input" id="indfi-5" name="LastName" placeholder="Last Name">
                                             <div style="color: red; font-size: 12px;"><?= $lastNameErr ?></div>
                                        </div>
                                        <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-6 wk-ipadp-6 emial"
                                            id="ityct">
                                            <input class="input" id="ipmgh-7" name="Email" placeholder="Email">
                                             <div style="color: red; font-size: 12px;"><?= $emailErr ?></div>
                                        </div>
                                        <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                            <input class="input" id="imgis-6" name="PhoneNumber" placeholder="Phone Number">
                                             <div style="color: red; font-size: 12px;"><?= $phoneErr ?></div>
                                        </div>
                                        <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                            id="i634i-7">
                                            <textarea name="Message" aria-placeholder="Type message here" class="textinput" id="i5vyy-7"
                                                placeholder="Type message here"></textarea>
                                                 <div style="color: red; font-size: 12px;"><?= $messageErr ?></div>
                                        </div>
                                        <button class="submit-btn btn" type="submit">
                                            Get quote
                                        </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <!-- Background Glow Effects -->
            <div class="footer-glow footer-glow-left"></div>
            <div class="footer-glow footer-glow-right"></div>

            <div class="footer-container">
                <div class="footer-grid">

                    <!-- Column 1: About -->
                    <div class="footer-col">
                        <div class="footer-logo">
                            <img width="80px" src="imgs/ChatGPT_Image_Jun_13__2025__07_00_35_PM-removebg-preview.png"
                                alt="Logo">
                        </div>
                        <p class="footer-tagline">
                            🚀 Instant Access to Canva Pro, CapCut, Figma, VidIQ, Surfshark & More – All in One Place.
                            <br>
                        </p>
                        <div class="feature-list">
                            <div class="feature-item">
                                <span class="feature-icon">🔐</span>
                                <span>100% Secure</span>
                            </div>
                            <div class="feature-item">
                                <span class="feature-icon">⚡</span>
                                <span> No Hassle</span>
                            </div>
                            <div class="feature-item">
                                <span class="feature-icon">💸</span>
                                <span>Unbeatable Prices</span>
                            </div>
                        </div>
                        <div class="button-row">
                            <!-- Neon Button -->
                            <div class="button-container">
                                <button onclick="location.href='#pricing'" class="btn header-button">
                                    <div class="particles"></div>
                                    <span><a href="#pricing">BUY NOW</a></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Quick Links -->
                    <div class="footer-col">
                        <h3 class="footer-heading">Quick Links</h3>
                        <ul class="footer-links">
                            <li class="footer-link-item"><a href="https://usmandigitalstore.com/"
                                    class="footer-link">Canva Pro</a>
                            <li class="footer-link-item"><a href="./surfshark.html" class="footer-link">Surfshark</a>
                            </li>
                            </li>
                            <li class="footer-link-item"><a href="./vidIQ.html" class="footer-link">VidIQ</a></li>
                            <li class="footer-link-item"><a href="skillshare.html" class="footer-link">SkillShare</a>
                            </li>
                            <li class="footer-link-item"><a href="./capcut.html" class="footer-link">CapCut Pro</a></li>
                            <li class="footer-link-item"><a href="./chatgpt.html" class="footer-link">ChatGPT Plus</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Column 3: Contact -->
                    <div class="footer-col">
                        <h3 class="footer-heading">Support</h3>

                        <div class="contact-info">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <span class="contact-text"><a
                                    href="mailto:support@usmandigitalstore.com"><span>support@usmandigitalstore.com</span></a></span>
                        </div>

                        <div class="contact-info">
                            <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                            <a href="https://wa.me/+923284385228" class="contact-text" target="_blank">
                                WhatsApp: +92 3284385228</a>
                        </div>

                        <div class="footer-social">
                            <a href="https://web.facebook.com/usmandigitalstore/" class="social-icon"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/usmandigitalstore1/" class="social-icon"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="https://x.com/usmandigitlstor" class="social-icon">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>

                    <div class="footer-col">
                        <h3 class="footer-heading">Customer Care</h3>
                        <ul class="footer-links">
                            <li class="footer-link-item"><a href="privacypolicy.html" class="footer-link">Privacy</a>
                            </li>
                            <li class="footer-link-item"><a href="terms.html" class="footer-link">Terms</a></li>
                            <li class="footer-link-item"><a href="refundpolicy.html" class="footer-link">Refund</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="footer-bottom">
                <p class="footer-copyright">
                    &copy; 2025 Usman Digital Store. All rights reserved.
                </p>

                <!-- <div class="footer-bottom-links">
                        <a class="footer-bottom-link" href="privacypolicy.html">Privacy</a>
                        <a class="footer-bottom-link" href="terms.html">Terms</a>
                        <a class="footer-bottom-link" href="refundpolicy.html">Refund</a>
                    </div> -->
            </div>
        </footer>


        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </div>

    <!-- GSAP, Lenis and ScrollTrigger CDN -->
    <!-- Add to your HTML head -->
    <script src="./script/lenis.min.js"></script>
    <script src="./script/gsap.min.js"></script>
    <script src="./script/ScrollTrigger.min.js"></script>
    <script src="script/vslcontainer%20-%20Copy.js"></script>
    <script src="./script/swiper-bundle.min.js"></script>


</body>


</html>