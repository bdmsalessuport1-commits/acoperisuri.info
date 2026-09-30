/**
 * Add component images to Metigla pluvial system (ID 24)
 * Maps each component to its corresponding image in
 * /uploads/products/metigla-sistem-pluvial/X.png
 */
const fs = require('fs');
const path = require('path');

const dataDir = path.join(__dirname, '..', 'data');
const products = JSON.parse(fs.readFileSync(path.join(dataDir, 'products.json'), 'utf8'));
const now = '2026-04-24 20:00:00';

// Mapping: component name (exact match from existing data) -> image file
const imageMap = {
    'Jgheab': '/uploads/products/metigla-sistem-pluvial/8.png',
    'Burlan': '/uploads/products/metigla-sistem-pluvial/18.png',
    'Capac jgheab': '/uploads/products/metigla-sistem-pluvial/4.png',
    'Carlig jgheab caprior': '/uploads/products/metigla-sistem-pluvial/5.png',
    'Carlig jgheab aplicat': '/uploads/products/metigla-sistem-pluvial/9.png',
    'Carlig rasucit': '/uploads/products/metigla-sistem-pluvial/24.png',
    'Stabilizator jgheab': '/uploads/products/metigla-sistem-pluvial/10.png',
    'Piesa de imbinare jgheab': '/uploads/products/metigla-sistem-pluvial/6.png',
    'Coltar interior': '/uploads/products/metigla-sistem-pluvial/7.png',
    'Coltar exterior': '/uploads/products/metigla-sistem-pluvial/13.png',
    'Racord jgheab-burlan': '/uploads/products/metigla-sistem-pluvial/11.png',
    'Racord jgheab-burlan 165/88': '/uploads/products/metigla-sistem-pluvial/12.png',
    'Palnie colectare': '/uploads/products/metigla-sistem-pluvial/22.png',
    'Cot burlan': '/uploads/products/metigla-sistem-pluvial/15.png',
    'Prelungitor burlan': '/uploads/products/metigla-sistem-pluvial/14.png',
    'Bratara burlan': '/uploads/products/metigla-sistem-pluvial/17.png',
    'Ramificatie burlan': '/uploads/products/metigla-sistem-pluvial/16.png',
    'Element deversare': '/uploads/products/metigla-sistem-pluvial/19.png',
    'Element evacuare': '/uploads/products/metigla-sistem-pluvial/20.png',
    'Racord canalizare': '/uploads/products/metigla-sistem-pluvial/21.png',
    'Parafrunzar': '/uploads/products/metigla-sistem-pluvial/23.png',
};

const metigla = products.find(p => p.id === 24);
if (!metigla) {
    console.error('Metigla product (ID 24) not found!');
    process.exit(1);
}

let matched = 0;
let missing = [];
metigla.components.forEach(comp => {
    if (imageMap[comp.name]) {
        comp.image = imageMap[comp.name];
        matched++;
    } else {
        missing.push(comp.name);
    }
});
metigla.updated_at = now;

fs.writeFileSync(path.join(dataDir, 'products.json'), JSON.stringify(products, null, 4));

console.log(`Matched: ${matched}/${metigla.components.length} components`);
if (missing.length > 0) {
    console.log('Missing mappings:', missing);
}
console.log('Done!');
