#!/bin/bash
cd "$(dirname "$0")/.."

declare -A PRODUCTS=(
    # 07a Folii BDM (2)
    [bdm-125-standard-plus]="3:1C8H3OJyfRbHtiwvaZUtClogq2jrH54TY 4:14jf4tz_rvyUs_bM2-_7JCX_1Z03-n8qI"
    [bdm-140-maxi-sk2]="1:1MGysswki1vMwmr-igjqjwovkV-EFycWY 2:1LevTVSNaaFvp6CHiby4Uvk5As6HVq7IM"
    # 07b Membrane Difuzie (8)
    [riwega-do-135]="29:1jKIT44e7Ed5vq7I1nsC079a5Yq7emEm3 30:1L_1665VtabOF85-hsDN2refb0DAxfFge 31:1k4aCL--VKIwY28KyqE9oFPiKBqW3rFui"
    [riwega-do-155]="25:1B8JCvgp-FtJ4bDf2wRmJejKJp9yAu_tH 26:1rII7sBMsVpP1jPOInZbXs7EmUMDj77P2 27:1KgNIEJSgOubv9aUVd01V9RMX-IBIeUr5"
    [riwega-usb-classic]="17:1GPQHqBpraok7mhTFG7eIcWNuJa8APFVL 18:1iFAVoar0JvZSzbuKlZ4PAhNoDXZLllbB 19:1woWSKDx30hUgYOGHnkAT6GCW643z2rEN"
    [riwega-usb-elefant]="21:1TiRlko6nGvMCmqCFtnbSknaYjFEgUnt_ 22:1NakxZpoCqHl1MR_CxMo48iUkU2SEKhpn 23:14yOlQwY8njaR5d730sjWQwrauC76liGH"
    [riwega-usb-protector-gold-330]="5:16GCjXSmCP0N_q46CxJhqlK2HDzmPatPV 6:1niWojveCHDbZg3NpJmuiv2cB7w8tGSVF 7:1CpDql6LObtgLBxT7caWto7YCYsgu5Sue"
    [riwega-usb-protector-silver-230]="9:1LVR4JgLrN1ljmieo-5ltEjFqE5VvgVtB 10:1ZYR2RMI4ftFXxaOUGVKjoNIwRyI9uQXk 11:1ImhUtAT8SozomQBmhfonoRzQrUFpMKQ1"
    [riwega-usb-reflex-plus]="1:1Q__46Y3VIKHOaxZIS8NSpEMtfROGJpRe 2:1DWqAfpVfqhwt6MhHfUAPavHlDFNpyR4d 3:1G42xhF6K5hOnkghCOVtq7Wi3xNrfJ45Q"
    [riwega-usb-weld-as]="13:1HqLRrmZVUt4yvws-2gC3wHf4RiQxyp-z 14:1u2t3pLHDmVe7KRxwNTpVEMqxiY9hy8NF 15:1tuQKOGPkA4Qbj8H6HN3Kt9gLjrO98XLf"
    # 07c Membrane Control Vapori (4)
    [riwega-usb-micro-strong]="1:19GV5KbS7BUGvxBKn4KvRqrpmSAi0gfI5 2:1a7B0BgExLnqEP20ZPL3JXjAFWN9mO__T 3:1f2C-zl1Js36Y8P81q8NNaFRgehYeWtva"
    [riwega-usb-micro]="5:1CMn-hsJLUnjRO1cfHx0CVCQ8Luy8Q6HD 6:1c_T8Ij4sk2G8n1tnNBB90JpA3UEHqN3D 7:1Qk2qOam6OS8MHZG3yyW9b_kUlkvGlFwZ"
    [riwega-usb-micro-light]="9:1EOI1Arkxqokf_8UgdYDiH4LNQSom6NIe 10:18d4CMPNViBQvy-PlCpZLMYIH-Oizfu9o 11:1fCqVsNC9UPmlhvEsgsESoCo5MqMHd4az"
    [riwega-micro-200-vario]="13:1o0suCbIIrJXT7tNUeEexAGNh2QQwkuIl 14:1gfpZJ__ZgEvIbbypS4xVGVOSjp_rBpYN 15:1LlidUr9mj0ciK0EB0PySteAluvehwgwW"
    # 07d Bariere Vapori (3)
    [riwega-ds-188-alu]="1:1y_mpJQDW4Ba1YYQUYPpx5oMP6T5XAie7 2:11sqJsbvgVv-UY7WQUyqaSsyTLBKtJ6eS 3:19Bx2hsJg4bkR1tefB1QxBx1VYx_0f1Wr"
    [riwega-ds-1500-syn]="5:118n04Zvpxh0YNmdnxWyi91O22AqZqpC9 6:1yfZ8nEtqFYj0joSAYKA36HSLXJLaOSrR 7:1g9JLR1fJhjp38GUU6gzv8DLjyj9Hbn1L"
    [riwega-ds-65-pe]="9:1HQ8apxtEarwLd0jK8qHxKsBuIjAjPIpk 10:1tFCthOInt1T2ZEJIPbgWDZu30JypMkXB"
    # 07e Membrane Fatada (2)
    [riwega-usb-windtop-uv]="2:1jX-H6g3kq2f7VEZDXyLdsUu_4MOq7sPE 3:120bcHIj_1PNB8ILhOP0M19DlIni1ZCzm 4:1pz1gQggd8-PrPUkfNqVrKl_bmCOdLPZn"
    [riwega-usb-wall-120]="6:19_Sz3VTVrECzsPMUacL-vfdKdieoxWOn 7:1bKAK0OSnFD9v-PTSWqivZWCZp0U4wlAi 8:1m6kph58pYKFKOt_zboearRUUVN1U69Fp"
    # 07f Covoare Tabla Faltuita (1 cu poze)
    [riwega-usb-drenlam-bluetech]="2:1UZx9fbq7ZXI24iueLOwNTCZtVe9ouprY 3:1fJRw1_fXyB5PjcIlGX_7-vW9ofRGA5HH 4:1OK8cg40IAQJdMI_Co8v7-zWpUloPUGGH"
    # 07g Membrane Autoadezive (3)
    [riwega-vsk-bitum-reflex-1200]="2:1hcH4Ohc-uefqIV1F0v5pZzSNe7cPVuiZ 3:1SGFFDGE0zYfx_MkWqpkxMxeR80kfY-B9 4:1ycglbgdherPGz-IT3a-fM-GioPhr45Ry"
    [riwega-vsk-clear-280]="6:1qkzfLHiLjPUUQ9s4NvMbB5FoYcS0hmtt 7:1BkeZe2u84z-nqJYfwC3QyvcQaIEavvXR 8:1wna_sf68Qhb_xgeA-1bLCK7KX-_wBuwg"
    [riwega-vsk-ds-1500-syn]="10:13q34r4p_31uSv5bq6l25xdwRXQ6VE05G 11:1UGwyoFVcbkd3QsTbPhRTX6ajDs2aFy3X 12:1CxVXn4lav0zxnZwdDJNdRrqKv7ALwlGL"
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
            echo "$slug/$num.png -> $sz"
        fi
    done
done
echo "=== DONE ==="
