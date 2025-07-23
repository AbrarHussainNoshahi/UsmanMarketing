<?php
$productData = [
    'canva' => [
        [ 'id' => 1, 'name' => 'Canva Pro Spark', 'price' => 299 ],
        [ 'id' => 2, 'name' => 'Canva Pro Flow', 'price' => 599 ],
        [ 'id' => 3, 'name' => 'Canva Pro Legacy', 'price' => 1299 ],
    ],
    'surfshark' => [
        [ 'id' => 1, 'name' => 'Surfshark Lite Plan', 'price' => 300 ],
        [ 'id' => 2, 'name' => 'Surfshark Plus Plan', 'price' => 700 ],
        [ 'id' => 3, 'name' => 'Surfshark Premium Plan', 'price' => 1500 ],
    ],
    'vidiq' => [
        [ 'id' => 1, 'name' => 'vidIQ Boost (1-Month Private Plan)', 'price' => 800 ]
    ],
    'skillshare' => [
        [ 'id' => 1, 'name' => 'Skillshare Shared Plan', 'price' => 500 ],
        [ 'id' => 2, 'name' => 'Skillshare Private Plan', 'price' => 899 ]
    ],
    'capcut' => [
        [ 'id' => 1, 'name' => 'CapCut Lite Plan', 'price' => 600 ],
        [ 'id' => 2, 'name' => 'CapCut Desktop Plan', 'price' => 2000 ],
        [ 'id' => 3, 'name' => 'CapCut Premium Plan', 'price' => 9500 ],
    ],
    'chatgpt' => [
        [ 'id' => 1, 'name' => 'GPT-4 Semi-Private Plan', 'price' => 1499 ],
        [ 'id' => 2, 'name' => 'GPT-4 Private Plan', 'price' => 4000 ],
    ],
];

$product = $_GET['product'] ?? null;
$id = $_GET['id'] ?? null;

$matchedProduct = null;


if ($product && $id && isset($productData[$product])) {
    foreach ($productData[$product] as $item) {
        if ($item['id'] == $id) {
            $matchedProduct = $item;
            break;
        }
    }
}

    $emailError = "";
    $firstNameError = "";
    $lastNameError = "";
    $countryError = "";
    $addressError = "";
    $cityError = "";
    $stateError = "";
    $zipError = "";

$product_name = $matchedProduct['name'] ?? null;
$product_price = $matchedProduct['price'] ?? null;


