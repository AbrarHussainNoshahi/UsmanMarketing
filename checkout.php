<?php
$country = $_POST['selection'] ?? 'select';

$countries = array(
"AF" => "Afghanistan",
"AL" => "Albania",
"DZ" => "Algeria",
"AS" => "American Samoa",
"AD" => "Andorra",
"AO" => "Angola",
"AI" => "Anguilla",
"AQ" => "Antarctica",
"AG" => "Antigua and Barbuda",
"AR" => "Argentina",
"AM" => "Armenia",
"AW" => "Aruba",
"AU" => "Australia",
"AT" => "Austria",
"AZ" => "Azerbaijan",
"BS" => "Bahamas",
"BH" => "Bahrain",
"BD" => "Bangladesh",
"BB" => "Barbados",
"BY" => "Belarus",
"BE" => "Belgium",
"BZ" => "Belize",
"BJ" => "Benin",
"BM" => "Bermuda",
"BT" => "Bhutan",
"BO" => "Bolivia",
"BA" => "Bosnia and Herzegovina",
"BW" => "Botswana",
"BV" => "Bouvet Island",
"BR" => "Brazil",
"BQ" => "British Antarctic Territory",
"IO" => "British Indian Ocean Territory",
"VG" => "British Virgin Islands",
"BN" => "Brunei",
"BG" => "Bulgaria",
"BF" => "Burkina Faso",
"BI" => "Burundi",
"KH" => "Cambodia",
"CM" => "Cameroon",
"CA" => "Canada",
"CT" => "Canton and Enderbury Islands",
"CV" => "Cape Verde",
"KY" => "Cayman Islands",
"CF" => "Central African Republic",
"TD" => "Chad",
"CL" => "Chile",
"CN" => "China",
"CX" => "Christmas Island",
"CC" => "Cocos [Keeling] Islands",
"CO" => "Colombia",
"KM" => "Comoros",
"CG" => "Congo - Brazzaville",
"CD" => "Congo - Kinshasa",
"CK" => "Cook Islands",
"CR" => "Costa Rica",
"HR" => "Croatia",
"CU" => "Cuba",
"CY" => "Cyprus",
"CZ" => "Czech Republic",
"CI" => "Côte d’Ivoire",
"DK" => "Denmark",
"DJ" => "Djibouti",
"DM" => "Dominica",
"DO" => "Dominican Republic",
"NQ" => "Dronning Maud Land",
"DD" => "East Germany",
"EC" => "Ecuador",
"EG" => "Egypt",
"SV" => "El Salvador",
"GQ" => "Equatorial Guinea",
"ER" => "Eritrea",
"EE" => "Estonia",
"ET" => "Ethiopia",
"FK" => "Falkland Islands",
"FO" => "Faroe Islands",
"FJ" => "Fiji",
"FI" => "Finland",
"FR" => "France",
"GF" => "French Guiana",
"PF" => "French Polynesia",
"TF" => "French Southern Territories",
"FQ" => "French Southern and Antarctic Territories",
"GA" => "Gabon",
"GM" => "Gambia",
"GE" => "Georgia",
"DE" => "Germany",
"GH" => "Ghana",
"GI" => "Gibraltar",
"GR" => "Greece",
"GL" => "Greenland",
"GD" => "Grenada",
"GP" => "Guadeloupe",
"GU" => "Guam",
"GT" => "Guatemala",
"GG" => "Guernsey",
"GN" => "Guinea",
"GW" => "Guinea-Bissau",
"GY" => "Guyana",
"HT" => "Haiti",
"HM" => "Heard Island and McDonald Islands",
"HN" => "Honduras",
"HK" => "Hong Kong SAR China",
"HU" => "Hungary",
"IS" => "Iceland",
"IN" => "India",
"ID" => "Indonesia",
"IR" => "Iran",
"IQ" => "Iraq",
"IE" => "Ireland",
"IM" => "Isle of Man",
"IL" => "Israel",
"IT" => "Italy",
"JM" => "Jamaica",
"JP" => "Japan",
"JE" => "Jersey",
"JT" => "Johnston Island",
"JO" => "Jordan",
"KZ" => "Kazakhstan",
"KE" => "Kenya",
"KI" => "Kiribati",
"KW" => "Kuwait",
"KG" => "Kyrgyzstan",
"LA" => "Laos",
"LV" => "Latvia",
"LB" => "Lebanon",
"LS" => "Lesotho",
"LR" => "Liberia",
"LY" => "Libya",
"LI" => "Liechtenstein",
"LT" => "Lithuania",
"LU" => "Luxembourg",
"MO" => "Macau SAR China",
"MK" => "Macedonia",
"MG" => "Madagascar",
"MW" => "Malawi",
"MY" => "Malaysia",
"MV" => "Maldives",
"ML" => "Mali",
"MT" => "Malta",
"MH" => "Marshall Islands",
"MQ" => "Martinique",
"MR" => "Mauritania",
"MU" => "Mauritius",
"YT" => "Mayotte",
"FX" => "Metropolitan France",
"MX" => "Mexico",
"FM" => "Micronesia",
"MI" => "Midway Islands",
"MD" => "Moldova",
"MC" => "Monaco",
"MN" => "Mongolia",
"ME" => "Montenegro",
"MS" => "Montserrat",
"MA" => "Morocco",
"MZ" => "Mozambique",
"MM" => "Myanmar [Burma]",
"NA" => "Namibia",
"NR" => "Nauru",
"NP" => "Nepal",
"NL" => "Netherlands",
"AN" => "Netherlands Antilles",
"NT" => "Neutral Zone",
"NC" => "New Caledonia",
"NZ" => "New Zealand",
"NI" => "Nicaragua",
"NE" => "Niger",
"NG" => "Nigeria",
"NU" => "Niue",
"NF" => "Norfolk Island",
"KP" => "North Korea",
"VD" => "North Vietnam",
"MP" => "Northern Mariana Islands",
"NO" => "Norway",
"OM" => "Oman",
"PC" => "Pacific Islands Trust Territory",
"PK" => "Pakistan",
"PW" => "Palau",
"PS" => "Palestinian Territories",
"PA" => "Panama",
"PZ" => "Panama Canal Zone",
"PG" => "Papua New Guinea",
"PY" => "Paraguay",
"YD" => "People's Democratic Republic of Yemen",
"PE" => "Peru",
"PH" => "Philippines",
"PN" => "Pitcairn Islands",
"PL" => "Poland",
"PT" => "Portugal",
"PR" => "Puerto Rico",
"QA" => "Qatar",
"RO" => "Romania",
"RU" => "Russia",
"RW" => "Rwanda",
"RE" => "Réunion",
"BL" => "Saint Barthélemy",
"SH" => "Saint Helena",
"KN" => "Saint Kitts and Nevis",
"LC" => "Saint Lucia",
"MF" => "Saint Martin",
"PM" => "Saint Pierre and Miquelon",
"VC" => "Saint Vincent and the Grenadines",
"WS" => "Samoa",
"SM" => "San Marino",
"SA" => "Saudi Arabia",
"SN" => "Senegal",
"RS" => "Serbia",
"CS" => "Serbia and Montenegro",
"SC" => "Seychelles",
"SL" => "Sierra Leone",
"SG" => "Singapore",
"SK" => "Slovakia",
"SI" => "Slovenia",
"SB" => "Solomon Islands",
"SO" => "Somalia",
"ZA" => "South Africa",
"GS" => "South Georgia and the South Sandwich Islands",
"KR" => "South Korea",
"ES" => "Spain",
"LK" => "Sri Lanka",
"SD" => "Sudan",
"SR" => "Suriname",
"SJ" => "Svalbard and Jan Mayen",
"SZ" => "Swaziland",
"SE" => "Sweden",
"CH" => "Switzerland",
"SY" => "Syria",
"ST" => "São Tomé and Príncipe",
"TW" => "Taiwan",
"TJ" => "Tajikistan",
"TZ" => "Tanzania",
"TH" => "Thailand",
"TL" => "Timor-Leste",
"TG" => "Togo",
"TK" => "Tokelau",
"TO" => "Tonga",
"TT" => "Trinidad and Tobago",
"TN" => "Tunisia",
"TR" => "Turkey",
"TM" => "Turkmenistan",
"TC" => "Turks and Caicos Islands",
"TV" => "Tuvalu",
"UM" => "U.S. Minor Outlying Islands",
"PU" => "U.S. Miscellaneous Pacific Islands",
"VI" => "U.S. Virgin Islands",
"UG" => "Uganda",
"UA" => "Ukraine",
"SU" => "Union of Soviet Socialist Republics",
"AE" => "United Arab Emirates",
"GB" => "United Kingdom",
"US" => "United States",
"ZZ" => "Unknown or Invalid Region",
"UY" => "Uruguay",
"UZ" => "Uzbekistan",
"VU" => "Vanuatu",
"VA" => "Vatican City",
"VE" => "Venezuela",
"VN" => "Vietnam",
"WK" => "Wake Island",
"WF" => "Wallis and Futuna",
"EH" => "Western Sahara",
"YE" => "Yemen",
"ZM" => "Zambia",
"ZW" => "Zimbabwe",
"AX" => "Åland Islands",
);


