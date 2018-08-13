@extends('layouts.app.app')

@section('content')
    <style type="text/css">
        input{
            padding: 5px !important;
            border-radius: 0 !important;
            resize: none !important;
        }
        textarea{
            padding: 5px !important;
            border-radius: 0 !important;
        }
    </style>

        <!-- Intro Section -->
        <section id="intro" class="intro-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 style="font-family:Jonah_DEMO !important; font-size: 2.5em !important; display: inline-flex !important;">
                            <div style="color: #d59431;">MAKTUB</div>
                            <div style="font-size: 0.6em !important; padding-top: 8%;">&nbsp;BEAUTY</div>
                        </h1>
                        <p class="text-justify">
                            A <code>Maktubbeauty</code> deu inicio ao seu sonho no final de 2017 com sua loja física dentro do Shopping Vipx (tradicional na baixada santista)  seu começo já foi grande, dentro de poucos meses tornou-se referencia e indicado por muitos como a maior loja de maquiagem da baixada santista.
                            Como objetivo a Maktubbeauty tem como transformar seus sonhos em realidade e com isso em Julho de 2018 o sonho se tornou ainda maior após iniciar seu e-commerce especializado em maquiagem com o o intuito de levar beleza, auto estima e amor para todo o Brasil.
                            A <code>Maktubbeauty</code> conta com uma linha grande de marcas nacionais e importadas ! Todos produtos são testados pela equipe de maquiadoras qualificadas e blogueiras parceiras, queremos não só buscar o melhor para você, mas também o melhor custo-beneficio.
                        </p>
                        <a class="btn btn-default page-scroll" href="#about">Click para Saber Mais!</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Política de privacidade -->
        <section id="policies" class="policies-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Política de privacidade</h3>
                        <p class="text-justify">A Maktubbeauty sempre estará preocupada em proteger seus dados com segurança e privacidade.
                            Os seus dados cadastrais são armazenados de forma segura e sigilosa. Todos seus dados serão utilizados somente autorizado. No final da Pagina (rodapé) toda comunicação de newsletter você encontrará a opção "descadastro" na qual poderá optar por não receber as nossas promoções.
                            Qualquer duvida só entrar em contato conosco através de nossas redes sociais
                        </p>
                    </div>
                </div>
            </div>
        </section>

            <!-- Prazo de Entrega -->
        <section id="deliveryTime" class="policies-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Prazo de Entrega</h3>
                        <p class="text-justify">A Maktubbeuaty conta com prazo de entrega que varia de acordo com a sua região e a forma de envio selecionada.
                            <P>Hoje temos duas modalidades de envio:</p>
                            <strong> - Via PAC</strong>
                            <br>
                            <strong> - Via Sedex</strong>
                            <br>
                            <br>
                            <small>
                                O valor do frete e a estimativa do prazo de entrega são calculados no carrinho quando você informa o CEP do endereço de entrega.
                            </small>
                            <br>
                            <br>
                            <p><strong>Para conferir as condições para o seu endereço de envio:</strong></p>
                            <p class="text-justify">
                                    1. Adicione um ou mais produtos que você deseja comprar ao carrinho;
                                <br>2. Informe o CEP para entrega no campo indicado;
                                <br>3. Clique no botão Calcular Frete;
                                <br>4. Os valores de frete de cada modalidade e a estimativa de prazos de entrega vão aparecer logo abaixo para que você selecione a de sua preferência.
                            </p>
                            <p class="text-justify">
                                Todas as compras são enviadas em no máximo 2 dias úteis após a confirmação de pagamento. O prazo de entrega é calculado em dias úteis, após a data da postagem do pedido. Você pode acompanhar o status de pagamento e envio acessando o seu cadastro, na opção <strong>MEUS PEDIDOS</strong>.
                                O prazo é uma estimativa que varia de acordo com a localidade. Para a Região Norte o prazo pode ser estendido para até 27 dias úteis em entregas na modalidade <strong>PAC</strong>, já para entregas via <strong>SEDEX</strong> pode haver o acréscimo de até 3 dias úteis ao prazo inicial.
                                Para a modalidade <strong>SEDEX</strong> o valor do frete é variável de acordo com a região e o peso dos produtos selecionados.</p>
                        </P>
                    </div>
                </div>
            </div>
        </section>

        <!-- Código de Rastreio -->
        <section id="trackingCode" class="policies-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Código de Rastreio</h3>
                        <p class="text-justify">Quando o seu pedido é enviado, nas modalidades <strong>PAC</strong> e <strong>SEDEX</strong>, nós informamos o <code>código de rastreio*</code>, para que você possa acompanhar o percurso diretamente no site dos correios ou pelo painel do cliente. Nossas encomendas são enviadas via Correios e estão sujeitas a alterações de prazo, de acordo com as políticas e serviços da instituição. O código de rastreamento informa apenas as etapas pelas quais seu pedido passou até sair para entrega no endereço indicado, mas não informa a localização em tempo real do seu pedido.<br>
                            Por este motivo podem haver divergências entre o informado no site dos correios e o real status do seu envio.
                    </div>
                </div>
            </div>
        </section>

        <!-- Formas e Condições de pagamento -->
        <section id="TermsPayment" class="policies-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Formas e Condições de pagamento</h3>
                        <p class="text-justify">Atualmente a Maktubbeauty trabalha com as seguintes formas de pagamento:</p>
                        <p class="text-justify">
                            <strong>- Boleto bancário:</strong> O prazo para pagamento do boleto bancário é de 1 dia útil e o prazo para compensação do pagamento é de até 3 dias úteis.
                            <br>
                            Não é necessário o envio do boleto bancário ou comprovante para nosso SAC, pois a confirmação de pagamento é identificada automaticamente e repassada pelo banco.
                            <br>
                            <br>
                            <strong>- Cartão de crédito:</strong> (Visa, Mastercard, Hipercard, Elo, American Express): O parcelamento nas compras por cartão de crédito pode ser de até 3x sem juros. A parcela mínima é de R$ 20,00.
                            <br>
                            As compras por cartão de crédito costumam ser aprovados automaticamente, mas podem levar até 72 horas, caso seu pagamento fique em análise.
                            <br>
                            <br>
                            <strong>- Deposito em Conta/Transferência:</strong> Os dados bancários para depósito ou transferência estão na finalização do pedido e o prazo para realização do pagamento é de até 3 dias úteis. Estão disponíveis opções para realização do depósito: Bradesco, Itau.
                            <br>
                            A confirmação do pagamento é realizada mediante envio do comprovante, que pode ser enviado como anexo para o e-mail: financeiro@maktubbeauty.com.br. O prazo para confirmação do pagamento é de até 48 horas úteis.
                    </div>
                </div>
            </div>
        </section>

        <!-- Trocas e Devoluções -->
        <section id="swapDevices" class="policies-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Trocas e Devoluções</h3>
                        <p class="text-justify"><strong>- Desisti da compra:</strong> A partir da data de recebimento do produto, você tem 7 dias corridos para solicitar a devolução do pedido<BR> (conforme Art. 49 do Código de Defesa do Consumidor).</p>
                        <p class="text-justify">
                            <strong>- Não gostei da cor e quero trocar:</strong> Você percebeu pela embalagem que o tom não se adequa ao seu gosto? Não tem problema, você tem 7 dias corridos, para solicitar a devolução do pedido (conforme Art. 49 do Código de Defesa do Consumidor).
                            <br>
                            Não é necessário o envio do boleto bancário ou comprovante para nosso SAC, pois a confirmação de pagamento é identificada automaticamente e repassada pelo banco.
                            <br>
                            <br>
                            <strong>- Meu produto veio com defeito de fábrica:</strong>Infelizmente, na grande maioria das vezes não temos como verificar o estado dos produtos que contém lacre antes do envio. Então, se o seu pedido está com defeito de fábrica, o prazo para nós contatar é de 7 (sete) dias, a partir do recebimento do produto (conforme Art. 18 e Art. 26 do Código de Defesa do Consumidor);
                            <br>
                            <br>
                            <strong>- Eu não pedi esse produto ou essa cor:</strong> Você verificou que a cor do batom chegou trocada, ou veio outro produto que não está de acordo com o que você solicitou? Se possível recuse o pedido no ato da entrega, ou entre em contato com nosso SAC em até 7 (sete) dias a partir do recebimento do produto (conforme Art. 18 e Art. 26 do Código de Defesa do Consumidor);
                            <br>
                            <br>
                            <strong>- Minha caixa chegou aberta:</strong> Caso você não tenha recebido diretamente, entre em contato com nosso SAC, o prazo é de até 7 (sete) dias a partir do recebimento do produto (conforme Art. 18 e Art. 26 do Código de Defesa do Consumidor).
                            Como pode ser realizada a troca ou devolução?
                            <br>
                            <br>
                            <strong>OBS - A troca poderá ser realizada pelo mesmo produto;</strong> O estorno do valor do produto ou pedido, que poderá ser realizada por: conta corrente, ou estorno no cartão de crédito.
                            <p class="text-justify">O reembolso poderá ser realizado de duas formas:</P>
                            <p class="text-justify"><strong>- Deposito ou Transferência:</strong> após o envio dos dados bancários, será enviado um e-mail de confirmação de recebimento dos dados. O prazo para realizar a transação é de até 5 dias úteis após a resposta do nosso setor.</P>
                            <p class="text-justify"><strong>- Cartão de Crédito:</strong> O estorno será realizado de imediato junto à administradora do cartão de crédito. A administradora realizará o estorno em uma das duas próximas faturas do seu cartão de crédito.</P>
                            <BR><strong>Como o produto deve estar para que a troca seja realizada?</strong>
                            <BR><small><b>- Com exceção de produtos com defeito de fábrica, os produtos para trocas ou devoluções devem estar nas seguintes condições:</b></small>

                            <P CLASS="text-left">
                                - Lacre intacto;<br>
                                - Na embalagem original;<br>
                                - Sem indícios de uso do produto ou de estrago por mau uso;<br>
                                - Acompanhado do manual e com todos os acessórios, se houver;
                            </P>
                            <P class="text-justify">
                                A troca ou devolução só poderá ser efetivada após análise do produto, feita pela nossa área de Logística. Pode ser solicitado ao cliente imagens (foto ou vídeo) do produto, para que seja identificado e certificado que o produto está com o lacre, ou para constatar o problema relatado pelo cliente. O prazo para análise é de até 3 (três) dias úteis, contados a partir do recebimento do produto em nossa Loja<br>
                                <br>Tenho algum gasto com a troca ou devolução?<br>
                                - Não, a troca ou a devolução é um direito do cliente. Não é cobrado nenhum valor por esse serviço.
                            </P>
                    </div>
                </div>
            </div>
        </section>

        <!------------------------------------>

        <!-- Política de Privacidade -->
        <section id="policiesPrivate" class="policies-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Política de privacidade</h3>
                        <p class="text-justify">Todas as suas informações pessoais recolhidas, serão usadas para o ajudar a tornar a sua visita no nosso site o mais produtiva e agradável possível.
                            A garantia da confidencialidade dos dados pessoais dos utilizadores do nosso site é importante para o Maktube Beauty.
                            Todas as informações pessoais relativas a membros, assinantes, clientes ou visitantes que usem o Maktube Beauty serão tratadas em concordância com a Lei da Proteção de Dados Pessoais de 26 de outubro de 1998 (Lei n.º 67/98).
                            A informação pessoal recolhida pode incluir o seu nome, e-mail, número de telefone e/ou telemóvel, morada, data de nascimento e/ou outros.
                            O uso do Maktube Beauty pressupõe a aceitação deste Acordo de privacidade. A equipa do Maktube Beauty reserva-se ao direito de alterar este acordo sem aviso prévio. Deste modo, recomendamos que consulte a nossa política de privacidade com regularidade de forma a estar sempre atualizado.
                        <h3>Os anúncios</h3>
                        <p class="text-justify">Tal como outros websites, coletamos e utilizamos informação contida nos anúncios. A informação contida nos anúncios, inclui o seu endereço IP (Internet Protocol), o seu ISP (Internet Service Provider, como o Sapo, Clix, ou outro), o browser que utilizou ao visitar o nosso website (como o Internet Explorer, Google Chrome ou o Firefox), o tempo da sua visita e que páginas visitou dentro do nosso website.</p>
                        <h3>Os cookies e Web Beacons</h3>
                        <p class="text-justify">Utilizamos cookies para armazenar informação, tais como as suas preferências pessoas quando visita o nosso website. Isto poderá incluir um simples popup, ou uma ligação em vários serviços que providenciamos, tais como fóruns.</p>
                        <p class="text-justify">Em adição também utilizamos publicidade de terceiros no nosso website para suportar os custos de manutenção. Alguns destes publicitários, poderão utilizar tecnologias como os cookies e/ou web beacons quando publicitam no nosso website, o que fará com que esses publicitários (como o Google através do Google AdSense) também recebam a sua informação pessoal, como o endereço IP, o seu ISP, o seu browser, etc. Esta função é geralmente utilizada para geotargeting (mostrar publicidade de Lisboa apenas aos leitores oriundos de Lisboa por ex.) ou apresentar publicidade direcionada a um tipo de utilizador (como mostrar publicidade de restaurante a um utilizador que visita sites de culinária regularmente, por ex.).</p>
                        <p class="text-justify">Você detém o poder de desligar os seus cookies, nas opções do seu browser, ou efetuando alterações nas ferramentas de programas Anti-Virus, como o Norton Internet Security. No entanto, isso poderá alterar a forma como interage com o nosso website, ou outros websites. Isso poderá afetar ou não permitir que faça logins em programas, sites ou fóruns da nossa e de outras redes.</p>
                        <h3>Ligações a Sites de terceiros</h3>
                        <p class="text-justify">O Maktube Beauty possui ligações para outros sites, os quais, a nosso ver, podem conter informações / ferramentas úteis para os nossos visitantes. A nossa política de privacidade não é aplicada a sites de terceiros, pelo que, caso visite outro site a partir do nosso deverá ler a politica de privacidade do mesmo.</p>
                        <p class="text-justify">Não nos responsabilizamos pela política de privacidade ou conteúdo presente nesses mesmos sites.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="terms" class="terms-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Termo de Uso</h3>
                    <h4>Visão Geral</h4>
                    <p class="text-justify">Esse site é operado pelo Maktube Beauty. Em todo o site, os termos “nós”, “nos” e “nosso” se referem ao Maktube Beauty. O Maktube Beauty proporciona esse site, incluindo todas as informações, ferramentas e serviços disponíveis deste site para você, o usuário, com a condição da sua aceitação de todos os termos, condições, políticas e avisos declarados aqui.</p>
                    <p class="text-justify">Ao visitar nosso site e/ou comprar alguma coisa no nosso site, você está utilizando nossos “Serviços”. Consequentemente, você  concorda com os seguintes termos e condições (“Termos de serviço”, “Termos”), incluindo os termos e condições e políticas adicionais mencionados neste documento e/ou disponíveis por hyperlink. Esses Termos de serviço se aplicam a todos os usuários do site, incluindo, sem limitação, os usuários que são navegadores, fornecedores, clientes, lojistas e/ou contribuidores de conteúdo.</p>
                    <p class="text-justify">Por favor, leia esses Termos de serviço cuidadosamente antes de acessar ou utilizar o nosso site. Ao acessar ou usar qualquer parte do site, você concorda com os Termos de serviço. Se você não concorda com todos os termos e condições desse acordo, então você não pode acessar o site ou usar quaisquer serviços. Se esses Termos de serviço são considerados uma oferta, a aceitação é expressamente limitada a esses Termos de serviço.</p>
                    <p class="text-justify">Quaisquer novos recursos ou ferramentas que forem adicionados à loja atual também devem estar sujeitos aos Termos de serviço. Você pode revisar a versão mais atual dos Termos de serviço quando quiser nesta página. Reservamos o direito de atualizar, alterar ou trocar qualquer parte desses Termos de serviço ao publicar atualizações e/ou alterações no nosso site. É sua responsabilidade verificar as alterações feitas nesta página periodicamente. Seu uso contínuo ou acesso ao site após a publicação de quaisquer alterações constitui aceitação de tais alterações.</p>
                    <p class="text-left"><a href="{{asset('docs/Terms_of_Use.pdf')}}" style="text-decoration: none;"><code><span class="fa fa-file-pdf-o state"></span>&nbsp;Versão Completa</code></a></p>
                </div>
            </div>
        </div>
    </section>
        <!-- About Section -->
        <section id="about" class="about-section">
            <div class="container">
            <!--Missão-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="img-responsive">
                        <div class="col-md-8 col-sm-6 portfolio-item">
                            <div>
                                <h5 class="text-left">Nossa Motivação </h5>
                                <p class="text-justify">
                                    Sabe-se que a maquiagem é a sua forma de preencher todos os espaços e ser um refugio para a sua auto estima
                                    Você será sempre muito bem-vinda
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="img-responsive">
                        <div class="col-md-8 col-sm-6 portfolio-item">
                            <div>
                                <h5 class="text-left">Missão </h5>
                                <p class="text-justify">Trazer experiencia unica em cada compra. Lidando com a sua auto-estima e realização pessoal como objetivo principal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Visão-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="img-responsive">
                        <div class="col-md-8 col-sm-6">
                            <div>
                                <h5 class="text-left">Visão</h5>
                                <p class="text-justify">Ser o maior portal de Maquiagem do brasil</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Valores-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="img-responsive">
                        <div class="col-md-8 col-sm-6">
                            <div>
                                <h5 class="text-left">Valores</h5>
                                <p class="text-justify">Qualidade, Honestidade, Inovação.</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- Contact Section -->
        <section id="contact" class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Contato</h2>
                        <h3 class="section-subheading text-muted">Envie-nos a sua mensagem, ajude-nos a melhorar.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form name="sentMessage" id="contactForm" >
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Seu Nome *" id="name" required data-validation-required-message="Digite seu Name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Seu E-Mail *" id="email" required data-validation-required-message="Digite seu E-Mail.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" class="form-control" placeholder="Seu Telefone *" id="phone" required data-validation-required-message="Digite seu Número de Telefone.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <textarea class="form-control" placeholder="Sua Mensagem *" id="message" required data-validation-required-message="Digite sua Mensagem." rows="6" maxlength="1500"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-xl">Enviar Mensagem</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact" class="contact-section">
            <div class="container">
                <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Conheça nossa Loja Fisica</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
                <div class="row">
                <div class="col-md-12">
                    <div id="location" class="d-flex justify-content-center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14583.307733368389!2d-46.3849294!3d-23.9665593!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6d544802d1b4e2b4!2sMaktub+Beauty!5e0!3m2!1spt-BR!2sbr!4v1533650947100" width="650" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            </div>
        </section>


@stop
