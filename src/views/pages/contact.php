<?php
$formData   = $formData   ?? [];
$formErrors = $formErrors ?? [];
$formSent   = $formSent   ?? false;
?>

<!-- Schema.org LocalBusiness -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "BDM Systems",
    "description": "Solutii complete pentru acoperisuri - tigla metalica, tabla faltuita, sisteme pluviale, ferestre FAKRO, izolatie STEICO.",
    "url": "https://acoperisuri.info",
    "telephone": "+40756034734",
    "email": "office@bdmacoperis.ro",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "Strada Principala nr. 100",
        "addressLocality": "Bucuresti",
        "addressRegion": "Bucuresti",
        "postalCode": "010001",
        "addressCountry": "RO"
    },
    "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
            "opens": "08:00",
            "closes": "17:00"
        },
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": "Saturday",
            "opens": "09:00",
            "closes": "14:00"
        }
    ],
    "image": "https://acoperisuri.info/images/logo/logo-full.png",
    "priceRange": "$$"
}
</script>

<!-- HERO -->
<section class="page-hero">
    <div class="container">
        <h1>Contactati-ne</h1>
        <p class="page-hero-desc">Suntem aici sa va ajutam cu orice intrebare despre acoperisuri, materiale sau servicii. Raspundem in maximum 24 de ore.</p>
    </div>
</section>

