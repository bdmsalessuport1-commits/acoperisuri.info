<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDM Systems - acoperisuri.info</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/logo/favicon-16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" sizes="192x192" href="/images/logo/favicon-192.png">
    <link rel="shortcut icon" href="/favicon.ico">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/variables.css">
    <link rel="stylesheet" href="/css/base.css">

    <style>
        /* Branding test page specific styles */
        .brand-test {
            padding: var(--spacing-2xl) 0;
        }

        .brand-header {
            background-color: var(--color-bg-header);
            padding: var(--spacing-2xl) 0;
            text-align: center;
            border-bottom: 3px solid var(--color-accent-green);
        }

        .brand-header img {
            max-width: 200px;
            margin: 0 auto var(--spacing-lg);
        }

        .brand-section {
            padding: var(--spacing-2xl) 0;
            border-bottom: 1px solid var(--color-border-light);
        }

        .brand-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: var(--text-xl);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--color-text-light);
            margin-bottom: var(--spacing-lg);
            font-weight: 600;
        }

        /* Color swatches */
        .color-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: var(--spacing-md);
        }

        .color-swatch {
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--color-border-light);
        }

        .color-swatch-block {
            height: 80px;
        }

        .color-swatch-info {
            padding: var(--spacing-sm) var(--spacing-md);
            background: var(--color-bg-white);
        }

        .color-swatch-name {
            font-family: var(--font-heading);
            font-weight: 600;
            font-size: var(--text-sm);
            color: var(--color-primary);
        }

        .color-swatch-hex {
            font-family: monospace;
            font-size: var(--text-xs);
            color: var(--color-text-light);
        }

        /* Typography showcase */
        .typo-sample {
            margin-bottom: var(--spacing-lg);
            padding-bottom: var(--spacing-lg);
            border-bottom: 1px solid var(--color-border-light);
        }

        .typo-sample:last-child {
            border-bottom: none;
        }

        .typo-label {
            font-family: monospace;
            font-size: var(--text-xs);
            color: var(--color-text-light);
            margin-bottom: var(--spacing-xs);
        }

        /* Button showcase */
        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            align-items: center;
        }

        /* Shadow showcase */
        .shadow-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: var(--spacing-lg);
        }

        .shadow-box {
            padding: var(--spacing-xl);
            background: var(--color-bg-white);
            border-radius: var(--radius-md);
            text-align: center;
            font-family: monospace;
            font-size: var(--text-sm);
            color: var(--color-text-light);
        }

        /* Footer */
        .brand-footer {
            background-color: var(--color-primary);
            color: var(--color-bg-white);
            padding: var(--spacing-2xl) 0;
            text-align: center;
        }

        .brand-footer p {
            color: rgba(255, 255, 255, 0.7);
            font-size: var(--text-sm);
        }

        @media (max-width: 480px) {
            .color-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

    <!-- Header with Logo -->
    <header class="brand-header">
        <div class="container">
            <img src="/images/logo/logo-full.png" alt="BDM Systems Logo">
            <h1>BDM Systems - acoperisuri.info</h1>
            <p class="text-light">Pagina de test branding - Identitate vizuala</p>
        </div>
    </header>

    <main class="container">

        <!-- Color Palette -->
        <section class="brand-section">
            <p class="section-title">Paleta de culori</p>
            <div class="color-grid">
                <div class="color-swatch">
                    <div class="color-swatch-block" style="background-color: var(--color-primary);"></div>
                    <div class="color-swatch-info">
                        <div class="color-swatch-name">Primary Navy</div>
                        <div class="color-swatch-hex">#00204A</div>
                    </div>
                </div>
                <div class="color-swatch">
                    <div class="color-swatch-block" style="background-color: var(--color-secondary);"></div>
                    <div class="color-swatch-info">
                        <div class="color-swatch-name">Secondary</div>
                        <div class="color-swatch-hex">#2D2B48</div>
                    </div>
                </div>
                <div class="color-swatch">
                    <div class="color-swatch-block" style="background-color: var(--color-accent-green);"></div>
                    <div class="color-swatch-info">
                        <div class="color-swatch-name">Accent Green</div>
                        <div class="color-swatch-hex">#12A757</div>
                    </div>
                </div>
                <div class="color-swatch">
                    <div class="color-swatch-block" style="background-color: var(--color-accent-blue);"></div>
                    <div class="color-swatch-info">
                        <div class="color-swatch-name">Accent Blue</div>
                        <div class="color-swatch-hex">#14A4D4</div>
                    </div>
                </div>
                <div class="color-swatch">
                    <div class="color-swatch-block" style="background-color: var(--color-text);"></div>
                    <div class="color-swatch-info">
                        <div class="color-swatch-name">Text</div>
                        <div class="color-swatch-hex">#54595F</div>
                    </div>
                </div>
                <div class="color-swatch">
                    <div class="color-swatch-block" style="background-color: var(--color-text-light);"></div>
                    <div class="color-swatch-info">
                        <div class="color-swatch-name">Text Light</div>
                        <div class="color-swatch-hex">#7A7A7A</div>
                    </div>
                </div>
                <div class="color-swatch">
                    <div class="color-swatch-block" style="background-color: var(--color-red);"></div>
                    <div class="color-swatch-info">
                        <div class="color-swatch-name">Red / Error</div>
                        <div class="color-swatch-hex">#E00808</div>
                    </div>
                </div>
                <div class="color-swatch">
                    <div class="color-swatch-block" style="background-color: var(--color-bg-header);"></div>
                    <div class="color-swatch-info">
                        <div class="color-swatch-name">Background Header</div>
                        <div class="color-swatch-hex">#F5FAFF</div>
                    </div>
                </div>
                <div class="color-swatch">
                    <div class="color-swatch-block" style="background-color: var(--color-bg-light);"></div>
                    <div class="color-swatch-info">
                        <div class="color-swatch-name">Background Light</div>
                        <div class="color-swatch-hex">#F0F4F8</div>
                    </div>
                </div>
                <div class="color-swatch">
                    <div class="color-swatch-block" style="background-color: var(--color-border); border: 1px solid var(--color-border);"></div>
                    <div class="color-swatch-info">
                        <div class="color-swatch-name">Border</div>
                        <div class="color-swatch-hex">#D0D5DD</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Typography -->
        <section class="brand-section">
            <p class="section-title">Tipografie</p>

            <div class="typo-sample">
                <div class="typo-label">h1 - Public Sans 700 / 2.25rem</div>
                <h1 style="margin-bottom: 0;">Heading 1 - Acoperisuri de calitate</h1>
            </div>
            <div class="typo-sample">
                <div class="typo-label">h2 - Public Sans 700 / 1.875rem</div>
                <h2 style="margin-bottom: 0;">Heading 2 - Servicii profesionale</h2>
            </div>
            <div class="typo-sample">
                <div class="typo-label">h3 - Public Sans 700 / 1.5rem</div>
                <h3 style="margin-bottom: 0;">Heading 3 - Materiale premium</h3>
            </div>
            <div class="typo-sample">
                <div class="typo-label">h4 - Public Sans 700 / 1.25rem</div>
                <h4 style="margin-bottom: 0;">Heading 4 - Garantie extinsa</h4>
            </div>
            <div class="typo-sample">
                <div class="typo-label">h5 - Public Sans 700 / 1.125rem</div>
                <h5 style="margin-bottom: 0;">Heading 5 - Echipa experimentata</h5>
            </div>
            <div class="typo-sample">
                <div class="typo-label">h6 - Public Sans 700 / 1rem</div>
                <h6 style="margin-bottom: 0;">Heading 6 - Detalii proiect</h6>
            </div>
            <div class="typo-sample">
                <div class="typo-label">p - Roboto 400 / 1rem / line-height 1.6</div>
                <p style="margin-bottom: 0;">BDM Systems ofera solutii complete pentru acoperisuri, de la consultanta si proiectare pana la montaj si intretinere. Cu o experienta de peste 15 ani in domeniu, suntem partenerul ideal pentru proiectul tau de constructie sau renovare.</p>
            </div>
            <div class="typo-sample">
                <div class="typo-label">a - Link cu hover</div>
                <p style="margin-bottom: 0;">Viziteaza <a href="#">pagina noastra de servicii</a> pentru mai multe detalii despre oferta BDM Systems.</p>
            </div>
        </section>

        <!-- Buttons -->
        <section class="brand-section">
            <p class="section-title">Butoane</p>
            <div class="button-row mb-lg">
                <button class="btn btn-primary">Solicita oferta</button>
                <button class="btn btn-secondary">Despre noi</button>
                <button class="btn btn-outline">Proiecte realizate</button>
            </div>
            <div class="button-row mb-lg">
                <button class="btn btn-primary btn-lg">Buton Large Primary</button>
                <button class="btn btn-secondary btn-lg">Buton Large Secondary</button>
            </div>
            <div class="button-row">
                <button class="btn btn-primary btn-sm">Buton Small</button>
                <button class="btn btn-secondary btn-sm">Buton Small</button>
                <button class="btn btn-outline btn-sm">Buton Small Outline</button>
            </div>
        </section>

        <!-- Shadows -->
        <section class="brand-section">
            <p class="section-title">Umbre (Shadows)</p>
            <div class="shadow-grid">
                <div class="shadow-box" style="box-shadow: var(--shadow-sm);">shadow-sm</div>
                <div class="shadow-box" style="box-shadow: var(--shadow-md);">shadow-md</div>
                <div class="shadow-box" style="box-shadow: var(--shadow-lg);">shadow-lg</div>
                <div class="shadow-box" style="box-shadow: var(--shadow-xl);">shadow-xl</div>
            </div>
        </section>

        <!-- Border Radius -->
        <section class="brand-section">
            <p class="section-title">Border Radius</p>
            <div class="button-row">
                <div style="width:80px;height:80px;background:var(--color-accent-green);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:#fff;font-size:var(--text-xs);font-family:monospace;">4px</div>
                <div style="width:80px;height:80px;background:var(--color-accent-blue);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;color:#fff;font-size:var(--text-xs);font-family:monospace;">8px</div>
                <div style="width:80px;height:80px;background:var(--color-primary);border-radius:var(--radius-lg);display:flex;align-items:center;justify-content:center;color:#fff;font-size:var(--text-xs);font-family:monospace;">12px</div>
                <div style="width:80px;height:80px;background:var(--color-secondary);border-radius:var(--radius-xl);display:flex;align-items:center;justify-content:center;color:#fff;font-size:var(--text-xs);font-family:monospace;">16px</div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="brand-footer">
        <div class="container">
            <p>&copy; 2026 BDM Systems. Toate drepturile rezervate.</p>
            <p class="mt-sm">acoperisuri.info - Branding Test Page</p>
        </div>
    </footer>

</body>
</html>