// if ($matchedProduct) {
//     echo "ID: " . $matchedProduct['id'] . "<br>";
//     echo "Name: " . $matchedProduct['name'] . "<br>";
//     echo "Price: " . $matchedProduct['price'] . "<br>";
// } else {
//     echo "Product not found";
// }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    // Collect and sanitize inputs
    $email = sanitize($_POST['email']);
    $firstName = sanitize($_POST['FirstName']);
    $lastName = sanitize($_POST['LastName']);
    $country = sanitize($_POST['selection']);
    $address = sanitize($_POST['Address']);
    $apartment = sanitize($_POST['Appartment'] ?? '');
    $city = sanitize($_POST['TownCity']);
    $state = sanitize($_POST['StateCounty']);
    $zip = sanitize($_POST['ZipCode']);
    $phone = sanitize($_POST['PhoneNumber'] ?? '');

    // Initialize individual error variables


    $hasErrors = false;

    // Individual validation
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Valid Email is required.";
        $hasErrors = true;
    }

    if (empty($firstName)) {
        $firstNameError = "First name is required.";
        $hasErrors = true;
    }

    if (empty($lastName)) {
        $lastNameError = "Last name is required.";
        $hasErrors = true;
    }

    if ($country == "select") {
        $countryError = "Country must be selected.";
        $hasErrors = true;
    }

    if (empty($address)) {
        $cityError = "Address is required.";
        $hasErrors = true;
    }

    if (empty($city)) {
        $cityError = "City is required.";
        $hasErrors = true;
    }

    if (empty($state)) {
        $stateError = "State is required.";
        $hasErrors = true;
    }

    if (empty($zip)) {
        $zipError = "Zip code is required.";
        $hasErrors = true;
    }
    // if ($hasErrors) {
    //     echo "<h3>Form Errors:</h3><ul>";
    //     if ($emailError) echo "<li>$emailError</li>";
    //     if ($firstNameError) echo "<li>$firstNameError</li>";
    //     if ($lastNameError) echo "<li>$lastNameError</li>";
    //     if ($countryError) echo "<li>$countryError</li>";
    //     if ($cityError) echo "<li>$cityError</li>";
    //     if ($stateError) echo "<li>$stateError</li>";
    //     if ($zipError) echo "<li>$zipError</li>";
    //     echo "</ul>";
    //     exit;
    // }


    // ---------------------
    // Admin Email
    // ---------------------
    $adminEmail = "support@usmandigitalstore.com";
    $subjectAdmin = "New Order: $product_name";
    $messageAdmin = "
    New Order Received:

    Customer Email: $email
    Name: $firstName $lastName
    Country: $country
    Address: $address
    Apartment: $apartment
    City: $city
    State: $state
    Zip: $zip
    Phone: $phone

    Product: $product_name
    Price: $product_price PKR
    ";

    $headersAdmin = "From: no-reply@usmandigitalstore.com\r\n";
    $headersAdmin .= "Reply-To: $email\r\n";

    // ---------------------
    // Customer Email
    // ---------------------
    $subjectCustomer = "Thanks for your order, $firstName!";
    $messageCustomer = "
    Dear $firstName,

    Thank you for your order of $product_name. We’ve received your information and are processing your order.

    Order Summary:
    --------------------
    Product: $product_name
    Total: $product_price PKR

    We will contact you shortly with more details.

    Best regards,  
    The Usman Digital Services
    ";

    $headersCustomer = "From: support@usmandigitalstore.com\r\n";
    $headersCustomer .= "Reply-To: support@usmandigitalstore.com\r\n";
    // ---------------------
    // Send Emails
    // ---------------------
    $adminSent = mail($adminEmail, $subjectAdmin, $messageAdmin, $headersAdmin);
    $customerSent = mail($email, $subjectCustomer, $messageCustomer, $headersCustomer);

    if ($adminSent && $customerSent) {
         echo "<script>alert('Order Placed Successfully.'); window.location.href = 'index.html'</script>";
        // echo "<h3>Order Placed Successfully!</h3><p>Thank you, $firstName. A confirmation email has been sent to $email.</p>";
    } else {
        echo "<script>alert('Error Sending email.'); window.location.href = 'index.html';</script>";
        // echo "<h3>Error sending email.</h3><p>Please try again later.</p>";
    }
} else {
    // echo "<script>alert('Invalid Request.');window.location.href = 'index.html';</script>";
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

    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/contact_style_responsive.css">
    <link rel="stylesheet" href="styles/kaflasystem.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/countdown.css">
    <link rel="stylesheet" href="styles/responsiveness.css">
    <title>Usman Digital Store - Contact Us</title>

</head>
<style>
    .error{
        color: red;
        font-size: 12px;
    }
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
        <div class="hamburger-navbar">

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
            <div class="button-row">
                <!-- Neon Button -->
                <div class="button-container">
                    <button onclick="location.href='#pricing'" class="btn header-button">
                        <div class="particles"></div>
                        <span><a href="#pricing">BUY NOW</a></span>
                    </button>
                </div>
            </div>

        </header>

        <div class="landing_page">
            <h2 class="kafla-headline">Checkout Your <span class="highlight playfair-display">Order </span>
            </h2>
            <div class="responsive-container-block big-container">
                <form class="form-box" method="post" id="checkoutForm" action="./checkout.php">
                    <div class="responsive-container-block container">
                        <div class="responsive-cell-block wk-ipadp-6 wk-tab-12 wk-mobile-12 wk-desk-7 left-one "
                            id="i1zj">
                            <div class="container-block form-wrapper">
                                <p class="text-blk contactus-head">
                                    <a class="link" href="">
                                    </a>
                                    Contact information
                                </p>
                                <p class="text-blk contactus-subhead">
                                    We'll use this email to send you details and updates about your order.
                                </p>
                                <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                    id="i10mt-7" style="margin-bottom: 20px;">
                                    <input class="input" id="ijowk-7"  name="email" type="email" placeholder="Your Email" required>
                                    <span class="error"><?php $emailError ?></span>
                                </div>
                                <p class="text-blk contactus-head">
                                    <a class="link" href="">
                                    </a>
                                    Billing address
                                </p>
                                <p class="text-blk contactus-subhead">
                                    Enter the billing address that matches your payment method.
                                </p>
                                <div class="responsive-container-block">
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                        id="i10mt-7">
                                        <select name="selection" class="input" require>
                                            <option value="select">Select a country...</option>
                                            <option value="AFG">Afghanistan</option>
                                            <option value="ALA">Åland Islands</option>
                                            <option value="ALB">Albania</option>
                                            <option value="DZA">Algeria</option>
                                            <option value="ASM">American Samoa</option>
                                            <option value="AND">Andorra</option>
                                            <option value="AGO">Angola</option>
                                            <option value="AIA">Anguilla</option>
                                            <option value="ATA">Antarctica</option>
                                            <option value="ATG">Antigua and Barbuda</option>
                                            <option value="ARG">Argentina</option>
                                            <option value="ARM">Armenia</option>
                                            <option value="ABW">Aruba</option>
                                            <option value="AUS">Australia</option>
                                            <option value="AUT">Austria</option>
                                            <option value="AZE">Azerbaijan</option>
                                            <option value="BHS">Bahamas</option>
                                            <option value="BHR">Bahrain</option>
                                            <option value="BGD">Bangladesh</option>
                                            <option value="BRB">Barbados</option>
                                            <option value="BLR">Belarus</option>
                                            <option value="BEL">Belgium</option>
                                            <option value="BLZ">Belize</option>
                                            <option value="BEN">Benin</option>
                                            <option value="BMU">Bermuda</option>
                                            <option value="BTN">Bhutan</option>
                                            <option value="BOL">Bolivia, Plurinational State of</option>
                                            <option value="BES">Bonaire, Sint Eustatius and Saba</option>
                                            <option value="BIH">Bosnia and Herzegovina</option>
                                            <option value="BWA">Botswana</option>
                                            <option value="BVT">Bouvet Island</option>
                                            <option value="BRA">Brazil</option>
                                            <option value="IOT">British Indian Ocean Territory</option>
                                            <option value="BRN">Brunei Darussalam</option>
                                            <option value="BGR">Bulgaria</option>
                                            <option value="BFA">Burkina Faso</option>
                                            <option value="BDI">Burundi</option>
                                            <option value="KHM">Cambodia</option>
                                            <option value="CMR">Cameroon</option>
                                            <option value="CAN">Canada</option>
                                            <option value="CPV">Cape Verde</option>
                                            <option value="CYM">Cayman Islands</option>
                                            <option value="CAF">Central African Republic</option>
                                            <option value="TCD">Chad</option>
                                            <option value="CHL">Chile</option>
                                            <option value="CHN">China</option>
                                            <option value="CXR">Christmas Island</option>
                                            <option value="CCK">Cocos (Keeling) Islands</option>
                                            <option value="COL">Colombia</option>
                                            <option value="COM">Comoros</option>
                                            <option value="COG">Congo</option>
                                            <option value="COD">Congo, the Democratic Republic of the</option>
                                            <option value="COK">Cook Islands</option>
                                            <option value="CRI">Costa Rica</option>
                                            <option value="CIV">Côte d'Ivoire</option>
                                            <option value="HRV">Croatia</option>
                                            <option value="CUB">Cuba</option>
                                            <option value="CUW">Curaçao</option>
                                            <option value="CYP">Cyprus</option>
                                            <option value="CZE">Czech Republic</option>
                                            <option value="DNK">Denmark</option>
                                            <option value="DJI">Djibouti</option>
                                            <option value="DMA">Dominica</option>
                                            <option value="DOM">Dominican Republic</option>
                                            <option value="ECU">Ecuador</option>
                                            <option value="EGY">Egypt</option>
                                            <option value="SLV">El Salvador</option>
                                            <option value="GNQ">Equatorial Guinea</option>
                                            <option value="ERI">Eritrea</option>
                                            <option value="EST">Estonia</option>
                                            <option value="ETH">Ethiopia</option>
                                            <option value="FLK">Falkland Islands (Malvinas)</option>
                                            <option value="FRO">Faroe Islands</option>
                                            <option value="FJI">Fiji</option>
                                            <option value="FIN">Finland</option>
                                            <option value="FRA">France</option>
                                            <option value="GUF">French Guiana</option>
                                            <option value="PYF">French Polynesia</option>
                                            <option value="ATF">French Southern Territories</option>
                                            <option value="GAB">Gabon</option>
                                            <option value="GMB">Gambia</option>
                                            <option value="GEO">Georgia</option>
                                            <option value="DEU">Germany</option>
                                            <option value="GHA">Ghana</option>
                                            <option value="GIB">Gibraltar</option>
                                            <option value="GRC">Greece</option>
                                            <option value="GRL">Greenland</option>
                                            <option value="GRD">Grenada</option>
                                            <option value="GLP">Guadeloupe</option>
                                            <option value="GUM">Guam</option>
                                            <option value="GTM">Guatemala</option>
                                            <option value="GGY">Guernsey</option>
                                            <option value="GIN">Guinea</option>
                                            <option value="GNB">Guinea-Bissau</option>
                                            <option value="GUY">Guyana</option>
                                            <option value="HTI">Haiti</option>
                                            <option value="HMD">Heard Island and McDonald Islands</option>
                                            <option value="VAT">Holy See (Vatican City State)</option>
                                            <option value="HND">Honduras</option>
                                            <option value="HKG">Hong Kong</option>
                                            <option value="HUN">Hungary</option>
                                            <option value="ISL">Iceland</option>
                                            <option value="IND">India</option>
                                            <option value="IDN">Indonesia</option>
                                            <option value="IRN">Iran, Islamic Republic of</option>
                                            <option value="IRQ">Iraq</option>
                                            <option value="IRL">Ireland</option>
                                            <option value="IMN">Isle of Man</option>
                                            <option value="ISR">Israel</option>
                                            <option value="ITA">Italy</option>
                                            <option value="JAM">Jamaica</option>
                                            <option value="JPN">Japan</option>
                                            <option value="JEY">Jersey</option>
                                            <option value="JOR">Jordan</option>
                                            <option value="KAZ">Kazakhstan</option>
                                            <option value="KEN">Kenya</option>
                                            <option value="KIR">Kiribati</option>
                                            <option value="PRK">Korea, Democratic People's Republic of</option>
                                            <option value="KOR">Korea, Republic of</option>
                                            <option value="KWT">Kuwait</option>
                                            <option value="KGZ">Kyrgyzstan</option>
                                            <option value="LAO">Lao People's Democratic Republic</option>
                                            <option value="LVA">Latvia</option>
                                            <option value="LBN">Lebanon</option>
                                            <option value="LSO">Lesotho</option>
                                            <option value="LBR">Liberia</option>
                                            <option value="LBY">Libya</option>
                                            <option value="LIE">Liechtenstein</option>
                                            <option value="LTU">Lithuania</option>
                                            <option value="LUX">Luxembourg</option>
                                            <option value="MAC">Macao</option>
                                            <option value="MKD">Macedonia, the former Yugoslav Republic of</option>
                                            <option value="MDG">Madagascar</option>
                                            <option value="MWI">Malawi</option>
                                            <option value="MYS">Malaysia</option>
                                            <option value="MDV">Maldives</option>
                                            <option value="MLI">Mali</option>
                                            <option value="MLT">Malta</option>
                                            <option value="MHL">Marshall Islands</option>
                                            <option value="MTQ">Martinique</option>
                                            <option value="MRT">Mauritania</option>
                                            <option value="MUS">Mauritius</option>
                                            <option value="MYT">Mayotte</option>
                                            <option value="MEX">Mexico</option>
                                            <option value="FSM">Micronesia, Federated States of</option>
                                            <option value="MDA">Moldova, Republic of</option>
                                            <option value="MCO">Monaco</option>
                                            <option value="MNG">Mongolia</option>
                                            <option value="MNE">Montenegro</option>
                                            <option value="MSR">Montserrat</option>
                                            <option value="MAR">Morocco</option>
                                            <option value="MOZ">Mozambique</option>
                                            <option value="MMR">Myanmar</option>
                                            <option value="NAM">Namibia</option>
                                            <option value="NRU">Nauru</option>
                                            <option value="NPL">Nepal</option>
                                            <option value="NLD">Netherlands</option>
                                            <option value="NCL">New Caledonia</option>
                                            <option value="NZL">New Zealand</option>
                                            <option value="NIC">Nicaragua</option>
                                            <option value="NER">Niger</option>
                                            <option value="NGA">Nigeria</option>
                                            <option value="NIU">Niue</option>
                                            <option value="NFK">Norfolk Island</option>
                                            <option value="MNP">Northern Mariana Islands</option>
                                            <option value="NOR">Norway</option>
                                            <option value="OMN">Oman</option>
                                            <option value="PAK">Pakistan</option>
                                            <option value="PLW">Palau</option>
                                            <option value="PSE">Palestinian Territory, Occupied</option>
                                            <option value="PAN">Panama</option>
                                            <option value="PNG">Papua New Guinea</option>
                                            <option value="PRY">Paraguay</option>
                                            <option value="PER">Peru</option>
                                            <option value="PHL">Philippines</option>
                                            <option value="PCN">Pitcairn</option>
                                            <option value="POL">Poland</option>
                                            <option value="PRT">Portugal</option>
                                            <option value="PRI">Puerto Rico</option>
                                            <option value="QAT">Qatar</option>
                                            <option value="REU">Réunion</option>
                                            <option value="ROU">Romania</option>
                                            <option value="RUS">Russian Federation</option>
                                            <option value="RWA">Rwanda</option>
                                            <option value="BLM">Saint Barthélemy</option>
                                            <option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
                                            <option value="KNA">Saint Kitts and Nevis</option>
                                            <option value="LCA">Saint Lucia</option>
                                            <option value="MAF">Saint Martin (French part)</option>
                                            <option value="SPM">Saint Pierre and Miquelon</option>
                                            <option value="VCT">Saint Vincent and the Grenadines</option>
                                            <option value="WSM">Samoa</option>
                                            <option value="SMR">San Marino</option>
                                            <option value="STP">Sao Tome and Principe</option>
                                            <option value="SAU">Saudi Arabia</option>
                                            <option value="SEN">Senegal</option>
                                            <option value="SRB">Serbia</option>
                                            <option value="SYC">Seychelles</option>
                                            <option value="SLE">Sierra Leone</option>
                                            <option value="SGP">Singapore</option>
                                            <option value="SXM">Sint Maarten (Dutch part)</option>
                                            <option value="SVK">Slovakia</option>
                                            <option value="SVN">Slovenia</option>
                                            <option value="SLB">Solomon Islands</option>
                                            <option value="SOM">Somalia</option>
                                            <option value="ZAF">South Africa</option>
                                            <option value="SGS">South Georgia and the South Sandwich Islands</option>
                                            <option value="SSD">South Sudan</option>
                                            <option value="ESP">Spain</option>
                                            <option value="LKA">Sri Lanka</option>
                                            <option value="SDN">Sudan</option>
                                            <option value="SUR">Suriname</option>
                                            <option value="SJM">Svalbard and Jan Mayen</option>
                                            <option value="SWZ">Swaziland</option>
                                            <option value="SWE">Sweden</option>
                                            <option value="CHE">Switzerland</option>
                                            <option value="SYR">Syrian Arab Republic</option>
                                            <option value="TWN">Taiwan, Province of China</option>
                                            <option value="TJK">Tajikistan</option>
                                            <option value="TZA">Tanzania, United Republic of</option>
                                            <option value="THA">Thailand</option>
                                            <option value="TLS">Timor-Leste</option>
                                            <option value="TGO">Togo</option>
                                            <option value="TKL">Tokelau</option>
                                            <option value="TON">Tonga</option>
                                            <option value="TTO">Trinidad and Tobago</option>
                                            <option value="TUN">Tunisia</option>
                                            <option value="TUR">Turkey</option>
                                            <option value="TKM">Turkmenistan</option>
                                            <option value="TCA">Turks and Caicos Islands</option>
                                            <option value="TUV">Tuvalu</option>
                                            <option value="UGA">Uganda</option>
                                            <option value="UKR">Ukraine</option>
                                            <option value="ARE">United Arab Emirates</option>
                                            <option value="GBR">United Kingdom</option>
                                            <option value="USA">United States</option>
                                            <option value="UMI">United States Minor Outlying Islands</option>
                                            <option value="URY">Uruguay</option>
                                            <option value="UZB">Uzbekistan</option>
                                            <option value="VUT">Vanuatu</option>
                                            <option value="VEN">Venezuela, Bolivarian Republic of</option>
                                            <option value="VNM">Viet Nam</option>
                                            <option value="VGB">Virgin Islands, British</option>
                                            <option value="VIR">Virgin Islands, U.S.</option>
                                            <option value="WLF">Wallis and Futuna</option>
                                            <option value="ESH">Western Sahara</option>
                                            <option value="YEM">Yemen</option>
                                            <option value="ZMB">Zambia</option>
                                            <option value="ZWE">Zimbabwe</option>
                                        </select>
                                        <span class="error"><?= $countryError ?></span>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                        id="i10mt-7">
                                        <input class="input" id="ijowk-7" name="FirstName" placeholder="First Name" required>
                                        <span class="error"><?= $firstNameError ?></span>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                        id="i1ro7">
                                        <input class="input" id="indfi-5" name="LastName" placeholder="Last Name" required>
                                        <span class="error"><?= $lastNameError ?></span>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                        id="i1ro7-1">
                                        <input class="input" id="indfi-6" name="Address"
                                            placeholder="Address" required>
                                        <span class="error"><?= $addressError ?></span>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                        id="i1ro7-2">
                                        <input class="input" id="indfi-7" name="Appartment"
                                            placeholder="Apartment, suite, etc. (Optional)">
                                    </div>

                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-6 wk-ipadp-6 emial"
                                        id="ityct-1">
                                        <input class="input" id="ipmgh-8" name="TownCity" placeholder="Town / City" required>
                                        <span class="error"><?= $cityError ?></span>
                                    </div>
                                    <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                        <input class="input" id="ipmgh-9" name="StateCounty"
                                            placeholder="State / County" required>
                                        <span class="error"><?= $stateError ?></span>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-6 wk-ipadp-6 emial"
                                        id="ityct">
                                        <input class="input" id="ipmgh-10" name="ZipCode" placeholder="Zip Code" required>
                                        <span class="error"><?= $zipError ?></span>
                                    </div>
                                    <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                        <input class="input" id="imgis-11" name="PhoneNumber"
                                            placeholder="Phone (Optional)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="responsive-cell-block wk-ipadp-5 wk-tab-12 wk-mobile-12 wk-desk-4 right-one"
                            id="i1zj">
                            <div class="container-block form-wrapper">
                                <p class="text-blk contactus-head">
                                    <a class="link" href="">
                                    </a>
                                    Order Details
                                </p>
                                <!-- <div id="plan-details">Loading.....</div> -->
                                <div class="responsive-container-block">

                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12 order-block"
                                        id="i10mt-7">
                                        <p class="order_title">Product Name</p>
                                        <p class="price" id="p_name"><?php echo $product_name ?></p>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12 order-block"
                                        id="i10mt-8">
                                        <p class="order_title">Subtotal</p>
                                        <p class="price" id="p_subprice"><?php echo $product_price ?></p>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12 order-block" style="border-bottom: none;"
                                        id="i10mt-9">
                                        <p class="order_title">Total</p>
                                        <p class="price" id="p_price"><?php echo $product_price ?></p>
                                    </div>
                                    
                                    <button class="submit-btn btn" type="submit">
                                        Place Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    <!-- <script src="script/vslcontainer%20-%20Copy.js"></script> -->
    <script src="./script/swiper-bundle.min.js"></script>
    <!-- <script>
        const productData = {
            canva: [
                { id: 1, name: 'Canva Pro Spark', price: 299 },
                { id: 2, name: 'Canva Pro Flow', price: 599 },
                { id: 3, name: 'Canva Pro Legacy', price: 1299 },
            ],
            surfshark: [
                { id: 1, name: 'Surfshark Lite Plan', price: 300 },
                { id: 2, name: 'Surfshark Plus Plan', price: 700 },
                { id: 3, name: 'Surfshark Premium Plan', price: 1500 },
            ],
            vidiq: [
                { id: 1, name: 'vidIQ Boost (1-Month Private Plan)', price: 800 }
            ],
            skillshare: [
                { id: 1, name: 'Skillshare Shared Plan', price: 500 },
                { id: 2, name: 'Skillshare Private Plan', price: 899 }
            ],
            capcut: [
                { id: 1, name: 'CapCut Lite Plan', price: 600 },
                { id: 2, name: 'CapCut Desktop Plan', price: 2000 },
                { id: 3, name: 'CapCut Premium Plan', price: 9500 },
            ],
            chatgpt: [
                { id: 1, name: 'GPT-4 Semi-Private Plan', price: 1499 },
                { id: 2, name: 'GPT-4 Private Plan', price: 4000 },
            ]
        };
        function getQueryParams() {
            const params = new URLSearchParams(window.location.search);
            return {
                product: params.get('product'),
                id: parseInt(params.get('id')),
            };
        }

        const { product, id } = getQueryParams();
        const productPlans = productData[product];

        if (productPlans) {
            const selectedPlan = productPlans.find(plan => plan.id === id);
            if (selectedPlan) {
              document.getElementById('p_name').innerText = selectedPlan.name;
              document.getElementById('p_subprice').innerText =  `${selectedPlan.price} PKR`;
              document.getElementById('p_price').innerText =  `${selectedPlan.price} PKR`;

            } else {
                document.getElementById('plan-details').textContent = 'Plan not found!';
            }
        } else {
            document.getElementById('plan-details').textContent = 'Product not found!';
        }
    </script> -->
    <script>
        const message = <?php echo $messageAdmin ?>
        console.log(message);
    </script>

</body>


</html>

<?php echo $messageAdmin ?>