<!-- CONTENT -->
<section class="section">
    <div class="container">
        <div class="contact-layout">

            <!-- FORMULAR -->
            <div class="contact-form-wrap">

                <?php if ($formSent): ?>
                <div class="form-success">
                    <span class="form-success-icon">&#9989;</span>
                    <h2>Mesajul a fost trimis!</h2>
                    <p>Va vom contacta in cel mai scurt timp posibil. Multumim!</p>
                    <a href="/contact" class="btn btn-outline mt-lg">Trimite alt mesaj</a>
                </div>

                <?php else: ?>

                <h2 class="contact-form-title">Trimite-ne un mesaj</h2>
                <p class="contact-form-subtitle">Completati formularul de mai jos si va vom raspunde in cel mai scurt timp.</p>

                <?php if (!empty($formErrors)): ?>
                <div class="form-error-box">
                    <strong>&#9888; Corectati urmatoarele erori:</strong>
                    <ul>
                        <?php foreach ($formErrors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form method="POST" action="/contact" class="contact-form" id="contactForm" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nume complet <span class="required">*</span></label>
                            <input type="text" id="name" name="name" required
                                   placeholder="Ex: Ion Popescu"
                                   value="<?= htmlspecialchars($formData['name'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefon <span class="required">*</span></label>
                            <input type="tel" id="phone" name="phone" required
                                   placeholder="Ex: 0756 034 734"
                                   value="<?= htmlspecialchars($formData['phone'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email" required
                                   placeholder="Ex: ion@email.com"
                                   value="<?= htmlspecialchars($formData['email'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subiect <span class="required">*</span></label>
                            <select id="subject" name="subject" required>
                                <option value="">Selecteaza subiectul</option>
                                <option value="Cerere oferta" <?= ($formData['subject'] ?? '') === 'Cerere oferta' ? 'selected' : '' ?>>Cerere oferta</option>
                                <option value="Informatii produs" <?= ($formData['subject'] ?? '') === 'Informatii produs' ? 'selected' : '' ?>>Informatii produs</option>
                                <option value="Consultanta" <?= ($formData['subject'] ?? '') === 'Consultanta' ? 'selected' : '' ?>>Consultanta tehnica</option>
                                <option value="Reclamatie" <?= ($formData['subject'] ?? '') === 'Reclamatie' ? 'selected' : '' ?>>Reclamatie</option>
                                <option value="Altele" <?= ($formData['subject'] ?? '') === 'Altele' ? 'selected' : '' ?>>Altele</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product">Produs de interes <span class="optional">(optional)</span></label>
                        <input type="text" id="product" name="product"
                               placeholder="Ex: Tigla metalica Wetterbest Colosseum"
                               value="<?= htmlspecialchars($formData['product'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="message">Mesaj <span class="required">*</span></label>
                        <textarea id="message" name="message" rows="5" required
                                  placeholder="Descrieti cat mai detaliat solicitarea dumneavoastra..."><?= htmlspecialchars($formData['message'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group form-consent">
                        <label class="checkbox-label">
                            <input type="checkbox" name="consent" required <?= !empty($formData['consent']) ? 'checked' : '' ?>>
                            <span>Sunt de acord cu prelucrarea datelor personale conform politicii de confidentialitate.</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">
                        &#9993; Trimite mesajul
                    </button>
                </form>

                <?php endif; ?>
            </div>

            <!-- SIDEBAR INFO -->
            <aside class="contact-sidebar">

                <div class="contact-info-box">
                    <h3>&#128222; Telefon</h3>
                    <a href="tel:+40756034734" class="contact-info-value">0756.034.734</a>
                    <p class="contact-info-note">Luni - Vineri: 08:00 - 17:00</p>
                </div>

                <div class="contact-info-box">
                    <h3>&#9993; Email</h3>
                    <a href="mailto:office@bdmacoperis.ro" class="contact-info-value">office@bdmacoperis.ro</a>
                    <p class="contact-info-note">Raspundem in max. 24 ore</p>
                </div>

                <div class="contact-info-box">
                    <h3>&#128205; Adresa</h3>
                    <p class="contact-info-value">Strada Principala nr. 100<br>Bucuresti, Romania</p>
                </div>

                <div class="contact-info-box">
                    <h3>&#128338; Program</h3>
                    <div class="contact-schedule">
                        <div class="schedule-row">
                            <span>Luni - Vineri</span>
                            <span>08:00 - 17:00</span>
                        </div>
                        <div class="schedule-row">
                            <span>Sambata</span>
                            <span>09:00 - 14:00</span>
                        </div>
                        <div class="schedule-row">
                            <span>Duminica</span>
                            <span class="closed">Inchis</span>
                        </div>
                    </div>
                </div>

                <!-- Google Maps -->
                <div class="contact-map">
                    <h3>&#127758; Locatie</h3>
                    <div class="map-embed">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2849.5!2d26.1025!3d44.4268!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDTCsDI1JzM2LjUiTiAyNsKwMDYnMDkuMCJF!5e0!3m2!1sro!2sro!4v1"
                            width="100%" height="220" style="border:0; border-radius: var(--radius-lg);"
                            allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Locatia BDM Systems pe harta">
                        </iframe>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</section>

<!-- Frontend validation -->
<script>
(function () {
    var form = document.getElementById('contactForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        var errors = [];
        var name    = form.querySelector('#name');
        var email   = form.querySelector('#email');
        var phone   = form.querySelector('#phone');
        var subject = form.querySelector('#subject');
        var message = form.querySelector('#message');
        var consent = form.querySelector('[name="consent"]');

        // Reset
        form.querySelectorAll('.field-error').forEach(function (el) { el.remove(); });
        form.querySelectorAll('.has-error').forEach(function (el) { el.classList.remove('has-error'); });

        if (!name.value.trim()) { markError(name, 'Numele este obligatoriu'); errors.push(1); }
        if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) { markError(email, 'Introduceti un email valid'); errors.push(1); }
        if (!phone.value.trim() || phone.value.replace(/\D/g,'').length < 9) { markError(phone, 'Introduceti un numar de telefon valid'); errors.push(1); }
        if (!subject.value) { markError(subject, 'Selectati un subiect'); errors.push(1); }
        if (!message.value.trim() || message.value.trim().length < 10) { markError(message, 'Mesajul trebuie sa aiba minimum 10 caractere'); errors.push(1); }
        if (!consent.checked) { markError(consent.closest('.form-group'), 'Trebuie sa fiti de acord cu prelucrarea datelor'); errors.push(1); }

        if (errors.length > 0) {
            e.preventDefault();
            var first = form.querySelector('.has-error');
            if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    function markError(el, msg) {
        var group = el.closest('.form-group') || el;
        group.classList.add('has-error');
        var span = document.createElement('span');
        span.className = 'field-error';
        span.textContent = msg;
        group.appendChild(span);
    }
})();
</script>
