<?php $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "The Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"); ?>

<div>
    <form method="post">
        <div class="form-group">
            <label for="username">Name</label>
            <input type="text"
                   name="username"
                   id="username"
                   class="form-control"
                   placeholder="Username"
                   value="<?= $client['client_name'] ?>"
                   required>
        </div>

        <div class="form-group">
            <label for="email">Email*</label>
            <input type="email"
                   name="email"
                   id="email"
                   class="form-control"
                   placeholder="Email"
                   value="<?= $client['client_email'] ?>">
        </div>

        <div class="form-group">
            <label for="tel">Telephone Number*</label>
            <input type="text"
                   name="tel"
                   id="tel"
                   class="form-control"
                   placeholder="Telephone nr."
                   value="<?= $client['client_tel'] ?>">
        </div>

        <div class="form-group">
            <label for="country">Country*</label>
            <select type="text"
                    name="country"
                    id="country"
                    class="form-control">
                <option selected>Select a country</option>
                <?php
                foreach ($countries as $country){
                    ?>
                    <option value="<?= $country ?>" <?= ($client['client_country'] == $country)? 'selected':'' ?>><?= $country ?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="state">State*</label>
            <input type="text"
                   name="state"
                   id="state"
                   class="form-control"
                   placeholder="State"
                   value="<?= $client['client_state'] ?>">
        </div>

        <div class="form-group">
            <label for="town">Town*</label>
            <input type="text"
                   name="town"
                   id="town"
                   class="form-control"
                   placeholder="Town"
                   value="<?= $client['client_city'] ?>">
        </div>

        <div class="form-group">
            <label for="street">Street*</label>
            <input type="text"
                   name="street"
                   id="street"
                   class="form-control"
                   placeholder="Street"
                   value="<?= $client['client_street'] ?>">
        </div>

        <div class="form-group">
            <label for="number">Number*</label>
            <input type="text"
                   name="number"
                   id="number"
                   class="form-control"
                   placeholder="Number"
                   value="<?= $client['client_street_number'] ?>">
        </div>

        <div class="form-group">
            <label for="zip">Zipcode*</label>
            <input type="text"
                   name="zip"
                   id="zip"
                   class="form-control"
                   placeholder="Zipcode"
                   value="<?= $client['client_zipcode'] ?>">
        </div>

        <span class="w-100">* Not required</span>

        <br />
        <br />

        <button type="submit" class="btn btn-outline-success">Submit</button>
    </form>
</div>

<script>
    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();
        <?= ajax('POST', 'editClient', '$(this).serialize()', $client['client_id']) ?>
    });
</script>