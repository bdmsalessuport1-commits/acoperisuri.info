/**
 * Add component images to Budmat Flamingo iQ (ID 26)
 */
const fs = require('fs');
const path = require('path');

const dataDir = path.join(__dirname, '..', 'data');
const products = JSON.parse(fs.readFileSync(path.join(dataDir, 'products.json'), 'utf8'));
const now = '2026-04-24 20:40:00';

const imageMap = {
    'Jgheab rectangular': '/uploads/products/budmat-flamingo-iq/2.png',
    'Burlan rectangular': '/uploads/products/budmat-flamingo-iq/14.png',
    'Capac jgheab': '/uploads/products/budmat-flamingo-iq/10.png',
    'Carlig ascuns fascia': '/uploads/products/budmat-flamingo-iq/4.png',
    'Carlig ascuns capriori': '/uploads/products/budmat-flamingo-iq/5.png',
    'Coltar interior/exterior 90°': '/uploads/products/budmat-flamingo-iq/9.png',
    'Piesa imbinare jgheab': '/uploads/products/budmat-flamingo-iq/3.png',
    'Racord jgheab-burlan': '/uploads/products/budmat-flamingo-iq/11.png',
    'Cot burlan': '/uploads/products/budmat-flamingo-iq/12.png',
    'Prelungitor burlan': '/uploads/products/budmat-flamingo-iq/13.png',
    'Bratara burlan': '/uploads/products/budmat-flamingo-iq/15.png',
    'Element evacuare': '/uploads/products/budmat-flamingo-iq/16.png',
    'Parafrunzar': '', // Budmat doesn't have this as separate image
};

const fl = products.find(p => p.id === 26);
if (!fl) {
    console.error('Flamingo iQ product (ID 26) not found!');
    process.exit(1);
}

let matched = 0, skipped = 0;
const missing = [];
fl.components.forEach(comp => {
    if (imageMap.hasOwnProperty(comp.name)) {
        comp.image = imageMap[comp.name];
        if (imageMap[comp.name]) matched++;
        else skipped++;
    } else {
        missing.push(comp.name);
    }
});
fl.updated_at = now;

fs.writeFileSync(path.join(dataDir, 'products.json'), JSON.stringify(products, null, 4));

console.log(`Matched: ${matched}/${fl.components.length}`);
console.log(`Skipped: ${skipped}`);
if (missing.length > 0) console.log('Unknown:', missing);
console.log('Done!');
