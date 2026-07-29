// Function to inject into pages via browser console
// Returns full article data with SEO + content
function extractArticleData() {
    const sections = document.querySelectorAll('section.elementor-section');
    const largest = Array.from(sections).sort((a,b) => b.innerText.length - a.innerText.length)[0];

    let content = '';
    if (largest) {
        const seen = new Set();
        const parts = [];
        largest.querySelectorAll('h1, h2, h3, h4, h5, h6, p, ul, ol, img').forEach(el => {
            const tag = el.tagName;
            if (['H1','H2','H3','H4','H5','H6','P'].includes(tag)) {
                const txt = el.innerText.trim();
                if (txt && !seen.has(txt)) {
                    seen.add(txt);
                    const t = tag.toLowerCase();
                    parts.push('<' + t + '>' + txt.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;') + '</' + t + '>');
                }
            }
            if (tag === 'UL' || tag === 'OL') {
                const items = Array.from(el.querySelectorAll('li')).map(li => li.innerText.trim()).filter(Boolean);
                if (items.length && !seen.has('list-' + items.join('|'))) {
                    seen.add('list-' + items.join('|'));
                    items.forEach(i => seen.add(i));
                    const t = tag.toLowerCase();
                    parts.push('<' + t + '>' + items.map(i => '<li>' + i.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;') + '</li>').join('') + '</' + t + '>');
                }
            }
            if (tag === 'IMG') {
                const src = el.src;
                const alt = el.alt || '';
                if (src && !src.includes('data:image') && !src.includes('logo') && !seen.has(src)) {
                    seen.add(src);
                    parts.push('<img src="' + src + '" alt="' + alt.replace(/"/g,'&quot;') + '">');
                }
            }
        });
        content = parts.join('\n\n');
    }

    // Get slug from URL
    const url = window.location.href;
    const slug = url.replace('https://acoperisuri.info/', '').replace(/\/$/,'');

    return {
        url: url,
        slug: slug,
        title: document.title,
        h1: document.querySelector('h1')?.textContent.trim() || '',
        metaDescription: document.querySelector('meta[name="description"]')?.content || '',
        metaKeywords: document.querySelector('meta[name="keywords"]')?.content || '',
        canonical: document.querySelector('link[rel="canonical"]')?.href || '',
        ogImage: document.querySelector('meta[property="og:image"]')?.content || '',
        ogType: document.querySelector('meta[property="og:type"]')?.content || '',
        publishedTime: document.querySelector('meta[property="article:published_time"]')?.content || '',
        modifiedTime: document.querySelector('meta[property="article:modified_time"]')?.content || '',
        content: content,
        contentLength: content.length,
    };
}
extractArticleData();