// Turn on error reporting for debugging (optional)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



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

$product = $_GET['product'] ?? $_POST['product'] ?? null;
$id = $_GET['id'] ?? $_POST['id'] ?? null;

if ($product && $id && isset($productData[$product])) {
    foreach ($productData[$product] as $item) {
        if ($item['id'] == $id) {
            $matchedProduct = $item;
            break;
        }
    }
}

$product_name = $matchedProduct['name'] ?? '';
$product_price = $matchedProduct['price'] ?? '';
$countryError = "";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    $email = $_POST['email'] ?? '';
    $country = $_POST['selection'] ?? '';
    $firstName = $_POST['FirstName'] ?? '';
    $lastName = $_POST['LastName'] ?? '';
    $address = $_POST['Address'] ?? '';
    $appartment = $_POST['Appartment'] ?? '';
    $city = $_POST['TownCity'] ?? '';
    $state = $_POST['StateCounty'] ?? '';
    $zip = $_POST['ZipCode'] ?? '';
    $phone = $_POST['PhoneNumber'] ?? '';
    $product_name = $matchedProduct['name'] ?? '';
    $product_price = $matchedProduct['price'] ?? '';

    $isValid = true;

    if ($country == "select") {
        $countryError = "Country must be selected.";
        $isValid = false;
    }
    if($isValid){
        // Email addresses
        // $adminEmail = "support@usmandigitalstore.com";
        // $customerEmail = $email;
        // $adminSubject = "New Order Received";
        // $adminMessage = "
        // <h2>New Order Details</h2>
        // <p><strong>Product:</strong> $product_name</p>
        // <p><strong>Price:</strong> $product_price</p>
        // <p><strong>Email:</strong> $email</p>
        // <p><strong>Name:</strong> $firstName $lastName</p>
        // <p><strong>Address:</strong> $address $appartment, $city, $state, $zip, $country</p>
        // <p><strong>Phone:</strong> $phone</p>
        // ";

        // // Email headers for HTML mail
        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // $headers .= "From: Usman Digital Store <$adminEmail>" . "\r\n";

        // // Send to Admin
        // mail($adminEmail, $adminSubject, $adminMessage, $headers);

        // // ----------- Send Email to Customer -----------
        // $customerSubject = "Order Confirmation";
        // $customerMessage = "
        // <h2>Thank you for your order!</h2>
        // <p>Hi $firstName,</p>
        // <p>We've received your order for <strong>$product_name</strong> and are currently processing it.</p>
        // <p>We’ll send you an update soon.</p>
        // <br>
        // <p>Thanks,</p>
        // <p>Usman Digital Store</p>
        // ";

        // // Send to Customer
        // mail($customerEmail, $customerSubject, $customerMessage, $headers);
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
    if ($adminSent && $customerSent){

        header("Location: thankyou.php");
        exit;
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

    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/contact_style_responsive.css">
    <link rel="stylesheet" href="styles/kaflasystem.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/countdown.css">
    <link rel="stylesheet" href="styles/responsiveness.css">
    <title>Usman Digital Store - Checkout</title>

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
                     <input type="hidden" name="product" value="<?php echo htmlspecialchars($product); ?>">
                     <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
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
                                    <input class="input" id="ijowk-7" value="<?php echo htmlspecialchars($email ?? ''); ?>" name="email" type="email" placeholder="Your Email" required>
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
                                        <select name="selection" class="input">
                                            <option value="select" <?php if ($country == "select") echo "selected"; ?>>Select a country...</option>
                                            <?php foreach ($countries as $code => $name): ?>
                                                <option value="<?= htmlspecialchars($code) ?>" <?php if ($country == $code) echo 'selected'; ?>>
                                                    <?= htmlspecialchars($name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="error"><?= $countryError ?></span>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                        id="i10mt-7">
                                        <input class="input" id="ijowk-7" name="FirstName" value="<?php echo htmlspecialchars($firstName ?? ''); ?>"  placeholder="First Name" required>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                        id="i1ro7">
                                        <input class="input" id="indfi-5" name="LastName" value="<?php echo htmlspecialchars($lastName ?? ''); ?>"  placeholder="Last Name" required>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                        id="i1ro7-1">
                                        <input class="input" id="indfi-6" value="<?php echo htmlspecialchars($address ?? ''); ?>"  name="Address"
                                            placeholder="Address" required>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                        id="i1ro7-2">
                                        <input class="input" id="indfi-7" name="Appartment" value="<?php echo htmlspecialchars($appartment ?? ''); ?>"
                                            placeholder="Apartment, suite, etc. (Optional)">
                                    </div>

                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-6 wk-ipadp-6 emial"
                                        id="ityct-1">
                                        <input class="input" id="ipmgh-8" value="<?php echo htmlspecialchars($city ?? ''); ?>"  name="TownCity" placeholder="Town / City" required>
                                    </div>
                                    <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                        <input class="input" id="ipmgh-9" name="StateCounty"
                                            placeholder="State / County" value="<?php echo htmlspecialchars($state ?? ''); ?>"  required>
                                    </div>
                                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-6 wk-ipadp-6 emial"
                                        id="ityct">
                                        <input class="input" id="ipmgh-10" value="<?php echo htmlspecialchars($zip ?? ''); ?>"  name="ZipCode" placeholder="Zip Code" required>
                                    </div>
                                    <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                        <input class="input" id="imgis-11" value="<?php echo htmlspecialchars($phone ?? ''); ?>"  name="PhoneNumber"
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
                                   
                                    <button class="submit-btn btn" name="submit" type="submit">
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
</body>


</html>