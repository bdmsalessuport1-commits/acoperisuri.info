# 📱 Control remote acoperisuri.info de pe telefon

Ghid complet pentru a lucra pe site-ul BDM Systems / acoperisuri.info de pe telefonul mobil, fără să atingi laptopul.

---

## 🎯 Ce poți face de pe telefon

| Acțiune | Cum | Timp |
|---------|-----|------|
| Vezi site-ul live | Browser mobil | ⏱ instant |
| Chat cu Claude despre proiect | App Claude iOS/Android | ⏱ instant |
| Cere modificări de conținut / produse | App Claude → GitHub | ~5-10 min |
| Trigger deploy manual pe Render | Bookmark buton | ⏱ instant |
| Verifică status deploy | Render dashboard | ⏱ instant |
| Vezi log-uri erori | Render dashboard | ⏱ instant |
| Aprobi modificări | Chat sau GitHub app | variabil |

## 🚫 Ce NU poți face de pe telefon
- Rula PHP local (Laragon rămâne pe laptop)
- Testa în browser înainte de deploy (poți testa doar pe staging)
- Modifica direct fișiere din Windows

---

## 🔧 PASUL 1 — Instalează app-urile necesare

### A. Claude (obligatoriu pentru chat)
- **iOS**: [App Store → Claude](https://apps.apple.com/app/claude/id6473753684)
- **Android**: [Google Play → Claude](https://play.google.com/store/apps/details?id=com.anthropic.claude)
- Fă login cu **același cont Anthropic** ca pe laptop (`bdm.sales.suport1@gmail.com`)

### B. GitHub Mobile (opțional, dar util)
- **iOS**: App Store → „GitHub"
- **Android**: Google Play → „GitHub"
- Login cu contul care are acces la repo (`bdmsalessuport1-commits`)
- Aici vei aproba pull requests, vei vedea commit-urile

### C. Render dashboard (browser)
- Browser mobil → https://dashboard.render.com/
- Login cu contul Render
- Vei vedea status deploy-urilor și log-uri

---

## 🚀 PASUL 2 — Bookmark-uri utile pe ecranul principal al telefonului

Salvează aceste linkuri pe ecranul principal (Add to Home Screen):

### 🌐 Site-ul tău live
```
https://acoperisuri-info.onrender.com/
```

### 🔥 Trigger deploy manual (după modificări în GitHub)
```
https://api.render.com/deploy/srv-d758q6shg0os73afdsmg?key=gNqpQ245Dz4
```
**Cum funcționează:** apeși linkul → Render începe automat un deploy nou. Nu apărea nimic important pe ecran, dar deploy-ul se declanșează. Verifici status pe Render dashboard.

### 📊 Dashboard Render (status + log-uri)
```
https://dashboard.render.com/web/srv-d758q6shg0os73afdsmg
```

### 💻 Repo GitHub
```
https://github.com/bdmsalessuport1-commits/acoperisuri.info
```

### 🎨 Pagina consultanță Passive House
```
https://acoperisuri-info.onrender.com/consultanta-passive-house
```

### 🏗️ Panou admin (login)
```
https://acoperisuri-info.onrender.com/admin/login
```

---

## 💬 PASUL 3 — Cum lucrezi cu Claude de pe telefon

### Începe o conversație nouă în app-ul Claude
Începe fiecare cerere cu contextul: **„Pentru proiectul acoperisuri.info..."**

Astfel Claude știe la ce proiect te referi.

### Exemple de comenzi tipice de pe telefon

**Adaugă produs nou:**
> „Pentru acoperisuri.info, adaugă produsul XYZ de la Metigla în categoria tabla-faltuita. Poze pe metigla.ro/products/xyz. Deploy după."

**Actualizare conținut:**
> „Pe pagina de consultanță passive house, schimbă subtitlul din X în Y. Deploy."

**Verificare status:**
> „Verifică dacă acoperisuri-info.onrender.com răspunde 200 și dacă badgurile PHI încarcă corect."

**Modificare rapidă text:**
> „În data/homepage.json, la categoria «Sisteme pluviale», schimbă descrierea în «X». Commit și deploy."

### Ce trebuie să știe Claude să facă:
Pentru fiecare cerere, Claude va:
1. Face un fork al conversației cu tot contextul proiectului
2. Modifica fișierele necesare **direct în GitHub** (prin `gh` CLI sau MCP)
3. Face commit + push pe branch-ul `develop`
4. Declanșa deploy pe Render (automat prin webhook)
5. Îți răspunde cu URL-ul live când e gata

---

## 🤖 PASUL 4 — Automatizări setate deja (rulează fără tine)

Aceste task-uri se execută **automat**, fără intervenția ta:

### ✅ Deploy automat la fiecare push pe `develop`
- Render urmărește branch-ul `develop`
- Când apar commit-uri noi → deploy automat
- Nu trebuie să faci nimic manual

### ✅ Health check pe live (setabil în viitor)
- Se poate configura un scheduled task care verifică zilnic că site-ul răspunde
- Îți trimite notificare doar dacă apare o problemă

---

## 🆘 Când ceva nu merge — troubleshooting rapid

### Site-ul nu răspunde
1. Verifică dashboardul Render — vezi dacă deploy-ul e „Live"
2. Dacă e „Failed" → verifică log-urile în Render (butonul „Logs")
3. În Claude app, trimite log-urile către mine să le analizez

### Deploy-ul a eșuat
1. Chat cu Claude: „Deploy-ul pe acoperisuri.info a eșuat cu eroarea X"
2. Voi analiza și voi propune fix

### O poză nu apare pe site
- Cel mai probabil fișierul e în `.gitignore`
- Cere-mi: „Verifică de ce imaginea X nu apare pe live"

---

## 🔑 Credențiale (păstrează-le sigur)

**Deploy hook (nu partaja acest URL):**
```
https://api.render.com/deploy/srv-d758q6shg0os73afdsmg?key=gNqpQ245Dz4
```

**Repo GitHub:**
```
bdmsalessuport1-commits/acoperisuri.info
```

**Site live:**
```
https://acoperisuri-info.onrender.com
```

**Sediu firmă (pentru referință):**
```
BDM Systems
București, Prelungirea Ghencea Nr. 95C
+40 756 034 734
office@bdmacoperis.ro
```

---

## 📞 Sfat final

**Cel mai simplu workflow de pe telefon:**

1. Deschide app-ul Claude
2. Îmi scrii ce vrei modificat pe site (limbaj natural, ca acum)
3. Fac modificarea și deploy-ul
4. Îți trimit link-ul live când e gata
5. Verifici pe telefon din browser

**Nu ai nevoie să scrii cod, să știi git, sau să atingi laptopul.**

Totul se face prin conversație.
