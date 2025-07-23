<?php
/*
Plugin Name: Custom Contact Form
Description: A simple contact form plugin with shortcode support.
Version: 1.0
Author: Manik Rana
*/

function manik_contact_form_shortcode() {
    ob_start();
    ?>
    <form method="post">
        <input type="text" name="manik_name" placeholder="Your Name" required><br>
        <input type="email" name="manik_email" placeholder="Your Email" required><br>
        <textarea name="manik_message" placeholder="Your Message" required></textarea><br>
        <input type="submit" name="manik_submit" value="Send">
    </form>
    <?php
    if (isset($_POST['manik_submit'])) {
        $name = sanitize_text_field($_POST['manik_name']);
        $email = sanitize_email($_POST['manik_email']);
        $message = sanitize_textarea_field($_POST['manik_message']);

        $to = get_option('admin_email');
        $subject = "New Contact Form Message";
        $body = "From: $name <$email>\n\n$message";

        wp_mail($to, $subject, $body);
        echo "<p>Message sent successfully!</p>";
    }
    return ob_get_clean();
}

add_shortcode('contact_form', 'manik_contact_form_shortcode');
