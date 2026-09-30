#!/bin/bash
cd "$(dirname "$0")/../../public/uploads"
mkdir -p blog
cd blog

# Featured images list (slug:image_path)
declare -A IMGS=(
    [beneficii-tigla-metalica-bilka]="/wp-content/uploads/2017/07/Screenshot_2.png"
    [cum-eviti-putrezirea-sipcii-de-lemn-de-sub-acoperis]="/wp-content/uploads/2020/04/92212574_247775713288578_887791021646151680_n-1.jpg"
    [de-ce-zboara-acoperisurile-cu-tigla-metalica]="/wp-content/uploads/2020/05/acoperis-zbiurat-5.jpg"
    [stii-cat-de-mult-te-poate-costa-pretul-cel-mai-mic]="/wp-content/uploads/2020/05/Cat_de_mult_te_poate_cost_oferta_cu_cel_mai_mic_pret_mic.png"
    [importanta-stratului-de-zinc-pentru-tigla-metalica]="/wp-content/uploads/2021/11/consilieri_vanzari_bdm_roof_system_54543-1.png"
    [tigla-metalica-cu-roca-vs-budmat-venecja]="/wp-content/uploads/2020/05/tigla-metalica-cu-roca-vulcanica-vs-budmat-venecja.png"
    [ce-inseamna-un-acoperis-sanatos]="/wp-content/uploads/2017/08/articol-blog-2.jpg"
    [tabla-pentru-acoperis-alege-simplu-pe-baza-acestui-tabel]="/wp-content/uploads/2021/05/tigla-metalica-bdm-roof-system.png"
    [budmat-venecja-revolutia-in-acoperisuri]="/wp-content/uploads/2021/06/BDM-Budmat-728px.png"
    [recomandare-tigla-metalica-budmat-venecja]="/wp-content/uploads/2021/07/coperta-tigla-metalica-budmat.jpg"
    [de-ce-sa-nu-montezi-tigla-metalica-pentru-tabla-faltuita-veche]="/wp-content/uploads/2020/06/nu-monta-tigla-metalica-peste-invelitoarea-veche.png"
    [tigla-metalica-impro-cu-finisaj-herculit-garantie-40-de-ani]="/wp-content/uploads/2021/07/tigla_metalica_impro_cu_finisaj_herculit.png"
    [buretele-expandabil-elimina-riscul-de-infiltratii-in-zonele-de-dolie-si-calcan]="/wp-content/uploads/2021/08/burete-expandabil.jpeg"
    [cum-pot-pasarile-sa-ti-deterioreze-acoperisul-ce-poti-face]="/wp-content/uploads/2021/08/pasari-acoperis.png"
    [de-ce-este-mai-ieftin-si-mai-rentabil-sa-ai-casa-acoperita-cu-tigla-metalica-budmat-venecja]="/wp-content/uploads/2020/06/de-ce-e-mai-ieftin-si-mai-rentabil-2.png"
    [cele-mai-frecvente-15-intrebari-ale-clientilor-despre-tigla-metalica]="/wp-content/uploads/2017/09/tigla-metalica-sau-tigla-ceramica.jpg"
    [folia-anticondens-importanta-rol-parametri-de-performanta]="/wp-content/uploads/2017/08/articol-blog.jpg"
    [ventilare-tigla-metalica]="/wp-content/uploads/2017/08/articol-blog-1.jpg"
    [cum-poti-avea-un-acoperis-sanatos-la-un-pret-mai-accesibil]="/wp-content/uploads/2021/10/tigla_metalica_acoperisuri_55522.jpg"
    [ce-intrebari-sa-i-pui-contractantului-de-acoperis-inainte-de-a-semna-un-contract]="/wp-content/uploads/2021/11/firma_acoperisuri_tigla_bdm_roof_system_54451.jpg"
    [tigla-metalica-rugineste]="/wp-content/uploads/2021/11/tigla_metalica_bdm_roof_systems_54445.jpg"
    [cum-iti-afecteaza-caldura-din-timpul-verii-acoperisul]="/wp-content/uploads/2021/11/acoperis_vara_54401.jpg"
    [acoperis-rezistent-la-vant-puternic-si-tornade]="/wp-content/uploads/2021/11/acoperis_rezistent_la_tornade_si_furtuni_54469-768x432.jpg"
    [bdm-roof-system-revolutioneaza-acoperisurile]="/wp-content/uploads/2021/10/tigla_metalica_acoperisuri_55522.jpg"
    [cat-de-mult-conteaza-consilierii-de-vanzari-cand-iti-alegi-tigla-metalica]="/wp-content/uploads/2021/11/consilieri_vanzari_bdm_roof_system_54543-1-768x608.png"
    [2-greseli-pentru-care-vei-avea-costuri-mari-la-acoperisul-cu-tigla-metalica]="/wp-content/uploads/2021/11/acoperis_sanatos_bt_bdm_55430-1-768x432.png"
    [tabla-cutata-pentru-acoperis-utilizari-avantaje-montaj]="/wp-content/uploads/2021/10/tabla_cutata_54655.jpg"
    [cum-poti-avea-infiltratii-in-casa-chiar-daca-afara-nu-ploua-sau-ninge]="/wp-content/uploads/2021/10/ventilare_acoperis_54772-768x552.jpg"
    [care-este-adevaratul-rol-al-foliei-anticondens]="/wp-content/uploads/2021/10/folie_anticondens_54789-768x677.jpg"
    [budmat-venecja-tigla-metalica-cu-o-etansare-perfecta]="/wp-content/uploads/2021/10/acoperis_sanatos_bt_bdm_55430-768x432.png"
    [folia-anticondens-riwega-reflecta-83-din-caldura-emisa-de-tigla-catre-casa]="/wp-content/uploads/2021/11/membrana_de_difuzie_termo_reflexiva_riwega_43848.jpeg"
    [tigla-metalica-sau-tigla-ceramica]="/wp-content/uploads/2017/09/tigla-metalica-sau-tigla-ceramica-sau-tabla-faltuita-mic-1.png"
    [valorile-bdm-roof-system]="/wp-content/uploads/2021/11/consilieri_vanzari_bdm_roof_system_54543-1.png"
)

for slug in "${!IMGS[@]}"; do
    path="${IMGS[$slug]}"
    ext="${path##*.}"
    dest="${slug}.${ext}"
    if [ ! -f "$dest" ]; then
        url="https://acoperisuri.info${path}"
        curl -skL -o "$dest" "$url"
        sz=$(stat -c %s "$dest" 2>/dev/null || echo 0)
        echo "$dest -> $sz bytes"
    fi
done
echo "=== DONE ==="
