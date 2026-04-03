/**
 * Migration: Add all missing Fakro products
 * - Update category 10 (Ferestre FAKRO)
 * - Rename subcategory 29, add subcategories 52-55
 * - Add missing ferestre mansarda, ferestre terasa, tunele lumina, luminatoare
 * - Add missing scari pod
 */
const fs = require('fs');
const path = require('path');

const dataDir = path.join(__dirname, '..', 'data');
const now = '2026-04-03 10:00:00';

// ---- CATEGORIES ----
const categories = JSON.parse(fs.readFileSync(path.join(dataDir, 'categories.json'), 'utf8'));
const cat10 = categories.find(c => c.id === 10);
if (cat10) {
    cat10.name = 'Ferestre si luminatoare FAKRO';
    cat10.slug = 'ferestre-fakro';
    cat10.description = 'Ferestre de mansarda, ferestre pentru acoperis terasa, tunele de lumina si luminatoare FAKRO. Iluminare naturala, ventilatie si acces pe acoperis.';
    cat10.seo_title = 'Ferestre FAKRO - Mansarda, Terasa, Tunele de Lumina, Luminatoare';
    cat10.seo_text = '<h2>Ferestre si luminatoare FAKRO</h2>\n<p>FAKRO este unul dintre cei mai importanti producatori europeni de ferestre de mansarda, ferestre pentru acoperis terasa, tunele de lumina si luminatoare. Toate produsele FAKRO ofera iluminare naturala superioara, ventilatie eficienta si acces sigur pe acoperis.</p>\n<h3>Categorii de produse FAKRO</h3>\n<ul>\n<li>Ferestre de mansarda - cu centru de rotatie, preSelect MAX, PVC, supertermoizolante</li>\n<li>Ferestre pentru acoperis terasa - tip C, tip F, circulabile DXW</li>\n<li>Tunele de lumina - cu tub rigid SRT si flexibil SLT</li>\n<li>Luminatoare - WLI, WGI, WGT pentru acces pe acoperis</li>\n</ul>';
    cat10.updated_at = now;
}
fs.writeFileSync(path.join(dataDir, 'categories.json'), JSON.stringify(categories, null, 4));
console.log('Categories updated.');

// ---- SUBCATEGORIES ----
const subcategories = JSON.parse(fs.readFileSync(path.join(dataDir, 'subcategories.json'), 'utf8'));
const sub29 = subcategories.find(s => s.id === 29);
if (sub29) {
    sub29.name = 'Ferestre mansarda';
    sub29.slug = 'ferestre-mansarda';
    sub29.description = 'Ferestre de mansarda FAKRO cu deschidere mediana, preSelect MAX, PVC si supertermoizolante';
    sub29.count = 15; // 7 existing + 8 new
    sub29.updated_at = now;
}

const newSubs = [
    {
        id: 52, category_id: 10, name: 'Ferestre acoperis terasa', slug: 'ferestre-acoperis-terasa',
        description: 'Ferestre FAKRO pentru acoperis plat si terasa - tip C, tip F, circulabile DXW, acces si evacuare fum',
        image: '', icon: '&#9632;', count: 8, seo_title: '', seo_description: '', seo_text: '',
        sort_order: 2, is_active: true, created_at: now, updated_at: now
    },
    {
        id: 53, category_id: 10, name: 'Tunele de lumina', slug: 'tunele-de-lumina',
        description: 'Tunele de lumina FAKRO cu tub rigid SRT si flexibil SLT pentru iluminare naturala',
        image: '', icon: '&#9728;', count: 4, seo_title: '', seo_description: '', seo_text: '',
        sort_order: 3, is_active: true, created_at: now, updated_at: now
    },
    {
        id: 54, category_id: 10, name: 'Luminatoare', slug: 'luminatoare',
        description: 'Luminatoare FAKRO WLI, WGI, WGT pentru acces si iluminare pod',
        image: '', icon: '&#128161;', count: 3, seo_title: '', seo_description: '', seo_text: '',
        sort_order: 4, is_active: true, created_at: now, updated_at: now
    }
];
subcategories.push(...newSubs);
fs.writeFileSync(path.join(dataDir, 'subcategories.json'), JSON.stringify(subcategories, null, 4));
console.log('Subcategories updated.');

// ---- PRODUCTS ----
const products = JSON.parse(fs.readFileSync(path.join(dataDir, 'products.json'), 'utf8'));
let nextId = Math.max(...products.map(p => p.id)) + 1;

function addProduct(p) {
    p.id = nextId++;
    p.manufacturer = p.manufacturer || 'FAKRO';
    p.status = 'activ';
    p.image_main = '';
    p.image_schema = '';
    p.gallery = [];
    p.seo_title = '';
    p.seo_description = '';
    p.sort_order = p.id;
    p.is_active = true;
    p.created_at = now;
    p.updated_at = now;
    products.push(p);
    return p;
}

// ============================================================
// FERESTRE MANSARDA - 8 missing models (cat 10, sub 29)
// ============================================================

