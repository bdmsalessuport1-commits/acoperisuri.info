<?php
/** @var array $settings */
/** @var array $sitemapStats */
/** @var array|null $flash */
$csrfToken = \App\Helpers\Auth::csrfToken();
?>

<?php if ($flash): ?>
    <div class="admin-flash admin-flash-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['message']) ?></div>
<?php endif; ?>

<div class="admin-form-grid">
    <!-- MAIN COLUMN -->
    <div class="admin-form-main">

        <!-- Global SEO Settings -->
        <form method="post" action="/admin/seo" id="seoForm">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <input type="hidden" name="action" value="save_settings">

            <div class="admin-card">
                <div class="admin-card-header">Setari SEO globale</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label>Titlu site</label>
                        <input type="text" name="site_title" value="<?= htmlspecialchars($settings['site_title'] ?? '') ?>">
                    </div>
                    <div class="admin-field">
                        <label>Separator titlu</label>
                        <input type="text" name="title_separator" value="<?= htmlspecialchars($settings['title_separator'] ?? ' | ') ?>" style="max-width: 120px;">
                        <small class="admin-field-hint">Ex: " | ", " - ", " &mdash; ". Apare intre titlu pagina si numele site-ului.</small>
                    </div>
                    <div class="admin-field">
                        <label>Meta description implicita</label>
                        <textarea name="default_description" rows="3" maxlength="160"><?= htmlspecialchars($settings['default_description'] ?? '') ?></textarea>
                        <small class="admin-field-hint">Folosita cand o pagina nu are description proprie. Max 160 caractere.</small>
                    </div>
                </div>
            </div>

            <!-- Analytics -->
            <div class="admin-card">
                <div class="admin-card-header">Google Analytics / Tag Manager</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label>Google Analytics (Measurement ID)</label>
                        <input type="text" name="analytics_code" value="<?= htmlspecialchars($settings['analytics_code'] ?? '') ?>" placeholder="G-XXXXXXXXXX">
                        <small class="admin-field-hint">Ex: G-A1B2C3D4E5. Se adauga automat in &lt;head&gt;.</small>
                    </div>
                    <div class="admin-field">
                        <label>Google Tag Manager (Container ID)</label>
                        <input type="text" name="tag_manager_id" value="<?= htmlspecialchars($settings['tag_manager_id'] ?? '') ?>" placeholder="GTM-XXXXXXX">
                        <small class="admin-field-hint">Ex: GTM-ABC1234. Se adauga automat in &lt;head&gt; si &lt;body&gt;.</small>
                    </div>
                </div>
            </div>

            <!-- robots.txt -->
            <div class="admin-card">
                <div class="admin-card-header">robots.txt</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <textarea name="robots_txt" rows="8" class="admin-code-editor"><?= htmlspecialchars($settings['robots_txt'] ?? '') ?></textarea>
                        <small class="admin-field-hint">Continutul fisierului robots.txt. Accesibil la /robots.txt</small>
                    </div>
                </div>
            </div>

            <div style="margin-top: 1rem;">
                <button type="submit" class="btn btn-primary">Salveaza setarile SEO</button>
            </div>
        </form>

        <!-- 301 Redirects -->
        <div class="admin-card" style="margin-top: var(--spacing-lg);">
            <div class="admin-card-header">
                Redirecturi 301
                <button type="button" class="btn btn-sm btn-outline" onclick="addRedirectRow()" style="margin-left: auto;">+ Adauga redirect</button>
            </div>
            <div class="admin-card-body" style="padding: 0;">
                <form method="post" action="/admin/seo" id="redirectsForm">
                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                    <input type="hidden" name="action" value="save_redirects">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>De la (URL vechi)</th>
                                <th>Catre (URL nou)</th>
                                <th style="width: 70px;">Activ</th>
                                <th style="width: 60px;"></th>
                            </tr>
                        </thead>
                        <tbody id="redirectsBody">
                            <?php foreach (($settings['redirects'] ?? []) as $i => $r): ?>
                            <tr class="redirect-row">
                                <td><input type="text" name="redirect_from[]" value="<?= htmlspecialchars($r['from'] ?? '') ?>" placeholder="/url-vechi" class="admin-table-input"></td>
                                <td><input type="text" name="redirect_to[]" value="<?= htmlspecialchars($r['to'] ?? '') ?>" placeholder="/url-nou" class="admin-table-input"></td>
                                <td style="text-align:center;"><input type="checkbox" name="redirect_active[<?= $i ?>]" value="1" <?= ($r['active'] ?? true) ? 'checked' : '' ?>></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">&times;</button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div style="padding: 1rem;">
                        <button type="submit" class="btn btn-primary btn-sm">Salveaza redirecturile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SIDEBAR -->
    <div class="admin-form-side">

        <!-- Sitemap -->
        <div class="admin-card">
            <div class="admin-card-header">Sitemap XML</div>
            <div class="admin-card-body">
                <p style="font-size: var(--text-sm); color: var(--color-text-light); margin: 0;">Sitemap-ul se genereaza automat din categorii, produse si articole blog.</p>
                <div class="seo-sitemap-stats">
                    <?php foreach ($sitemapStats as $label => $count): ?>
                        <div class="seo-stat-row">
                            <span><?= htmlspecialchars($label) ?></span>
                            <strong><?= $count ?></strong>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="/sitemap.xml" class="btn btn-sm btn-outline btn-block" target="_blank" style="margin-top: 0.5rem;">&#8599; Vezi sitemap.xml</a>
                <a href="/robots.txt" class="btn btn-sm btn-outline btn-block" target="_blank">&#8599; Vezi robots.txt</a>
            </div>
        </div>

        <!-- Schema Markup Info -->
        <div class="admin-card">
            <div class="admin-card-header">Schema Markup (JSON-LD)</div>
            <div class="admin-card-body">
                <p style="font-size: var(--text-sm); color: var(--color-text-light); margin: 0 0 0.5rem;">Se genereaza automat pe pagini:</p>
                <div class="seo-schema-list">
                    <div class="seo-schema-item">&#10003; <strong>Organization</strong> — Homepage</div>
                    <div class="seo-schema-item">&#10003; <strong>LocalBusiness</strong> — Contact</div>
                    <div class="seo-schema-item">&#10003; <strong>Product</strong> — Pagini produs</div>
                    <div class="seo-schema-item">&#10003; <strong>Article</strong> — Articole blog</div>
                    <div class="seo-schema-item">&#10003; <strong>BreadcrumbList</strong> — Toate paginile</div>
                    <div class="seo-schema-item">&#10003; <strong>VideoObject</strong> — Pagina videouri</div>
                    <div class="seo-schema-item">&#10003; <strong>FAQPage</strong> — Pagini cu FAQ</div>
                </div>
            </div>
        </div>

        <!-- SERP Preview Info -->
        <div class="admin-card">
            <div class="admin-card-header">Scor SEO per pagina</div>
            <div class="admin-card-body">
                <p style="font-size: var(--text-sm); color: var(--color-text-light); margin: 0;">Preview SERP si scor SEO sunt disponibile in formularul fiecarei categorii, subcategorii si produs (sectiunea SEO).</p>
                <div class="seo-score-legend" style="margin-top: 0.5rem;">
                    <span class="seo-score-dot seo-score-green"></span> 70-100: Bun
                    <span class="seo-score-dot seo-score-yellow" style="margin-left: 0.75rem;"></span> 40-69: Mediocru
                    <span class="seo-score-dot seo-score-red" style="margin-left: 0.75rem;"></span> 0-39: Slab
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let redirectCounter = <?= count($settings['redirects'] ?? []) ?>;
function addRedirectRow() {
    const tbody = document.getElementById('redirectsBody');
    const tr = document.createElement('tr');
    tr.className = 'redirect-row';
    const idx = redirectCounter++;
    tr.innerHTML = `
        <td><input type="text" name="redirect_from[]" placeholder="/url-vechi" class="admin-table-input"></td>
        <td><input type="text" name="redirect_to[]" placeholder="/url-nou" class="admin-table-input"></td>
        <td style="text-align:center;"><input type="checkbox" name="redirect_active[${idx}]" value="1" checked></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">&times;</button></td>
    `;
    tbody.appendChild(tr);
    tr.querySelector('input').focus();
}
</script>
