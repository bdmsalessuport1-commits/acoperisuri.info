/**
 * Migration: Add component elements to pluvial system products
 * - Metigla (ID 24): 21 components
 * - Wetterbest (ID 25): 17 components
 * - Flamingo iQ (ID 26): 13 components
 */
const fs = require('fs');
const path = require('path');

const dataDir = path.join(__dirname, '..', 'data');
const products = JSON.parse(fs.readFileSync(path.join(dataDir, 'products.json'), 'utf8'));
const now = '2026-04-17 12:00:00';

// ============================================================
// METIGLA SISTEM PLUVIAL (ID 24) - 21 components
// ============================================================
const metiglaComponents = [
    { name: 'Jgheab', desc: 'Jgheab semicircular 125mm sau 165mm, lungime 4m', image: '' },
    { name: 'Burlan', desc: 'Burlan circular 88mm sau 100mm, lungime 3m', image: '' },
    { name: 'Capac jgheab', desc: 'Inchide capatul jgheabului, stanga sau dreapta', image: '' },
    { name: 'Carlig jgheab caprior', desc: 'Se fixeaza pe capriori inainte de montarea asterelii', image: '' },
    { name: 'Carlig jgheab aplicat', desc: 'Se fixeaza pe pana sau pe asterealaa dupa montaj', image: '' },
    { name: 'Carlig rasucit', desc: 'Carlig reglabil cu tija rasucita pentru ajustare precisa', image: '' },
    { name: 'Stabilizator jgheab', desc: 'Rigidizeaza jgheabul si previne deformarea', image: '' },
    { name: 'Piesa de imbinare jgheab', desc: 'Uneste doua tronsoane de jgheab, cu garnitura etansare', image: '' },
    { name: 'Coltar interior', desc: 'Colt interior 90 grade pentru jgheab', image: '' },
    { name: 'Coltar exterior', desc: 'Colt exterior 90 grade pentru jgheab', image: '' },
    { name: 'Racord jgheab-burlan', desc: 'Conecteaza jgheabul la burlan, cu palnie integrata', image: '' },
    { name: 'Racord jgheab-burlan 165/88', desc: 'Racord pentru dimensiune 165mm jgheab / 88mm burlan', image: '' },
    { name: 'Palnie colectare', desc: 'Colecteaza apa din jgheab si o directioneaza in burlan', image: '' },
    { name: 'Cot burlan', desc: 'Schimba directia burlanului, unghi variabil', image: '' },
    { name: 'Prelungitor burlan', desc: 'Extensie pentru conectarea coturilor la burlan', image: '' },
    { name: 'Bratara burlan', desc: 'Fixeaza burlanul pe perete, cu surub inclus', image: '' },
    { name: 'Ramificatie burlan', desc: 'Ramificatie Y pentru unirea a doua burlane', image: '' },
    { name: 'Element deversare', desc: 'Deversare apa la baza burlanului, spre trotuar', image: '' },
    { name: 'Element evacuare', desc: 'Evacuare apa la baza burlanului, cot final', image: '' },
    { name: 'Racord canalizare', desc: 'Conecteaza burlanul la reteaua de canalizare', image: '' },
    { name: 'Parafrunzar', desc: 'Filtru metalic care previne blocarea cu frunze', image: '' },
];

