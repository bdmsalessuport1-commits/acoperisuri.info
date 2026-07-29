/**
 * Add component images to Wetterbest pluvial system (ID 25)
 * Sistem 150mm jgheab + 97mm burlan
 */
const fs = require('fs');
const path = require('path');

const dataDir = path.join(__dirname, '..', 'data');
const products = JSON.parse(fs.readFileSync(path.join(dataDir, 'products.json'), 'utf8'));
const now = '2026-04-24 20:30:00';

const imageMap = {
    'Jgheab 150mm': '/uploads/products/wetterbest-sistem-pluvial/28.png',
    'Burlan 97mm': '/uploads/products/wetterbest-sistem-pluvial/26.png',
    'Capac jgheab': '/uploads/products/wetterbest-sistem-pluvial/23.png',
    'Carlig jgheab aplicat': '/uploads/products/wetterbest-sistem-pluvial/16.png',
    'Carlig rasucit': '/uploads/products/wetterbest-sistem-pluvial/24.png',
    'Contracarlig jgheab': '/uploads/products/wetterbest-sistem-pluvial/3.png',
    'Bratara jgheab': '/uploads/products/wetterbest-sistem-pluvial/4.png',
    'Piesa imbinare jgheab': '/uploads/products/wetterbest-sistem-pluvial/4.png',
    'Coltar interior': '/uploads/products/wetterbest-sistem-pluvial/12.png',
    'Coltar exterior': '/uploads/products/wetterbest-sistem-pluvial/9.png',
    'Racord jgheab-burlan': '/uploads/products/wetterbest-sistem-pluvial/2.png',
    'Palnie colectare': '/uploads/products/wetterbest-sistem-pluvial/29.png',
    'Cot burlan': '/uploads/products/wetterbest-sistem-pluvial/22.png',
    'Cot evacuare': '/uploads/products/wetterbest-sistem-pluvial/8.png',
    'Bratara burlan': '/uploads/products/wetterbest-sistem-pluvial/25.png',
    'Ramificatie burlan Y': '/uploads/products/wetterbest-sistem-pluvial/21.png',
    'Parafrunzar': '', // Wetterbest doesn't have this product
};

const wetter = products.find(p => p.id === 25);
if (!wetter) {
    console.error('Wetterbest product (ID 25) not found!');
    process.exit(1);
}

let matched = 0;
let skipped = 0;
let missing = [];
wetter.components.forEach(comp => {
    if (imageMap.hasOwnProperty(comp.name)) {
        comp.image = imageMap[comp.name];
        if (imageMap[comp.name]) matched++;
        else skipped++;
    } else {
        missing.push(comp.name);
    }
});
wetter.updated_at = now;

fs.writeFileSync(path.join(dataDir, 'products.json'), JSON.stringify(products, null, 4));

console.log(`Matched: ${matched}/${wetter.components.length} components`);
console.log(`Skipped (no image): ${skipped}`);
if (missing.length > 0) console.log('Unknown:', missing);
console.log('Done!');