addProduct({
    name: 'FAKRO FTP-V U4', slug: 'fakro-ftp-v-u4', category_id: 10, subcategory_id: 29,
    subtitle: 'Fereastra mansarda cu geam triplu, izolatie termica superioara. U=0.95 W/m\u00b2K.',
    specs: [
        { key: 'Coeficient U fereastra', value: '0.95 W/m\u00b2K', sort_order: 1 },
        { key: 'Tip geam', value: 'Triplu - 3 sticle cu argon', sort_order: 2 },
        { key: 'Deschidere', value: 'Centru de rotatie (mediana)', sort_order: 3 },
        { key: 'Material rama', value: 'Pin tratat fungicid, lacuit', sort_order: 4 },
        { key: 'Panta acoperis', value: '15 - 90 grade', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Pin natural lacuit', code: 'Standard', hex: '#c4a96a', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Geam triplu cu argon. Certificat CE.',
    description_html: '<h2>FAKRO FTP-V U4 - geam triplu pentru izolatie superioara</h2>\n<p>FTP-V U4 ofera un pas important in izolatie termica fata de modelul U3, cu geam triplu si coeficient U de 0.95 W/m\u00b2K. Ideal pentru case cu cerinte energetice ridicate.</p>\n<ul>\n<li>Geam triplu cu argon - izolatie termica excelenta</li>\n<li>Deschidere mediana - curatare usoara din interior</li>\n<li>Pin de calitate tratat si lacuit</li>\n<li>Compatibil cu toate accesoriile FAKRO</li>\n</ul>',
    related_products: ['fakro-ftp-v-u3', 'fakro-ftp-v-u5']
});

addProduct({
    name: 'FAKRO FTU-V U3', slug: 'fakro-ftu-v-u3', category_id: 10, subcategory_id: 29,
    subtitle: 'Fereastra mansarda cu finisaj poliuretanic alb. Rezistenta la umiditate, ideala pentru bai si bucatarii.',
    specs: [
        { key: 'Coeficient U fereastra', value: '1.3 W/m\u00b2K', sort_order: 1 },
        { key: 'Tip geam', value: 'Dublu cu argon', sort_order: 2 },
        { key: 'Deschidere', value: 'Centru de rotatie (mediana)', sort_order: 3 },
        { key: 'Material rama', value: 'Pin cu lac poliuretanic alb', sort_order: 4 },
        { key: 'Panta acoperis', value: '15 - 90 grade', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Alb poliuretanic', code: 'White PU', hex: '#f5f5f5', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Finisaj poliuretanic rezistent la umiditate.',
    description_html: '<h2>FAKRO FTU-V U3 - finisaj alb rezistent la umiditate</h2>\n<p>FTU-V U3 are acelasi performante ca FTP-V U3, dar cu un finisaj poliuretanic alb care il face rezistent la umiditate. Perfect pentru bai, bucatarii si spatii umede.</p>\n<ul>\n<li>Lac poliuretanic alb - rezistent la umiditate si usor de curatat</li>\n<li>Aspect modern, alb, se integreaza perfect in orice interior</li>\n<li>Aceleasi performante termice ca FTP-V U3</li>\n</ul>',
    related_products: ['fakro-ftp-v-u3', 'fakro-ptp-v-u3']
});

addProduct({
    name: 'FAKRO PTP-V U3', slug: 'fakro-ptp-v-u3', category_id: 10, subcategory_id: 29,
    subtitle: 'Fereastra mansarda PVC cu centru de rotatie. Rezistenta la umiditate, intretinere zero.',
    specs: [
        { key: 'Coeficient U fereastra', value: '1.3 W/m\u00b2K', sort_order: 1 },
        { key: 'Tip geam', value: 'Dublu cu argon', sort_order: 2 },
        { key: 'Deschidere', value: 'Centru de rotatie (mediana)', sort_order: 3 },
        { key: 'Material rama', value: 'PVC multi-camera, armat cu otel', sort_order: 4 },
        { key: 'Panta acoperis', value: '15 - 90 grade', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Alb PVC', code: 'White PVC', hex: '#ffffff', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Profil PVC multi-camera, armat cu otel galvanizat.',
    description_html: '<h2>FAKRO PTP-V U3 - fereastra PVC pentru mansarda</h2>\n<p>PTP-V U3 este varianta PVC a gamei FAKRO cu centru de rotatie. Profilul multi-camera din PVC armat cu otel ofera rezistenta la umiditate si intretinere zero.</p>\n<ul>\n<li>Profil PVC multi-camera - fara intretinere, rezistent la umiditate</li>\n<li>Armat cu profil U din otel galvanizat pentru rigiditate</li>\n<li>Ideal pentru bai, bucatarii si spatii umede</li>\n<li>Aspect alb modern</li>\n</ul>',
    related_products: ['fakro-ptp-v-u4', 'fakro-ftu-v-u3']
});

addProduct({
    name: 'FAKRO PTP-V U4', slug: 'fakro-ptp-v-u4', category_id: 10, subcategory_id: 29,
    subtitle: 'Fereastra mansarda PVC cu geam triplu. Izolatie termica superioara, fara intretinere.',
    specs: [
        { key: 'Coeficient U fereastra', value: '0.95 W/m\u00b2K', sort_order: 1 },
        { key: 'Tip geam', value: 'Triplu - 3 sticle cu argon', sort_order: 2 },
        { key: 'Deschidere', value: 'Centru de rotatie (mediana)', sort_order: 3 },
        { key: 'Material rama', value: 'PVC multi-camera, armat cu otel', sort_order: 4 },
        { key: 'Panta acoperis', value: '15 - 90 grade', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Alb PVC', code: 'White PVC', hex: '#ffffff', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. PVC cu geam triplu, izolatie excelenta.',
    description_html: '<h2>FAKRO PTP-V U4 - PVC cu geam triplu</h2>\n<p>PTP-V U4 combina avantajele profilului PVC (zero intretinere, rezistenta la umiditate) cu geamul triplu pentru izolatie termica superioara.</p>\n<ul>\n<li>Geam triplu cu argon - U=0.95 W/m\u00b2K</li>\n<li>Profil PVC multi-camera fara intretinere</li>\n<li>Ideal pentru case cu cerinte energetice ridicate</li>\n</ul>',
    related_products: ['fakro-ptp-v-u3', 'fakro-ptp-v-u5']
});

addProduct({
    name: 'FAKRO PTP-V U5', slug: 'fakro-ptp-v-u5', category_id: 10, subcategory_id: 29,
    subtitle: 'Fereastra mansarda PVC supertermoizolatoare. Cel mai performant model PVC FAKRO.',
    specs: [
        { key: 'Coeficient U fereastra', value: '0.76 W/m\u00b2K', sort_order: 1 },
        { key: 'Tip geam', value: 'Triplu supertermoizolant cu argon', sort_order: 2 },
        { key: 'Deschidere', value: 'Centru de rotatie (mediana)', sort_order: 3 },
        { key: 'Material rama', value: 'PVC multi-camera, armat cu otel', sort_order: 4 },
        { key: 'Panta acoperis', value: '15 - 90 grade', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Alb PVC', code: 'White PVC', hex: '#ffffff', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Supertermoizolant, ideal case pasive.',
    description_html: '<h2>FAKRO PTP-V U5 - PVC supertermoizolant</h2>\n<p>PTP-V U5 este cel mai performant model PVC din gama FAKRO, cu coeficient termic U=0.76 W/m\u00b2K. Ideal pentru case pasive si constructii cu cerinte energetice foarte ridicate.</p>\n<ul>\n<li>Coeficient U = 0.76 W/m\u00b2K - performanta termica de top</li>\n<li>Profil PVC fara intretinere</li>\n<li>Potrivit pentru case pasive si nZEB</li>\n</ul>',
    related_products: ['fakro-ptp-v-u4', 'fakro-ftp-v-u5']
});

addProduct({
    name: 'FAKRO FTT U8 Thermo', slug: 'fakro-ftt-u8-thermo', category_id: 10, subcategory_id: 29,
    subtitle: 'Fereastra mansarda supertermoizolatoare pentru case pasive. U=0.58 W/m\u00b2K - cea mai calda fereastra de mansarda.',
    specs: [
        { key: 'Coeficient U fereastra', value: '0.58 W/m\u00b2K', sort_order: 1 },
        { key: 'Tip geam', value: 'U8 - triplu cu argon, emisivitate joasa', sort_order: 2 },
        { key: 'Deschidere', value: 'Centru de rotatie (mediana)', sort_order: 3 },
        { key: 'Material rama', value: 'Pin tratat, izolatie suplimentara', sort_order: 4 },
        { key: 'Panta acoperis', value: '15 - 90 grade', sort_order: 5 },
        { key: 'Certificare', value: 'Passive House certified', sort_order: 6 },
        { key: 'Garantie', value: '10 ani', sort_order: 7 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Pin natural lacuit', code: 'Standard', hex: '#c4a96a', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Certificat Passive House. Cel mai cald geam de mansarda.',
    description_html: '<h2>FAKRO FTT U8 Thermo - cea mai calda fereastra de mansarda</h2>\n<p>FTT U8 Thermo este sistemul complet format din fereastra FTT U8, rama de etansare EHV-AT Thermo si setul de izolatie XDK. Cu U=0.58 W/m\u00b2K, este cea mai calda fereastra de mansarda de pe piata cu un singur pachet de geam termic.</p>\n<ul>\n<li>U = 0.58 W/m\u00b2K - record mondial pentru geam simplu termic</li>\n<li>Certificat Passive House - confirmat pentru case pasive</li>\n<li>Include rama etansare Thermo si set izolatie XDK</li>\n<li>Ideal pentru constructii nZEB si case pasive</li>\n</ul>',
    related_products: ['fakro-ftp-v-u5', 'fakro-ptp-v-u5']
});

addProduct({
    name: 'FAKRO FGH-V P5 Galeria', slug: 'fakro-fgh-v-p5-galeria', category_id: 10, subcategory_id: 29,
    subtitle: 'Fereastra-balcon pentru mansarda. Se transforma din fereastra in balcon cu un singur gest.',
    specs: [
        { key: 'Tip', value: 'Fereastra-balcon', sort_order: 1 },
        { key: 'Deschidere', value: 'Partea superioara - basculanta, partea inferioara - spre exterior', sort_order: 2 },
        { key: 'Material rama', value: 'Pin tratat fungicid, lacuit', sort_order: 3 },
        { key: 'Panta acoperis', value: '35 - 55 grade', sort_order: 4 },
        { key: 'Balustrada', value: 'Laterala inclusa', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Pin natural lacuit', code: 'Standard', hex: '#c4a96a', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Fereastra-balcon unica pe piata.',
    description_html: '<h2>FAKRO FGH-V P5 Galeria - fereastra care devine balcon</h2>\n<p>FGH-V P5 Galeria este o fereastra inovatoare care se transforma in balcon. Partea superioara se deschide basculant iar partea inferioara se rabate spre exterior, creand un balcon cu balustrada laterala.</p>\n<ul>\n<li>Se transforma din fereastra in balcon in cateva secunde</li>\n<li>Balustrada laterala inclusa pentru siguranta</li>\n<li>Permite iesirea pe acoperis si bucurarea de lumina naturala</li>\n<li>Panta acoperis: 35-55 grade</li>\n</ul>',
    related_products: ['fakro-fdy-v-u3', 'fakro-fpu-v-u3']
});

addProduct({
    name: 'FAKRO FPU-V U5 preSelect MAX', slug: 'fakro-fpu-v-u5', category_id: 10, subcategory_id: 29,
    subtitle: 'Fereastra mansarda supertermoizolatoare cu dubla deschidere preSelect. Lac poliuretanic alb, U=0.76.',
    specs: [
        { key: 'Coeficient U fereastra', value: '0.76 W/m\u00b2K', sort_order: 1 },
        { key: 'Tip geam', value: 'Triplu supertermoizolant cu argon', sort_order: 2 },
        { key: 'Deschidere', value: 'Dubla - mediana + superioara (preSelect)', sort_order: 3 },
        { key: 'Material rama', value: 'Pin cu lac poliuretanic alb', sort_order: 4 },
        { key: 'Panta acoperis', value: '15 - 90 grade', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Alb poliuretanic', code: 'White PU', hex: '#f5f5f5', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Dubla deschidere preSelect, supertermoizolant.',
    description_html: '<h2>FAKRO FPU-V U5 preSelect MAX - premium supertermoizolant</h2>\n<p>FPU-V U5 combina sistemul de dubla deschidere preSelect MAX cu geamul supertermoizolant U5 si finisajul poliuretanic alb. Este modelul premium din gama FAKRO.</p>\n<ul>\n<li>Dubla deschidere preSelect - mediana sau superioara, la alegere</li>\n<li>U = 0.76 W/m\u00b2K - performanta pentru case eficiente energetic</li>\n<li>Finisaj poliuretanic alb - rezistent la umiditate</li>\n<li>Ventilatie V40P - 40 m\u00b3/h</li>\n</ul>',
    related_products: ['fakro-fpu-v-u3', 'fakro-fpp-v-u3']
});

// ============================================================
// FERESTRE ACOPERIS TERASA - 8 models (cat 10, sub 52)
// ============================================================

addProduct({
    name: 'FAKRO DXC-C P2 Tip C', slug: 'fakro-dxc-c-p2', category_id: 10, subcategory_id: 52,
    subtitle: 'Fereastra acoperis terasa tip C cu cupola policarbonat si geam dublu. Panta 0-15 grade.',
    specs: [
        { key: 'Tip', value: 'Tip C - cu cupola policarbonat', sort_order: 1 },
        { key: 'Geam', value: 'Dublu cu argon', sort_order: 2 },
        { key: 'Cupola', value: 'Policarbonat transparent', sort_order: 3 },
        { key: 'Panta acoperis', value: '0 - 15 grade', sort_order: 4 },
        { key: 'Deschidere', value: 'Fixa', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Alb PVC', code: 'Standard', hex: '#ffffff', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Cupola policarbonat rezistenta la impact.',
    description_html: '<h2>FAKRO DXC-C P2 - fereastra terasa tip C</h2>\n<p>Fereastra tip C cu cupola din policarbonat ofera iluminare naturala pentru acoperisuri plate. Cupola protejeaza geamul de intemperii si asigura evacuarea apei pluviale.</p>\n<ul>\n<li>Cupola policarbonat - rezistenta la impact si UV</li>\n<li>Geam dublu P2 cu protectie antiefractie</li>\n<li>Montaj pe acoperis plat, panta 0-15 grade</li>\n</ul>',
    related_products: ['fakro-dxf-du6', 'fakro-dxw']
});

addProduct({
    name: 'FAKRO DXF DU6 Tip F', slug: 'fakro-dxf-du6', category_id: 10, subcategory_id: 52,
    subtitle: 'Fereastra acoperis terasa tip F cu geam plat DU6, fixa. Design modern fara cupola, U=0.64.',
    specs: [
        { key: 'Tip', value: 'Tip F - geam plat, fara cupola', sort_order: 1 },
        { key: 'Coeficient U fereastra', value: '0.64 W/m\u00b2K', sort_order: 2 },
        { key: 'Geam', value: 'DU6 triplu termoizolant', sort_order: 3 },
        { key: 'Panta acoperis', value: '0 - 15 grade', sort_order: 4 },
        { key: 'Deschidere', value: 'Fixa', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Alb PVC', code: 'Standard', hex: '#ffffff', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Geam plat DU6 supertermoizolant.',
    description_html: '<h2>FAKRO DXF DU6 - fereastra terasa tip F</h2>\n<p>Fereastra tip F cu geam plat ofera un design modern si minimalist. Geamul DU6 triplu termoizolant asigura U=0.64 W/m\u00b2K, potrivit pentru case pasive.</p>\n<ul>\n<li>Design modern cu geam plat - fara cupola</li>\n<li>U = 0.64 W/m\u00b2K - potrivit case pasive</li>\n<li>Geam DU6 triplu cu argon</li>\n</ul>',
    related_products: ['fakro-dxc-c-p2', 'fakro-dmf-du6']
});

addProduct({
    name: 'FAKRO DMF DU6', slug: 'fakro-dmf-du6', category_id: 10, subcategory_id: 52,
    subtitle: 'Fereastra acoperis terasa cu deschidere manuala si geam plat DU6. Ventilatie naturala.',
    specs: [
        { key: 'Tip', value: 'Deschidere manuala cu tija ZSD', sort_order: 1 },
        { key: 'Coeficient U fereastra', value: '0.64 W/m\u00b2K', sort_order: 2 },
        { key: 'Geam', value: 'DU6 triplu termoizolant', sort_order: 3 },
        { key: 'Panta acoperis', value: '0 - 15 grade', sort_order: 4 },
        { key: 'Deschidere', value: 'Manuala cu tija telescopica ZSD', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Alb PVC', code: 'Standard', hex: '#ffffff', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Deschidere manuala pentru ventilatie.',
    description_html: '<h2>FAKRO DMF DU6 - fereastra terasa cu deschidere manuala</h2>\n<p>DMF DU6 combina geamul plat supertermoizolant cu posibilitatea de deschidere manuala prin tija telescopica ZSD, oferind ventilatie naturala pe acoperisul plat.</p>',
    related_products: ['fakro-dxf-du6', 'fakro-def-du6']
});

addProduct({
    name: 'FAKRO DEF DU6', slug: 'fakro-def-du6', category_id: 10, subcategory_id: 52,
    subtitle: 'Fereastra acoperis terasa cu deschidere electrica Z-Wave si senzor ploaie. Confort maxim.',
    specs: [
        { key: 'Tip', value: 'Deschidere electrica Z-Wave', sort_order: 1 },
        { key: 'Coeficient U fereastra', value: '0.64 W/m\u00b2K', sort_order: 2 },
        { key: 'Geam', value: 'DU6 triplu termoizolant', sort_order: 3 },
        { key: 'Panta acoperis', value: '0 - 15 grade', sort_order: 4 },
        { key: 'Deschidere', value: 'Electrica Z-Wave cu senzor ploaie', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Alb PVC', code: 'Standard', hex: '#ffffff', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Deschidere electrica Z-Wave cu senzor ploaie.',
    description_html: '<h2>FAKRO DEF DU6 - fereastra terasa electrica</h2>\n<p>DEF DU6 este varianta premium cu deschidere electrica Z-Wave. Include senzor de ploaie care inchide automat fereastra. Controlabila prin telecomanda sau sistem smart home.</p>',
    related_products: ['fakro-dmf-du6', 'fakro-dxf-du6']
});

addProduct({
    name: 'FAKRO DXW Circulabila', slug: 'fakro-dxw', category_id: 10, subcategory_id: 52,
    subtitle: 'Fereastra circulabila pentru acoperis terasa. Geam armat anti-alunecare, se poate calca pe ea.',
    specs: [
        { key: 'Tip', value: 'Circulabila (se poate calca)', sort_order: 1 },
        { key: 'Coeficient U fereastra', value: '0.70 W/m\u00b2K', sort_order: 2 },
        { key: 'Geam', value: 'Triplu armat cu structura anti-alunecare', sort_order: 3 },
        { key: 'Panta acoperis', value: '0 grade (plat)', sort_order: 4 },
        { key: 'Deschidere', value: 'Fixa', sort_order: 5 },
        { key: 'Dimensiuni disponibile', value: '60x60 - 120x120 cm', sort_order: 6 },
        { key: 'Garantie', value: '10 ani', sort_order: 7 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Transparent armat', code: 'Standard', hex: '#e0e8ef', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Geam armat circulabil, structura anti-alunecare.',
    description_html: '<h2>FAKRO DXW - fereastra circulabila pentru terasa</h2>\n<p>DXW este proiectata special pentru acoperisuri plate care servesc si ca spatii de locuit. Geamul triplu armat cu structura anti-alunecare permite calcarea pe fereastra in siguranta.</p>\n<ul>\n<li>Se poate calca - geam triplu armat</li>\n<li>Structura exterioara anti-alunecare</li>\n<li>U = 0.70 W/m\u00b2K</li>\n<li>Dimensiuni de la 60x60 la 120x120 cm</li>\n</ul>',
    related_products: ['fakro-dxf-du6', 'fakro-dxc-c-p2']
});

addProduct({
    name: 'FAKRO DSF Evacuare Fum', slug: 'fakro-dsf', category_id: 10, subcategory_id: 52,
    subtitle: 'Fereastra pentru evacuarea fumului pe acoperis plat. Deschidere automata la detectia fumului.',
    specs: [
        { key: 'Tip', value: 'Evacuare fum - normativ incendiu', sort_order: 1 },
        { key: 'Deschidere', value: 'Automata la detectia fumului', sort_order: 2 },
        { key: 'Panta acoperis', value: '0 - 15 grade', sort_order: 3 },
        { key: 'Suprafata ventilatie', value: 'Conform normativ', sort_order: 4 },
        { key: 'Garantie', value: '10 ani', sort_order: 5 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Standard', code: 'Standard', hex: '#cccccc', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Conform normativelor de protectie la incendiu.',
    description_html: '<h2>FAKRO DSF - fereastra evacuare fum</h2>\n<p>DSF este fereastra speciala pentru evacuarea fumului conform normativelor de protectie la incendiu. Se deschide automat la detectia fumului, permitand evacuarea rapida a gazelor toxice.</p>',
    related_products: ['fakro-dxf-du6', 'fakro-drl']
});

addProduct({
    name: 'FAKRO DRC-C P2 Acces Terasa', slug: 'fakro-drc-c-p2', category_id: 10, subcategory_id: 52,
    subtitle: 'Fereastra de acces pe acoperis terasa cu cupola policarbonat. Permite iesirea pe acoperis.',
    specs: [
        { key: 'Tip', value: 'Acces pe acoperis terasa', sort_order: 1 },
        { key: 'Geam', value: 'Dublu P2 + cupola policarbonat', sort_order: 2 },
        { key: 'Deschidere', value: 'Manuala, permite acces pe acoperis', sort_order: 3 },
        { key: 'Panta acoperis', value: '0 - 15 grade', sort_order: 4 },
        { key: 'Garantie', value: '10 ani', sort_order: 5 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Alb PVC', code: 'Standard', hex: '#ffffff', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Acces sigur pe acoperis plat.',
    description_html: '<h2>FAKRO DRC-C P2 - acces pe acoperis terasa</h2>\n<p>DRC-C P2 permite accesul sigur pe acoperisul plat. Cu cupola din policarbonat rezistent la impact si geam dublu P2 antiefractie.</p>',
    related_products: ['fakro-drl', 'fakro-dxf-du6']
});

addProduct({
    name: 'FAKRO DRL Trapa Acces', slug: 'fakro-drl', category_id: 10, subcategory_id: 52,
    subtitle: 'Trapa de acces pe acoperis terasa. Deschidere ampla pentru iesire confortabila pe acoperis.',
    specs: [
        { key: 'Tip', value: 'Trapa acces acoperis plat', sort_order: 1 },
        { key: 'Deschidere', value: 'Manuala, deschidere ampla', sort_order: 2 },
        { key: 'Izolatie', value: 'Capac termoizolat', sort_order: 3 },
        { key: 'Panta acoperis', value: '0 - 15 grade', sort_order: 4 },
        { key: 'Garantie', value: '10 ani', sort_order: 5 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Standard', code: 'Standard', hex: '#cccccc', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Trapa acces cu izolatie termica.',
    description_html: '<h2>FAKRO DRL - trapa acces acoperis</h2>\n<p>DRL este trapa de acces pentru acoperis plat, cu deschidere ampla si capac termoizolat. Permite iesirea confortabila pe acoperis pentru intretinere sau acces.</p>',
    related_products: ['fakro-drc-c-p2', 'fakro-dsf']
});

// ============================================================
// TUNELE DE LUMINA - 4 models (cat 10, sub 53)
// ============================================================

addProduct({
    name: 'FAKRO SRT Tub Rigid', slug: 'fakro-srt', category_id: 10, subcategory_id: 53,
    subtitle: 'Tunel de lumina cu tub rigid si cupola. Eficienta luminoasa 98%, distante lungi pana la 12m.',
    specs: [
        { key: 'Tip tub', value: 'Rigid din aluminiu', sort_order: 1 },
        { key: 'Eficienta reflectie', value: '98%', sort_order: 2 },
        { key: 'Strat reflectorizant', value: 'Pe baza de argint', sort_order: 3 },
        { key: 'Distanta maxima', value: 'Pana la 12 m', sort_order: 4 },
        { key: 'Cupola', value: 'Da - policarbonat transparent', sort_order: 5 },
        { key: 'Diametru', value: '250 mm / 350 mm / 550 mm', sort_order: 6 },
        { key: 'Garantie', value: '10 ani', sort_order: 7 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Standard', code: 'Standard', hex: '#e0e0e0', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Tub rigid cu eficienta luminoasa 98%.',
    description_html: '<h2>FAKRO SRT - tunel de lumina cu tub rigid</h2>\n<p>Tunelul SRT are tub rigid din aluminiu acoperit cu un strat reflectorizant pe baza de argint, asigurand o eficienta de transfer luminos de pana la 98%. Recomandat pentru distante lungi (pana la 12m).</p>\n<ul>\n<li>Tub rigid - eficienta luminoasa maxima</li>\n<li>Strat reflectorizant pe baza de argint</li>\n<li>Distante lungi de pana la 12 metri</li>\n<li>Cupola din policarbonat transparent</li>\n<li>Disponibil in diametrele 250, 350 si 550 mm</li>\n</ul>',
    related_products: ['fakro-slt', 'fakro-sr']
});

addProduct({
    name: 'FAKRO SLT Tub Flexibil', slug: 'fakro-slt', category_id: 10, subcategory_id: 53,
    subtitle: 'Tunel de lumina cu tub flexibil si cupola. Se adapteaza la structura acoperisului.',
    specs: [
        { key: 'Tip tub', value: 'Flexibil - poliester metalizat', sort_order: 1 },
        { key: 'Material tub', value: 'Poliester metalizat armat cu arcuri metalice', sort_order: 2 },
        { key: 'Lungime tub', value: '210 cm (extensibil)', sort_order: 3 },
        { key: 'Cupola', value: 'Da - policarbonat transparent', sort_order: 4 },
        { key: 'Diametru', value: '250 mm / 350 mm', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Standard', code: 'Standard', hex: '#e0e0e0', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Tub flexibil, se adapteaza la orice structura.',
    description_html: '<h2>FAKRO SLT - tunel de lumina cu tub flexibil</h2>\n<p>Tunelul SLT are tub flexibil din poliester metalizat armat cu arcuri metalice. Flexibilitatea excelenta permite ocolirea elementelor structurale ale acoperisului, ideal pentru distante scurte.</p>\n<ul>\n<li>Tub flexibil - se adapteaza la structura existenta</li>\n<li>Ideal pentru distante scurte si spatii inguste</li>\n<li>Ocoleste grinzi, conducte si alte obstacole</li>\n<li>Montaj simplu si rapid</li>\n</ul>',
    related_products: ['fakro-srt', 'fakro-sf']
});

addProduct({
    name: 'FAKRO SR_ Tub Rigid Rama Integrata', slug: 'fakro-sr', category_id: 10, subcategory_id: 53,
    subtitle: 'Tunel de lumina cu tub rigid si rama integrata. Montaj simplificat, fara cupola separata.',
    specs: [
        { key: 'Tip tub', value: 'Rigid din aluminiu', sort_order: 1 },
        { key: 'Rama', value: 'Integrata (fara cupola separata)', sort_order: 2 },
        { key: 'Eficienta reflectie', value: '98%', sort_order: 3 },
        { key: 'Diametru', value: '250 mm / 350 mm', sort_order: 4 },
        { key: 'Variante', value: 'SR_ standard si SR_-L (lumineaza si podul)', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Standard', code: 'Standard', hex: '#e0e0e0', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Rama integrata, montaj simplificat.',
    description_html: '<h2>FAKRO SR_ - tunel de lumina rigid cu rama integrata</h2>\n<p>Tunelul SR_ are tub rigid si rama integrata, simplificand montajul. Disponibil si in varianta SR_-L care lumineaza si zona podului.</p>',
    related_products: ['fakro-srt', 'fakro-sf']
});

addProduct({
    name: 'FAKRO SF_ Tub Flexibil Rama Integrata', slug: 'fakro-sf', category_id: 10, subcategory_id: 53,
    subtitle: 'Tunel de lumina cu tub flexibil si rama integrata. Flexibilitate maxima la montaj.',
    specs: [
        { key: 'Tip tub', value: 'Flexibil - poliester metalizat', sort_order: 1 },
        { key: 'Rama', value: 'Integrata (fara cupola separata)', sort_order: 2 },
        { key: 'Diametru', value: '250 mm / 350 mm', sort_order: 3 },
        { key: 'Variante', value: 'SF_ standard si SF_-L (lumineaza si podul)', sort_order: 4 },
        { key: 'Garantie', value: '10 ani', sort_order: 5 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Standard', code: 'Standard', hex: '#e0e0e0', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Tub flexibil cu rama integrata.',
    description_html: '<h2>FAKRO SF_ - tunel de lumina flexibil cu rama integrata</h2>\n<p>Tunelul SF_ combina tubul flexibil cu rama integrata pentru montaj simplificat. Ideal pentru spatii unde tubul rigid nu se poate instala din cauza obstacolelor structurale.</p>',
    related_products: ['fakro-slt', 'fakro-sr']
});

// ============================================================
// LUMINATOARE - 3 models (cat 10, sub 54)
// ============================================================

addProduct({
    name: 'FAKRO WLI Luminator', slug: 'fakro-wli', category_id: 10, subcategory_id: 54,
    subtitle: 'Luminator standard pentru iluminare si ventilare pod nelocuit. Dimensiuni 54x83 si 86x87 cm.',
    specs: [
        { key: 'Tip', value: 'Luminator standard - acces pe acoperis', sort_order: 1 },
        { key: 'Dimensiuni', value: '54x83 cm / 86x87 cm', sort_order: 2 },
        { key: 'Material rama', value: 'Pin impregnat in vid', sort_order: 3 },
        { key: 'Geam', value: 'Armat cu rezistenta crescuta', sort_order: 4 },
        { key: 'Rama etansare', value: 'Universala - orice tip invelitoare', sort_order: 5 },
        { key: 'Panta acoperis', value: '15 - 55 grade', sort_order: 6 },
        { key: 'Garantie', value: '10 ani', sort_order: 7 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Pin natural', code: 'Standard', hex: '#c4a96a', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Luminator universal pentru orice invelitoare.',
    description_html: '<h2>FAKRO WLI - luminator standard</h2>\n<p>WLI este luminatorul standard FAKRO pentru iluminarea si ventilarea podurilor nelocuite. Cu rama de etansare universala se potriveste pe orice tip de invelitoare.</p>\n<ul>\n<li>Iluminare si ventilare pod nelocuit</li>\n<li>Permite accesul pe acoperis pentru intretinere</li>\n<li>Rama etansare universala inclusa</li>\n<li>Blocare impotriva inchiderii accidentale</li>\n<li>Disponibil in 2 dimensiuni standard</li>\n</ul>',
    related_products: ['fakro-wgi', 'fakro-wgt']
});

addProduct({
    name: 'FAKRO WGI Luminator Geam', slug: 'fakro-wgi', category_id: 10, subcategory_id: 54,
    subtitle: 'Luminator cu geam izolant pentru iluminare pod. Rama din lemn, panta 15-55 grade.',
    specs: [
        { key: 'Tip', value: 'Luminator cu geam izolant', sort_order: 1 },
        { key: 'Material rama', value: 'Lemn de pin', sort_order: 2 },
        { key: 'Geam', value: 'Izolant dublu', sort_order: 3 },
        { key: 'Panta acoperis', value: '15 - 55 grade', sort_order: 4 },
        { key: 'Deschidere', value: 'Basculanta pentru ventilatie', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Pin natural', code: 'Standard', hex: '#c4a96a', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Geam izolant dublu.',
    description_html: '<h2>FAKRO WGI - luminator cu geam izolant</h2>\n<p>WGI ofera iluminare naturala cu geam izolant dublu pentru o mai buna eficienta termica comparativ cu luminatorul standard WLI.</p>',
    related_products: ['fakro-wli', 'fakro-wgt']
});

addProduct({
    name: 'FAKRO WGT Luminator Termoizolant', slug: 'fakro-wgt', category_id: 10, subcategory_id: 54,
    subtitle: 'Luminator cu geam termoizolant superior. Cea mai buna izolatie termica din gama luminatoare.',
    specs: [
        { key: 'Tip', value: 'Luminator termoizolant', sort_order: 1 },
        { key: 'Material rama', value: 'Lemn de pin', sort_order: 2 },
        { key: 'Geam', value: 'Termoizolant superior', sort_order: 3 },
        { key: 'Panta acoperis', value: '15 - 55 grade', sort_order: 4 },
        { key: 'Deschidere', value: 'Basculanta pentru ventilatie si acces', sort_order: 5 },
        { key: 'Garantie', value: '10 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Finisaj', sort_order: 1, colors: [{ name: 'Pin natural', code: 'Standard', hex: '#c4a96a', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 10 ani FAKRO. Geam termoizolant de top.',
    description_html: '<h2>FAKRO WGT - luminator termoizolant</h2>\n<p>WGT este luminatorul premium FAKRO cu geam termoizolant superior, oferind cea mai buna izolatie termica din gama de luminatoare. Ideal pentru poduri unde se doreste minimizarea pierderilor de caldura.</p>',
    related_products: ['fakro-wgi', 'fakro-wli']
});

// ============================================================
// SCARI POD MISSING - 7 models (cat 11, sub 30)
// ============================================================

addProduct({
    name: 'FAKRO LWL Extra', slug: 'fakro-lwl-extra', category_id: 11, subcategory_id: 30,
    subtitle: 'Scara pod din lemn cu suport de desfacere automat. Deschidere asistata, 160kg.',
    specs: [
        { key: 'Material', value: 'Lemn pin', sort_order: 1 },
        { key: 'Sarcina maxima', value: '160 kg', sort_order: 2 },
        { key: 'Inaltime tavan max', value: '280 cm / 305 cm', sort_order: 3 },
        { key: 'Sectiuni', value: '3', sort_order: 4 },
        { key: 'Deschidere', value: 'Asistata cu suport automat', sort_order: 5 },
        { key: 'Trepte', value: 'Antiderapante, latime 34 cm', sort_order: 6 },
        { key: 'Garantie', value: '3 ani', sort_order: 7 }
    ],
    materials: [{ name: 'Disponibil', sort_order: 1, colors: [{ name: 'Pin lacuit, capac alb', code: 'Standard', hex: '#c4a96a', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 3 ani FAKRO. Suport de desfacere automat pentru confort maxim.',
    description_html: '<h2>FAKRO LWL Extra - scara pod cu deschidere asistata</h2>\n<p>LWL Extra se distinge prin suportul de desfacere automat care asista deschiderea si inchiderea scarii. Constructie solida din pin cu trepte antiderapante.</p>\n<ul>\n<li>Suport de desfacere automat - deschidere usoara</li>\n<li>Trepte antiderapante latime 34 cm</li>\n<li>Capac termoizolat alb</li>\n<li>7 dimensiuni disponibile</li>\n</ul>',
    related_products: ['fakro-lwk-komfort', 'fakro-lwt-thermo']
});

addProduct({
    name: 'FAKRO LWF 45 Antifoc', slug: 'fakro-lwf-45', category_id: 11, subcategory_id: 30,
    subtitle: 'Scara pod din lemn cu rezistenta la foc EI2 45 minute. Obligatorie in anumite constructii.',
    specs: [
        { key: 'Material', value: 'Lemn pin', sort_order: 1 },
        { key: 'Sarcina maxima', value: '160 kg', sort_order: 2 },
        { key: 'Rezistenta foc', value: 'EI2 45 minute', sort_order: 3 },
        { key: 'Inaltime tavan max', value: '280 cm / 305 cm', sort_order: 4 },
        { key: 'Sectiuni', value: '3 sau 4', sort_order: 5 },
        { key: 'Trepte', value: 'Antiderapante, latime 34 cm', sort_order: 6 },
        { key: 'Garantie', value: '3 ani', sort_order: 7 }
    ],
    materials: [{ name: 'Disponibil', sort_order: 1, colors: [{ name: 'Pin lacuit, capac alb', code: 'Standard', hex: '#c4a96a', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 3 ani FAKRO. Rezistenta la foc EI2 45 minute certificata.',
    description_html: '<h2>FAKRO LWF 45 - scara pod antifoc</h2>\n<p>LWF 45 este scara din lemn cu rezistenta la foc EI2 de 45 minute. Capac alb cu tripla etansare si izolatie termica. Obligatorie in constructii care necesita compartimentare antifoc.</p>',
    related_products: ['fakro-lwk-komfort', 'fakro-lmf']
});

addProduct({
    name: 'FAKRO LWZ Plus', slug: 'fakro-lwz-plus', category_id: 11, subcategory_id: 30,
    subtitle: 'Scara pod din lemn economica. Raport excelent calitate-pret, 160kg.',
    specs: [
        { key: 'Material', value: 'Lemn pin', sort_order: 1 },
        { key: 'Sarcina maxima', value: '160 kg', sort_order: 2 },
        { key: 'Inaltime tavan max', value: '280 cm / 305 cm', sort_order: 3 },
        { key: 'Sectiuni', value: '3 sau 4', sort_order: 4 },
        { key: 'Trepte', value: 'Antiderapante', sort_order: 5 },
        { key: 'Garantie', value: '2 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Disponibil', sort_order: 1, colors: [{ name: 'Pin lacuit, capac alb', code: 'Standard', hex: '#c4a96a', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 2 ani FAKRO. Model economic cu calitate FAKRO.',
    description_html: '<h2>FAKRO LWZ Plus - scara pod economica</h2>\n<p>LWZ Plus ofera calitatea FAKRO la un pret accesibil. Constructie solida din pin cu trepte antiderapante, ideala pentru buget limitat.</p>',
    related_products: ['fakro-lwk-komfort', 'fakro-lwl-extra']
});

addProduct({
    name: 'FAKRO LMK Komfort Metal', slug: 'fakro-lmk-komfort', category_id: 11, subcategory_id: 30,
    subtitle: 'Scara pod metalica Komfort. Sarcina 200kg, robusta si durabila, capac termoizolat.',
    specs: [
        { key: 'Material', value: 'Metal (otel)', sort_order: 1 },
        { key: 'Sarcina maxima', value: '200 kg', sort_order: 2 },
        { key: 'U capac', value: '1.1 W/m\u00b2K', sort_order: 3 },
        { key: 'Inaltime tavan max', value: '280 cm / 305 cm', sort_order: 4 },
        { key: 'Sectiuni', value: '3', sort_order: 5 },
        { key: 'Trepte', value: 'Metalice antiderapante', sort_order: 6 },
        { key: 'Garantie', value: '3 ani', sort_order: 7 }
    ],
    materials: [{ name: 'Disponibil', sort_order: 1, colors: [{ name: 'Metal vopsit, capac alb', code: 'Standard', hex: '#888888', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 3 ani FAKRO. Metalica, 200kg sarcina maxima.',
    description_html: '<h2>FAKRO LMK Komfort - scara pod metalica</h2>\n<p>LMK Komfort este varianta metalica a popularului LWK. Cu sarcina maxima de 200kg si constructie robusta din otel, este ideala pentru utilizare frecventa.</p>\n<ul>\n<li>Metal - sarcina 200kg, mai rezistenta decat lemnul</li>\n<li>Capac termoizolat U=1.1 W/m\u00b2K</li>\n<li>Trepte metalice antiderapante</li>\n</ul>',
    related_products: ['fakro-lml-lux', 'fakro-lwk-komfort']
});

addProduct({
    name: 'FAKRO LMP Inaltime Mare', slug: 'fakro-lmp', category_id: 11, subcategory_id: 30,
    subtitle: 'Scara pod metalica pentru tavane inalte pana la 366 cm. 4 sectiuni pliabile.',
    specs: [
        { key: 'Material', value: 'Metal (otel)', sort_order: 1 },
        { key: 'Sarcina maxima', value: '200 kg', sort_order: 2 },
        { key: 'Inaltime tavan max', value: '366 cm', sort_order: 3 },
        { key: 'Sectiuni', value: '4', sort_order: 4 },
        { key: 'Trepte', value: 'Metalice antiderapante', sort_order: 5 },
        { key: 'Garantie', value: '3 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Disponibil', sort_order: 1, colors: [{ name: 'Metal vopsit, capac alb', code: 'Standard', hex: '#888888', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 3 ani FAKRO. Pentru tavane inalte pana la 366 cm.',
    description_html: '<h2>FAKRO LMP - scara pod pentru tavane inalte</h2>\n<p>LMP este proiectata special pentru spatii cu tavane inalte de pana la 366 cm. Cu 4 sectiuni pliabile metalice si sarcina de 200kg.</p>',
    related_products: ['fakro-lmk-komfort', 'fakro-lml-lux']
});

addProduct({
    name: 'FAKRO LSZ Foarfeca Termoizolata', slug: 'fakro-lsz', category_id: 11, subcategory_id: 30,
    subtitle: 'Scara pod tip foarfeca cu izolatie termica superioara. Economie de spatiu, U=0.51.',
    specs: [
        { key: 'Material', value: 'Metal (otel)', sort_order: 1 },
        { key: 'Sarcina maxima', value: '200 kg', sort_order: 2 },
        { key: 'U capac', value: '0.51 W/m\u00b2K', sort_order: 3 },
        { key: 'Inaltime tavan max', value: '280 cm / 305 cm', sort_order: 4 },
        { key: 'Tip', value: 'Foarfeca (scissor)', sort_order: 5 },
        { key: 'Garantie', value: '3 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Disponibil', sort_order: 1, colors: [{ name: 'Metal vopsit, capac alb', code: 'Standard', hex: '#888888', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 3 ani FAKRO. Foarfeca termoizolata U=0.51 W/m\u00b2K.',
    description_html: '<h2>FAKRO LSZ - scara foarfeca termoizolata</h2>\n<p>LSZ combina mecanismul foarfeca (economie de spatiu) cu izolatie termica superioara U=0.51 W/m\u00b2K. Ideala pentru case cu cerinte energetice ridicate.</p>',
    related_products: ['fakro-lst', 'fakro-lsf']
});

addProduct({
    name: 'FAKRO LSF Foarfeca Antifoc', slug: 'fakro-lsf', category_id: 11, subcategory_id: 30,
    subtitle: 'Scara pod tip foarfeca cu rezistenta la foc. Economie spatiu + protectie antifoc.',
    specs: [
        { key: 'Material', value: 'Metal (otel)', sort_order: 1 },
        { key: 'Sarcina maxima', value: '200 kg', sort_order: 2 },
        { key: 'Rezistenta foc', value: 'EI2 60 minute', sort_order: 3 },
        { key: 'Inaltime tavan max', value: '280 cm / 305 cm', sort_order: 4 },
        { key: 'Tip', value: 'Foarfeca (scissor)', sort_order: 5 },
        { key: 'Garantie', value: '3 ani', sort_order: 6 }
    ],
    materials: [{ name: 'Disponibil', sort_order: 1, colors: [{ name: 'Metal vopsit, capac alb', code: 'Standard', hex: '#888888', swatch: '', sort_order: 1 }] }],
    warranty_text: 'Garantie 3 ani FAKRO. Foarfeca antifoc EI2 60 minute.',
    description_html: '<h2>FAKRO LSF - scara foarfeca antifoc</h2>\n<p>LSF combina mecanismul foarfeca cu rezistenta la foc EI2 de 60 minute. Permite compartimentare antifoc obligatorie in anumite constructii, cu avantajul economiei de spatiu.</p>',
    related_products: ['fakro-lst', 'fakro-lsz']
});

// Update subcategory 30 count
const sub30 = subcategories.find(s => s.id === 30);
if (sub30) {
    sub30.count = 13; // 6 existing + 7 new
    sub30.updated_at = now;
}

// Save updated subcategories (count update for sub30)
fs.writeFileSync(path.join(dataDir, 'subcategories.json'), JSON.stringify(subcategories, null, 4));

// Save products
fs.writeFileSync(path.join(dataDir, 'products.json'), JSON.stringify(products, null, 4));

console.log(`Products updated. Total: ${products.length}, New max ID: ${Math.max(...products.map(p => p.id))}`);
console.log('Migration complete!');
console.log('');
console.log('Summary:');
console.log('- Category 10 renamed to "Ferestre si luminatoare FAKRO"');
console.log('- Subcategory 29 renamed to "Ferestre mansarda" (15 products)');
console.log('- Subcategory 52: Ferestre acoperis terasa (8 products)');
console.log('- Subcategory 53: Tunele de lumina (4 products)');
console.log('- Subcategory 54: Luminatoare (3 products)');
console.log('- Subcategory 30: Scari pod FAKRO (13 products)');
console.log('- Added: 8 ferestre mansarda + 8 ferestre terasa + 4 tunele + 3 luminatoare + 7 scari = 30 new products');
