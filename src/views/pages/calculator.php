<!-- HERO -->
<section class="page-hero">
    <div class="container">
        <h1>Calculator cost acoperis</h1>
        <p class="page-hero-desc">Estimeaza rapid costul materialelor pentru acoperisul tau. Selecteaza tipul de invelitoare, suprafata si obtine o estimare orientativa.</p>
    </div>
</section>

<!-- CALCULATOR -->
<section class="section">
    <div class="container">
        <div class="calc-wrapper">

            <div class="calc-form-area">
                <h2>Completeaza datele acoperisului</h2>

                <!-- Tip invelitoare -->
                <div class="calc-field">
                    <label for="calc-tip">Tip invelitoare</label>
                    <select id="calc-tip">
                        <option value="">— Selecteaza —</option>
                        <option value="tigla-metalica" data-pret-min="28" data-pret-max="45">Tigla metalica</option>
                        <option value="tabla-faltuita" data-pret-min="35" data-pret-max="60">Tabla faltuita</option>
                        <option value="tabla-click" data-pret-min="32" data-pret-max="55">Tabla click</option>
                        <option value="tabla-cutata" data-pret-min="22" data-pret-max="38">Tabla cutata</option>
                    </select>
                </div>

                <!-- Suprafata -->
                <div class="calc-field">
                    <label for="calc-suprafata">Suprafata acoperis (m&sup2;)</label>
                    <input type="number" id="calc-suprafata" min="10" max="2000" step="1" placeholder="ex: 150">
                </div>

                <!-- Accesorii -->
                <div class="calc-field">
                    <label>Accesorii incluse</label>
                    <div class="calc-checkboxes">
                        <label class="calc-checkbox">
                            <input type="checkbox" id="calc-folii" data-pret="8"> Folie anticondens
                        </label>
                        <label class="calc-checkbox">
                            <input type="checkbox" id="calc-sipci" data-pret="6"> Sipci metalice
                        </label>
                        <label class="calc-checkbox">
                            <input type="checkbox" id="calc-pluviale" data-pret="12"> Sistem pluvial
                        </label>
                        <label class="calc-checkbox">
                            <input type="checkbox" id="calc-parazapezi" data-pret="5"> Parazapezi
                        </label>
                    </div>
                </div>

                <!-- Montaj -->
                <div class="calc-field">
                    <label>Doriti si montaj?</label>
                    <div class="calc-radio-group">
                        <label class="calc-radio">
                            <input type="radio" name="montaj" value="0" checked> Doar materiale
                        </label>
                        <label class="calc-radio">
                            <input type="radio" name="montaj" value="25"> Da, cu montaj (+25 lei/m&sup2;)
                        </label>
                    </div>
                </div>

                <button class="btn btn-primary btn-lg calc-submit" id="calcSubmit">&#128202; Calculeaza costul</button>
            </div>

            <!-- REZULTAT -->
            <div class="calc-result-area" id="calcResult" style="display:none;">
                <div class="calc-result-card">
                    <h3>Estimare cost acoperis</h3>
                    <div class="calc-result-type" id="resultType"></div>
                    <div class="calc-result-suprafata" id="resultSuprafata"></div>

                    <div class="calc-result-breakdown" id="resultBreakdown"></div>

                    <div class="calc-result-total">
                        <div class="calc-total-label">Cost estimat total:</div>
                        <div class="calc-total-range">
                            <span class="calc-total-min" id="resultMin"></span>
                            <span class="calc-total-separator"> — </span>
                            <span class="calc-total-max" id="resultMax"></span>
                        </div>
                    </div>

                    <div class="calc-result-note">
                        <p>&#9432; Preturile sunt orientative si pot varia in functie de profilul ales, grosimea tablei, culoarea si cantitatea exacta. Pentru o oferta personalizata, contactati-ne.</p>
                    </div>

                    <div class="calc-result-actions">
                        <a href="/contact" class="btn btn-primary btn-lg">Solicita oferta exacta</a>
                        <a href="tel:+40756034734" class="btn btn-outline-green btn-lg">&#128222; 0756.034.734</a>
                    </div>
                </div>
            </div>

            <!-- EROARE -->
            <div class="calc-error" id="calcError" style="display:none;">
                <p id="calcErrorMsg"></p>
            </div>

        </div>
    </div>
</section>

