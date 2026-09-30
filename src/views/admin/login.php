<?php use App\Helpers\Auth; ?>

<div class="login-container">
    <div class="login-card">
        <div class="login-logo">
            <div class="login-logo-icon">BDM</div>
            <h1>Admin Panel</h1>
            <p>acoperisuri.info</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="login-error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/admin/login" class="login-form" novalidate>
            <?= Auth::csrfField() ?>

            <div class="login-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($email ?? '') ?>"
                       placeholder="admin@acoperisuri.info"
                       autocomplete="email" required autofocus>
            </div>

            <div class="login-field">
                <label for="password">Parola</label>
                <input type="password" id="password" name="password"
                       placeholder="Introduceti parola"
                       autocomplete="current-password" required>
            </div>

            <button type="submit" class="login-btn">Autentificare</button>
        </form>

        <div class="login-footer">
            <a href="/">&larr; Inapoi la site</a>
        </div>
    </div>
</div>
