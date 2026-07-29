#!/bin/bash
cd "$(dirname "$0")/.."
# FAKRO Ferestre Mansarda - download all images

declare -A PRODUCTS=(
    [fakro-fts-v-u2]="2:1wlJeWYRZONsws9LyHMT2JAGrPetndwON 3:1upAi_SziCqlYlNuqOENSkqS_4fflxlzh 4:1sBu5cq80u_G1w7t0FHs7b1j__ywZgFVm"
    [fakro-ftp-v-u3]="6:1111iF9vX1TUDcQkVeOJLU0Ng5laVu55L 7:16RUQtBJpSeyAd446wJ-BC3L-SejdiP18 8:1Kzx7FDwVS5PaJTyS6V5HHSVOxHxTCC2v 9:1wHlE3QUpkhEXt_GVyqFyihRMJ3MG2N3L"
    [fakro-ftp-v-u5]="11:1iZEZo58oI0YJcAp1Gzth3geEAnFvWPfp 12:1nMk-MgZAB4SPjQ-W_Pz0A5hQoc_WHcPv 13:12r8ZtOgOZfkxFg3lfeS26T3JxxOQdUSJ"
    [fakro-ftp-v-p2]="15:1Pni-fhJxYpdcytzd2EwwWy8Krz4IO8iz 16:1mWi56OOi1U3nN2y4Yhcfyd5IPO7MgX2r"
    [fakro-fpp-v-u3]="18:156CjueFIU5mXIRzUOE3YZNE756iOET7o 19:1MEjnhcO3Ge8lr_HSq3QJR--_ApBmozRj"
    [fakro-fpu-v-u3]="21:1pvFGAGdD99645eXJ4kjnsSjzK1IRL_9K 22:1EGBz3mEgS07cXRBgJVd8btM3vL3xjS_2 23:11pG_z1AQYlXL31WNLS_UsRc9Ck-58d7o"
    [fakro-fdy-v-u3]="25:1RtXHEII2_S2jU7ye-xjtgyLTeqFyGcB4 26:1Miuf1AnNjeEdDggmJUym_ZeYV69yOtNR 27:1YCtf3GZcCVclIF05Ldf98tN_sXfrncwB"
    [fakro-ftp-v-u4]="29:1JA0yrk7e4jPwobpJVxH2K4frlz4-LdE0 30:15kPFZGPIMuqO0OdZM12JM15Dot-yr--G"
    [fakro-ftu-v-u3]="32:1oWuwH7A8B7k-gZwVMSe6UJdZPYgCefsi 33:1n7YHCcHlmPmkDAyjk11pPTjChu1a2RwX 34:1MmoQsfWz-pETh3lqLUCiwT3Jmyeu6V1e"
    [fakro-ptp-v-u3]="36:1PyoRFr9UJ15HtDsidrRXsi8yGugwin2b 37:1jc7wmYl7cAd2gdF_E6nNd077TTWoj0fk 38:1MDuh2rmLZZz3Ojl13YomfhKj6hHLhSVz 39:15qqPYJi0MpHticE-lTvgM9FbB18AEklT 40:1h8c3tD8Bczl-gKq9_3QYb3XQ2S2YHVCe 41:1jTjqcyamVeIHHJS_C55NF-3bCxClCBU3"
    [fakro-ptp-v-u4]="43:1on6e-JyQOGT-GZzwEDyWvMtTIzZe3ZXR 44:1GqXgz6lVLWdiKBXCgcVJqS04d_9z7KCt 45:1j6sJScIRWR24_67JB8Em5spTuJ6oVmJY"
    [fakro-ptp-v-u5]="47:1ze7QCgkTpRhoVgub5ztU85efJ2K69HRO 48:14V1GYru4M4N-iSE5onx4FBQVhh-xJm24"
    [fakro-ftt-u8-thermo]="50:18lcE1CtI9dafDnoVD5V36zSE_ynBjUzZ 51:1N5TZpMHLfV7JoXDYlZd4fxIxt3N_DCKU 52:1NKflPKzY1oyx729QQKT3HcJCfpYDx99y"
    [fakro-fgh-v-p5-galeria]="54:1vd4qC-EH3hEo5PO5wy0kNjFCeZhQtz1P 55:1NjSUTtv0OaqFWqmJ0fEc-sq_2_SUGgwL 56:1LALthnr0qYOG3lNLrUYj-cVCYXjP47ci 57:1PhFj3MRxBrBMsCqk31zxvlzqoJzY8UoZ"
    [fakro-fpu-v-u5]="59:1kV9F_wGWYM8FYJ_D9Jw_mF5tzbX4lFnV 60:1st-h69gcFkNFXeeuD2SB7twigWPjbS0w 61:15hVcBL1pWNK4aAzVJQ53bwCc2Aas-5TY"
)

for slug in "${!PRODUCTS[@]}"; do
    mkdir -p "public/uploads/products/$slug"
    for pair in ${PRODUCTS[$slug]}; do
        num=${pair%:*}
        id=${pair#*:}
        file="public/uploads/products/$slug/$num.png"
        if [ ! -f "$file" ]; then
            curl -skL -o "$file" "https://drive.google.com/uc?export=download&id=${id}"
            sz=$(stat -c %s "$file" 2>/dev/null || echo 0)
            echo "$slug/$num.png -> $sz bytes"
        fi
    done
done
echo "=== DONE ==="
