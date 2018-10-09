<?php

namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;

class XmlFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera feed de xml de produtos cadastrados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('produto_categoria_subcat', 'produto.cd_produto', '=', 'produto_categoria_subcat.cd_produto')
            ->join('categoria_subcat', 'produto_categoria_subcat.cd_categoria_subcat', '=', 'categoria_subcat.cd_categoria_subcat')
            ->join('categoria', 'categoria_subcat.cd_categoria', '=', 'categoria.cd_categoria')
            ->join('sub_categoria', 'categoria_subcat.cd_sub_categoria', '=', 'sub_categoria.cd_sub_categoria')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('marca', 'produto.marca_id_fk', '=', 'marca.id_marca')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->where('produto.cd_status_produto', '=', 1)
            ->where('img_produto.ic_img_principal', '=', 1)
            ->get();

        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">';
        $xml .= '<channel>';
        $xml .= '<title>Maktub Beauty</title>';
        $xml .= '<link>https://www.maktubbeauty.com.br</link>';
        $xml .= '<description>Teste</description>';

        foreach($produtos as $p){
            $xml .= '<item>
                <g:id>'. $p->cd_nr_sku .'</g:id>
                <g:title>'. $p->nm_produto .'</g:title>
                <g:description>'. $p->ds_produto .'</g:description>
                <g:link>https://www.maktubbeauty.com.br/page/product/'. $p->nm_slug.'</g:link>
                <g:image_link>http://maktubbeauty.com.br/img/products/'. $p->im_produto .'</g:image_link>
                <g:condition>new</g:condition>
                <g:price>R$'. $p->vl_produto .'</g:price>';

            if($p->qt_produto > 5)
                $xml .= '<g:availability>in stock</g:availability>';
            else
                $xml .= '<g:availability>preorder</g:availability>';

            $xml .= '<g:shipping>
                            <g:country>BR</g:country>
                            <g:service>Standard</g:service>
                        </g:shipping>
                        <g:gtin>'. $p->cd_ean .'</g:gtin>
                        <g:brand>'.$p->nm_marca .'</g:brand>
                        <g:google_product_category>'. $p->nm_categoria . ' > ' . $p->nm_sub_categoria . '</g:google_product_category>
                    </item>';
        }

        $xml .= '</channel>
                </rss>';

        $arquivo = fopen('public/feed8.xml', 'w+');
        fwrite($arquivo, $xml);
        fclose($arquivo);
    }
}