// ============================================================
// WETTERBEST SISTEM PLUVIAL (ID 25) - 17 components
// ============================================================
const wetterbComponents = [
    { name: 'Jgheab 150mm', desc: 'Jgheab semicircular 150mm, lungime 4m', image: '' },
    { name: 'Burlan 97mm', desc: 'Burlan circular 97mm, lungime 3m', image: '' },
    { name: 'Capac jgheab', desc: 'Inchide capatul jgheabului, stanga sau dreapta', image: '' },
    { name: 'Carlig jgheab aplicat', desc: 'Carlig pentru fixare pe pana sau asterealaa', image: '' },
    { name: 'Carlig rasucit', desc: 'Carlig cu tija rasucita pentru reglare inaltimii', image: '' },
    { name: 'Contracarlig jgheab', desc: 'Sustine jgheabul pe partea opusa carligului', image: '' },
    { name: 'Bratara jgheab', desc: 'Element de rigidizare si fixare suplimentara jgheab', image: '' },
    { name: 'Piesa imbinare jgheab', desc: 'Uneste doua tronsoane de jgheab etans', image: '' },
    { name: 'Coltar interior', desc: 'Colt interior 90 grade pentru jgheab', image: '' },
    { name: 'Coltar exterior', desc: 'Colt exterior 90 grade pentru jgheab', image: '' },
    { name: 'Racord jgheab-burlan', desc: 'Conecteaza jgheabul de burlan', image: '' },
    { name: 'Palnie colectare', desc: 'Colecteaza apa si o directioneaza in burlan', image: '' },
    { name: 'Cot burlan', desc: 'Schimba directia burlanului', image: '' },
    { name: 'Cot evacuare', desc: 'Cot final la baza burlanului pentru evacuare apa', image: '' },
    { name: 'Bratara burlan', desc: 'Fixeaza burlanul pe perete', image: '' },
    { name: 'Ramificatie burlan Y', desc: 'Ramificatie Y pentru unirea a doua burlane', image: '' },
    { name: 'Parafrunzar', desc: 'Filtru care previne blocarea cu frunze si resturi', image: '' },
];

// ============================================================
// FLAMINGO IQ RECTANGULAR (ID 26) - 13 components
// ============================================================
const flamingoComponents = [
    { name: 'Jgheab rectangular', desc: 'Jgheab rectangular simetric cu margine dubla rulata, 4m', image: '' },
    { name: 'Burlan rectangular', desc: 'Burlan cu sectiune rectangulara, 3m', image: '' },
    { name: 'Capac jgheab', desc: 'Inchide capatul jgheabului rectangular', image: '' },
    { name: 'Carlig ascuns fascia', desc: 'Carlig invizibil din exterior, fixare pe scandura de vant', image: '' },
    { name: 'Carlig ascuns capriori', desc: 'Carlig invizibil din exterior, fixare pe capriori', image: '' },
    { name: 'Coltar interior/exterior 90°', desc: 'Element de colt universal, se monteaza ca interior sau exterior', image: '' },
    { name: 'Piesa imbinare jgheab', desc: 'Uneste doua tronsoane de jgheab cu etansare', image: '' },
    { name: 'Racord jgheab-burlan', desc: 'Face trecerea de la jgheab la burlan', image: '' },
    { name: 'Cot burlan', desc: 'Schimba directia burlanului rectangular', image: '' },
    { name: 'Prelungitor burlan', desc: 'Tub intermediar intre coturi si burlan', image: '' },
    { name: 'Bratara burlan', desc: 'Fixeaza burlanul rectangular pe perete', image: '' },
    { name: 'Element evacuare', desc: 'Cot final la baza burlanului', image: '' },
    { name: 'Parafrunzar', desc: 'Filtru frunze pentru protectia burlanului', image: '' },
];

// Apply components to products
const metigla = products.find(p => p.id === 24);
if (metigla) {
    metigla.components = metiglaComponents;
    metigla.updated_at = now;
}

const wetterb = products.find(p => p.id === 25);
if (wetterb) {
    wetterb.components = wetterbComponents;
    wetterb.updated_at = now;
}

const flamingo = products.find(p => p.id === 26);
if (flamingo) {
    flamingo.components = flamingoComponents;
    flamingo.updated_at = now;
}

fs.writeFileSync(path.join(dataDir, 'products.json'), JSON.stringify(products, null, 4));

console.log('Pluvial components added:');
console.log('- Metigla (ID 24):', metiglaComponents.length, 'components');
console.log('- Wetterbest (ID 25):', wetterbComponents.length, 'components');
console.log('- Flamingo iQ (ID 26):', flamingoComponents.length, 'components');
console.log('Done!');
