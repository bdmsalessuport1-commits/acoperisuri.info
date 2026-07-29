<?php
$c = $content;
?>

<link rel="stylesheet" href="/css/consulting.css?v=1">

<section class="ch-thanks">
    <div class="container">
        <div class="ch-thanks-card">
            <div class="ch-thanks-icon" aria-hidden="true">
                <svg viewBox="0 0 80 80" width="72" height="72">
                    <circle cx="40" cy="40" r="36" fill="#12A757" opacity=".12"/>
                    <circle cx="40" cy="40" r="28" fill="#12A757"/>
                    <path d="M28 40l8 8 16-18" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <h1>Aplicația ta a fost trimisă cu succes.</h1>
            <p class="ch-thanks-lead"><?= htmlspecialchars($c['form']['success_message']) ?></p>

            <div class="ch-thanks-next">
                <h2>Ce urmează?</h2>
                <ol>
                    <li>Analizez informațiile pe care mi le-ai trimis și documentele încărcate.</li>
                    <li>Îți scriu sau te sun în intervalul preferat de tine, pe canalul pe care l-ai ales.</li>
                    <li>Discutăm scurt despre stadiul proiectului și îți recomand pachetul potrivit.</li>
                </ol>
            </div>

            <div class="ch-thanks-contact">
                <p><strong>Ai nevoie să adaugi ceva urgent?</strong></p>
                <div class="ch-quick-contact">
                    <a href="tel:<?= htmlspecialchars($c['expert']['contact']['phone']) ?>" class="ch-quick-link">
                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3.1-8.7A2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .3 2 .6 2.9a2 2 0 01-.5 2.1L8 10a16 16 0 006 6l1.3-1.3a2 2 0 012.1-.4c.9.3 1.9.5 2.9.6a2 2 0 011.7 2z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                        <?= htmlspecialchars($c['expert']['contact']['phone']) ?>
                    </a>
                    <a href="mailto:<?= htmlspecialchars($c['expert']['contact']['email']) ?>" class="ch-quick-link">
                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M4 4h16v16H4z" fill="none" stroke="currentColor" stroke-width="2"/><path d="M4 4l8 8 8-8" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                        <?= htmlspecialchars($c['expert']['contact']['email']) ?>
                    </a>
                    <a href="https://wa.me/<?= preg_replace('/\D/', '', $c['expert']['contact']['whatsapp']) ?>"
                       class="ch-quick-link ch-quick-whatsapp"
                       target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2C6.5 2 2 6.5 2 12c0 1.8.5 3.4 1.3 4.9L2 22l5.3-1.4c1.5.8 3 1.2 4.7 1.2 5.5 0 10-4.5 10-10S17.5 2 12 2z" fill="#25D366"/><path d="M17 14.5c-.2-.1-1.3-.6-1.5-.7-.2-.1-.4-.1-.5.1-.2.2-.6.7-.7.8-.1.1-.2.2-.5.1-.2-.1-1-.4-1.8-1.1-.7-.6-1.1-1.4-1.3-1.6-.1-.2 0-.3.1-.5l.4-.4c.1-.1.1-.2.2-.4 0-.1 0-.3 0-.4-.1-.1-.5-1.3-.7-1.7-.2-.4-.4-.4-.5-.4h-.4c-.2 0-.4.1-.6.3-.2.2-.8.8-.8 2s.9 2.3 1 2.5c.1.2 1.8 2.8 4.4 3.9.6.3 1.1.4 1.5.5.6.2 1.2.2 1.6.1.5-.1 1.5-.6 1.7-1.2.2-.6.2-1.1.1-1.2-.1-.1-.2-.2-.4-.3z" fill="#fff"/></svg>
                        WhatsApp
                    </a>
                </div>
            </div>

            <div class="ch-thanks-links">
                <a href="/consultanta-passive-house">← Înapoi la pagina de consultanță</a>
                <a href="/">Acasă</a>
            </div>
        </div>
    </div>
</section>

<script>
// Fire successful submit event on thank-you page load
if (typeof window.gtag === 'function') {
    window.gtag('event', 'consulting_form_submit_success');
}
if (window.dataLayer && Array.isArray(window.dataLayer)) {
    window.dataLayer.push({event: 'consulting_form_submit_success'});
}
</script>
