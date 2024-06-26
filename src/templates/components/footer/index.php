<?php namespace ProcessWire;

    $form_action = $pages->get("template=utilities-ajax")->url;
    $this_year = date("Y");

?>

<footer class="gs_reveal">
    <div class="footer__text">
        <h2>Have a project <span class="no-wrap">in mind?</span></h2>
        <p>Please call, email, or fill in this form to let us know <span class='no-wrap'>what you&apos;re looking for.</span></p>
    </div>
    <form id="cf" class="contact-form" action="<?= $form_action ?>">
        <fieldset class="details">
            <label for="name" class="form-label sr-only prevention"></label>
            <input name="name" type="text" id="name" class="prevention" autocomplete="off">
            <label for="fname" class="form-label sr-only">First name</label>
            <input type="text" id="fname" name="fname" placeholder="First name" pattern="[A-Za-z]+" required>
            <label for="lname" class="form-label sr-only">Last name</label>
            <input type="text" id="lname" name="lname" placeholder="Last name" pattern="[A-Za-z]+" required>
            <label for="email" class="form-label sr-only">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" pattern="^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$" required>
            <label for="subject" class="form-label sr-only">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Subject" pattern="^([a-zA-Z0-9 _\-!?'`,.]+)$" required>
        </fieldset>
        <label for="message" class="form-label sr-only">Message</label>
        <textarea id="message" name="message" placeholder="Message" required></textarea>
        <fieldset class="consent-set">
            <input type="checkbox" id="consent" class="consent-checkbox" name="consent" value="consent" required>
            <label for="consent" class="consent-label">I consent to my information being stored until this <span class='no-wrap'>enquiry is resolved</span></label>
        </fieldset>
        <input type="submit" class="bttn-cp bttn-cp--form" value="send">
        <div class="form-status">
            <p>Thanks for contacting us - we'll get back to you really soon!</p>
            <div class="spinner">
                <div class="lds-dual-ring"></div>
            </div>
        </div>
    </form>
    <address>
        The Creative Pulse<br>
        2 West Street, Epsom,<br>
        Surrey KT18 7RG
    </address>
    <p class="contact">0800 112 3228</p>
    <p class="copyright">&copy; <?= $this_year ?> The Creative Pulse</p>
    <ul class="footer__links">
        <li id="footer-link__projects" class="link__projects"><a href="/#project-gallery">Projects</a></li>
        <li id="footer-link__about"><a href="/about">About Us</a></li>
    </ul>
</footer>
