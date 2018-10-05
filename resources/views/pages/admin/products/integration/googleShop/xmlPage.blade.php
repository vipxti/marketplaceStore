<?php
echo '<?xml version="1.0"?>';
?>

<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
    <channel>
    <title>Maktub Beauty</title>
    <link>https://www.maktubbeauty.com.br</link>
    <description>
        Teste
    </description>
        @foreach($produtos as $p)
            <item>
                <g:id>{{$p->cd_nr_sku}}</g:id>
                <g:title>{{$p->nm_produto}}</g:title>
                <g:description>{{$p->ds_produto}}</g:description>
                <g:link>https://www.maktubbeauty.com.br/page/product/{{$p->nm_slug}}</g:link>
                <g:image_link>http://maktubbeauty.com.br/img/products/{{$p->im_produto}}</g:image_link>
                <g:condition>Novo</g:condition>
                <g:price>R${{$p->vl_produto}}</g:price>

                @if($p->qt_produto > 5)
                    <g:availability>Em Estoque</g:availability>
                @else
                    <g:availability>Indisponivel</g:availability>
                @endif

                <g:shipping>
                    <g:country>BR</g:country>
                    <g:service>Padrão</g:service>
                </g:shipping>
                <g:gtin>{{$p->cd_ean}}</g:gtin>
                <g:brand>{{$p->nm_marca}}</g:brand>
                <g:google_product_category>{{$p->nm_categoria . ' > ' . $p->nm_sub_categoria}}</g:google_product_category>
            </item>
        @endforeach
    </channel>
</rss>