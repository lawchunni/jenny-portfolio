<?php include __DIR__ . '/inc/header.inc.php'; ?>

<!-- Section 1: Contact me form -->
<section id="contact">
    <div class="wrapper">
    <div class="left">
        <h1><?=$utils->esc($title)?></h1>
        <div class="portrait">
        <img src="images/portrait.png" alt="Portrait" width="406" height="568">
        </div>
    </div>

    <div class="right">

        <!-- Detect IE 8 -->
        <!--[if IE 8]>
        <p>You appear to be using an ancient Internet Explorer 8 browser. Upgrade to the most recent version to stay on trend ;)</p>
        <![endif]-->
        
        <form action="http://scott-media.com/test/form_display.php"
            method="post"
            id="contact_form"
            autocomplete="off"
            >
        <p> <!-- First name input field -->
            <input type="text"
                    name="first_name"
                    id="first_name"
                    placeholder="First Name"
                    required />
        </p>
            
        <p> <!-- Last name input field -->
            <input type="text"
                    name="last_name"
                    id="last_name"
                    placeholder="Last Name"
                    required />
        </p>
            
        <p> <!-- Email input field -->
            <input type="email" 
                    name="email_address"
                    id="email_address"
                    placeholder="Email Address"
                    required />
        </p>
            
        <p> <!-- Telephone input field -->
            <input type="tel" 
                    name="phone_number"
                    id="phone_number"
                    placeholder="Phone Number (optional)"/>
        </p>

        <p> <!-- Message box field -->
            <textarea id="message"
                    name="message"
                    cols="35"
                    rows="5"
                    placeholder="Leave me a message (optional), or I will contact you ;)"></textarea>
        </p>
            
        <div> <!-- Form submit buttons -->
            <button class="submit_button">Send</button>
        </div>
        </form>
    </div>
    
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>