<!-- INFO -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header">
            <h2>De ce sa alegi BDM Systems?</h2>
            <p>Peste 14 ani de experienta si 4000+ acoperisuri realizate</p>
        </div>
        <div class="grid grid-3">
            <div class="service-card">
                <div class="service-icon">&#128176;</div>
                <h3>Preturi de producator</h3>
                <p>Lucram direct cu producatorii: Budmat, Metigla, Wetterbest, Rufster. Fara intermediari, preturi competitive.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">&#128666;</div>
                <h3>Livrare in toata tara</h3>
                <p>Livram materialele direct la santier, in toata Romania. Transport rapid si in siguranta.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">&#128736;</div>
                <h3>Montaj profesional</h3>
                <p>Echipe proprii cu experienta de peste 10 ani. Garantie manopera si materiale.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-final">
    <div class="container">
        <h2>Vrei o oferta personalizata?</h2>
        <p>Contacteaza-ne pentru o estimare exacta, adaptata proiectului tau.</p>
        <a href="/contact" class="btn btn-lg">Solicita oferta gratuita</a>
        <div class="cta-phone">
            <a href="tel:+40756034734">&#128222; 0756.034.734</a>
        </div>
    </div>
</section>

<script>
(function(){
    var btn = document.getElementById('calcSubmit');
    var resultArea = document.getElementById('calcResult');
    var errorArea = document.getElementById('calcError');

    btn.addEventListener('click', function(){
        var tip = document.getElementById('calc-tip');
        var suprafata = parseFloat(document.getElementById('calc-suprafata').value);
        var montaj = document.querySelector('input[name="montaj"]:checked').value;

        // Reset
        resultArea.style.display = 'none';
        errorArea.style.display = 'none';

        // Validate
        if (!tip.value) {
            showError('Selectati tipul de invelitoare.');
            return;
        }
        if (!suprafata || suprafata < 10) {
            showError('Introduceti o suprafata valida (minim 10 m\u00B2).');
            return;
        }
        if (suprafata > 2000) {
            showError('Pentru suprafete mai mari de 2000 m\u00B2, va rugam sa ne contactati direct.');
            return;
        }

        var sel = tip.options[tip.selectedIndex];
        var pretMin = parseFloat(sel.dataset.pretMin);
        var pretMax = parseFloat(sel.dataset.pretMax);
        var tipName = sel.text;

        var breakdown = [];
        breakdown.push({name: tipName, min: pretMin * suprafata, max: pretMax * suprafata});

        // Accesorii
        var checkboxes = document.querySelectorAll('.calc-checkboxes input[type="checkbox"]');
        checkboxes.forEach(function(cb){
            if (cb.checked) {
                var pret = parseFloat(cb.dataset.pret);
                var label = cb.parentElement.textContent.trim();
                breakdown.push({name: label, min: pret * suprafata, max: pret * suprafata});
            }
        });

        // Montaj
        var montajPret = parseFloat(montaj);
        if (montajPret > 0) {
            breakdown.push({name: 'Montaj profesional', min: montajPret * suprafata, max: montajPret * suprafata});
        }

        var totalMin = 0, totalMax = 0;
        var html = '';
        breakdown.forEach(function(item){
            totalMin += item.min;
            totalMax += item.max;
            html += '<div class="calc-breakdown-row">';
            html += '<span class="calc-breakdown-name">' + item.name + '</span>';
            if (item.min === item.max) {
                html += '<span class="calc-breakdown-val">' + formatLei(item.min) + '</span>';
            } else {
                html += '<span class="calc-breakdown-val">' + formatLei(item.min) + ' - ' + formatLei(item.max) + '</span>';
            }
            html += '</div>';
        });

        document.getElementById('resultType').textContent = tipName;
        document.getElementById('resultSuprafata').textContent = suprafata + ' m\u00B2';
        document.getElementById('resultBreakdown').innerHTML = html;
        document.getElementById('resultMin').textContent = formatLei(totalMin);
        document.getElementById('resultMax').textContent = formatLei(totalMax);

        resultArea.style.display = 'block';
        resultArea.scrollIntoView({behavior: 'smooth', block: 'start'});
    });

    function showError(msg) {
        document.getElementById('calcErrorMsg').textContent = msg;
        errorArea.style.display = 'block';
    }

    function formatLei(val) {
        return val.toLocaleString('ro-RO', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' lei';
    }
})();
</script>
