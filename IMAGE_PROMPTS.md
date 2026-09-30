# Image Prompts — Pagina Consultanță Passive House

Acest fișier conține prompturile detaliate pentru toate imaginile necesare paginii de consultanță. Folosește-le în ChatGPT (DALL-E), Midjourney, Adobe Firefly sau alt generator, apoi salvează rezultatele în `public/uploads/consultanta/` cu numele indicate.

**IMPORTANT:** Pentru portretele reale cu Mircea Barticel, NU folosi generare AI. Folosește doar fotografii reale furnizate de tine, exportate din Instagram sau făcute cu telefonul.

---

## 1. FOTOGRAFII REALE (NU AI-generated!)

### `mircea-hero.jpg` — Portret hero
- **Format:** JPG sau WebP, minimum 960×1200 px (4:5 ratio), max 500 KB
- **Preferat:** Mircea în cămașă albă, brațe încrucișate, fundal neutru (studio sau perete alb)
- **Sursa recomandată:** Fotografia din brief-ul deja trimis (poza 1 — studio + logo BDM) — dar decupat DOAR figura, fără graficele suprapuse
- **Alternativă:** Fotografie făcută cu telefonul lângă un perete alb, cămașă albă cu mânecile suflecate, lumină naturală laterală de la o fereastră

### `mircea-santier-expo.jpg` — Secțiunea "Despre Mircea"
- **Format:** JPG sau WebP, minimum 960×1200 px (4:5 ratio), max 500 KB
- **Preferat:** Fotografia din brief (poza 2 — Mircea la expoziție cu machetă șarpantă verde + izolație)
- **Alternativă acceptabilă:** Mircea explicând ceva lângă un panou de izolație, un plan, sau un material de construcție

### `og-consultanta.jpg` — Open Graph pentru share social
- **Format:** JPG, EXACT 1200×630 px (Facebook / LinkedIn standard), max 300 KB
- **Compoziție:** Portret Mircea la stânga (40%) + text la dreapta:
  - "Consultanță Passive House și nZEB"
  - "Mircea Barticel · Consultant Certificat PHI"
  - Logo BDM Systems mic în colț
- Se poate face în Canva pornind de la portretul principal

---

## 2. IMAGINI CONCEPTUALE (pot fi generate cu AI)

### `envelope-diagram.svg` — Diagrama anvelopei termice (OPȚIONAL)
Recomandat: creează în SVG direct în cod (nu prin AI) sau folosește un diagram maker.
Nu este critic pentru lansare — grid-ul interactiv cu cele 10 zone acoperă acest rol.

### `phpp-visualization.jpg` — Vizual conceptual PHPP (OPȚIONAL)
**Prompt AI (Midjourney/DALL-E):**
> "Modern architectural technical drawing overlay showing a house cross-section with heat flow arrows, energy modeling visualization, engineering blueprint aesthetic, dark blue and green color palette, professional and clean, no text labels, orthographic side view, 16:9 aspect ratio"

**Format final:** JPG 1600×900, max 400 KB
**Etichetare:** Marchează clar ca "ilustrație conceptuală" — NU este captură reală din PHPP

### `house-section-envelope.jpg` — Secțiune casă cu straturi
**Prompt AI:**
> "Detailed architectural cross-section of a modern energy-efficient passive house, showing insulation layers, windows, vapor barrier, thermal bridges highlighted in orange, clean technical illustration style, blue tones with green accents, no text, professional engineering drawing, 16:9"

**Format:** JPG 1600×900, max 400 KB

### `thermal-bridges-comparison.jpg` — Comparație punți termice
**Prompt AI:**
> "Two-panel comparison illustration: left side shows a house cross-section with red thermal bridge hotspots (heat escaping), right side shows the same house with continuous insulation and no thermal bridges (all cool), architectural technical style, clean, minimal, dark blue background, no text labels needed, 16:9 aspect ratio"

**Format:** JPG 1600×900, max 400 KB

### `cost-total-illustration.jpg` — Costul construcției vs locuirii
**Prompt AI:**
> "Modern financial infographic showing 3 stacked cost blocks: small blue block labeled 'construction' at bottom, large orange block labeled 'utilities' in middle, medium red block labeled 'repairs' at top, clean minimalist design, isometric style, dark navy background, technical illustration, corporate financial aesthetic, no house imagery, 4:3 aspect ratio"

**Format:** JPG 1200×900, max 300 KB
**Notă:** Poate fi înlocuit cu SVG-ul deja implementat în pagină (secțiunea "Costul real")

---

## 3. FOTOGRAFII DE ȘANTIER (poți face cu telefonul)

### `santier-detaliu-1.jpg` — Detaliu termoizolație
- **Ce fotografiezi:** Un colț de casă în șantier unde se vede clar termoizolația continuă
- **Cadru:** Aproape, cu mâinile tale în cadru dacă vrei
- **Format:** JPG 1600×1200, max 400 KB

### `santier-tamplarie.jpg` — Detaliu montaj tâmplărie
- **Ce fotografiezi:** O fereastră montată corect, cu banda perimetrală vizibilă
- **Format:** JPG 1600×1200, max 400 KB

### `santier-anvelopa.jpg` — Vedere de ansamblu anvelopă
- **Ce fotografiezi:** O casă în stadiul de închis exterior, cu straturile de izolație vizibile
- **Format:** JPG 1600×1200, max 400 KB

---

## 4. LOGO-URI PARTENERI (dacă vrei secțiune)

Dacă vrei să adaugi la un moment dat o secțiune "Colaborăm cu", ai nevoie de logourile:
- STEICO (izolație fibre lemn)
- FAKRO (ferestre mansardă)
- Riwega (folii anticondens)
- Passivhaus Institute (poți folosi cel din badge-urile de certificare)
- Brandurile de tigla metalică pe care le distribuie BDM

**Format:** SVG preferat, sau PNG cu fundal transparent, ~200×80 px

---

## Optimizare imagini

După ce ai imaginile, optimizează-le:

**Pentru web (obligatoriu):**
```bash
# Squoosh CLI (npm install -g @squoosh/cli)
squoosh-cli --webp '{"quality":85}' public/uploads/consultanta/*.jpg

# Sau folosește serviciul online: https://squoosh.app/
```

**Format recomandat:** WebP (cu fallback JPG). Reducere ~40% din dimensiunea originală.

---

## Checklist final imagini

- [ ] `mircea-hero.jpg` — portret hero (foto reală)
- [ ] `mircea-santier-expo.jpg` — despre Mircea (foto reală)
- [ ] `og-consultanta.jpg` — Open Graph share (composit)
- [ ] Fotografii de șantier (opționale, pot fi adăugate ulterior)
- [ ] Ilustrații conceptuale (opționale, pagina funcționează fără ele)

**Toate imaginile PORTRET obligatorii sunt fotografii REALE — NU generate AI.**
